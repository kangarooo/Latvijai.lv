<?php
/**
 * Elementor atbalsts.
 *
 * - Sākumlapas sekcijas kā Elementor logrīki (kategorija „Latvijai Futura”).
 * - Elementor Pro galvenes/kājenes vietas (Theme Builder).
 * - Elementor noklusējuma krāsas un fonti izslēgti, lai logrīki manto tēmas stilu.
 * - Viena klikšķa „Elementor sākumlapa”, kas izskatās tieši kā tēmas sākumlapa.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sākumlapas sekcijas secībā: slug => nosaukums.
 *
 * @return array
 */
function latvijai_front_sections() {
	return array(
		'hero'      => __( 'Hero (virsraksts, daļiņas, tikers)', 'latvijai-futura' ),
		'mission'   => __( 'Misija', 'latvijai-futura' ),
		'latvia'    => __( 'Latvija (reģioni)', 'latvijai-futura' ),
		'projects'  => __( 'Projekti', 'latvijai-futura' ),
		'spotlight' => __( 'Fokuss', 'latvijai-futura' ),
		'journal'   => __( 'Žurnāls', 'latvijai-futura' ),
		'cta'       => __( 'Aicinājums (CTA)', 'latvijai-futura' ),
	);
}

/**
 * Vai Elementor ir aktīvs.
 *
 * @return bool
 */
function latvijai_has_elementor() {
	return did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' );
}

/**
 * Vai lapa ir veidota ar Elementor.
 *
 * @param int|null $post_id Lapas ID; noklusējums — pašreizējā.
 * @return bool
 */
function latvijai_is_elementor_page( $post_id = null ) {
	if ( ! latvijai_has_elementor() ) {
		return false;
	}

	if ( null === $post_id ) {
		$post_id = is_singular() ? get_queried_object_id() : 0;
	}

	if ( ! $post_id ) {
		return false;
	}

	$document = \Elementor\Plugin::$instance->documents->get( $post_id );

	return $document && $document->is_built_with_elementor();
}

/**
 * Tēmas atbalsts un Elementor Pro vietas.
 */
function latvijai_elementor_setup() {
	add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'latvijai_elementor_setup' );

/**
 * Elementor Pro Theme Builder: galvene un kājene.
 *
 * @param \ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $manager Vietu pārvaldnieks.
 */
function latvijai_elementor_register_locations( $manager ) {
	$manager->register_core_location( 'header' );
	$manager->register_core_location( 'footer' );
}
add_action( 'elementor/theme/register_locations', 'latvijai_elementor_register_locations' );

/**
 * Izvada Elementor Pro vietu, ja tāda ir piešķirta.
 *
 * @param string $location header|footer.
 * @return bool True, ja Elementor izvadīja vietu un tēmas versija jāizlaiž.
 */
function latvijai_elementor_location( $location ) {
	return function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( $location );
}

/**
 * Pēc tēmas aktivizēšanas izslēdz Elementor noklusējuma krāsas un fontus,
 * lai virsraksti, pogas un teksts mantotu tēmas dizainu.
 */
function latvijai_elementor_defaults() {
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
}
add_action( 'after_switch_theme', 'latvijai_elementor_defaults' );

/**
 * Logrīku kategorija.
 *
 * @param \Elementor\Elements_Manager $elements_manager Elementu pārvaldnieks.
 */
