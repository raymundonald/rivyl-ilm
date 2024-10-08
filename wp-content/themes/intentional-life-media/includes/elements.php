<?php
function __heading($data, $html = '')
{
    $heading = isset($data['heading']) ? $data['heading'] : false;
    $class = isset($data['class']) ? $data['class'] : false;
    $tag = isset($data['tag']) ? $data['tag'] : 'h2';
    $prefix = isset($data['prefix']) ? $data['prefix'] : false;
    $suffix = isset($data['suffix']) ? $data['suffix'] : false;
    $post_status = isset($data['link']) ? get_post_status($data['link']) : false;
    $link = isset($data['link']) ? get_permalink($data['link']) : false;

    $classes[] = 'heading';

    if ($class) {
        $classes[] = $class;
    }
    if (isset($classes)) {
        $classes_val = _array_to_string($classes);
    }

    if ($heading) {

        if ($prefix || $suffix) {
            $html .= "<div class='$classes_val'>";

            if ($prefix) {
                $html .= "<span>$prefix</span>";
            }
            if ($link && $post_status == 'publish') {
                $html .= "<a class='text-inherit text-decoration-none heading-link' href='$link'>";
            }
            $html .= "<$tag>$heading</$tag>";
            if ($link && $post_status == 'publish') {
                $html .= "</a>";
            }
            if ($suffix) {
                $html .= "<span class='small-text'>$suffix</span>";
            }

            $html .= "</div>";
        } else {
            if ($link && $post_status == 'publish') {
                $html .= "<a class='text-inherit text-decoration-none heading-link' href='$link'>";
            }
            $html .= "<$tag class='$classes_val'>$heading</$tag>";
            if ($link && $post_status == 'publish') {
                $html .= "</a>";
            }
        }
    }
    return $html;
}

function __description($data)
{
    $description = isset($data['description']) ? $data['description'] : false;
    $class = isset($data['class']) ? $data['class'] : false;
    $autop = isset($data['autop']) ? $data['autop'] : true;
    $classes[] = 'desc-box';

    if ($class) {
        $classes[] = $class;
    }
    if (isset($classes)) {
        $classes_val = _array_to_string($classes);
    }
    if ($description) {
        if ($autop) {
            $description_val = wpautop($description);
        } else {
            $description_val = $description;
        }

        return "<div class='$classes_val'>$description_val</div>";
    }
}

function __icon_image($data)
{
    $mime_type = get_post_mime_type($data['id']);
    if (str_contains($mime_type, 'svg')) {
        return __icon($data);
    } else {
        return __image($data);
    }
}

function __icon($data, $html = '', $classes_val = '')
{
    $id = isset($data['id']) ? $data['id'] : false;
    if ($id) {
        $class = isset($data['class']) ? $data['class'] : 'svg-box';
        if ($class) {
            $classes[] = $class;
        }
        if (isset($classes)) {
            $classes_val = _array_to_string($classes);
        }

        $url = wp_get_original_image_path($id);
        $html .= "<div class='$classes_val'>";
        $html .= _output_svg_from_url($url);
        $html .= '</div>';
    }

    return $html;
}

