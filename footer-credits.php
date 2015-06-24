<?php
/**
 * Footer Credits
 *
 * @package   FooterCredits
 * @author    Brady Vercher
 * @link      https://github.com/cedaro/footer-credits
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Footer Credits
 * Plugin URI:  https://wordpress.org/plugins/footer-credits
 * Description: A Customizer control for editing footer credits.
 * Version:     1.0.0
 * Author:      Cedaro
 * Author URI:  http://www.cedaro.com/?utm_source=wordpress-plugin&utm_medium=link&utm_content=footer-credits-author-uri&utm_campaign=plugins
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: footer-credits
 * Domain Path: /languages
 */

/**
 * Load the footer credits class if it doesn't exist.
 */
if ( ! class_exists( '' ) ) {
	include( dirname( __FILE__ ) . '/class-footer-credits.php' );
}

/**
 * Localize the plugin.
 *
 * @since 1.0.0
 */
function cedaro_footer_credits_load_textdomain() {
	$plugin_rel_path = dirname( plugin_basename( __FILE__ ) ) . '/languages';
	load_plugin_textdomain( 'footer-credits', false, $plugin_rel_path );
}
add_action( 'plugins_loaded', 'cedaro_footer_credits_load_textdomain' );

/**
 * Load the plugin.
 */
$footer_credits = new Cedaro_Footer_Credits();
add_action( 'after_setup_theme', array( $footer_credits, 'register_hooks' ) );
