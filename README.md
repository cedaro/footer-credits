# Footer Credits

A WordPress plugin for making theme footer credits editable.

__Contributors:__ [Brady Vercher](https://twitter.com/bradyvercher)  
__Requires:__ WordPress 4.0+  
__License:__ [GPL-2.0+](http://www.gnu.org/licenses/gpl-2.0.html)


## Description

**This plugin only works with themes that have added support.**

*Footer Credits* provides a standardized method for making theme credits editable. It registers a new section and fields in the Customizer for modifying the credits and choosing how they appear.

Theme authors, let your users and customers know your theme supports the *Footer Credits* plugin.


## Installation

*Footer Credits* is available in the [WordPress plugin directory](http://wordpress.org/plugins/footer-widgets/), so it can be installed from your admin panel.


## Usage

After installing and activating:

1. Go to *Appearance &rarr; Customize* in your admin panel
2. Open the **Credits** section
3. Add some text to the **Credits** text area
4. Choose whether your custom text appears before, after, or replaces the default credits.

*Tip: Insert {{year}} in your text to have the year update automatically.*

![Footer Credits Customizer Screenshot](https://raw.github.com/cedaro/footer-credits/master/screenshot-1.png)  
_The Customizer section and fields._


## Adding Support

If you're a theme author and want to add support, all you need to do is pass the default credits string through a `footer_credits` filter.

**1. Create a template tag with the default credits and filter:**

```php
<?php
if ( ! function_exists( 'themename_credits' ) ) :
/**
 * Theme credits text.
 */
function themename_credits() {
	$text = sprintf( __( '%s by Cedaro.', 'themename' ),
		'<a href="http://www.cedaro.com/wordpress/themes/hyalite/">Hyalite</a>'
	);

	echo apply_filters( 'footer_credits', $text );
}
endif;
```

**2. Then call the template tag somewhere in the footer of the theme:**

```php
<footer class="site-footer">
	<div class="credits">
		<?php themename_credits(); ?>
	</div>
</footer>
```
