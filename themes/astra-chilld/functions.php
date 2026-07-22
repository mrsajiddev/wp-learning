<?php

register_nav_menus(array(
    'primary-menu' => 'Primary Menu',
    'footer-menu' => 'Footer Menu',
));
add_theme_support('custom-header');
add_theme_support('custom-logo');

function child_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'), wp_get_theme()->get('Version'));
    wp_enqueue_style('header-style', get_stylesheet_directory_uri() . '/css/header.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('footer-style', get_stylesheet_directory_uri() . '/css/footer.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css');
    wp_enqueue_script('header-js', get_stylesheet_directory_uri() . '/js/header.js', array(), wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');
require_once get_stylesheet_directory() . '/inc/customizer.php';
