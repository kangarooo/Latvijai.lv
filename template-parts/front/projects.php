<?php
/**
 * Sākumlapas sekcija: Projekti.
 *
 * Izmanto gan front-page.php, gan Elementor logrīks „Latvijai: Projekti”.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$latvijai_ctx = latvijai_front_context();
$demo_projects = $latvijai_ctx['demo_projects'];
$projects_url = $latvijai_ctx['projects_url'];
?>
<section id="projekti" class="section projects">
	<div class="container">
		<div class="section-top">
			<div class="reveal">
				<span class="eyebrow"><span class="eyebrow-index">02</span> <?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?></span>
				<h2 class="section-title"><?php esc_html_e( 'Idejas, kas jau', 'latvijai-futura' ); ?><br><span class="text-outline"><?php esc_html_e( 'strādā Latvijai.', 'latvijai-futura' ); ?></span></h2>
			</div>
			<a class="link-arrow" href="<?php echo esc_url( $projects_url ); ?>">
				<?php esc_html_e( 'Visi projekti', 'latvijai-futura' ); ?>
				<?php latvijai_icon_e( 'arrow-up-right' ); ?>
			</a>
		</div>

		<div class="projects-grid">
			<?php
			$showing_demos = false;
			$projects      = new WP_Query(
				array(
					'post_type'           => 'projekts',
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);

			if ( $projects->have_posts() ) :
				$index = 0;
				while ( $projects->have_posts() ) :
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
				endwhile;
				wp_reset_postdata();
			else :
				$showing_demos = true;
				foreach ( $demo_projects as $index => $demo ) :
					get_template_part(
						'template-parts/project-card',
						null,
						array(
							'demo'  => $demo,
							'index' => $index,
							'url'   => $demo['url'],
						)
					);
				endforeach;
			endif;
			?>
		</div>

		<?php if ( $showing_demos ) : ?>
			<p class="projects-note"><?php esc_html_e( 'Rādīti parauga projekti. Pievieno savus projektus WordPress administrācijā.', 'latvijai-futura' ); ?></p>
		<?php endif; ?>
	</div>
</section>
