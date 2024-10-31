<?php

use Carbon_Fields\Block;
use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Hero Settings')
    ->where('post_template', '=', 'templates/page-modules.php')
    ->or_where('post_template', '=', 'templates/page-archives.php')
    ->or_where('post_id', '=', get_option('page_for_posts'))
    ->add_tab('Settings', array(
        Field::make('select', 'hero_style', __('Hero Style'))
            ->set_options(array(
                'hero-content-below-image' => 'Content Below Image',
                'hero-content-over-image' => 'Content Over Image',
                'hero-text-icon-only' => 'Text and Icon Only',
                'no-hero' => 'No Hero',
            )),
        Field::make('text', 'hero_alt_text', 'Hero Alt Text'),
        Field::make('image', 'icon', __('Icon'))->set_width(50),
        Field::make('image', 'mobile_bg', __('Mobile BG'))->set_width(50),
        Field::make('html', 'hero_bg', 'Hero BG')->set_help_text('Hero Background Is Set in Featured Image | Hero Description Is Set in Excerpt'),
    ))

    ->add_tab('Buttons', array(
        Field::make('complex', 'hero_buttons', __('Hero Buttons'))
            ->set_layout('tabbed-vertical')
            ->add_fields(array(
                Field::make('select', 'button_type', __('Button Type'))
                    ->set_options(
                        array(
                            'page'        => 'Page',
                            'post'        => 'Post',
                            'popups'      => 'Popup',
                            'custom'      => 'Custom',
                        )
                    ),
                Field::make('text', 'button_text', __('Button Text')),
                Field::make('association', 'button_url', __('Select Post'))
                    ->set_max(1)
                    ->set_types(array(
                        array(
                            'type'      => 'post',
                            'post_type' => 'post',
                        ),
                        array(
                            'type'      => 'post',
                            'post_type' => 'page',
                        )
                    ))
                    ->set_conditional_logic(
                        array(
                            array(
                                'field'   => 'button_type',
                                'value'   => 'custom',
                                'compare' => '!='
                            )
                        )
                    ),
                Field::make('html', 'html')
                    ->set_html('<div class="page-selector">  </div>'),
                Field::make('text', 'button_url_custom', __('Button URL'))
                    ->set_conditional_logic(
                        array(
                            array(
                                'field' => 'button_type',
                                'value' => 'custom',
                            )
                        )
                    ),
                Field::make('select', 'button_style', __('Button Style'))
                    ->set_options(
                        array(
                            'button-tangerine'    => 'Tangerine',
                            'button-white'     => 'White',
                            'button-bordered'  => 'Bordered',
                        )
                    ),
                Field::make('select', 'button_target', __('Button Target'))
                    ->set_options(
                        array(
                            'target="_self"'  => 'Default',
                            'target="_blank"' => 'New Tab',
                        )
                    ),
            ))
            ->set_header_template('Button: <%- button_text %>'),
    ));

