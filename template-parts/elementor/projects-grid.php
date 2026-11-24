<?php
/**
 * Elementor daļa: Projektu kartītes.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_part_settings( 'projects-grid', $args ?? array() );

$cards = ! empty( $s['cards'] ) && is_array( $s['cards'] ) ? array_values( $s['cards'] ) : array();
$count = max( 1, min( 12, (int) $s['count'] ) );
?>
<div class="projects-grid">
	<?php
	$showing_samples = false;
	$has_posts       = false;

	if ( 'manual' !== $s['source'] ) {
		$projects = new WP_Query(
			array(
				'post_type'           => 'projekts',
				'posts_per_page'      => $count,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);

		if ( $projects->have_posts() ) {
			$has_posts = true;
			$index     = 0;
			while ( $projects->have_posts() ) {
				$projects->the_post();
				get_template_part(
					'template-parts/project-card',
					null,
					array(
						'post_id' => get_the_ID(),
						'index'   => $index,
					)
				);
				$index++;
			}
			wp_reset_postdata();
		}

		$showing_samples = ! $has_posts;
	}

	if ( ! $has_posts ) {
		foreach ( $cards as $index => $card ) {
			$card['sample'] = $showing_samples;
			get_template_part(
				'template-parts/project-card',
				null,
				array(
					'demo'  => $card,
					'index' => $index,
				)
			);
		}
	}
	?>
</div>

<?php if ( $showing_samples && $cards && '' !== trim( (string) $s['note'] ) ) : ?>
	<p class="projects-note"><?php echo esc_html( $s['note'] ); ?></p>
<?php endif; ?>
