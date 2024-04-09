<?php

class TORQ_StarRating extends TORQ_Builder_Module
{

    public function init()
    {
        $this->vb_support = 'on';
        $this->name       = __('Torq Star Rating', 'divitorque');
        $this->slug       = 'torq_star_rating';

        $this->settings_modal_toggles = [
            'general'  => [
                'toggles' => [
                    'main_content' => __('Content', 'divitorque'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'stars' => __('Stars', 'divitorque'),
                    'label' => __('Label', 'divitorque'),
                ],
            ],
        ];

        $this->custom_css_fields = [];
    }

    public function get_fields()
    {
        $fields = [];

        $fields['stars'] = [
            'label'           => __('Stars', 'divitorque'),
            'type'            => 'select',
            'option_category' => 'configuration',
            'default'         => '5',
            'options'         => [
                '1'  => __('1 Star', 'divitorque'),
                '2'  => __('2 Stars', 'divitorque'),
                '3'  => __('3 Stars', 'divitorque'),
                '4'  => __('4 Stars', 'divitorque'),
                '5'  => __('5 Stars', 'divitorque'),
                '6'  => __('6 Stars', 'divitorque'),
                '7'  => __('7 Stars', 'divitorque'),
                '8'  => __('8 Stars', 'divitorque'),
                '9'  => __('9 Stars', 'divitorque'),
                '10' => __('10 Stars', 'divitorque'),
            ],
            'toggle_slug' => 'main_content',
        ];

        $fields['rating'] = [
            'label'          => __('Rating', 'divitorque'),
            'default'        => '4.5',
            'range_settings' => [
                'min'  => '1',
                'max'  => '10',
                'step' => '0.1',
            ],
            'type'            => 'range',
            'option_category' => 'layout',
            'mobile_options'  => false,
            'validate_unit'   => false,
            'toggle_slug'     => 'main_content',
        ];

        $fields['icon_type'] = [
            'label'           => __('Icon Type', 'divitorque'),
            'type'            => 'select',
            'option_category' => 'configuration',
            'default'         => 'fa',
            'options'         => [
                'fa'     => __('FontAwesome', 'divitorque'),
                'im'     => __('Icon Moon', 'divitorque'),
                // 'custom' => __('Custom', 'divitorque'),
            ],
            'toggle_slug' => 'main_content',
        ];

        $fields['star_icon'] = array(
            'label'              => __('Upload SVG Icon', 'divitorque'),
            'description'        => esc_html__('Upload only SVG icon with \'.svg\' file type. Please make sure your website has the permission to upload SVG file.', 'divitorque'),
            'type'               => 'upload',
            'upload_button_text' => esc_attr__('Upload SVG', 'divitorque'),
            'choose_text'        => esc_attr__('Upload SVG', 'divitorque'),
            'update_text'        => esc_attr__('Set As SVG', 'divitorque'),
            'toggle_slug'        => 'main_content',
            'show_if'            => [
                'icon_type' => 'custom',
            ],
        );

        $fields['show_label'] = [
            'label'           => __('Show Label', 'divitorque'),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => [
                'on'  => __('Yes', 'divitorque'),
                'off' => __('No', 'divitorque'),
            ],
            'toggle_slug' => 'main_content',
        ];

        $fields['label'] = [
            'label'           => __('Label', 'divitorque'),
            'type'            => 'text',
            'option_category' => 'configuration',
            'toggle_slug'     => 'main_content',
            'show_if'         => [
                'show_label' => 'on',
            ],
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover'           => 'tabs',
        ];

        $fields['star_size'] = [
            'label'          => __('Star Size', 'divitorque'),
            'default'        => '24px',
            'range_settings' => [
                'min'  => '12',
                'max'  => '256',
                'step' => '0',
            ],
            'type'            => 'range',
            'option_category' => 'layout',
            'mobile_options'  => true,
            'validate_unit'   => true,
            'toggle_slug'     => 'stars',
            'tab_slug'        => 'advanced',
        ];

        $fields['star_spacing'] = [
            'label'          => __('Star Spacing', 'divitorque'),
            'default'        => '5px',
            'range_settings' => [
                'min'  => '0',
                'max'  => '50',
                'step' => '1',
            ],
            'type'            => 'range',
            'option_category' => 'layout',
            'mobile_options'  => true,
            'validate_unit'   => true,
            'toggle_slug'     => 'stars',
            'tab_slug'        => 'advanced',
        ];

        $fields['star_color'] = [
            'label'       => __('Star Color', 'divitorque'),
            'type'        => 'color-alpha',
            'toggle_slug' => 'stars',
            'tab_slug'    => 'advanced',
            'hover'       => 'tabs',
        ];

        $fields['unmarked_star_color'] = [
            'label'       => __('Unmarked Star Color', 'divitorque'),
            'type'        => 'color-alpha',
            'toggle_slug' => 'stars',
            'tab_slug'    => 'advanced',
            'hover'       => 'tabs',
        ];

        return $fields;
    }

    public function get_advanced_fields_config()
    {

        $advanced_fields = array();
        $advanced_fields['text']          = array();
        $advanced_fields['text_shadow']   = array();
        $advanced_fields['fonts']         = array();

        $advanced_fields['fonts']['label'] = [
            'label'           => esc_html__('Label', 'divi-pro-gallery'),
            'css'             => [
                'main' => "%%order_class%% .torq-star-rating-label",
            ],
            'font_size'       => [
                'default' => '14px',
            ],
            'line_height'     => [
                'default' => '1em',
            ],
            'hide_text_align' => true,
            'toggle_slug'     => 'label',
        ];

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug)
    {

        wp_enqueue_style('torq-star-rating');

        $this->torq_generate_styles($render_slug);

        $multi_view   = et_pb_multi_view_options($this);
        $total_stars  = $this->props['stars'];
        $show_label   = $this->props['show_label'];
        $label        = $this->props['label'];
        $icon_type    = $this->props['icon_type'];
        $render_stars = '';

        for ($i = 0; $i < intval($total_stars); $i++) {
            $render_stars .= $this->star_icon($icon_type);
        }

        $render_label = 'on' === $show_label ? $multi_view->render_element(
            [
                'tag'     => 'div',
                'content' => $label,
                'attrs'   => [
                    'class' => 'torq-star-rating-label',
                ],
            ]
        ) : '';

        return sprintf(
            '<div class="torq-star-rating">
                %1$s
                <div class = "torq-star-rating-wrap">
                    %2$s
                </div>
                %3$s
            </div>',
            $render_label,
            $render_stars,
            $this->star_rating()
        );
    }

    public function star_icon($icon_type = 'fa')
    {
        if ('fa' === $icon_type) {

            return '<svg aria-hidden="true" focusable="false" data-prefix="fas" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star fa-w-18 fa-2x"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>';
        } elseif ('im' === $icon_type) {

            return '<svg xmlns="http://www.w3.org/2000/svg" ifill="currentColor" d="icon-star-full" viewBox="0 0 32 32"><path d="M32 12.408l-11.056-1.607-4.944-10.018-4.944 10.018-11.056 1.607 8 7.798-1.889 11.011 9.889-5.199 9.889 5.199-1.889-11.011 8-7.798z"></path></svg>';
        } else {
            return $this->props['star_icon'];
        }
    }

    public function star_rating()
    {
        $rating  = $this->props['rating'];
        $star_color = $this->props['star_color'];
        $unmarked_star_color = $this->props['unmarked_star_color'];

        $integer = intval($rating);
        $percent = ($rating - $integer) * 100 . '%';

        print_r($this->module_id());

        return sprintf(
            '<svg width="0" height="0">
                <linearGradient id="torq-star_rating%s" x1="0" x2="100%%" y1="0" y2="0">
                    <stop offset="%s" stop-color="%s"></stop>
                    <stop offset="%s" stop-color="%s"></stop>
                </linearGradient>
            </svg>',
            $this->module_id(),
            $percent,
            $star_color,
            $percent,
            $unmarked_star_color
        );
    }

    public function torq_generate_styles($render_slug)
    {
        $rating     = $this->props['rating'];
        $int_rating = intval($rating) + 1;

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => "%%order_class%% .torq-star-rating-wrap svg:nth-child(n+$int_rating)",
                'declaration' => 'fill: lightgrey;',
            ]
        );

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => "%%order_class%% .torq-star-rating-wrap svg:nth-child($int_rating)",
                'declaration' => 'fill: url(#torq-star_rating) !important;',
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'star_size',
                'selector'       => '%%order_class%% .torq-star-rating-wrap svg',
                'css_property'   => 'height',
                'render_slug'    => $render_slug,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'star_size',
                'selector'       => '%%order_class%% .torq-star-rating-wrap svg',
                'css_property'   => 'width',
                'render_slug'    => $render_slug,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'star_spacing',
                'selector'       => '%%order_class%% .torq-star-rating-wrap',
                'css_property'   => 'gap',
                'render_slug'    => $render_slug,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => true,
                'base_attr_name' => 'star_color',
                'selector'       => '%%order_class%% .torq-star-rating-wrap svg',
                'css_property'   => ['fill'],
                'render_slug'    => $render_slug,
                'type'           => 'color',
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'unmarked_star_color',
                'selector'       => "%%order_class%% .torq-star-rating-wrap svg:nth-child(n+$int_rating)",
                'css_property'   => ['fill'],
                'important'      => false,
                'render_slug'    => $render_slug,
                'type'           => 'color',
            ]
        );
    }
}

new TORQ_StarRating;