function __image($data)
{
    $featured_image = isset($data['featured_image']) ? $data['featured_image'] : false;
    $id = isset($data['id']) ? $data['id'] : false;
    $size = isset($data['size']) ? $data['size'] : false;
    $class = isset($data['class']) ? $data['class'] : false;
    $placeholder = isset($data['placeholder']) ? $data['placeholder'] : false;
    $link = isset($data['link']) ? get_permalink($data['link']) : false;

    $attributes_args = [];
    if ($featured_image) {
        $image = get_the_post_thumbnail($featured_image, $size);
    } else {
        $image = wp_get_attachment_image($id, $size);
    }
    if ($image) {
        $classes[] = 'image-box';
        if ($class) {
            $classes[] = $class;
        }
        $class_val = _array_to_string($classes);

        $html = "<div class='$class_val'>";
        if ($link) {
            $html .= "<a class='text-inherit text-decoration-none' href='$link'>";
        }
        $html .= $image;
        if ($link) {
            $html .= '</a>';
        }
        $html .= "</div>";
        return $html;
    } else {
        if ($placeholder) {
            $class = _attribute('class', array('is-placeholder image-box rounded-corner overflow-hidden bg-black'));
            $attributes_args[] = $class;

            $_attributes = _attributes($attributes_args);

            $svg = "<svg fill='#fff' xmlns='http://www.w3.org/2000/svg' width='256' height='26.026' viewBox='0 0 256 26.026'> <g id='Group_170' data-name='Group 170' transform='translate(-99.825 -87.108)'> <g id='Group_172' data-name='Group 172' transform='translate(99.825 87.108)'> <path id='Path_97' data-name='Path 97' d='M137.86,105.141q0,.52-.037,1.3a8.62,8.62,0,0,1-.26,1.673,7.665,7.665,0,0,1-.706,1.784,5.4,5.4,0,0,1-1.376,1.617,7,7,0,0,1-2.25,1.171,10.9,10.9,0,0,1-3.365.446H107.819a10.9,10.9,0,0,1-3.365-.446,6.989,6.989,0,0,1-2.249-1.171,5.391,5.391,0,0,1-1.376-1.617,7.64,7.64,0,0,1-.706-1.784,8.577,8.577,0,0,1-.261-1.673q-.037-.78-.037-1.3V95.1q0-.484.037-1.265a8.577,8.577,0,0,1,.261-1.673,8,8,0,0,1,.706-1.8,5.334,5.334,0,0,1,1.376-1.635,6.989,6.989,0,0,1,2.249-1.171,10.9,10.9,0,0,1,3.365-.446h22.048a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.346,5.346,0,0,1,1.376,1.635,8.027,8.027,0,0,1,.706,1.8,8.621,8.621,0,0,1,.26,1.673q.037.78.037,1.265h-7.994a1.768,1.768,0,0,0-.316-1.134,2.109,2.109,0,0,0-.687-.577,2.606,2.606,0,0,0-1-.26H109.826a2.393,2.393,0,0,0-1,.259,1.677,1.677,0,0,0-1,1.705v10.012a1.923,1.923,0,0,0,.3,1.15,1.785,1.785,0,0,0,.707.593,2.38,2.38,0,0,0,1,.26h18.033a2.641,2.641,0,0,0,1-.256,2.016,2.016,0,0,0,.687-.584,1.789,1.789,0,0,0,.316-1.131Z' transform='translate(-99.825 -87.108)'></path> <path id='Path_98' data-name='Path 98' d='M273.549,87.108a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.35,5.35,0,0,1,1.376,1.635,8.013,8.013,0,0,1,.706,1.8,8.6,8.6,0,0,1,.261,1.673q.036.78.037,1.265v10.039q0,.52-.037,1.3a8.6,8.6,0,0,1-.261,1.673,7.651,7.651,0,0,1-.706,1.784,5.407,5.407,0,0,1-1.376,1.617,7,7,0,0,1-2.25,1.171,10.9,10.9,0,0,1-3.365.446H251.5a10.9,10.9,0,0,1-3.365-.446,6.989,6.989,0,0,1-2.249-1.171,5.4,5.4,0,0,1-1.376-1.617,7.639,7.639,0,0,1-.706-1.784,8.577,8.577,0,0,1-.261-1.673q-.037-.78-.037-1.3V95.1q0-.484.037-1.265a8.578,8.578,0,0,1,.261-1.673,8,8,0,0,1,.706-1.8,5.339,5.339,0,0,1,1.376-1.635,6.989,6.989,0,0,1,2.249-1.171,10.9,10.9,0,0,1,3.365-.446Zm-2.007,20a2.6,2.6,0,0,0,1-.26,2.038,2.038,0,0,0,.688-.593,1.843,1.843,0,0,0,.316-1.15V95.1a1.762,1.762,0,0,0-.316-1.131,2.125,2.125,0,0,0-.688-.575,2.618,2.618,0,0,0-1-.259H253.508a2.4,2.4,0,0,0-1,.259,1.677,1.677,0,0,0-1,1.705v10.012a1.923,1.923,0,0,0,.3,1.15,1.786,1.786,0,0,0,.706.593,2.383,2.383,0,0,0,1,.26Z' transform='translate(-201.754 -87.108)'></path> <path id='Path_99' data-name='Path 99' d='M417.23,87.108a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.35,5.35,0,0,1,1.376,1.635,8.011,8.011,0,0,1,.706,1.8,8.621,8.621,0,0,1,.261,1.673q.036.78.037,1.265t-.037,1.282a8.653,8.653,0,0,1-.261,1.692,7.993,7.993,0,0,1-.706,1.8,5.148,5.148,0,0,1-1.376,1.617,7.533,7.533,0,0,1-2.25,1.171,10.478,10.478,0,0,1-3.365.465H395.183v10h-7.994V87.108Zm-2.007,10a2.6,2.6,0,0,0,1-.26,2.022,2.022,0,0,0,.688-.595,1.847,1.847,0,0,0,.316-1.152,1.768,1.768,0,0,0-.316-1.134,2.11,2.11,0,0,0-.688-.577,2.6,2.6,0,0,0-1-.26H395.183v3.977Z' transform='translate(-303.683 -87.108)'></path> <path id='Path_100' data-name='Path 100' d='M568.906,87.108v6.024H553.886v20h-7.994v-20H530.871V87.108Z' transform='translate(-405.611 -87.108)'></path> <path id='Path_101' data-name='Path 101' d='M702.587,103.133l10,10h-10l-10-10H682.547v10h-7.994V87.108h30.041a10.9,10.9,0,0,1,3.365.446,7,7,0,0,1,2.25,1.171,5.342,5.342,0,0,1,1.376,1.635,8.024,8.024,0,0,1,.706,1.8,8.594,8.594,0,0,1,.26,1.673q.037.78.037,1.265t-.037,1.282a8.627,8.627,0,0,1-.26,1.692,8.006,8.006,0,0,1-.706,1.8,5.141,5.141,0,0,1-1.376,1.617,7.532,7.532,0,0,1-2.25,1.171,10.479,10.479,0,0,1-3.365.465Zm0-6.024a2.6,2.6,0,0,0,1-.26,2.021,2.021,0,0,0,.687-.595,1.847,1.847,0,0,0,.316-1.152,1.768,1.768,0,0,0-.316-1.134,2.108,2.108,0,0,0-.687-.577,2.6,2.6,0,0,0-1-.26h-20.04v3.977Z' transform='translate(-507.54 -87.108)'></path> <path id='Path_102' data-name='Path 102' d='M856.27,93.12l-28.034,13.991H856.27v6.023H818.235v-7.993l26.026-12.009H818.235V87.108H856.27Z' transform='translate(-609.469 -87.108)'></path> </g> <path id='Path_103' data-name='Path 103' d='M964.486,87.884l-.041-.007-1.13,2.823h-.34l-1.15-2.916-.041.007V90.7h-.367V87.108h.5l1.209,3.023h.041l1.223-3.023h.461V90.7h-.367Zm-3.589-.395h-1.056V90.7h-.374v-3.21H958.33v-.381H960.9Z' transform='translate(-609.028)'></path> </g> </svg>";

            $html = "<div $_attributes>";
            if ($link) {
                $html .= "<a class='text-inherit text-decoration-none' href='$link'>";
            }
            $html .= $svg;
            if ($link) {
                $html .= '</a>';
            }
            $html .= "</div>";
            return $html;
        }
    }
}

