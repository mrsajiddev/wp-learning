<div class="navbar">

    <div class="container">

        <!-- Logo -->
        <div class="site-logo">

            <a href="<?php echo home_url(); ?>">

                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    bloginfo('name');
                }
                ?>

            </a>

        </div>

        <!-- Navigation -->

        <nav class="main-navigation">

            <?php

            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'menu_class' => 'main-menu',
                'container' => false,
            ));

            ?>

        </nav>

        <!-- Right Side -->

        <div class="navbar-right">

            <div class="header-search">

                <a href="#" class="search-toggle">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </a>

            </div>

            <button class="menu-toggle">

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

    </div>

</div>