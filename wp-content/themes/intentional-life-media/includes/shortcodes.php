<?php

class Shortcodes
{
    function layouts($atts)
    {
        extract(
            shortcode_atts(
                array(
                    'id' => '',
                ),
                $atts
            )
        );

        return do_shortcode(get_the_content(NULL, false, $id));
    }
    function blog_meta()
    {
        ob_start();
?>
        <div class="blog-meta small-text">
            <div class="row">
                <div class="col-auto">
                    <p class="mb-0 fw-semibold"><strong>Last updated on</strong></p>
                    <p class="fw-light"><?= get_the_date('jS F') ?></p>
                </div>
            </div>
        </div>
    <?php
        return ob_get_clean();
    }

    function social_share($atts)
    {
        extract(
            shortcode_atts(
                array(
                    'hide_title' => '',
                ),
                $atts
            )
        );

        global $post;
        $SVG = new SVG;
        $url = get_permalink($post->ID);
        $title = str_replace(' ', '%20', get_the_title($post->ID));

        $social_buttons = '';
        $social_buttons .= '<div class="social-share-wrap">';
        if ($hide_title != 1) {
            $social_buttons .= '<div>Share this post</div>';
        }
        $social_buttons .= '<div class="social-share-buttons">';

        $social_buttons .= '<button onclick="copy_link()" class="post-link-copy">';
        $social_buttons .= '<input class="d-none" id="copy-link" value="' . get_permalink(get_the_ID()) . '">';
        $social_buttons .= $SVG->copy();
        $social_buttons .= '</button>';

        $social_buttons .= '<a href="#" onclick="window.open(\'https://www.facebook.com/sharer.php?u=' . $url . '&t=' . $title . '\', \'_blank\', \'width=600,height=400\'); return false;">' . $SVG->facebook() . '</a>';

        $social_buttons .= '<a href="#" onclick="window.open(\'https://www.linkedin.com/feed/?linkOrigin=LI_BADGE&shareActive=true&shareUrl=' . $url . '\', \'_blank\', \'width=600,height=400\'); return false;">' . $SVG->linkedin() . '</a>';
        $social_buttons .= '<a href="#" onclick="window.open(\'https://x.com/share?url=' . $url . '&text=' . $title . '\', \'_blank\', \'width=600,height=400\'); return false;">' . $SVG->x() . '</a>';
        $social_buttons .= '</div>';
        $social_buttons .= '</div>';
        return $social_buttons;
    }


