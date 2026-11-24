<?php
/**
 * Elementor daļa: Tēmu josla.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_part_settings( 'ticker', $args ?? array() );

$topics = latvijai_lines( $s['ticker_topics'] );
if ( ! $topics ) {
	return;
}
?>
<div class="ticker" aria-hidden="true">
	<div class="ticker-track">
		<?php for ( $loop = 0; $loop < 2; $loop++ ) : ?>
			<?php foreach ( $topics as $topic ) : ?>
				<span class="ticker-item">
					<?php echo esc_html( $topic ); ?>
					<span class="ticker-star">✦</span>
				</span>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</div>
