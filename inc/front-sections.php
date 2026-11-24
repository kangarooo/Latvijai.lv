<?php
/**
 * Sākumlapas sekciju lauki.
 *
 * Viena definīcija katrai sekcijai: no tās tiek veidotas Elementor vadīklas
 * (viss sekcijas saturs labojams Elementor lapā), un tā pati definīcija dod
 * noklusējuma vērtības klasiskajai sākumlapai bez Elementor.
 *
 * Lauka formāts: key => array(
 *   'type'    => text|textarea|switch|select|number|media|repeater,
 *   'label'   => redaktora nosaukums,
 *   'default' => noklusējums,
 *   'group'   => vadīklu grupa (Elementor panelī),
 *   'options' => (select) vērtība => nosaukums,
 *   'fields'  => (repeater) apakšlauki tādā pašā formātā,
 *   'title'   => (repeater) apakšlauks, ko rādīt saraksta rindā,
 * )
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sekcijas lauku definīcijas.
 *
 * @param string $section Sekcijas slug.
 * @return array
 */
function latvijai_section_fields( $section ) {
	static $cache = array();
	if ( isset( $cache[ $section ] ) ) {
		return $cache[ $section ];
	}

	$coords  = latvijai_get( 'contact_coords' );
	$content = __( 'Saturs', 'latvijai-futura' );
	$buttons = __( 'Pogas', 'latvijai-futura' );
	$details = __( 'Detaļas', 'latvijai-futura' );
	$fields  = array();

	switch ( $section ) {
		case 'hero':
			$topics = array( 'Kultūra', 'Tehnoloģijas', 'Daba', 'Izglītība', 'Sabiedrība', 'Valoda', 'Rīga', 'Kurzeme', 'Zemgale', 'Vidzeme', 'Latgale', 'Daugavpils', 'Liepāja', 'Jelgava', 'Valmiera', 'Rēzekne', 'Ventspils', 'Jūrmala', 'Cēsis', 'Nākotne' );

			$fields = array(
				'hero_eyebrow'         => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), latvijai_get( 'hero_eyebrow' ), $content ),
				'hero_title_1'         => array( 'text', __( 'Virsraksts — 1. rinda', 'latvijai-futura' ), latvijai_get( 'hero_title_1' ), $content ),
				'hero_title_2'         => array( 'text', __( 'Virsraksts — 2. rinda', 'latvijai-futura' ), latvijai_get( 'hero_title_2' ), $content ),
				'hero_title_3'         => array( 'text', __( 'Virsraksts — 3. rinda', 'latvijai-futura' ), latvijai_get( 'hero_title_3' ), $content ),
				'hero_flag_colours'    => array( 'switch', __( 'Virsraksts Latvijas karoga krāsās', 'latvijai-futura' ), latvijai_get( 'hero_flag_colours' ) ? 'yes' : '', $content ),
				'hero_text'            => array( 'textarea', __( 'Teksts', 'latvijai-futura' ), latvijai_get( 'hero_text' ), $content ),
				'hero_primary_label'   => array( 'text', __( 'Galvenā poga — teksts', 'latvijai-futura' ), latvijai_get( 'hero_primary_label' ), $buttons ),
				'hero_primary_url'     => array( 'text', __( 'Galvenā poga — saite', 'latvijai-futura' ), latvijai_get( 'hero_primary_url' ), $buttons ),
				'hero_secondary_label' => array( 'text', __( 'Otrā poga — teksts', 'latvijai-futura' ), latvijai_get( 'hero_secondary_label' ), $buttons ),
				'hero_secondary_url'   => array( 'text', __( 'Otrā poga — saite', 'latvijai-futura' ), latvijai_get( 'hero_secondary_url' ), $buttons ),
				'hero_status'          => array( 'text', __( 'Statusa rinda', 'latvijai-futura' ), latvijai_get( 'hero_status' ), $details ),
				'hero_coords'          => array( 'text', __( 'Koordinātas', 'latvijai-futura' ), $coords, $details ),
				'orb_monogram'         => array( 'text', __( 'Lodes monogramma', 'latvijai-futura' ), 'LV', $details ),
				'orb_chip_1'           => array( 'text', __( 'Lodes birka 1', 'latvijai-futura' ), __( 'Kultūra', 'latvijai-futura' ), $details ),
				'orb_chip_2'           => array( 'text', __( 'Lodes birka 2', 'latvijai-futura' ), __( 'Valoda', 'latvijai-futura' ), $details ),
				'orb_chip_3'           => array( 'text', __( 'Lodes birka 3', 'latvijai-futura' ), __( 'Daba', 'latvijai-futura' ), $details ),
				'orb_chip_4'           => array( 'text', __( 'Lodes birka 4', 'latvijai-futura' ), __( 'Novadi', 'latvijai-futura' ), $details ),
				'hero_readout'         => array( 'text', __( 'Vertikālais uzraksts', 'latvijai-futura' ), __( 'Latvijai.lv / Sabiedriskie projekti', 'latvijai-futura' ), $details ),
				'scroll_label'         => array( 'text', __( 'Ritināšanas norāde', 'latvijai-futura' ), __( 'Ritini', 'latvijai-futura' ), $details ),
				'ticker_enabled'       => array( 'switch', __( 'Rādīt slīdošo tēmu joslu', 'latvijai-futura' ), 'yes', __( 'Tēmu josla', 'latvijai-futura' ) ),
				'ticker_topics'        => array( 'textarea', __( 'Tēmas (katra savā rindā)', 'latvijai-futura' ), implode( "\n", $topics ), __( 'Tēmu josla', 'latvijai-futura' ) ),
			);
			break;

		case 'mission':
			$stats = array();
			for ( $i = 1; $i <= 4; $i++ ) {
				$stats[] = array(
					'number' => latvijai_get( 'stat_' . $i . '_number' ),
					'label'  => latvijai_get( 'stat_' . $i . '_label' ),
				);
			}

			$fields = array(
				'eyebrow_index' => array( 'text', __( 'Numurs', 'latvijai-futura' ), '01', $content ),
				'eyebrow'       => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), __( 'Misija', 'latvijai-futura' ), $content ),
				'title'         => array( 'text', __( 'Virsraksts', 'latvijai-futura' ), __( 'Latvija nav tikai vieta.', 'latvijai-futura' ), $content ),
				'title_accent'  => array( 'text', __( 'Virsraksts — izcelts', 'latvijai-futura' ), __( 'Tā ir mūsu kopīgais projekts.', 'latvijai-futura' ), $content ),
				'lead'          => array( 'textarea', __( 'Ievads', 'latvijai-futura' ), __( 'Mēs ticam, ka valsts nākotni veido nevis viena ideja, bet tūkstošiem mazu darbu, kas notiek blakus.', 'latvijai-futura' ), $content ),
				'text'          => array( 'textarea', __( 'Teksts', 'latvijai-futura' ), __( 'Latvijai.lv apkopo sabiedriskos projektus, savieno cilvēkus ar līdzdomātājiem un palīdz idejām pārvērsties darbos — no Rīgas līdz mazākajam novadam.', 'latvijai-futura' ), $content ),
				'link_label'    => array( 'text', __( 'Saites teksts', 'latvijai-futura' ), __( 'Skatīt, ko būvējam', 'latvijai-futura' ), $content ),
				'link_url'      => array( 'text', __( 'Saite', 'latvijai-futura' ), '#projekti', $content ),
				'stats'         => array(
					'repeater',
					__( 'Skaitļi', 'latvijai-futura' ),
					$stats,
					__( 'Skaitļi', 'latvijai-futura' ),
					'fields' => array(
						'number' => array( 'text', __( 'Skaitlis (cipari skaitās no nulles)', 'latvijai-futura' ), '' ),
						'label'  => array( 'text', __( 'Nosaukums', 'latvijai-futura' ), '' ),
					),
					'title'  => 'label',
				),
			);
			break;

		case 'latvia':
			$regions = array(
				array( 'name' => 'Rīga', 'places' => 'Galvaspilsēta' ),
				array( 'name' => 'Kurzeme', 'places' => 'Liepāja · Ventspils' ),
				array( 'name' => 'Zemgale', 'places' => 'Jelgava · Bauska' ),
				array( 'name' => 'Vidzeme', 'places' => 'Valmiera · Cēsis' ),
				array( 'name' => 'Latgale', 'places' => 'Daugavpils · Rēzekne' ),
			);

			$fields = array(
				'eyebrow_index' => array( 'text', __( 'Numurs', 'latvijai-futura' ), 'LV', $content ),
				'eyebrow'       => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), __( 'Latvija / 5 novadi', 'latvijai-futura' ), $content ),
				'title'         => array( 'text', __( 'Virsraksts', 'latvijai-futura' ), __( 'Viena Latvija.', 'latvijai-futura' ), $content ),
				'title_outline' => array( 'text', __( 'Virsraksts — kontūra', 'latvijai-futura' ), __( 'Pieci novadi.', 'latvijai-futura' ), $content ),
				'text'          => array( 'textarea', __( 'Teksts', 'latvijai-futura' ), __( 'No Rīgas līdz Latgalei, no Kurzemes līdz Vidzemei. Mēs savienojam cilvēkus, kas savu novadu pārvērš par vietu, kur gribas palikt.', 'latvijai-futura' ), $content ),
				'meta'          => array( 'text', __( 'Fakti', 'latvijai-futura' ), __( '5 novadi · 64 589 km²', 'latvijai-futura' ), $content ),
				'coords'        => array( 'text', __( 'Koordinātas', 'latvijai-futura' ), $coords, $content ),
				'link_label'    => array( 'text', __( 'Saites teksts', 'latvijai-futura' ), __( 'Skatīt projektus', 'latvijai-futura' ), $content ),
				'link_url'      => array( 'text', __( 'Saite', 'latvijai-futura' ), '#projekti', $content ),
				'regions'       => array(
					'repeater',
					__( 'Novadi', 'latvijai-futura' ),
					$regions,
					__( 'Novadi', 'latvijai-futura' ),
					'fields' => array(
						'name'   => array( 'text', __( 'Nosaukums', 'latvijai-futura' ), '' ),
						'places' => array( 'text', __( 'Vietas', 'latvijai-futura' ), '' ),
					),
					'title'  => 'name',
				),
			);
			break;

		case 'projects':
			$projects_url = get_post_type_archive_link( 'projekts' );
			$cards        = array(
				array(
					'title'        => 'Runā Latviski',
					'field'        => 'Valoda',
					'status'       => 'Aktīvs',
					'status_class' => 'active',
					'location'     => 'Visa Latvija',
					'excerpt'      => 'Ikdienas sarunas latviski — bez bailēm kļūdīties. Projekts, kas valodu atgriež ielās, kafejnīcās un mājās.',
					'url'          => 'https://runalatviski.latvijai.lv/',
					'glyph'        => 'R',
					'tone'         => 'ember',
				),
				array(
					'title'        => 'Nākotnes darbnīcas',
					'field'        => 'Izglītība',
					'status'       => 'Izstrādē',
					'status_class' => 'progress',
					'location'     => 'Visa Latvija',
					'excerpt'      => 'Praktiskas darbnīcas jauniešiem par tehnoloģijām, uzņēmējdarbību un kopienu veidošanu.',
					'url'          => '#pieteikties',
					'glyph'        => 'N',
					'tone'         => 'ice',
				),
				array(
					'title'        => 'Zaļā infrastruktūra',
					'field'        => 'Vide',
					'status'       => 'Ideja',
					'status_class' => 'idea',
					'location'     => 'Latvija',
					'excerpt'      => 'Koku stādīšana, pilsētu zaļās zonas un ilgtspējīgi risinājumi katrai kopienai.',
					'url'          => '#pieteikties',
					'glyph'        => 'Z',
					'tone'         => 'violet',
				),
			);

			$fields = array(
				'eyebrow_index' => array( 'text', __( 'Numurs', 'latvijai-futura' ), '02', $content ),
				'eyebrow'       => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), __( 'Projekti', 'latvijai-futura' ), $content ),
				'title'         => array( 'text', __( 'Virsraksts', 'latvijai-futura' ), __( 'Idejas, kas jau', 'latvijai-futura' ), $content ),
				'title_outline' => array( 'text', __( 'Virsraksts — kontūra', 'latvijai-futura' ), __( 'strādā Latvijai.', 'latvijai-futura' ), $content ),
				'link_label'    => array( 'text', __( 'Saites teksts', 'latvijai-futura' ), __( 'Visi projekti', 'latvijai-futura' ), $content ),
				'link_url'      => array( 'text', __( 'Saite', 'latvijai-futura' ), $projects_url ? $projects_url : home_url( '/#projekti' ), $content ),
				'source'        => array(
					'select',
					__( 'Kartītes', 'latvijai-futura' ),
					'auto',
					__( 'Kartītes', 'latvijai-futura' ),
					'options' => array(
						'auto'   => __( 'Jaunākie projekti (ja nav — zemāk ievadītās)', 'latvijai-futura' ),
						'manual' => __( 'Tikai zemāk ievadītās kartītes', 'latvijai-futura' ),
					),
				),
				'count'         => array( 'number', __( 'Projektu skaits', 'latvijai-futura' ), 3, __( 'Kartītes', 'latvijai-futura' ) ),
				'cards'         => array(
					'repeater',
					__( 'Ievadītās kartītes', 'latvijai-futura' ),
					$cards,
					__( 'Kartītes', 'latvijai-futura' ),
					'fields' => array(
						'title'        => array( 'text', __( 'Nosaukums', 'latvijai-futura' ), '' ),
						'field'        => array( 'text', __( 'Joma', 'latvijai-futura' ), '' ),
						'status'       => array( 'text', __( 'Statuss', 'latvijai-futura' ), '' ),
						'status_class' => array(
							'select',
							__( 'Statusa krāsa', 'latvijai-futura' ),
							'active',
							'options' => array(
								'active'   => __( 'Aktīvs', 'latvijai-futura' ),
								'progress' => __( 'Izstrādē', 'latvijai-futura' ),
								'idea'     => __( 'Ideja', 'latvijai-futura' ),
								'done'     => __( 'Pabeigts', 'latvijai-futura' ),
							),
						),
						'location'     => array( 'text', __( 'Vieta', 'latvijai-futura' ), '' ),
						'excerpt'      => array( 'textarea', __( 'Apraksts', 'latvijai-futura' ), '' ),
						'url'          => array( 'text', __( 'Saite', 'latvijai-futura' ), '' ),
						'image'        => array( 'media', __( 'Attēls (nav obligāts)', 'latvijai-futura' ), '' ),
						'glyph'        => array( 'text', __( 'Burts (ja nav attēla)', 'latvijai-futura' ), '' ),
						'tone'         => array(
							'select',
							__( 'Fona tonis', 'latvijai-futura' ),
							'ember',
							'options' => array(
								'ember'  => __( 'Sarkans', 'latvijai-futura' ),
								'ice'    => __( 'Zils', 'latvijai-futura' ),
								'violet' => __( 'Violets', 'latvijai-futura' ),
							),
						),
					),
					'title'  => 'title',
				),
				'note'          => array( 'text', __( 'Piezīme, ja rādīti paraugi', 'latvijai-futura' ), __( 'Rādīti parauga projekti. Pievieno savus projektus WordPress administrācijā.', 'latvijai-futura' ), __( 'Kartītes', 'latvijai-futura' ) ),
			);
			break;

		case 'spotlight':
			$fields = array(
				'spotlight_eyebrow' => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), latvijai_get( 'spotlight_eyebrow' ), $content ),
				'spotlight_title'   => array( 'text', __( 'Virsraksts (pēdējais vārds — kontūrā)', 'latvijai-futura' ), latvijai_get( 'spotlight_title' ), $content ),
				'spotlight_text'    => array( 'textarea', __( 'Teksts', 'latvijai-futura' ), latvijai_get( 'spotlight_text' ), $content ),
				'spotlight_label'   => array( 'text', __( 'Pogas teksts', 'latvijai-futura' ), latvijai_get( 'spotlight_label' ), $content ),
				'spotlight_url'     => array( 'text', __( 'Pogas saite', 'latvijai-futura' ), latvijai_get( 'spotlight_url' ), $content ),
				'alphabet_label'    => array( 'text', __( 'Alfabēta uzraksts', 'latvijai-futura' ), __( 'Latviešu valoda', 'latvijai-futura' ), $details ),
				'alphabet'          => array( 'text', __( 'Burti', 'latvijai-futura' ), 'ĀČĒĢĪĶĻŅŠŪŽ', $details ),
				'glyph'             => array( 'text', __( 'Lielais burts', 'latvijai-futura' ), 'Ā', $details ),
				'coords'            => array( 'text', __( 'Koordinātas', 'latvijai-futura' ), $coords, $details ),
			);
			break;

		case 'journal':
			$journal_url = get_permalink( (int) get_option( 'page_for_posts' ) );

			$fields = array(
				'eyebrow_index' => array( 'text', __( 'Numurs', 'latvijai-futura' ), '04', $content ),
				'eyebrow'       => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), __( 'Žurnāls', 'latvijai-futura' ), $content ),
				'title'         => array( 'text', __( 'Virsraksts', 'latvijai-futura' ), __( 'Stāsti no', 'latvijai-futura' ), $content ),
				'title_outline' => array( 'text', __( 'Virsraksts — kontūra', 'latvijai-futura' ), __( 'Latvijas nākotnes.', 'latvijai-futura' ), $content ),
				'link_label'    => array( 'text', __( 'Saites teksts', 'latvijai-futura' ), __( 'Visi ieraksti', 'latvijai-futura' ), $content ),
				'link_url'      => array( 'text', __( 'Saite', 'latvijai-futura' ), $journal_url ? $journal_url : home_url( '/#zurnals' ), $content ),
				'count'         => array( 'number', __( 'Ierakstu skaits', 'latvijai-futura' ), 3, $content ),
				'empty_eyebrow' => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), __( 'Tukšs signāls', 'latvijai-futura' ), __( 'Ja vēl nav ierakstu', 'latvijai-futura' ) ),
				'empty_title'   => array( 'text', __( 'Virsraksts', 'latvijai-futura' ), __( 'Pirmie stāsti jau ceļā.', 'latvijai-futura' ), __( 'Ja vēl nav ierakstu', 'latvijai-futura' ) ),
				'empty_text'    => array( 'textarea', __( 'Teksts', 'latvijai-futura' ), __( 'Žurnāls tiks atvērts pavisam drīz. Tikmēr pievienojies kustībai vai ieskaties projektos.', 'latvijai-futura' ), __( 'Ja vēl nav ierakstu', 'latvijai-futura' ) ),
			);
			break;

		case 'cta':
			$fields = array(
				'cta_eyebrow'         => array( 'text', __( 'Virsrinda', 'latvijai-futura' ), latvijai_get( 'cta_eyebrow' ), $content ),
				'cta_title'           => array( 'text', __( 'Virsraksts', 'latvijai-futura' ), latvijai_get( 'cta_title' ), $content ),
				'cta_title_2'         => array( 'text', __( 'Virsraksts — kontūra', 'latvijai-futura' ), latvijai_get( 'cta_title_2' ), $content ),
				'cta_text'            => array( 'textarea', __( 'Teksts', 'latvijai-futura' ), latvijai_get( 'cta_text' ), $content ),
				'cta_meta'            => array( 'text', __( 'Apakšrinda', 'latvijai-futura' ), latvijai_get( 'cta_meta' ), $content ),
				'cta_primary_label'   => array( 'text', __( 'Galvenā poga — teksts', 'latvijai-futura' ), latvijai_get( 'cta_primary_label' ), $buttons ),
				'cta_primary_url'     => array( 'text', __( 'Galvenā poga — saite', 'latvijai-futura' ), latvijai_get( 'cta_primary_url' ), $buttons ),
				'cta_secondary_label' => array( 'text', __( 'Otrā poga — teksts', 'latvijai-futura' ), latvijai_get( 'cta_secondary_label' ), $buttons ),
				'cta_secondary_url'   => array( 'text', __( 'Otrā poga — saite', 'latvijai-futura' ), latvijai_get( 'cta_secondary_url' ), $buttons ),
			);
			break;
	}

	$cache[ $section ] = latvijai_normalize_fields( $fields );
	return $cache[ $section ];
}

