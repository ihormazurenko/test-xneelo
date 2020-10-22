<?php
if (!defined('ABSPATH')) exit;

// loading styles and scripts
function load_style_script(){
    wp_enqueue_style('fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700', array(), null);
    wp_enqueue_style('custom-styles', get_template_directory_uri() . '/assets/css/screen.css', [], null );
    wp_enqueue_style('style', get_stylesheet_uri(), [], null );

    if ( !wp_script_is( 'jquery' ) ) {
        wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-1.12.4.min.js', [], '1.12.4', false  );
    }
    wp_enqueue_script('html5shiv', '//html5shiv.googlecode.com/svn/trunk/html5.js', [], null, false );
    wp_script_add_data('html5shiv','conditional','IE 9');

    wp_enqueue_script('dotdotdot', '//cdnjs.cloudflare.com/ajax/libs/jQuery.dotdotdot/4.1.0/dotdotdot.min.js', ['jquery'], '4.1.0', true );
    wp_enqueue_script('fontawesome', '//kit.fontawesome.com/d64e28f0c1.js', [], null );
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/custom/scripts.js', ['jquery'], null, true );
    wp_enqueue_script('react-scripts', get_template_directory_uri() . '/assets/js/custom/react/build/index.js', ['wp-element', 'wp-components'], null, true );
}
add_action('wp_enqueue_scripts', 'load_style_script');



add_filter( 'login_headerurl', function(){ return get_home_url(); } );

// no information explaining the situation will appear when an incorrect login or password is entered
add_filter( 'login_errors', function($a){ return null; } );

// custom login styles
function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login-styles', get_template_directory_uri() . '/assets/css/login-styles.css', ['login'] );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );



// delete unnecessary items in wp_head
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );



// automatic generation of the tag <title>
add_theme_support( 'title-tag' );
// adding html5 markup
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

// support custom logo
add_theme_support( 'custom-logo', array(
    'flex-height' => true,
    'flex-width'  => true
) );
add_theme_support( 'custom-logo' );

// support thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}


// support menus
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(array(
        'main-menu'     => 'Main Menu'
    ));
}


// for excerpts
function new_excerpt_more( $more ) {
    return '&hellip;&nbsp;<a href="' . esc_url(get_permalink()) . '" title="' . esc_attr__('more', 'xneelo') . '" class="more">' . __('more', 'xneelo') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


function new_excerpt_length($length) {
  return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');



/* Hack on overwriting the guid parameter when publishing or updating a post in the admin panel (the permalink in the current structure is written)
--------------------------------------------------------------------------------------------------------------------------------- */
function guid_write( $id ){
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение

    global $wpdb;

    if( $id = (int) $id )
        $wpdb->query("UPDATE $wpdb->posts SET guid='". get_permalink($id) ."' WHERE ID=$id LIMIT 1");
}
add_action('save_post', 'guid_write', 100);

