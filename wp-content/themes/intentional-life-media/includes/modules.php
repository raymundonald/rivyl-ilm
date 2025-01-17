<?php
function action_module_content()
{
    // Check if a post was updated (add your specific conditions here)
    if (did_action('post_updated')) {
        // Check if this is an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        $post_types = array(
            'layouts',
        );
        $template = get_page_template_slug();

        if ($template == 'templates/page-modules.php' || $template == 'templates/page-library-of-hope.php' || in_array(get_post_type(), $post_types)) {
            $content_html = '<!-- wp:html -->';
            $content_html .= __sections(get_the_ID());
            $content_html .= '<!-- /wp:html -->';

            if ($content_html) {
                $my_post = array(
                    'ID'           => get_the_ID(),
                    'post_content' => $content_html
                );
                wp_update_post($my_post);
            }
        }
    }
}
add_action('shutdown', 'action_module_content');


function __hero($id)
{
    $hero_style = get__post_meta_by_id($id, 'hero_style');

    if ($hero_style != 'no-hero') {
        $hero_alt_text = get__post_meta_by_id($id, 'hero_alt_text');
        $hero_buttons = get__post_meta_by_id($id, 'hero_buttons');
        $icon = get__post_meta_by_id($id, 'icon');
        $mobile_bg = get__post_meta_by_id($id, 'mobile_bg');

        $hero_desc = get_the_excerpt($id);
        $hero_image = get_the_post_thumbnail($id, 'full', array('class' => 'desktop-bg'));
        $hero_image_mobile = wp_get_attachment_image($mobile_bg, 'full');
        $hero_title = $hero_alt_text ? $hero_alt_text : get_the_title($id);


        $heading_class = '';
        $hero_content_classes[] = 'hero-content left-right-padding position-relative';
        $hero_desc_classes[] = 'hero-desc';
        $hero_classes[] = 'hero position-relative d-flex align-items-end';
        if ($mobile_bg) {
            $hero_classes[] = 'has-mobile-bg';
        }
        if ($hero_style == 'hero-content-over-image') {
            $hero_classes[] = 'lg-padding-bottom lg-padding-top';
            $heading_class = "large-heading";
        } else  if ($hero_style == 'hero-content-below-image') {
            $hero_content_classes[] = 'bg-light-gray sm-padding-top sm-padding-bottom';
            $hero_desc_classes[] = 'text-style-bordered-left';
        } else {
            $hero_classes[] = 'lg-padding-top';
        }
        if ($hero_style) {
            $hero_classes[] = $hero_style;
        }
        $hero_classes_val = _array_to_string($hero_classes);
        $hero_content_classes_val = _array_to_string($hero_content_classes);
        $hero_desc_classes_val = _array_to_string($hero_desc_classes);
        $html = "<section class='$hero_classes_val'>";
        $html .= "<div class='hero-inner w-100'>";
        if ($hero_image && $hero_style != 'hero-text-icon-only') {
            $html .= "<div class='hero-image bg-image'>";
            $html .= $hero_image;
            $html .= $hero_image_mobile;
            $html .= "</div>";
        }


        $html .= "<div class='$hero_content_classes_val'>";
        $html .= "<div class='container position-relative'>";

        if ($hero_style == 'hero-text-icon-only') {
            $html .= "<div class='heading-description position-relative content-margin md-margin-bottom icon-right content-center'>";
        }
        if ($icon) {
            $html .= __icon_image(array(
                'id' => $icon,
                'class' => 'hero-icon icon',
                'size' => 'medium',
            ));
        }

        $html .= "<h1 class='$heading_class'>$hero_title</h1>";
        if (get_the_excerpt()) {
            $html .= "<div class='$hero_desc_classes_val'>";
            $html .= wpautop($hero_desc);
            $html .= "</div>";
        }

        if ($hero_style == 'hero-text-icon-only') {
            $html .= "</div>";
        }

        if ($hero_buttons) {
            $html .= _button_modules($hero_buttons);
        }
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</section>";

        return $html;
    }
}

function __hero_default($hero_title, $hero_desc = false, $hero_image = false)
{


    $html = "<section class='hero position-relative d-flex align-items-end lg-padding-top hero-content-over-image hero-content-over-image-not-fh'>";
    $html .= "<div class='hero-inner w-100'>";
    if ($hero_image) {
        $html .= "<div class='hero-image bg-image'>";
        $html .= wp_get_attachment_image($hero_image, 'full');
        $html .= "</div>";
    }


    $html .= "<div class='hero-content left-right-padding position-relative'>";
    $html .= "<div class='container position-relative'>";


    $html .= "<h1>$hero_title</h1>";

    if ($hero_desc) {
        $html .= "<div class='hero-desc'>";
        $html .= wpautop($hero_desc);
        $html .= "</div>";
    }




    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</section>";

    return $html;
}

