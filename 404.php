<?php
/**
 * 404 template.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<section class="error-404">
		<div class="container error-inner">
			<p class="eyebrow"><?php esc_html_e( 'Kļūda 404 / Signāls pazaudēts', 'latvijai-futura' ); ?></p>

			<div class="glitch" data-text="404" aria-hidden="true"><span>404</span></div>

			<h1 class="error-title"><?php esc_html_e( 'Šī frekvence ir tukša.', 'latvijai-futura' ); ?></h1>
			<p><?php esc_html_e( 'Meklētā lapa pazuda starp Rīgas torņiem. Pārbaudi adresi vai atgriezies sākumlapā — tur viss darbojas.', 'latvijai-futura' ); ?></p>

			<div class="error-actions">
				<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Atgriezties sākumlapā', 'latvijai-futura' ); ?>
					<?php latvijai_icon_e( 'arrow-right' ); ?>
				</a>
				<a class="btn btn-ghost" href="<?php echo esc_url( get_post_type_archive_link( 'projekts' ) ? get_post_type_archive_link( 'projekts' ) : home_url( '/#projekti' ) ); ?>">
					<?php esc_html_e( 'Skatīt projektus', 'latvijai-futura' ); ?>
				</a>
			</div>

			<div class="error-search">
				<?php get_search_form(); ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