function __color_options__()
{
    return array(
        '' => 'Default',
        'forest-gray' => 'Forest Gray',
        'light-gray' => 'Light Gray',
        'torquoise' => 'Torquoise',
        'seafoam' => 'Seafoam',
        'tangerine' => 'Tangerine',
        'blush' => 'Blush',
        'white' => 'White',
        'black' => 'Black',
    );
}
function __button_fields__()
{
    return  Field::make('complex', 'buttons', __('Buttons'))
        ->set_layout('tabbed-vertical')
        ->add_fields(array(
            Field::make('select', 'button_type', __('Button Type'))
                ->set_options(
                    array(
                        'page'        => 'Page',
                        'custom'      => 'Custom',
                    )
                ),
            Field::make('text', 'button_text', __('Button Text')),
            Field::make('association', 'button_url', __('Select Post'))
                ->set_max(1)
                ->set_types(array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'post',
                    ),
                    array(
                        'type'      => 'post',
                        'post_type' => 'page',
                    )
                ))
                ->set_conditional_logic(
                    array(
                        array(
                            'field'   => 'button_type',
                            'value'   => 'custom',
                            'compare' => '!='
                        )
                    )
                ),
            Field::make('html', 'html')
                ->set_html('<div class="page-selector">  </div>'),
            Field::make('text', 'button_url_custom', __('Button URL'))
                ->set_conditional_logic(
                    array(
                        array(
                            'field' => 'button_type',
                            'value' => 'custom',
                        )
                    )
                ),
            Field::make('select', 'button_style', __('Button Style'))
                ->set_options(
                    array(
                        'button-tangerine'    => 'Tangerine',
                        'button-white'     => 'White',
                        'button-bordered'  => 'Bordered',
                    )
                ),
            Field::make('select', 'button_target', __('Button Target'))
                ->set_options(
                    array(
                        'target="_self"'  => 'Default',
                        'target="_blank"' => 'New Tab',
                    )
                ),
        ))
        ->set_header_template('Button: <%- button_text %>');
}
function __style_and_settings_fields__()
{
    return array(
        Field::make('html', 'html_styles')->set_html('<label>Section Styles</label>')->set_classes('cb-label'),
        Field::make('complex', 'styles', '')
            ->set_duplicate_groups_allowed(false)
            ->setup_labels(
                array(
                    'plural_name'   => 'Styles',
                    'singular_name' => 'Style',
                )
            )
            ->set_layout('tabbed-vertical')
            ->add_fields('background', array(
                Field::make('select', 'background_color')->set_options(__color_options__()),
            )),

        Field::make('html', 'html_settings')->set_html('<label>Section Settings</label>')->set_classes('cb-label'),
        Field::make('text', 'custom_id', __('Custom ID'))->set_width(25),
        Field::make('text', 'custom_classes', __('Custom Classes'))->set_width(25),
        Field::make('select', 'container_width', __('Container'))->set_width(25)
            ->set_options(array(
                '' => 'Default',
                'fw-container' => 'Full Width',
                'lm-container' => 'Left Margin',
                'rm-container' => 'Right Margin',
            )),
        Field::make('checkbox', 'disable', __('Disable'))->set_width(25),
        Field::make('html', 'html_fields')->set_html('<label>Section Fields</label>')->set_classes('cb-label'),
    );
}

function __heading_fields__()
{
    return array(
        Field::make('html', 'heading_html')->set_classes('cb-label')->set_html('Heading'),
        Field::make('text', 'heading', __('Heading'))->set_width(20),
        Field::make('select', 'heading_color')->set_options(__color_options__())->set_width(20),
        Field::make('select', 'decor_color')->set_options(__color_options__())->set_width(20)
            ->set_conditional_logic(
                array(
                    array(
                        'field'   => 'heading_has_decor',
                        'value'   => true,
                    )
                )
            ),
        Field::make('checkbox', 'heading_has_decor', 'Heading has decor')->set_width(20),
        Field::make('checkbox', 'heading_line', 'Heading Line')->set_width(20),

    );
}

function __description_fields__()
{
    return array(
        Field::make('html', 'description_html')->set_classes('cb-label')->set_html('Description'),
        Field::make('textarea', 'description', __('Description'))->set_width(25),
        Field::make('select', 'text_color')->set_options(__color_options__())->set_width(25),
        Field::make('checkbox', 'text_has_decor', 'Text has decor')->set_width(25),
    );
}

function __logo_slider_fields__()
{
    return array_merge(__heading_fields__(), array(
        Field::make('media_gallery', 'logos', __('Logos'))
    ));
}

