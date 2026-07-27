<?php

/*
 * Plugin Name: Book Shop
 * Description: Handles all Book functionality.
 * Version: 1.0
 * Author: Sumaira Jamshed
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/register-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-columns.php';
require_once plugin_dir_path(__FILE__) . 'includes/register-taxonomy.php';
require_once plugin_dir_path(__FILE__) . 'includes/database.php';
require_once plugin_dir_path(__FILE__) . 'includes/cart.php';
register_activation_hook(__FILE__, 'bs_create_cart_tables');

function bs_enqueue_assets()
{
    // Books Listing Page
    if (is_page_template('Book-template.php')) {
        wp_enqueue_style(
            'bs-books',
            plugin_dir_url(__FILE__) . 'assets/css/books.css',
            array(),
            '1.0'
        );
    }
    // Single Book Page
    if (is_singular('book')) {
        wp_enqueue_style(
            'bs-books',
            plugin_dir_url(__FILE__) . 'assets/css/books.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'bs-single-book',
            plugin_dir_url(__FILE__) . 'assets/css/single-book.css',
            array('bs-books'),
            '1.0'
        );
    }
    // Cart Page
    if (is_page_template('cart-template.php')) {
        wp_enqueue_style(
            'bs-cart',
            plugin_dir_url(__FILE__) . 'assets/css/cart.css',
            array(),
            '1.0'
        );
    }
    // enqueue js in book and single page
    if (is_page_template('Book-template.php') || is_singular('book') || is_page_template('cart-template.php')) {
        wp_enqueue_script(
            'bs-cart',
            plugin_dir_url(__FILE__) . 'assets/js/cart.js',
            array('jquery'),
            '1.0',
            true
        );
        wp_localize_script(
            'bs-cart',
            'bs_cart',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'cart_url' => home_url('/cart'),
            )
        );
    }
}

add_action('wp_enqueue_scripts', 'bs_enqueue_assets');
