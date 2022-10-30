<?php
// Global variables define
define('CONTENT_PARENT_TEMPLATE_DIR_URI',get_template_directory_uri());
define('CONTENT_ST_TEMPLATE_DIR_URI',get_stylesheet_directory_uri());
define('CONTENT_ST_TEMPLATE_DIR',get_stylesheet_directory());

add_action('wp_enqueue_scripts', 'content_theme_css', 999);
function content_theme_css() {
    wp_enqueue_style('content-parent-style', CONTENT_PARENT_TEMPLATE_DIR_URI . '/style.css');
    wp_enqueue_style('bootstrap', CONTENT_PARENT_TEMPLATE_DIR_URI . '/css/bootstrap.css');
	wp_enqueue_style('content-media-responsive-css', CONTENT_ST_TEMPLATE_DIR_URI."/css/media-responsive.css" );
    wp_enqueue_script('content-mp-masonry-js', CONTENT_ST_TEMPLATE_DIR_URI . '/js/masonry/mp.mansory.js');
}

if ( ! function_exists( 'content_theme_setup' ) ) :

function content_theme_setup() {

//Load text domain for translation-ready
load_theme_textdomain('content', CONTENT_ST_TEMPLATE_DIR . '/languages');

if ( is_admin() ) {
	require CONTENT_ST_TEMPLATE_DIR . '/admin/admin-init.php';
}

// Add default posts and comments RSS feed links to head.

add_theme_support( 'automatic-feed-links' );

/* Let WordPress manage the document title. */

add_theme_support( 'title-tag' );

}
endif;
add_action( 'after_setup_theme', 'content_theme_setup' );

/**
 * Import options from SpicePress
 *
 */
function content_get_lite_options() {
	$spicepress_mods = get_option( 'theme_mods_spicepress' );
	if ( ! empty( $spicepress_mods ) ) {
		foreach ( $spicepress_mods as $spicepress_mod_k => $spicepress_mod_v ) {
			set_theme_mod( $spicepress_mod_k, $spicepress_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'content_get_lite_options' );

add_action( 'admin_init', 'content_detect_button' );
	function content_detect_button() {
	wp_enqueue_style('content-info-button', CONTENT_ST_TEMPLATE_DIR_URI .'/css/import-button.css');
}

// footer custom script
function content_footer_custom_script() {

if ( is_active_sidebar('sidebar-1') ) {
$col =6;
}
else
{
$col =4;
}
?>
    <script>
        jQuery(document).ready(function (jQuery) {
            jQuery("#blog-masonry").mpmansory(
                    {
                        childrenClass: 'item', // default is a div
                        columnClasses: 'padding', //add classes to items
                        breakpoints: {
                            lg: <?php echo esc_html($col);?>, //Change masonry column here like 2, 3, 4 column
                            md: 6,
                            sm: 6,
                            xs: 12
                        },
                        distributeBy: {order: false, height: false, attr: 'data-order', attrOrder: 'asc'}, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
                        onload: function (items) {
                            //make somthing with items
                        }
                    }
            );
        });
    </script>
    <?php

}
add_action('wp_footer', 'content_footer_custom_script');

//Set for old user before 1.8.5
if (!get_option('content_user_with_1_8_5', false)) {
    //detect old user and set value
    $content_service_title=get_theme_mod('home_service_section_title');
    $content_service_discription=get_theme_mod('home_service_section_discription');
    $content_blog_title=get_theme_mod('home_news_section_title');
    $content_blog_discription=get_theme_mod('home_news_section_discription');
    $content_slider_title=get_theme_mod('home_slider_title');
    $content_slider_discription=get_theme_mod('home_slider_discription');
    $content_testimonial_title=get_theme_mod('home_testimonial_section_title');
    $content_testimonial__discription=get_theme_mod('home_testimonial_section_discription');
    $content_footer_credit=get_theme_mod('footer_copyright_text');

    if ($content_service_title !=null || $content_service_discription !=null || $content_blog_title !=null || $content_blog_discription !=null || $content_slider_title !=null || $content_slider_discription !=null || $content_testimonial_title !=null || $content_testimonial__discription !=null || $content_footer_credit !=null )  {
        add_option('content_user_with_1_8_5', 'old');

    } else {
        add_option('content_user_with_1_8_5', 'new');
    }
}

//Remove Footer section
function content_remove_customize_register( $wp_customize ) {

   $wp_customize->remove_section( 'spicepress_footer_copyright');

}
add_action( 'customize_register', 'content_remove_customize_register',11);
