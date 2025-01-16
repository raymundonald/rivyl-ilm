<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Libray of Hope 
/* Template Post Type: page
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header(); ?>

<?php
while (have_posts()) {
    the_post();
    echo do_shortcode(__hero(get_the_ID()));
}
?>
<section class="content-filter xxs-padding">
    <div class="container">
        <div class="content-filter-box d-flex flex-wrap">
            <button class="filter-button filter-button-active">
                All content
            </button>
            <button class="filter-button">
                Most Recent Posts
            </button>
            <button class="filter-button">
                Blogs
            </button>
            <button class="filter-button">
                New Music
            </button>
            <button class="filter-button">
                Podcast
            </button>
            <button class="filter-button">
                Stories
            </button>
            <button class="filter-button">
                On-Demand Videos
            </button>
            <button class="filter-button">
                Evangelistic
            </button>
        </div>
    </div>
</section>

<section class="swiper-slider-section sm-padding-top sm-padding-bottom bg-light-gray">
    <div class="container mb-5">
        <h2 class="heading decor" style="--decor-color: var(--torquoise)">Listen</h2>
    </div>
    <?php
    $posts = [];
    $music = get_posts(array(
        'post_type' => 'music',
        'numberposts' => 5,
        'fields' => 'ids'
    ));
    $posts[] = $music[0];
    $posts[] = $music[1];
    $posts[] = $music[2];
    $posts[] = $music[3];
    $posts[] = $music[4];
    $posts[] = get_posts(array(
        'post_type' => 'albums',
        'numberposts' => 1,
        'fields' => 'ids'
    ))[0];
    $posts[] = get_posts(array(
        'post_type' => 'videos',
        'numberposts' => 1,
        'fields' => 'ids'
    ))[0];
    $posts[] = get_posts(array(
        'post_type' => 'playlists',
        'numberposts' => 1,
        'fields' => 'ids'
    ))[0];
    $posts[] = get_posts(array(
        'post_type' => 'livestreams',
        'numberposts' => 1,
        'fields' => 'ids'
    ))[0];

    ?>
    <div class="swiper-post-slider-style-2  mb-4" id="swiper-post-slider-style-2-1" style="--width: 252px; --padding: 50% 0;">
        <?= _post_query_v2(
            array(
                'post_type' => 'any',
                'include' => $posts,
                'orderby' => 'rand'
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'post_box_style_1',
                'post_box_settings' => array(
                    'show_post_type_label' => true,
                    'type' => 'post',
                )
            )
        ); ?>
    </div>

    <div class="swiper-post-slider-style-2" id="swiper-post-slider-style-2-2" style="--width: 262px; --padding: 60% 0;">
        <?= _post_query_v2(
            array(
                'role'    => 'author',
                'orderby' => 'user_nicename',
                'order'   => 'ASC'
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'post_box_style_1',
                'post_box_settings' => array(
                    'show_post_type_label' => 'Artists',
                    'type' => 'user',
                )
            )
        ); ?>
    </div>
</section>

<section class="swiper-slider-section watch-section sm-padding-top sm-padding-bottom">
    <div class="container mb-5">
        <h2 class="heading decor" style="--decor-color: var(--torquoise)">Watch</h2>
        <div class="desc-box main-desc">
            <p>Inspiration for every stage of your journey. </p>
        </div>
    </div>
    <div class="swiper-post-slider-style-2" id="swiper-post-slider-style-2-3" style="--width: 262px; --padding: 60% 0;">
        <div class="container">
            <h3 class="heading text-torquoise mb-3">PODCASTS</h3>
        </div>
        <?= _post_query_v2(
            array(
                'taxonomy' => 'podcast_category',
                'hide_empty' => false,
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'post_box_style_2',
                'post_box_settings' => array(
                    'type' => 'terms',
                )
            )
        ); ?>
    </div>

    <div class="swiper-post-slider-style-2" id="swiper-post-slider-style-2-4" style="--width: 262px; --padding: 60% 0;">
        <div class="container">
            <h3 class="heading text-torquoise mb-3">storytellers</h3>
        </div>
        <?= _post_query_v2(array(
            'role'    => 'author',
            'orderby' => 'user_nicename',
            'order'   => 'ASC'
        ), array(
            'is_slider' => true,
            'pagination' => true,
            'navigation' => true,
            'container_class' => 'bizmo',
            'post_box_style' => 'post_box_style_3',
            'post_box_settings' => array(
                'type' => 'user',
            )
        )); ?>
    </div>

</section>

<section class="swiper-slider-section stories-section bg-forest-gray text-white sm-padding-top sm-padding-bottom">
    <div class="container mb-5">
        <h2 class="heading decor" style="--decor-color: var(--torquoise)">words of wisdom</h2>
        <div class="desc-box main-desc">
            <p>Reflections of an intentional life. </p>
        </div>
    </div>
    <div class="swiper-post-slider-style-2  mb-4" id="swiper-post-slider-style-2-5" style="--width: 300px;">
        <?= _post_query_v2(
            array(
                'post_type' => 'stories',
                'orderby' => 'rand',
                'numberposts' => 10
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'story_player_box',
            )
        ); ?>
    </div>
</section>

<section class="swiper-slider-section watch-section sm-padding-top sm-padding-bottom">
    <div class="container mb-5">
        <h2 class="heading decor" style="--decor-color: var(--torquoise)">Mission-led moments</h2>
        <div class="desc-box main-desc">
            <p>On demand podcasts, stories, and devotionals. </p>
        </div>
    </div>

    <div class="swiper-post-slider-style-2  mb-4" id="swiper-post-slider-style-2-6" style="--width: 575px; --padding: 36%">
        <?= _post_query_v2(
            array(
                'post_type' => 'on-demand',
                'orderby' => 'rand',
                'numberposts' => 10
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'video_player_box',
            )
        ); ?>
    </div>
</section>

<section class="swiper-slider-section stories-section bg-forest-gray text-white sm-padding-top sm-padding-bottom">
    <div class="container mb-5">
        <h2 class="heading decor" style="--decor-color: var(--torquoise)">Uplifting stories</h2>
        <div class="desc-box main-desc">
            <p>“Faith can move mountains” - Matthew 17:20 </p>
        </div>
    </div>
    <div class="swiper-post-slider-style-2  mb-4" id="swiper-post-slider-style-2-5" style="--width: 455px;">
        <?= do_shortcode(_post_query_v2(
            array(
                'post_type' => 'evangelistic',
                'orderby' => 'rand',
                'numberposts' => 10
            ),
            array(
                'is_slider' => true,
                'pagination' => true,
                'navigation' => true,
                'container_class' => 'bizmo',
                'post_box_style' => 'post_box_style_4',
                'post_box_settings' => array(
                    'type' => 'post',
                )
            )
        )) ?>
    </div>
</section>

<?php the_content() ?>

<?php get_footer(); ?>