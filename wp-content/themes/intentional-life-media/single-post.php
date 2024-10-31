<?php get_header(); ?>
<?php
while (have_posts()) {
    the_post();
    $post_id = get_the_ID();
    $category = serialize(array('category'));
    $tag = serialize(array('post_tag'));
    $page_for_posts = get_option('page_for_posts');
    $author_id = get_the_author_meta('ID');
    $post_author = get_the_author_meta('display_name', $author_id);
    $read_time = get__post_meta('read_time');
?>
    <section class="blog-header lg-padding-top lg-padding-bottom">
        <div class="container">
            <div class="navigation mb-4">
                <div class="button-previous button-box"><a class="" href="<?= get_permalink($page_for_posts) ?>" _self="">All Posts</a></div>
            </div>
            <div class="mb-3">
                <?= do_shortcode("[post_taxonomy_terms post_id='$post_id' taxonomy='$category']") ?>
                <?php if ($read_time) { ?>
                    <span class="read-time ms-3">
                        <?= $read_time ?> min read
                    </span>
                <?php } ?>
            </div>
            <?
            echo __heading(array(
                'heading' => get_the_title(),
                'tag' => 'h1',
                'class' => 'h2'
            ));

            echo __image(array(
                'featured_image' => get_the_ID(),
                'class' => 'image-style md-margin-top'
            )) ?>

            <div class="blog-meta mt-4">
                <div class="row gy-3">
                    <div class="col-auto">
                        <div class="text-tiny">
                            Written by
                        </div>
                        <div class="author bizmo">
                            <?= $post_author ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="text-tiny">
                            Published on
                        </div>
                        <div class="date bizmo">
                            <?= get_the_date('d F Y', get_the_ID()) ?>
                        </div>
                    </div>
                    <div class="col text-lg-end">
                        <?= do_shortcode('[social_share hide_title=1]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-content lg-padding-bottom">
        <div class="container small-container">
            <div class="the-content">
                <?php the_content() ?>
            </div>
            <div class="bottom sm-margin-top">
                <div class="share xs-padding-bottom xs-margin-bottom">
                    <div class="row g-4 align-items-end">
                        <div class="col-lg-5">
                            <?= do_shortcode('[social_share]') ?>
                        </div>
                        <div class="col-lg-7 text-lg-end">
                            <?= do_shortcode("[post_taxonomy_terms post_id='$post_id' taxonomy='$tag']") ?>
                        </div>
                    </div>
                </div>
                <div class="author">
                    <div class="avatar">

                    </div>
                    <div class="author-details">
                        <?= do_shortcode("[post_author author_id='$author_id']") ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php get_footer(); ?>