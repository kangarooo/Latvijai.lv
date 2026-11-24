<?php
/**
 * Sākumlapas sekcija: Aicinājums (CTA).
 *
 * Saturs nāk no Elementor logrīka „Latvijai: Aicinājums (CTA)” iestatījumiem;
 * bez Elementor — no noklusējumiem (inc/front-sections.php).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_section_settings( 'cta', $args ?? array() );
?>
<section id="pieteikties" class="cta-section">
	<div class="container">
		<div class="cta-panel reveal">
			<p class="eyebrow"><?php echo esc_html( $s['cta_eyebrow'] ); ?></p>
			<h2 class="cta-title">
				<?php echo esc_html( $s['cta_title'] ); ?>
				<span class="text-outline"><?php echo esc_html( $s['cta_title_2'] ); ?></span>
			</h2>
			<p class="cta-text"><?php echo esc_html( $s['cta_text'] ); ?></p>
			<div class="cta-actions">
				<a class="btn btn-primary btn-lg" href="<?php echo esc_url( $s['cta_primary_url'] ); ?>">
					<?php echo esc_html( $s['cta_primary_label'] ); ?>
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</a>
				<a class="btn btn-ghost btn-lg" href="<?php echo esc_url( $s['cta_secondary_url'] ); ?>">
					<?php echo esc_html( $s['cta_secondary_label'] ); ?>
					<?php latvijai_icon_e( 'heart' ); ?>
				</a>
			</div>
			<p class="cta-meta"><?php echo esc_html( $s['cta_meta'] ); ?></p>
		</div>
	</div>
</section>
