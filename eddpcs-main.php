<?php
/*
Plugin Name: Easy Digital Downloads Product Carousel Slider
Plugin URI:  http://adlplugins.com/plugin/easy-digital-downloads-product-carousel-slider
Description: This plugin allows you to easily create Easy Digital Downloads product carousel slider. It is fully responsive and mobile friendly carousel slider which comes with lots of features including advanced Shortcode Generator.
Version:     1.3
Author:      ADL Plugins
Author URI:  http://adlplugins.com
License:     GPL2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages/
Text Domain: product-carousel-slider-for-easy-digital-downloads
*/

/**
 * Protect direct access
 */
if( ! defined( 'EDDPCS_HACK_MSG' ) ) define( 'EDDPCS_HACK_MSG', __( 'Sorry! This is not your place!', 'product-carousel-slider-for-easy-digital-downloads' ) );
if ( ! defined( 'ABSPATH' ) ) die( EDDPCS_HACK_MSG );

/**
 * Defining constants
 */
if( ! defined( 'EDDPCS_PLUGIN_DIR' ) ) define( 'EDDPCS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'EDDPCS_PLUGIN_URI' ) ) define( 'EDDPCS_PLUGIN_URI', plugins_url( '', __FILE__ ) );

require_once EDDPCS_PLUGIN_DIR . 'eddpcs-metabox.php';
require_once EDDPCS_PLUGIN_DIR . 'eddpcs-img-resizer.php';
require_once EDDPCS_PLUGIN_DIR . 'eddpcs-shortcodes.php';

/**
 * Registers scripts and stylesheets
 */
function eddpcs_frontend_scripts_and_styles() {
	wp_register_style( 'eddpcs-custom-style', EDDPCS_PLUGIN_URI . '/css/eddpcs-styles.css' );
	wp_register_style( 'eddpcs-owl-carousel-style', EDDPCS_PLUGIN_URI . '/css/owl.carousel.css' );
	wp_register_style( 'eddpcs-owl-theme-style', EDDPCS_PLUGIN_URI . '/css/owl.theme.css' );
	wp_register_style( 'eddpcs-owl-transitions', EDDPCS_PLUGIN_URI . '/css/owl.transitions.css' );
	wp_register_style( 'eddpcs-font-awesome', EDDPCS_PLUGIN_URI . '/css/font-awesome.min.css' );
	wp_register_script( 'eddpcs-owl-carousel-js', EDDPCS_PLUGIN_URI . '/js/owl.carousel.min.js', array('jquery'),'1.3.3', true );
}
add_action( 'wp_enqueue_scripts', 'eddpcs_frontend_scripts_and_styles' );

function eddpcs_admin_scripts_and_styles() {
	global $typenow;	
	if ( ($typenow == 'eddcarousel') ) {
	wp_enqueue_style( 'eddpcs_custom_wp_admin_css', EDDPCS_PLUGIN_URI . '/css/eddpcs-admin-styles.css' );
	wp_enqueue_style( 'eddpcs_meta_fields_css', EDDPCS_PLUGIN_URI . '/css/cmb2.min.css' );
	wp_enqueue_script( 'eddpcs_custom_wp_admin_js', EDDPCS_PLUGIN_URI . '/js/eddpcs-admin-script.js', array('jquery'), '1.3.3', true  );
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'eddpcs-wp-color-picker', EDDPCS_PLUGIN_URI . '/js/eddpcs-color-picker.js', array( 'wp-color-picker' ), false, true );  
	}
}
add_action( 'admin_enqueue_scripts', 'eddpcs_admin_scripts_and_styles' );

/**
 * Enables shortcode for Widget
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Load plugin textdomain
 */
function eddpcs_load_textdomain() {
	load_plugin_textdomain( 'product-carousel-slider-for-easy-digital-downloads', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'eddpcs_load_textdomain');

/**
 * Pro Version link
 */
function eddpcs_pro_version_link( $links ) {
   $links[] = '<a href="http://adlplugins.com/plugin/product-carousel-slider-for-easy-digital-downloads-pro" target="_blank">Pro Version</a>';
   return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'eddpcs_pro_version_link' );

/**
 * Upgrade & Support submenu pages
 */
function eddpcs_upgrade_support_submenu_pages() {
	add_submenu_page( 'edit.php?post_type=eddcarousel', __('Upgrade', 'product-carousel-slider-for-easy-digital-downloads'), __('Upgrade', 'product-carousel-slider-for-easy-digital-downloads'), 'manage_options', 'upgrade', 'eddpcs_upgrade_callback' );
	add_submenu_page( 'edit.php?post_type=eddcarousel', __('Support', 'product-carousel-slider-for-easy-digital-downloads'), __('Support', 'product-carousel-slider-for-easy-digital-downloads'), 'manage_options', 'support', 'eddpcs_support_callback' );
}
add_action('admin_menu', 'eddpcs_upgrade_support_submenu_pages');

function eddpcs_upgrade_callback() {
	include('eddpcs-upgrade.php');
}

function eddpcs_support_callback() { 
	include('eddpcs-support.php');
}


