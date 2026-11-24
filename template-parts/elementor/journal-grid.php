<?php
/**
 * Elementor daļa: Žurnāla ieraksti.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_part_settings( 'journal-grid', $args ?? array() );
?>
<div class="journal-grid">
	<?php
	$journal = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => max( 1, min( 12, (int) $s['count'] ) ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);

	if ( $journal->have_posts() ) :
		$index = 0;
		while ( $journal->have_posts() ) :
			$journal->the_post();
			get_template_part(
				'template-parts/content-card',
				null,
				array(
					'post_id' => get_the_ID(),
					'index'   => $index,
				)
			);
			$index++;
		endwhile;
		wp_reset_postdata();
	else :
		?>
		<div class="empty-state reveal" style="grid-column: 1 / -1;">
			<p class="eyebrow"><?php echo esc_html( $s['empty_eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $s['empty_title'] ); ?></h2>
			<p><?php echo esc_html( $s['empty_text'] ); ?></p>
			<div class="empty-actions">
				<a class="btn btn-primary" href="#pieteikties"><?php esc_html_e( 'Pievienoties', 'latvijai-futura' ); ?></a>
				<a class="btn btn-ghost" href="#projekti"><?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?></a>
			</div>
		</div>
	<?php endif; ?>
</div>
