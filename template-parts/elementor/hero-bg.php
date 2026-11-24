<?php
/**
 * Elementor daļa: Hero fons.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_part_settings( 'hero-bg', $args ?? array() );
?>
<canvas class="hero-canvas" data-particles aria-hidden="true"></canvas>
<div class="hero-glow" aria-hidden="true"></div>
<a class="scroll-cue" href="#misija">
	<span><?php echo esc_html( $s['scroll_label'] ); ?></span>
	<span class="scroll-line" aria-hidden="true"></span>
</a>
