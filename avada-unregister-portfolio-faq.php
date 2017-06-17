<?php 
/**
 *
 * Plugin Name: Avada Unregister Portfolio and FAQ Content Types
 * Plugin URI:
 * Description: Remove Avada's custom content types 'Portfolio' and 'FAQ'
 * Version: 0.1.0
 * Author: Dennis Fischer
 * Author URI: http://www.ichderfisch.de
 */

// Prevent direct file access.
if (!defined ('ABSPATH')) exit;

function avada_unregister_portfolio_faq() {
    unregister_post_type( 'avada_portfolio' );
    unregister_post_type( 'avada_faq' );
}
add_action('init','avada_unregister_portfolio_faq', 100);