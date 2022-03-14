<?php
/**
 * inpress Theme Customizer
 *
 * @package inpress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function inpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'inpress_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'inpress_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'inpress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function inpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function inpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function inpress_customize_preview_js() {
	wp_enqueue_script( 'inpress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'inpress_customize_preview_js' );

/*Font Customiser*/
new theme_customizer();

class theme_customizer {
	public function __construct() {
		add_action( 'customize_register', array(&$this, 'customize_inpress' ));
	}

	/**
	 * Customizer manager demo
	 * @param  WP_Customizer_Manager $wp_manager
	 * @return void
	 */
	public function customize_inpress( $wp_manager ) {
		$this->inpress_fonts_sections( $wp_manager );
	}

	private function inpress_fonts_sections( $wp_manager ) {
		$wp_manager->add_section( 'inpress_google_fonts_section', array(
			'title'       => __( 'Google Fonts', 'inpress' ),
			'priority'       => 24,
		) );

		$font_choices = array(
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
			'Droid Sans:400,700' => 'Droid Sans',
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Arvo:400,700,400italic,700italic' => 'Arvo',
			'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif',
			'PT Sans:400,700,400italic,700italic' => 'PT Sans',
			'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
			'Arimo:400,700,400italic,700italic' => 'Arimo',
			'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
			'Bitter:400,700,400italic' => 'Bitter',
			'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Roboto:400,400italic,700,700italic' => 'Roboto',
			'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
			'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
			'Roboto Slab:400,700' => 'Roboto Slab',
			'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
			'Rokkitt:400' => 'Rokkitt',
		);

		$wp_manager->add_setting( 'inpress_headings_fonts', array(
				'sanitize_callback' => 'inpress_sanitize_fonts',
			)
		);

		$wp_manager->add_control( 'inpress_headings_fonts', array(
				'type' => 'select',
				'description' => __('Select your desired font for the headings.', 'inpress'),
				'section' => 'inpress_google_fonts_section',
				'choices' => $font_choices
			)
		);

		$wp_manager->add_setting( 'inpress_body_fonts', array(
				'sanitize_callback' => 'inpress_sanitize_fonts'
			)
		);

		$wp_manager->add_control( 'inpress_body_fonts', array(
				'type' => 'select',
				'description' => __( 'Select your desired font for the body.', 'inpress' ),
				'section' => 'inpress_google_fonts_section',
				'choices' => $font_choices
			)
		);
		$wp_manager->add_setting( 'inpress_header_color',
		array(
			'default' => '#110e0d',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color'
		)
		);
 
		$wp_manager->add_control( 'inpress_header_color',
		array(
			'label' => 'Header Colour' ,
			'description' => 'Used for all headers' ,
			'section' => 'colors',
			'priority' => 1, 
			'type' => 'color',
		)
		);
		$wp_manager->add_setting( 'inpress_body_color',
		array(
			'default' => '#110e0d',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color'
		)
		);
 
		$wp_manager->add_control( 'inpress_body_color',
		array(
			'label' => 'Body Colour' ,
			'description' => 'Used for body font' ,
			'section' => 'colors',
			'priority' => 1, 
			'type' => 'color',
		)
		);
		$wp_manager->add_setting( 'inpress_link_color',
		array(
			'default' => '#110e0d',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color'
		)
		);
 
		$wp_manager->add_control( 'inpress_link_color',
		array(
			'label' => 'Link Colour' ,
			'description' => 'Used for links' ,
			'section' => 'colors',
			'priority' => 1, 
			'type' => 'color',
		)
		);
		$wp_manager->add_setting( 'inpress_highlight_color',
		array(
			'default' => '#110e0d',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color'
		)
		);
 
		$wp_manager->add_control( 'inpress_highlight_color',
		array(
			'label' => 'Highlight Colour' ,
			'description' => 'Used for hover effects on links' ,
			'section' => 'colors',
			'priority' => 1, 
			'type' => 'color',
		)
		);
		$wp_manager->add_setting( 'inpress_footer_color',
		array(
			'default' => '#1f1f1f',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color'
		)
		);
 
		$wp_manager->add_control( 'inpress_footer_color',
		array(
			'label' => 'Footer Background Colour' ,
			'section' => 'colors',
			'priority' => 1, 
			'type' => 'color',
		)
		);
		$wp_manager->add_setting( 'inpress_footer_text_color',
		array(
			'default' => '#909090',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color'
		)
		);
 
		$wp_manager->add_control( 'inpress_footer_text_color',
		array(
			'label' => 'Footer Text Colour' ,
			'section' => 'colors',
			'priority' => 1, 
			'type' => 'color',
		)
		);
	}
}

