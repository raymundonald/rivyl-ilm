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
    $custom_css = '';
    $custom_scripts = '';

    if (is_page() || get_post_type() == 'layouts') {
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
            $custom_css = custom_css($_custom_css);
        }
        if ($_custom_scripts) {
            $custom_scripts = custom_scripts($_custom_scripts);
        }
        if ($_layouts) {
            foreach ($_layouts as $layout) {
                $_custom_css = get_post_meta($layout, '_custom_css', true);
                $_custom_scripts = get_post_meta($layout, '_custom_scripts', true);
                if ($_custom_css) {
                    $custom_css .= custom_css($_custom_css);
                }
                if ($_custom_scripts) {
                    $custom_scripts .= custom_scripts($_custom_scripts);
                }
            }
        }
    }

    if (is_single()) {
        $id = _get_layout_id(get_post_type(), 'single');
        if ($id) {
            $_custom_css = get_post_meta($id, '_custom_css', true);
            $_custom_scripts = get_post_meta($id, '_custom_scripts', true);
            $_layouts = get_post_meta($id, '_layouts', true);
            if ($_custom_css) {
                $custom_css .= custom_css($_custom_css);
            }
            if ($_custom_scripts) {
                $custom_scripts .= custom_scripts($_custom_scripts);
            }
            if ($_layouts) {
                foreach ($_layouts as $layout) {
                    $_custom_css = get_post_meta($layout, '_custom_css', true);
                    $_custom_scripts = get_post_meta($layout, '_custom_scripts', true);
                    if ($_custom_css) {
                        $custom_css .= custom_css($_custom_css);
                    }
                    if ($_custom_scripts) {
                        $custom_scripts .= custom_scripts($_custom_scripts);
                    }
                }
            }
        }
    }

    if ($custom_css) {
        echo '<style class="custom-css">';
        echo $custom_css;
        echo '</style>';
    }
    if ($custom_scripts) {
        echo '<script class="custom-script">';
        echo 'jQuery(document).ready(function () {';
        echo $custom_scripts;
        echo '});';
        echo '</script>';
    }
}

add_action('wp_head', 'action_wp_head');

function custom_css($_custom_css)
{
    if ($_custom_css) {
        return $_custom_css;
    }
}

function custom_scripts($_custom_scripts)
{
    if ($_custom_scripts) {
        return $_custom_scripts;
    }
}


function templates()
{
    get_template_part('template-parts/header/header-sideout-menu');
    get_template_part('template-parts/popups/listen');
}
add_action('wp_footer', 'templates');
