<?php
// If this file is called directly, abort.
defined('ABSPATH') || exit;

use DiviTorque\Helpers;

/**
 * The Gallery module class.
 */
class TORQ_FilterableGallery extends TORQ_Builder_Module
{

    public function init()
    {

        $this->name             = esc_html__('Torq Filterable Gallery', 'divitorque');
        $this->slug             = 'torq_filterable_gallery';
        $this->vb_support       = 'on';
        $this->main_css_element = '%%order_class%%';
        $this->icon_path        = plugin_dir_path(__FILE__) . '';

        $this->settings_modal_toggles = [
            'general'  => [
                'toggles' => [
                    'general'     => esc_html__('General', 'divitorque'),
                    'lightbox'    => esc_html__('Lightbox & Links', 'divitorque'),
                    'filter_bar' => esc_html__('Filter Bar', 'divitorque'),
                    'caption'     => esc_html__('Captions', 'divitorque'),
                    'pagination'   => esc_html__('Pagination', 'divitorque'),
                    'hover_effect' => esc_html__('Hover Effects', 'divitorque'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'overlay'        => esc_html__('Overlay', 'divitorque'),
                    'image'        => esc_html__('Image', 'divitorque'),
                    'caption'      => esc_html__('Caption', 'divitorque'),
                    'caption_text' => [
                        'title'             => esc_html__('Caption Text', 'divitorque'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'caption_title' => [
                                'name' => esc_html__('Title', 'divitorque'),
                            ],
                            'caption_desc'  => [
                                'name' => esc_html__('Description', 'divitorque'),
                            ],
                        ],
                    ],
                    'filter_bar'  => esc_html__('Filter Bar', 'divitorque'),
                    'filters_text' => [
                        'title'             => esc_html__('Filter Bar Text', 'divitorque'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'normal' => [
                                'name' => esc_html__('Normal', 'divitorque'),
                            ],
                            'active' => [
                                'name' => esc_html__('Active', 'divitorque'),
                            ],
                        ],
                    ],
                    'pagination'  => [
                        'title'             => esc_html__('Pagination', 'divitorque'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => [
                            'normal' => [
                                'name' => esc_html__('Normal', 'divitorque'),
                            ],
                            'active'  => [
                                'name' => esc_html__('Active', 'divitorque'),
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->custom_css_fields = [
            'gallery' => [
                'label'    => esc_html__('Gallery', 'divitorque'),
                'selector' => '.torq-gallery',
            ],

            'filters' => [
                'label'    => esc_html__('Filters', 'divitorque'),
                'selector' => '.torq-filters',
            ],

            'items'   => [
                'label'    => esc_html__('Items', 'divitorque'),
                'selector' => '.torq-items',
            ],

            'item'    => [
                'label'    => esc_html__('Item', 'divitorque'),
                'selector' => '.torq-item',
            ],

            'image'   => [
                'label'    => esc_html__('Image', 'divitorque'),
                'selector' => '.torq-item .pic',
            ],
        ];
    }

    public function get_fields()
    {
        $general = [

            'gallery_ids'     => [
                'label'            => __('Choose Images', 'divitorque'),
                'description'      => __('Choose the images that you would like to appear in the image gallery.', 'divitorque'),
                'type'             => 'upload-gallery',
                'option_category'  => 'basic_option',
                'toggle_slug'      => 'general',
                'computed_affects' => [
                    '__gallery',
                ],
            ],

            'image_size'      => [
                'label'            => __('Image Size', 'divitorque'),
                'type'             => 'select',
                'description'      => __(' Select the size of your images.', 'divitorque'),
                'default'          => array_keys(Helpers::get_image_sizes()),
                'options'          => Helpers::get_image_sizes(),
                'option_category'  => 'basic_option',
                'toggle_slug'      => 'general',
                'computed_affects' => [
                    '__gallery',
                ],
            ],

            '_layout'         => [
                'type'        => 'torq_separator',
                '_text'       => __('Gallery Layout', 'divitorque'),
                'toggle_slug' => 'general',
            ],

            'gallery_type'    => [
                'label'            => __('Gallery Type', 'divitorque'),
                'type'             => 'select',
                'default'          => 'grid',
                'options'          => [
                    'grid'      => __('Grid', 'divitorque'),
                    'masonry'   => __('Masonry', 'divitorque'),
                ],
                'toggle_slug'      => 'general',
                'computed_affects' => [
                    '__gallery',
                ],
            ],

            'columns'         => [
                'label'            => __('Columns', 'divitorque'),
                'toggle_slug'      => 'general',
                'type'             => 'select',
                'default'          => '4',
                'options'          => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'mobile_options'   => true,
                'validate_unit'    => true,
                'option_category'  => 'layout',
                'computed_affects' => [
                    '__gallery',
                ],
            ],

            'gutter'          => [
                'label'            => __('Spacing', 'divitorque'),
                'toggle_slug'      => 'general',
                'type'             => 'text',
                'option_category'  => 'basic_option',
                'default'          => 20,
                'default_on_front' => 20,
                'computed_affects' => [
                    '__gallery',
                ],
                'validate_unit'    => false,
            ],

            // 'hover_effects'     => [
            //     'label'            => esc_html__('Hover Effects', 'divitorque'),
            //     'type'             => 'select',
            //     'options'          => [
            //         'none'  => __('Default', 'divitorque'),
            //     ],
            //     'default'          => 'none',
            //     'toggle_slug'      => 'general',
            //     'computed_affects' => [
            //         '__gallery',
            //     ],
            // ],

        ];

        $overlay = [
            'overlay_bg_color' => [
                'label'          => esc_html__('Overlay Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'option_category'  => 'basic_option',
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'overlay',
            ],

            'overlay_bg_opacity' => [
                'label'            => esc_html__('Opacity', 'divitorque'),
                'type'             => 'range',
                'option_category'  => 'basic_option',
                'range_settings'   => [
                    'min'  => '0.1',
                    'max'  => '1',
                    'step' => '0.1',
                ],
                'mobile_options'   => true,
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'overlay',
            ],
        ];

        $click_action = [

            'click_action'     => [
                'label'            => __('Lightbox & Links', 'divitorque'),
                'type'             => 'select',
                'default'          => 'lightbox',
                'options'          => [
                    'no-link'    => esc_html__('No Link', 'divitorque'),
                    'file'       => esc_html__('Media File', 'divitorque'),
                    'attachment' => esc_html__('Attachment Page', 'divitorque'),
                    'lightbox'   => esc_html__('Lightbox', 'divitorque'),
                    'custom'   => esc_html__('Custom Links', 'divitorque'),
                ],
                'option_category'  => 'basic_option',
                'toggle_slug'      => 'lightbox',
                'computed_affects' => [
                    '__gallery',
                ],
            ],

            'lightbox_actions' => [
                'label'            => __('Actions', 'divitorque'),
                'type'             => 'multiple_checkboxes',
                'default'          => 'zoom',
                'options'          => [
                    'zoom'       => __('Zoom', 'divitorque'),
                    'share'      => __('Social Share', 'divitorque'),
                    'slideShow'  => __('Slideshow', 'divitorque'),
                    'fullScreen' => __('Full Screen', 'divitorque'),
                    'download'   => __('Download', 'divitorque'),
                    'thumbs'     => __('Gallery', 'divitorque'),
                ],
                'option_category'  => 'basic_option',
                'toggle_slug'      => 'lightbox',
                'computed_affects' => [
                    '__gallery',
                ],
                'show_if'          => [
                    'click_action' => 'lightbox',
                ],
            ],

        ];

        $filters = [

            'hide_filters'          => [
                'label'            => esc_html__('Hide Filters', 'divitorque'),
                'description'      => esc_html__('Allow users to filter the gallery images by their tags.', 'divitorque'),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __('yes', 'divitorque'),
                    'off' => __('no', 'divitorque'),
                ],
                'default'          => 'off',
                'toggle_slug'      => 'filter_bar',
                'computed_affects' => ['__gallery'],
                'show_if'          => [
                    'gallery_type' => ['grid', 'masonry'],
                ],
            ],

            'hide_all_filter'       => [
                'label'            => esc_html__('Hide "All" filter', 'divitorque'),
                'type'             => 'yes_no_button',
                'default'          => 'off',
                'options'          => [
                    'on'  => __('yes', 'divitorque'),
                    'off' => __('no', 'divitorque'),
                ],
                'description'      => esc_html__('Choose to show or hide the “All” filter.', 'divitorque'),
                'toggle_slug'      => 'filter_bar',
                'computed_affects' => ['__gallery'],
                'show_if'          => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

            'all_filter_label'      => [
                'label'            => esc_html__('Text For "All" filter', 'divitorque'),
                'type'             => 'text',
                'default'          => esc_html__('All', 'divitorque'),
                'description'      => esc_html__('Set the label you want to use for the “All” filter that will contain all the images in your gallery.', 'divitorque'),
                'toggle_slug'      => 'filter_bar',
                'computed_affects' => ['__gallery'],
                'show_if'          => [
                    'gallery_type'    => ['grid', 'masonry'],
                    'hide_filters'    => 'off',
                    'hide_all_filter' => 'off',
                ],
            ],

            'filter_spacing_bottom' => [
                'label'           => esc_html__('Bottom Spacing', 'divitorque'),
                'type'            => 'text',
                'default'         => '20px',
                'mobile_options'  => true,
                'validate_unit'   => true,
                'option_category' => 'basic_option',
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'filter_bar',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

            'filter_alignment'      => [
                'label'           => esc_html__('Alignment', 'divitorque'),
                'description'     => esc_html__('Here you can define the alignment of Button', 'divitorque'),
                'type'            => 'text_align',
                'option_category' => 'configuration',
                'default'         => 'center',
                'options'         => et_builder_get_text_orientation_options(['justified']),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'filter_bar',
                'mobile_options'  => true,
            ],

            'filter_bg'             => [
                'label'          => esc_html__('Background Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'filter_bar',
                'show_if'        => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

            'filter_bg_active'      => [
                'label'          => esc_html__('Active Background Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'toggle_slug'    => 'filter_bar',
                'tab_slug'       => 'advanced',
                'show_if'        => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

            'filter_spacing'        => [
                'label'           => esc_html__('Filter Spacing', 'divitorque'),
                'type'            => 'text',
                'default'         => '10px',
                'mobile_options'  => true,
                'validate_unit'   => true,
                'option_category' => 'basic_option',
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'filter_bar',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

            'filter_padding'        => [
                'label'           => esc_html__('Filter Padding', 'divitorque'),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'mobile_options'  => true,
                'responsive'      => true,
                'default'         => '5px|15px|5px|15px',
                'toggle_slug'     => 'filter_bar',
                'tab_slug'        => 'advanced',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

            '_filter'               => [
                'type'        => 'torq_separator',
                '_text'       => __('Border', 'divitorque'),
                'toggle_slug' => 'filter_bar',
                'tab_slug'    => 'advanced',
                'show_if'     => [
                    'gallery_type' => ['grid', 'masonry'],
                    'hide_filters' => 'off',
                ],
            ],

        ];

        $pagination = [

            'show_pagination'          => [
                'label'            => esc_html__('Show Pagination', 'divitorque'),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __('yes', 'divitorque'),
                    'off' => __('no', 'divitorque'),
                ],
                'default'          => 'off',
                'toggle_slug'      => 'pagination',
                'computed_affects' => ['__gallery'],
                'show_if'          => [
                    'gallery_type' => ['grid', 'masonry'],
                ],
            ],

            'items_per_page'          => [
                'label'            => __('Items Per Page', 'divitorque'),
                'toggle_slug'      => 'pagination',
                'type'             => 'text',
                'option_category'  => 'basic_option',
                'default'          => 8,
                'default_on_front' => 8,
                'computed_affects' => [
                    '__gallery',
                ],
                'validate_unit'    => false,
                'show_if'          => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_alignment' => [
                'label'           => esc_html__('Alignment', 'divitorque'),
                'description'     => esc_html__('Here you can define the alignment of Button', 'divitorque'),
                'type'            => 'select',
                'option_category' => 'configuration',
                'default'         => 'center',
                'options'         => [
                    'flex-start'   => esc_html__('Left', 'divitorque'),
                    'center' => esc_html__('Center', 'divitorque'),
                    'flex-end'  => esc_html__('Right', 'divitorque'),
                ],
                'toggle_slug'     => 'pagination',
                'mobile_options'  => true,
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_bg' => [
                'label'          => esc_html__('Background Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'normal',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_text_color' => [
                'label'          => esc_html__('Text Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'normal',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_border_color' => [
                'label'          => esc_html__('Border Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'normal',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_bg_active' => [
                'label'          => esc_html__('Background Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'active',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_text_color_active' => [
                'label'          => esc_html__('Text Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'active',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_border_color_active' => [
                'label'          => esc_html__('Border Color', 'divitorque'),
                'type'           => 'color-alpha',
                'default'        => '',
                'custom_color'   => true,
                'mobile_options' => true,
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'active',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_padding' => [
                'label'           => esc_html__('Pager Padding', 'divitorque'),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'mobile_options'  => true,
                'responsive'      => true,
                'default'         => '10px|15px|10px|15px',
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'normal',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

            'pagination_spacing' => [
                'label'           => esc_html__('Pager Spacing', 'divitorque'),
                'type'            => 'text',
                'default'         => '10px',
                'mobile_options'  => true,
                'validate_unit'   => true,
                'option_category' => 'basic_option',
                'tab_slug'    => 'advanced',
                'toggle_slug'    => 'pagination',
                'sub_toggle'      => 'normal',
                'show_if'         => [
                    'gallery_type' => ['grid', 'masonry'],
                    'show_pagination' => 'on',
                ],
            ],

        ];

        $caption = [
            'hide_caption'     => [
                'label'            => esc_html__('Hide Caption', 'divitorque'),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __('yes', 'divitorque'),
                    'off' => __('no', 'divitorque'),
                ],
                'default'          => 'off',
                'toggle_slug'      => 'caption',
                'computed_affects' => [
                    '__gallery',
                ],
            ],

            'hide_title'       => [
                'label'            => esc_html__('Hide Title', 'divitorque'),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __('yes', 'divitorque'),
                    'off' => __('no', 'divitorque'),
                ],
                'default'          => 'off',
                'toggle_slug'      => 'caption',
                'computed_affects' => [
                    '__gallery',
                ],
                'show_if'          => [
                    'hide_caption' => 'off',
                ],
            ],

            'hide_description' => [
                'label'            => esc_html__('Hide Description', 'divitorque'),
                'type'             => 'yes_no_button',
                'options'          => [
                    'on'  => __('yes', 'divitorque'),
                    'off' => __('no', 'divitorque'),
                ],
                'default'          => 'on',
                'toggle_slug'      => 'caption',
                'computed_affects' => [
                    '__gallery',
                ],
                'show_if'          => [
                    'hide_caption' => 'off',
                ],
            ],
        ];

        $computed = [
            '__gallery' => [
                'type'                => 'computed',
                'computed_callback'   => ['TORQ_FilterableGallery', 'gallery_html'],
                'computed_depends_on' => [
                    'gallery_ids',
                    'gallery_type',
                    'image_size',
                    'columns',
                    'gutter',
                    'click_action',
                    'lightbox_actions',
                    'hide_filters',
                    'hide_all_filter',
                    'all_filter_label',
                    'hide_caption',
                    'hide_title',
                    'hide_description',
                    'show_pagination',
                    'items_per_page',
                    // 'hover_effects'
                ],
            ],
        ];

        return array_merge(
            $general,
            $overlay,
            $click_action,
            $filters,
            $pagination,
            $caption,
            $computed
        );
    }

    public function get_advanced_fields_config()
    {

        $advanced_fields                 = [];
        $advanced_fields['text']         = [];
        $advanced_fields['text_shadow']  = [];
        $advanced_fields['fonts']        = [];
        $advanced_fields['borders']      = [];
        $advanced_fields['box_shadow']   = [];
        $advanced_fields['link_options'] = [];
        $advanced_fields['button']       = [];

        $advanced_fields['borders']['items'] = array(
            'css'         => [
                'main' => [
                    'border_radii'  => '%%order_class%% .torq-item',
                    'border_styles' => '%%order_class%% .torq-item',
                ],
            ],
            'toggle_slug' => 'items',
        );

        $advanced_fields['borders']['normal'] = [
            'label_prefix'        => esc_html__('Filter', 'divitorque'),
            'css'                 => [
                'main' => [
                    'border_radii'  => '%%order_class%% .torq-filters li.torq-filter-item',
                    'border_styles' => '%%order_class%% .torq-filters li.torq-filter-item',
                ],
            ],
            'toggle_slug'         => 'filter_bar',
            'depends_show_if_not' => 'on',
            'depends_on'          => [
                'hide_filters',
            ],
        ];

        $advanced_fields['borders']['active'] = [
            'label_prefix'        => esc_html__('Active', 'divitorque'),
            'css'                 => [
                'main' => [
                    'border_radii'  => '%%order_class%% .torq-filters li.torq-filter-item.current',
                    'border_styles' => '%%order_class%% .torq-filters li.torq-filter-item.current',
                ],
            ],
            'toggle_slug'         => 'filter_bar',
            'depends_show_if_not' => 'on',
            'depends_on'          => [
                'hide_filters',
            ],
        ];

        $advanced_fields['fonts']['caption_title'] = [
            'label'           => esc_html__('Title', 'divitorque'),
            'css'             => [
                'main' => "%%order_class%% .torq-item-content h2",
            ],
            'font_size'       => [
                'default' => '18px',
            ],
            'line_height'     => [
                'default' => '1.2em',
            ],
            'hide_text_align' => true,
            'toggle_slug'     => 'caption_text',
            'sub_toggle'      => 'caption_title',
        ];

        $advanced_fields['fonts']['caption_desc'] = [
            'label'           => esc_html__('Description', 'divitorque'),
            'css'             => [
                'main' => "%%order_class%% .torq-item-content p",
            ],
            'font_size'       => [
                'default' => '14px',
            ],
            'line_height'     => [
                'default' => '1.5em',
            ],
            'hide_text_align' => true,
            'toggle_slug'     => 'caption_text',
            'sub_toggle'      => 'caption_desc',
        ];

        $advanced_fields['fonts']['filter_normal'] = [
            'label'            => esc_html__('Normal', 'divitorque'),
            'css'              => [
                'main'        => "%%order_class%% .torq-filters li, %%order_class%% .torq-filters ul li a",
                'color'       => "%%order_class%% .torq-filters ul li a",
                'hover'       => "%%order_class%% .torq-filters li:hover, %%order_class%% .torq-filters li:hover a",
                'color_hover' => "%%order_class%% .torq-filters li:hover a",
                'important'   => 'all',
            ],
            'font_size'        => [
                'default' => '14px',
            ],
            'line_height'      => [
                'default' => '1em',
            ],
            'hide_line_height' => true,
            'toggle_slug'      => 'filters_text',
            'sub_toggle'       => 'normal',
        ];

        $advanced_fields['fonts']['filter_active'] = [
            'label'            => esc_html__('Active', 'divitorque'),
            'css'              => [
                'main'        => "%%order_class%% .torq-filters li.current, %%order_class%% .torq-filters li.current a",
                'color'       => "%%order_class%% .torq-filters li.current a",
                'hover'       => "%%order_class%% .torq-filters li.current:hover, %%order_class%% .torq-filters li.current:hover a",
                'color_hover' => "%%order_class%% .torq-filters li.current:hover a",
                'important'   => 'all',
            ],
            'hide_line_height' => true,
            'toggle_slug'      => 'filters_text',
            'sub_toggle'       => 'active',
        ];

        $advanced_fields['borders']['image'] = [
            'label_prefix' => esc_html__('Image', 'divitorque'),
            'css'          => [
                'main' => [
                    'border_radii'  => '%%order_class%% .torq-items .torq-item img, %%order_class%% .torq-items .torq-item .pic',
                    'border_styles' => '%%order_class%% .torq-items .torq-item img, %%order_class%% .torq-items .torq-item .pic',
                ],
            ],
            'tab_slug'     => 'advanced',
            'toggle_slug'  => 'image',
        ];

        $advanced_fields['filters'] = [
            'css'                  => [
                'main' => '%%order_class%%',
            ],

            'child_filters_target' => [
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'image',
            ],
        ];

        return $advanced_fields;
    }

    static function gallery_html($args = [], $conditional_tags = [], $current_page = [])
    {

        $gallery = new self();

        do_action('dgp_get_gallery_html_before');

        $gallery->props = $args;

        $output = $gallery->render_gallery([], [], $current_page);

        do_action('dgp_get_gallery_html_after');

        return $output;
    }

    public function render_gallery($args = [], $conditional_tags = [], $current_page = [])
    {

        foreach ($args as $arg => $value) {
            $this->props[$arg] = $value;
        }

        if (empty($this->props['gallery_ids'])) {
            return sprintf('%s', esc_html__('Gallery not found.', 'divitorque'));
        }

        $gallery_type = $this->props['gallery_type'];

        $gallery_items = get_posts([
            'include'        => $this->props['gallery_ids'],
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'ASC',
            'orderby'        => 'post__in',
        ]);

        if (empty($gallery_items)) {
            return sprintf('%s', esc_html__('Gallery not found.', 'divitorque'));
        }

        // Gallery items.
        ob_start();
        $items = 1;
        foreach ($gallery_items as $image) {

            $image_object = get_post($image->ID);
            $thumb        = wp_get_attachment_image_src($image->ID, 'thumbnail');
            $image_full   = wp_get_attachment_image_src($image->ID, 'full');
            $image_src    = wp_get_attachment_image_src($image->ID, $this->props['image_size']);

            // Image data.
            $image_data = [
                'id'              => $image->ID,
                'title'           => $image_object->post_title,
                'description'     => $image_object->post_content,
                'caption'         => wp_get_attachment_caption($image->ID),
                'item_attributes' => [],
                'link_attributes' => [],
                'img_attributes'  => [
                    'alt'              => wp_get_attachment_caption($image->ID),
                    'title'            => $image->post_title,
                    'data-description' => $image->post_conten,
                    'data-caption'     => $image->caption,
                    'data-full'        => esc_url($image->guid),
                ],
                'img_classes'     => ['image', 'pic', 'wp-image-' . $image->ID],
                'link_classes'    => ['torq-item-link'],
                'item_classes'    => ['torq-item'],
                'click_action'    => $this->props['click_action'],
            ];

            if ('grid' === $gallery_type) {
                $image_data['img_classes'][] = 'torq-square';
            }

            if ($thumb) {
                $image_data['img_attributes']['data-thumb'] = esc_url($thumb[0]);
            }

            if ($image_full) {
                $image_data['image_full'] = esc_url($image_full[0]);
            }

            if ($image_src) {
                $image_data['image_src']                  = esc_url($image_src[0]);
                $image_data['img_attributes']['src']      = (isset($image_src[0])) ? $image_src[0] : $image_full[0];
                $image_data['img_attributes']['data-src'] = (isset($image_src[0])) ? $image_src[0] : $image_full[0];
            }

            if ('no-link' !== $this->props['click_action']) {

                if ('file' === $this->props['click_action']) {
                    $image_data['link_attributes']['href'] = $image_full ? esc_url($image_full[0]) : esc_url($image_src[0]);
                }

                if ('attachment' === $this->props['click_action']) {
                    $image_data['link_attributes']['href'] = get_attachment_link($image->ID);
                }

                if ('custom' === $this->props['click_action']) {
                    $image_data['link_attributes']['href'] =  get_post_meta($image->ID, 'gallery_links', true);
                }

                if ('lightbox' === $this->props['click_action']) {
                    $image_data['link_attributes']['href']       = $image_full ? esc_url($image_full[0]) : esc_url($image_src[0]);
                    $image_data['link_attributes']['class'][]    = 'torq-lightbox-link';
                    $image_data['link_attributes']['aria-label'] = esc_html__('Open image', 'divitorque');
                    $image_data['link_attributes']['title']      = esc_html__('Open image', 'divitorque');

                    // Enable lightbox.
                    $image_data['link_attributes']['data-fancybox'] = 'torq-gallery';
                }
            }

            $has_filters = ('off' === $this->props['hide_filters']) && ('grid' === $gallery_type || 'masonry' === $gallery_type) ? true : false;

            $filters_options = [
                'has_filters'      => $has_filters,
                'hide_all_filter'  => 'on' === $this->props['hide_all_filter'] ? false : true,
                'all_filter_label' => $this->props['all_filter_label'],

            ];

            $filters_data['options'] = $filters_options;

            if ($has_filters) {
                $filters = get_post_meta($image->ID, 'gallery_tags', true);
                if ($filters) {
                    $filters = explode(',', $filters);
                    foreach ($filters as $filter) {

                        $filter                                = trim($filter);
                        $filter_slug                           = strtolower(str_replace(' ', '-', $filter));
                        $image_data['item_classes'][]          = sanitize_title($filter_slug);
                        $filters_data['filters'][$filter_slug] = $filter;
                    }
                }
            }

            $has_pagination = ('on' === $this->props['show_pagination']) && ('grid' === $gallery_type || 'masonry' === $gallery_type) ? true : false;

            if ($has_pagination && $items <= $this->props['items_per_page']) {
                $image_data['item_classes'][] = 'torq-item-visible';
            }

            include DTP_PLUGIN_PATH . 'includes/modules/divi-4/FilterableGallery/item-card.php';

            $items++;
        }

        $gallery = sprintf(
            '<div class="%s">%s</div>',
            "torq-items",
            ob_get_clean()
        );

        $filtersOutput = '';
        $paginationOutput = '';

        // Handle filters rendering.
        if ($has_filters) {
            ob_start();

            $hide_all_filter  = $filters_data['options']['hide_all_filter'] ?? false;
            $all_filter_label = $filters_data['options']['all_filter_label'] ?? '';
            $filters = $filters_data['filters'] ?? [];

            echo "<ul class='torq-filters-list'>";

            if ($hide_all_filter) {
                echo '<li class="torq-filter-item current">';
                echo "<a data-filter='*' href='#all'>", esc_html($all_filter_label), '</a>';
                echo '</li>';
            }

            foreach ($filters as $filter) {
                $filter_slug = sanitize_title($filter);
                echo '<li class="torq-filter-item">';
                echo '<a data-filter=".', esc_attr($filter_slug), '" class="torq-link" href="#', esc_url($filter_slug), '">', esc_html($filter), '</a>';
                echo '</li>';
            }

            echo "</ul>";

            $filtersOutput = sprintf('<div class="torq-filters">%s</div>', ob_get_clean());
        }

        // Handle pagination rendering.
        if ($has_pagination) {
            ob_start();

            $current_url = $_REQUEST['current_page']['url'] ?? '';

            // Check if page builder is activated.
            $is_et_activated = preg_match('/et_fb=1/', $current_url);

            if ($is_et_activated) {
                $total_images = count($gallery_items);
                $pages = ceil($total_images / $this->props['items_per_page']);

                for ($x = 1; $x <= $pages; $x++) {
                    $current_class = ($x == 1) ? 'current' : '';
                    echo '<a href="javascript:void(0);" class="pager ', $current_class, '">', $x, '</a>';
                }
            }

            $paginationOutput = sprintf('<div class="torq-pagination-wrap">%s</div>', ob_get_clean());
        }

        // Return the combined output.
        return wp_kses_post($filtersOutput . $gallery . $paginationOutput);
    }

    public function render($attrs, $content, $render_slug)
    {
        // Enqueue scripts and styles.
        wp_enqueue_script('torq-filterable-gallery');
        wp_enqueue_style('torq-filterable-gallery');

        // Generate styles.
        $this->torq_generate_styles($render_slug);

        // Extract properties.
        $gallery_type = $this->props['gallery_type'];
        $click_action = $this->props['click_action'];
        $lightbox_actions = $this->props['lightbox_actions'];
        $hide_filters = $this->props['hide_filters'];
        $show_pagination = $this->props['show_pagination'];

        // Determine gallery flags.
        $has_filters = $hide_filters === 'off' && in_array($gallery_type, ['grid', 'masonry']);
        $has_pagination = $show_pagination === 'on' && in_array($gallery_type, ['grid', 'masonry']);
        $hasLightbox = $click_action === 'lightbox';

        $lightboxOpts = ['close'];

        if ($hasLightbox) {
            $actions = explode('|', $lightbox_actions);
            $action_names = ['zoom', 'share', 'slideShow', 'fullScreen', 'download', 'thumbs'];

            foreach ($actions as $i => $action) {
                if ($action && $action !== 'off') {
                    $lightboxOpts[] = $action_names[$i];
                }
            }
        }

        $columns = Helpers::get_responsive_options('columns', $this->props);
        $order_class = self::get_module_order_class($render_slug);
        $order_number = str_replace(['_', $this->slug], '', $order_class);

        // Set data config.
        $data_config = [
            'type' => $gallery_type,
            'order_id' => $order_number,
            'lightbox' => $hasLightbox,
            'lightboxOpts' => $lightboxOpts,
            'hasFilters' => $has_filters,
            'hasPagination' => $has_pagination,
            'items_per_page' => $this->props['items_per_page'],
            'columnsResponsive' => $columns['responsive_status'],
            'columns' => absint($columns['desktop']),
            'columnsTablet' => absint($columns['tablet']),
            'columnsPhone' => absint($columns['phone']),
            'gutter' => absint($this->props['gutter']),
        ];

        // Set gallery attributes.
        $gallery_attr = [
            'class' => ['torq-filterable-gallery', "torq-$gallery_type"],
            'data-config' => wp_json_encode($data_config),
        ];

        // Render the gallery.
        $output = sprintf(
            '<div %2$s>%1$s</div>',
            $this->render_gallery(),
            Helpers::render_attributes($gallery_attr)
        );

        // Return the gallery output.
        return $output;
    }

    public function torq_generate_styles($render_slug)
    {

        $gutter                = $this->props['gutter'] ? intval($this->props['gutter']) : 20;
        $columns               = Helpers::get_responsive_options('columns', $this->props);
        $filter_alignment      = Helpers::get_responsive_options('filter_alignment', $this->props);
        $filter_spacing        = Helpers::get_responsive_options('filter_spacing', $this->props);
        $filter_spacing_bottom = Helpers::get_responsive_options('filter_spacing_bottom', $this->props);

        if ($this->props['filter_padding']) {
            $value                         = explode('|', $this->props['filter_padding']);
            $this->props['filter_padding'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .torq-filterable-gallery:not(.torq-highlight):not(.torq-slider) .torq-item',
                'declaration' => "width: calc((100% - {$gutter}px * ( {$columns['desktop']} - 1 )) / {$columns['desktop']});",
            ]
        );

        if ($columns['responsive_status']) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .torq-filterable-gallery:not(.torq-highlight):not(.torq-slider) .torq-item',
                    'declaration' => "width: calc((100% - {$gutter}px * ( {$columns['tablet']} - 1 )) / {$columns['tablet']});",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => '%%order_class%% .torq-filterable-gallery:not(.torq-highlight):not(.torq-slider) .torq-item',
                    'declaration' => "width: calc((100% - {$gutter}px * ( {$columns['phone']} - 1 )) / {$columns['phone']});",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ]
            );
        }

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'overlay_bg_color',
                'selector'       => '%%order_class%% .torq-item:hover .torq-item-overlay',
                'css_property'   => ['background-color'],
                'important'      => true,
                'render_slug'    => $render_slug,
                'type'           => 'color',
            ]
        );


        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'overlay_bg_opacity',
                'selector'       => '%%order_class%% .torq-item:hover .torq-item-content img.pic',
                'css_property'   => ['opacity'],
                'important'      => true,
                'render_slug'    => $render_slug,
                'type'           => 'color',
            ]
        );

        // Filters
        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => 'div%%order_class%% .torq-filters',
                'declaration' => "margin-right: {$filter_spacing_bottom['desktop']};",
            ]
        );

        if ($filter_spacing_bottom['responsive_status']) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => 'div%%order_class%% .torq-filters',
                    'declaration' => "margin-right: {$filter_spacing_bottom['tablet']};",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => 'div%%order_class%% .torq-filters',
                    'declaration' => "margin-right: {$filter_spacing_bottom['phone']};",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ]
            );
        }

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => '%%order_class%% .torq-filters ul.torq-filters-list',
                'declaration' => "justify-content: {$filter_alignment['desktop']};",
            ]
        );

        if ($filter_alignment['responsive_status']) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => 'div%%order_class%% .torq-filters ul.torq-filters-list',
                    'declaration' => "justify-content:  {$filter_alignment['tablet']};",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => 'div%%order_class%% .torq-filters ul.torq-filters-list',
                    'declaration' => "justify-content: {$filter_alignment['phone']};",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ]
            );
        }

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => 'div%%order_class%% .torq-filters li:not(:last-child)',
                'declaration' => "margin-right: {$filter_spacing['desktop']};",
            ]
        );

        if ($filter_spacing['responsive_status']) {
            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => 'div%%order_class%% .torq-filters li:not(:last-child)',
                    'declaration' => "margin-right: {$filter_spacing['tablet']};",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ]
            );

            ET_Builder_Element::set_style(
                $render_slug,
                [
                    'selector'    => 'div%%order_class%% .torq-filters li:not(:last-child)',
                    'declaration' => "margin-right: {$filter_spacing['phone']};",
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ]
            );
        }

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'filter_padding',
                'selector'       => 'div%%order_class%% .torq-filters ul li a',
                'css_property'   => 'padding',
                'render_slug'    => $render_slug,
                'type'           => 'custom_margin',
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'filter_bg',
                'selector'       => 'div%%order_class%% .torq-filters ul li a',
                'css_property'   => ['background-color'],
                'important'      => true,
                'render_slug'    => $render_slug,
                'type'           => 'color',
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'filter_bg_active',
                'selector'       => 'div%%order_class%% .torq-filters ul li.current a',
                'css_property'   => ['background-color'],
                'important'      => true,
                'render_slug'    => $render_slug,
                'type'           => 'color',
            ]
        );

        // Pagination
        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'pagination_alignment',
                'selector'       => '%%order_class%% .torq-pagination-wrap > div',
                'css_property'   => ['justify-content'],
                'render_slug'    => $render_slug,
                'important'      => true,
            ]
        );


        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'pagination_bg',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div a',
                'css_property'   => ['background'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
                'important'      => true,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'pagination_text_color',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div a',
                'css_property'   => ['color'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
                'important'      => true,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'pagination_border_color',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div a',
                'css_property'   => ['border-color'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
                'important'      => true,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'pagination_bg_active',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div a.current',
                'css_property'   => ['background'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
                'important'      => true,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'pagination_text_color_active',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div a.current',
                'css_property'   => ['color'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
                'important'      => true,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'pagination_border_color_active',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div a.current',
                'css_property'   => ['border-color'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
                'important'      => true,
            ]
        );

        if ($this->props['pagination_padding']) {
            $value                         = explode('|', $this->props['pagination_padding']);
            $this->props['pagination_padding'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }


        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'pagination_padding',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div > a',
                'css_property'   => 'padding',
                'render_slug'    => $render_slug,
                'type'           => 'custom_margin',
                'important'      => true,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'pagination_spacing',
                'selector'       => 'div%%order_class%% .torq-pagination-wrap > div',
                'css_property'   => 'gap',
                'render_slug'    => $render_slug,
            ]
        );
    }

    public function multi_view_filter_value($raw_value, $args)
    {

        $name = isset($args['name']) ? $args['name'] : '';
        if ($raw_value && 'font_icon' === $name) {
            return et_pb_get_extended_font_icon_value($raw_value, true);
        }

        return $raw_value;
    }
}

new TORQ_FilterableGallery();
