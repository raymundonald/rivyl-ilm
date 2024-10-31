<?php get_header(); ?>

<?php
while (have_posts()) {
    the_post();
    echo __hero(get_the_ID());
    the_content();
}
?>

<?php get_footer(); ?>