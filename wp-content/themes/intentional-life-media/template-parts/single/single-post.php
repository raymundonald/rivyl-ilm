<?php
echo ___hero_modules('text-start', 'small-hero');
?>
<section class="post-details sm-padding-top sm-padding-bottom px-4">
    <div class="container-fluid">
        <div class="row align-items-center g-0 justify-content-center">
            <div class="col-lg-7 px-5">
                <div class="row g-4 justify-content-between">
                    <div class="col-auto">
                        <?= do_shortcode('[blog_meta]') ?>
                    </div>
                    <div class="col-auto ">
                        <div class="d-flex justify-content-end">
                            <?= do_shortcode('[post_link]') ?>
                            <?= do_shortcode('[social_share]') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="post-content-v2 sm-padding-top sm-padding-bottom no-overflow border-top-default px-4">
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col col-post-nav d-none d-lg-block">
                <div class="column-holder post-navigation-holder">
                    <h3>Contents</h3>
                    <ul id="post-navigation" class="d-flex flex-wrap list-inline">

                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-post-content px-5">
                <div class="column-holder the-content content-margin fw-light" id="post-content">
                    <?php the_content() ?>
                    <?= do_shortcode('[layouts id=271847]') ?>
                    <?php
                    global $layouts_global;
                    $layouts_global[] = 271847;
                    ?>
                    <?php
                    $avatar = get_avatar(get_the_author_meta('ID'));
                    ?>

                </div>
            </div>
            <div class="col col-sidebar">
                <div class="column-holder mt-5 mt-lg-0" id="blog-single-sidebar">
                    <?php dynamic_sidebar('blog_single_sidebar') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="sm-padding-top sm-padding-bottom border-top-default px-4">
    <div class="row g-0 justify-content-center">
        <div class="col-lg-7 px-5">
            <div class="author">
                <div class="text-accent fw-semibold medium-text">Written by:</div>
                <div class="fw-light medium-text"><?= get_author_name() ?></div>
            </div>
        </div>
    </div>
</div>