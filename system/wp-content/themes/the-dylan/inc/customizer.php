<?php
/**
 * Dylan Theme Customizer.
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function the_dylan_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}

add_action( 'customize_register', 'the_dylan_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_dylan_customize_preview_js() {
	wp_enqueue_script( 'the_dylan_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'the_dylan_customize_preview_js' );

if (!function_exists( 'the_dylan_theme_customizer' ) ) :
	function the_dylan_theme_customizer( $wp_customize ) {
		function the_dylan_sanitize_text_field( $str ) {
			return sanitize_text_field( $str );
		}

		function the_dylan_sanitize_textarea( $text ) {
			return esc_textarea( $text );
		}
		
		$wp_customize->add_panel( 'the_dylan_home_featured_panel', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __('Home Page Features', 'the-dylan'),
		) );
		//slider
		$wp_customize->add_section( 'the_dylan_slider_section' , array(
			'title'       => __( 'Slider', 'the-dylan' ),
			'priority'    => 20,
			'panel'  => 'the_dylan_home_featured_panel',
		) );

		$wp_customize->add_setting('the_dylan_display_slider_setting', array(
			'default'        => 1,
			'sanitize_callback' => 'the_dylan_sanitize_checkbox',
		));

		$wp_customize->add_control('the_dylan_display_slider_control', array(
			'settings' => 'the_dylan_display_slider_setting',
			'label'    => __('Display Slider', 'the-dylan'),
			'section'  => 'the_dylan_slider_section',
			'type'     => 'checkbox',
			'priority'	=> 24
		));

				
		$categories = get_categories();
				$cats = array();
				$i = 0;
				foreach($categories as $category){
					if($i==0){
						$default = $category->slug;
						$i++;
					}
					$cats[$category->slug] = $category->name;
				}
	

		//  =============================
		//  Select Box               
		//  =============================
		$wp_customize->add_setting('the_dylan_category_setting', array(
			'default' => '',
			'sanitize_callback' => 'the_dylan_sanitize_category',
		));

		$wp_customize->add_control('the_dylan_category_control', array(
			'settings' => 'the_dylan_category_setting',
			'type' => 'select',
			'label' => __('Select Category:', 'the-dylan'),
			'section' => 'the_dylan_slider_section',
			'choices' => $cats,
			'priority'	=> 24
		));
		
		//  Set Speed
		$wp_customize->add_setting( 'the_dylan_slider_speed_setting', array (
			'default' => '6000',
			'sanitize_callback' => 'the_dylan_sanitize_integer',
		) );
		
		$wp_customize->add_control('the_dylan_slider_speed', array(
			'label'    => __( 'Slider Speed (milliseconds)', 'the-dylan' ),
			'section'  => 'the_dylan_slider_section',
			'settings' => 'the_dylan_slider_speed_setting',
			'priority'	=> 24
		) );
		
		/**
		------------------------------------------------------------
		SECTION: Fonts
		------------------------------------------------------------
		**/
		$wp_customize->add_section('the_dylan_section_fonts', array(
			'title'		=> esc_html__('Typography', 'the-dylan'),
			'priority'	=> 30,
		));
		 
		/**
		Main Google Font Setting
		**/
		$wp_customize->add_setting( 'the_dylan_main_google_font_list', array(
			'default'           => 'Lato',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_setting( 'the_dylan_header_google_font_list', array(
			'default'           => 'Lato',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$font_choices = customizer_library_get_font_choices();
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'the_dylan_main_google_font_list', array(
			'id' => 'smartr_main_font',
			'label'   => __( 'Primary Font', 'the-dylan' ),
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => 'Lato',
			'section'    => 'the_dylan_section_fonts',
			'settings'   => 'the_dylan_main_google_font_list',
		)));
	
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'the_dylan_header_google_font_list', array(
			'id' => 'smartr_headers_font',
			'label'   => __( 'Header Font', 'the-dylan' ),
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => 'Lato',
			'section'    => 'the_dylan_section_fonts',
			'settings'   => 'the_dylan_header_google_font_list',
		)));

		/*Link color option */
		$wp_customize->add_setting( 'the_dylan_link_color_setting', array (
			'default'     => '#6ce3df',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_dylan_link_color', array(
			'label'    => __( 'Link Color Option', 'the-dylan' ),
			'section'  => 'colors',
			'settings' => 'the_dylan_link_color_setting',
		) ) );
		
		/*Header/footer background color option */
		$wp_customize->add_setting( 'the_dylan_footer_background_setting', array (
			'default'     => '#252525',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_dylan_footer_background_color', array(
			'label'    => __( 'Header/Footer Background Option', 'the-dylan' ),
			'section'  => 'colors',
			'settings' => 'the_dylan_footer_background_setting',
		) ) );
		
		/*Sub menu background */
		$wp_customize->add_setting( 'the_dylan_submenu_background_setting', array (
			'default'     => '#002157',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_dylan_submenu_background_color', array(
			'label'    => __( 'Submenu Background Option', 'the-dylan' ),
			'section'  => 'colors',
			'settings' => 'the_dylan_submenu_background_setting',
		) ) );
	}