/**
 * Pārveido saīsināto lauku pierakstu ( [type, label, default, group, ...] ) par asociatīvu masīvu.
 *
 * @param array $fields Lauki.
 * @return array
 */
function latvijai_normalize_fields( $fields ) {
	$out = array();
	foreach ( $fields as $key => $field ) {
		$item = array(
			'type'    => $field[0],
			'label'   => $field[1],
			'default' => isset( $field[2] ) ? $field[2] : '',
			'group'   => isset( $field[3] ) ? $field[3] : '',
		);
		foreach ( array( 'options', 'title' ) as $extra ) {
			if ( isset( $field[ $extra ] ) ) {
				$item[ $extra ] = $field[ $extra ];
			}
		}
		if ( isset( $field['fields'] ) ) {
			$item['fields'] = latvijai_normalize_fields( $field['fields'] );
		}
		$out[ $key ] = $item;
	}
	return $out;
}

/**
 * Sekcijas vērtības: noklusējumi + Elementor iestatījumi (ja sekciju izvada logrīks).
 *
 * @param string $section Sekcijas slug.
 * @param array  $args    get_template_part argumenti; 'settings' — Elementor logrīka iestatījumi.
 * @return array
 */
function latvijai_section_settings( $section, $args = array() ) {
	$values = array();
	foreach ( latvijai_section_fields( $section ) as $key => $field ) {
		$values[ $key ] = $field['default'];
	}

	if ( ! empty( $args['settings'] ) && is_array( $args['settings'] ) ) {
		foreach ( $values as $key => $default ) {
			if ( array_key_exists( $key, $args['settings'] ) && null !== $args['settings'][ $key ] ) {
				$values[ $key ] = $args['settings'][ $key ];
			}
		}
	}

	return $values;
}

/**
 * Teksta rindas → masīvs (tukšās rindas izlaistas).
 *
 * @param string $text Teksts.
 * @return array
 */
function latvijai_lines( $text ) {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $text ) ), 'strlen' ) );
}

/**
 * Burtu virkne → atsevišķi burti (UTF-8, atstarpes izlaistas).
 *
 * @param string $text Teksts.
 * @return array
 */
function latvijai_chars( $text ) {
	return preg_split( '//u', preg_replace( '/\s+/u', '', (string) $text ), -1, PREG_SPLIT_NO_EMPTY );
}
