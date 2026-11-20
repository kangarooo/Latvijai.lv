<?php
/**
 * Reusable page hero.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_args = wp_parse_args(
	$args ?? array(),
	array(
		'eyebrow'     => '',
		'title'       => '',
		'description' => '',
		'meta'        => '',
		'center'      => false,
	)
);
?>
<section class="page-hero<?php echo $hero_args['center'] ? ' page-hero--center' : ''; ?>">
	<div class="container">
		<?php if ( '' !== $hero_args['eyebrow'] ) : ?>
			<p class="eyebrow"><?php echo wp_kses_post( $hero_args['eyebrow'] ); ?></p>
		<?php endif; ?>

		<h1 class="page-title"><?php echo wp_kses_post( $hero_args['title'] ); ?></h1>

		<?php if ( '' !== $hero_args['description'] ) : ?>
			<div class="page-deck"><?php echo wp_kses_post( wpautop( $hero_args['description'] ) ); ?></div>
		<?php endif; ?>

		<?php if ( '' !== $hero_args['meta'] ) : ?>
			<div class="page-meta"><?php echo wp_kses_post( $hero_args['meta'] ); ?></div>
		<?php endif; ?>
	</div>
</section>
