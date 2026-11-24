<?php
/**
 * Sākumlapas sekcija: Hero (virsraksts, daļiņas, tikers).
 *
 * Saturs nāk no Elementor logrīka „Latvijai: Hero (virsraksts, daļiņas, tikers)” iestatījumiem;
 * bez Elementor — no noklusējumiem (inc/front-sections.php).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_section_settings( 'hero', $args ?? array() );

$hero_title_1 = (string) $s['hero_title_1'];
$hero_title_2 = (string) $s['hero_title_2'];
$hero_title_3 = (string) $s['hero_title_3'];
$hero_full    = trim( $hero_title_1 . ' ' . $hero_title_2 . ' ' . $hero_title_3 );
$topics       = latvijai_lines( $s['ticker_topics'] );
?>
<section class="hero" data-hero>
	<canvas class="hero-canvas" data-particles aria-hidden="true"></canvas>
	<div class="hero-glow" aria-hidden="true"></div>

	<div class="container hero-inner">
		<div class="hero-copy">
			<p class="hero-eyebrow"><span class="lv-flag" aria-hidden="true"></span><?php echo esc_html( $s['hero_eyebrow'] ); ?></p>

			<h1 class="hero-title<?php echo ! empty( $s['hero_flag_colours'] ) ? ' hero-title--flag' : ''; ?>" aria-label="<?php echo esc_attr( $hero_full ); ?>">
				<?php if ( '' !== $hero_title_1 ) : ?>
					<span class="hero-line" aria-hidden="true"><span><?php echo esc_html( $hero_title_1 ); ?></span></span>
				<?php endif; ?>
				<?php if ( '' !== $hero_title_2 ) : ?>
					<span class="hero-line hero-line--outline" aria-hidden="true"><span><?php echo esc_html( $hero_title_2 ); ?></span></span>
				<?php endif; ?>
				<?php if ( '' !== $hero_title_3 ) : ?>
					<span class="hero-line" aria-hidden="true"><span><?php echo esc_html( $hero_title_3 ); ?><em class="hero-dot">.</em></span></span>
				<?php endif; ?>
			</h1>

			<p class="hero-text"><?php echo esc_html( $s['hero_text'] ); ?></p>

			<div class="hero-actions">
				<a class="btn btn-primary btn-lg" href="<?php echo esc_url( $s['hero_primary_url'] ); ?>">
					<?php echo esc_html( $s['hero_primary_label'] ); ?>
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</a>
				<a class="btn btn-ghost btn-lg" href="<?php echo esc_url( $s['hero_secondary_url'] ); ?>">
					<?php echo esc_html( $s['hero_secondary_label'] ); ?>
				</a>
			</div>

			<div class="hero-meta">
				<span class="hero-status">
					<span class="pulse" aria-hidden="true"></span>
					<?php echo esc_html( $s['hero_status'] ); ?>
				</span>
				<span class="hero-coords"><?php echo esc_html( $s['hero_coords'] ); ?></span>
			</div>
		</div>

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
	</div>

	<a class="scroll-cue" href="#misija">
		<span><?php echo esc_html( $s['scroll_label'] ); ?></span>
		<span class="scroll-line" aria-hidden="true"></span>
	</a>
</section>

<?php if ( ! empty( $s['ticker_enabled'] ) && $topics ) : ?>
<div class="ticker" aria-hidden="true">
	<div class="ticker-track">
		<?php for ( $loop = 0; $loop < 2; $loop++ ) : ?>
			<?php foreach ( $topics as $topic ) : ?>
				<span class="ticker-item">
					<?php echo esc_html( $topic ); ?>
					<span class="ticker-star">✦</span>
				</span>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</div>
<?php endif; ?>
