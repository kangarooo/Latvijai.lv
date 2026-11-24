<?php
/**
 * Sākumlapas sekcija: Misija.
 *
 * Izmanto gan front-page.php, gan Elementor logrīks „Latvijai: Misija”.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section id="misija" class="section mission">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><span class="eyebrow-index">01</span> <?php esc_html_e( 'Misija', 'latvijai-futura' ); ?></span>
			<span class="section-line" aria-hidden="true"></span>
		</div>

		<div class="mission-grid">
			<div class="mission-title reveal">
				<h2>
					<?php esc_html_e( 'Latvija nav tikai vieta.', 'latvijai-futura' ); ?>
					<span class="accent"><?php esc_html_e( 'Tā ir mūsu kopīgais projekts.', 'latvijai-futura' ); ?></span>
				</h2>
			</div>

			<div class="mission-body">
				<p class="lead reveal"><?php esc_html_e( 'Mēs ticam, ka valsts nākotni veido nevis viena ideja, bet tūkstošiem mazu darbu, kas notiek blakus.', 'latvijai-futura' ); ?></p>
				<p class="reveal"><?php esc_html_e( 'Latvijai.lv apkopo sabiedriskos projektus, savieno cilvēkus ar līdzdomātājiem un palīdz idejām pārvērsties darbos — no Rīgas līdz mazākajam novadam.', 'latvijai-futura' ); ?></p>

				<div class="stats-grid">
					<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
						<?php
						$stat_number = latvijai_get( 'stat_' . $i . '_number' );
						$stat_label  = latvijai_get( 'stat_' . $i . '_label' );
						$is_numeric  = (bool) preg_match( '/^\d+$/', $stat_number );
						?>
						<div class="stat reveal" style="--delay: <?php echo esc_attr( ( $i - 1 ) * 0.08 ); ?>s;">
							<span class="stat-number<?php echo $is_numeric ? '' : ' stat-number--accent'; ?>"<?php echo $is_numeric ? ' data-count="' . esc_attr( $stat_number ) . '"' : ''; ?>><?php echo esc_html( $is_numeric ? '0' : $stat_number ); ?></span>
							<span class="stat-label"><?php echo esc_html( $stat_label ); ?></span>
						</div>
					<?php endfor; ?>
				</div>

				<a class="link-arrow mission-link reveal" href="#projekti">
					<?php esc_html_e( 'Skatīt, ko būvējam', 'latvijai-futura' ); ?>
					<?php latvijai_icon_e( 'arrow-right' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
