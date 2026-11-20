<?php
/**
 * Archive template for posts, projects and taxonomies.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$is_projects = is_post_type_archive( 'projekts' ) || is_tax( 'joma' );
$eyebrow     = $is_projects ? __( 'Arhīvs / Projekti', 'latvijai-futura' ) : __( 'Arhīvs / Žurnāls', 'latvijai-futura' );
$archive_desc = latvijai_archive_description();
?>

<main id="primary" class="site-main">
	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow'     => $eyebrow,
			'title'       => esc_html( latvijai_archive_title() ),
			'description' => $archive_desc,
		)
	);
	?>

	<?php if ( $is_projects ) : ?>
		<div class="container">
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'joma',
					'hide_empty' => true,
				)
			);

			$current_term = is_tax( 'joma' ) ? get_queried_object_id() : 0;

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
				?>
				<nav class="filter-bar" aria-label="<?php esc_attr_e( 'Filtrēt projektus pēc jomas', 'latvijai-futura' ); ?>">
					<a class="filter-chip<?php echo 0 === $current_term ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'projekts' ) ); ?>">
						<?php esc_html_e( 'Visi', 'latvijai-futura' ); ?>
					</a>
					<?php foreach ( $terms as $term ) : ?>
						<a class="filter-chip<?php echo (int) $current_term === (int) $term->term_id ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
							<?php echo esc_html( $term->name ); ?>
							<span class="count"><?php echo esc_html( number_format_i18n( $term->count ) ); ?></span>
						</a>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="container page-content">
		<?php if ( have_posts() ) : ?>
			<div class="<?php echo $is_projects ? 'projects-grid' : 'posts-grid'; ?>">
				<?php
				$index = 0;
				while ( have_posts() ) :
					the_post();

					if ( $is_projects || 'projekts' === get_post_type() ) {
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
