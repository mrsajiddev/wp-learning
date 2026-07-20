
<div class="footer-main">

    <div class="bs-container">

        <!-- Left Column -->
        <div class="footer-column">

            <div class="footer-logo">

                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    bloginfo('name');
                }
                ?>

            </div>

            <hr>

            <h3>Contact Information</h3>

            <p>

                123 Main Street<br>
                New York, NY 10001<br>
                Phone: +1 777 123 4567<br>
                Email: info@example.com

            </p>


        </div>

        <!-- Middle Column -->

        <div class="footer-column">

            <h3>Site Map</h3>

            <?php

            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class' => 'footer-menu',
                'container' => false,
            ));

            ?>

        </div>

        <!-- Right Column -->

        <div class="footer-column">

            <form class="newsletter-form">

                <input
                    type="email"
                    placeholder="Email address"
                >

                <button type="submit">
                    Subscribe
                </button>

            </form>

       <div class="footer-social">

<a href="#"><i class="fab fa-facebook-f"></i></a>

<a href="#"><i class="fab fa-twitter"></i></a>

<a href="#"><i class="fas fa-envelope"></i></a>

<a href="#"><i class="fab fa-youtube"></i></a>

</div>

        </div>

    </div>

    <div class="footer-bottom">

        Copyright © <?php echo date('Y'); ?>
        <?php bloginfo('name'); ?>

    </div>

</div>