function __video($data)
{
    $video_url = wp_get_attachment_url($data['video_id']);
    $video_type = isset($data['video_type']) ? $data['video_type'] : false;
    $autoplay = isset($data['autoplay']) ? $data['autoplay'] : true;
    $class = isset($data['class']) ? $data['class'] : false;
    $attributes_args = [];
    if ($class) {
        $attributes_args[] = $class;
    }
    $_attributes = _attributes($attributes_args);

    if ($video_type == 'youtube') {
        $parameters = '';
        $youtube_video_id = $data['youtube_video_id'];
        if ($autoplay) {
            $parameters = "?loop=1&controls=0&rel=0&playsinline=1&autoplay=1&mute=1&controls=0&playlist=$youtube_video_id";
        }
        $source = "https://www.youtube.com/embed/$youtube_video_id$parameters";
        return "<div $_attributes><iframe src='$source'></iframe></div>";
    } else {
        if ($video_url) {

            $parameters = '';
            if ($autoplay) {
                $parameters = 'autoplay loop muted';
            } else {
                $parameters = 'controls';
            }


            return "<div $_attributes><video  $parameters src='$video_url'></video></div>";
        }
    }
}

function __background($background, $is_youtube = false)
{
    if ($is_youtube == false) {
        $mime_type = get_post_mime_type($background);
        if (str_contains($mime_type, 'video')) {
            return __video(array(
                'video_id' => $background,
                'class'    => _attribute('class', array('background-image', 'background-overlay'))
            ));
        } else {
            return __image(array(
                'id' => $background,
                'class'    => _attribute('class', array('background-image', 'background-overlay')),
                'size'     => 'full'
            ));
        }
    } else {
        return "<div class='background-image background-overlay'><div id='player' video_id='$background'></div></iframe></div>";
    }
}

