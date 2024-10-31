<?php

/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header(); ?>

<?php
$args = array(
    'post_type' => 'podcasts',
    'numberposts' => -1,
    'order' => 'DESC',
    'orderby' => 'DATE'
);
$settings = array(
    'pagination' => false,
    'navigation' => true,
    'is_slider' => true
);

$id = _get_layout_id('podcasts');
if ($id) {
    echo do_shortcode(__hero($id));
}
echo do_shortcode(_posts_sliders('podcast_category', $args, $settings));
if ($id) {
    echo do_shortcode(get_the_content(NULL, false, $id));
}

?>

<?php get_footer(); ?>