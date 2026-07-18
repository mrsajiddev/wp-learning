<?php
/*
Plugin Name: Book Shop
Description: Handles all Book functionality.
Version: 1.0
Author: Sumaira Jamshed
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/register-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-columns.php';
require_once plugin_dir_path(__FILE__) . 'includes/register-taxonomy.php';
require_once plugin_dir_path(__FILE__) . 'includes/database.php';
register_activation_hook( __FILE__, 'bs_create_cart_tables' );