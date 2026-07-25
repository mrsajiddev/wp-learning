<?php

if (!defined('ABSPATH')) {
    exit;
}


function bs_create_cart_tables()
{
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $charset_collate = $wpdb->get_charset_collate();

    $cart_table = $wpdb->prefix . 'cart';

    $cart_items_table = $wpdb->prefix . 'cart_items';

    /*
     * Create Cart Table
     */
    if ($wpdb->get_var("SHOW TABLES LIKE '$cart_table'") != $cart_table) {
        $sql = "CREATE TABLE $cart_table (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            user_id BIGINT UNSIGNED DEFAULT NULL,

            session_id VARCHAR(255) DEFAULT NULL,

            created_at DATETIME NOT NULL,

            updated_at DATETIME NOT NULL,

            PRIMARY KEY (id),

            KEY user_id (user_id),

            KEY session_id (session_id)

        ) $charset_collate;";

        dbDelta($sql);
    }

    /*
     * Create Cart Items Table
     */
    if ($wpdb->get_var("SHOW TABLES LIKE '$cart_items_table'") != $cart_items_table) {
        $sql = "CREATE TABLE $cart_items_table (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            cart_id BIGINT UNSIGNED NOT NULL,

            book_id BIGINT UNSIGNED NOT NULL,

            quantity INT UNSIGNED NOT NULL DEFAULT 1,

            created_at DATETIME NOT NULL,

            updated_at DATETIME NOT NULL,

            PRIMARY KEY (id),

            KEY cart_id (cart_id),

            KEY book_id (book_id)

        ) $charset_collate;";

        dbDelta($sql);
    }
}
