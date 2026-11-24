<?php
/**
 * Elementor daļa: Fokusa burts.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_part_settings( 'spotlight-visual', $args ?? array() );
?>
<div class="spotlight-visual" aria-hidden="true">
	<span class="spotlight-orbit"></span>
	<span class="spotlight-glyph"><?php echo esc_html( $s['glyph'] ); ?></span>
	<span class="spotlight-coords"><?php echo esc_html( $s['coords'] ); ?></span>
</div>
