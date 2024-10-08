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
    $custom_css = ".photographer-swiper-container {
      padding-top: var(--wp--preset--spacing--medium);
    }
    
    .swiper {
      margin-left: 0;
      margin-right: 0;     
      padding-bottom: 30px;
    }
    
    .swiper-button-next::after, .swiper-button-prev::after {
      color: #f5eb4a;
      font-size: 60px;
    }
    
    .mySwiper:hover {
      cursor: pointer;
    }
    
    .photographer-swiper-container .swiper-slide {      
      max-height: 100vh;
      max-width: 90%;
    }  
    
    .content-type-story-carousel .swiper-slide {
      max-width: 300px;
    }
    
    .content-type-story-carousel .swiper-slide:hover {
      cursor: pointer;
    }
    
    .swiper-slide-image-container {
      height: 80%;
    }
    
    .photographer-swiper-container .swiper-slide img {      
      width: 100%;
      height: 100%;
      object-fit: contain;
      max-height: 80vh;
    }
    
    .related-content-section.content-type-story-carousel .swiper-slide a {
      text-decoration: none;
    }
    
    .related-content-section.content-type-story-carousel .swiper-slide img {
      width: 100%;
        height: 100%;
        object-fit: cover;
      aspect-ratio: 4/3;
    }
    
    .swiper-slide p {
      font-size: var(--wp--preset--font-size--x-small);
      color: var(--wp--preset--color--charcoal);
      flex-basis: 20%;
      max-width: 400px;      
    }
    
    .related-content-section.content-type-story-carousel .swiper-slide h3 {
      font-weight: bold;
      font-size: var(--wp--preset--font-size--small);
    }
    
    .swiper-slide {
      width: auto;
    }
    
    .swiper-control-arrows {
      font-weight: bold;
      cursor: pointer;
      display: flex;
      justify-content: right;
      font-size: var(--wp--preset--font-size--medium);
    }
    
    .swiper-control-arrows .swiper-button-disabled {
      opacity: 0.35;
    }
    
    .read-story-link {
      font-size: var(--wp--preset--font-size--x-small);
    }
    
    @media (max-width: 800px) {
    
      .swiper-slide p {        
      max-width: 300px;        
      }
    
    }";
    wp_add_inline_style( 'related-content-external-css', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'enqueue_related_content_styles' );