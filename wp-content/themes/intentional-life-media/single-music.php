<?php get_header(); ?>
<?php
$post_id = get_the_ID();
$category = serialize(array('podcast_category'));
$post_author = $post->post_author;
?>
<?php
echo __hero_default('Listen', '“But let all who take refuge in you rejoice; let them ever sing for joy, and spread your protection over them, that those who love your name may exult in you.” - Psalm 5:11', 635);
?>
<section class="podcast-header lg-padding-top lg-padding-bottom bg-light-gray">
    <div class="container">
        <div class="podcast-image position-relative" style="--padding: 18.5%">
            <?php
            echo __image(array(
                'featured_image' => get_the_ID(),
                'class' => 'image-style mt-md-5'
            ));
            ?>
        </div>
        <div class="podcast-player bg-white">
            <div class="row g-4">
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
<section class="swiper-slider-section sm-padding-bottom bg-light-gray">
    <div class="container mb-5">
        <h3 class="heading">MUSIC FOR YOU</h3>
    </div>

    <div class="swiper-post-slider-style-2  mb-4" id="swiper-post-slider-style-2-1" style="--width: 252px; --padding: 50% 0;">
        <?= _post_query_v2(
            array(
                'post_type' => 'music',
                'orderby' => 'rand',
                'numberposts' => 10
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'post_box_style_1',
                'post_box_settings' => array(
                    'type' => 'post',
                )
            )
        ); ?>
    </div>
</section>
<?php get_footer(); ?>