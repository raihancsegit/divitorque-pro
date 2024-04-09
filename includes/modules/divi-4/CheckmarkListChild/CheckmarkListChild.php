<?php

class TORQ_CheckmarkListChild extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('List Item', 'divitorque');
        $this->plural = esc_html__('List Items', 'divitorque');
        $this->slug = 'torq_checkmark_list_child';
        $this->type = 'child';
        $this->vb_support = 'on';
        $this->child_title_var = 'name';
        $this->advanced_setting_title_text = esc_html__('New List Item', 'divitorque');
        $this->settings_text = esc_html__('List Item Settings', 'divitorque');
        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Content', 'divitorque'),
                ),
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['title'] = array(
            'label' => esc_html__('Item Title', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the Title for the list item.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options' => true,
            'hover' => 'tabs',
        );

        $fields['list_type'] = array(
            'label' => esc_html__('List Type', 'divitorque'),
            'type' => 'select',
            'options' => array(
                'positive' => esc_html__('Positive', 'divitorque'),
                'negative' => esc_html__('Negative', 'divitorque'),
            ),
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Choose whether this list item is positive or negative.', 'divitorque'),
            'mobile_options' => false,
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();

        $advanced_fields['text'] = array();
        $advanced_fields['fonts'] = array();
        $advanced_fields['link_options'] = array();

        $advanced_fields['borders']['default'] = array(
            'css'          => array(
                'main'      => array(
                    'border_radii'  => '%%order_class%%',
                    'border_styles' => '%%order_class%%',
                ),
                'important' => 'all',
            ),
            'defaults'     => array(
                'border_radii'  => 'on|0px|0px|0px|0px',
                'border_styles' => array(
                    'width' => '0px',
                    'color' => '#333333',
                    'style' => 'solid',
                ),
            ),
        );

        $advanced_fields['box_shadow']['default'] = array(
            'css'         => array(
                'main'      => '%%order_class%%',
                'important' => 'all',
            ),
        );

        $advanced_fields['filters']['default'] = array(
            'css'         => array(
                'main'      => '%%order_class%%',
                'important' => 'all',
            ),
        );

        $advanced_fields['max_width']['default'] = array(
            'css'         => array(
                'main'      => '%%order_class%%',
                'important' => 'all',
            ),
        );

        $advanced_fields['margin_padding']['default'] = array(
            'css'         => array(
                'main'      => '%%order_class%%',
                'important' => 'all',
            ),
        );

        $advanced_fields['animation']['default'] = array(
            'css'         => array(
                'main'      => '%%order_class%%',
                'important' => 'all',
            ),
        );

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug)
    {

        global $global_checkmark_list_titles;
        global $global_checkmark_list_class;
        global $global_checkmark_list_type;

        $multi_view = et_pb_multi_view_options($this);

        $global_checkmark_list_titles[]  = $multi_view->get_values('title');
        $global_checkmark_list_type[]  = $multi_view->get_values('list_type');
        $global_checkmark_list_class[] = ET_Builder_Element::get_module_order_class($render_slug);

        // Remove automatically added classnames
        $this->remove_classname(
            array(
                'et_pb_module',
            )
        );

        $output = '';

        return $this->_render_module_wrapper($output, $render_slug);
    }
}

new TORQ_CheckmarkListChild();
