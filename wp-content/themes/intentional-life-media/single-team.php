<?php get_header(); ?>
<?php while (have_posts()) { ?>
    <?php the_post() ?>
    <section class="team-section bg-light-gray md-padding-top md-padding-bottom bg-light-gray overflow-hidden">
        <div class="container">
            <div class="row gx-65px align-items-center">
                <div class="col-lg-5">
                    <?= __image(array(
                        'featured_image' => get_the_ID(),
                        'class' => 'image-style mb-4 mb-lg-0'
                    )) ?>
                </div>
                <div class="col-lg-7 content-margin">
                    <h1 class="text-torquoise h2"><?php the_title() ?></h1>
                    <div class="position"><?php the_excerpt() ?></div>
                    <div class="desc-box">
                        <?php the_content() ?>
                    </div>
                    <?= do_shortcode('[socials source="post"]') ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php
$posts = get_posts(array(
    'post_type' => 'team',
    'numberposts' => 4,
    'exclude' => get_the_ID(),
    'orderby' => 'rand'
));
?>
<section class="post-team md-padding-top lg-padding-bottom">
    <div class="container">
        <div class="heading-description position-relative content-margin md-margin-bottom  text-center">
            <h1>MEET THE TEAM</h1>
            <div class="hero-desc">
                <p>Joyful kinship is at the heart of what we do.</p>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($posts as $post) {
                echo "<div class='col-lg-3 col-md-6'>";
                echo _team_grid(array(
                    'id' => $post->ID,
                    'post_title' => $post->post_title,
                    'post_excerpt' => $post->post_excerpt
                ));
                echo "</div>";
            }
            ?>
        </div>
        <div class="button-tangerine col-auto button-box text-center md-margin-top"><a href="/team" target="_self">More</a></div>
    </div>
</section>

<?php get_footer(); ?>