<?php
/**
 * Plugin Name:       Blockylicious
 * Plugin URI:        https://wordpress.org/plugins/blockylicious/
 * Description:       a plugin of funcy blocks.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Shariful Haque
 * Author URI:        https://profiles.wordpress.org/mdsharifulhaque
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blockylicious
 *
 * @package CreateBlock
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function create_block_blockylicious_block_init()
{

	if (function_exists('wp_register_block_types_from_metadata_collection')) {
		wp_register_block_types_from_metadata_collection(__DIR__ . '/build/blocks', __DIR__ . '/build/blocks-manifest.php');
		return;
	}

	if (function_exists('wp_register_block_metadata_collection')) {
		wp_register_block_metadata_collection(__DIR__ . '/build/blocks', __DIR__ . '/build/blocks-manifest.php');
	}

	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach (array_keys($manifest_data) as $block_type) {
		register_block_type(__DIR__ . "/build/blocks/{$block_type}");
	}
}
add_action('init', 'create_block_blockylicious_block_init');