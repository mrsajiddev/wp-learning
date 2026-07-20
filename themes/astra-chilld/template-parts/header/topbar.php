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

            <a href="<?php
echo home_url('/cart');  // wordpress returns http://localhost/child-theme/cart
?>">
                Cart (0)
            </a>

        </div>

    </div>

</div>