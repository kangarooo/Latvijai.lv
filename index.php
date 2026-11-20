<?php
/**
 * Blog index.
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
	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'eyebrow'     => __( 'Žurnāls / Arhīvs', 'latvijai-futura' ),
			'title'       => __( 'Stāsti no<br><span class="text-outline">Latvijas nākotnes.</span>', 'latvijai-futura' ),
			'description' => __( 'Idejas, cilvēki un projekti, kas dara Latviju stiprāku. Lasi, iedvesmojies, pievienojies.', 'latvijai-futura' ),
		)
	);
	?>

	<div class="container page-content">
		<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php
				$index = 0;
				while ( have_posts() ) :
					the_post();
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

			<?php latvijai_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content-none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