    function post_link()
    {
        ob_start();
    ?>
        <button onclick="copy_link()" class="post-link-copy">
            <input class="d-none" id="copy-link" value="<?= get_permalink(get_the_ID()) ?>">
            <span>Copy Link</span>
        </button>
        <script>
            function copy_link() {
                // Get the text field
                var copyText = document.getElementById("copy-link");

                // Select the text field
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);

                jQuery('.post-link-copy span').text('Link Copied');
            }
        </script>
        <?php
        return ob_get_clean();
    }

    function related_posts()
    {
        $categories = get_the_category(get_the_ID());
        $args = array(
            'posts_per_page' => 3,

            'post_type'      => array('post'),

            'post_status'    => 'publish',

            'category__and ' => $categories,

            'orderby'        => 'rand'

        );
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            $html = "<div class='related-posts-sidebar'>";
            $html .= "<h3>Related Posts</h3>";
            $html .= "<div class='row g-3 same-image-height' style='--image-padding: 35%'>";
            while ($query->have_posts()) {
                $query->the_post();
                $html .= "<div class='col-12'>";
                $data = array(
                    'id'       => get_the_ID(),
                    'featured' => false,
                    'col'      => false,
                    'style'    => 'style-1',
                    'taxonomy' => 'category',
                    'elements' => array('image', 'category', 'date', 'title', 'excerpt', 'button')
                );
                $html .= __post_box($data);
                $html .= "</div>";
            }
            wp_reset_postdata();
            $html .= "</div>";
            $html .= "</div>";

            return $html;
        }
    }



    function socials($atts)
    {
        $SVG = new SVG;

        extract(
            shortcode_atts(
                array(
                    'source' => 'theme_options',
                ),
                $atts
            )
        );
        if ($source == 'theme_options') {
            $socials = get__theme_option('socials');
        } else {
            $socials = get__post_meta('socials');
        }
        if ($socials) {
            $html = "<div class='socials d-inline-block'>";
            $html .= "<ul class='d-inline-flex align-items-center m-0 p-0'>";
            foreach ($socials as $social) {
                $url = $social['url'];
                $icon = $social['_type'];
                $html .= "<li>";
                $html .= "<a href='$url' target='_blank'>";
                $html .= $SVG->$icon();
                $html .= "</a>";
                $html .= "</li>";
            }

            $html .= "</ul>";
            $html .= "</div>";
            return $html;
        }
    }

    function site_logo()
    {
        $logo = get__theme_option('logo');
        $site_url = get_site_url();

        $html = "<div class='site-logo'>";
        $html .= "<a href='$site_url'>";
        $html .= __icon_image(array(
            'id' => $logo
        ));
        $html .= "</a>";
        $html .= "</div>";
        return $html;
    }


    function post_title()
    {
        return get_the_title();
    }
    function permalink($atts)
    {
        extract(
            shortcode_atts(
                array(
                    'id' => '',
                ),
                $atts
            )
        );
        return get_the_permalink($id);
    }


    function post_id($atts)
    {
        extract(
            shortcode_atts(
                array(
                    'id' => '',
                ),
                $atts
            )
        );

        return apply_filters('wpml_object_id', $id, 'post');
    }

    function post($atts)
    {
        extract(
            shortcode_atts(
                array(
                    'data' => '',
                ),
                $atts
            )
        );

        $data_val = unserialize($data);

        return do_shortcode(__post($data_val));
    }


    function post_taxonomy_terms($atts)
    {

        extract(
            shortcode_atts(
                array(
                    'post_id' => '',
                    'taxonomy' => ''
                ),
                $atts
            )
        );

        $html = "<div class='post-taxonomy-term text-tiny'>";

        $_taxonomy = unserialize($taxonomy);

        foreach ($_taxonomy as $tax) {
            $html .= _get_terms($post_id, $tax);
        }
        $html .= "</div>";

        return $html;
    }
    function post_author($atts)
    {

        extract(
            shortcode_atts(
                array(
                    'author_id' => '',
                ),
                $atts
            )
        );

        $avatar = get_the_author_meta('avatar', $author_id);
        $name = get_the_author_meta('display_name', $author_id);
        $html = "<div class='author-box text-large fw-medium'>";
        if ($avatar) {
            $html .= "<img src='$avatar' width='140' height='140' class='avatar' alt='$name' />";
        } else {
            $SVG = new SVG;
            $html .= $SVG->user();
        }
        $html .= $name;
        $html .= "</div>";

        return $html;
    }

    function audio_player()
    {
        $audio = get__post_meta('audio');
        if ($audio) {
            ob_start();
            $SVG  = new SVG;
            $audio_url = wp_get_attachment_url($audio);
        ?>
            <div class="audio-player-wrap sm-margin-top">
                <div class="audio-player">
                    <div class="controls">
                        <div class="play-container">
                            <div class="toggle-play play">
                                <div class="play-icon">
                                    <?= $SVG->play() ?>
                                </div>
                                <div class="pause-icon">
                                    <?= $SVG->pause() ?>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-holder">
                            <div class="timeline">
                                <div class="timeline-progress"></div>
                            </div>
                            <div class="time d-flex justify-content-between">
                                <div class="current">0:00</div>
                                <div class="length"></div>
                            </div>
                            <div class="volume-container">
                                <div class="volume-button">
                                    <div class="volume icono-volumeMedium"></div>
                                </div>

                                <div class="volume-slider">
                                    <div class="volume-percentage"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Possible improvements:
                // - Change timeline and volume slider into input sliders, reskinned
                // - Change into Vue or React component
                // - Be able to grab a custom title instead of "Music Song"
                // - Hover over sliders to see preview of timestamp/volume change

                const audioPlayer = document.querySelector(".audio-player");
                const audio = new Audio(
                    "<?= $audio_url ?>"
                );
                //credit for song: Adrian kreativaweb@gmail.com

                console.dir(audio);

                audio.addEventListener(
                    "loadeddata",
                    () => {
                        audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
                            audio.duration
                        );
                        audio.volume = .75;
                    },
                    false
                );

                //click on timeline to skip around
                const timeline = audioPlayer.querySelector(".timeline");
                timeline.addEventListener("click", e => {
                    const timelineWidth = window.getComputedStyle(timeline).width;
                    const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
                    audio.currentTime = timeToSeek;
                }, false);

                //click volume slider to change volume
                const volumeSlider = audioPlayer.querySelector(".controls .volume-slider");
                volumeSlider.addEventListener('click', e => {
                    const sliderWidth = window.getComputedStyle(volumeSlider).width;
                    const newVolume = e.offsetX / parseInt(sliderWidth);
                    audio.volume = newVolume;
                    audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
                }, false)

                //check audio percentage and update time accordingly
                setInterval(() => {
                    const progressBar = audioPlayer.querySelector(".timeline-progress");
                    progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
                    audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
                        audio.currentTime
                    );
                }, 500);

                //toggle between playing and pausing on button click
                const playBtn = audioPlayer.querySelector(".controls .toggle-play");
                playBtn.addEventListener(
                    "click",
                    () => {
                        if (audio.paused) {
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                        } else {
                            playBtn.classList.remove("pause");
                            playBtn.classList.add("play");
                            audio.pause();
                        }
                    },
                    false
                );

                audioPlayer.querySelector(".volume-button").addEventListener("click", () => {
                    const volumeEl = audioPlayer.querySelector(".volume-container .volume");
                    audio.muted = !audio.muted;
                    if (audio.muted) {
                        volumeEl.classList.remove("icono-volumeMedium");
                        volumeEl.classList.add("icono-volumeMute");
                    } else {
                        volumeEl.classList.add("icono-volumeMedium");
                        volumeEl.classList.remove("icono-volumeMute");
                    }
                });

                //turn 128 seconds into 2:08
                function getTimeCodeFromNum(num) {
                    let seconds = parseInt(num);
                    let minutes = parseInt(seconds / 60);
                    seconds -= minutes * 60;
                    const hours = parseInt(minutes / 60);
                    minutes -= hours * 60;

                    if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
                    return `${String(hours).padStart(2, 0)}:${minutes}:${String(
    seconds % 60
  ).padStart(2, 0)}`;
                }
            </script>
<?php
            return ob_get_clean();
        }
    }
}
$Shortcodes = new Shortcodes;
add_shortcode('layouts', array($Shortcodes, 'layouts'));
add_shortcode('post', array($Shortcodes, 'post'));


add_shortcode('blog_meta', array($Shortcodes, 'blog_meta'));
add_shortcode('social_share', array($Shortcodes, 'social_share'));
add_shortcode('post_link', array($Shortcodes, 'post_link'));
add_shortcode('related_posts', array($Shortcodes, 'related_posts'));
add_shortcode('socials', array($Shortcodes, 'socials'));
add_shortcode('site_logo', array($Shortcodes, 'site_logo'));
add_shortcode('post_title', array($Shortcodes, 'post_title'));
add_shortcode('permalink', array($Shortcodes, 'permalink'));
add_shortcode('post_id', array($Shortcodes, 'post_id'));
add_shortcode('post_taxonomy_terms', array($Shortcodes, 'post_taxonomy_terms'));
add_shortcode('post_author', array($Shortcodes, 'post_author'));
add_shortcode('audio_player', array($Shortcodes, 'audio_player'));
