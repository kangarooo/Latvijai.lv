<?php
/**
 * Sākumlapas sekcija: Aicinājums (CTA).
 *
 * Izmanto gan front-page.php, gan Elementor logrīks „Latvijai: Aicinājums (CTA)”.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section id="pieteikties" class="cta-section">
	<div class="container">
		<div class="cta-panel reveal">
			<p class="eyebrow"><?php echo esc_html( latvijai_get( 'cta_eyebrow' ) ); ?></p>
			<h2 class="cta-title">
				<?php echo esc_html( latvijai_get( 'cta_title' ) ); ?>
				<span class="text-outline"><?php echo esc_html( latvijai_get( 'cta_title_2' ) ); ?></span>
			</h2>
			<p class="cta-text"><?php echo esc_html( latvijai_get( 'cta_text' ) ); ?></p>
			<div class="cta-actions">
				<a class="btn btn-primary btn-lg" href="<?php echo esc_url( latvijai_get( 'cta_primary_url' ) ); ?>">
					<?php echo esc_html( latvijai_get( 'cta_primary_label' ) ); ?>
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</a>
				<a class="btn btn-ghost btn-lg" href="<?php echo esc_url( latvijai_get( 'cta_secondary_url' ) ); ?>">
					<?php echo esc_html( latvijai_get( 'cta_secondary_label' ) ); ?>
					<?php latvijai_icon_e( 'heart' ); ?>
				</a>
			</div>
			<p class="cta-meta"><?php echo esc_html( latvijai_get( 'cta_meta' ) ); ?></p>
		</div>
	</div>
</section>