function __two_columns_image_and_text_fields()
{

    return array_merge(__heading_fields__(), array_merge(__description_fields__()), array(

        Field::make('image', 'image', __('Image'))->set_width(50),
        Field::make('image', 'icon', __('Icon'))->set_width(50),
        __button_fields__(),
        Field::make('html', 'html_options')->set_html('<label>Section Options</label>')->set_classes('cb-label'),
        Field::make('select', 'vertical_alignment', __('Vertical Alignment'))->set_width(20)
            ->set_options(array(
                '' => 'Default',
                'justify-content-start' => 'Start',
                'justify-content-center' => 'Center',
                'justify-content-end' => 'End',
                'justify-content-between' => 'Between',
            )),
        Field::make('checkbox', 'full_height', __('Full Height'))->set_width(20),
        Field::make('checkbox', 'sticky_content', __('Sticky Content'))->set_width(20),
        Field::make('checkbox', 'swap_column', __('Swap Column'))->set_width(20),
        Field::make('checkbox', 'swap_column_mobile', __('Swap Column Mobile'))->set_width(20)
    ));
};

function __newsletter_fields__()
{
    return array(
        Field::make('text', 'heading', __('Heading')),
        Field::make('textarea', 'description', __('Description')),
        Field::make('textarea', 'form_code', __('Form Code')),
    );
}

function __grid_fields__()
{
    return array_merge(__heading_fields__(), array_merge(__description_fields__()), array(
        Field::make('complex', 'grids', 'Grids')
            ->set_layout('tabbed-vertical')
            ->setup_labels(
                array(
                    'plural_name'   => 'Grids',
                    'singular_name' => 'Grid',
                )
            )
            ->add_fields(array(
                Field::make('checkbox', 'hide_on_mobile', 'Hide on mobile'),
                Field::make('text', 'title', 'Title'),
                Field::make('select', 'background_color')->set_options(__color_options__()),
                Field::make('complex', 'items', 'Items')
                    ->setup_labels(
                        array(
                            'plural_name'   => 'Styles',
                            'singular_name' => 'Style',
                        )
                    )
                    ->set_layout('tabbed-vertical')
                    ->add_fields('heading', array(
                        Field::make('text', 'heading'),
                    ))
                    ->set_header_template('Heading: <%- heading %>')

                    ->add_fields('description', array(
                        Field::make('textarea', 'description'),
                    ))
                    ->set_header_template('Desc: <%- description %>')
                    ->add_fields('image', array(
                        Field::make('image', 'image'),
                    )),
            ))
            ->set_header_template('Grid: <%- title %>'),
        Field::make('html', 'html_options')->set_html('<label>Grid Options</label>')->set_classes('cb-label'),
        Field::make('text', 'grid_columns_desktop', __('Grid Columns Desktop'))->set_width(33)->set_default_value(3),
        Field::make('text', 'grid_columns_tablet', __('Grid Columns Tablet'))->set_width(33)->set_default_value(2),
        Field::make('text', 'grid_columns_mobile', __('Grid Columns Mobile'))->set_width(33)->set_default_value(1),
        Field::make('select', 'grid_style', __('Grid Style'))->set_width(33)
            ->set_options(
                array(
                    'style-1' => 'Style-1',
                    'style-2'      => 'Style-2',
                )
            ),
    ));
}

