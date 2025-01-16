<?php
function ___logo_slider($section)
{
    $heading = $section['heading'];
    $logos = $section['logos'];

    $html = "<div class='container'>";
    $html .= __heading(array(
        'heading' => $heading,
        'class' => 'xs-margin-bottom'
    ));
    $html .= "</div>";

    $html .= "<div class='carousel d-flex align-items-center carousel-logo-slider'>";
    $html .= "<div class='group d-flex align-items-center'>";
    foreach ($logos as $logo) {
        $html .= "<div class='slide'>";
        $html .= __icon_image(array(
            'id' => $logo,
            'size' => 'medium',
            'class' => 'logo-image'
        ));
        $html .= "</div>";
    }
    $html .= "</div>";
    $html .= "<div class='group d-flex align-items-center '>";
    foreach ($logos as $logo) {
        $html .= "<div class='slide'>";
        $html .= __icon_image(array(
            'id' => $logo,
            'size' => 'medium',
            'class' => 'logo-image'
        ));
        $html .= "</div>";
    }
    $html .= "</div>";
    $html .= "</div>";
    return $html;
}

function __two_columns_image_and_text($section)
{
    $vertical_alignment = $section['vertical_alignment'];
    $swap_column = $section['swap_column'];
    $swap_column_mobile = $section['swap_column_mobile'];

    $column_holder_class[] = 'column-holder d-flex flex-column h-100 lg-padding-top lg-padding-bottom';

    if ($vertical_alignment) {
        $column_holder_class[] = $vertical_alignment;
    } else {
        $column_holder_class[] = 'justify-content-center';
    }

    if ($swap_column) {
        $row_class = 'row flex-row-reverse';
    } else {
        $row_class = 'row';
    }

    if ($swap_column_mobile) {
        $row_class .= ' swap-column-mobile';
    }

    $column_holder_class_val = _array_to_string($column_holder_class);

    $html = "<div class='container'>";
    $html .= "<div class='$row_class gx-80px'>";

    $html .= "<div class='col-lg-6'>";
    $html .= "<div class='$column_holder_class_val'>";
    $html .= __icon_image(array(
        'id' => $section['icon'],
        'size' => 'medium',
        'class' => 'icon-box d-none d-lg-block'
    ));

    $html .= "<div class='content-box content-margin'>";

    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    $html .= __description(array(
        'description' => $section['description'],
        'class' => 'main-desc'
    ));

    $html .= _button_modules($section['buttons']);
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class='col-lg-6 col-image'>";
    $html .= __icon_image(array(
        'id' => $section['image'],
        'size' => 'large',
        'class' => 'main-image'
    ));
    $html .= "</div>";

    $html .= "</div>";
    $html .= "</div>";

    return $html;
}


