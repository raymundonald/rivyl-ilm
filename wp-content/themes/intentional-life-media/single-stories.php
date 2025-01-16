<?php get_header(); ?>
<?php
$post_id = get_the_ID();
$category = serialize(array('podcast_category'));
$post_author = $post->post_author;
$stories_arr = [get_the_ID()];
$stories = get_posts(array(
    'post_type' => 'stories',
    'orderby' => 'rand',
    'exclude' => get_the_ID(),
    'numberposts' => 10,
    'fields' => 'ids'
));
$stories_var = array_merge($stories_arr, $stories);
?>
<?php
echo __hero_default('storied moments', 'Provoking thought and igniting transformation, one story at a time.', 896);
?>

<section class="stories-header lg-padding-top">
    <div class="container">
        <div class="heading-description position-relative content-margin md-margin-bottom icon-right">
            <div class="image-box icon"><img width="207" height="208" src="http://ilm.local/wp-content/uploads/2025/01/Intentional-Life-Media_Sticker-Mockup-copy-1.png"></div>
            <h2 class="heading decor">words of wisdom
            </h2>
            <div class="desc-box main-desc">
                <p> Reflections from our community.</p>
            </div>
        </div>
        <div class="stories-feed">
            <div class="swiper swiper-stories-single">
                <div class="swiper-wrapper">
                    <?php foreach ($stories_var as $key => $stories) {
                        echo "<div class='swiper-slide' key='$key'>";
                        echo "<div class='story-feed-holder'>";
                        $post_data['post_type'] = $post->post_type;
                        $post_data['id'] = $post->ID;
                        $post_data['link'] = $post->ID;
                        $post_data['title'] = $post->post_title;
                        $post_data['desc'] = $post->post_excerpt;

                        echo _story_player_box($post_data);
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>