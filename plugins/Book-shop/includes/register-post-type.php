<?php
function create_book_post_type()
{
    register_post_type('book',
        array(
            'labels' => array(
                'name' => 'Books',
                'singular_name' => 'Book',
                'add_new' => 'Add New Book',
                'add_new_item' => 'Add New Book',
                'edit_item' => 'Edit Book',
                'new_item' => 'New Book',
                'view_item' => 'View Book',
                'search_items' => 'Search Books',
                'not_found' => 'No Books Found',
                'not_found_in_trash' => 'No Books Found in Trash',
                'all_items' => 'All Books',
                'menu_name' => 'Books'
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-book',
            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            ),
            'taxonomies' => array('book_category'),
            'show_in_rest' => false
        ));
}

add_action('init', 'create_book_post_type');
