<?php

/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header(); ?>

<?php
$args = array(
    'post_type' => 'team',
    'numberposts' => -1,
    'order' => 'DESC',
    'orderby' => 'DATE'
);
$settings = array(
    'is_slider' => false
);

$id = _get_layout_id('team');
if ($id) {
    echo do_shortcode(__hero($id));
}
?>
<section class="post-team md-padding-top lg-padding-bottom">
    <div class="container">
        <div class="row">
            <?php
            while (have_posts()) {
                the_post();
                echo "<div class='col-lg-3 col-md-6'>";
                echo _team_grid(array(
                    'id' => get_the_ID(),
                    'post_title' => get_the_title(),
                    'post_excerpt' => get_the_excerpt(),
                ));
                echo "</div>";
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php

if ($id) {
    echo do_shortcode(__sections($id));
}

?>

<?php get_footer(); ?>