function __post_fields_()
{

    return array_merge(__heading_fields__(), array_merge(__description_fields__()), array(
        Field::make('image', 'icon', __('Icon')),
        Field::make('select', 'icon_position', __('Icon Position'))
            ->set_options(
                array(
                    'none' => 'None',
                    'left'      => 'Left',
                    'right' => 'Right',
                )
            ),
        Field::make('html', 'html_options')->set_html('<label>post Options</label>')->set_classes('cb-label'),
        Field::make('complex', 'post_type', 'Post Type')
            ->set_duplicate_groups_allowed(false)
            ->set_max(1)
            ->add_fields(
                'post',
                array(
                    Field::make('hidden', 'taxonomy', __('Source'))->set_default_value('category'),
                    Field::make('select', 'source', __('Source'))
                        ->set_options(
                            array(
                                'most-recent'      => 'Most Recent',
                                'manually' => 'Select Manually',
                                'category' => 'Select by Category',
                            )
                        ),

                    Field::make('association', 'post', 'Select Blog')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'post',
                                    'post_type' => 'post',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'manually',
                                )
                            )
                        ),
                    Field::make('association', 'terms', 'Select Category')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'term',
                                    'taxonomy' => 'category',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'category',
                                )
                            )
                        ),

                )
            )->add_fields(
                'podcasts',
                array(
                    Field::make('hidden', 'taxonomy', __('Source'))->set_default_value('podcast_category'),
                    Field::make('select', 'source', __('Source'))
                        ->set_options(
                            array(
                                'most-recent'      => 'Most Recent',
                                'manually' => 'Select Manually',
                                'category' => 'Select by Category',
                            )
                        ),

                    Field::make('association', 'post', 'Select Blog')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'post',
                                    'post_type' => 'podcasts',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'manually',
                                )
                            )
                        ),
                    Field::make('association', 'terms', 'Select Category')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'term',
                                    'taxonomy' => 'podcast_category',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'category',
                                )
                            )
                        ),

                )
            )
            ->add_fields(
                'testimonials',
                array(
                    Field::make('hidden', 'taxonomy', __('Source'))->set_default_value('testimonial_category'),
                    Field::make('select', 'source', __('Source'))
                        ->set_options(
                            array(
                                'most-recent'      => 'Most Recent',
                                'manually' => 'Select Manually',
                                'category' => 'Select by Category',
                            )
                        ),

                    Field::make('association', 'post', 'Select Blog')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'post',
                                    'post_type' => 'testimonials',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'manually',
                                )
                            )
                        ),
                    Field::make('association', 'terms', 'Select Category')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'term',
                                    'taxonomy' => 'testimonial_category',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'category',
                                )
                            )
                        ),

                )
            )
            ->add_fields(
                'team',
                array(
                    Field::make('hidden', 'taxonomy', __('Source'))->set_default_value('team_category'),
                    Field::make('select', 'source', __('Source'))
                        ->set_options(
                            array(
                                'most-recent'      => 'Most Recent',
                                'manually' => 'Select Manually',
                                'category' => 'Select by Category',
                            )
                        ),

                    Field::make('association', 'post', 'Select Blog')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'post',
                                    'post_type' => 'testimonials',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'manually',
                                )
                            )
                        ),
                    Field::make('association', 'terms', 'Select Category')
                        ->set_types(
                            array(
                                array(
                                    'type'      => 'term',
                                    'taxonomy' => 'team_category',
                                )
                            )
                        )
                        ->set_conditional_logic(
                            array(
                                array(
                                    'field' => 'source',
                                    'value' => 'category',
                                )
                            )
                        ),

                )
            ),

        Field::make('text', 'posts_per_page', __('Post Per Page'))->set_width(50)->set_default_value(10),
        Field::make('checkbox', 'is_slider', __('Is Slider'))->set_width(50),
        Field::make('text', 'slides_per_view_wide', __('Slides Per View Wide'))->set_width(20)
            ->set_conditional_logic(
                array(
                    array(
                        'field' => 'is_slider',
                        'value' => true,
                    )
                )
            ),
        Field::make('text', 'slides_per_view_desktop', __('Slides Per View Desktop'))->set_width(20)
            ->set_conditional_logic(
                array(
                    array(
                        'field' => 'is_slider',
                        'value' => true,
                    )
                )
            ),

        Field::make('text', 'slides_per_view_tablet_landscape', __('Slides Per View Tablet Landscape'))->set_width(20)
            ->set_conditional_logic(
                array(
                    array(
                        'field' => 'is_slider',
                        'value' => true,
                    )
                )
            ),
        Field::make('text', 'slides_per_view_tablet_portrait', __('Slides Per View Tablet'))->set_width(20)
            ->set_conditional_logic(
                array(
                    array(
                        'field' => 'is_slider',
                        'value' => true,
                    )
                )
            ),
        Field::make('text', 'slides_per_view_mobile', __('Slides Per View Mobile'))->set_width(20)
            ->set_conditional_logic(
                array(
                    array(
                        'field' => 'is_slider',
                        'value' => true,
                    )
                )
            ),
        __button_fields__(),

    ));
}
function __accordion_fields__()
{
    return array(
        Field::make('text', 'heading', __('Heading'))->set_width(25),
        Field::make('select', 'heading_color')->set_options(__color_options__())->set_width(25),
        Field::make('select', 'decor_color')->set_options(__color_options__())->set_width(25)
            ->set_conditional_logic(
                array(
                    array(
                        'field'   => 'heading_has_decor',
                        'value'   => true,
                    )
                )
            ),
        Field::make('checkbox', 'heading_has_decor', 'Heading has decor')->set_width(25),
        Field::make('textarea', 'description', __('Description'))->set_width(33),
        Field::make('select', 'text_color')->set_options(__color_options__())->set_width(33),
        Field::make('checkbox', 'text_has_decor', 'Text has decor')->set_width(33),
        Field::make('checkbox', 'open_first_item', __('Open First Item')),
        Field::make('select', 'accordion_source', __('Accordion Source'))
            ->set_options(
                array(
                    ''              => 'Custom',
                    'faqs'          => 'FAQs Select Manually',
                    'faqs_category' => 'FAQs by Category',
                )
            ),
        Field::make('complex', 'accordion', __('Accordion'))
            ->set_layout('tabbed-vertical')
            ->add_fields(
                array(
                    Field::make('text', 'heading', __('Heading')),
                    Field::make('textarea', 'description', __('Description'))->set_width(80),
                    Field::make('html', 'activate_wysiwyg')->set_width(20)
                        ->set_html('<span class="button button-primary button-large wysiwyg-editor-trigger" >Wysiwyg Editor</span>'),
                )
            )
            ->set_header_template('<%- heading  %>')
            ->set_conditional_logic(
                array(
                    array(
                        'field'   => 'accordion_source',
                        'value'   => '',
                        'comapre' => '='
                    )
                )
            ),
        Field::make('association', 'faqs', 'Select FAQs')
            ->set_types(
                array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'faqs',
                    )
                )
            )
            ->set_conditional_logic(
                array(
                    array(
                        'field'   => 'accordion_source',
                        'value'   => 'faqs',
                        'comapre' => '='
                    )
                )
            ),
        Field::make('association', 'faqs_category', 'Select FAQs Category')
            ->set_types(
                array(
                    array(
                        'type'     => 'term',
                        'taxonomy' => 'faqs_category',
                    )
                )
            )
            ->set_conditional_logic(
                array(
                    array(
                        'field'   => 'accordion_source',
                        'value'   => 'faqs_category',
                        'comapre' => '='
                    )
                )
            ),
        Field::make('text', 'bottom_heading', 'Bottom Heading'),
        Field::make('textarea', 'bottom_description', 'Bottom Description'),
        __button_fields__(),
    );
}


