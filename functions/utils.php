<?php

function pretty_print($object)
{
    echo "<pre>";
    print_r($object);
    echo "</pre>";
}

function get_project_categories_sorted()
{
    if (defined('ICL_LANGUAGE_CODE')) {
        do_action('wpml_switch_language', ICL_LANGUAGE_CODE);
    }
    $args = array('hide_empty' => true);
    $categories = get_categories($args);
    $arraycats = array();

    foreach ($categories as $idx => $category) {
        $arraycats[$idx] = array();
        $arraycats[$idx]['id'] = $category->term_id;
        $arraycats[$idx]['order'] = get_field('order', 'category_' . $category->term_id);
        $arraycats[$idx]['name'] = $category->name;
        $arraycats[$idx]['featured_image'] = get_field('featured_image', 'category_' . $category->term_id);
    }

    $arraycats = array_filter($arraycats, function ($item) {
        return $item['order'] == '-1' ? false : true;
    });

    usort($arraycats, function ($a, $b) {
        return $a['order'] - $b['order'];
    });

    return $arraycats;
}

function get_featured_projects()
{
    if (defined('ICL_LANGUAGE_CODE')) {
        do_action('wpml_switch_language', ICL_LANGUAGE_CODE);
    }
    $args = array('post_type' => 'project');
    $query = new WP_Query($args);
    $projects = $query->posts;
    $featured_projects = array();

    foreach ($projects as $idx => $project) {
        $featured_projects[$idx] = array();
        $featured_projects[$idx]['id'] = $project->ID;
        $featured_projects[$idx]['featured'] = get_field('featured', 'post_' . $project->ID);
        $featured_projects[$idx]['title'] = $project->post_title;
        $featured_projects[$idx]['image'] = get_the_post_thumbnail_url($project->ID);
        $featured_projects[$idx]['guid'] = $project->guid;
        $featured_projects[$idx]['customer'] = wp_get_post_terms($project->ID, array('customers'))[0]->name;
        $featured_projects[$idx]['year'] = date('Y', strtotime($project->post_date));
    }

    $featured_projects = array_filter($featured_projects, function ($item) {
        return $item['featured'] ? true : false;
    });

    return $featured_projects;
}

add_post_type_support('page', 'excerpt');
