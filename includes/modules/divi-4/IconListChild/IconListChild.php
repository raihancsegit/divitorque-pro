<?php

class TORQ_IconListChild extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('List Item', 'divitorque');
        $this->plural = esc_html__('List Items', 'divitorque');
        $this->slug = 'torq_icon_list_child';
        $this->type = 'child';
        $this->vb_support = 'on';
        $this->child_title_var = 'title';
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
            'label' => esc_html__('Item Name', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the name for the list item.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options' => true,
            'hover' => 'tabs',
        );

        $fields['font_icon'] = array(
            'label' => esc_html__('Icon', 'divitorque'),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Here you can select the icon for the list item.', 'divitorque'),
            'hover' => 'tabs',
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

        $this->torq_generate_styles($render_slug);

        $multi_view = et_pb_multi_view_options($this);

        $font_icon = $this->props['font_icon'];

        dtp_inject_fa_icons($font_icon);

        $icon_classes[] = 'torq-icon dtq-et-icon';

        $this->remove_classname('et_pb_module');

        $list_icon = $multi_view->render_element(
            array(
                'tag'     => 'span',
                'content' => '{{font_icon}}',
                'attrs'   => array(
                    'class' => implode(' ', $icon_classes),
                ),
            )
        );

        $list_title = $multi_view->render_element(
            array(
                'tag'     => 'span',
                'content' => '{{title}}',
                'attrs'   => array(
                    'class' => 'torq-icon-list-child-title',
                ),
            )
        );

        $output = sprintf(
            '<li class="torq-icon-list-child">
                <div class="torq-icon-list-child-wrap">
                    %1$s
                    %2$s
                </div>
            </li>',
            $list_icon,
            $list_title
        );

        return $this->_render_module_wrapper($output, $render_slug);
    }


    private function torq_generate_styles($render_slug)
    {
        $this->generate_styles([
            'utility_arg'    => 'icon_font_family',
            'render_slug'    => $render_slug,
            'base_attr_name' => 'font_icon',
            'important'      => true,
            'selector'       => '%%order_class%% .torq-icon-list-child .torq-icon',
            'processor'      => ['ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon'],
        ]);
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

new TORQ_IconListChild;
