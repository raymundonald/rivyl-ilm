<?php get_header(); ?>
<section class="not-found position-relative md-padding-top md-padding-bottom">
    <div class="bg-image">
        <?= wp_get_attachment_image(290, 'full') ?>
    </div>
    <div class="container small-container text-center position-relative content-margin">
        <div class="decor-top decor-2"></div>
        <h1>404</h1>
        <div class="desc-box">
            <p class="mb-0">
                <i> For the Son of Man came to seek and to save the lost.</i>
            </p>
            <p class="text-tiny">
                - Luke 19:10
            </p>
        </div>
        <div class="button-tangerine col-auto button-box"><a class="" href="<?= get_site_url() ?>" target="_self">Back Home</a></div>
        <div class="decor-bottom decor-2"></div>
    </div>
</section>
<?php get_footer(); ?>