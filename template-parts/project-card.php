<?php
/**
 * Project card.
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
		'demo'    => null,
		'index'   => 0,
		'url'     => '',
	)
);

$index  = (int) $card_args['index'];
$demo   = $card_args['demo'];
$tones  = array( 'ember', 'ice', 'violet' );
$tone   = $tones[ $index % 3 ];
$is_new = false;

if ( is_array( $demo ) ) {
	$demo = wp_parse_args(
		$demo,
		array(
			'title'        => '',
			'field'        => '',
			'status'       => '',
			'status_class' => 'active',
			'location'     => '',
			'excerpt'      => '',
			'url'          => '',
			'glyph'        => '',
			'tone'         => $tone,
			'image'        => null,
			'sample'       => true,
		)
	);

	$title        = $demo['title'];
	$field        = $demo['field'];
	$status       = $demo['status'];
	$status_class = $demo['status_class'];
	$location     = $demo['location'];
	$excerpt      = $demo['excerpt'];
	$url          = $demo['url'];
	$glyph        = '' !== $demo['glyph'] ? $demo['glyph'] : ( preg_match( '/^./u', $title, $match ) ? $match[0] : 'L' );
	$tone         = in_array( $demo['tone'], $tones, true ) ? $demo['tone'] : $tone;
	$image_id     = is_array( $demo['image'] ) && ! empty( $demo['image']['id'] ) ? (int) $demo['image']['id'] : 0;
	$thumbnail    = $image_id ? wp_get_attachment_image( $image_id, 'latvijai-card', false, array( 'loading' => 'lazy' ) ) : '';
	$is_new       = ! empty( $demo['sample'] );
} else {
	$post_id      = (int) $card_args['post_id'];
	$project_meta = latvijai_project_meta( $post_id );

	$title        = get_the_title( $post_id );
	$field        = latvijai_project_field( $post_id );
	$status       = $project_meta['status_label'];
	$status_class = $project_meta['status_class'];
	$location     = $project_meta['location'];
	$excerpt      = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post_id ) ), 24, '…' );
	$url          = get_permalink( $post_id );
	$thumbnail    = get_the_post_thumbnail( $post_id, 'latvijai-card', array( 'loading' => 'lazy' ) );
	$glyph        = preg_match( '/^./u', $title, $match ) ? $match[0] : 'L';
}

$is_external = ( is_array( $demo ) && preg_match( '#^https?://#i', $url ) && false === strpos( $url, home_url() ) );
$link_attrs  = $is_external ? ' target="_blank" rel="noopener noreferrer"' : '';
?>
<article class="project-card reveal tilt" style="--delay: <?php echo esc_attr( $index * 0.09 ); ?>s;">
	<a class="project-card-link" href="<?php echo esc_url( $url ); ?>"<?php echo $link_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static attribute string. ?>>
		<div class="project-media">
			<?php if ( $thumbnail ) : ?>
				<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WordPress generated image markup. ?>
			<?php else : ?>
				<div class="project-visual project-visual--<?php echo esc_attr( $tone ); ?>">
					<span class="project-glyph" aria-hidden="true"><?php echo esc_html( $glyph ); ?></span>
				</div>
			<?php endif; ?>

			<span class="project-status project-status--<?php echo esc_attr( $status_class ); ?>">
				<span class="dot" aria-hidden="true"></span>
				<?php echo esc_html( $status ); ?>
			</span>

			<span class="project-index" aria-hidden="true">P—<?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>

			<?php if ( $is_new ) : ?>
				<span class="project-demo"><?php esc_html_e( 'Paraugs', 'latvijai-futura' ); ?></span>
			<?php endif; ?>
		</div>

		<div class="project-body">
			<span class="project-field"><?php echo esc_html( $field ); ?></span>
			<h3 class="project-title"><?php echo esc_html( $title ); ?></h3>
			<p class="project-excerpt"><?php echo esc_html( $excerpt ); ?></p>

			<div class="project-footer">
				<span class="project-place">
					<?php latvijai_icon_e( 'pin' ); ?>
					<?php echo esc_html( $location ); ?>
				</span>
				<span class="project-arrow" aria-hidden="true">
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</span>
			</div>
		</div>
	</a>
</article>
