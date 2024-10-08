<?php get_header(); ?>

<?php
echo do_shortcode(__sections(get_the_ID()));
?>

<?php get_footer(); ?>