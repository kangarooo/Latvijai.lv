<?php
/**
 * Template helpers and theme defaults.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default values for every customizer setting used by the theme.
 *
 * @return array<string, string>
 */
function latvijai_defaults() {
	static $defaults = null;

	if ( null === $defaults ) {
		$defaults = array(
			'hero_eyebrow'        => 'Sabiedriskie projekti · Latvija',
			'hero_title_1'        => 'Būvējam',
			'hero_title_2'        => 'Latviju',
			'hero_title_3'        => 'nākotnei',
			'hero_flag_colours'   => '1',
			'hero_text'           => 'Vieta idejām, projektiem un cilvēkiem, kas dara Latviju stiprāku. No pirmās idejas līdz reālai iedarbībai — kopā.',
			'hero_primary_label'  => 'Atklāt projektus',
			'hero_primary_url'    => '#projekti',
			'hero_secondary_label' => 'Pievienoties',
			'hero_secondary_url'  => '#pieteikties',
			'hero_status'         => 'Latvija aktīva — pieņemam jaunas idejas',
			'stat_1_number'       => '12',
			'stat_1_label'        => 'Aktīvi projekti',
			'stat_2_number'       => '48',
			'stat_2_label'        => 'Brīvprātīgie',
			'stat_3_number'       => '5',
			'stat_3_label'        => 'Novadi',
			'stat_4_number'       => '∞',
			'stat_4_label'        => 'Idejas',
			'spotlight_eyebrow'   => 'Fokuss / 03 · Valoda',
			'spotlight_title'     => 'Runā Latviski',
			'spotlight_text'      => 'Valoda ir mūsu kopīgais kods. “Runā Latviski” aicina ikvienu — jaunu un vecu, vietējo un atbraukušo — sarunāties latviski ikdienā, bez bailēm kļūdīties.',
			'spotlight_label'     => 'Iepazīt projektu',
			'spotlight_url'       => 'https://runalatviski.latvijai.lv/',
			'cta_eyebrow'         => 'Pieteikties / 05 · Latvijai',
			'cta_title'           => 'Tev ir ideja?',
			'cta_title_2'         => 'Mums ir platforma.',
			'cta_text'            => 'Pastāsti par savu projektu, iniciatīvu vai vienkārši labu domu Latvijai. Mēs palīdzēsim atrast cilvēkus, resursus un ceļu līdz īstenošanai.',
			'cta_primary_label'   => 'Sākt projektu',
			'cta_primary_url'     => 'mailto:info@latvijai.lv',
			'cta_secondary_label' => 'Ziedo',
			'cta_secondary_url'   => 'https://latvijai.lv/ziedo/',
			'cta_meta'            => 'Visa Latvija · visi novadi · visas idejas',
			'footer_text'         => 'Sabiedrisko projektu platforma, kas savieno idejas, cilvēkus un vietas. Būvējam Latviju, kurā gribas dzīvot.',
			'contact_email'       => 'info@latvijai.lv',
			'contact_location'    => 'Rīga, Latvija',
			'contact_coords'      => '56.9496° N / 24.1052° E',
			'donate_url'          => 'https://latvijai.lv/ziedo/',
			'social_facebook'     => 'https://www.facebook.com/LatvijaiLV/',
			'social_instagram'    => 'https://www.instagram.com/latvijailv',
			'social_linkedin'     => 'https://www.linkedin.com/company/latvijailv/',
			'social_youtube'      => '',
			'preloader_enabled'    => '1',
			'preloader_image'      => '',
			'preloader_bg_color'   => '#0a0a11',
			'preloader_bg_color_2' => '#12050a',
			'preloader_duration'   => '800',
			'header_flag_enabled'  => '1',
			'header_flag_height'   => '20',
			'color_scheme'         => 'dark',
			'theme_toggle_enabled' => '1',
		);
	}

	return $defaults;
}

/**
 * Get a single default value.
 *
 * @param string $key Setting key.
 * @return string
 */
