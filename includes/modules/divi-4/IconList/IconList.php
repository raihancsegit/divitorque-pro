<?php

class TORQ_IconList extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Torq Icon List', 'divitorque');
        $this->plural = esc_html__('Torq Icon Lists', 'divitorque');
        $this->slug = 'torq_icon_list';
        $this->vb_support = 'on';
        $this->child_slug = 'torq_icon_list_child';
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

        $fields['icon_color'] = array(
            'label' => esc_html__('Icon Color', 'divitorque'),
            'type' => 'color-alpha',
            'option_category' => 'basic_option',
            'description' => esc_html__('Controls the color of the icon.', 'divitorque'),
            'mobile_options'  => true,
            'hover' => 'tabs',
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

        $fields['icon_bg_color'] = array(
            'label' => esc_html__('Icon background Color', 'divitorque'),
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

        $fields['icon_border_radii'] = array(
            'label' => esc_html__('Border Radius', 'divitorque'),
            'type' => 'custom_margin',
            'option_category' => 'layout',
            'toggle_slug' => 'icon',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Here you can define the border radius for your icon.', 'divitorque'),
            'hover'           => 'tabs',
            'default' => '0px|0px|0px|0px',
            'mobile_options'  => true,
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
                'main'      => "{$this->main_css_element} .torq-icon-list .torq-icon-list-child",
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

        wp_enqueue_style('torq-icon-list');

        $this->torq_generate_styles($render_slug);

        $content = $this->props['content'];

        $output = sprintf(
            '<div class="torq-icon-list-container">
                <ul class="torq-icon-list">
                    %1$s
                </ul>
            </div>',
            $content
        );

        return $output;
    }

    private function torq_generate_styles($render_slug)
    {

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_size',
            'selector'       => 'div%%order_class%% .torq-icon-list .torq-icon',
            'css_property'   => 'font-size',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_color',
            'selector'       => 'div%%order_class%% .torq-icon-list .torq-icon',
            'css_property'   => 'color',
            'render_slug'    => $render_slug,
        ]);

        if ('on' === $this->props['is_background']) {
            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'icon_bg_color',
                'selector'       => 'div%%order_class%% .torq-icon-list .torq-icon',
                'css_property'   => 'background-color',
                'render_slug'    => $render_slug,
            ]);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_area_height',
            'selector'       => 'div%%order_class%% .torq-icon-list .torq-icon',
            'css_property'   => 'height',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_area_width',
            'selector'       => 'div%%order_class%% .torq-icon-list .torq-icon',
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
            'selector'       => 'div%%order_class%% .torq-icon-list .torq-icon',
            'css_property'   => 'border-radius',
            'render_slug'    => $render_slug,
            'type'           => 'custom_margin',
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'below_item_spacing',
            'selector'       => 'div%%order_class%% .torq-icon-list',
            'css_property'   => 'gap',
            'render_slug'    => $render_slug,
        ]);
    }
}

new TORQ_IconList;
