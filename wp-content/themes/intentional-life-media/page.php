<?php get_header(); ?>


<?php while (have_posts()) { ?>
    <?php the_post() ?>
    <section class="default-template overflow-hidden lg-padding-top lg-padding-bottom">
        <div class="container">
            <div class="heading-description position-relative content-margin md-margin-bottom icon-none color">
                <div class="heading-line">
                    <h2 class="heading text-torquoise"><?php the_title() ?></h2>
                    <?php the_excerpt() ?>
                </div>
            </div>
            <div class="the-content">
                <?php the_content() ?>
            </div>
        </div>
    </section>
<?php } ?>
<?php get_footer(); ?>