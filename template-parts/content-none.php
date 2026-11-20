<?php
/**
 * Empty state.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="empty-state">
	<p class="eyebrow"><?php esc_html_e( 'Tukšs signāls', 'latvijai-futura' ); ?></p>
	<h2><?php esc_html_e( 'Nekas nav atrasts.', 'latvijai-futura' ); ?></h2>
	<p><?php esc_html_e( 'Mēģini citu atslēgvārdu vai ieskaties projektos — varbūt meklētais jau top.', 'latvijai-futura' ); ?></p>

	<?php get_search_form(); ?>

	<div class="empty-actions">
		<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Uz sākumlapu', 'latvijai-futura' ); ?>
		</a>
		<a class="btn btn-ghost" href="<?php echo esc_url( get_post_type_archive_link( 'projekts' ) ? get_post_type_archive_link( 'projekts' ) : home_url( '/#projekti' ) ); ?>">
			<?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?>
		</a>
	</div>
</section>
