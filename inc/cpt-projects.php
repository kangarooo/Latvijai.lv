<?php
/**
 * Projects custom post type and metadata.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the project post type and its field taxonomy.
 */
function latvijai_register_project_cpt() {
	$labels = array(
		'name'                  => __( 'Projekti', 'latvijai-futura' ),
		'singular_name'         => __( 'Projekts', 'latvijai-futura' ),
		'menu_name'             => __( 'Projekti', 'latvijai-futura' ),
		'name_admin_bar'        => __( 'Projekts', 'latvijai-futura' ),
		'add_new'               => __( 'Pievienot jaunu', 'latvijai-futura' ),
		'add_new_item'          => __( 'Pievienot projektu', 'latvijai-futura' ),
		'new_item'              => __( 'Jauns projekts', 'latvijai-futura' ),
		'edit_item'             => __( 'Labot projektu', 'latvijai-futura' ),
		'view_item'             => __( 'Skatīt projektu', 'latvijai-futura' ),
		'view_items'            => __( 'Skatīt projektus', 'latvijai-futura' ),
		'all_items'             => __( 'Visi projekti', 'latvijai-futura' ),
		'search_items'          => __( 'Meklēt projektus', 'latvijai-futura' ),
		'not_found'             => __( 'Projekti nav atrasti.', 'latvijai-futura' ),
		'not_found_in_trash'    => __( 'Miskastē projektu nav.', 'latvijai-futura' ),
		'featured_image'        => __( 'Projekta attēls', 'latvijai-futura' ),
		'set_featured_image'    => __( 'Iestatīt projekta attēlu', 'latvijai-futura' ),
		'remove_featured_image' => __( 'Noņemt projekta attēlu', 'latvijai-futura' ),
		'use_featured_image'    => __( 'Izmantot kā projekta attēlu', 'latvijai-futura' ),
		'archives'              => __( 'Projektu arhīvs', 'latvijai-futura' ),
		'attributes'            => __( 'Projekta atribūti', 'latvijai-futura' ),
		'insert_into_item'      => __( 'Ievietot projektā', 'latvijai-futura' ),
		'uploaded_to_this_item' => __( 'Augšupielādēts šim projektam', 'latvijai-futura' ),
		'items_list'            => __( 'Projektu saraksts', 'latvijai-futura' ),
		'items_list_navigation' => __( 'Projektu saraksta navigācija', 'latvijai-futura' ),
		'filter_items_list'     => __( 'Filtrēt projektus', 'latvijai-futura' ),
	);

	register_post_type(
		'projekts',
		array(
			'labels'             => $labels,
			'public'             => true,
			'show_in_rest'       => true,
			'has_archive'        => 'projekti',
			'rewrite'            => array(
				'slug'       => 'projekti',
				'with_front' => false,
			),
			'menu_icon'          => 'dashicons-lightbulb',
			'menu_position'      => 20,
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'taxonomies'         => array( 'joma' ),
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'delete_with_user'   => false,
		)
	);

	register_taxonomy(
		'joma',
		array( 'projekts' ),
		array(
			'labels'            => array(
				'name'              => __( 'Jomas', 'latvijai-futura' ),
				'singular_name'     => __( 'Joma', 'latvijai-futura' ),
				'search_items'      => __( 'Meklēt jomas', 'latvijai-futura' ),
				'all_items'         => __( 'Visas jomas', 'latvijai-futura' ),
				'parent_item'       => __( 'Virsjoma', 'latvijai-futura' ),
				'parent_item_colon' => __( 'Virsjoma:', 'latvijai-futura' ),
				'edit_item'         => __( 'Labot jomu', 'latvijai-futura' ),
				'update_item'       => __( 'Atjaunināt jomu', 'latvijai-futura' ),
				'add_new_item'      => __( 'Pievienot jomu', 'latvijai-futura' ),
				'new_item_name'     => __( 'Jaunas jomas nosaukums', 'latvijai-futura' ),
				'menu_name'         => __( 'Jomas', 'latvijai-futura' ),
			),
			'public'            => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'rewrite'           => array(
				'slug'         => 'joma',
				'with_front'   => false,
				'hierarchical' => true,
			),
		)
	);
}
add_action( 'init', 'latvijai_register_project_cpt' );

/**
 * Flush rewrite rules when the theme is activated.
 */
function latvijai_flush_rewrites() {
	latvijai_register_project_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'latvijai_flush_rewrites' );

/**
 * Add the project details meta box.
 */
