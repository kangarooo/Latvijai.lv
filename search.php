<?php
/**
 * Search results.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$search_query = get_search_query();
$found        = (int) $GLOBALS['wp_query']->found_posts;

$title = '' !== $search_query
	? sprintf(
		/* translators: %s: search query. */
		__( 'Rezultāti: <span class="search-query">“%s”</span>', 'latvijai-futura' ),
		esc_html( $search_query )
	)
	: __( 'Meklēšana', 'latvijai-futura' );

$description = sprintf(
	/* translators: %s: number of results. */
	_n( '%s rezultāts', '%s rezultāti', $found, 'latvijai-futura' ),
	number_format_i18n( $found )
);

?>

<main id="primary" class="site-main search-results">
	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow'     => __( 'Meklēšana / Latvijai.lv', 'latvijai-futura' ),
			'title'       => $title,
			'description' => $description,
		)
	);
	?>

	<div class="container">
		<?php get_search_form(); ?>
	</div>

	<div class="container page-content">
		<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php
				$index = 0;
				while ( have_posts() ) :
					the_post();

					if ( 'projekts' === get_post_type() ) {
						get_template_part(
							'template-parts/project-card',
							null,
							array(
								'post_id' => get_the_ID(),
								'index'   => $index,
							)
						);
					} else {
						get_template_part(
							'template-parts/content-card',
							null,
							array(
								'post_id' => get_the_ID(),
								'index'   => $index,
							)
						);
					}

					$index++;
				endwhile;
				?>
			</div>

			<?php latvijai_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content-none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
