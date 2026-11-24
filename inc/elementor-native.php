<?php
/**
 * Sākumlapa no Elementor pamatelementiem.
 *
 * Visi teksti, pogas un saites ir parasti Elementor logrīki (Virsraksts, Poga)
 * konteineros ar tēmas CSS klasēm, tāpēc tos labo tieši lapā.
 * Tēmas kodā paliek tikai dekoratīvās un dinamiskās daļas (mazie logrīki zemāk).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Mazās tēmas daļas: slug => array( nosaukums, sekcija, lauki, ikona ).
 *
 * Lauki tiek ņemti no inc/front-sections.php attiecīgās sekcijas.
 *
 * @return array
 */
function latvijai_parts() {
	return array(
		'hero-bg'          => array( __( 'Hero fons (daļiņas, gaisma)', 'latvijai-futura' ), 'hero', array( 'scroll_label' ), 'eicon-animation' ),
		'hero-visual'      => array( __( 'Hero lode', 'latvijai-futura' ), 'hero', array( 'orb_monogram', 'orb_chip_1', 'orb_chip_2', 'orb_chip_3', 'orb_chip_4', 'hero_readout' ), 'eicon-circle-o' ),
		'ticker'           => array( __( 'Tēmu josla', 'latvijai-futura' ), 'hero', array( 'ticker_topics' ), 'eicon-animation-text' ),
		'projects-grid'    => array( __( 'Projektu kartītes', 'latvijai-futura' ), 'projects', array( 'source', 'count', 'cards', 'note' ), 'eicon-posts-grid' ),
		'journal-grid'     => array( __( 'Žurnāla ieraksti', 'latvijai-futura' ), 'journal', array( 'count', 'empty_eyebrow', 'empty_title', 'empty_text' ), 'eicon-post-list' ),
		'spotlight-visual' => array( __( 'Fokusa burts', 'latvijai-futura' ), 'spotlight', array( 'glyph', 'coords' ), 'eicon-typography' ),
	);
}

/**
 * Daļas lauki.
 *
 * @param string $part Daļas slug.
 * @return array
 */
function latvijai_part_fields( $part ) {
	$parts = latvijai_parts();
	if ( ! isset( $parts[ $part ] ) ) {
		return array();
	}
	$all = latvijai_section_fields( $parts[ $part ][1] );
	return array_intersect_key( $all, array_flip( $parts[ $part ][2] ) );
}

/**
 * Daļas vērtības: noklusējumi + logrīka iestatījumi.
 *
 * @param string $part Daļas slug.
 * @param array  $args get_template_part argumenti.
 * @return array
 */
function latvijai_part_settings( $part, $args = array() ) {
	$parts = latvijai_parts();
	$all   = latvijai_section_settings( $parts[ $part ][1], $args );
	return array_intersect_key( $all, array_flip( $parts[ $part ][2] ) );
}

/**
 * Elementor datu veidotājs.
 */
class Latvijai_Native_Builder {

	/**
	 * Skaitītājs stabiliem ID.
	 *
	 * @var int
	 */
	private $n = 0;

	/**
	 * Jauns elementa ID.
	 *
	 * @return string
	 */
	private function id() {
		$this->n++;
		return substr( md5( 'latvijai-native-' . $this->n ), 0, 7 );
	}

	/**
	 * Konteiners ar tēmas klasēm.
	 *
	 * @param string $classes  CSS klases.
	 * @param array  $children Bērni.
	 * @param array  $opts     tag, id.
	 * @return array
	 */
	public function box( $classes, $children, $opts = array() ) {
		$settings = array(
			'content_width' => 'full',
			'css_classes'   => trim( 'lv-box ' . $classes ),
		);
		if ( ! empty( $opts['tag'] ) ) {
			$settings['html_tag'] = $opts['tag'];
		}
		if ( ! empty( $opts['id'] ) ) {
			$settings['_element_id'] = $opts['id'];
		}
		if ( ! empty( $opts['title'] ) ) {
			$settings['_title'] = $opts['title'];
		}
		return array(
			'id'       => $this->id(),
			'elType'   => 'container',
			'isInner'  => false,
			'settings' => $settings,
			'elements' => array_values( array_filter( $children ) ),
		);
	}

	/**
	 * Virsraksta logrīks (arī rindkopām un īsiem tekstiem).
	 *
	 * @param string $tag     h1–h6, p, span, div.
	 * @param string $html    Saturs (atļauts vienkāršs HTML).
	 * @param string $classes CSS klases.
	 * @return array|null
	 */
	public function text( $tag, $html, $classes ) {
		if ( '' === trim( (string) $html ) ) {
			return null;
		}
		return array(
			'id'         => $this->id(),
			'elType'     => 'widget',
			'widgetType' => 'heading',
			'settings'   => array(
				'title'        => $html,
				'header_size'  => $tag,
				'_css_classes' => $classes,
			),
			'elements'   => array(),
		);
	}

