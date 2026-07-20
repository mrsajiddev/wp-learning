<?php

/*
 * Template Name: Books Template
 */

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$args = array(
    'post_type' => 'book',
    'posts_per_page' => 12,
    'paged' => $paged,
);

if ($sort == 'low-high') {
    $args['meta_key'] = 'price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'ASC';
} elseif ($sort == 'high-low') {
    $args['meta_key'] = 'price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'DESC';
} elseif ($sort == 'popular') {
    $args['orderby'] = 'comment_count';
}

print_r($args);
// die;

$books = new WP_Query($args);

?>

<div class="books-page">

    <div class="books-container">

        <!-- Top Bar -->
        <div class="books-top-bar">

            <div class="results-count">

<?php

$total_books = $books->found_posts;
$start = (($paged - 1) * 12) + 1;
$end = min($paged * 12, $total_books);
echo "Showing {$start} – {$end} of {$total_books} results";

?>

</div>

        <div class="sort-books">

<form method="GET">
<select name="sort" onchange="this.form.submit()">
<option value="">Sort By Latest</option>
<option value="low-high" <?php selected($sort, 'low-high'); ?>> Price Low to High</option>
<option value="high-low"<?php selected($sort, 'high-low'); ?>>Price High to Low</option>
<option value="popular" <?php selected($sort, 'popular'); ?>>Popularity</option>
</select>
</form>
</div>

        </div>

        <!-- Books Grid -->
        <div class="books-grid">

<?php
if ($books->have_posts()):
    while ($books->have_posts()):
        $books->the_post();

        ?>

                <div class="book-card">

                    <div class="book-image">

                        <span class="badge hot">Hot</span>

                        <span class="badge discount">-30%</span>

                        <span class="wishlist">♡</span>
<a href="<?php the_permalink(); ?>">
                 <?php
        $image = get_field('book_image');
        if ($image) {
            ?> 
                    <img src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>">
                    <?php
        }
        ?></a>
                    </div>

                    <div class="book-info">

                        <div class="rating-price">

                            <div class="rating">
                                ⭐ (4.5)
                            </div>

                            <div class="price">
                                <span class="new-price"> 
                                $<?php echo get_field('price'); ?></span>
                            </div>

                        </div>
<a href="<?php the_permalink(); ?>">
                        <h3 class="book-title">
                       
                          <?php the_title(); ?>
                        </h3>
          </a>
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

                    </div>

                </div>

            <?php endwhile;
else:
    echo 'No books found';
endif; ?>

        </div>

        <!-- Pagination -->
        <div class="books-pagination">
<div class="books-pagination">

<?php
echo paginate_links(array(
    'total' => $books->max_num_pages,
    'current' => $paged,
    'prev_text' => '←',
    'next_text' => '→',
));

?>

</div>
            
        </div>

    </div>

</div>

<?php
get_footer();
?>