function __text_image_section_fields()
{
    return array_merge(__heading_fields__(), array_merge(__description_fields__()), array(
        Field::make('image', 'image', __('Image'))->set_width(50),
    ));
}

function __text_over_bg_image_fields__()
{
    return array_merge(__heading_fields__(), array_merge(__description_fields__()), array(
        Field::make('image', 'image', __('Image'))->set_width(50),
    ));
}


function __contact_fields__()
{

    return array_merge(__heading_fields__(), array_merge(__description_fields__()), array(
        Field::make('text', 'contact_form', __('Contact Form')),
    ));
}

Container::make('post_meta', 'Sections')
    ->where('post_template', '=', 'templates/page-modules.php')
    ->or_where('post_id', '=', get_option('page_for_posts'))
    ->or_where('post_type', '=', 'layouts')
    ->add_fields(array(
        Field::make('complex', 'sections', '')
            ->set_collapsed(true)
            ->setup_labels(
                array(
                    'plural_name'   => 'Sections',
                    'singular_name' => 'Section',
                )
            )
            ->add_fields('layouts', array(
                Field::make('text', 'title', 'Title'),
                Field::make('association', 'layouts', 'Select Layouts')
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'layouts',
                            )
                        )
                    )
            ))
            ->set_header_template('Layouts: <%- title %>')
            ->add_fields(
                'logo_slider',
                array_merge(__style_and_settings_fields__(), __logo_slider_fields__())
            )
            ->set_header_template('Logo Slider: <%- heading %>')
            ->add_fields(
                'two_columns_image_and_text',
                array_merge(__style_and_settings_fields__(), __two_columns_image_and_text_fields())
            )
            ->set_header_template('Two Column Image and Text: <%- heading %>')
            ->add_fields(
                'newsletter',
                array_merge(__style_and_settings_fields__(), __newsletter_fields__())
            )
            ->set_header_template('Newsletter: <%- heading %>')
            ->add_fields(
                'grid',
                array_merge(__style_and_settings_fields__(), __grid_fields__())
            )
            ->set_header_template('Grid: <%- heading %>')
            ->add_fields(
                'post',
                array_merge(__style_and_settings_fields__(), __post_fields_())
            )
            ->set_header_template('Post: <%- heading %>')
            ->add_fields(
                'accordion',
                array_merge(__style_and_settings_fields__(), __accordion_fields__())
            )
            ->set_header_template('Accordion: <%- heading %>')
            ->add_fields(
                'text_image_section',
                array_merge(__style_and_settings_fields__(), __text_image_section_fields())
            )
            ->set_header_template('Text Image: <%- heading %>')
            ->add_fields(
                'text_over_bg_image',
                array_merge(__style_and_settings_fields__(), __text_over_bg_image_fields__())
            )
            ->set_header_template('Text Over BG Image: <%- heading %>')
            ->add_fields(
                'contact',
                array_merge(__style_and_settings_fields__(), __contact_fields__())
            )
            ->set_header_template('Contact: <%- heading %>')


    ));


