<?php
/**
 * Full-screen search overlay.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="search-overlay" class="search-overlay" data-search-overlay role="dialog" aria-modal="true" aria-labelledby="search-overlay-title" aria-hidden="true" inert>
	<button class="icon-btn search-overlay-close" type="button" data-search-close aria-label="<?php esc_attr_e( 'Aizvērt meklēšanu', 'latvijai-futura' ); ?>">
		<?php latvijai_icon_e( 'close' ); ?>
	</button>

	<div class="search-panel">
		<p class="eyebrow" id="search-overlay-title"><?php esc_html_e( 'Meklēt Latvijai.lv', 'latvijai-futura' ); ?></p>

		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="overlay-search"><?php esc_html_e( 'Meklēt', 'latvijai-futura' ); ?></label>
			<input
				type="search"
				id="overlay-search"
				class="search-field"
				name="s"
				value="<?php echo esc_attr( get_search_query() ); ?>"
				placeholder="<?php esc_attr_e( 'Projekti, idejas, stāsti…', 'latvijai-futura' ); ?>"
				autocomplete="off"
			>
			<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Meklēt', 'latvijai-futura' ); ?>">
				<?php latvijai_icon_e( 'search' ); ?>
			</button>
		</form>

		<p class="search-hint">
			<?php
			printf(
				/* translators: 1: Esc key, 2: Enter key. */
				esc_html__( 'Nospied %1$s, lai aizvērtu · %2$s, lai meklētu', 'latvijai-futura' ),
				'<kbd>Esc</kbd>',
				'<kbd>Enter</kbd>'
			);
			?>
		</p>
	</div>
</div>
