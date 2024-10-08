<?php get_header(); ?>
<section class="blog-header lg-padding-top lg-padding-bottom">
    <div class="container">
        <div class="navigation mb-4">
            <div class="button-readmore button-box"><a class="" href="http://ilm.local/podcasts/illo-assumenda-atque-2/" _self="">All Posts</a></div>
        </div>
        <div class="mb-3">
            <?= __post_taxonomy_terms(get_the_ID(), array('category', 'post_tag')) ?>
            <span class="read-time ms-3">
                5 min read
            </span>
        </div>
        <h1>
            <?php the_title() ?>
        </h1>
        <?= __image(array(
            'featured_image' => get_the_ID(),
            'class' => 'image-style md-margin-top'
        )) ?>
    </div>
</section>
<section class="blog-content">
    <div class="container small-container">
        <div class="the-content">
            <?php the_content() ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>