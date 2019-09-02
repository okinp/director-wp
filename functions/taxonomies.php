<?php 


function create_customers_nonhierarchical_taxonomy() { 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Customers', 'taxonomy general name' ),
    'singular_name' => _x( 'Customer', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Customers' ),
    'popular_items' => __( 'Popular Customers' ),
    'all_items' => __( 'All Customers' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Customer' ), 
    'update_item' => __( 'Update Customer' ),
    'add_new_item' => __( 'Add New Customer' ),
    'new_item_name' => __( 'New Customer Name' ),
    'separate_items_with_commas' => __( 'Separate customers with commas' ),
    'add_or_remove_items' => __( 'Add or remove customers' ),
    'choose_from_most_used' => __( 'Choose from the most used customers' ),
    'menu_name' => __( 'Customers' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('customers','project',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'customer' ),
  ));
}

add_action( 'init', 'create_customers_nonhierarchical_taxonomy', 0 );