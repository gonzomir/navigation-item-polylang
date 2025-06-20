<?php

namespace Gonzo\NavigationItemPolylang;

define( __NAMESPACE__ . '\\BLOCKS_PATH', dirname( __DIR__ ) . '/build' );

/**
 * Hook everything.
 *
 * @return void
 */
function bootstrap() {
	add_action( 'init', __NAMESPACE__ . '\\block_init' );
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\block_editor_assets' );
	add_filter( 'block_core_navigation_listable_blocks', __NAMESPACE__ . '\\wrap_language_switcher' );
}


/**
 * Register block(s).
 *
 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function block_init() {
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata.
	 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( BLOCKS_PATH, BLOCKS_PATH . '/blocks-manifest.php' );
		return;
	}

	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` file.
	 * Added to WordPress 6.7 to improve the performance of block type registration.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( BLOCKS_PATH, BLOCKS_PATH . '/blocks-manifest.php' );
	}
	/**
	 * Registers the block type(s) in the `blocks-manifest.php` file.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	$manifest_data = require BLOCKS_PATH . '/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( BLOCKS_PATH . '/' . $block_type );
	}
}

/**
 * Enqueue block editor assets.
 *
 * Enqueues the block editor script for extending the navigation block.
 *
 * @return void
 */
function block_editor_assets() {
	$editor_meta = require BLOCKS_PATH . '/editor.asset.php';

	wp_enqueue_script(
		'navigation-item-polylang-block-editor',
		plugins_url( 'build/editor.js', __DIR__ ),
		$editor_meta['dependencies'],
		$editor_meta['version']
	);

	wp_enqueue_style(
		'navigation-item-polylang-block-editor-style',
		plugins_url( 'build/editor.css', __DIR__ ),
		[],
		$editor_meta['version']
	);
}

/**
 * Wraps the language switcher block in a list element.
 *
 * @param array $blocks The list of blocks that can will be wrapped with list items.
 * @return array The modified list of blocks.
 */
function wrap_language_switcher( $blocks ) {
	$blocks[] = 'gonzomir/polylang-language-switcher';
	return $blocks;
}
