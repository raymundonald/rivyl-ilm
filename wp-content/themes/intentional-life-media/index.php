<?php

/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header(); ?>

<?php

if (is_home()) {
    $args = array(
        'post_type' => 'post',
        'numberposts' => -1,
        'order' => 'DESC',
        'orderby' => 'DATE'
    );
    $settings = array(
        'pagination' => false,
        'navigation' => true,
        'is_slider' => true
    );

    $id =  get_option('page_for_posts');

    echo do_shortcode(__hero($id));
    echo do_shortcode(_posts_sliders('category', $args, $settings));
    echo do_shortcode(__sections($id));
}

?>

<?php get_footer(); ?>