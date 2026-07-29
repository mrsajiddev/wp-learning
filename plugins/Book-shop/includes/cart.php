<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get Current Cart ID
 */
function bs_get_cart_id()
{
    global $wpdb;
    $cart_table = $wpdb->prefix . 'cart';
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();

        $cart_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id
                FROM $cart_table
                WHERE user_id = %d",
                $user_id
            )
        );

        if (!$cart_id) {
            $wpdb->insert(
                $cart_table,
                array(
                    'user_id' => $user_id,
                    'session_id' => null,
                    'created_at' => current_time('mysql'),
                    'updated_at' => current_time('mysql'),
                )
            );
            $cart_id = $wpdb->insert_id;
        }
        return $cart_id;
    } else {
        $session_id = isset($_COOKIE['bs_cart_session']) ? sanitize_text_field($_COOKIE['bs_cart_session']) : '';

        if (empty($session_id)) {
            $session_id = wp_generate_uuid4();
            setcookie(
                'bs_cart_session',
                $session_id,
                time() + (30 * DAY_IN_SECONDS),
                COOKIEPATH,
                COOKIE_DOMAIN
            );
        }

        $cart_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id
            FROM $cart_table
            WHERE session_id = %s",
                $session_id
            )
        );

        if (!$cart_id) {
            $wpdb->insert(
                $cart_table,
                array(
                    'user_id' => null,
                    'session_id' => $session_id,
                    'created_at' => current_time('mysql'),
                    'updated_at' => current_time('mysql'),
                )
            );

            $cart_id = $wpdb->insert_id;
        }

        return $cart_id;
    }
}

/**
 * Add Book to Cart
 */
function bs_add_to_cart($book_id, $quantity = 1)
{
    $stock = get_field('stock', $book_id);
    $cart_id = bs_get_cart_id();
    global $wpdb;
    $cart_items_table = $wpdb->prefix . 'cart_items';
    $current_quantity = 0;
    $cart_item = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT *
        FROM $cart_items_table
        WHERE cart_id = %d
        AND book_id = %d",
            $cart_id,
            $book_id
        )
    );
    if ($cart_item) {
        $current_quantity = $cart_item->quantity;
        if (($current_quantity + $quantity) > $stock) {
            return new WP_Error(
                'out_of_stock',
                'Sorry, only ' . $stock . ' books are available.'
            );
        }
    }
    if ($cart_item) {
        $wpdb->update($cart_items_table, array(
            'quantity' => $cart_item->quantity + $quantity,
            'updated_at' => current_time('mysql'),
        ),
            array(
                'id' => $cart_item->id,  // Which row should I update?
            ));
    } else {
        $wpdb->insert($cart_items_table, array(
            'cart_id' => $cart_id,
            'book_id' => $book_id,
            'quantity' => $quantity,
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        ));
    }
    return true;
}

/**
 * Get Cart Item Count
 */
function bs_get_cart_count()
{
    $cart_id = bs_get_cart_id();
    global $wpdb;
    $cart_items_table = $wpdb->prefix . 'cart_items';

    $count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT SUM(quantity)
             FROM $cart_items_table
             WHERE cart_id = %d",
            $cart_id
        )
    );

    return $count ? $count : 0;
}

/**
 * AJAX Add To Cart
 */
function bs_ajax_add_to_cart()
{
    $book_id = isset($_POST['book_id'])
        ? absint($_POST['book_id'])
        : 0;

    if (!$book_id) {
        echo 'Invalid Book';
        wp_die();
    }

    $result = bs_add_to_cart($book_id);

    if (is_wp_error($result)) {
        wp_send_json_error(
            array(
                'message' => $result->get_error_message(),
            )
        );
    }

    wp_send_json_success(
        array(
            'message' => 'Book added successfully',
            'count' => bs_get_cart_count(),
        )
    );
}

/**
 * AJAX Update Cart Quantity
 */
