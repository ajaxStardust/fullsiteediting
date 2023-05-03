<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package full-site-editing
 * @since 1.0.0
 */

/**
 * The theme version.
 *
 * @since 1.0.0
 */
define( 'FULL_SITE_EDITING_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Add theme support.
 */
function full_site_editing_setup() {
	add_theme_support( 'wp-block-styles' );
	add_editor_style( './assets/css/style-shared.min.css' );

	/*
	 * Load additional block styles.
	 * See details on how to add more styles in the readme.txt.
	 */
	$styled_blocks = [ 'button', 'file', 'quote', 'search' ];
	foreach ( $styled_blocks as $block_name ) {
		$args = array(
			'handle' => "full-site-editing-$block_name",
			'src'    => get_theme_file_uri( "assets/css/blocks/$block_name.min.css" ),
			'path'   => get_theme_file_path( "assets/css/blocks/$block_name.min.css" ),
		);
		// Replace the "core" prefix if you are styling blocks from plugins.
		wp_enqueue_block_style( "core/$block_name", $args );
	}
}
add_action( 'after_setup_theme', 'full_site_editing_setup' );

/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function full_site_editing_styles() {
	wp_enqueue_style(
		'full-site-editing-style',
		get_stylesheet_uri(),
		[],
		FULL_SITE_EDITING_VERSION
	);
	wp_enqueue_style(
		'full-site-editing-shared-styles',
		get_theme_file_uri( 'assets/css/style-shared.min.css' ),
		[],
		FULL_SITE_EDITING_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'full_site_editing_styles' );

// Block style examples.
require_once get_theme_file_path( 'inc/register-block-styles.php' );

// Block pattern helper for the privacy policy.
require_once get_theme_file_path( 'inc/block-pattern-helper.php' );