function __general_settings_fields()
{
    return array(
        Field::make('image', 'logo', 'Logo')->set_classes('inline-field inline-field-wide-label'),

    );
}

function __social_fields()
{
    return array(
        Field::make('complex', 'socials')
            ->add_fields('facebook', array(
                Field::make('text', 'url', __('Facebook URL'))->set_classes('inline-field'),
            ))
            ->add_fields('instagram', array(
                Field::make('text', 'url', __('Instagram URL'))->set_classes('inline-field'),
            ))
            ->add_fields('x', array(
                Field::make('text', 'url', __('X URL'))->set_classes('inline-field'),
            ))
            ->add_fields('linkedin', array(
                Field::make('text', 'url', __('Linkedin URL'))->set_classes('inline-field'),
            ))
            ->add_fields('youtube', array(
                Field::make('text', 'url', __('Youtube URL'))->set_classes('inline-field'),
            ))
            ->add_fields('google', array(
                Field::make('text', 'url', __('Google URL'))->set_classes('inline-field'),
            ))
            ->set_duplicate_groups_allowed(false)
            ->set_collapsed(true)
    );
}
Container::make('theme_options', __('Theme Settings'))
    ->add_tab('General Settings', __general_settings_fields())
    ->add_tab('Socials', __social_fields());


Container::make('post_meta', 'Team Settings')
    ->where('post_type', '=', 'team')
    ->add_fields(__social_fields());


Container::make('post_meta', 'Podcast Settings')
    ->where('post_type', '=', 'podcasts')
    ->add_fields(array(
        Field::make('file', 'audio', __('Audio'))->set_classes('inline-field')->set_type(array('audio'))
    ));

Container::make('post_meta', 'Blog Settings')
    ->where('post_type', '=', 'post')
    ->add_fields(array(
        Field::make('text', 'read_time', __('Read Time(in minutes)'))->set_attribute('type', 'number')
    ));
