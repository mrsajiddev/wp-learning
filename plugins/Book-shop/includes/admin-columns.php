<?php

/**
 * Custom Book Columns
 */
function custom_column_heading($columns) {

    $new_columns = array();

    $new_columns['cb']          = $columns['cb'];
    $new_columns['book_image']  = 'Book Image';
    $new_columns['title']       = $columns['title'];
    $new_columns['book_author'] = 'Author';
    $new_columns['stock']       = 'Stock';
    $new_columns['price']       = 'Price';
    $new_columns['pages']       = 'Pages';
    $new_columns['date']        = $columns['date'];

    return $new_columns;
}

add_filter('manage_book_posts_columns', 'custom_column_heading');
// function custom_column_heading($columns) {

//     $new_columns = array();

//     foreach ($columns as $key => $value) {

//         $new_columns[$key] = $value;

//         // Add our custom columns after the Title column
//         if ($key === 'title') {
//             $new_columns['book_image'] = 'Book Image';
//             $new_columns['author_name'] = 'Author';
//             $new_columns['stock'] = 'Stock';
//             $new_columns['price'] = 'Price';
//             $new_columns['pages'] = 'Pages';
//         }
//     }

//     return $new_columns;
// }

// add_filter('manage_book_posts_columns', 'custom_column_heading');

/**
 * Display Custom Column Data
 */
function show_book_column($column, $post_id) {

    switch ($column) {

        case 'book_author':

            $author = get_field('select_the_author', $post_id);

            if ($author) {
                echo esc_html($author->display_name);
            } else {
                echo '—';
            }

            break;

        case 'stock':

            echo esc_html(get_field('stock', $post_id));

            break;

        case 'price':

            echo esc_html(get_field('price', $post_id));

            break;

        case 'pages':

            echo esc_html(get_field('pages', $post_id));

            break;

        case 'book_image':

            $image = get_field('book_image', $post_id);

            if (!empty($image)) {

                echo '<img src="' . esc_url($image['url']) . '" width="60" height="80" alt="">';

            } else {

                echo 'No Image';

            }

            break;
    }
}

add_action('manage_book_posts_custom_column', 'show_book_column', 10, 2);