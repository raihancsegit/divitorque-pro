<?php

class TORQ_PricingTableChild extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name                         = esc_html__('Feature', 'divitorque');
        $this->plural                       = esc_html__('Features', 'divitorque');
        $this->slug                         = 'torq_pricing_table_child';
        $this->type                        = 'child';
        $this->vb_support                   = 'on';
        $this->child_title_var             = 'name';
        $this->advanced_setting_title_text  = esc_html__('New Feature', 'divitorque');
        $this->settings_text                = esc_html__('Feature Settings', 'divitorque');
        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Feature', 'divitorque'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'feature' => esc_html__('Feature', 'divitorque'),
                ),
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['name'] = array(
            'label' => esc_html__('Feature Name', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the name for the feature.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover'           => 'tabs',
        );

        $fields['use_icon'] = array(
            'label'            => esc_html__('Use Icon', 'divitorque'),
            'type'             => 'yes_no_button',
            'option_category'  => 'basic_option',
            'options'          => array(
                'off' => et_builder_i18n('No'),
                'on'  => et_builder_i18n('Yes'),
            ),
            'toggle_slug'      => 'main_content',
            'description'      => esc_html__('Here you can choose whether icon set below should be used.', 'divitorque'),
            'default'          => 'on',
        );

        $fields['icon'] = array(
            'label'           => esc_html__('Icon', 'divitorque'),
            'type'            => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug'     => 'main_content',
            'description'     => esc_html__('Here you can select the icon you want to use.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if'        => array('use_icon' => 'on'),
        );

        $fields['icon_color'] = array(
            'label' => esc_html__('Icon Color', 'divitorque'),
            'type' => 'color-alpha',
            'custom_color' => true,
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Controls the color of the icon.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if'        => array('use_icon' => 'on'),
        );

        $fields['not_included'] = array(
            'label' => esc_html__('Not Included', 'divitorque'),
            'type'             => 'yes_no_button',
            'option_category'  => 'basic_option',
            'default'          => 'off',
            'options'          => array(
                'off' => et_builder_i18n('No'),
                'on'  => et_builder_i18n('Yes'),
            ),
            'toggle_slug'      => 'main_content',
            'description' => esc_html__('Enable or disable the feature.', 'divitorque'),
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();
        $advanced_fields['text'] = array();
        $advanced_fields['button'] = array();
        $advanced_fields['background'] = array();
        $advanced_fields['border'] = array();
        $advanced_fields['box_shadow'] = array();
        $advanced_fields['filters'] = array();
        $advanced_fields['animation'] = array();
        $advanced_fields['text_shadow'] = array();
        $advanced_fields['max_width'] = array();
        $advanced_fields['margin_padding'] = array();
        $advanced_fields['fonts'] = array();
        $advanced_fields['button'] = array();
        $advanced_fields['text_orientation'] = array();
        $advanced_fields['text_shadow'] = array();
        $advanced_fields['link_options'] = null;

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug)
    {

        $this->remove_classname('et_pb_module');
        $this->add_classname('torq-pricing-table-feature');

        if ($this->props['not_included'] === 'on') {
            $this->add_classname('torq-feature-not-included');
        }

        $renderIcon = $this->_renderIcon($this->props);

        $this->generate_styles([
            'utility_arg'    => 'icon_font_family',
            'render_slug'    => $render_slug,
            'base_attr_name' => 'icon',
            'important'      => true,
            'selector'       => '%%order_class%% .torq-icon',
            'processor'      => ['ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon'],
        ]);

        $output = sprintf(
            '<li class="%3$s">%1$s%2$s</li>',
            $renderIcon,
            $this->props['name'],
            $this->module_classname($render_slug),
        );

        return $output;
    }

    protected function _render_module_wrapper($output = '', $render_slug = '')
    {
        return $output;
    }

    private function _renderIcon($props)
    {

        if ($props['use_icon'] === 'off') {
            return '';
        }

        dtp_inject_fa_icons($props['icon']);

        return sprintf(
            '<i class="torq-icon dtq-et-icon">%s</i>',
            esc_attr(et_pb_process_font_icon($props['icon']))
        );
    }
}

new TORQ_PricingTableChild;
