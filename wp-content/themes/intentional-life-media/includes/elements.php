<?php
function __heading($data, $html = '')
{
    $heading = isset($data['heading']) ? $data['heading'] : false;
    $class = isset($data['class']) ? $data['class'] : false;
    $tag = isset($data['tag']) ? $data['tag'] : 'h2';
    $prefix = isset($data['prefix']) ? $data['prefix'] : false;
    $suffix = isset($data['suffix']) ? $data['suffix'] : false;
    $post_status = isset($data['link']) ? get_post_status($data['link']) : false;
    $link_var = isset($data['link']) ? $data['link'] : false;
    $link_type = isset($data['link_type']) ? $data['link_type'] : 'post';
    if ($link_var != false) {
        $link = $link_type == 'post' ? get_permalink($data['link']) : get_term_link($data['link']);
    } else {
        $link = false;
    }

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
            if ($link && $post_status == 'publish' || $link && $link_type == 'term') {
                $html .= "<a class='text-inherit text-decoration-none heading-link' href='$link'>";
            }
            $html .= "<$tag>$heading</$tag>";
            if ($link && $post_status == 'publish' || $link && $link_type == 'term') {
                $html .= "</a>";
            }
            if ($suffix) {
                $html .= "<span class='small-text'>$suffix</span>";
            }

            $html .= "</div>";
        } else {
            if ($link && $post_status == 'publish' || $link && $link_type == 'term') {
                $html .= "<a class='text-inherit text-decoration-none heading-link' href='$link'>";
            }
            $html .= "<$tag class='$classes_val'>$heading</$tag>";
            if ($link && $post_status == 'publish' || $link && $link_type == 'term') {
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
    $link_var = isset($data['link']) ? $data['link'] : false;
    $link_type = isset($data['link_type']) ? $data['link_type'] : 'post';
    $post_status = isset($data['link']) ? get_post_status($data['link']) : false;

    if ($link_var != false) {
        $link = $link_type == 'post' ? get_permalink($data['link']) : get_term_link($data['link']);
    } else {
        $link = false;
    }

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
        if ($link && $post_status == 'publish' || $link && $link_type == 'term') {

            $html .= "<a class='text-inherit text-decoration-none' href='$link'>";
        }
        $html .= $image;
        if ($link && $post_status == 'publish' || $link && $link_type == 'term') {

            $html .= '</a>';
        }
        $html .= "</div>";
        return $html;
    }
}


function __video($data)
{
    $id = isset($data['id']) ? $data['id'] : false;
    $class = isset($data['class']) ? $data['class'] : false;
    $link_var = isset($data['link']) ? $data['link'] : false;
    $link_type = isset($data['link_type']) ? $data['link_type'] : 'post';
    $post_status = isset($data['link']) ? get_post_status($data['link']) : false;
    $video = wp_get_attachment_url($id);

    if ($link_var != false) {
        $link = $link_type == 'post' ? get_permalink($data['link']) : get_term_link($data['link']);
    } else {
        $link = false;
    }


    if ($video) {
        $classes[] = 'video-box';
        if ($class) {
            $classes[] = $class;
        }
        $class_val = _array_to_string($classes);

        $html = "<div class='$class_val'>";
        if ($link && $post_status == 'publish' || $link && $link_type == 'term') {

            $html .= "<a class='text-inherit text-decoration-none' href='$link'>";
        }
        $html .= "<video allow='autoplay' loop>";
        $html .= "<source src='$video'>";
        $html .= "</video>";
        if ($link && $post_status == 'publish' || $link && $link_type == 'term') {

            $html .= '</a>';
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