	/**
	 * Pogas logrīks.
	 *
	 * @param string $label   Teksts.
	 * @param string $url     Saite.
	 * @param string $classes btn btn-primary btn-lg | link-arrow …
	 * @return array|null
	 */
	public function button( $label, $url, $classes ) {
		if ( '' === trim( (string) $label ) ) {
			return null;
		}
		$external = (bool) preg_match( '#^https?://#i', (string) $url ) && false === strpos( (string) $url, home_url() );
		return array(
			'id'         => $this->id(),
			'elType'     => 'widget',
			'widgetType' => 'button',
			'settings'   => array(
				'text'         => $label,
				'link'         => array(
					'url'         => (string) $url,
					'is_external' => $external ? 'on' : '',
					'nofollow'    => '',
				),
				'_css_classes' => $classes,
			),
			'elements'   => array(),
		);
	}

	/**
	 * Tēmas daļas logrīks.
	 *
	 * @param string $part     Daļas slug.
	 * @param array  $settings Iestatījumi.
	 * @return array
	 */
	public function part( $part, $settings ) {
		return array(
			'id'         => $this->id(),
			'elType'     => 'widget',
			'widgetType' => 'latvijai-part-' . $part,
			'settings'   => $settings,
			'elements'   => array(),
		);
	}
}

/**
 * Repeater rindām pievieno _id (Elementor to prasa).
 *
 * @param array  $rows Rindas.
 * @param string $salt Sāls.
 * @return array
 */
function latvijai_rows_with_ids( $rows, $salt ) {
	$out = array();
	foreach ( array_values( (array) $rows ) as $i => $row ) {
		$out[] = array( '_id' => substr( md5( $salt . $i ), 0, 7 ) ) + (array) $row;
	}
	return $out;
}

/**
 * Sākumlapa no Elementor pamatelementiem ar pašreizējo saturu.
 *
 * @return array Elementor dati.
 */
