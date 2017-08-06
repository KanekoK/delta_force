<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses the_dylan_header_style()
 * @uses the_dylan_admin_header_style()
 * @uses the_dylan_admin_header_image()
 */
function the_dylan_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'the_dylan_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '#ffffff',
		'width'                  => 1170,
		'height'                 => 160,
		'flex-height'            => true,
		'wp-head-callback'       => 'the_dylan_header_style',
		'admin-head-callback'    => 'the_dylan_admin_header_style',
		'admin-preview-callback' => 'the_dylan_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'the_dylan_custom_header_setup' );

if ( ! function_exists( 'the_dylan_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see the_dylan_custom_header_setup().
 */
function the_dylan_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description,
		.main-navigation a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // the_dylan_header_style

if ( ! function_exists( 'the_dylan_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see the_dylan_custom_header_setup().
 */
function the_dylan_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // the_dylan_admin_header_style