function __sections($id)
{
    $sections = get__post_meta_by_id($id, 'sections');

    if ($sections) {
        $layouts_arr = [];
        $html = '';
        $styles_val = '';
        $scripts_val = '';
        foreach ($sections as $key => $section) {
            $type = $section['_type'];
            $custom_classes = isset($section['custom_classes']) ? $section['custom_classes'] : false;
            $custom_id = isset($section['custom_id']) ? $section['custom_id'] : false;
            $container_width = isset($section['container_width']) ? $section['container_width'] : false;
            $section_classes = [];
            $inline_styles = [];
            $heading_style = [];
            $text_styles = [];
            $styles = isset($section['styles']) ? $section['styles'] : [];
            if ($custom_classes) {
                $section_classes[] = $custom_classes;
            }
            if ($container_width) {
                $section_classes[] = $container_width;
            }
            if ($custom_id) {
                $section_id = $custom_id;
                $custom_id_val = "id='$section_id'";
            } else {
                $section_id = "section-$id-$type-$key";
                $custom_id_val = "id='$section_id'";
            }

            //heading styles
            $heading_color = isset($section['heading_color']) ? $section['heading_color'] : false;
            $decor_color = isset($section['decor_color']) ? $section['decor_color'] : false;
            $heading_has_decor = isset($section['heading_has_decor']) ? $section['heading_has_decor'] : false;

            if ($heading_color || $decor_color || $heading_has_decor) {
                $heading_style['_type'] = 'heading';
            }
            if ($heading_color) {
                $heading_style['heading_color'] = $heading_color;
            }
            if ($decor_color) {
                $heading_style['decor_color'] = $decor_color;
            }
            if ($heading_has_decor) {
                $heading_style['heading_has_decor'] = $heading_has_decor;
            }
            if ($heading_style) {
                $styles[] = $heading_style;
            }

            //text-styles
            $text_has_decor = isset($section['text_has_decor']) ? $section['text_has_decor'] : false;
            $text_color = isset($section['text_color']) ? $section['text_color'] : false;
            if ($text_has_decor || $text_color) {
                $text_styles['_type'] = 'text';
            }
            if ($text_has_decor) {
                $text_styles['text_has_decor'] = $text_has_decor;
            }
            if ($text_color) {
                $text_styles['text_color'] = $text_color;
            }
            if ($text_styles) {
                $styles[] = $text_styles;
            }
            switch ($type) {
                case 'layouts':
                    $layouts = $section['layouts'];
                    foreach ($layouts as $layout) {
                        $layout_id = $layout['id'];
                        $html .= "[layouts id='$layout_id']";
                        $layouts_arr[] = $layout_id;
                        $section_html = false;
                    }
                    break;
                case 'logo_slider':
                    $section_classes[] = 'logo-slider md-padding-top md-padding-bottom';
                    $section_html = ___logo_slider($section);
                    break;
                case 'two_columns_image_and_text':
                    $section_classes[] = 'two-column-image-text overflow-hidden';
                    $full_height = $section['full_height'];
                    $sticky_content = $section['sticky_content'];
                    if ($full_height) {
                        $section_classes[] = 'full-height';
                    }
                    if ($sticky_content) {
                        $section_classes[] = 'sticky-content';
                    }
                    $section_html = __two_columns_image_and_text($section);
                    break;
                case 'newsletter':
                    $section_classes[] = 'newsletter lg-padding-top lg-padding-bottom left-right-padding';
                    $section_html = __newsletter($section);
                    break;
                case 'grid':
                    $section_classes[] = 'grids lg-padding-top lg-padding-bottom left-right-padding';
                    $grid_columns_desktop = $section['grid_columns_desktop'];
                    $grid_columns_tablet = $section['grid_columns_tablet'];
                    $grid_columns_mobile = $section['grid_columns_mobile'];
                    $post_box_style = $section['post_box_style'];
                    if ($post_box_style) {
                        $section_classes[] = $post_box_style;
                    }

                    $inline_styles[] = "--grid-column-desktop: $grid_columns_desktop";
                    $inline_styles[] = "--grid-column-tablet: $grid_columns_tablet";
                    $inline_styles[] = "--grid-column-mobile: $grid_columns_mobile";

                    $section_html = __grid($section);
                    break;
                case 'post':
                    $post_type = $section['post_type'][0]['_type'];
                    $slide_view_type = isset($section['slide_view_type']) ? $section['slide_view_type'] : '';

                    if ($slide_view_type == 'slide-width') {
                        $section_classes[] = 'slide-width';
                        $slides_width_wide = $section['slides_width_wide'] ? $section['slides_width_wide'] : '390px';
                        $slides_width_desktop = $section['slides_width_desktop'] ? $section['slides_width_desktop'] : '370px';
                        $slides_width_tablet_landscape = $section['slides_width_tablet_landscape'] ? $section['slides_width_tablet_landscape'] : '350px';
                        $slides_width_tablet_portrait = $section['slides_width_tablet_portrait'] ? $section['slides_width_tablet_portrait'] : '300px';
                        $slides_width_mobile = $section['slides_width_mobile'] ? $section['slides_width_mobile'] : '275px';

                        $inline_styles[] = "--slides-width-wide: $slides_width_wide";
                        $inline_styles[] = "--slides-width-desktop: $slides_width_desktop";
                        $inline_styles[] = "--slides-width-tablet-landscape: $slides_width_tablet_landscape";
                        $inline_styles[] = "--slides-width-tablet-portrait: $slides_width_tablet_portrait";
                        $inline_styles[] = "--slides-width-mobile: $slides_width_mobile";
                    } else {
                        $slides_per_view_wide = $section['slides_per_view_wide'] ? $section['slides_per_view_wide'] : 3.95;
                        $slides_per_view_desktop = $section['slides_per_view_desktop'] ? $section['slides_per_view_desktop'] : 2.95;
                        $slides_per_view_tablet_landscape = $section['slides_per_view_tablet_landscape'] ? $section['slides_per_view_tablet_landscape'] : 1.95;
                        $slides_per_view_tablet_portrait = $section['slides_per_view_tablet_portrait'] ? $section['slides_per_view_tablet_portrait'] : 1.95;
                        $slides_per_view_mobile = $section['slides_per_view_mobile'] ? $section['slides_per_view_mobile'] : 0.95;
                    }
                    $section_classes[] = "post lg-padding-top lg-padding-bottom left-right-padding post-$post_type";
                    $sections_val = serialize($section);
                    $section_html = "[post data='$sections_val']";
                    $slider_id = "slider_" . str_replace('-', '_', $section_id);

                    if ($section['is_slider']) {
                        if ($slide_view_type == 'slide-width') {
                            $scripts_val .= "
                            var $slider_id = new Swiper('#$section_id .swiper-post-slider', {
                                spaceBetween: 20,
                                slidesPerView: 'auto',
                                pagination: {
                                    el: '#$section_id .swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '#$section_id .swiper-button-next',
                                    prevEl: '#$section_id .swiper-button-prev',
                                }
                            });
                        ";
                        } else {
                            $scripts_val .= "
                            var $slider_id = new Swiper('#$section_id .swiper-post-slider', {
                                spaceBetween: 20,
                                pagination: {
                                    el: '#$section_id .swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '#$section_id .swiper-button-next',
                                    prevEl: '#$section_id .swiper-button-prev',
                                },
                                breakpoints: {
                                    0: {
                                        slidesPerView: $slides_per_view_mobile,
                                    },
                                    768: {
                                        slidesPerView: $slides_per_view_tablet_portrait,
                                    },
                                    992: {
                                        slidesPerView: $slides_per_view_tablet_landscape,
                                    },
                                    1200: {
                                        slidesPerView: $slides_per_view_desktop,
                                    },
                                    1441: {
                                        slidesPerView: $slides_per_view_wide,
                                    },
                                }
                            });
                        ";
                        }
                    }
                    break;
                case 'accordion':
                    $section_classes[] = 'accordion-section lg-padding-top lg-padding-bottom left-right-padding';
                    $section_html = __accordion($section, $section_id);
                    break;
                case 'text_image_section':
                    $section_classes[] = 'text-image-section sm-padding-top sm-padding-bottom left-right-padding';
                    $section_html = __text_image_section($section);
                    break;
                case 'text_over_bg_image':
                    $section_classes[] = 'text-over-bg-image-section left-right-padding';
                    $section_html = __text_over_bg_image($section);
                    break;

                case 'contact':
                    $section_classes[] = 'contact bg-half';
                    $inline_styles[] = "--background-color: var(--light-gray)";
                    $section_html = __contact($section);
                    break;
            }

            $section_classes_val = _array_to_string($section_classes);
            $inline_styles_val = _array_to_string($inline_styles, ';');

            if ($section_html) {
                $html .= "<section class='$section_classes_val' $custom_id_val style='$inline_styles_val'>";
                $html .= $section_html;
                $html .= "</section>";
            }

            $styles_val .= __custom_css($section_id, $styles);
            $scripts_val .= __custom_scripts($section_id, $styles);
        }
        if ($layouts_arr) {
            update_post_meta($id, '_layouts', $layouts_arr);
        }

        if ($styles_val) {
            update_post_meta($id, '_custom_css', $styles_val);
        } else {
            delete_post_meta($id, '_custom_css');
        }
        if ($scripts_val) {
            update_post_meta($id, '_custom_scripts', $scripts_val);
        } else {
            delete_post_meta($id, '_custom_scripts');
        }
        return $html;
    }
}

