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

        return do_shortcode(__sections($id));
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

    function social_share()
    {
        global $post;
        $SVG = new SVG;
        $url = get_permalink($post->ID);
        $title = str_replace(' ', '%20', get_the_title($post->ID));

        $social_buttons = '';
        $social_buttons .= '<div class="social-share-buttons">';

        $social_buttons .= '<a href="#" onclick="window.open(\'https://www.facebook.com/sharer.php?u=' . $url . '&t=' . $title . '\', \'_blank\', \'width=600,height=400\'); return false;">' . $SVG->facebook() . '</a>';

        $social_buttons .= '<a href="#" onclick="window.open(\'https://www.linkedin.com/feed/?linkOrigin=LI_BADGE&shareActive=true&shareUrl=' . $url . '\', \'_blank\', \'width=600,height=400\'); return false;">' . $SVG->linkedin() . '</a>';
        $social_buttons .= '<a href="#" onclick="window.open(\'https://x.com/share?url=' . $url . '&text=' . $title . '\', \'_blank\', \'width=600,height=400\'); return false;">' . $SVG->x() . '</a>';
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