function latvijai_default( $key ) {
	$defaults = latvijai_defaults();

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Get a theme mod with a sane default.
 *
 * @param string $key Setting key.
 * @return string
 */
function latvijai_get( $key ) {
	return (string) get_theme_mod( $key, latvijai_default( $key ) );
}

/**
 * Render the site brand: custom logo when available, stylised fallback otherwise.
 */
function latvijai_brand() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	$name = esc_html( get_bloginfo( 'name' ) );
	$name = preg_replace( '/\.lv$/i', '<span class="brand-dot">.</span>lv', $name );
	$tag  = get_bloginfo( 'description' );
	if ( '' === $tag ) {
		$tag = __( 'Sabiedriskie projekti', 'latvijai-futura' );
	}
	?>
	<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<?php echo latvijai_mark(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Internal SVG. ?>
		<span class="brand-copy">
			<span class="brand-name"><?php echo wp_kses( $name, array( 'span' => array( 'class' => array() ) ) ); ?></span>
			<span class="brand-tag"><?php echo esc_html( $tag ); ?></span>
		</span>
	</a>
	<?php
}

/**
 * Fallback primary menu used before a menu is assigned.
 *
 * @param array $args wp_nav_menu arguments.
 */
function latvijai_menu_fallback( $args = array() ) {
	$menu_id    = ! empty( $args['menu_id'] ) ? $args['menu_id'] : 'primary-menu';
	$menu_class = ! empty( $args['menu_class'] ) ? $args['menu_class'] : 'menu';

	$projects_url = get_post_type_archive_link( 'projekts' );
	if ( ! $projects_url ) {
		$projects_url = home_url( '/#projekti' );
	}

	$journal_url = get_permalink( (int) get_option( 'page_for_posts' ) );
	if ( ! $journal_url ) {
		$journal_url = home_url( '/#zurnals' );
	}

	$about_page = get_page_by_path( 'par-mums' );
	$about_url  = $about_page ? get_permalink( $about_page ) : home_url( '/#misija' );

	$items = array(
		'home'     => array(
			'label'   => __( 'Sākumlapa', 'latvijai-futura' ),
			'url'     => home_url( '/' ),
			'current' => is_front_page(),
		),
		'regions'  => array(
			'label'   => __( 'Novadi', 'latvijai-futura' ),
			'url'     => home_url( '/#latvija' ),
			'current' => false,
		),
		'projects' => array(
			'label'   => __( 'Projekti', 'latvijai-futura' ),
			'url'     => $projects_url,
			'current' => is_post_type_archive( 'projekts' ) || is_tax( 'joma' ) || is_singular( 'projekts' ),
		),
		'journal'  => array(
			'label'   => __( 'Žurnāls', 'latvijai-futura' ),
			'url'     => $journal_url,
			'current' => is_home() || is_singular( 'post' ) || is_category() || is_tag(),
		),
		'about'    => array(
			'label'   => __( 'Par mums', 'latvijai-futura' ),
			'url'     => $about_url,
			'current' => is_page( 'par-mums' ),
		),
	);

	echo '<ul id="' . esc_attr( $menu_id ) . '" class="' . esc_attr( $menu_class ) . '">';
	foreach ( $items as $item ) {
		printf(
			'<li class="menu-item%1$s"><a href="%2$s">%3$s</a></li>',
			$item['current'] ? ' current-menu-item' : '',
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}

/**
 * Output social network links from the customizer.
 *
 * @param string $link_class Extra class for each link.
 */
function latvijai_social_links( $link_class = 'social-link' ) {
	$networks = array(
		'social_facebook'  => array(
			'label' => 'Facebook',
			'icon'  => 'facebook',
		),
		'social_instagram' => array(
			'label' => 'Instagram',
			'icon'  => 'instagram',
		),
		'social_linkedin'  => array(
			'label' => 'LinkedIn',
			'icon'  => 'linkedin',
		),
		'social_youtube'   => array(
			'label' => 'YouTube',
			'icon'  => 'youtube',
		),
	);

	foreach ( $networks as $key => $network ) {
		$url = latvijai_get( $key );
		if ( '' === $url ) {
			continue;
		}

		printf(
			'<a class="%1$s" href="%2$s" target="_blank" rel="noopener noreferrer" aria-label="%3$s">%4$s</a>',
			esc_attr( $link_class ),
			esc_url( $url ),
			esc_attr( $network['label'] ),
			latvijai_icon( $network['icon'] ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Internal SVG.
		);
	}
}

/**
 * Estimated reading time for the current post.
 *
 * @param int $post_id Optional post ID.
 * @return string
 */
function latvijai_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$content = wp_strip_all_tags( (string) $content );
	$words   = preg_split( '/\s+/u', trim( $content ), -1, PREG_SPLIT_NO_EMPTY );
	$count   = is_array( $words ) ? count( $words ) : 0;
	$minutes = max( 1, (int) ceil( $count / 200 ) );

	return sprintf(
		/* translators: %s: number of minutes. */
		_n( '%s min lasīt', '%s min lasīt', $minutes, 'latvijai-futura' ),
		number_format_i18n( $minutes )
	);
}

/**
 * Project metadata with safe fallbacks.
 *
 * @param int $post_id Optional post ID.
 * @return array<string, mixed>
 */
function latvijai_project_meta( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	$status_map = array(
		'ideja'    => array(
			'label' => __( 'Ideja', 'latvijai-futura' ),
			'class' => 'idea',
		),
		'izstrade' => array(
			'label' => __( 'Izstrādē', 'latvijai-futura' ),
			'class' => 'progress',
		),
		'aktivs'   => array(
			'label' => __( 'Aktīvs', 'latvijai-futura' ),
			'class' => 'active',
		),
		'pabeigts' => array(
			'label' => __( 'Pabeigts', 'latvijai-futura' ),
			'class' => 'done',
		),
	);

	$status = get_post_meta( $post_id, '_latvijai_project_status', true );
	if ( ! isset( $status_map[ $status ] ) ) {
		$status = 'aktivs';
	}

	$progress = get_post_meta( $post_id, '_latvijai_project_progress', true );
	$progress = ( '' === $progress ) ? 0 : min( 100, absint( $progress ) );

	$location = get_post_meta( $post_id, '_latvijai_project_location', true );
	if ( '' === $location ) {
		$location = __( 'Latvija', 'latvijai-futura' );
	}

	return array(
		'status'       => $status,
		'status_label' => $status_map[ $status ]['label'],
		'status_class' => $status_map[ $status ]['class'],
		'location'     => $location,
		'progress'     => $progress,
		'url'          => get_post_meta( $post_id, '_latvijai_project_url', true ),
	);
}

/**
 * Human readable project field (taxonomy term).
 *
 * @param int $post_id Optional post ID.
 * @return string
 */
function latvijai_project_field( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$terms   = get_the_terms( $post_id, 'joma' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return __( 'Sabiedrība', 'latvijai-futura' );
	}

	$names = wp_list_pluck( $terms, 'name' );

	return implode( ', ', $names );
}

/**
 * Archive title without WordPress' "Category:" prefixes.
 *
 * @return string
 */
function latvijai_archive_title() {
	if ( is_category() ) {
		return single_cat_title( '', false );
	}

	if ( is_tag() ) {
		return single_tag_title( '', false );
	}

	if ( is_tax() ) {
		return single_term_title( '', false );
	}

	if ( is_author() ) {
		return get_the_author();
	}

	if ( is_date() ) {
		return get_the_date();
	}

	if ( is_post_type_archive() ) {
		return post_type_archive_title( '', false );
	}

	if ( is_home() ) {
		$page_for_posts = (int) get_option( 'page_for_posts' );
		return $page_for_posts ? get_the_title( $page_for_posts ) : __( 'Žurnāls', 'latvijai-futura' );
	}

	return __( 'Arhīvs', 'latvijai-futura' );
}

/**
 * Archive description when available.
 *
 * @return string
 */
function latvijai_archive_description() {
	if ( is_category() || is_tag() || is_tax() ) {
		return term_description();
	}

	if ( is_author() ) {
		return (string) get_the_author_meta( 'description' );
	}

	if ( is_post_type_archive( 'projekts' ) ) {
		return __( 'Idejas, iniciatīvas un darbi, kas jau maina Latviju. Atver projektu, uzzini vairāk un pievienojies.', 'latvijai-futura' );
	}

	return '';
}

/**
 * Entry meta line for single posts.
 */
function latvijai_entry_meta() {
	$categories = get_the_category();

	echo '<div class="entry-meta">';

	if ( ! empty( $categories ) ) {
		printf(
			'<a href="%1$s">%2$s</a><span class="meta-sep" aria-hidden="true"></span>',
			esc_url( get_category_link( $categories[0]->term_id ) ),
			esc_html( $categories[0]->name )
		);
	}

	printf(
		'<span>%1$s</span><span class="meta-sep" aria-hidden="true"></span><span>%2$s</span><span class="meta-sep" aria-hidden="true"></span><span>%3$s</span>',
		esc_html( get_the_date() ),
		esc_html( latvijai_reading_time() ),
		esc_html( get_the_author() )
	);

	echo '</div>';
}

/**
 * Share buttons for the current post.
 */
function latvijai_share_links() {
	$url   = rawurlencode( get_permalink() );
	$title = rawurlencode( get_the_title() );

	$links = array(
		array(
			'label' => 'Facebook',
			'icon'  => 'facebook',
			'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
		),
		array(
			'label' => 'X',
			'icon'  => 'x',
			'url'   => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
		),
		array(
			'label' => 'LinkedIn',
			'icon'  => 'linkedin',
			'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url,
		),
		array(
			'label' => __( 'E-pasts', 'latvijai-futura' ),
			'icon'  => 'mail',
			'url'   => 'mailto:?subject=' . $title . '&body=' . $url,
		),
	);

	echo '<div class="share-row">';
	echo '<span class="share-label">' . esc_html__( 'Dalīties', 'latvijai-futura' ) . '</span>';

	foreach ( $links as $link ) {
		printf(
			'<a class="share-btn" href="%1$s" target="_blank" rel="noopener noreferrer">%2$s<span>%3$s</span></a>',
			esc_url( $link['url'] ),
			latvijai_icon( $link['icon'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Internal SVG.
			esc_html( $link['label'] )
		);
	}

	printf(
		'<button class="share-btn" type="button" data-copy-url="%1$s" data-copied-label="%2$s">%3$s<span>%4$s</span></button>',
		esc_url( get_permalink() ),
		esc_attr__( 'Nokopēts', 'latvijai-futura' ),
		latvijai_icon( 'copy' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Internal SVG.
		esc_html__( 'Kopēt saiti', 'latvijai-futura' )
	);

	echo '</div>';
}

/**
 * Themed pagination.
 */
function latvijai_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => latvijai_icon( 'chevron-left' ) . '<span class="screen-reader-text">' . esc_html__( 'Iepriekšējā lapa', 'latvijai-futura' ) . '</span>',
			'next_text'          => latvijai_icon( 'chevron-right' ) . '<span class="screen-reader-text">' . esc_html__( 'Nākamā lapa', 'latvijai-futura' ) . '</span>',
			'screen_reader_text' => __( 'Lapu navigācija', 'latvijai-futura' ),
			'aria_label'         => __( 'Ierakstu lapas', 'latvijai-futura' ),
		)
	);
}

/**
 * Custom comment template.
 *
 * @param WP_Comment $comment Comment object.
 * @param array      $args    Comment arguments.
 * @param int        $depth   Depth.
 */
function latvijai_comment( $comment, $args, $depth ) {
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-item' ); ?>>
		<article class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 48 ); ?>
					<span class="fn"><?php comment_author_link(); ?></span>
				</div>
				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>"><?php comment_time( get_option( 'date_format' ) . ', H:i' ); ?></time>
					</a>
				</div>
			</footer>

			<?php if ( '0' === $comment->comment_approved ) : ?>
				<p class="comment-awaiting"><?php esc_html_e( 'Tavs komentārs gaida apstiprinājumu.', 'latvijai-futura' ); ?></p>
			<?php endif; ?>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

			<div class="comment-actions">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'reply_text' => __( 'Atbildēt', 'latvijai-futura' ),
						)
					)
				);
				edit_comment_link( __( 'Labot', 'latvijai-futura' ) );
				?>
			</div>
		</article>
	<?php
}

