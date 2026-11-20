<?php
/**
 * Page template.
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
		$page_description = has_excerpt() ? get_the_excerpt() : '';

		get_template_part(
			'template-parts/page-hero',
			null,
			array(
				'eyebrow'     => __( 'Latvijai.lv / Lapa', 'latvijai-futura' ),
				'title'       => get_the_title(),
				'description' => $page_description,
			)
		);
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-hero-image">
					<?php the_post_thumbnail( 'latvijai-wide' ); ?>
				</figure>
			<?php endif; ?>

			<div class="container page-content">
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Lapas', 'latvijai-futura' ) . '"><span class="screen-reader-text">' . esc_html__( 'Lapas:', 'latvijai-futura' ) . '</span>',
							'after'       => '</nav>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						)
					);
					?>
				</div>

				<?php
				edit_post_link(
					__( 'Labot lapu', 'latvijai-futura' ),
					'<p class="edit-link">',
					'</p>'
				);

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
