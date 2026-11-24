<?php
/**
 * Sākumlapas sekcija: Fokuss.
 *
 * Izmanto gan front-page.php, gan Elementor logrīks „Latvijai: Fokuss”.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section id="fokuss" class="section spotlight">
	<div class="container">
		<div class="spotlight-panel reveal">
			<div class="spotlight-content">
				<p class="eyebrow"><?php echo esc_html( latvijai_get( 'spotlight_eyebrow' ) ); ?></p>
				<?php
				$spotlight_title = latvijai_get( 'spotlight_title' );
				$spotlight_words = preg_split( '/\s+/u', trim( $spotlight_title ) );
				$spotlight_last  = array_pop( $spotlight_words );
				$spotlight_first = implode( ' ', $spotlight_words );
				?>
				<h2 class="spotlight-title">
					<?php if ( '' !== $spotlight_first ) : ?>
						<?php echo esc_html( $spotlight_first ); ?>
					<?php endif; ?>
					<span><?php echo esc_html( $spotlight_last ); ?></span>
				</h2>
				<p class="spotlight-text"><?php echo esc_html( latvijai_get( 'spotlight_text' ) ); ?></p>
				<div>
					<a class="btn btn-light" href="<?php echo esc_url( latvijai_get( 'spotlight_url' ) ); ?>">
						<?php echo esc_html( latvijai_get( 'spotlight_label' ) ); ?>
						<?php latvijai_icon_e( 'arrow-up-right' ); ?>
					</a>
				</div>

				<div class="spotlight-alphabet">
					<span class="spotlight-alphabet-label"><?php esc_html_e( 'Latviešu valoda', 'latvijai-futura' ); ?></span>
					<span class="spotlight-alphabet-letters" aria-hidden="true"><span>Ā</span><span>Č</span><span>Ē</span><span>Ģ</span><span>Ī</span><span>Ķ</span><span>Ļ</span><span>Ņ</span><span>Š</span><span>Ū</span><span>Ž</span></span>
				</div>
			</div>

			<div class="spotlight-visual" aria-hidden="true">
				<span class="spotlight-orbit"></span>
				<span class="spotlight-glyph">Ā</span>
				<span class="spotlight-coords"><?php echo esc_html( latvijai_get( 'contact_coords' ) ); ?></span>
			</div>
		</div>
	</div>
</section>
