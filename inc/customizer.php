<?php
/**
 * Customizer settings for the front page and contact details.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize checkbox value.
 *
 * @param mixed $value Input value.
 * @return int
 */
function latvijai_sanitize_checkbox( $value ) {
	return (int) ! empty( $value );
}

/**
 * Register theme customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function latvijai_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'latvijai_home',
		array(
			'title'       => __( 'Latvijai — sākumlapa', 'latvijai-futura' ),
			'description' => __( 'Sākumlapas teksts, statistika, fokusa projekts un kontakti.', 'latvijai-futura' ),
			'priority'    => 30,
		)
	);

	$sections = array(
		'latvijai_hero'      => __( 'Hero sadaļa', 'latvijai-futura' ),
		'latvijai_stats'     => __( 'Statistika', 'latvijai-futura' ),
		'latvijai_spotlight' => __( 'Fokusa projekts', 'latvijai-futura' ),
		'latvijai_cta'       => __( 'Aicinājums pievienoties', 'latvijai-futura' ),
		'latvijai_contact'   => __( 'Kontakti un sociālie tīkli', 'latvijai-futura' ),
	);

	$priority = 10;
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			$id,
			array(
				'title'    => $title,
				'panel'    => 'latvijai_home',
				'priority' => $priority,
			)
		);
		$priority += 10;
	}

	/**
	 * Helper to register a field with theme defaults.
	 *
	 * @param string $id          Setting ID.
	 * @param string $label       Control label.
	 * @param string $section     Section ID.
	 * @param string $type        Control type.
	 * @param string $sanitize    Sanitize callback.
	 * @param string $description Optional description.
	 */
	$add_field = function ( $id, $label, $section, $type = 'text', $sanitize = 'sanitize_text_field', $description = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => latvijai_default( $id ),
				'sanitize_callback' => $sanitize,
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'       => $label,
				'section'     => $section,
				'type'        => $type,
				'description' => $description,
			)
		);
	};

	/* Hero */
	$add_field( 'hero_eyebrow', __( 'Virsraksta uzraksts', 'latvijai-futura' ), 'latvijai_hero' );
	$add_field( 'hero_title_1', __( 'Virsraksts — 1. rinda', 'latvijai-futura' ), 'latvijai_hero' );
	$add_field( 'hero_title_2', __( 'Virsraksts — 2. rinda (kontūra)', 'latvijai-futura' ), 'latvijai_hero' );
	$add_field( 'hero_title_3', __( 'Virsraksts — 3. rinda', 'latvijai-futura' ), 'latvijai_hero' );
	$add_field( 'hero_text', __( 'Ievadteksts', 'latvijai-futura' ), 'latvijai_hero', 'textarea', 'sanitize_textarea_field' );
	$add_field( 'hero_primary_label', __( 'Primārās pogas teksts', 'latvijai-futura' ), 'latvijai_hero' );
	$add_field( 'hero_primary_url', __( 'Primārās pogas saite', 'latvijai-futura' ), 'latvijai_hero', 'url', 'esc_url_raw' );
	$add_field( 'hero_secondary_label', __( 'Sekundārās pogas teksts', 'latvijai-futura' ), 'latvijai_hero' );
	$add_field( 'hero_secondary_url', __( 'Sekundārās pogas saite', 'latvijai-futura' ), 'latvijai_hero', 'url', 'esc_url_raw' );
	$add_field( 'hero_status', __( 'Statusa teksts', 'latvijai-futura' ), 'latvijai_hero' );

	/* Stats */
	for ( $i = 1; $i <= 4; $i++ ) {
		$add_field(
			'stat_' . $i . '_number',
			/* translators: %d: stat number. */
			sprintf( __( 'Statistika %d — skaitlis', 'latvijai-futura' ), $i ),
			'latvijai_stats'
		);
		$add_field(
			'stat_' . $i . '_label',
			/* translators: %d: stat number. */
			sprintf( __( 'Statistika %d — apzīmējums', 'latvijai-futura' ), $i ),
			'latvijai_stats'
		);
	}

	/* Spotlight */
	$add_field( 'spotlight_eyebrow', __( 'Uzraksts', 'latvijai-futura' ), 'latvijai_spotlight' );
	$add_field( 'spotlight_title', __( 'Projekta nosaukums', 'latvijai-futura' ), 'latvijai_spotlight' );
	$add_field( 'spotlight_text', __( 'Apraksts', 'latvijai-futura' ), 'latvijai_spotlight', 'textarea', 'sanitize_textarea_field' );
	$add_field( 'spotlight_label', __( 'Pogas teksts', 'latvijai-futura' ), 'latvijai_spotlight' );
	$add_field( 'spotlight_url', __( 'Pogas saite', 'latvijai-futura' ), 'latvijai_spotlight', 'url', 'esc_url_raw' );

	/* CTA */
	$add_field( 'cta_eyebrow', __( 'Uzraksts', 'latvijai-futura' ), 'latvijai_cta' );
	$add_field( 'cta_title', __( 'Virsraksts — 1. rinda', 'latvijai-futura' ), 'latvijai_cta' );
	$add_field( 'cta_title_2', __( 'Virsraksts — 2. rinda (kontūra)', 'latvijai-futura' ), 'latvijai_cta' );
	$add_field( 'cta_text', __( 'Apraksts', 'latvijai-futura' ), 'latvijai_cta', 'textarea', 'sanitize_textarea_field' );
	$add_field( 'cta_primary_label', __( 'Primārās pogas teksts', 'latvijai-futura' ), 'latvijai_cta' );
	$add_field( 'cta_primary_url', __( 'Primārās pogas saite', 'latvijai-futura' ), 'latvijai_cta', 'url', 'esc_url_raw' );
	$add_field( 'cta_secondary_label', __( 'Sekundārās pogas teksts', 'latvijai-futura' ), 'latvijai_cta' );
	$add_field( 'cta_secondary_url', __( 'Sekundārās pogas saite', 'latvijai-futura' ), 'latvijai_cta', 'url', 'esc_url_raw' );
	$add_field( 'cta_meta', __( 'Apakšējais uzraksts', 'latvijai-futura' ), 'latvijai_cta' );

	/* Contact */
	$add_field( 'footer_text', __( 'Kājenes apraksts', 'latvijai-futura' ), 'latvijai_contact', 'textarea', 'sanitize_textarea_field' );
	$add_field( 'contact_email', __( 'E-pasts', 'latvijai-futura' ), 'latvijai_contact', 'email', 'sanitize_email' );
	$add_field( 'contact_location', __( 'Atrašanās vieta', 'latvijai-futura' ), 'latvijai_contact' );
	$add_field( 'contact_coords', __( 'Koordinātas', 'latvijai-futura' ), 'latvijai_contact' );
	$add_field( 'donate_url', __( 'Ziedošanas saite', 'latvijai-futura' ), 'latvijai_contact', 'url', 'esc_url_raw' );
	$add_field( 'social_facebook', __( 'Facebook URL', 'latvijai-futura' ), 'latvijai_contact', 'url', 'esc_url_raw' );
	$add_field( 'social_instagram', __( 'Instagram URL', 'latvijai-futura' ), 'latvijai_contact', 'url', 'esc_url_raw' );
	$add_field( 'social_linkedin', __( 'LinkedIn URL', 'latvijai-futura' ), 'latvijai_contact', 'url', 'esc_url_raw' );
	$add_field( 'social_youtube', __( 'YouTube URL', 'latvijai-futura' ), 'latvijai_contact', 'url', 'esc_url_raw' );

	/* Colour scheme */
	$wp_customize->add_section(
		'latvijai_color_scheme',
		array(
			'title'    => __( 'Krāsu režīms', 'latvijai-futura' ),
			'panel'    => 'latvijai_home',
			'priority' => 70,
		)
	);

	$wp_customize->add_setting(
		'color_scheme',
		array(
			'default'           => latvijai_default( 'color_scheme' ),
			'sanitize_callback' => 'latvijai_sanitize_color_scheme',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'color_scheme',
		array(
			'label'       => __( 'Noklusējuma krāsu režīms', 'latvijai-futura' ),
			'section'     => 'latvijai_color_scheme',
			'type'        => 'radio',
			'choices'     => array(
				'dark'  => __( 'Tumšs', 'latvijai-futura' ),
				'light' => __( 'Gaišs', 'latvijai-futura' ),
				'auto'  => __( 'Automātiski (pēc apmeklētāja ierīces iestatījuma)', 'latvijai-futura' ),
			),
		)
	);

	$add_field(
		'theme_toggle_enabled',
		__( 'Rādīt gaišā / tumšā režīma pārslēgu galvenē', 'latvijai-futura' ),
		'latvijai_color_scheme',
		'checkbox',
		'latvijai_sanitize_checkbox',
		__( 'Apmeklētāja izvēle tiek atcerēta viņa pārlūkā.', 'latvijai-futura' )
	);

	/* Latvian national flag above the header */
	$wp_customize->add_section(
		'latvijai_header_flag',
		array(
			'title'    => __( 'Latvijas karogs galvenē', 'latvijai-futura' ),
			'panel'    => 'latvijai_home',
			'priority' => 75,
		)
	);

	$add_field( 'header_flag_enabled', __( 'Rādīt Latvijas karogu virs galvenes', 'latvijai-futura' ), 'latvijai_header_flag', 'checkbox', 'latvijai_sanitize_checkbox' );
	$add_field(
		'header_flag_height',
		__( 'Karoga augstums (px)', 'latvijai-futura' ),
		'latvijai_header_flag',
		'number',
		'latvijai_sanitize_flag_height',
		__( 'No 4 līdz 60 px. Svītru attiecība vienmēr paliek 2 : 1 : 2.', 'latvijai-futura' )
	);

	/* Preloader */
	$wp_customize->add_section(
		'latvijai_preloader',
		array(
			'title'    => __( 'Prelādētājs', 'latvijai-futura' ),
			'panel'    => 'latvijai_home',
			'priority' => 80,
		)
	);

	$add_field( 'preloader_enabled', __( 'Ieslēgt prelādētāju', 'latvijai-futura' ), 'latvijai_preloader', 'checkbox', 'latvijai_sanitize_checkbox' );
	/*
	 * Image and colour fields need their dedicated control classes. A plain
	 * control with type "color" makes the customizer JS call wpColorPicker(),
	 * which is not enqueued for plain controls — the resulting JS error stops
	 * the whole customizer from initialising and hides every panel.
	 */
	$wp_customize->add_setting(
		'preloader_image',
		array(
			'default'           => latvijai_default( 'preloader_image' ),
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'preloader_image',
			array(
				'label'   => __( 'Prelādētāja attēls', 'latvijai-futura' ),
				'section' => 'latvijai_preloader',
			)
		)
	);

	$color_fields = array(
		'preloader_bg_color'   => __( 'Fona krāsa', 'latvijai-futura' ),
		'preloader_bg_color_2' => __( 'Fona otrā krāsa (gradientam)', 'latvijai-futura' ),
	);
	foreach ( $color_fields as $id => $label ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => latvijai_default( $id ),
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$id,
				array(
					'label'   => $label,
					'section' => 'latvijai_preloader',
				)
			)
		);
	}

	$add_field( 'preloader_duration', __( 'Minimālā rādīšanas laiks (ms)', 'latvijai-futura' ), 'latvijai_preloader', 'number', 'absint' );
}
add_action( 'customize_register', 'latvijai_customize_register' );

/**
 * Clamp the header flag height to a sensible range.
 *
 * @param mixed $value Raw value.
 * @return int
 */
function latvijai_sanitize_flag_height( $value ) {
	return max( 4, min( 60, absint( $value ) ) );
}

/**
 * Allow only the known colour schemes.
 *
 * @param mixed $value Raw value.
 * @return string
 */
function latvijai_sanitize_color_scheme( $value ) {
	return in_array( $value, array( 'dark', 'light', 'auto' ), true ) ? $value : 'dark';
}

