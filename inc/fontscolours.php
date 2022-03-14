<?php 
/**
 * Add inline css from Customizer
 */

function inpress_custom_styles($custom) {


//Fonts

$headings_font = esc_html(get_theme_mod('inpress_headings_fonts'));

$body_font = esc_html(get_theme_mod('inpress_body_fonts'));

$header_colour = esc_html(get_theme_mod('inpress_header_color'));

$body_colour = esc_html(get_theme_mod('inpress_body_color'));

$link_colour = esc_html(get_theme_mod('inpress_link_color'));

$highlight_colour = esc_html(get_theme_mod('inpress_highlight_color'));

$footer_bg = esc_html(get_theme_mod('inpress_footer_color'));

$footer_text = esc_html(get_theme_mod('inpress_footer_text_color'));

$bg_colour = get_background_color();

if( $bg_colour ){
    $custom .= ":root{--bg-colour:#{$bg_colour};}"."\n";
}

if ( $headings_font ) {

    $font_pieces = explode(":", $headings_font);

    $custom .= "h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { font-family: {$font_pieces[0]}; color:{$header_colour}; }"."\n";

}

if ( $body_font ) {

    $font_pieces = explode(":", $body_font);

    $custom .= "body, button, input, select, textarea { font-family: {$font_pieces[0]}; color:{$body_colour};}"."\n";

}

if( $link_colour ) {
    
    $custom .= "a, a:visited {color:{$link_colour};}"."\n".":root {--link-colour:{$link_colour};}"."\n";

}

if( $highlight_colour ) {
   
    $custom .= "a:hover {color:{$highlight_colour};}"."\n";

}
if( $footer_bg ) {
   
    $custom .= ".site-footer {background-color:{$footer_bg};}"."\n";

}
if( $footer_text ) {
   
    $custom .= ".site-footer a, .site-footer p, .site-footer h4 {color:{$footer_text};}"."\n";

}

//Output all the styles

wp_add_inline_style( 'inpress-style', $custom );

}

add_action( 'wp_enqueue_scripts', 'inpress_custom_styles' );



//Sanitizes Fonts
function inpress_sanitize_fonts( $input ) {
$valid = array(
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

if ( array_key_exists( $input, $valid ) ) {
    return $input;
} else {
    return '';
}
}