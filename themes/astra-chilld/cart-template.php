<?php  // Template Name: Cart Template
get_header();
$cart_id = bs_get_cart_id();
global $wpdb;
$cart_items_table = $wpdb->prefix . 'cart_items';
$cart_items = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT *
        FROM $cart_items_table
        WHERE cart_id = %d",
        $cart_id
    )
);

?>

    <div class="cart-container">
        <!-- Left Section: Shopping Cart List -->
        <main class="cart-main">
            <div class="cart-header">
                <h1>Shopping Cart</h1>
                <span class="item-count">3 Items</span>
            </div>

            <!-- Table Headers -->
            <div class="cart-labels">
                <span class="label-product">Product Details</span>
                <span class="label-quantity">Quantity</span>
                <span class="label-price">Price</span>
                <span class="label-total">Total</span>
            </div>

     <?php

if (!empty($cart_items)) {
    foreach ($cart_items as $cart_item) {
        $book = get_post($cart_item->book_id);

        if (!$book) {
            continue;
        }
        $image = get_field('book_image', $book->ID);
        $price = get_field('price', $book->ID);

?>

    <div class="cart-item" data-cart-item-id="<?php echo esc_attr($cart_item->id); ?>">
        <div class="product-details">
<?php if ($image): ?>

    <img src="<?php echo esc_url($image['url']); ?>"
         alt="<?php echo esc_attr($book->post_title); ?>">

<?php endif; ?>            <div class="product-info">
<h3><?php echo esc_html(get_the_title($book->ID)); ?></h3>                <?php
        $author = get_field('select_the_author', $book->ID);

        if ($author):
?>

<p class="product-category">
    By: <?php echo esc_html($author->display_name); ?>
</p>

<?php endif; ?>
                <button class="remove-btn">Remove</button>
            </div>
        </div>
        
        <div class="product-quantity">
<button class="qty-btn qty-minus">-</button><input type="text"
       value="<?php echo esc_attr($cart_item->quantity); ?>"
       readonly>
<button class="qty-btn qty-plus">+</button>        </div>
        
<div class="product-price">
    $<?php echo number_format($price, 2); ?>
</div>       <div class="product-total">
    $<span class="cart-item-total">
        <?php echo number_format($price * $cart_item->quantity, 2); ?>
    </span>
</div>
    </div>

<?php
    }
} else {
    echo '<p>Your cart is empty.</p>';
}

?>
            <!-- Back navigation -->
            <a href="#" class="continue-shopping">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Continue Shopping
            </a>
        </main>

        <!-- Right Section: Order Summary -->
        <aside class="cart-summary">
            <h2>Order Summary</h2>
            
            <div class="summary-row summary-subtotal">
                <span>ITEMS 3</span>
                <span>£457.98</span>
            </div>

            <div class="summary-field">
                <label for="shipping">SHIPPING</label>
                <div class="select-wrapper">
                    <select id="shipping">
                        <option>Standard Delivery - £5.00</option>
                        <option>Express Delivery - £10.00</option>
                    </select>
                </div>
            </div>

            <div class="summary-field">
                <label for="promo">PROMO CODE</label>
                <input type="text" id="promo" placeholder="Enter your code">
                <button class="apply-btn">APPLY</button>
            </div>

            <div class="summary-total-row">
                <span>TOTAL COST</span>
                <span>£462.98</span>
            </div>

            <button class="checkout-btn">CHECKOUT</button>
        </aside>
    </div>
<?php get_footer(); ?>