function __items($items)
{
    $html = '';
    foreach ($items as $key => $item) {
        $type = $item['_type'];
        switch ($type) {
            case 'heading':
                $html .= __heading(array(
                    'heading' => $item['heading'],
                    'tag' => 'h3',
                ));
                break;
            case 'description':
                $html .= __description(array(
                    'description' => $item['description']
                ));
                break;
            case 'image':
                $html .= __icon_image(array(
                    'id' => $item['image'],
                    'size' => 'large',
                ));
                break;
        }
    }
    return $html;
}
function __custom_scripts($section_id, $styles, $script = '')
{
    if ($styles) {
        foreach ($styles as $style) {
            $type = $style['_type'];
            switch ($type) {
                case 'background':
                    if (isset($style['background_color'])) {
                        $background_color = $style['background_color'];
                        $script .= "jQuery('#$section_id').addClass('has-background bg-$background_color');";
                    }
                    break;
                case 'heading':
                    if (isset($style['heading_has_decor'])) {
                        $script .= "jQuery('#$section_id h2.heading').addClass('decor');";
                    }
                    break;
                case 'text':
                    if (isset($style['text_has_decor'])) {
                        $script .= "jQuery('#$section_id .main-desc').addClass('text-style-bordered-left');";
                    }
                    break;
            }
        }
        return $script;
    }
}

