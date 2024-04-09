<?php

class TORQ_StatsGridChild extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Stat Item', 'divitorque');
        $this->plural = esc_html__('Stat Items', 'divitorque');
        $this->slug = 'torq_stats_grid_child';
        $this->type = 'child';
        $this->vb_support = 'on';
        $this->child_title_var = 'title';
        $this->advanced_setting_title_text = esc_html__('New Stat Item', 'divitorque');
        $this->settings_text = esc_html__('List Stat Settings', 'divitorque');
        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Content', 'divitorque'),
                ),
            ),

            'advanced' => array(
                'toggles' => array(
                    'icon_settings' => esc_html__('Icon Settings', 'divitorque'),
                    'content'     => array(
                        'title'             => esc_html__('Content', 'divitorque'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => array(
                            'title'       => array(
                                'name' => esc_html__('Title', 'divitorque'),
                            ),
                            'description'       => array(
                                'name' => esc_html__('Description', 'divitorque'),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['title'] = array(
            'label' => esc_html__('Title', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the name for the list item.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options' => true,
            'hover' => 'tabs',
        );

        $fields['use_icon'] = array(
            'label'            => esc_html__('Use Icon', 'divitorque'),
            'type'             => 'yes_no_button',
            'option_category'  => 'basic_option',
            'options'          => array(
                'off' => esc_html__('No', 'divitorque'),
                'on'  => esc_html__('Yes', 'divitorque'),
            ),
            'toggle_slug' => 'main_content',
            'description'      => esc_html__('Here you can choose whether or not to display an icon.', 'divitorque'),
        );

        $fields['font_icon'] = array(
            'label' => esc_html__('Icon', 'divitorque'),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Here you can select the icon for the list item.', 'divitorque'),
            'hover' => 'tabs',
            'mobile_options'  => true,
            'show_if'  => array('use_icon' => 'on'),
        );

        $fields['image'] = array(
            'label'              => esc_html__('Image', 'divitorque'),
            'type'               => 'upload',
            'option_category'    => 'basic_option',
            'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
            'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
            'update_text'        => esc_attr__('Set As Image', 'divitorque'),
            'description'        => esc_html__('Upload your desired image, or type in the URL to the image you would like to display.', 'divitorque'),
            'toggle_slug'        => 'main_content',
            'dynamic_content'    => 'image',
            'show_if'            => array('use_icon' => 'off'),
            'hover'              => 'tabs',
            'mobile_options'     => true,
        );

        $fields['alt'] = array(
            'label'           => esc_html__('Image Alternative Text', 'divitorque'),
            'type'            => 'text',
            'option_category' => 'basic_option',
            'description'     => esc_html__('Alt text content for your image.', 'divitorque'),
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'attributes',
            'show_if'         => array('use_icon' => 'off'),
            'dynamic_content' => 'text',
        );

        $fields['content'] = array(
            'label' => esc_html__('Content', 'divitorque'),
            'type' => 'tiny_mce',
            'option_category' => 'basic_option',
            'dynamic_content' => 'text',
            'description' => esc_html__('Here you can create the content that will be used within the list item.', 'divitorque'),
            'toggle_slug' => 'main_content',
        );

        $fields['icon_color'] = array(
            'label' => esc_html__('Icon Color', 'divitorque'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon_settings',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Here you can adjust the color of the icon.', 'divitorque'),
            'hover' => 'tabs',
            'mobile_options' => true,
            'show_if'  => array('use_icon' => 'on'),
        );

        $fields['icon_size'] = array(
            'label' => esc_html__('Icon Size', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon_settings',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Here you can adjust the size of the icon.', 'divitorque'),
            'range_settings' => array(
                'min' => '16',
                'max' => '256',
                'step' => '1',
            ),
            'mobile_options' => true,
            'hover' => 'tabs',
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();

        $advanced_fields['text'] = array();
        $advanced_fields['fonts'] = array();

        $advanced_fields['fonts']['title'] = array(
            'label'       => esc_html__('Title', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .stats-item .stats-title",
                'important' => 'all',
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'content',
            'sub_toggle'     => 'title',
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
        );

        $advanced_fields['fonts']['description'] = array(
            'label'       => esc_html__('Content', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .stats-item .stats-content",
                'important' => 'all',
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'content',
            'sub_toggle'     => 'description',
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
        );

        return $advanced_fields;
    }

    // Render function to generate the HTML output
    public function render($attrs, $content, $render_slug)
    {
        $this->torq_generate_styles($render_slug);

        $multi_view = et_pb_multi_view_options($this);
        $use_icon = $this->props['use_icon'];
        $font_icon = $this->props['font_icon'];
        $image = $this->props['image'];
        $alt = $this->props['alt'];

        dtp_inject_fa_icons($font_icon);

        if ('off' === $use_icon) {
            $icon_classes = ['stats-image'];
        } else {
            $icon_classes = ['stats-icon', 'et-icon'];
        }

        $this->remove_classname('et_pb_module');

        // Render icon element
        if ('off' === $use_icon) {
            $icon = $multi_view->render_element(
                array(
                    'tag'      => 'img',
                    'attrs'    => array(
                        'src'   => '{{image}}',
                        'class' => implode(' ', $icon_classes),
                        'alt'   => $alt,
                    ),
                    'required' => 'image',
                )
            );
        } else {

            $icon = $multi_view->render_element([
                'tag' => 'span',
                'content' => '{{font_icon}}',
                'attrs' => ['class' => implode(' ', $icon_classes)],
            ]);
        }

        // Render title element
        $title = $multi_view->render_element([
            'tag' => 'h3',
            'content' => '{{title}}',
            'attrs' => ['class' => 'stats-title'],
        ]);

        // Render content element
        $content = $multi_view->render_element([
            'tag' => 'div',
            'content' => '{{content}}',
            'attrs' => ['class' => 'stats-content'],
        ]);

        // Final HTML output
        $output = sprintf(
            '<div class="stats-item">
                <div class="icon-container">%s</div>
                <div class="text-container">
                    %s
                    %s
                </div>
            </div>',
            $icon,
            $title,
            $content
        );

        return $output;
    }

    private function torq_generate_styles($render_slug)
    {
        $this->generate_styles([
            'utility_arg'    => 'icon_font_family',
            'render_slug'    => $render_slug,
            'base_attr_name' => 'font_icon',
            'important'      => true,
            'selector'       => '%%order_class%% .stats-icon',
            'processor'      => ['ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon'],
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_color',
            'selector'       => 'div%%order_class%% .stats-item .stats-icon',
            'css_property'   => 'color',
            'render_slug'    => $render_slug,
        ]);

        if ('on' === $this->props['use_icon']) {
            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_size',
                'selector'       => 'div%%order_class%% .stats-item .stats-icon',
                'css_property'   => 'font-size',
                'render_slug'    => $render_slug,
            ]);
        } else {
            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_size',
                'selector'       => 'div%%order_class%% .stats-item .stats-image',
                'css_property'   => 'width',
                'render_slug'    => $render_slug,
            ]);

            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_size',
                'selector'       => 'div%%order_class%% .stats-item .stats-image',
                'css_property'   => 'height',
                'render_slug'    => $render_slug,
            ]);
        }
    }

    public function multi_view_filter_value($raw_value, $args, $multi_view)
    {
        $name = isset($args['name']) ? $args['name'] : '';

        if ($raw_value && 'font_icon' === $name) {
            return et_pb_get_extended_font_icon_value($raw_value, true);
        }

        return $raw_value;
    }
}

new TORQ_StatsGridChild();
