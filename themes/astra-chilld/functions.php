<?php

register_nav_menus(array(

    'primary-menu' => 'Primary Menu',

    'footer-menu'  => 'Footer Menu',

));
add_theme_support('custom-header');
add_theme_support('custom-logo');
function child_theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'), wp_get_theme()->get('Version'));
    wp_enqueue_style('books-style', get_stylesheet_directory_uri(). '/css/books.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('single-book-style', get_stylesheet_directory_uri(). '/css/single-book.css', array('books-style'), wp_get_theme()->get('Version'));
    wp_enqueue_style('cart-style', get_stylesheet_directory_uri(). '/css/cart.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('header-style', get_stylesheet_directory_uri(). '/css/header.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('footer-style', get_stylesheet_directory_uri(). '/css/footer.css', array(), wp_get_theme()->get('Version'));         
    wp_enqueue_style('font-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css');
    wp_enqueue_script('header-js', get_stylesheet_directory_uri() . '/js/header.js', array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');
require_once get_stylesheet_directory() . '/inc/customizer.php';
// function create_book_post_type() {

//     register_post_type('book',

//         array(

//           'labels' => array(
//     'name'               => 'Books',
//     'singular_name'      => 'Book',
//     'add_new'            => 'Add New Book',
//     'add_new_item'       => 'Add New Book',
//     'edit_item'          => 'Edit Book',
//     'new_item'           => 'New Book',
//     'view_item'          => 'View Book',
//     'search_items'       => 'Search Books',
//     'not_found'          => 'No Books Found',
//     'not_found_in_trash' => 'No Books Found in Trash',
//     'all_items'          => 'All Books',
//     'menu_name'          => 'Books'
// ),

//             'public' => true,

//             'has_archive' => true,

//             'menu_icon' => 'dashicons-book',

//             'supports' => array(
//                 'title',
//                 'editor',
//                 'thumbnail'
//             ),

//             'show_in_rest' => false

//         )
//     );
// }

// add_action('init', 'create_book_post_type');


// function custom_column_heading($columns) {

//     $new_columns = array();

//     $new_columns['cb'] = $columns['cb'];
//     $new_columns['book_image'] = 'Book Image';
//     $new_columns['title'] = $columns['title'];
//     $new_columns['author_name'] = 'Author Name';
//     $new_columns['stock'] = 'Stock';
//     $new_columns['price'] = 'Price';
//     $new_columns['pages'] = 'Pages';
//     $new_columns['date'] = $columns['date'];
//     return $new_columns;
// }

// add_filter('manage_book_posts_columns', 'custom_column_heading');

// function show_book_column($column, $post_id){

// switch($column) {
//     case 'author_name':
//         echo get_field('author_name',$post_id );
//         break;
//     case 'stock':
//         echo get_field('stock', $post_id);
//         break;
//     case 'price':
//         echo get_field('price', $post_id);
//         break;
//     case 'pages':
//         echo get_field('pages', $post_id );
//         break;
// case 'book_image':

//     $image = get_field('book_image', $post_id);

//     if (!empty($image)) {
//         echo '<img src="' . $image['url'] . '" width="60" height="80" />';
//     } else {
//         echo 'No Image';
//     }

//     break;

// }
// }
// add_action('manage_book_posts_custom_column', 'show_book_column', 10, 2);