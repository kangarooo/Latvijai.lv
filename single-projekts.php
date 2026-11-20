<?php
/**
 * Single project template.
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
		$meta         = latvijai_project_meta();
		$field        = latvijai_project_field();
		$external_url = $meta['url'];
		$archive_url  = get_post_type_archive_link( 'projekts' );
		$contact_mail = latvijai_get( 'contact_email' );
		?>
		<div class="reading-progress" data-progress aria-hidden="true"><span></span></div>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-project' ); ?>>
			<header class="project-hero">
				<div class="container">
					<p class="eyebrow">
						<a href="<?php echo esc_url( $archive_url ? $archive_url : home_url( '/#projekti' ) ); ?>"><?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?></a>
						<span aria-hidden="true">/</span>
						<?php echo esc_html( $field ); ?>
					</p>

					<h1 class="project-title"><?php the_title(); ?></h1>

					<?php if ( has_excerpt() ) : ?>
						<p class="single-deck"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>

					<div class="project-actions">
						<?php if ( $external_url ) : ?>
							<a class="btn btn-primary" href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'Apmeklēt projektu', 'latvijai-futura' ); ?>
								<?php latvijai_icon_e( 'external' ); ?>
							</a>
						<?php endif; ?>
						<a class="btn btn-ghost" href="<?php echo esc_url( latvijai_get( 'donate_url' ) ); ?>">
							<?php esc_html_e( 'Atbalstīt', 'latvijai-futura' ); ?>
							<?php latvijai_icon_e( 'heart' ); ?>
						</a>
					</div>

					<div class="project-meta-panel">
						<div class="project-meta-cell">
							<span class="project-meta-label"><?php esc_html_e( 'Statuss', 'latvijai-futura' ); ?></span>
							<span class="project-meta-value project-meta-value--<?php echo esc_attr( $meta['status_class'] ); ?>">
								<span class="dot" aria-hidden="true"></span>
								<?php echo esc_html( $meta['status_label'] ); ?>
							</span>
						</div>

						<div class="project-meta-cell">
							<span class="project-meta-label"><?php esc_html_e( 'Norises vieta', 'latvijai-futura' ); ?></span>
							<span class="project-meta-value">
								<?php latvijai_icon_e( 'pin' ); ?>
								<?php echo esc_html( $meta['location'] ); ?>
							</span>
						</div>

						<div class="project-meta-cell">
							<span class="project-meta-label"><?php esc_html_e( 'Progress', 'latvijai-futura' ); ?></span>
							<span class="project-meta-value"><?php echo esc_html( number_format_i18n( $meta['progress'] ) ); ?>%</span>
							<div class="progress-track" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $meta['progress'] ); ?>">
								<span style="width: <?php echo esc_attr( $meta['progress'] ); ?>%;"></span>
							</div>
						</div>
					</div>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-hero-image">
					<?php the_post_thumbnail( 'latvijai-wide', array( 'loading' => 'eager' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="container project-content-wrap">
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Projekta lapas', 'latvijai-futura' ) . '"><span class="screen-reader-text">' . esc_html__( 'Lapas:', 'latvijai-futura' ) . '</span>',
							'after'       => '</nav>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						)
					);
					?>
				</div>

				<div class="project-support">
					<h2><?php esc_html_e( 'Atbalsti šo projektu', 'latvijai-futura' ); ?></h2>
					<p><?php esc_html_e( 'Katrs ziedojums, brīvprātīgā stunda vai dalība palīdz projektam augt. Pievienojies — tavs ieguldījums paliek Latvijā.', 'latvijai-futura' ); ?></p>
					<div class="cta-actions">
						<a class="btn btn-primary" href="<?php echo esc_url( latvijai_get( 'donate_url' ) ); ?>">
							<?php esc_html_e( 'Ziedo projektam', 'latvijai-futura' ); ?>
							<?php latvijai_icon_e( 'heart' ); ?>
						</a>
						<a class="btn btn-ghost" href="mailto:<?php echo esc_attr( $contact_mail ); ?>">
							<?php esc_html_e( 'Sazināties', 'latvijai-futura' ); ?>
							<?php latvijai_icon_e( 'mail' ); ?>
						</a>
					</div>
				</div>
			</div>

			<?php
			$related = new WP_Query(
				array(
					'post_type'           => 'projekts',
					'posts_per_page'      => 3,
					'post__not_in'        => array( get_the_ID() ),
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);

			if ( $related->have_posts() ) :
				?>
				<section class="related-posts" aria-labelledby="related-projects-title">
					<h2 class="related-title" id="related-projects-title"><?php esc_html_e( 'Citi projekti', 'latvijai-futura' ); ?></h2>
					<div class="projects-grid">
						<?php
						$index = 0;
						while ( $related->have_posts() ) :
							$related->the_post();
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
						?>
					</div>
				</section>
				<?php
				wp_reset_postdata();
			endif;

			the_post_navigation(
				array(
					'prev_text'          => '<span class="meta-nav">' . esc_html__( 'Iepriekšējais projekts', 'latvijai-futura' ) . '</span><span class="post-title">%title</span>',
					'next_text'          => '<span class="meta-nav">' . esc_html__( 'Nākamais projekts', 'latvijai-futura' ) . '</span><span class="post-title">%title</span>',
					'screen_reader_text' => __( 'Projektu navigācija', 'latvijai-futura' ),
					'aria_label'         => __( 'Citi projekti', 'latvijai-futura' ),
				)
			);

			if ( comments_open() || get_comments_number() ) {
				echo '<div class="container">';
				comments_template();
				echo '</div>';
			}
			?>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