/**
 * Latvian national flag strip shown at the very top of the header.
 *
 * Proportions follow the Latvian flag law: carmine – white – carmine
 * stripes in a 2 : 1 : 2 ratio. Colour is Pantone 201 C (#9D2235).
 */
function latvijai_header_flag() {
	if ( ! latvijai_get( 'header_flag_enabled' ) ) {
		return;
	}
	?>
	<div id="header_flag" role="img" aria-label="<?php esc_attr_e( 'Latvijas valsts karogs', 'latvijai-futura' ); ?>">
		<span class="header_flag_1"></span>
		<span class="header_flag_0"></span>
		<span class="header_flag_1"></span>
	</div>
	<?php
}

/**
 * Site colour scheme chosen in the Customizer: dark, light or auto.
 *
 * @return string
 */
function latvijai_color_scheme() {
	return latvijai_sanitize_color_scheme( latvijai_get( 'color_scheme' ) );
}

/**
 * Light / dark switch button for the header.
 */
function latvijai_theme_toggle() {
	if ( ! latvijai_get( 'theme_toggle_enabled' ) ) {
		return;
	}
	?>
	<button class="icon-btn theme-toggle" type="button" data-theme-toggle aria-pressed="false" aria-label="<?php esc_attr_e( 'Pārslēgt gaišo / tumšo režīmu', 'latvijai-futura' ); ?>" title="<?php esc_attr_e( 'Gaišais / tumšais režīms', 'latvijai-futura' ); ?>">
		<?php latvijai_icon_e( 'sun', 'icon-sun' ); ?>
		<?php latvijai_icon_e( 'moon', 'icon-moon' ); ?>
	</button>
	<?php
}