function latvijai_elementor_native_page_data() {
	$b  = new Latvijai_Native_Builder();
	$e = 'esc_html';

	// Hero.
	$h     = latvijai_section_settings( 'hero' );
	// Atstarpes starp rindām, lai virsraksts lasās kā teikums (meklētāji, ekrāna lasītāji).
	$lines = array();
	if ( '' !== $h['hero_title_1'] ) {
		$lines[] = '<span class="hero-line"><span>' . $e( $h['hero_title_1'] ) . '</span></span>';
	}
	if ( '' !== $h['hero_title_2'] ) {
		$lines[] = '<span class="hero-line hero-line--outline"><span>' . $e( $h['hero_title_2'] ) . '</span></span>';
	}
	if ( '' !== $h['hero_title_3'] ) {
		$lines[] = '<span class="hero-line"><span>' . $e( $h['hero_title_3'] ) . '<em class="hero-dot">.</em></span></span>';
	}
	$lines = implode( ' ', $lines );

	$hero = $b->box(
		'hero',
		array(
			$b->part( 'hero-bg', array( 'scroll_label' => $h['scroll_label'] ) ),
			$b->box(
				'container hero-inner',
				array(
					$b->box(
						'hero-copy',
						array(
							$b->text( 'p', '<span class="lv-flag" aria-hidden="true"></span>' . $e( $h['hero_eyebrow'] ), 'hero-eyebrow lv-contents' ),
							$b->text( 'h1', $lines, 'hero-title' . ( ! empty( $h['hero_flag_colours'] ) ? ' hero-title--flag' : '' ) ),
							$b->text( 'p', $e( $h['hero_text'] ), 'hero-text' ),
							$b->box(
								'hero-actions',
								array(
									$b->button( $h['hero_primary_label'], $h['hero_primary_url'], 'lv-btn lv-btn-primary lv-btn-lg lv-icon-up' ),
									$b->button( $h['hero_secondary_label'], $h['hero_secondary_url'], 'lv-btn lv-btn-ghost lv-btn-lg' ),
								)
							),
							$b->text( 'div', '<span class="hero-status"><span class="pulse" aria-hidden="true"></span>' . $e( $h['hero_status'] ) . '</span><span class="hero-coords">' . $e( $h['hero_coords'] ) . '</span>', 'hero-meta lv-contents' ),
						)
					),
					$b->part(
						'hero-visual',
						array_intersect_key( $h, array_flip( array( 'orb_monogram', 'orb_chip_1', 'orb_chip_2', 'orb_chip_3', 'orb_chip_4', 'hero_readout' ) ) )
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'title' => __( 'Hero', 'latvijai-futura' ),
		)
	);

	$ticker = ! empty( $h['ticker_enabled'] ) ? $b->box( 'lv-ticker', array( $b->part( 'ticker', array( 'ticker_topics' => $h['ticker_topics'] ) ) ), array( 'title' => __( 'Tēmu josla', 'latvijai-futura' ) ) ) : null;

	// Misija.
	$m     = latvijai_section_settings( 'mission' );
	$stats = array();
	foreach ( array_values( (array) $m['stats'] ) as $i => $stat ) {
		$number  = (string) $stat['number'];
		$stats[] = $b->box(
			'stat reveal',
			array(
				$b->text( 'span', $e( $number ), 'stat-number' . ( preg_match( '/^\d+$/', $number ) ? '' : ' stat-number--accent' ) ),
				$b->text( 'span', $e( $stat['label'] ), 'stat-label' ),
			)
		);
	}

	$mission = $b->box(
		'section mission',
		array(
			$b->box(
				'container',
				array(
					$b->text( 'div', '<span class="eyebrow"><span class="eyebrow-index">' . $e( $m['eyebrow_index'] ) . '</span> ' . $e( $m['eyebrow'] ) . '</span><span class="section-line" aria-hidden="true"></span>', 'section-head reveal lv-contents' ),
					$b->box(
						'mission-grid',
						array(
							$b->box( 'mission-title reveal', array( $b->text( 'h2', $e( $m['title'] ) . ' <span class="accent">' . $e( $m['title_accent'] ) . '</span>', '' ) ) ),
							$b->box(
								'mission-body',
								array(
									$b->text( 'p', $e( $m['lead'] ), 'lead reveal' ),
									$b->text( 'p', $e( $m['text'] ), 'reveal' ),
									$b->box( 'stats-grid', $stats ),
									$b->button( $m['link_label'], $m['link_url'], 'lv-link-arrow lv-icon-right mission-link reveal' ),
								)
							),
						)
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'id'    => 'misija',
			'title' => __( 'Misija', 'latvijai-futura' ),
		)
	);

	// Latvija.
	$l       = latvijai_section_settings( 'latvia' );
	$regions = array();
	foreach ( array_values( (array) $l['regions'] ) as $i => $region ) {
		$regions[] = $b->text(
			'div',
			'<span class="latvia-region-index">' . str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) . '</span><span class="latvia-region-copy"><strong>' . $e( $region['name'] ) . '</strong><em>' . $e( $region['places'] ) . '</em></span>',
			'latvia-region lv-contents'
		);
	}

	$latvia = $b->box(
		'section latvia',
		array(
			$b->box(
				'container',
				array(
					$b->box(
						'latvia-panel reveal',
						array(
							$b->box(
								'latvia-copy',
								array(
									$b->text( 'p', '<span class="eyebrow-index">' . $e( $l['eyebrow_index'] ) . '</span> ' . $e( $l['eyebrow'] ), 'eyebrow lv-contents' ),
									$b->text( 'h2', $e( $l['title'] ) . ' <span class="text-outline">' . $e( $l['title_outline'] ) . '</span>', 'latvia-title' ),
									$b->text( 'p', $e( $l['text'] ), 'latvia-text' ),
									$b->text( 'div', '<span class="lv-flag" aria-hidden="true"></span><span>' . $e( $l['meta'] ) . '</span><span>' . $e( $l['coords'] ) . '</span>', 'latvia-meta lv-contents' ),
									$b->button( $l['link_label'], $l['link_url'], 'lv-link-arrow lv-icon-right latvia-link' ),
								)
							),
							$b->box( 'latvia-regions', $regions ),
						)
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'id'    => 'latvija',
			'title' => __( 'Latvija', 'latvijai-futura' ),
		)
	);

	// Projekti.
	$p        = latvijai_section_settings( 'projects' );
	$projects = $b->box(
		'section projects',
		array(
			$b->box(
				'container',
				array(
					$b->box(
						'section-top',
						array(
							$b->box(
								'reveal',
								array(
									$b->text( 'span', '<span class="eyebrow-index">' . $e( $p['eyebrow_index'] ) . '</span> ' . $e( $p['eyebrow'] ), 'eyebrow lv-contents' ),
									$b->text( 'h2', $e( $p['title'] ) . '<br><span class="text-outline">' . $e( $p['title_outline'] ) . '</span>', 'section-title' ),
								)
							),
							$b->button( $p['link_label'], $p['link_url'], 'lv-link-arrow lv-icon-up' ),
						)
					),
					$b->part(
						'projects-grid',
						array(
							'source' => $p['source'],
							'count'  => (int) $p['count'],
							'cards'  => latvijai_rows_with_ids( $p['cards'], 'card' ),
							'note'   => $p['note'],
						)
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'id'    => 'projekti',
			'title' => __( 'Projekti', 'latvijai-futura' ),
		)
	);

	// Fokuss.
	$s       = latvijai_section_settings( 'spotlight' );
	$words   = preg_split( '/\s+/u', trim( (string) $s['spotlight_title'] ) );
	$last    = array_pop( $words );
	$letters = '';
	foreach ( latvijai_chars( $s['alphabet'] ) as $letter ) {
		$letters .= '<span>' . $e( $letter ) . '</span>';
	}

	$spotlight = $b->box(
		'section spotlight',
		array(
			$b->box(
				'container',
				array(
					$b->box(
						'spotlight-panel reveal',
						array(
							$b->box(
								'spotlight-content',
								array(
									$b->text( 'p', $e( $s['spotlight_eyebrow'] ), 'eyebrow' ),
									$b->text( 'h2', ( $words ? $e( implode( ' ', $words ) ) . ' ' : '' ) . '<span>' . $e( $last ) . '</span>', 'spotlight-title' ),
									$b->text( 'p', $e( $s['spotlight_text'] ), 'spotlight-text' ),
									$b->button( $s['spotlight_label'], $s['spotlight_url'], 'lv-btn lv-btn-light lv-icon-up' ),
									$b->text( 'div', '<span class="spotlight-alphabet-label">' . $e( $s['alphabet_label'] ) . '</span><span class="spotlight-alphabet-letters" aria-hidden="true">' . $letters . '</span>', 'spotlight-alphabet lv-contents' ),
								)
							),
							$b->part( 'spotlight-visual', array( 'glyph' => $s['glyph'], 'coords' => $s['coords'] ) ),
						)
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'id'    => 'fokuss',
			'title' => __( 'Fokuss', 'latvijai-futura' ),
		)
	);

	// Žurnāls.
	$j       = latvijai_section_settings( 'journal' );
	$journal = $b->box(
		'section journal',
		array(
			$b->box(
				'container',
				array(
					$b->box(
						'section-top',
						array(
							$b->box(
								'reveal',
								array(
									$b->text( 'span', '<span class="eyebrow-index">' . $e( $j['eyebrow_index'] ) . '</span> ' . $e( $j['eyebrow'] ), 'eyebrow lv-contents' ),
									$b->text( 'h2', $e( $j['title'] ) . '<br><span class="text-outline">' . $e( $j['title_outline'] ) . '</span>', 'section-title' ),
								)
							),
							$b->button( $j['link_label'], $j['link_url'], 'lv-link-arrow lv-icon-up' ),
						)
					),
					$b->part(
						'journal-grid',
						array(
							'count'         => (int) $j['count'],
							'empty_eyebrow' => $j['empty_eyebrow'],
							'empty_title'   => $j['empty_title'],
							'empty_text'    => $j['empty_text'],
						)
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'id'    => 'zurnals',
			'title' => __( 'Žurnāls', 'latvijai-futura' ),
		)
	);

	// CTA.
	$c   = latvijai_section_settings( 'cta' );
	$cta = $b->box(
		'cta-section',
		array(
			$b->box(
				'container',
				array(
					$b->box(
						'cta-panel reveal',
						array(
							$b->text( 'p', $e( $c['cta_eyebrow'] ), 'eyebrow' ),
							$b->text( 'h2', $e( $c['cta_title'] ) . ' <span class="text-outline">' . $e( $c['cta_title_2'] ) . '</span>', 'cta-title' ),
							$b->text( 'p', $e( $c['cta_text'] ), 'cta-text' ),
							$b->box(
								'cta-actions',
								array(
									$b->button( $c['cta_primary_label'], $c['cta_primary_url'], 'lv-btn lv-btn-primary lv-btn-lg lv-icon-up' ),
									$b->button( $c['cta_secondary_label'], $c['cta_secondary_url'], 'lv-btn lv-btn-ghost lv-btn-lg lv-icon-heart' ),
								)
							),
							$b->text( 'p', $e( $c['cta_meta'] ), 'cta-meta' ),
						)
					),
				)
			),
		),
		array(
			'tag'   => 'section',
			'id'    => 'pieteikties',
			'title' => __( 'Aicinājums', 'latvijai-futura' ),
		)
	);

	return array_values( array_filter( array( $hero, $ticker, $mission, $latvia, $projects, $spotlight, $journal, $cta ) ) );
}

/**
 * Reģistrē mazās daļas kā Elementor logrīkus.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Logrīku pārvaldnieks.
 */
function latvijai_elementor_part_widgets( $widgets_manager ) {
	require_once get_template_directory() . '/inc/elementor-widget.php';

	foreach ( latvijai_parts() as $slug => $part ) {
		$widgets_manager->register(
			new Latvijai_Part_Widget(
				array(),
				array(
					'latvijai_part'  => $slug,
					'latvijai_label' => $part[0],
				)
			)
		);
	}
}
add_action( 'elementor/widgets/register', 'latvijai_elementor_part_widgets', 20 );
