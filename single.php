<?php
/**
 * Single post template.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		$categories = get_the_category();
		?>
		<div class="reading-progress" data-progress aria-hidden="true"><span></span></div>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
			<header class="single-hero">
				<div class="container">
					<p class="eyebrow">
						<?php if ( ! empty( $categories ) ) : ?>
							<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
						<?php else : ?>
							<?php esc_html_e( 'Žurnāls', 'latvijai-futura' ); ?>
						<?php endif; ?>
						<span aria-hidden="true">/</span>
						<?php echo esc_html( get_the_date( 'Y' ) ); ?>
					</p>

					<h1 class="single-title"><?php the_title(); ?></h1>

					<?php if ( has_excerpt() ) : ?>
						<p class="single-deck"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>

					<?php latvijai_entry_meta(); ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-hero-image">
					<?php the_post_thumbnail( 'latvijai-wide', array( 'loading' => 'eager' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="container">
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Ieraksta lapas', 'latvijai-futura' ) . '"><span class="screen-reader-text">' . esc_html__( 'Lapas:', 'latvijai-futura' ) . '</span>',
							'after'       => '</nav>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						)
					);
					?>
				</div>

				<footer class="entry-footer">
					<?php the_tags( '<div class="tags-links">', '', '</div>' ); ?>
					<?php latvijai_share_links(); ?>

					<div class="author-box">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 56, '', get_the_author(), array( 'class' => 'avatar' ) ); ?>
						<div>
							<h3>
								<?php esc_html_e( 'Autors', 'latvijai-futura' ); ?>
								<span><?php the_author(); ?></span>
							</h3>
							<p>
								<?php
								$author_bio = get_the_author_meta( 'description' );
								echo esc_html( $author_bio ? $author_bio : __( 'Raksta par cilvēkiem, idejām un projektiem, kas veido Latvijas nākotni.', 'latvijai-futura' ) );
								?>
							</p>
						</div>
					</div>
				</footer>
			</div>

			<?php
			the_post_navigation(
				array(
					'prev_text'          => '<span class="meta-nav">' . esc_html__( 'Iepriekšējais', 'latvijai-futura' ) . '</span><span class="post-title">%title</span>',
					'next_text'          => '<span class="meta-nav">' . esc_html__( 'Nākamais', 'latvijai-futura' ) . '</span><span class="post-title">%title</span>',
					'screen_reader_text' => __( 'Ierakstu navigācija', 'latvijai-futura' ),
					'aria_label'         => __( 'Citi ieraksti', 'latvijai-futura' ),
				)
			);
			?>

			<?php
			$category_ids = wp_get_post_categories( get_the_ID() );
			if ( ! empty( $category_ids ) ) :
				$related = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 3,
						'post__not_in'        => array( get_the_ID() ),
						'category__in'        => $category_ids,
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);

				if ( $related->have_posts() ) :
					?>
					<section class="related-posts" aria-labelledby="related-title">
						<h2 class="related-title" id="related-title"><?php esc_html_e( 'Lasīt tālāk', 'latvijai-futura' ); ?></h2>
						<div class="related-grid">
							<?php
							$index = 0;
							while ( $related->have_posts() ) :
								$related->the_post();
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
							?>
						</div>
					</section>
					<?php
					wp_reset_postdata();
				endif;
			endif;
			?>

			<div class="container">
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
