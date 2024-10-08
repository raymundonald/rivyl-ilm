<?php
function add_svg_support($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_svg_support');


add_post_type_support('page', 'excerpt');

/*-----------------------------------------------------------------------------------*/
/* Admin Settings
/*-----------------------------------------------------------------------------------*/

function action_admin_enqueue_scripts($hook)
{

    wp_enqueue_style('admin', get_template_directory_uri() . '/admin/css/admin.css');
}
add_action('admin_enqueue_scripts', 'action_admin_enqueue_scripts');

function action_wp_head()
{
    $id = false;

    if (is_page()) {
        $id = get_the_ID();
    } else if (is_home()) {
        $id =  get_option('page_for_posts');
    } else if (is_post_type_archive()) {
        $id = _get_layout_id(get_query_var('post_type'));
    }

    if ($id) {
        $_custom_css = get_post_meta($id, '_custom_css', true);
        $_custom_scripts = get_post_meta($id, '_custom_scripts', true);
        $_layouts = get_post_meta($id, '_layouts', true);
        if ($_custom_css) {
            echo custom_css($_custom_css);
        }
        if ($_custom_scripts) {
            echo custom_scripts($_custom_scripts);
        }
        if ($_layouts) {
            foreach ($_layouts as $layout) {
                $_custom_css = get_post_meta($layout, '_custom_css', true);
                $_custom_scripts = get_post_meta($layout, '_custom_scripts', true);
                if ($_custom_css) {
                    echo custom_css($_custom_css);
                }
                if ($_custom_scripts) {
                    echo custom_scripts($_custom_scripts);
                }
            }
        }
    }

    if (is_single()) {
        $id = _get_layout_id('post');
        if ($id) {
            $_custom_css = get_post_meta($id, '_custom_css', true);
            $_custom_scripts = get_post_meta($id, '_custom_scripts', true);
            $_layouts = get_post_meta($id, '_layouts', true);
            if ($_custom_css) {
                echo custom_css($_custom_css);
            }
            if ($_custom_scripts) {
                echo custom_scripts($_custom_scripts);
            }

            if ($_layouts) {
                foreach ($_layouts as $layout) {
                    $_custom_css = get_post_meta($layout, '_custom_css', true);
                    $_custom_scripts = get_post_meta($layout, '_custom_scripts', true);
                    if ($_custom_css) {
                        echo custom_css($_custom_css);
                    }
                    if ($_custom_scripts) {
                        echo custom_scripts($_custom_scripts);
                    }
                }
            }
        }
    }
}

add_action('wp_head', 'action_wp_head');

function custom_css($_custom_css)
{
    $css = '<style class="custom-css">';
    $css .= $_custom_css;
    $css .= '</style>';
    return $css;
}

function custom_scripts($_custom_scripts)
{
    $script = '<script class="custom-scripts">';
    $script .= 'jQuery(document).ready(function () {';
    $script .= $_custom_scripts;
    $script .= '});';
    $script .= '</script>';

    return $script;
}