function latvijai_add_project_meta_box() {
	add_meta_box(
		'latvijai-project-details',
		__( 'Projekta detaļas', 'latvijai-futura' ),
		'latvijai_project_meta_box_html',
		'projekts',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'latvijai_add_project_meta_box' );

/**
 * Render the project details meta box.
 *
 * @param WP_Post $post Current post.
 */
function latvijai_project_meta_box_html( $post ) {
	wp_nonce_field( 'latvijai_save_project_meta', 'latvijai_project_nonce' );

	$status = get_post_meta( $post->ID, '_latvijai_project_status', true );
	if ( '' === $status ) {
		$status = 'aktivs';
	}

	$location = get_post_meta( $post->ID, '_latvijai_project_location', true );
	$progress = get_post_meta( $post->ID, '_latvijai_project_progress', true );
	$url      = get_post_meta( $post->ID, '_latvijai_project_url', true );
	?>
	<p>
		<label for="latvijai_project_status"><strong><?php esc_html_e( 'Statuss', 'latvijai-futura' ); ?></strong></label>
		<select id="latvijai_project_status" name="latvijai_project_status" style="width:100%;margin-top:6px;">
			<option value="ideja" <?php selected( $status, 'ideja' ); ?>><?php esc_html_e( 'Ideja', 'latvijai-futura' ); ?></option>
			<option value="izstrade" <?php selected( $status, 'izstrade' ); ?>><?php esc_html_e( 'Izstrādē', 'latvijai-futura' ); ?></option>
			<option value="aktivs" <?php selected( $status, 'aktivs' ); ?>><?php esc_html_e( 'Aktīvs', 'latvijai-futura' ); ?></option>
			<option value="pabeigts" <?php selected( $status, 'pabeigts' ); ?>><?php esc_html_e( 'Pabeigts', 'latvijai-futura' ); ?></option>
		</select>
	</p>

	<p>
		<label for="latvijai_project_location"><strong><?php esc_html_e( 'Norises vieta', 'latvijai-futura' ); ?></strong></label>
		<input type="text" id="latvijai_project_location" name="latvijai_project_location" value="<?php echo esc_attr( $location ); ?>" placeholder="<?php esc_attr_e( 'Rīga, Latvija', 'latvijai-futura' ); ?>" style="width:100%;margin-top:6px;" />
	</p>

	<p>
		<label for="latvijai_project_progress"><strong><?php esc_html_e( 'Progress (%)', 'latvijai-futura' ); ?></strong></label>
		<input type="number" id="latvijai_project_progress" name="latvijai_project_progress" value="<?php echo esc_attr( $progress ); ?>" min="0" max="100" step="1" style="width:100%;margin-top:6px;" />
	</p>

	<p>
		<label for="latvijai_project_url"><strong><?php esc_html_e( 'Projekta saite', 'latvijai-futura' ); ?></strong></label>
		<input type="url" id="latvijai_project_url" name="latvijai_project_url" value="<?php echo esc_url( $url ); ?>" placeholder="https://" style="width:100%;margin-top:6px;" />
		<span class="description"><?php esc_html_e( 'Neobligāta ārēja saite, piemēram, projekta mājaslapa.', 'latvijai-futura' ); ?></span>
	</p>
	<?php
}

/**
 * Save project metadata.
 *
 * @param int $post_id Post ID.
 */
function latvijai_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['latvijai_project_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['latvijai_project_nonce'] ) );
	if ( ! wp_verify_nonce( $nonce, 'latvijai_save_project_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$allowed_statuses = array( 'ideja', 'izstrade', 'aktivs', 'pabeigts' );
	$status           = isset( $_POST['latvijai_project_status'] ) ? sanitize_key( wp_unslash( $_POST['latvijai_project_status'] ) ) : 'aktivs';
	if ( ! in_array( $status, $allowed_statuses, true ) ) {
		$status = 'aktivs';
	}
	update_post_meta( $post_id, '_latvijai_project_status', $status );

	$location = isset( $_POST['latvijai_project_location'] ) ? sanitize_text_field( wp_unslash( $_POST['latvijai_project_location'] ) ) : '';
	update_post_meta( $post_id, '_latvijai_project_location', $location );

	$progress = isset( $_POST['latvijai_project_progress'] ) ? absint( wp_unslash( $_POST['latvijai_project_progress'] ) ) : 0;
	update_post_meta( $post_id, '_latvijai_project_progress', min( 100, $progress ) );

	$url = isset( $_POST['latvijai_project_url'] ) ? esc_url_raw( wp_unslash( $_POST['latvijai_project_url'] ) ) : '';
	update_post_meta( $post_id, '_latvijai_project_url', $url );
}
add_action( 'save_post_projekts', 'latvijai_save_project_meta' );

/**
 * Add status and location columns to the projects list.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function latvijai_project_columns( $columns ) {
	$new = array();

	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( 'title' === $key ) {
			$new['project_status']   = __( 'Statuss', 'latvijai-futura' );
			$new['project_location'] = __( 'Vieta', 'latvijai-futura' );
		}
	}

	return $new;
}
add_filter( 'manage_projekts_posts_columns', 'latvijai_project_columns' );

/**
 * Render custom project columns.
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function latvijai_project_column_content( $column, $post_id ) {
	$meta = latvijai_project_meta( $post_id );

	if ( 'project_status' === $column ) {
		echo esc_html( $meta['status_label'] );
	}

	if ( 'project_location' === $column ) {
		echo esc_html( $meta['location'] );
	}
}
add_action( 'manage_projekts_posts_custom_column', 'latvijai_project_column_content', 10, 2 );
