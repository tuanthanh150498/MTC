<?php
/**
 * Theme functions and definitions
 *
 * @package Blossom_Consulting
 */
 
/**
 * Enqueue parent style 
*/	 
function blossom_consulting_enqueue_styles() {
    
    if( blossom_coach_is_woocommerce_activated() ){
        $dependencies = array( 'blossom-coach-woocommerce', 'owl-carousel', 'animate', 'blossom-coach-google-fonts' );    
    }else{
        $dependencies = array( 'owl-carousel', 'animate', 'blossom-coach-google-fonts' );
    }
        
    wp_enqueue_style( 'blossom-consulting-parent-style', get_template_directory_uri() . '/style.css', $dependencies );

} 
add_action( 'wp_enqueue_scripts', 'blossom_consulting_enqueue_styles' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
*/
function blossom_consulting_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'blossom-consulting', get_stylesheet_directory() . '/languages' );

    //add image size
    add_image_size( 'blossom-coach-shop', 540, 690, true );
}
add_action( 'after_setup_theme', 'blossom_consulting_setup' );

/**
 * Remove action from parent
*/
function blossom_consulting_remove_action(){
    remove_action( 'wp_enqueue_scripts', 'blossom_coach_dynamic_css', 99 );
    remove_action( 'customize_register', 'blossom_coach_customizer_theme_info' );
}
add_action( 'init', 'blossom_consulting_remove_action' );

function blossom_consulting_overide_values( $wp_customize ){
    if (blossom_coach_is_wheel_of_life_activated() ) {
        $wp_customize->get_setting( 'wheeloflife_color' )->default = '#fafbfd';
    }
}
add_action( 'customize_register', 'blossom_consulting_overide_values', 999 );

/**
 * Dynamic Styles
*/
function blossom_consulting_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Nunito Sans' );
    $primary_fonts   = blossom_coach_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Nunito' );
    $secondary_fonts = blossom_coach_get_fonts( $secondary_font, 'regular' );
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Nunito', 'variant'=>'700' ) );
    $site_title_fonts     = blossom_coach_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 25 );

    $wheeloflife_color = get_theme_mod( 'wheeloflife_color', '#fafbfd' );
    
    $custom_css = '';
    $custom_css .= '

    :root {
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
    }
    
    .site-title, 
    .site-title-wrap .site-title{
        font-size   : ' . absint( $site_title_font_size ) . 'px;
        font-family : ' . esc_html( $site_title_fonts['font'] ) . ';
        font-weight : ' . esc_html( $site_title_fonts['weight'] ) . ';
        font-style  : ' . esc_html( $site_title_fonts['style'] ) . ';
    }
    
    section#wheeloflife_section {
        background-color: ' . blossom_coach_sanitize_hex_color( $wheeloflife_color ) . ';
    }';

    wp_add_inline_style( 'blossom-coach', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'blossom_consulting_dynamic_css', 99 );

/**
 * Returns Home Sections 
*/
function blossom_coach_get_home_sections(){
    $ed_banner = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $sections = array( 
        'client'        => array( 'sidebar' => 'client' ),
        'infor'        => array( 'section' => 'infor' ),
        'about'         => array( 'sidebar' => 'about' ),
        'cta'           => array( 'sidebar' => 'cta' ),
        'testimonial'   => array( 'sidebar' => 'testimonial' ),
        'service'       => array( 'sidebar' => 'service' ),
        'wheeloflife'   => array( 'wsection' => 'wheeloflife' ),
        'blog'          => array( 'bsection' => 'blog' ),
        'simple-cta'    => array( 'sidebar' => 'simple-cta' ),
        'shop'          => array( 'section' => 'shop' ),
        'contact'       => array( 'sidebar' => 'contact' ), 
    );
    
    $enabled_section = array();
    
    if( $ed_banner == 'static_nl_banner' || $ed_banner == 'slider_banner' || $ed_banner == 'static_banner' ) array_push( $enabled_section, 'banner' );
    
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $v['sidebar'] );
        }else{
            if( array_key_exists( 'bsection', $v ) && get_theme_mod( 'ed_blog_section', true ) ) array_push( $enabled_section, $v['bsection'] );
            if( array_key_exists( 'wsection', $v ) && get_theme_mod( 'ed_wheeloflife_section', false ) ) array_push( $enabled_section, $v['wsection'] );
        }
    }  
    
    return apply_filters( 'blossom_coach_home_sections', $enabled_section );
}

/**
 * Footer Bottom
*/
function blossom_coach_footer_bottom(){ ?>
    <div class="bottom-footer">
        <div class="wrapper">
            <div class="copyright">            
            <?php
                blossom_coach_get_footer_copyright();
                esc_html_e( ' Blossom Consulting | Developed By ', 'blossom-consulting' );                
                echo '<a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Blossom Themes', 'blossom-consulting' ) . '</a>.';                
                printf( esc_html__( ' Powered by %s', 'blossom-consulting' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'blossom-consulting' ) ) .'" target="_blank">WordPress</a>.' );
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>               
            </div>
        </div><!-- .wrapper -->
    </div><!-- .bottom-footer -->
    <?php
}

/**
 * Customizer Controls
*/
require get_stylesheet_directory() . '/inc/customizer.php';
if( ! function_exists( 'blossom_coach_footer_bottom_custom' ) ) :
function blossom_coach_footer_bottom_custom(){ ?>
    <div class="bottom-footer-custom">
		<div class="wrapper">
			<div class="copyright">            
            <?php  
                echo '© Copyright 2022 . All Rights Reserved.';                
                // if ( function_exists( 'the_privacy_policy_link' ) ) :
                //     the_privacy_policy_link();
                // endif;
            ?>               
            </div>
		</div><!-- .wrapper -->
	</div><!-- .bottom-footer -->
    <?php
}
endif;
add_action( 'blossom_coach_footer', 'blossom_coach_footer_bottom_custom', 40 );

add_filter( 'big_image_size_threshold', '__return_false' );

function create_news_and_events() {
    $labels = array(
        'name'                  => _x( 'News and Events', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'News and Events', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'News and Events', 'Admin Menu text', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'service' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        // 'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'news_events', $args );
    register_taxonomy( 'news_events_category', array('news_events'), array('hierarchical' => true, 'label' => 'Categories', 'singular_label' => 'Category', 'rewrite' => array( 'slug' => 'news_events', 'with_front'=> false )));
}
 
add_action( 'init', 'create_news_and_events' );

if( ! function_exists( 'custom_entry_content' ) ) :
    /**
     * Entry Content
    */
    function custom_entry_content(){ 
        $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
        <div class="entry-content" itemprop="text">
            <?php
                if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                    the_content();    
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blossom-coach' ),
                        'after'  => '</div>',
                    ) );
                }
            ?>
        </div><!-- .entry-content -->
        <?php
    }
endif;
add_action( 'custom_posts_entry_content', 'custom_entry_content', 20 );

/*Register custom sidebar*/
function my_custom_sidebar() {
    register_sidebar(
    array (
    'name' => __( 'Custom', 'your-theme-domain' ),
    'id' => 'custom-side-bar',
    'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
    'before_widget' => '<div class="widget-content">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    )
    );
    }
    add_action( 'widgets_init', 'my_custom_sidebar' );