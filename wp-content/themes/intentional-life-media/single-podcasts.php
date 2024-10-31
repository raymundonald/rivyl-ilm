<?php get_header(); ?>
<?php
$post_id = get_the_ID();
$category = serialize(array('podcast_category'));
$post_author = $post->post_author;
?>
<section class="podcast-header lg-padding-top lg-padding-bottom">
    <div class="container medium-container">
        <div class="navigation mb-4">
            <div class="button-previous button-box"><a class="" href="/podcasts" _self="">All Podcasts</a></div>
        </div>
        <div class="mb-3">
            <?= do_shortcode("[post_taxonomy_terms post_id='$post_id' taxonomy='$category']") ?>
        </div>
        <div class="podcast-image position-relative">
            <?php
            echo __image(array(
                'featured_image' => get_the_ID(),
                'class' => 'image-style mt-md-5'
            ));

            echo __image(array(
                'id' => 92,
                'class' => 'podcast-icon'
            ))
            ?>
        </div>
        <div class="podcast-player bg-light-gray">
            <div class="row g-4">
                <div class="col-12 col-lg-auto d-none d-md-block">
                    <?= __image(array(
                        'id' => 304,
                        'class' => 'podcast-author'
                    )) ?>
                </div>
                <div class="col">
                    <div class="title-share flex-column flex-md-row d-flex align-items-start align-items-md-center justify-content-between">
                        <?php
                        echo __heading(array(
                            'heading' => get_the_title(),
                            'tag' => 'h1',
                            'class' => 'h4'
                        ));
                        echo do_shortcode('[social_share hide_title=1]');
                        ?>
                    </div>
                    <?php

                    echo __description(array(
                        'description' =>  get_the_excerpt()
                    ));
                    echo do_shortcode('[audio_player]');
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog-content lg-padding-bottom">
    <div class="container medium-container">
        <div class="the-content">
            <?php the_content() ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>