function __custom_css($section_id, $styles, $css = '')
{
    if ($styles) {
        $css .= "#$section_id {";
        foreach ($styles as $style) {
            $type = $style['_type'];
            switch ($type) {
                case 'heading':
                    $heading_color = isset($style['heading_color']) ? $style['heading_color'] : false;
                    $decor_color = isset($style['decor_color']) ? $style['decor_color'] : false;
                    if ($heading_color) {
                        $css .= "--heading-color: var(--$heading_color);";
                    }
                    if ($decor_color) {
                        $css .= "--decor-color: var(--$decor_color);";
                    }
                    break;
                case 'text':
                    $text_color = isset($style['text_color']) ? $style['text_color'] : false;
                    if ($text_color) {
                        $css .= "--text-color: var(--$text_color);";
                    }
                    break;
            }
        }
        $css .= '}';
        return $css;
    }
}


function _array_to_string($classes, $sep = ' ')
{
    return implode($sep, $classes);
}
function _output_svg_from_url($url)
{
    $content = file_get_contents($url);

    // Output the sanitized SVG
    return $content;
}

function _button_modules($buttons, $buttons_alignment = '')
{
    if (count($buttons) > 0) {
        $html = "<div class='button-group-box $buttons_alignment'>";
        $html .= "<div class='row g-3 justify-content-center d-inline-flex'>";
        foreach ($buttons as $button) {
            $html .= __button(array(
                'button_type'       => $button['button_type'],
                'button_text'       => $button['button_text'],
                'button_url'        => isset($button['button_url'][0]) ? $button['button_url'][0] : false,
                'button_url_custom' => $button['button_url_custom'],
                'button_style'      => $button['button_style'] . ' col-auto',
                'button_target'     => $button['button_target'],
            ));
        }
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }
}


function _accordion_module($data, $class = '')
{

    $module_id = isset($data['module_id']) ? $data['module_id'] : 'accordion';
    $faqs = isset($data['faqs']) ? $data['faqs'] : false;
    $accordion_source = isset($data['accordion_source']) ? $data['accordion_source'] : false;
    $faqs_category = isset($data['faqs_category']) ? $data['faqs_category'] : false;
    $faqs = isset($data['accordion_source']) ? $data['accordion_source'] : false;
    $accordion = isset($data['accordion']) ? $data['accordion'] : false;
    $open_first_item = isset($data['open_first_item']) ? $data['open_first_item'] : false;

    if ($accordion_source == 'faqs') {
        $accordion = array();
        foreach ($faqs as $faq) {
            $accordion[$faq['id']] = array(
                'heading'     => get_the_title($faq['id']),
                'description' => get_the_content(null, false, $faq['id']),
            );
        }
    } else if ($accordion_source == 'faqs_category') {
        $faqs_cat_id = array();
        foreach ($faqs_category as $faqs_cat) {
            $faqs_cat_id[] = $faqs_cat['id'];
        }
        $args = array(
            'post_type'   => 'faqs',
            'post_status' => 'publish',
            'numberposts' => -1,
            'tax_query'   => array(
                array(
                    'taxonomy' => 'faqs_category',
                    'field'    => 'term_id',
                    'terms'    => $faqs_cat_id
                )
            )
        );
        $faqs_lists = get_posts($args);
        $accordion = array();
        foreach ($faqs_lists as $faq) {
            $accordion[$faq->ID] = array(
                'heading'     => $faq->post_title,
                'description' => $faq->post_content
            );
        }
    } else {
        $accordion = $accordion;
    }
    $html = "<div class='accordion md-margin-top md-margin-bottom $class accordion-flush' id='accordion-$module_id'>"; //accordion
    $index = 0;
    foreach ($accordion as $key => $accordion_item) {
        $heading = $accordion_item['heading'];
        $description = $accordion_item['description'];
        $button_class = $index == 0 && $open_first_item ? '' : 'collapsed';
        $content_class = $index == 0 && $open_first_item ? 'show' : '';
        $aria_expanded = $index == 0 && $open_first_item ? 'true' : 'false';
        $html .= "<div class='accordion-item'>"; //accordion-item
        $html .= "<h3 class='accordion-header' id='flush-heading-$key'>";
        $html .= "<button class='accordion-button justify-content-between $button_class' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse-$key' aria-expanded='$aria_expanded' aria-controls='flush-collapse-$key'>";
        $html .= "<span> ";
        $html .= $heading;
        $html .= "</span> ";
        $html .= "<span class='plus-minus'></span>";
        $html .= "</button>";
        $html .= "</h3>";

        $html .= "<div id='flush-collapse-$key' class='accordion-collapse collapse $content_class' aria-labelledby='flush-heading-$key' data-bs-parent='#accordion-$module_id'>";
        $html .= __description(array(
            'description' => $description,
        ));
        $html .= "</div>";
        $html .= "</div>"; //end-accordion-item
        $index++;
    }
    $html .= "</div>"; //end-accordion

    return $html;
}

