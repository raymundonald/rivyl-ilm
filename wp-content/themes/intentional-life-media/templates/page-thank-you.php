<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Thank You
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header(); ?>
<section class="not-found position-relative md-padding-top md-padding-bottom">
    <div class="bg-image">
        <?= wp_get_attachment_image(288, 'full') ?>
    </div>
    <div class="container small-container text-center position-relative content-margin">
        <?php the_content() ?>
        <div class="button-tangerine col-auto button-box"><a class="" href="<?= get_site_url() ?>" target="_self">Back Home</a></div>
    </div>
</section>
<?php get_footer(); ?>