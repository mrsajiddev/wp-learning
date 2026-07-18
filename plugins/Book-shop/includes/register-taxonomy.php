<?php

/**
 * Register Book Categories Taxonomy
 */
function bs_register_book_category_taxonomy() {

    $labels = array(

        'name'              => 'Book Categories',
        'singular_name'     => 'Book Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Book Categories',

    );

    register_taxonomy(

        'book_category',

        array('book'),

        array(

            'labels'            => $labels,

            'hierarchical'      => true,

            'public'            => true,

            'show_admin_column' => true,

            'show_ui'           => true,

            'show_in_rest'      => true,

            'rewrite' => array(
                'slug' => 'book-category'
            )

        )

    );

}

add_action('init', 'bs_register_book_category_taxonomy');