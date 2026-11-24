<?php
/**
 * Sākumlapas sekcija: Latvija (reģioni).
 *
 * Saturs nāk no Elementor logrīka „Latvijai: Latvija (reģioni)” iestatījumiem;
 * bez Elementor — no noklusējumiem (inc/front-sections.php).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_section_settings( 'latvia', $args ?? array() );

$regions = ! empty( $s['regions'] ) && is_array( $s['regions'] ) ? array_values( $s['regions'] ) : array();
?>
<section id="latvija" class="section latvia">
	<div class="container">
		<div class="latvia-panel reveal">
			<div class="latvia-copy">
				<p class="eyebrow"><span class="eyebrow-index"><?php echo esc_html( $s['eyebrow_index'] ); ?></span> <?php echo esc_html( $s['eyebrow'] ); ?></p>

				<h2 class="latvia-title">
					<?php echo esc_html( $s['title'] ); ?>
					<span class="text-outline"><?php echo esc_html( $s['title_outline'] ); ?></span>
				</h2>

				<p class="latvia-text"><?php echo esc_html( $s['text'] ); ?></p>

				<div class="latvia-meta">
					<span class="lv-flag" aria-hidden="true"></span>
					<span><?php echo esc_html( $s['meta'] ); ?></span>
					<span><?php echo esc_html( $s['coords'] ); ?></span>
				</div>

				<?php if ( '' !== trim( (string) $s['link_label'] ) ) : ?>
					<a class="link-arrow latvia-link" href="<?php echo esc_url( $s['link_url'] ); ?>">
						<?php echo esc_html( $s['link_label'] ); ?>
						<?php latvijai_icon_e( 'arrow-right' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="latvia-regions" role="list" aria-label="<?php esc_attr_e( 'Latvijas novadi', 'latvijai-futura' ); ?>">
				<?php foreach ( $regions as $region_index => $region ) : ?>
					<div class="latvia-region" role="listitem">
						<span class="latvia-region-index"><?php echo esc_html( str_pad( (string) ( $region_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<div class="latvia-region-copy">
							<strong><?php echo esc_html( isset( $region['name'] ) ? $region['name'] : '' ); ?></strong>
							<em><?php echo esc_html( isset( $region['places'] ) ? $region['places'] : '' ); ?></em>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
