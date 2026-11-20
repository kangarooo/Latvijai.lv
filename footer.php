<?php
/**
 * The footer.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_email = latvijai_get( 'contact_email' );
?>
	</div><!-- #content -->
</div><!-- #page -->

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="footer-top">
			<div class="footer-brand">
				<?php latvijai_brand(); ?>
				<p class="footer-text"><?php echo esc_html( latvijai_get( 'footer_text' ) ); ?></p>
				<div class="footer-socials">
					<?php latvijai_social_links(); ?>
				</div>
			</div>

			<div class="footer-col">
				<h3><?php esc_html_e( 'Navigācija', 'latvijai-futura' ); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => 'latvijai_menu_fallback',
						'depth'          => 1,
					)
				);
				?>
			</div>

			<div class="footer-col">
				<h3><?php esc_html_e( 'Kontakts', 'latvijai-futura' ); ?></h3>
				<div class="footer-contact">
					<span class="footer-contact-item">
						<?php latvijai_icon_e( 'mail' ); ?>
						<a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
					</span>
					<span class="footer-contact-item">
						<?php latvijai_icon_e( 'pin' ); ?>
						<span><?php echo esc_html( latvijai_get( 'contact_location' ) ); ?></span>
					</span>
					<span class="footer-contact-item">
						<?php latvijai_icon_e( 'globe' ); ?>
						<span><?php echo esc_html( latvijai_get( 'contact_coords' ) ); ?></span>
					</span>
				</div>
			</div>

			<div class="footer-col">
				<h3><?php esc_html_e( 'Atbalsti', 'latvijai-futura' ); ?></h3>
				<p class="footer-text"><?php esc_html_e( 'Katra ideja sākas ar kādu, kas pieceļas. Pievienojies vai atbalsti projektu ar ziedojumu.', 'latvijai-futura' ); ?></p>
				<a class="btn btn-ghost btn-sm" href="<?php echo esc_url( latvijai_get( 'donate_url' ) ); ?>">
					<?php esc_html_e( 'Ziedo projektam', 'latvijai-futura' ); ?>
					<?php latvijai_icon_e( 'heart' ); ?>
				</a>
				<span class="footer-clock">
					<?php latvijai_icon_e( 'clock' ); ?>
					<strong data-riga-time>--:--</strong>
					<?php esc_html_e( 'Rīga', 'latvijai-futura' ); ?>
				</span>
			</div>
		</div>

		<div class="footer-wordmark" aria-hidden="true">LATVIJAI<span>.</span>LV</div>

		<div class="footer-bottom">
			<span>
				<?php
				printf(
					/* translators: 1: current year, 2: site name. */
					esc_html__( '© %1$s %2$s — visas tiesības aizsargātas.', 'latvijai-futura' ),
					esc_html( date_i18n( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</span>
			<span><?php esc_html_e( 'Veidots Latvijā, Latvijai.', 'latvijai-futura' ); ?></span>
			<a class="back-top" href="#page">
				<?php esc_html_e( 'Uz augšu', 'latvijai-futura' ); ?>
				<?php latvijai_icon_e( 'arrow-up' ); ?>
			</a>
		</div>
	</div>
</footer>

<button class="to-top" type="button" data-to-top aria-label="<?php esc_attr_e( 'Atgriezties uz augšu', 'latvijai-futura' ); ?>">
	<?php latvijai_icon_e( 'arrow-up' ); ?>
</button>

<?php wp_footer(); ?>
</body>
</html>
