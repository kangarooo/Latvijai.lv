<?php
/**
 * Sākumlapas sekcija: Fokuss.
 *
 * Saturs nāk no Elementor logrīka „Latvijai: Fokuss” iestatījumiem;
 * bez Elementor — no noklusējumiem (inc/front-sections.php).
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = latvijai_section_settings( 'spotlight', $args ?? array() );

$spotlight_words = preg_split( '/\s+/u', trim( (string) $s['spotlight_title'] ) );
$spotlight_last  = array_pop( $spotlight_words );
$spotlight_first = implode( ' ', $spotlight_words );
$letters         = latvijai_chars( $s['alphabet'] );
?>
<section id="fokuss" class="section spotlight">
	<div class="container">
		<div class="spotlight-panel reveal">
			<div class="spotlight-content">
				<p class="eyebrow"><?php echo esc_html( $s['spotlight_eyebrow'] ); ?></p>
				<h2 class="spotlight-title">
					<?php if ( '' !== $spotlight_first ) : ?>
						<?php echo esc_html( $spotlight_first ); ?>
					<?php endif; ?>
					<span><?php echo esc_html( $spotlight_last ); ?></span>
				</h2>
				<p class="spotlight-text"><?php echo esc_html( $s['spotlight_text'] ); ?></p>
				<?php if ( '' !== trim( (string) $s['spotlight_label'] ) ) : ?>
					<div>
						<a class="btn btn-light" href="<?php echo esc_url( $s['spotlight_url'] ); ?>">
							<?php echo esc_html( $s['spotlight_label'] ); ?>
							<?php latvijai_icon_e( 'arrow-up-right' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="spotlight-alphabet">
					<span class="spotlight-alphabet-label"><?php echo esc_html( $s['alphabet_label'] ); ?></span>
					<span class="spotlight-alphabet-letters" aria-hidden="true"><?php foreach ( $letters as $letter ) : ?><span><?php echo esc_html( $letter ); ?></span><?php endforeach; ?></span>
				</div>
			</div>

			<div class="spotlight-visual" aria-hidden="true">
				<span class="spotlight-orbit"></span>
				<span class="spotlight-glyph"><?php echo esc_html( $s['glyph'] ); ?></span>
				<span class="spotlight-coords"><?php echo esc_html( $s['coords'] ); ?></span>
			</div>
		</div>
	</div>
</section>
