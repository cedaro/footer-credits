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
 * Footer credits class.
 *
 * @package FooterCredits
 * @since 1.0.0
 */
class Cedaro_Footer_Credits {
	/**
	 * Load the credits functionality.
	 *
	 * @since 1.0.0
	 */
	public function load() {
		$this->load_textdomain();

		$filter = sprintf( '%s_credits', str_replace( '/src', '', get_template() ) );
		add_filter( $filter, array( $this, 'credits_text' ), 1000 );
		add_filter( 'footer_credits', array( $this, 'credits_text' ), 1000 );

		add_action( 'customize_register', array( $this, 'customize_register' ), 20 );
	}

	/**
	 * Update the credits text.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text Credits text.
	 * @return string
	 */
	public function credits_text( $text ) {
		$settings = wp_parse_args( (array) get_option( 'footer_credits' ), array(
			'placement' => '',
			'text'      => '',
		) );

		switch ( $settings['placement'] ) {
			case 'after' :
				$text .= ' ' . $settings['text'];
				break;
			case 'before' :
				$text = $settings['text'] . ' ' . $text;
				break;
			case 'remove' :
				$text = '';
				break;
			case 'replace' :
				$text = $settings['text'];
				break;
		}

		$search  = array( '{{year}}' );
		$replace = array( date( 'Y' ) );
		$text    = str_replace( $search, $replace, $text );

		$text = wptexturize( trim( $text ) );
		$text = convert_chars( $text );
		$text = $this->allowed_tags( $text );

		return $text;
	}

	/**
	 * Register Customizer settings.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager object.
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_section( 'footer_credits', array(
			'title'    => __( 'Credits', 'footer-credits' ),
			'priority' => 1000,
		) );

		$wp_customize->add_setting( 'footer_credits[text]', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'allowed_tags' ),
			'type'              => 'option',
		) );

		$wp_customize->add_control( 'footer_credits_text', array(
			'label'    => __( 'Credits', 'footer-credits' ),
			'section'  => 'footer_credits',
			'settings' => 'footer_credits[text]',
			'type'     => 'textarea',
		) );

		$wp_customize->add_setting( 'footer_credits[placement]', array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type'              => 'option',
		) );

		$wp_customize->add_control( 'footer_credits_placement', array(
			'choices'  => array(
				''        => '',
				'before'  => __( 'Before', 'footer-credits' ),
				'after'   => __( 'After', 'footer-credits' ),
				'replace' => __( 'Replace', 'footer-credits' ),
				'remove'  => __( 'Remove All', 'footer-credits' )
			),
			'label'    => __( 'Placement', 'footer-credits' ),
			'section'  => 'footer_credits',
			'settings' => 'footer_credits[placement]',
			'type'     => 'select',
		) );
	}

	/**
	 * Allow only the $allowedtags array in a string.
	 *
	 * @since  1.0.0
	 *
	 * @param string $string Unsanitized string.
	 * @return string Sanitized string.
	 */
	public function allowed_tags( $text ) {
		$allowedtags = wp_kses_allowed_html();
		$allowedtags['a']['rel'] = true;
		$allowedtags['br']       = array();

		return wp_kses( $text, $allowedtags );
	}

	/**
	 * Localize the plugin's strings.
	 *
	 * @since 1.0.0
	 */
	protected function load_textdomain() {
		$plugin_rel_path = dirname( plugin_basename( __FILE__ ) ) . '/languages';
		load_plugin_textdomain( 'footer-credits', false, $plugin_rel_path );
	}
}

/**
 * Load the plugin.
 */
$footer_credits = new Cedaro_Footer_Credits();
add_action( 'plugins_loaded', array( $footer_credits, 'load' ) );