/**
 * Latviešu spēka zīme kā SVG (kartīšu attēla vietā, ja nav fotogrāfijas).
 *
 * Zīmes: auseklis, saule, jumis, mara (Māras līkloči). Zīmētas ar līnijām,
 * krāsa no currentColor.
 *
 * @param string $name Zīmes nosaukums.
 * @return string SVG marķējums.
 */
function latvijai_sign_svg( $name ) {
	$paths = array(
		// Auseklis: divi pārklāti kvadrāti (astoņstaru zvaigzne) ar iekšējo kvadrātu.
		'auseklis' => '<path d="M30 30h60v60H30z"/><path d="M60 17.6 102.4 60 60 102.4 17.6 60z"/><path d="M47 47h26v26H47z"/><path d="M60 47v26M47 60h26"/>',
		// Saule: aplis ar astoņiem stariem.
		'saule'    => '<circle cx="60" cy="60" r="22"/><circle cx="60" cy="60" r="7"/><path d="M60 8v18M60 94v18M8 60h18M94 60h18M23.2 23.2l12.7 12.7M84.1 84.1l12.7 12.7M23.2 96.8l12.7-12.7M84.1 35.9l12.7-12.7"/>',
		// Jumis: divas sakrustotas vārpas uz viena stiebra.
		'jumis'    => '<path d="M60 110V44"/><path d="M60 44 34 18M60 44l26-26"/><path d="M60 68 34 42M60 68l26-26"/><path d="M60 92 40 72M60 92l20-20"/>',
		// Māras līkloči: trīs zigzaga rindas.
		'mara'     => '<path d="M10 36l12.5-14L35 36l12.5-14L60 36l12.5-14L85 36l12.5-14L110 36"/><path d="M10 67l12.5-14L35 67l12.5-14L60 67l12.5-14L85 67l12.5-14L110 67"/><path d="M10 98l12.5-14L35 98l12.5-14L60 98l12.5-14L85 98l12.5-14L110 98"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		$name = 'auseklis';
	}

	return '<svg class="lv-sign lv-sign--' . esc_attr( $name ) . '" viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}
