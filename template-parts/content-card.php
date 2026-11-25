<?php
/**
 * Post card.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$card_args = wp_parse_args(
	$args ?? array(),
	array(
		'post_id' => 0,
		'index'   => 0,
	)
);

$post_id   = (int) $card_args['post_id'];
$index     = (int) $card_args['index'];
$permalink = get_permalink( $post_id );
$title     = get_the_title( $post_id );
$excerpt   = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post_id ) ), 24, '…' );
$glyph     = preg_match( '/^./u', $title, $match ) ? $match[0] : 'Ž';
$cats      = get_the_category( $post_id );
$category  = ! empty( $cats ) ? $cats[0] : null;
$thumbnail = get_the_post_thumbnail( $post_id, 'latvijai-card', array( 'loading' => 'lazy' ) );
?>
<article <?php post_class( 'post-card reveal', $post_id ); ?> style="--delay: <?php echo esc_attr( $index * 0.09 ); ?>s;">
	<a class="post-card-media" href="<?php echo esc_url( $permalink ); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( $thumbnail ) : ?>
			<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WordPress generated image markup. ?>
		<?php else : ?>
			<?php $post_signs = array( 'jumis', 'saule', 'mara', 'auseklis' ); ?>
			<span class="post-card-fallback"><?php echo latvijai_sign_svg( $post_signs[ $index % 4 ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG. ?></span>
		<?php endif; ?>
		<span class="post-card-index">Ž—<?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
	</a>

	<div class="post-card-body">
		<div class="post-card-meta">
			<?php if ( $category ) : ?>
				<a class="post-card-cat" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
			<?php else : ?>
				<span class="post-card-cat"><?php esc_html_e( 'Žurnāls', 'latvijai-futura' ); ?></span>
			<?php endif; ?>
			<span class="sep" aria-hidden="true"></span>
			<time datetime="<?php echo esc_attr( get_the_date( 'c', $post_id ) ); ?>"><?php echo esc_html( get_the_date( '', $post_id ) ); ?></time>
		</div>

		<h3 class="post-card-title">
			<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
		</h3>

		<p class="post-card-excerpt"><?php echo esc_html( $excerpt ); ?></p>

		<div class="post-card-foot">
			<span><?php echo esc_html( latvijai_reading_time( $post_id ) ); ?></span>
			<span class="post-card-arrow" aria-hidden="true">
				<?php latvijai_icon_e( 'arrow-up-right' ); ?>
			</span>
		</div>
	</div>
</article>
