<?php
add_action('init', 'cp_custom_post_type_func');

function cp_custom_post_type_func() {
    $labels = array(
        'name' => _x('campaign', ''),
        'singular_name' => _x('campaign', ''),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => false,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'campaign', 'with_front' => false),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
    );

    register_post_type('campaign');
}
?>