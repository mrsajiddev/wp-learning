<?php
get_header();
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>

<div class="single-book-page">

    <div class="single-book-container">

<!-- Success Message -->
        <div id="bs-cart-message"></div>
        <section class="book-details-section">

        

            <div class="book-image-column">

<?php
        $image = get_field('book_image');
        if ($image) {
            ?> 
                    <img src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>">
                    <?php
        }
        ?>
            </div>


          

            <div class="book-info-column">

                <h1 class="single-book-title">
    <?php the_title(); ?>
                </h1>


              <?php

        $author = get_field('select_the_author');
        if ($author):
            ?>

<div class="single-book-author">

    <?php echo get_avatar($author->ID, 70); ?>

    <div class="author-details">

        <h3><?php echo esc_html($author->display_name); ?></h3>

    </div>

</div>

<?php endif; ?>


                <span class="stock-status">
                    In stock: 
                    <?php the_field('stock'); ?>
                </span>

                <div class="price-box">
</strong> Price: </strong>
                 <?php the_field('price'); ?>

<strong> <p>
                        Standard Discount:
                        10%
                    </p>

</strong>

                </div>

                <div class="book-meta">


                    <p><strong>Pages:</strong> <?php the_field('pages'); ?></p>

                   

                </div>

            </div>


          

            <div class="book-action-column">

                <a href="#" class="buy-now-btn">
                    Buy Now
                </a>

             <a href="#"
   class="cart-btn bs-add-to-cart"
   data-book-id="<?php the_ID(); ?>">
    Add To Cart
</a>

                <a href="#" class="wishlist-btn">
                    Add To Wishlist
                </a>

            </div>

        </section>




        <section class="book-description-section">

            <h2>Description</h2>

            <p>

    <?php the_content(); ?>

            </p>

        

        </section>

<!-- Related Products -->
        <section class="related-books-section">

            <div class="section-heading">

                <h2>Related Products</h2>

                <a href="http://localhost/child-theme/books">View All</a>

            </div>

            <div class="books-grid">

<?php

        $args = array(
            'post_type' => 'book',
            'posts_per_page' => 4,
        );

        $related_books = new WP_Query($args);

        if ($related_books->have_posts()):
            while ($related_books->have_posts()):
                $related_books->the_post();

                $image = get_field('book_image');
                ?>                 <div class="book-card">
        <div class="book-image">
            <span class="badge hot">Hot</span>
            <span class="badge discount">-30%</span>
            <span class="wishlist">♡</span>
             <a href="<?php the_permalink(); ?>">

            <?php if ($image): ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>

        </a>

        </div>
        <div class="book-info">
            <div class="rating-price">
                <div class="rating">⭐ (4.5)</div>
                <div class="price">
                   
                    <span class="new-price"><?php the_field('price'); ?></span>
                </div>
            </div>
          <?php

                $author = get_field('select_the_author');
                if ($author):
                    ?>

<div class="author">

    <?php echo get_avatar($author->ID, 35); ?>

    <span>
        By: <?php echo esc_html($author->display_name); ?>
    </span>

</div>

<?php endif; ?>
           <a href="<?php the_permalink(); ?>"> 
            <h3 class="book-title"><?php the_title(); ?></h3>
        </a>
        <a href="#" class="bs-add-to-cart" data-book-id="<?php the_ID(); ?>">
    Add to Cart
</a>
        </div>
        
    </div>

<?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>No related books found.</p>';
        endif;
        ?>

            </div>

        </section>

<!-- Best Seller -->

        <section class="bestseller-books-section">

            <div class="section-heading">

                <h2>Bestsellers </h2>

                <a href="http://localhost/child-theme/books/">View All</a>

            </div>

            <div class="books-grid">

<?php

        $args = array(
            'post_type' => 'book',
            'posts_per_page' => 4,
            'order' => 'ASC',
        );

        $related_books = new WP_Query($args);

        if ($related_books->have_posts()):
            while ($related_books->have_posts()):
                $related_books->the_post();

                $image = get_field('book_image');
                ?>                 <div class="book-card">
        <div class="book-image">
            <span class="badge hot">Hot</span>
            <span class="badge discount">-30%</span>
            <span class="wishlist">♡</span>
             <a href="<?php the_permalink(); ?>">

            <?php if ($image): ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>

        </a>

        </div>
        <div class="book-info">
            <div class="rating-price">
                <div class="rating">⭐ (4.5)</div>
                <div class="price">
                   
                    <span class="new-price"><?php the_field('price'); ?></span>
                </div>
            </div>
<?php

                $author = get_field('select_the_author');
                if ($author):
                    ?>

<div class="author">

    <?php echo get_avatar($author->ID, 35); ?>

    <span>
        By: <?php echo esc_html($author->display_name); ?>
    </span>

</div>

<?php endif; ?>          <a href="<?php the_permalink(); ?>"> 
            <h3 class="book-title"><?php the_title(); ?></h3>
        </a>
        <a href="#" class="bs-add-to-cart" data-book-id="<?php the_ID(); ?>">
    Add to Cart
</a>
        </div>
    </div>

<?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>No related books found.</p>';
        endif;
        ?>

            </div>

        </section>

    </div>

</div>

<?php
    endwhile;
endif;
get_footer();
?>