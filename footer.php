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
		<div class="footer-ornament" aria-hidden="true">
			<svg viewBox="0 0 1200 26" preserveAspectRatio="none" focusable="false">
				<defs>
					<pattern id="latvijai-lielvarde" width="72" height="26" patternUnits="userSpaceOnUse">
						<path d="M36 2 51 13 36 24 21 13Z" fill="none" stroke="#f4f1ea" stroke-opacity=".55" stroke-width="1.1"/>
						<path d="M36 7 44 13 36 19 28 13Z" fill="currentColor" opacity=".8"/>
						<path d="M7 7v12M1 13h12" stroke="currentColor" stroke-width="1.1"/>
						<path d="M65 7v12M59 13h12" stroke="currentColor" stroke-width="1.1"/>
						<circle cx="36" cy="13" r="1.2" fill="#f4f1ea" opacity=".55"/>
						<circle cx="15" cy="23" r="1" fill="currentColor" opacity=".65"/>
						<circle cx="57" cy="3" r="1" fill="currentColor" opacity=".65"/>
					</pattern>
				</defs>
				<rect width="1200" height="26" fill="url(#latvijai-lielvarde)"/>
			</svg>
		</div>

		<div class="footer-top">
			<div class="footer-brand">
				<?php latvijai_brand(); ?>
				<p class="footer-text"><?php echo esc_html( latvijai_get( 'footer_text' ) ); ?></p>
				<p class="footer-regions"><?php esc_html_e( 'Rīga · Kurzeme · Zemgale · Vidzeme · Latgale', 'latvijai-futura' ); ?></p>
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
				<h3><?php esc_html_e( 'Sazinies', 'latvijai-futura' ); ?></h3>
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
					<?php esc_html_e( 'Latvijas laiks', 'latvijai-futura' ); ?>
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