endif;

add_action('customize_register', 'the_dylan_theme_customizer');


/**
 * Sanitize integer input
 */
if ( ! function_exists( 'the_dylan_sanitize_integer' ) ) :
	function the_dylan_sanitize_integer( $input ) {		
		return absint($input);
	}
endif;

/**
 * Sanitize checkbox
 */

if (!function_exists( 'the_dylan_sanitize_checkbox' ) ) :
	function the_dylan_sanitize_checkbox( $input ) {
		if ( $input != 1 ) {
			return 0;
		} else {
			return 1;
		}
	}
endif;

if ( ! function_exists( 'the_dylan_sanitize_category' ) ){
	function the_dylan_sanitize_category( $input ) {
		$categories = get_categories();
		$cats = array();
		$i = 0;
		foreach($categories as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->slug] = $category->name;
		}
		$valid = $cats;

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';

		}
	}
}




/**
* Apply Color Scheme
*/
if ( ! function_exists( 'the_dylan_apply_color' ) ) :
  function the_dylan_apply_color() {
	?>
	<style id="color-settings">
		<?php if (get_theme_mod('the_dylan_main_google_font_list') ) { ?>
			body, p{
				font-family:<?php echo esc_html(get_theme_mod('the_dylan_main_google_font_list')); ?>
			}
		<?php } ?>
		<?php if (get_theme_mod('the_dylan_header_google_font_list') ) { ?>
			h1, h2, h3, h4, h5, h6{
				font-family:<?php echo esc_html(get_theme_mod('the_dylan_header_google_font_list')); ?>
			}
		<?php } ?>
		<?php if (get_theme_mod('the_dylan_link_color_setting') ) { ?>
			.site-footer a,
			#footer-menu li a:hover,
			#footer-menu li.current-menu-item a,
			.read_more:hover,
			.page-numbers.current,
			.site-footer h1,
			input[type="submit"]:hover,
			.carousel-content-bg a:hover,
			.entry-title a:hover,
			.site-title a:hover,
			.slide-bar ul li a:hover,
			.main-navigation li a:hover{
					color:<?php echo esc_html(get_theme_mod('the_dylan_link_color_setting')); ?>
			}
			input[type="submit"],
			a.read_more{
					background:<?php echo esc_html(get_theme_mod('the_dylan_link_color_setting')); ?>;
					border:solid 1px <?php echo esc_html(get_theme_mod('the_dylan_link_color_setting')); ?>
			}
			.fa-chevron-right,
			.fa-chevron-left, .widget-title span{
				background:<?php echo esc_html(get_theme_mod('the_dylan_link_color_setting')); ?>
			}
		<?php } ?>
		
		<?php if (get_theme_mod('the_dylan_footer_background_setting') ) { ?>
			.site-footer, .site-footer p, #branding-wrapper, .header-container, #home-slider{
				background:<?php echo esc_html(get_theme_mod('the_dylan_footer_background_setting')); ?>
			}
		<?php } ?>
		<?php if (get_theme_mod('the_dylan_submenu_background_setting') ) { ?>
			.main-navigation ul ul{
				background:<?php echo esc_html(get_theme_mod('the_dylan_submenu_background_setting')); ?>
			}
			@media screen and (max-width: 599px){
				.main-navigation ul{
					background:<?php echo esc_html(get_theme_mod('the_dylan_submenu_background_setting')); ?>
				}
			}
		<?php } ?>
		</style>
	<?php	  
  }
endif;
add_action( 'wp_head', 'the_dylan_apply_color' );