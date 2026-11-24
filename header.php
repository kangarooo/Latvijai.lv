<?php
/**
 * The header.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js" data-theme="<?php echo esc_attr( latvijai_color_scheme() ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>(function(d){d.classList.remove('no-js');d.classList.add('js');<?php if ( latvijai_get( 'theme_toggle_enabled' ) ) : ?>try{var t=localStorage.getItem('latvijai-theme');if(t==='light'||t==='dark'){d.setAttribute('data-theme',t);}}catch(e){}<?php endif; ?>})(document.documentElement);</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
if ( latvijai_get( 'preloader_enabled' ) ) :
	$preloader_bg1 = latvijai_get( 'preloader_bg_color' );
	$preloader_bg2 = latvijai_get( 'preloader_bg_color_2' );
	$preloader_bg  = $preloader_bg2 ? 'linear-gradient(135deg, ' . $preloader_bg1 . ', ' . $preloader_bg2 . ')' : $preloader_bg1;
	// Untouched default colours follow the active colour scheme instead.
	if ( latvijai_default( 'preloader_bg_color' ) === $preloader_bg1 && latvijai_default( 'preloader_bg_color_2' ) === $preloader_bg2 ) {
		$preloader_bg = '';
	}
?>
	<div id="preloader" class="preloader" aria-hidden="true" role="status" aria-label="<?php esc_attr_e( 'Lādē lapā', 'latvijai-futura' ); ?>" data-duration="<?php echo esc_attr( latvijai_get( 'preloader_duration' ) ); ?>"<?php echo $preloader_bg ? ' style="--preloader-bg: ' . esc_attr( $preloader_bg ) . ';"' : ''; ?>>
		<?php
		$preloader_image = latvijai_get( 'preloader_image' );
		if ( $preloader_image ) :
		?>
			<img class="preloader-image" src="<?php echo esc_url( $preloader_image ); ?>" alt="" aria-hidden="true" />
		<?php else : ?>
			<div class="preloader-spinner" aria-hidden="true">
				<span></span><span></span><span></span>
			</div>
		<?php endif; ?>
		<p class="preloader-text"><?php esc_html_e( 'Lādē Latviju…', 'latvijai-futura' ); ?></p>
	</div>
<?php endif; ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Pāriet uz saturu', 'latvijai-futura' ); ?></a>

<?php if ( ! latvijai_elementor_location( 'header' ) ) : ?>
<header id="masthead" class="site-header" data-header>
	<?php latvijai_header_flag(); ?>
	<div class="header-inner container">
		<div class="site-branding">
			<?php latvijai_brand(); ?>
		</div>

		<nav class="main-nav" aria-label="<?php esc_attr_e( 'Galvenā navigācija', 'latvijai-futura' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu',
					'fallback_cb'    => 'latvijai_menu_fallback',
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="header-actions">
			<span class="header-clock" aria-hidden="true">
				<span class="live-dot"></span>
				<span data-riga-time>--:--</span>
				<?php esc_html_e( 'Latvijas laiks', 'latvijai-futura' ); ?>
			</span>

			<?php latvijai_theme_toggle(); ?>

			<button class="icon-btn search-toggle" type="button" data-search-open aria-haspopup="dialog" aria-controls="search-overlay" aria-expanded="false" aria-label="<?php esc_attr_e( 'Atvērt meklēšanu', 'latvijai-futura' ); ?>">
				<?php latvijai_icon_e( 'search' ); ?>
			</button>

			<a class="btn btn-primary btn-sm donate-btn" href="<?php echo esc_url( latvijai_get( 'donate_url' ) ); ?>">
				<?php esc_html_e( 'Ziedo', 'latvijai-futura' ); ?>
				<?php latvijai_icon_e( 'heart' ); ?>
			</a>

			<button class="icon-btn menu-toggle" type="button" data-menu-toggle aria-controls="mobile-panel" aria-expanded="false" aria-label="<?php esc_attr_e( 'Atvērt izvēlni', 'latvijai-futura' ); ?>">
				<?php latvijai_icon_e( 'menu', 'icon-menu' ); ?>
				<?php latvijai_icon_e( 'close', 'icon-close' ); ?>
			</button>
		</div>
	</div>
</header>
<?php endif; ?>

<?php get_template_part( 'template-parts/search-overlay' ); ?>
<?php get_template_part( 'template-parts/mobile-panel' ); ?>

<div id="page" class="site">
	<div id="content" class="site-content">
