<?php
/**
 * Mobile navigation panel.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="mobile-panel" class="mobile-panel" data-mobile-panel aria-hidden="true" inert>
	<nav class="mobile-nav" aria-label="<?php esc_attr_e( 'Mobilā navigācija', 'latvijai-futura' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'mobile-menu',
				'menu_class'     => 'mobile-menu',
				'fallback_cb'    => 'latvijai_menu_fallback',
				'depth'          => 2,
			)
		);
		?>
	</nav>

	<div class="mobile-panel-foot">
		<span class="eyebrow eyebrow--plain"><?php esc_html_e( 'Latvijai.lv · Rīga', 'latvijai-futura' ); ?></span>
		<div class="mobile-socials">
			<?php latvijai_social_links( 'icon-btn' ); ?>
		</div>
	</div>
</div>