function __newsletter($section)
{
    $column_holder_class[] = 'column-holder content-margin';

    $column_holder_class_val = _array_to_string($column_holder_class);

    $html = "<div class='container'>";
    $html .= "<div class='row align-items-center'>";

    $html .= "<div class='col-lg-7'>";
    $html .= "<div class='$column_holder_class_val'>";

    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    $html .= __description(array(
        'description' => $section['description']
    ));

    $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class='col-lg-5 col-image'>";
    $html .= $section['form_code'];
    $html .= "</div>";

    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

function __grid($section)
{
    $grids = $section['grids'];

    if ($section['post_box_style'] == 'style-1') {
        $grid_container_class[] = 'text-style-bordered-left-parent';
    }

    $html = "<div class='container'>";
    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    $html .= __description(array(
        'description' => $section['description']
    ));
    if ($grids) {
        $html .= "<div class='grid-container md-margin-top $grid_container_class'>";
        foreach ($grids as $grid) {
            $grid_item_class = [];
            $items = $grid['items'];
            $grid_item_class[] = 'grid-item';
            $background_color = $grid['background_color'];
            $hide_on_mobile = $grid['hide_on_mobile'];
            if ($hide_on_mobile) {
                $grid_item_class[] = "d-none d-lg-block";
            }
            if ($background_color) {
                $grid_item_class[] = "bg-$background_color";
            }
            $grid_item_class_val = _array_to_string($grid_item_class);
            $html .= "<div class='$grid_item_class_val'>";
            $html .= __items($items);
            $html .= "</div>";
        }
        $html .= "</div>";
    }

    $html .= "</div>";

    return $html;
}


function __post($section, $args = [], $settings = [])
{
    $post_type = $section['post_type'][0]['_type'];
    $source = $section['post_type'][0]['source'];
    $post = $section['post_type'][0]['post'];
    $taxonomy = $section['post_type'][0]['taxonomy'];
    $terms = $section['post_type'][0]['terms'];
    $icon_position = $section['icon_position'];
    $heading_line = isset($section['heading_line']) ? $section['heading_line'] : false;
    $args['post_type'] = $post_type;

    if ($source == 'most-recent') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'DATE';
    } else if ($source == 'manually') {
        $post_ids = [];
        foreach ($post as $p) {
            $post_ids[] = $p['id'];
        }
        $args['post__in'] = $post_ids;
    } else {
        $term_ids = [];
        foreach ($terms as $term) {
            $term_ids[] = $term['id'];
        }
        $args['tax_query']   = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_ids
            )
        );
    }


    $args['numberposts'] = isset($section['posts_per_page']) ? $section['posts_per_page'] : 10;

    $settings['is_slider'] = isset($section['is_slider']) ? $section['is_slider'] : false;

    $settings['pagination'] =  isset($section['hide_pagination']) ? false : true;;

    if ($post_type == 'albums') {
        $settings['post_box_style'] = 'post_box_style_1';
    }

    if ($post_type == 'faqs') {
        $settings['navigation'] = false;
    } else {
        $settings['navigation'] = true;
    }

    $html = "<div class='container'>";
    $html .= "<div class='heading-description position-relative content-margin md-margin-bottom icon-$icon_position'>";
    $html .= __icon_image(array(
        'id' => $section['icon'],
        'size' => 'medium',
        'class' => 'icon'
    ));
    if ($heading_line) {
        $html .= "<div class='heading-line'>";
    }
    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    if ($heading_line) {
        $html .= "</div>";
    }
    $html .= __description(array(
        'description' => $section['description'],
        'class' => 'main-desc'
    ));
    $html .= "</div>";
    $html .= "</div>";

    if (isset($section['posts_slider_heading'])) {
        $html .= '<div class="container"> <h3 class="heading text-torquoise mb-3">' . $section['posts_slider_heading'] . '</h3> </div>';
    }

    $html .= _post_query($args, $settings);

    if ($section['buttons']) {
        $html .= "<div class='container text-center sm-margin-top'>";
        $html .= _button_modules($section['buttons']);
        $html .= "</div>";
    }


    return $html;
}


function __accordion($section, $section_id)
{
    $accordion = $section['accordion'];
    $accordion_source = $section['accordion_source'];
    $faqs = $section['faqs'];
    $faqs_category = $section['faqs_category'];

    $html = "<div class='container content-margin'>";

    $html .= __heading(array(
        'heading' => $section['heading'],
        'class' => 'text-center'
    ));
    $html .= __description(array(
        'description' => $section['description'],
        'class' => 'text-center'
    ));

    $html .= _accordion_module(array(
        'accordion'        => $accordion,
        'accordion_source' => $accordion_source,
        'faqs'             => $faqs,
        'faqs_category'    => $faqs_category,
        'open_first_item'  => true,
        'module_id'        => $section_id,
    ));


    $html .= __heading(array(
        'heading' => $section['bottom_heading'],
        'class' => 'text-center',
        'tag' => 'h3'
    ));
    $html .= __description(array(
        'description' => $section['bottom_description'],
        'class' => 'text-center'
    ));
    $html .= _button_modules($section['buttons'], 'text-center');

    $html .= "</div>";

    return $html;
}


function __text_image_section($section)
{
    $image = $section['image'];
    $html = "<div class='container'>";
    $html .= "<div class='content-margin md-margin-bottom'>";
    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    $html .= __description(array(
        'description' => $section['description']
    ));
    $html .= "</div>";

    $html .= __icon_image(array(
        'id' => $image,
        'size' => 'fulll',
    ));

    $html .= "</div>";

    return $html;
}



function __text_over_bg_image($section)
{
    $image = $section['image'];

    $html = __icon_image(array(
        'id' => $image,
        'size' => 'fulll',
        'class' => 'bg-image'
    ));

    $html .= "<div class='container text-center position-relative'>";
    $html .= "<div class='content-margin md-margin-bottom'>";
    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    $html .= __description(array(
        'description' => $section['description'],
        'class' => 'subheading'
    ));
    $html .= "</div>";


    $html .= "</div>";

    return $html;
}


function __contact($section)
{
    $html = "<div class='container position-relative'>";
    $html .= "<div class='row g-0'>";

    $html .= "<div class='col-lg-6 lg-padding-top lg-padding-bottom'>";
    $html .= "<div class='content-margin '>";
    $html .= __heading(array(
        'heading' => $section['heading'],
    ));
    $html .= __description(array(
        'description' => $section['description'],
    ));
    $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class='col-lg-6 lg-padding-top lg-padding-bottom'>";
    $html .= "<div class='form-box'>";
    $html .= do_shortcode($section['contact_form']);
    $html .= "</div>";
    $html .= "</div>";


    $html .= "</div>";
    $html .= "</div>";
    return $html;
}
