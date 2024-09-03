# Footer Credits

Contributors: cedaro, bradyvercher
Tags: credits, footer, credits, site credits, customizer, copyright, colophon
Requires at least: 6.0
Tested up to: 6.6
Stable tag: 1.1.0
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A Customizer control to make footer credits editable.


## Description

**This plugin only works with themes that have added support.**

Footer Credits provides a standardized method for making theme credits editable. It registers a new section and fields in the Customizer for modifying the credits and choosing how they appear.

Theme authors, let your users and customers know your theme supports the Footer Credits plugin.

If your theme doesn't work with Footer Credits, ask the developer to add support. Instructions can be find in the [Other Notes](https://wordpress.org/plugins/footer-credits/other_notes/) section.


### Additional Resources

* [Write a review](https://wordpress.org/support/view/plugin-reviews/footer-credits#postform)
* [Contribute on GitHub](https://github.com/cedaro/footer-credits)
* [Follow @cedaroco](https://twitter.com/cedaroco)
* [Visit Cedaro](https://www.cedaro.com/?utm_source=wordpress.org&utm_medium=link&utm_content=footer-credits-readme&utm_campaign=plugins)


## Installation

Install like most other plugins. [Check out the codex](https://codex.wordpress.org/Managing_Plugins#Installing_Plugins) if you have any questions.

### Usage

After installing:

1. Go to *Appearance &rarr; Customize* in your admin panel
2. Open the **Credits** section
3. Add some text to the **Credits** text area
4. Choose whether your custom text appears before, after, or replaces the default credits.

*Tip: Insert {{year}} in your text to have the year update automatically.*


## Screenshots

1. The Customizer section and fields.


## Notes

If you're a theme author and want to add support, all you need to do is pass the default credits string through a `footer_credits` filter.

### 1. Create a template tag with the default credits and filter:

`<?php
if ( ! function_exists( 'themename_credits' ) ) :
/**
 * Theme credits text.
 */
function themename_credits() {
	$text = sprintf( __( '%s by Cedaro.', 'themename' ),
		'<a href="https://www.cedaro.com/wordpress/themes/hyalite/">Hyalite</a>'
	);

	echo apply_filters( 'footer_credits', $text );
}
endif;`

### 2. Then call the template tag somewhere in the footer of the theme:

`<footer class="site-footer">
	<div class="credits">
		<?php themename_credits(); ?>
	</div>
</footer>`

## Changelog

### 1.1.0 - December 2, 2016
* Removed the call to `load_plugin_textdomain()` in favor of [just-in-time text domain loading](https://make.wordpress.org/core/2016/07/06/i18n-improvements-in-4-6/) available since WordPress 4.6.
* Updated URLs to https where possible.

### 1.0.0
* Initial release.