function __post_category($id, $category, $class = '')
{
    $terms = get_the_terms($id, $category);
    if ($terms) {
        $html = "<div class='position-relative small-text post-category mb-2 $class'>";

        foreach ($terms as $term) {
            $term_link = get_term_link($term->term_id);
            $term_name = $term->name;
            $html .= "<a href='$term_link'>";
            $html .= $term_name;
            $html .= "</a>";
        }

        $html .= "</div>";
        return $html;
    }
}

function __button($data)
{
    $button_type = isset($data['button_type']) ? $data['button_type'] : false;
    $button_text = isset($data['button_text']) ? $data['button_text'] : false;
    $button_url = isset($data['button_url']) ? $data['button_url'] : false;
    $button_url_custom = isset($data['button_url_custom']) ? $data['button_url_custom'] : false;
    $button_style = isset($data['button_style']) ? $data['button_style'] : false;
    $button_text = isset($data['button_text']) ? $data['button_text'] : false;
    $button_target = isset($data['button_target']) ? $data['button_target'] : false;
    $link = '';
    $class = '';
    $display = true;


    if ($button_type != 'popups' && $button_type != 'custom') {
        $tag = 'a';
        $post_status = get_post_status($button_url['id']);
        $button_url = '[permalink id=' . $button_url['id'] . ']';
        $link = "href='$button_url'";
        if ($post_status != 'publish') {
            $display = false;
        }
    } else if ($button_type == 'custom') {
        $button_url = $button_url_custom;
        $tag = 'a';
        $link = "href='$button_url_custom'";
    } else if ($button_type == 'popups') {
        global $popups_id;
        $popups_id[] = $button_url;
        $tag = 'button';
        $link = 'data-bs-toggle="modal" data-bs-target="#modal-[post_id id=' . $button_url . ']"';
    }

    if ($button_text && $link && $display == true) {
        $classes[] = $button_style;
        $classes[] = 'button-box';
        $classes_val = _array_to_string($classes);
        $html = "<div class='$classes_val'>";
        $html .= "<$tag class='$class' $link $button_target>";
        $html .= $button_text;
        $html .= "</$tag>";
        $html .= "</div>";

        return $html;
    }
}


function __post_author($author_id)
{
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


function __post_taxonomy_terms($post_id, $taxonomy)
{
    $html = "<div class='post-taxonomy-term text-tiny'>";

    if (is_array($taxonomy)) {
        foreach ($taxonomy as $tax) {
            $html .= _get_terms($post_id, $tax);
        }
    } else {
        $html .= _get_terms($post_id, $taxonomy);
    }
    $html .= "</div>";

    return $html;
}


function _get_terms($post_id, $taxonomy, $html = '')
{
    $terms = get_the_terms($post_id, $taxonomy);
    if ($terms) {
        foreach ($terms as $term) {
            $term_link = get_term_link($term->term_id, $taxonomy);
            $html .= "<a href='$term_link'>";
            $html .= $term->name;
            $html .= "</a>";
        }

        return $html;
    }
}
