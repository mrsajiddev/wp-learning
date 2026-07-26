<div class="topbar">

    <div class="container">

        <div class="topbar-left">
            <span>
                📞 <?php echo esc_html(get_theme_mod('bs_phone_number')); ?>
            </span>

            <span><?php  // esc_html makes the output safe for HTML.
?>
                ✉ <?php echo esc_html(get_theme_mod('bs_email_address')); ?>
            </span>

        </div>

        <div class="topbar-right">
            <a href="#">My Account</a>
            <a href="#">Wishlist (0)</a>

<a href="<?php echo home_url('/cart'); ?>">
Cart (<span id="bs-cart-count"><?php echo bs_get_cart_count(); ?></span>)</a>

        </div>

    </div>

</div>