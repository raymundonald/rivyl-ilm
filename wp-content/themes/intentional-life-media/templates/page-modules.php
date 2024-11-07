<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Modules 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header(); ?>

<?php
while (have_posts()) {
    the_post();
    echo do_shortcode(__hero(get_the_ID()));
    the_content();
}
?>

<?php get_footer(); ?>