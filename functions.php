<?php
/**
 * Latvijai Futura functions and definitions.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/icons.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/cpt-projects.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/front-sections.php';
require get_template_directory() . '/inc/elementor.php';
require get_template_directory() . '/inc/elementor-native.php';

/**
 * Theme setup.
 */
function latvijai_setup() {
	load_theme_textdomain( 'latvijai-futura', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 260,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	set_post_thumbnail_size( 1400, 900, true );
	add_image_size( 'latvijai-card', 760, 500, true );
	add_image_size( 'latvijai-wide', 1680, 940, true );

	register_nav_menus(
		array(
			'primary' => __( 'Galvenā navigācija', 'latvijai-futura' ),
			'footer'  => __( 'Kājenes navigācija', 'latvijai-futura' ),
		)
	);
}
add_action( 'after_setup_theme', 'latvijai_setup' );

/**
 * Set the content width.
 */
function latvijai_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'latvijai_content_width', 1240 );
}
add_action( 'after_setup_theme', 'latvijai_content_width', 0 );

/**
 * Enqueue fonts, styles and scripts.
 */
function latvijai_assets() {
	$version = wp_get_theme()->get( 'Version' );
	$deps    = array();

	$fonts_url = apply_filters(
		'latvijai_fonts_url',
		'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&family=Unbounded:wght@400;600;800&display=swap'
	);

	if ( $fonts_url && apply_filters( 'latvijai_enable_google_fonts', true ) ) {
		wp_enqueue_style( 'latvijai-fonts', $fonts_url, array(), null );
		$deps[] = 'latvijai-fonts';
	}

	wp_enqueue_style( 'latvijai-base', get_stylesheet_uri(), $deps, $version );
	wp_enqueue_style( 'latvijai-theme', get_template_directory_uri() . '/assets/css/theme.css', array( 'latvijai-base' ), $version );

	if ( latvijai_get( 'header_flag_enabled' ) ) {
		wp_add_inline_style(
			'latvijai-theme',
			sprintf( ':root{--flag-h:%dpx;}', latvijai_sanitize_flag_height( latvijai_get( 'header_flag_height' ) ) )
		);
	}

	wp_enqueue_script(
		'latvijai-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		$version,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'latvijai_assets' );

/**
 * Add preconnect hints for the Google Fonts host.
 *
 * @param array  $urls          Resource URLs.
 * @param string $relation_type Relation type.
 * @return array
 */
function latvijai_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type && apply_filters( 'latvijai_enable_google_fonts', true ) ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'latvijai_resource_hints', 10, 2 );

/**
 * Dark theme helpers in the document head.
 */
function latvijai_head_meta() {
	echo '<meta name="theme-color" content="#06060a" />' . "\n";

	if ( ! has_site_icon() ) {
		$favicon = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%2307070a'/%3E%3Cpath d='M32 8 56 32 32 56 8 32Z' fill='none' stroke='%23f4f1ea' stroke-width='2'/%3E%3Ccircle cx='32' cy='32' r='7' fill='%23e11d3f'/%3E%3C/svg%3E";
		echo '<link rel="icon" href="' . esc_attr( $favicon ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'latvijai_head_meta', 5 );

/**
 * Add a stable body class for styling hooks.
 *
 * @param array $classes Body classes.
 * @return array
 */
function latvijai_body_classes( $classes ) {
	$classes[] = 'latvijai-dark';

	if ( is_front_page() ) {
		$classes[] = 'is-front-page';
	}

	if ( is_singular() ) {
		$classes[] = 'is-singular';
	}

	if ( latvijai_get( 'header_flag_enabled' ) ) {
		$classes[] = 'has-header-flag';
	}

	return $classes;
}
add_filter( 'body_class', 'latvijai_body_classes' );

/**
 * Short, clean excerpts.
 *
 * @param int $length Default length.
 * @return int
 */
function latvijai_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'latvijai_excerpt_length' );

/**
 * Excerpt ellipsis.
 *
 * @return string
 */
function latvijai_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'latvijai_excerpt_more' );

/**
 * Add a pingback header on singular pages.
 */
function latvijai_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'latvijai_pingback_header' );
