<?php
/**
 * Sākumlapas sekcija: Latvija (reģioni).
 *
 * Izmanto gan front-page.php, gan Elementor logrīks „Latvijai: Latvija (reģioni)”.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$latvijai_ctx = latvijai_front_context();
$latvia_regions = $latvijai_ctx['latvia_regions'];
?>
<section id="latvija" class="section latvia">
	<div class="container">
		<div class="latvia-panel reveal">
			<div class="latvia-copy">
				<p class="eyebrow"><span class="eyebrow-index">LV</span> <?php esc_html_e( 'Latvija / 5 novadi', 'latvijai-futura' ); ?></p>

				<h2 class="latvia-title">
					<?php esc_html_e( 'Viena Latvija.', 'latvijai-futura' ); ?>
					<span class="text-outline"><?php esc_html_e( 'Pieci novadi.', 'latvijai-futura' ); ?></span>
				</h2>

				<p class="latvia-text"><?php esc_html_e( 'No Rīgas līdz Latgalei, no Kurzemes līdz Vidzemei. Mēs savienojam cilvēkus, kas savu novadu pārvērš par vietu, kur gribas palikt.', 'latvijai-futura' ); ?></p>

				<div class="latvia-meta">
					<span class="lv-flag" aria-hidden="true"></span>
					<span><?php esc_html_e( '5 novadi · 64 589 km²', 'latvijai-futura' ); ?></span>
					<span><?php echo esc_html( latvijai_get( 'contact_coords' ) ); ?></span>
				</div>

				<a class="link-arrow latvia-link" href="#projekti">
					<?php esc_html_e( 'Skatīt projektus', 'latvijai-futura' ); ?>
					<?php latvijai_icon_e( 'arrow-right' ); ?>
				</a>
			</div>

			<div class="latvia-regions" role="list" aria-label="<?php esc_attr_e( 'Latvijas novadi', 'latvijai-futura' ); ?>">
				<?php foreach ( $latvia_regions as $region_index => $region ) : ?>
					<div class="latvia-region" role="listitem">
						<span class="latvia-region-index"><?php echo esc_html( str_pad( (string) ( $region_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<div class="latvia-region-copy">
							<strong><?php echo esc_html( $region['name'] ); ?></strong>
							<em><?php echo esc_html( $region['places'] ); ?></em>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
