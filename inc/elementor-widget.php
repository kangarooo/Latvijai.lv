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
	 * Vadīklas: visi sekcijas teksti, saites un saraksti (inc/front-sections.php).
	 */
	protected function register_controls() {
		$current = null;

		foreach ( $this->latvijai_fields() as $key => $field ) {
			$group = '' !== $field['group'] ? $field['group'] : __( 'Saturs', 'latvijai-futura' );

			if ( $group !== $current ) {
				if ( null !== $current ) {
					$this->end_controls_section();
				}
				$this->start_controls_section(
					'latvijai_group_' . substr( md5( $group ), 0, 8 ),
					array( 'label' => $group )
				);
				$current = $group;
			}

			$this->add_control( $key, $this->latvijai_control_args( $field ) );
		}

		if ( null !== $current ) {
			$this->end_controls_section();
		}
	}

	/**
	 * Lauku definīcijas.
	 *
	 * @return array
	 */
	protected function latvijai_fields() {
		return latvijai_section_fields( $this->latvijai_section );
	}

	/**
	 * Lauka definīcija → Elementor vadīklas argumenti.
	 *
	 * @param array $field Lauks.
	 * @return array
	 */
	protected function latvijai_control_args( $field ) {
		$cm   = '\Elementor\Controls_Manager';
		$args = array(
			'label'   => $field['label'],
			'default' => $field['default'],
		);

		switch ( $field['type'] ) {
			case 'textarea':
				$args['type'] = $cm::TEXTAREA;
				$args['rows'] = 4;
				break;
			case 'switch':
				$args['type']         = $cm::SWITCHER;
				$args['return_value'] = 'yes';
				break;
			case 'select':
				$args['type']    = $cm::SELECT;
				$args['options'] = $field['options'];
				break;
			case 'number':
				$args['type'] = $cm::NUMBER;
				$args['min']  = 1;
				$args['max']  = 12;
				break;
			case 'media':
				$args['type']    = $cm::MEDIA;
				$args['default'] = array( 'url' => '', 'id' => '' );
				break;
			case 'repeater':
				$repeater = new \Elementor\Repeater();
				foreach ( $field['fields'] as $sub_key => $sub_field ) {
					$repeater->add_control( $sub_key, $this->latvijai_control_args( $sub_field ) );
				}
				$args['type']   = $cm::REPEATER;
				$args['fields'] = $repeater->get_controls();
				if ( ! empty( $field['title'] ) ) {
					$args['title_field'] = '{{{ ' . $field['title'] . ' }}}';
				}
				break;
			default:
				$args['type']        = $cm::TEXT;
				$args['label_block'] = true;
		}

		return $args;
	}

	/**
	 * Izvade.
	 */
	protected function render() {
		get_template_part(
			'template-parts/front/' . $this->latvijai_section,
			null,
			array( 'settings' => $this->get_settings_for_display() )
		);
	}

	/**
	 * Bez Elementor iekšējā ietvara (.elementor-widget-container) — izvade kā tēmā.
	 *
	 * @return bool
	 */
	public function has_widget_inner_wrapper(): bool {
		return false;
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

/**
 * Maza tēmas daļa (dekoratīva vai dinamiska) Elementor lapai no pamatelementiem.
 */
class Latvijai_Part_Widget extends Latvijai_Section_Widget {

	/**
	 * Daļas slug.
	 *
	 * @var string
	 */
	protected $latvijai_part = 'hero-bg';

	/**
	 * Konstruktors.
	 *
	 * @param array      $data Elementa dati.
	 * @param array|null $args Argumenti (latvijai_part, latvijai_label).
	 */
	public function __construct( $data = array(), $args = null ) {
		$parts = latvijai_parts();

		if ( ! empty( $args['latvijai_part'] ) ) {
			$this->latvijai_part = $args['latvijai_part'];
		} elseif ( ! empty( $data['widgetType'] ) && 0 === strpos( $data['widgetType'], 'latvijai-part-' ) ) {
			$this->latvijai_part = substr( $data['widgetType'], strlen( 'latvijai-part-' ) );
		}

		$this->latvijai_section = isset( $parts[ $this->latvijai_part ] ) ? $parts[ $this->latvijai_part ][1] : 'hero';

		$args = is_array( $args ) ? $args : array();
		if ( empty( $args['latvijai_section'] ) ) {
			$args['latvijai_section'] = $this->latvijai_section;
			$args['latvijai_label']   = isset( $parts[ $this->latvijai_part ] ) ? $parts[ $this->latvijai_part ][0] : '';
		}

		parent::__construct( $data, $args );
	}

	/**
	 * Logrīka nosaukums.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'latvijai-part-' . $this->latvijai_part;
	}

	/**
	 * Ikona.
	 *
	 * @return string
	 */
	public function get_icon() {
		$parts = latvijai_parts();
		return isset( $parts[ $this->latvijai_part ][3] ) ? $parts[ $this->latvijai_part ][3] : 'eicon-flag';
	}

	/**
	 * Lauku definīcijas.
	 *
	 * @return array
	 */
	protected function latvijai_fields() {
		return latvijai_part_fields( $this->latvijai_part );
	}

	/**
	 * Izvade.
	 */
	protected function render() {
		get_template_part(
			'template-parts/elementor/' . $this->latvijai_part,
			null,
			array( 'settings' => $this->get_settings_for_display() )
		);
	}
}
