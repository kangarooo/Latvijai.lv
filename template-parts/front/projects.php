<?php
/**
 * Sākumlapas sekcija: Projekti.
 *
 * Saturs nāk no Elementor logrīka „Latvijai: Projekti” iestatījumiem;
 * bez Elementor — no noklusējumiem (inc/front-sections.php).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_section_settings( 'projects', $args ?? array() );

$cards = ! empty( $s['cards'] ) && is_array( $s['cards'] ) ? array_values( $s['cards'] ) : array();
$count = max( 1, min( 12, (int) $s['count'] ) );
?>
<section id="projekti" class="section projects">
	<div class="container">
		<div class="section-top">
			<div class="reveal">
				<span class="eyebrow"><span class="eyebrow-index"><?php echo esc_html( $s['eyebrow_index'] ); ?></span> <?php echo esc_html( $s['eyebrow'] ); ?></span>
				<h2 class="section-title"><?php echo esc_html( $s['title'] ); ?><br><span class="text-outline"><?php echo esc_html( $s['title_outline'] ); ?></span></h2>
			</div>
			<?php if ( '' !== trim( (string) $s['link_label'] ) ) : ?>
				<a class="link-arrow" href="<?php echo esc_url( $s['link_url'] ); ?>">
					<?php echo esc_html( $s['link_label'] ); ?>
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</a>
			<?php endif; ?>
		</div>

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
	</div>
</section>