function bs_update_cart_quantity()
{
    $cart_item_id = isset($_POST['cart_item_id'])
        ? absint($_POST['cart_item_id'])
        : 0;
    $operation = isset($_POST['operation'])
        ? sanitize_text_field($_POST['operation'])
        : '';
    global $wpdb;

    $cart_items_table = $wpdb->prefix . 'cart_items';
    $cart_item = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $cart_items_table WHERE id = %d",
            $cart_item_id
        )
    );
    if (!$cart_item) {
        echo 'Cart item not found';

        wp_die();
    }
    if ($operation === 'increase') {
        $new_quantity = $cart_item->quantity + 1;
        $wpdb->update(
            $cart_items_table,
            array(
                'quantity' => $new_quantity,
                'updated_at' => current_time('mysql'),
            ),
            array(
                'id' => $cart_item_id,
            )
        );
    }
elseif ($operation === 'decrease') {
    if ($cart_item->quantity > 1) {
        $new_quantity = $cart_item->quantity - 1;
        $wpdb->update(
            $cart_items_table,
            array(
                'quantity'   => $new_quantity,
                'updated_at' => current_time('mysql'),
            ),
            array(
                'id' => $cart_item_id,
            )
        );

    } else {

        $wpdb->delete(
            $cart_items_table,
            array(
                'id' => $cart_item_id,
            )
        );

        wp_send_json_success(
            array(
                'removed' => true,
            )
        );

    }

}

$price = get_field( 'price', $cart_item->book_id );
$row_total = $price * $new_quantity;
$cart_id = bs_get_cart_id();
$cart_items = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT *
         FROM $cart_items_table
         WHERE cart_id = %d",
        $cart_id
    )
);
$total_items = 0;
$subtotal = 0;
$shipping = 5;
foreach ($cart_items as $item) {
    $price = get_field('price', $item->book_id);
    $total_items += $item->quantity;
    $subtotal += $price * $item->quantity;
}

$grand_total = $subtotal + $shipping;
wp_send_json_success(
    array(
        'quantity'     => $new_quantity,
        'row_total'    => number_format($row_total, 2),
        'total_items'  => $total_items,
        'subtotal'     => number_format($subtotal, 2),
        'grand_total'  => number_format($grand_total, 2),
    )
);
}
function bs_remove_cart_item()
{
    $cart_item_id = isset($_POST['cart_item_id'])
        ? absint($_POST['cart_item_id'])
        : 0;
        global $wpdb;
       $cart_items_table = $wpdb->prefix . 'cart_items';
       $cart_item = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT *
         FROM $cart_items_table
         WHERE id = %d",
        $cart_item_id
    )
);
     if (!$cart_item) {
         wp_send_json_error(
        array(
            'message' => 'Cart item not found.'
        )
    );
}
$wpdb->delete(
    $cart_items_table,
    array(
        'id' => $cart_item_id,
    )
);
$cart_id = bs_get_cart_id();
$cart_items = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT *
         FROM $cart_items_table
         WHERE cart_id = %d",
        $cart_id
    )
);
$total_items = 0;
$subtotal = 0;
$shipping = 5;
foreach ($cart_items as $item) {
    $price = get_field('price', $item->book_id);
    $total_items += $item->quantity;
    $subtotal += $price * $item->quantity;
}
$grand_total = $subtotal + $shipping;
wp_send_json_success(
    array(
        'total_items' => $total_items,
        'subtotal'    => number_format($subtotal, 2),
        'grand_total' => number_format($grand_total, 2),
    )
);
}
add_action('wp_ajax_bs_add_to_cart', 'bs_ajax_add_to_cart');
add_action('wp_ajax_nopriv_bs_add_to_cart', 'bs_ajax_add_to_cart');
add_action('wp_ajax_bs_update_cart_quantity', 'bs_update_cart_quantity');
add_action('wp_ajax_nopriv_bs_update_cart_quantity', 'bs_update_cart_quantity');
add_action('wp_ajax_bs_remove_cart_item', 'bs_remove_cart_item');
add_action('wp_ajax_nopriv_bs_remove_cart_item', 'bs_remove_cart_item');

