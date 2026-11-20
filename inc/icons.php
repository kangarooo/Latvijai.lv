<?php
/**
 * Inline SVG icon system.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return an inline SVG icon.
 *
 * @param string $name  Icon slug.
 * @param string $class Optional extra CSS classes.
 * @return string
 */
function latvijai_icon( $name, $class = '' ) {
	static $icons = null;

	if ( null === $icons ) {
		$icons = array(
			'arrow-up-right' => '<path d="M7 17 17 7M8 7h9v9"/>',
			'arrow-right'    => '<path d="M4 12h16m-6-6 6 6-6 6"/>',
			'arrow-down'     => '<path d="M12 4v16m-6-6 6 6 6-6"/>',
			'arrow-up'       => '<path d="M12 20V4m-6 6 6-6 6 6"/>',
			'chevron-left'   => '<path d="m15 18-6-6 6-6"/>',
			'chevron-right'  => '<path d="m9 18 6-6-6-6"/>',
			'search'         => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
			'close'          => '<path d="M6 6l12 12M18 6 6 18"/>',
			'menu'           => '<path d="M4 7h16M4 12h16M4 17h10"/>',
			'heart'          => '<path d="M20.8 5.6a5.4 5.4 0 0 0-7.7 0L12 6.7l-1.1-1.1a5.4 5.4 0 1 0-7.7 7.7L12 22l8.8-8.7a5.4 5.4 0 0 0 0-7.7Z"/>',
			'spark'          => '<path d="M12 2.5 14 8.8l6.3 2-6.3 2L12 19l-2-6.2-6.3-2 6.3-2L12 2.5Z"/><path d="M19 16.5 19.7 18.6 21.8 19.3 19.7 20 19 22.1 18.3 20 16.2 19.3 18.3 18.6 19 16.5Z"/>',
			'pin'            => '<path d="M12 21.3s7-5.5 7-11.3a7 7 0 1 0-14 0c0 5.8 7 11.3 7 11.3Z"/><circle cx="12" cy="10" r="2.4"/>',
			'clock'          => '<circle cx="12" cy="12" r="8.5"/><path d="M12 7v5.4l3.4 2"/>',
			'mail'           => '<rect x="3" y="5" width="18" height="14" rx="2.5"/><path d="m4 7 8 6 8-6"/>',
			'share'          => '<circle cx="18" cy="5" r="2.6"/><circle cx="6" cy="12" r="2.6"/><circle cx="18" cy="19" r="2.6"/><path d="m8.4 10.8 7.2-4.4M8.4 13.2l7.2 4.4"/>',
			'copy'           => '<rect x="8.5" y="8.5" width="11" height="11" rx="2"/><path d="M15.5 8.5v-2a2 2 0 0 0-2-2h-7a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h2"/>',
			'check'          => '<path d="m4.5 12.5 5 5 10-11"/>',
			'globe'          => '<circle cx="12" cy="12" r="8.5"/><path d="M3.5 12h17M12 3.5c2.2 2.3 3.3 5.3 3.3 8.5S14.2 18.2 12 20.5C9.8 18.2 8.7 15.2 8.7 12S9.8 5.8 12 3.5Z"/>',
			'facebook'       => '<path d="M14 8.7V6.9c0-.8.2-1.3 1.4-1.3H17V2.7c-.3 0-1.3-.1-2.4-.1-2.3 0-3.9 1.4-3.9 4v2.1H8.2v3h2.5v9.6H14v-9.6h2.9l.4-3H14Z" fill="currentColor" stroke="none"/>',
			'instagram'      => '<rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="3.8"/><circle cx="17.3" cy="6.8" r="1" fill="currentColor" stroke="none"/>',
			'linkedin'       => '<path d="M5 9h3v11H5V9Zm1.5-5.3a1.8 1.8 0 1 1 0 3.6 1.8 1.8 0 0 1 0-3.6ZM10 9h2.8v1.5h.1c.4-.8 1.5-1.7 3.1-1.7 3.2 0 3.8 2.1 3.8 4.9V20h-3v-5.4c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9V20H10V9Z" fill="currentColor" stroke="none"/>',
			'youtube'        => '<rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="m10.5 9.2 5 2.8-5 2.8V9.2Z" fill="currentColor" stroke="none"/>',
			'x'              => '<path d="M4 4l7.4 9L4.5 20h2.6l5.6-6.1L17 20h3l-7.9-9.5L19.4 4h-2.6l-5.1 5.6L7 4H4Z" fill="currentColor" stroke="none"/>',
			'external'       => '<path d="M14 4h6v6M20 4l-9 9"/><path d="M19 13v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5"/>',
			'bolt'           => '<path d="M13 2 4.5 13.5H11L10 22l8.5-11.5H12L13 2Z"/>',
		);
	}

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$classes = 'icon';
	if ( '' !== $class ) {
		$classes .= ' ' . $class;
	}

	return '<svg class="' . esc_attr( $classes ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}

/**
 * Echo an inline SVG icon.
 *
 * @param string $name  Icon slug.
 * @param string $class Optional extra CSS classes.
 */
function latvijai_icon_e( $name, $class = '' ) {
	echo latvijai_icon( $name, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Internal SVG markup.
}

/**
 * The theme mark used as a fallback logo.
 *
 * @param string $class Optional CSS class.
 * @return string
 */
function latvijai_mark( $class = 'brand-mark' ) {
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 48 48" fill="none" aria-hidden="true" focusable="false">'
		. '<path d="M24 2.5 45.5 24 24 45.5 2.5 24 24 2.5Z" stroke="currentColor" stroke-width="1.2" opacity=".35"/>'
		. '<path d="M24 10.5 37.5 24 24 37.5 10.5 24 24 10.5Z" stroke="currentColor" stroke-width="1.4"/>'
		. '<circle cx="24" cy="24" r="5.4" fill="#e11d3f"/>'
		. '<path d="M24 2.5v6M24 39.5v6M2.5 24h6M39.5 24h6" stroke="currentColor" stroke-width="1.2" opacity=".6"/>'
		. '</svg>';
}
