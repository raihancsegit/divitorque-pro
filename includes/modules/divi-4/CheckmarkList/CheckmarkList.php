<?php

class TORQ_CheckmarkList extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Torq Checkmark List', 'divitorque');
        $this->plural = esc_html__('Torq Checkmark Lists', 'divitorque');
        $this->slug = 'torq_checkmark_list';
        $this->vb_support = 'on';
        $this->child_slug = 'torq_checkmark_list_child';
        $this->child_item_text = esc_html__('List Item', 'divitorque');
        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Icon', 'divitorque'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'list_style'    => esc_html__('List Style', 'divitorque'),
                    'text'          => esc_html__('Text', 'divitorque'),
                    'icon'          => esc_html__('Icon Settings', 'divitorque'),
                ),
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['icon_positive'] = array(
            'label' => esc_html__('Positive Icon', 'divitorque'),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Choose the icon to display for positive list items.', 'divitorque'),
            'hover' => 'tabs',
            'mobile_options'  => true,
        );

        $fields['icon_negative'] = array(
            'label' => esc_html__('Negative Icon', 'divitorque'),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Choose the icon to display for negative list items.', 'divitorque'),
            'hover' => 'tabs',
            'mobile_options'  => true,
        );

        $fields['icon_size'] = array(
            'label' => esc_html__('Icon Size', 'divitorque'),
            'type' => 'range',
            'toggle_slug' => 'icon',
            'tab_slug'         => 'advanced',
            'description' => esc_html__('Adjust the size of the icon.', 'divitorque'),
            'range_settings' => array(
                'min' => '1',
                'max' => '200',
                'step' => '1',
            ),
            'default'                => '16px',
            'option_category'        => 'layout',
            'mobile_options'         => true,
            'validate_unit'          => true,
            'allowed_units'          => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
        );

        $fields['icon_positive_color'] = array(
            'label' => esc_html__('Positive Color', 'divitorque'),
            'type' => 'color-alpha',
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon',
            'tab_slug'         => 'advanced',
            'description' => esc_html__('Controls the color of the icon.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
        );

        $fields['icon_negative_color'] = array(
            'label' => esc_html__('Negative Color', 'divitorque'),
            'type' => 'color-alpha',
            'option_category' => 'basic_option',
            'description' => esc_html__('Controls the color of the icon.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'toggle_slug' => 'icon',
            'tab_slug'    => 'advanced',
        );

        $fields['is_background'] = array(
            'label' => esc_html__('Background', 'divitorque'),
            'type' => 'yes_no_button',
            'option_category' => 'basic_option',
            'options' => array(
                'on' => esc_html__('On', 'divitorque'),
                'off' => esc_html__('Off', 'divitorque'),
            ),
            'toggle_slug' => 'icon',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Enable this option to apply a background color to the icon.', 'divitorque'),
            'default' => 'on',
        );

        $fields['icon_color'] = array(
            'label' => esc_html__('Icon Color', 'divitorque'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Controls the color of the icon.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if' => array('is_background' => 'on'),
        );



        $fields['icon_area_width'] = array(
            'label' => esc_html__('Area Width', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon',
            'tab_slug'         => 'advanced',
            'description' => esc_html__('Adjust the width of the icon area.', 'divitorque'),
            'default' => '40px',
            'range_settings' => array(
                'min' => '1',
                'max' => '200',
                'step' => '1',
            ),
            'mobile_options'         => true,
            'validate_unit'          => true,
            'allowed_units'          => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
        );

        $fields['icon_area_height'] = array(
            'label' => esc_html__('Area Height', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon',
            'tab_slug'         => 'advanced',
            'description' => esc_html__('Adjust the height of the icon area.', 'divitorque'),
            'default' => '40px',
            'range_settings' => array(
                'min' => '1',
                'max' => '200',
                'step' => '1',
            ),
            'mobile_options'         => true,
            'validate_unit'          => true,
            'allowed_units'          => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
        );

        $fields['icon_border_radii'] = array(
            'label' => esc_html__('Border Radius', 'divitorque'),
            'type' => 'custom_margin',
            'option_category' => 'layout',
            'toggle_slug' => 'icon',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Here you can define the border radius for your icon.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'default' => '2px|2px|2px|2px',
        );

        $fields['below_item_spacing'] = array(
            'label' => esc_html__('Below Item Spacing', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'list_style',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Adjust the spacing below each list item.', 'divitorque'),
            'default' => '10px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options'  => true,
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();

        $advanced_fields['text'] = array();
        $advanced_fields['fonts'] = array();
        $advanced_fields['link_options'] = array();

        $advanced_fields['fonts']['text'] = array(
            'label'       => esc_html__('Text', 'divitorque'),
            'css'         => array(
                'main'      => ".et_pb_column {$this->main_css_element} .torq-checkmark-list .torq-checkmark-list-child",
                'important' => 'all',
            ),
            'toggle_slug' => 'text',
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

    public function render($attrs, $content, $render_slug)
    {
        global $global_checkmark_list_titles;
        global $global_checkmark_list_class;

        wp_enqueue_style('torq-checkmark-list');

        $this->torq_generate_styles($render_slug);

        $lists = $this->torq_list_item();

        $global_checkmark_list_titles = $global_checkmark_list_class = array();

        $output = sprintf(
            '<div class="torq-checkmark-list-container">
                <ul class="torq-checkmark-list">
                    %1$s
                </ul>
            </div>',
            $lists
        );

        return $output;
    }

    private function _renderIcon($type)
    {
        $multi_view = et_pb_multi_view_options($this);

        $icon_classes[] = 'torq-icon dtq-et-icon';
        $icon_negative = $this->props['icon_negative'];
        $icon_positive = $this->props['icon_positive'];

        if ($type === 'negative') {
            dtp_inject_fa_icons($icon_negative);
            $icon_classes[] = 'negative';
            return $multi_view->render_element(
                array(
                    'content' => '{{icon_negative}}',
                    'attrs'   => array(
                        'class' => implode(' ', $icon_classes),
                    ),
                )
            );
        } else {
            dtp_inject_fa_icons($icon_positive);
            $icon_classes[] = 'positive';
            return $multi_view->render_element(
                array(
                    'content' => '{{icon_positive}}',
                    'attrs'   => array(
                        'class' => implode(' ', $icon_classes),
                    ),
                )
            );
        }

        return '';
    }

    public function torq_list_item()
    {
        global $global_checkmark_list_titles, $global_checkmark_list_type, $global_checkmark_list_class;

        $lists = '';
        $i = 0;

        if (!empty($global_checkmark_list_titles)) {
            foreach ($global_checkmark_list_titles as $list_title) {
                ++$i;

                $listItem = et_pb_multi_view_options($this)->render_element(
                    array(
                        'content'      => '{{list_title}}',
                        'custom_props' => array(
                            'list_title' => $list_title,
                        ),
                    )
                );

                $classItem = is_array($global_checkmark_list_class[$i - 1])
                    ? ''
                    : ltrim($global_checkmark_list_class[$i - 1]);

                $listClass = sprintf(
                    'torq-checkmark-list-child %1$s',
                    esc_attr($classItem)
                );

                $lists .= sprintf(
                    '<li class="%1$s">
                        <div class="torq-checkmark-list-child-wrap">
                            %3$s
                            %2$s
                        </div>
                    </li>',
                    $listClass,
                    $listItem,
                    $global_checkmark_list_type[$i - 1]['desktop'] === 'positive'
                        ? $this->_renderIcon('positive')
                        : $this->_renderIcon('negative')
                );
            }
        }

        return $lists;
    }

    private function torq_generate_styles($render_slug)
    {

        $this->generate_styles([
            'utility_arg'    => 'icon_font_family',
            'render_slug'    => $render_slug,
            'base_attr_name' => 'icon_positive',
            'important'      => true,
            'selector'       => '%%order_class%% .torq-checkmark-list .torq-icon.positive',
            'processor'      => ['ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon'],
        ]);

        $this->generate_styles([
            'utility_arg'    => 'icon_font_family',
            'render_slug'    => $render_slug,
            'base_attr_name' => 'icon_negative',
            'important'      => true,
            'selector'       => '%%order_class%% .torq-checkmark-list .torq-icon.negative',
            'processor'      => ['ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon'],
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_size',
            'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon',
            'css_property'   => 'font-size',
            'render_slug'    => $render_slug,
        ]);

        if ('on' === $this->props['is_background']) {

            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_color',
                'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon',
                'css_property'   => 'color',
                'render_slug'    => $render_slug,
            ]);

            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_positive_color',
                'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon.positive',
                'css_property'   => 'background-color',
                'render_slug'    => $render_slug,
            ]);

            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_negative_color',
                'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon.negative',
                'css_property'   => 'background-color',
                'render_slug'    => $render_slug,
            ]);
        } else {

            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_positive_color',
                'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon.positive',
                'css_property'   => 'color',
                'render_slug'    => $render_slug,
            ]);

            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_negative_color',
                'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon.negative',
                'css_property'   => 'color',
                'render_slug'    => $render_slug,
            ]);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_area_height',
            'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon',
            'css_property'   => 'height',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_area_width',
            'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon',
            'css_property'   => 'width',
            'render_slug'    => $render_slug,
        ]);

        $icon_border_radii = $this->props['icon_border_radii'];

        if ($icon_border_radii) {
            $value = explode('|', $icon_border_radii);

            $this->props['icon_border_radii'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_border_radii',
            'selector'       => 'div%%order_class%% .torq-checkmark-list .torq-icon',
            'css_property'   => 'border-radius',
            'render_slug'    => $render_slug,
            'type'           => 'custom_margin',
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'below_item_spacing',
            'selector'       => 'div%%order_class%% .torq-checkmark-list',
            'css_property'   => 'gap',
            'render_slug'    => $render_slug,
        ]);
    }

    public function multi_view_filter_value($raw_value, $args, $multi_view)
    {
        $name = isset($args['name']) ? $args['name'] : '';
        $mode = isset($args['mode']) ? $args['mode'] : '';

        if ($raw_value && 'icon_positive' === $name) {
            return et_pb_get_extended_font_icon_value($raw_value, true);
        }

        if ($raw_value && 'icon_negative' === $name) {
            return et_pb_get_extended_font_icon_value($raw_value, true);
        }

        return $raw_value;
    }
}

new TORQ_CheckmarkList();
