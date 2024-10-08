<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Modules 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header(); ?>

<?php

echo do_shortcode(__hero(get_the_ID()));
echo do_shortcode(__sections(get_the_ID()));
?>

<?php get_footer(); ?>