<?php
/**
 * Sākumlapas sekcija: Žurnāls.
 *
 * Izmanto gan front-page.php, gan Elementor logrīks „Latvijai: Žurnāls”.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$latvijai_ctx = latvijai_front_context();
$journal_url = $latvijai_ctx['journal_url'];
?>
<section id="zurnals" class="section journal">
	<div class="container">
		<div class="section-top">
			<div class="reveal">
				<span class="eyebrow"><span class="eyebrow-index">04</span> <?php esc_html_e( 'Žurnāls', 'latvijai-futura' ); ?></span>
				<h2 class="section-title"><?php esc_html_e( 'Stāsti no', 'latvijai-futura' ); ?><br><span class="text-outline"><?php esc_html_e( 'Latvijas nākotnes.', 'latvijai-futura' ); ?></span></h2>
			</div>
			<a class="link-arrow" href="<?php echo esc_url( $journal_url ); ?>">
				<?php esc_html_e( 'Visi ieraksti', 'latvijai-futura' ); ?>
				<?php latvijai_icon_e( 'arrow-up-right' ); ?>
			</a>
		</div>

		<div class="journal-grid">
			<?php
			$journal = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);

			if ( $journal->have_posts() ) :
				$index = 0;
				while ( $journal->have_posts() ) :
					$journal->the_post();
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
				wp_reset_postdata();
			else :
				?>
				<div class="empty-state reveal" style="grid-column: 1 / -1;">
					<p class="eyebrow"><?php esc_html_e( 'Tukšs signāls', 'latvijai-futura' ); ?></p>
					<h2><?php esc_html_e( 'Pirmie stāsti jau ceļā.', 'latvijai-futura' ); ?></h2>
					<p><?php esc_html_e( 'Žurnāls tiks atvērts pavisam drīz. Tikmēr pievienojies kustībai vai ieskaties projektos.', 'latvijai-futura' ); ?></p>
					<div class="empty-actions">
						<a class="btn btn-primary" href="#pieteikties"><?php esc_html_e( 'Pievienoties', 'latvijai-futura' ); ?></a>
						<a class="btn btn-ghost" href="#projekti"><?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?></a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