function _post_query($args, $settings, $type = 'post', $html = "<div class='post-grid-holder'>")
{

    if ($type == 'user') {
        $posts = get_users($args);
    } else if ($type == 'terms') {
        $posts = get_terms($args);
    } else {
        $posts = get_posts($args);
    }
    $post_grid = array(
        'post',
        'podcasts'
    );
    $container_class = isset($settings['container_class']) ? $settings['container_class'] : '';
    $container_id = isset($settings['container_id']) ? $settings['container_id'] : '';
    if ($settings['is_slider'] == true) {
        if ($settings['pagination'] == true) {
            $html .= _swiper_pagination();
        }
        $html .= "<div class='carousel-container $container_class' id='$container_id'>";
        $html .= "<div class='container'>";
        $parent_class = "swiper swiper-post-slider";
        $item_class = 'swiper-slide';
    } else {
        $html .= "<div class='container $container_class' id='$container_id'>";
        $parent_class = 'row';
        if ($args['post_type'] == 'testimonials') {
            $item_class = 'col-lg-4 col-md-6';
        } else if ($args['post_type'] == 'team') {
            $item_class = 'col-lg-3 col-md-6';
        } else if ($args['post_type'] == 'any') {
            $item_class = 'col-lg';
        }
    }
    if (isset($settings['show_post_type_label']) && !is_bool($settings['show_post_type_label'])) {
        $html .= "<div class='text-label-style-1 mb-2'>" . $settings['show_post_type_label'] . "</div>";
    }
    $html .= "<div class='$parent_class'>";
    if ($settings['is_slider'] == true) {
        $html .= "<div class='swiper-wrapper'>";
    }

    foreach ($posts as $post) {
        $id = $post->ID;
        $html .= "<div class='$item_class' id='post-$id'>";

        if (isset($args['post_type']) && in_array($args['post_type'], $post_grid)) {
            $html .= _post_grid($post, $args['post_type']);
        } else {
            if (isset($args['post_type']) && $args['post_type'] == 'testimonials') {
                $html .= _testimonial_grid($post);
            } else if (isset($args['post_type']) && $args['post_type'] == 'team') {
                $html .= _team_grid(array(
                    'id' => $post->ID,
                    'post_title' => $post->post_title,
                    'post_excerpt' => $post->post_excerpt,
                ));
            } else if (isset($args['post_type'])) {
                $post_box_settings['type'] = 'post';
                if ($args['post_type'] == 'albums' || $args['post_type'] == 'playlists') {
                    $post_box_style = 'post_box_style_1';
                } else if ($args['post_type'] == 'videos') {
                    $post_box_style = 'video_player_box';
                    $post_box_settings['show_year'] = true;
                } else if ($args['post_type'] == 'livestreams') {
                    $post_box_style = 'post_box_style_1';
                    $post_box_settings['show_avatar_as_image'] = true;
                    $post_box_settings['bg_color'] = get__post_meta_by_id($id, 'color');
                } else if ($args['post_type'] == 'on-demand') {
                    $post_box_style = 'video_player_box';
                }
                $html .= post_box_styles($type, $post, $post_box_style, $post_box_settings);
            }
        }

        $html .= "</div>";
    }
    if ($settings['is_slider'] == true) {
        $html .= "</div>";

        $html .= "</div>";
        $html .= "</div>";
    } else {
        $html .= "</div>";
    }
    $html .= "</div>";
    if ($settings['navigation'] == true && $settings['is_slider'] == true) {
        $html .= _swiper_navigation();
    }
    $html .= "</div>";
    return $html;
}

function _post_query_v2($args, $settings, $html = "<div class='post-grid-holder'>")
{
    if (isset($settings['post_box_settings']['type'])) {
        $type = $settings['post_box_settings']['type'];
    } else {
        $type = 'post';
    }

    if ($type == 'user') {
        $posts = get_users($args);
    } else if ($type == 'terms') {
        $posts = get_terms($args);
    } else {
        $posts = get_posts($args);
    }

    $container_class = isset($settings['container_class']) ? $settings['container_class'] : '';
    $container_id = isset($settings['container_id']) ? $settings['container_id'] : '';
    if ($settings['is_slider'] == true) {
        if ($settings['pagination'] == true) {
            $html .= _swiper_pagination();
        }
        $html .= "<div class='carousel-container $container_class' id='$container_id'>";
        $html .= "<div class='container'>";
        $parent_class = "swiper swiper-post-slider";
        $item_class = 'swiper-slide';
    } else {
        $html .= "<div class='container $container_class' id='$container_id'>";
        $parent_class = 'row';
        if ($args['post_type'] == 'testimonials') {
            $item_class = 'col-lg-4 col-md-6';
        } else if ($args['post_type'] == 'team') {
            $item_class = 'col-lg-3 col-md-6';
        } else if ($args['post_type'] == 'any') {
            $item_class = 'col-lg';
        }
    }
    if (isset($settings['post_box_settings']['show_post_type_label']) && !is_bool($settings['post_box_settings']['show_post_type_label'])) {
        $html .= "<div class='text-label-style-1 mb-2'>" . $settings['post_box_settings']['show_post_type_label'] . "</div>";
    }
    $html .= "<div class='$parent_class'>";
    if ($settings['is_slider'] == true) {
        $html .= "<div class='swiper-wrapper'>";
    }

    foreach ($posts as $post) {
        $id = $post->ID;
        $html .= "<div class='$item_class' id='post-$id'>";

        $html .= post_box_styles($type, $post, $settings['post_box_style'], isset($settings['post_box_settings']) ? $settings['post_box_settings'] : false);


        $html .= "</div>";
    }
    if ($settings['is_slider'] == true) {
        $html .= "</div>";

        $html .= "</div>";
        $html .= "</div>";
    } else {
        $html .= "</div>";
    }
    $html .= "</div>";
    if ($settings['navigation'] == true && $settings['is_slider'] == true) {
        $html .= _swiper_navigation();
    }
    $html .= "</div>";
    return $html;
}

