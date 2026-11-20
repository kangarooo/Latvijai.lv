<?php
/**
 * Search form.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$search_id = function_exists( 'wp_unique_id' ) ? wp_unique_id( 'search-field-' ) : 'search-field';
?>
<form role="search" method="get" class="search-form search-form--inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $search_id ); ?>"><?php esc_html_e( 'Meklēt', 'latvijai-futura' ); ?></label>
	<input
		type="search"
		id="<?php echo esc_attr( $search_id ); ?>"
		class="search-field"
		name="s"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		placeholder="<?php esc_attr_e( 'Meklēt Latvijai.lv…', 'latvijai-futura' ); ?>"
	>
	<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Meklēt', 'latvijai-futura' ); ?>">
		<?php latvijai_icon_e( 'search' ); ?>
	</button>
</form>
