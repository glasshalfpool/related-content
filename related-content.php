<?php
/**
 * Plugin Name:       Related Content
 * Description:       Custom block to show related content on the We Feed the UK website
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.3.0
 * Author:            Jamie Glasspool
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       related-content
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_related_content_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_related_content_block_init' );

/**
 * Enqueue external CSS and add inline styles.
 */
function enqueue_related_content_styles() {
    // Enqueue the external CSS file
    wp_enqueue_style( 'related-content-external-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

    // Add inline CSS
    $custom_css = "";
    wp_add_inline_style( 'related-content-external-css', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'enqueue_related_content_styles' );