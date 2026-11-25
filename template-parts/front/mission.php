<?php
/**
 * Sākumlapas sekcija: Misija.
 *
 * Saturs nāk no Elementor logrīka „Latvijai: Misija” iestatījumiem;
 * bez Elementor — no noklusējumiem (inc/front-sections.php).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_section_settings( 'mission', $args ?? array() );
?>
<section id="misija" class="section mission">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><span class="eyebrow-index"><?php echo esc_html( $s['eyebrow_index'] ); ?></span> <?php echo esc_html( $s['eyebrow'] ); ?></span>
			<span class="section-line" aria-hidden="true"></span>
		</div>

		<div class="mission-grid">
			<div class="mission-title reveal">
				<h2>
					<?php echo esc_html( $s['title'] ); ?>
					<span class="accent"><?php echo esc_html( $s['title_accent'] ); ?></span>
				</h2>
			</div>

			<div class="mission-body">
				<?php if ( '' !== trim( (string) $s['lead'] ) ) : ?>
					<p class="lead reveal"><?php echo esc_html( $s['lead'] ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== trim( (string) $s['text'] ) ) : ?>
					<p class="reveal"><?php echo esc_html( $s['text'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $s['stats'] ) && is_array( $s['stats'] ) ) : ?>
					<div class="stats-grid">
						<?php foreach ( array_values( $s['stats'] ) as $i => $stat ) : ?>
							<?php
							$stat_number = isset( $stat['number'] ) ? (string) $stat['number'] : '';
							$stat_label  = isset( $stat['label'] ) ? (string) $stat['label'] : '';
							$is_numeric  = (bool) preg_match( '/^\d+$/', $stat_number );
							?>
							<div class="stat reveal" style="--delay: <?php echo esc_attr( $i * 0.08 ); ?>s;">
								<span class="stat-number<?php echo $is_numeric ? '' : ' stat-number--accent'; ?>"<?php echo $is_numeric ? ' data-count="' . esc_attr( $stat_number ) . '"' : ''; ?>><?php echo esc_html( $stat_number ); ?></span>
								<span class="stat-label"><?php echo esc_html( $stat_label ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( '' !== trim( (string) $s['link_label'] ) ) : ?>
					<a class="link-arrow mission-link reveal" href="<?php echo esc_url( $s['link_url'] ); ?>">
						<?php echo esc_html( $s['link_label'] ); ?>
						<?php latvijai_icon_e( 'arrow-right' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
