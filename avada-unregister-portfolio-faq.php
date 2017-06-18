<?php 
/**
 *
 * Plugin Name: Avada Unregister Portfolio and FAQ Content Types
 * Plugin URI: https://github.com/ichderfisch/avada-unregister-portfolio-faq
 * Description: Remove Avada's custom content types 'Portfolio' and 'FAQ'
 * Version: 0.1.0
 * Author: Dennis Fischer
 * Author URI: http://www.ichderfisch.de
 * Text-Domain: avada-unregister-portfolio-faq
 */

// Prevent direct file access.
if ( !defined ('ABSPATH') ) exit;

/**
 * Runs only when the plugin is activated.
 * @since 0.1.0
 */
function avada_unregister_portfolio_faq_activation_hook() {
 
    /* Create transient data */
    set_transient( 'avada_unregister_portfolio_faq_check', true, 5 );
}

/* Register activation hook. */
register_activation_hook( __FILE__, 'avada_unregister_portfolio_faq_activation_hook' );

/**
 * Runs only when the plugin is activated.
 * @since 0.1.0
 */
function avada_unregister_portfolio_faq_deactivation_hook() {
 
    // check if transient exists (= Fusion Core not found) and remove it deactivation of the plugin

    if( get_transient( 'avada_unregister_portfolio_faq_check' )) {
        /* Delete transient data */
        delete_transient( 'avada_unregister_portfolio_faq_check');
    }

}
/* Register deactivation hook. */
register_deactivation_hook( __FILE__, 'avada_unregister_portfolio_faq_deactivation_hook' );

/**
 * Runs only when the plugin is activated.
 * @since 0.1.0
 */
// FAQ and Portfolio are part of the Fusion Core Plugin. First check if it's activated.
function avada_unregister_portfolio_faq_init() {

    if ( class_exists( 'FusionCore_Plugin' ) ) {

        function avada_unregister_portfolio_faq() {
            unregister_post_type( 'avada_portfolio' );
            unregister_post_type( 'avada_faq' );
        }

        function avada_unregister_portfolio_faq_success() { 

            if ( get_transient( 'avada_unregister_portfolio_faq_check' ) ) { ?>

                <div class="updated notice is-dismissible">
                    <p><?php _e( 'Plugin <strong>activated</strong>. "Portfolio" and "FAQ Content Types are deactivated."', 'avada-unregister-portfolio-faq' ); ?></p>
                </div>

                <?php
                /* Delete transient, only display this notice once. */
                delete_transient( 'avada_unregister_portfolio_faq_check' );
            }
        }

        add_action( 'admin_notices', 'avada_unregister_portfolio_faq_success');
        add_action( 'init', 'avada_unregister_portfolio_faq', 100 );

    } 
    else {

        function avada_unregister_portfolio_faq_error() { ?>
            <div class="updated error is-dismissable">
                <p><?php _e( 'Avada <i>Fusion Core</i>-Plugin is not installed. You can deactivate <i>Avada Unregister Portfolio and FAQ Content Types</i>', 'avada-unregister-portfolio-faq' ); ?></p>
            </div>
            <?php
        }

        add_action( 'admin_notices', 'avada_unregister_portfolio_faq_error' );

    }
}
add_action( 'plugins_loaded', 'avada_unregister_portfolio_faq_init' );