function post_box_styles($type, $post, $post_box_style, $post_box_settings = false)
{
    $html = '';
    if ($type == 'user') {
        $post_data['link'] = get_author_posts_url($post->ID);
        $post_data['title'] = $post->display_name;
        $post_data['image'] = get_avatar($post->user_email, 300);
    } else if ($type == 'terms') {
        $post_data['id'] = $post->term_id;
        $post_data['link'] = $post->term_id;
        $post_data['title'] = $post->name;
        $post_data['image'] = 559;
    } else {
        $post_data['post_type'] = $post->post_type;
        $post_data['id'] = $post->ID;
        $post_data['link'] = $post->ID;
        $post_data['title'] = $post->post_title;
        $post_data['desc'] = $post->post_excerpt;
        if (isset($post_box_settings['show_avatar_as_image']) && $post_box_settings['show_avatar_as_image'] == true) {
            $post_data['image'] = get_avatar($post->post_author, 300);
        } else {
            $post_data['image'] = get_post_thumbnail_id($post->ID, 'medium');
        }
        $post_data['meta_data'] = array(
            'author' =>  get_the_author_meta('display_name', $post->post_author),
            'year' => get_the_date('Y', $post->ID)
        );
    }
    if ($post_box_style == 'post_box_style_1') {
        $html .= _post_box_style_1($post_data, $post_box_settings);
    } else if ($post_box_style == 'post_box_style_2') {
        $html .= _post_box_style_2($post_data, $post_box_settings);
    } else if ($post_box_style == 'post_box_style_3') {
        $html .= _post_box_style_3($post_data, $post_box_settings);
    } else if ($post_box_style == 'story_player_box') {
        $html .= _story_player_box($post_data);
    } else if ($post_box_style == 'video_player_box') {
        $html .= _video_player_box($post_data, $post_box_settings);
    } else if ($post_box_style == 'post_box_style_4') {
        $html .= _post_box_style_4($post_data, $post_box_settings);
    }
    return $html;
}

