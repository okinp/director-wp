<?php
add_theme_support('post-thumbnails');
function create_project_post_type()
{

    $labels = array(
        'name' => _x('Projects', 'post type general name'),
        'singular_name' => _x('Project', 'post type singular name'),
        'add_new' => _x('Add New', 'project'),
        'add_new_item' => __('Add New Project'),
        'edit_item' => __('Edit Project'),
        'new_item' => __('New Project'),
        'view_item' => __('View Project'),
        'search_items' => __('Search Projects'),
        'not_found' => __('No projects found'),
        'not_found_in_trash' => __('No projects found in Trash'),
        'parent_item_colon' => '',
    );
    $args = array(
        'thumbnail',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'project', 'with_front' => false),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 10,
        'taxonomies' => array('featured', 'category'),
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
    );
    register_post_type('project', $args);
}
add_action('init', 'create_project_post_type');
