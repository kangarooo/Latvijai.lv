<?php
/**
 * Elementor logrīks, kas izvada vienu tēmas sākumlapas sekciju.
 *
 * Saturu (virsrakstus, tekstus, saites) joprojām pārvalda Pielāgotājs
 * (Izskats → Pielāgot), tāpēc sekcija izskatās identiski tēmas sākumlapai.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sekcijas logrīks.
 */
class Latvijai_Section_Widget extends \Elementor\Widget_Base {

	/**
	 * Sekcijas slug.
	 *
	 * @var string
	 */
	protected $latvijai_section = 'hero';

	/**
	 * Nosaukums redaktorā.
	 *
	 * @var string
	 */
	protected $latvijai_label = '';

	/**
	 * Konstruktors.
	 *
	 * @param array      $data Elementa dati.
	 * @param array|null $args Argumenti (latvijai_section, latvijai_label).
	 */
	public function __construct( $data = array(), $args = null ) {
		if ( ! empty( $args['latvijai_section'] ) ) {
			$this->latvijai_section = $args['latvijai_section'];
			$this->latvijai_label   = isset( $args['latvijai_label'] ) ? $args['latvijai_label'] : '';
		} elseif ( ! empty( $data['widgetType'] ) && 0 === strpos( $data['widgetType'], 'latvijai-' ) ) {
			$this->latvijai_section = substr( $data['widgetType'], strlen( 'latvijai-' ) );
			$sections               = latvijai_front_sections();
			$this->latvijai_label   = isset( $sections[ $this->latvijai_section ] ) ? $sections[ $this->latvijai_section ] : '';
		}

		parent::__construct( $data, $args );
	}

	/**
	 * Logrīka nosaukums.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'latvijai-' . $this->latvijai_section;
	}

	/**
	 * Virsraksts redaktorā.
	 *
	 * @return string
	 */
	public function get_title() {
		/* translators: %s: sekcijas nosaukums. */
		return sprintf( __( 'Latvijai: %s', 'latvijai-futura' ), $this->latvijai_label );
	}

	/**
	 * Ikona.
	 *
	 * @return string
	 */
	public function get_icon() {
		$icons = array(
			'hero'      => 'eicon-header',
			'mission'   => 'eicon-info-box',
			'latvia'    => 'eicon-map-pin',
			'projects'  => 'eicon-posts-grid',
			'spotlight' => 'eicon-image-box',
			'journal'   => 'eicon-post-list',
			'cta'       => 'eicon-call-to-action',
		);

		return isset( $icons[ $this->latvijai_section ] ) ? $icons[ $this->latvijai_section ] : 'eicon-flag';
	}

	/**
	 * Kategorijas.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'latvijai-futura' );
	}

	/**
	 * Meklēšanas atslēgvārdi.
	 *
	 * @return array
	 */
	public function get_keywords() {
		return array( 'latvijai', 'latvija', $this->latvijai_section );
	}

	/**
	 * Vadīklas: tikai norāde, kur labot saturu.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'latvijai_info',
			array(
				'label' => __( 'Saturs', 'latvijai-futura' ),
			)
		);

		$this->add_control(
			'latvijai_note',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					/* translators: %s: saite uz Pielāgotāju. */
					__( 'Šīs sekcijas tekstus un saites labo <a href="%s" target="_blank">Izskats → Pielāgot</a>. Sekciju var pārvietot, dublēt vai paslēpt šeit.', 'latvijai-futura' ),
					esc_url( admin_url( 'customize.php' ) )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Izvade.
	 */
	protected function render() {
		get_template_part( 'template-parts/front/' . $this->latvijai_section );
	}

	/**
	 * Sekcija ir dinamiska — Elementor to nekešo kā statisku HTML.
	 *
	 * @return bool
	 */
	protected function is_dynamic_content(): bool {
		return true;
	}
}