function _post_box_style_1($post_data, $post_box_settings, $html = "")
{
    $style = '';
    $class = '';
    if (isset($post_box_settings['bg_color']) && $post_box_settings['bg_color']) {
        $style = 'style="--bg-color: ' . $post_box_settings['bg_color'] . '"';
        $class = 'has-bg-color';
    }
    $html .= "<div class='post-box-grid-holder'>";
    if (isset($post_box_settings['show_post_type_label']) && $post_box_settings['show_post_type_label'] == true && isset($post_data['post_type'])) {
        $post_type = $post_data['post_type'];
        $html .= "<div class='text-label-style-1 mb-2'>$post_type</div>";
    }
    $html .= "<div class='post-box-style-1-grid rounded image-zoom-on-hover' $style>";

    if (is_int($post_data['image'])) {
        $html .= __icon_image(array(
            'id' => $post_data['image'],
            'size' => 'medium',
            'class' => 'image-style ' . $class,
            'link' => $post_data['link'],
            'link_type' => $post_box_settings['type'],
        ));
    } else {
        $html .= '<div class="image-box image-style ' . $class . '"><a class="text-inherit text-decoration-none" href="' . $post_data['link'] . '">' . $post_data['image'] . '</a></div>';
    }
    $html .= "<div class='post-content'>";
    $html .= __heading(array(
        'heading' => $post_data['title'],
        'tag' => 'h3',
        'class' => 'title',
        'link' => $post_data['link'],
        'link_type' => $post_box_settings['type'],
    ));

    if (isset($post_data['meta_data'])) {
        foreach ($post_data['meta_data'] as $key => $meta_data) {
            $html .= "<div class='$key'>$meta_data</div>";
        }
    }

    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

function _post_box_style_2($post_data, $post_box_settings)
{
    $html = "<div class='post-box-grid-holder' style='--width: 346px'>";

    $html .= "<div class='post-box-style-2-grid text-center'>";

    if (is_int($post_data['image'])) {
        $html .= __icon_image(array(
            'id' => $post_data['image'],
            'size' => 'medium',
            'link' => $post_data['link'],
            'link_type' => $post_box_settings['type'],
        ));
    } else {
        $html .= '<div class="image-box image-style"><a class="text-inherit text-decoration-none" href="' . $post_data['link'] . '">' . $post_data['image'] . '</a></div>';
    }
    $html .= "<div class='post-content'>";
    $html .= __heading(array(
        'heading' => $post_data['title'],
        'tag' => 'h3',
        'class' => 'title mt-3',
        'link' => $post_data['link'],
        'link_type' => $post_box_settings['type'],
    ));


    $html .= "</div>";

    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

function _post_box_style_3($post_data, $post_box_settings)
{
    $html = "<div class='post-box-grid-holder' style='--padding: 50%;'>";

    $html .= "<div class='post-box-style-3-grid text-center'>";

    if (is_int($post_data['image'])) {
        $html .= __icon_image(array(
            'id' => $post_data['image'],
            'size' => 'medium',
            'link' => $post_data['link'],
            'class' => 'image-rounded',
            'link_type' => $post_box_settings['type'],
        ));
    } else {
        $html .= '<div class="image-box image-style image-rounded"><a class="text-inherit text-decoration-none" href="' . $post_data['link'] . '">' . $post_data['image'] . '</a></div>';
    }
    $html .= "<div class='post-content'>";
    $html .= __heading(array(
        'heading' => $post_data['title'],
        'tag' => 'h3',
        'class' => 'title mt-3',
        'link' => $post_data['link'],
        'link_type' => $post_box_settings['type'],
    ));


    $html .= "</div>";

    $html .= "</div>";
    $html .= "</div>";

    return $html;
}


function _post_box_style_4($post_data, $post_box_settings, $html = "")
{
    $author_id = get_post_field('post_author', $post_data['id']);


    $html .= "<div class='post-box-grid-holder'>";
    if (isset($post_box_settings['show_post_type_label']) && $post_box_settings['show_post_type_label'] == true && isset($post_data['post_type'])) {
        $post_type = $post_data['post_type'];
        $html .= "<div class='text-label-style-1 mb-2'>$post_type</div>";
    }
    $html .= "<div class='post-box-style-4-grid position-relative image-zoom-on-hover'>";

    if (is_int($post_data['image'])) {
        $html .= __icon_image(array(
            'id' => $post_data['image'],
            'size' => 'medium',
            'class' => 'image-style',
            'link' => $post_data['link'],
            'link_type' => $post_box_settings['type'],
        ));
    } else {
        $html .= '<div class="image-box image-style"><a class="text-inherit text-decoration-none" href="' . $post_data['link'] . '">' . $post_data['image'] . '</a></div>';
    }
    $html .= "<div class='post-content position-absolute text-white'>";
    $html .= "<div class='position-relative'>";
    $html .= __heading(array(
        'heading' => $post_data['title'],
        'tag' => 'h3',
        'class' => 'title mb-2 text-initial',
        'link' => $post_data['link'],
        'link_type' => $post_box_settings['type'],
    ));

    $html .= "[post_author author_id=$author_id]";

    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}


function _story_player_box($post_data)
{
    $SVG = new SVG;

    $author_id = get_post_field('post_author', $post_data['id']);
    $author = get_the_author_meta('display_name', $author_id);
    $username = '@' . get_the_author_meta('user_login', $author_id);
    $link = get_the_permalink($post_data['id']);

    $video = get__post_meta_by_id($post_data['id'], 'video');
    $html = "<div class='post-box-grid-holder'>";
    $html .= "<a href='$link' class='d-block video-player position-relative rounded overflow-hidden'>";
    $html .= __video(array(
        'id' => $video
    ));
    $html .= "<div class='play-button position-absolute'>" . $SVG->play() . "</div>";
    $html .= "<div class='story-details text-white position-absolute'>";
    $html .= __heading(array(
        'heading' => $author,
        'tag' => 'h3',
        'class' => 'title mb-0 text-large',
    ));
    $html .= "<div class='desc'>$username</div>";

    $html .= "</div>";

    $html .= "</a>";
    $html .= "</div>";

    return $html;
}

function _video_player_box($post_data, $post_box_settings)
{
    $SVG = new SVG;

    $link = get_the_permalink($post_data['id']);

    if (isset($post_box_settings['show_year']) && $post_box_settings['show_year'] == true) {
        $desc = $post_data['meta_data']['year'];
    } else {
        $desc = $post_data['desc'];
    }

    $video = get__post_meta_by_id($post_data['id'], 'video');
    $html = "<div class='post-box-grid-holder'>";

    $html .= "<a href='$link' class='d-block video-player position-relative rounded overflow-hidden'>";
    $html .= "<div class='video-holder position-static'>";
    $html .= __video(array(
        'id' => $video
    ));

    $html .= "<div class='play-button position-absolute'>" . $SVG->play() . "</div>";
    $html .= "</div>";

    $html .= "<div class='story-details text-white position-absolute'>";
    $html .= __heading(array(
        'heading' => $post_data['title'],
        'tag' => 'h3',
        'class' => 'title mb-0 text-large text-white',
    ));
    $html .= "<div class='desc'>" . $desc . "</div>";

    $html .= "</div>";

    $html .= "</a>";
    $html .= "</div>";

    return $html;
}
function _post_grid($post, $post_type, $html = "<div class='post-grid'>")
{

    if ($post_type == 'post') {
        $button_text = 'Read more';
    } else if ($post_type == 'podcasts') {
        $button_text = 'View all episodes';
    }

    $html .= __icon_image(array(
        'id' => get_post_thumbnail_id($post->ID, 'large'),
        'size' => 'large',
        'class' => 'image-style',
        'link' => $post->ID,
    ));

    $html .= "<div class='post-content content-margin-20'>";
    if ($post_type == 'podcasts') {
        $html .= "<div class='podcast-heading'>";
    }
    $html .= __heading(array(
        'heading' => $post->post_title,
        'tag' => 'h3',
        'class' => 'title',
        'link' => $post->ID,

    ));

    if ($post_type == 'podcasts') {
        $SVG = new SVG;
        $html .= $SVG->podcasts();
        $html .= "</div>";
    }

    if ($post_type == 'post') {
        $post_author = $post->post_author;
        $html .= "[post_author author_id='$post_author']";
    }
    $taxonomy = serialize(array('category', 'post_tag'));
    $post_id = $post->ID;
    $html .= "[post_taxonomy_terms post_id='$post_id' taxonomy='$taxonomy']";


    $html .= __description(array(
        'description' => $post->post_excerpt
    ));

    $html .= __button(array(
        'button_type'       => 'post',
        'button_text'       => $button_text,
        'button_url'        => ['id' => $post->ID],
        'button_url_custom' => false,
        'button_style'      => 'button-readmore text-tiny',
        'button_target'     => '_self',
    ));

    $html .= "</div>";

    $html .= "</div>";
    return $html;
}

function _testimonial_grid($post, $html = "<div class='testimonial-grid text-center'>")
{

    $html .= __description(array(
        'description' => $post->post_content,
        'autop' => false,
        'class' => 'mb-3'
    ));
    $html .= __icon_image(array(
        'id' => get_post_thumbnail_id($post->ID, 'large'),
        'size' => 'medium',
        'class' => 'testimonial-author mb-3',
        'link' => $post->ID,
    ));

    $html .= __description(array(
        'description' => $post->post_title,
        'class' => 'author-name mb-0'
    ));

    $html .= __description(array(
        'description' => $post->post_excerpt,
        'class' => 'author-position'
    ));


    $html .= "</div>";

    return $html;
}

function _team_grid($post, $html = "<div class='team-grid '>")
{


    $html .= __icon_image(array(
        'id' => get_post_thumbnail_id($post['id'], 'large'),
        'size' => 'medium',
        'class' => 'team-image image-style',
        'link' => $post['id'],
    ));
    $html .= "<div class='team-details'>";
    $html .= __description(array(
        'description' => $post['post_title'],
        'class' => 'team-name mb-0'
    ));

    $html .= __description(array(
        'description' => $post['post_excerpt'],
        'class' => 'team-position'
    ));


    $html .= "</div>";
    $html .= "</div>";

    return $html;
}


function _swiper_navigation()
{
    return '<div class="swiper-nav-holder container"><div class="swiper-button-prev"></div><div class="swiper-button-next"></div> </div>';
}

function _swiper_pagination()
{
    return '<div class="swiper-pagination container xs-margin-bottom"></div>';
}


function _posts_sliders($taxonomy, $args,  $settings)
{
    $terms = get_terms(array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => true,
    ));
    $post_type = $args['post_type'];
    $html = "<section class='post-sliders lg-padding-top lg-padding-bottom bg-light-gray post-$post_type'>";
    foreach ($terms as $term) {

        $id = $post_type . '-slider-' . $term->term_id;

        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term->term_id
            )
        );
        $html .= "<div class='post-sliders-post xs-margin-bottom' id='$id'>";

        $html .= "<div class='container cat-name-holder xs-margin-bottom'>";
        $html .= "<div class='row g-4 align-items-center'>";

        $html .= "<div class='col-lg-6 col-md-7'>";
        $html .= __heading(array(
            'heading' => $term->name,
        ));
        $html .= "</div>";

        $html .= "<div class='col-lg-6 col-md-5'>";
        $html .= _swiper_pagination();
        $html .= "</div>";

        $html .= "</div>";
        $html .= "</div>";

        $html .= _post_query($args, $settings);
        $html .= "</div>";
    }
    $html .= "</section>";

    return $html;
}


function _get_layout_id($slug, $type = 'archive')
{
    $post = get_posts(array(
        'post_type' => 'layouts',
        'fields' => 'ids',
        'tax_query'   => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'layouts_category',
                'field'    => 'slug',
                'terms'    => $slug . '-' . $type
            ),
            array(
                'taxonomy' => 'layouts_category',
                'field'    => 'slug',
                'terms'    => $type
            ),
        )
    ));
    if ($post) {
        return $post[0];
    } else {
        return false;
    }
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
