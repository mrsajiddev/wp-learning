<?php //Template Name: Cart Template 
get_header(); ?>

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
// Simple product loop 
for ($i = 0; $i < 3; $i++) { 
?>

    <div class="cart-item">
        <div class="product-details">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/muke.jpg" alt="Fifa 19">
            <div class="product-info">
                <h3>Fifa 19</h3>
                <p class="product-category">PS4</p>
                <button class="remove-btn">Remove</button>
            </div>
        </div>
        
        <div class="product-quantity">
            <button class="qty-btn">-</button>
            <input type="text" value="2" readonly>
            <button class="qty-btn">+</button>
        </div>
        
        <div class="product-price">£44.00</div>
        <div class="product-total">£88.00</div>
    </div>

<?php 
} // Loop yahan khatam hota hai
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