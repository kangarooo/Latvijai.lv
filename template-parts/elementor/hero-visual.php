<?php
/**
 * Elementor daļa: Hero lode.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_part_settings( 'hero-visual', $args ?? array() );
?>
<div class="hero-visual" aria-hidden="true">
	<div class="orb">
		<span class="orb-ring orb-ring--1"></span>
		<span class="orb-ring orb-ring--2"></span>
		<span class="orb-ring orb-ring--3"></span>
		<span class="orb-chip orb-chip--1"><?php echo esc_html( $s['orb_chip_1'] ); ?></span>
		<span class="orb-chip orb-chip--2"><?php echo esc_html( $s['orb_chip_2'] ); ?></span>
		<span class="orb-chip orb-chip--3"><?php echo esc_html( $s['orb_chip_3'] ); ?></span>
		<span class="orb-chip orb-chip--4"><?php echo esc_html( $s['orb_chip_4'] ); ?></span>
		<span class="orb-core">
			<span class="orb-monogram"><?php echo esc_html( $s['orb_monogram'] ); ?></span>
		</span>
		<span class="orb-triad">
			<svg viewBox="0 0 220 220" fill="none" aria-hidden="true" focusable="false">
				<defs>
					<linearGradient id="latvijai-orb-flag" x1="18" y1="26" x2="202" y2="194" gradientUnits="userSpaceOnUse">
						<stop offset="0" stop-color="#b3122e"/>
						<stop offset=".3" stop-color="#e11d3f"/>
						<stop offset=".52" stop-color="#f4f1ea"/>
						<stop offset=".76" stop-color="#e11d3f"/>
						<stop offset="1" stop-color="#9e1b32"/>
					</linearGradient>
					<radialGradient id="latvijai-orb-red-halo">
						<stop offset="0" stop-color="#e11d3f" stop-opacity=".55"/>
						<stop offset="1" stop-color="#e11d3f" stop-opacity="0"/>
					</radialGradient>
				</defs>
				<path class="orb-triad-aura" d="M110 10 196.6 160 23.4 160Z" stroke="url(#latvijai-orb-flag)" stroke-width="8" stroke-linejoin="round" opacity=".24"/>
				<path class="orb-triad-line" d="M110 10 196.6 160 23.4 160Z" stroke="url(#latvijai-orb-flag)" stroke-width="1.6" stroke-linejoin="round"/>
				<path class="orb-triad-pulse" d="M110 10 196.6 160 23.4 160Z" stroke="#ffffff" stroke-width="1.3" stroke-linecap="round" stroke-dasharray="3 47" pathLength="100"/>
				<g class="orb-triad-dot orb-triad-dot--red">
					<circle cx="110" cy="10" r="11" fill="url(#latvijai-orb-red-halo)"/>
					<circle cx="110" cy="10" r="4.4" fill="#ff3554"/>
				</g>
				<g class="orb-triad-dot orb-triad-dot--ice">
					<circle cx="196.6" cy="160" r="10" fill="#9fe8ff" opacity=".14"/>
					<circle cx="196.6" cy="160" r="3.9" fill="#f4f1ea"/>
				</g>
				<g class="orb-triad-dot orb-triad-dot--red">
					<circle cx="23.4" cy="160" r="11" fill="url(#latvijai-orb-red-halo)"/>
					<circle cx="23.4" cy="160" r="4.4" fill="#ff3554"/>
				</g>
			</svg>
		</span>
	</div>
	<span class="hero-readout"><?php echo esc_html( $s['hero_readout'] ); ?></span>
</div>