function latvijai_elementor_category( $elements_manager ) {
	$elements_manager->add_category(
		'latvijai-futura',
		array(
			'title' => __( 'Latvijai Futura', 'latvijai-futura' ),
			'icon'  => 'eicon-flag',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'latvijai_elementor_category' );

/**
 * Reģistrē sekciju logrīkus.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Logrīku pārvaldnieks.
 */
function latvijai_elementor_widgets( $widgets_manager ) {
	require_once get_template_directory() . '/inc/elementor-widget.php';

	foreach ( latvijai_front_sections() as $slug => $label ) {
		$widgets_manager->register(
			new Latvijai_Section_Widget(
				array(),
				array(
					'latvijai_section' => $slug,
					'latvijai_label'   => $label,
				)
			)
		);
	}
}
add_action( 'elementor/widgets/register', 'latvijai_elementor_widgets' );

/**
 * Elementor redaktorā atkārtoti palaiž tēmas animācijas pēc logrīka pārzīmēšanas.
 */
function latvijai_elementor_editor_script() {
	wp_add_inline_script(
		'elementor-frontend',
		"window.addEventListener('elementor/frontend/init',function(){if(!window.elementorFrontend||!elementorFrontend.isEditMode()){return;}elementorFrontend.hooks.addAction('frontend/element_ready/widget',function(scope){var el=scope&&scope[0];if(el&&/latvijai-/.test(el.getAttribute('data-widget_type')||'')&&window.LatvijaiFutura){window.LatvijaiFutura.refresh();}});});"
	);
}
add_action( 'elementor/frontend/after_enqueue_scripts', 'latvijai_elementor_editor_script' );

/**
 * Elementor datu struktūra, kas atkārto tēmas sākumlapu: viens pilna platuma
 * konteiners ar visiem sekciju logrīkiem.
 *
 * @return array
 */
function latvijai_elementor_front_page_data() {
	$zero = array(
		'unit'     => 'px',
		'top'      => '0',
		'right'    => '0',
		'bottom'   => '0',
		'left'     => '0',
		'isLinked' => true,
	);

	$widgets = array();
	foreach ( array_keys( latvijai_front_sections() ) as $slug ) {
		$widgets[] = array(
			'id'         => substr( md5( 'latvijai-' . $slug ), 0, 7 ),
			'elType'     => 'widget',
			'widgetType' => 'latvijai-' . $slug,
			'settings'   => array(),
			'elements'   => array(),
		);
	}

	return array(
		array(
			'id'       => substr( md5( 'latvijai-front' ), 0, 7 ),
			'elType'   => 'container',
			'isInner'  => false,
			'settings' => array(
				'content_width' => 'full',
				'flex_gap'      => array(
					'column'   => '0',
					'row'      => '0',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'padding'       => $zero,
				'margin'        => $zero,
			),
			'elements' => $widgets,
		),
	);
}

/**
 * Izveido (vai atjauno) Elementor sākumlapu un iestata to kā sākumlapu.
 *
 * @return int|WP_Error Lapas ID.
 */
function latvijai_elementor_create_front_page() {
	// Vienmēr jauna lapa: esošās sākumlapas saturs netiek pārrakstīts.
	$page_id = wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => __( 'Sākumlapa', 'latvijai-futura' ),
			'post_name'   => 'sakumlapa-elementor',
		),
		true
	);

	if ( is_wp_error( $page_id ) ) {
		return $page_id;
	}

	update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
	update_post_meta( $page_id, '_wp_page_template', 'default' );
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( latvijai_elementor_front_page_data() ) ) );
	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		update_post_meta( $page_id, '_elementor_version', ELEMENTOR_VERSION );
	}
	delete_post_meta( $page_id, '_elementor_css' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_id );

	if ( latvijai_has_elementor() ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	return $page_id;
}

/**
 * admin-post darbība: izveido Elementor sākumlapu.
 */
function latvijai_elementor_handle_create() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Nav tiesību.', 'latvijai-futura' ) );
	}
	check_admin_referer( 'latvijai_elementor_front' );

	$page_id = latvijai_elementor_create_front_page();
	if ( is_wp_error( $page_id ) ) {
		wp_die( esc_html( $page_id->get_error_message() ) );
	}

	wp_safe_redirect( admin_url( 'post.php?post=' . $page_id . '&action=elementor' ) );
	exit;
}
add_action( 'admin_post_latvijai_elementor_front', 'latvijai_elementor_handle_create' );

/**
 * Paziņojums administratoram, ja Elementor ir aktīvs, bet sākumlapa vēl nav Elementor lapa.
 */
function latvijai_elementor_admin_notice() {
	if ( ! latvijai_has_elementor() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$front_id = 'page' === get_option( 'show_on_front' ) ? (int) get_option( 'page_on_front' ) : 0;
	if ( $front_id && latvijai_is_elementor_page( $front_id ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'themes', 'edit-page' ), true ) ) {
		return;
	}

	$url = wp_nonce_url( admin_url( 'admin-post.php?action=latvijai_elementor_front' ), 'latvijai_elementor_front' );
	?>
	<div class="notice notice-info">
		<p>
			<strong><?php esc_html_e( 'Latvijai Futura + Elementor', 'latvijai-futura' ); ?></strong> —
			<?php esc_html_e( 'izveidot sākumlapu Elementor redaktorā ar visām tēmas sekcijām (izskatīsies tieši tāpat kā tagad).', 'latvijai-futura' ); ?>
		</p>
		<p><a class="button button-primary" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Izveidot Elementor sākumlapu', 'latvijai-futura' ); ?></a></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'latvijai_elementor_admin_notice' );
