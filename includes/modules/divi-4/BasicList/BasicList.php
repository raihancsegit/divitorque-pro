<?php

class TORQ_BasicList extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Torq Basic List', 'divitorque');
        $this->plural = esc_html__('Torq Basic Lists', 'divitorque');
        $this->slug = 'torq_basic_list';
        $this->vb_support = 'on';
        $this->child_slug = 'torq_basic_list_child';
        $this->child_item_text = esc_html__('List Item', 'divitorque');
        $this->main_css_element = '%%order_class%%';
        $this->settings_modal_toggles = array(
            'advanced' => array(
                'toggles' => array(
                    'list' => esc_html__('List', 'divitorque'),
                    'text' => array(
                        'title' => esc_html__('Text', 'divitorque'),
                        'priority' => 1,
                    ),
                ),
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['list_type'] = array(
            'label' => esc_html__('Marked Type', 'divitorque'),
            'type' => 'select',
            'options' => array(
                'none' => esc_html__('None', 'divitorque'),
                'disc' => esc_html__('Disc', 'divitorque'),
                'square' => esc_html__('Square', 'divitorque'),
                'emoji' => esc_html__('Emoji', 'divitorque'),
                'custom' => esc_html__('Custom', 'divitorque'),
            ),
            'toggle_slug' => 'list',
            'description' => esc_html__('Choose the style for the list marker.', 'divitorque'),
        );

        $fields['list_emoji'] = array(
            'label' => esc_html__('Emoji', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'list',
            'description' => esc_html__('Enter an emoji to be used as the list marker.', 'divitorque'),
            'show_if' => [
                'list_type' => 'emoji',
            ]
        );

        $fields['list_custom'] = array(
            'label' => esc_html__('Custom', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'list',
            'description' => esc_html__('Enter a custom character to be used as the list marker.', 'divitorque'),
            'show_if' => [
                'list_type' => 'custom',
            ],
            'mobile_options'  => true,
        );


        $fields['list_position'] = array(
            'label' => esc_html__('List Position', 'divitorque'),
            'type' => 'select',
            'options' => array(
                'inside' => esc_html__('Inside', 'divitorque'),
                'outside' => esc_html__('Outside', 'divitorque'),
            ),
            'default' => 'inside',
            'toggle_slug' => 'list',
            'description' => esc_html__('Choose whether the list marker should be inside or outside the list item.', 'divitorque'),
            'mobile_options'  => true,
        );

        $fields['below_item_spacing'] = array(
            'label' => esc_html__('Below Item Spacing', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'list',
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

        $fields['item_spacing_start'] = array(
            'label' => esc_html__('Item Padding Inline Start ', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'list',
            'description' => esc_html__('Adjust the padding on the inline start of the list item.', 'divitorque'),
            'default' => '10px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options'  => true,
        );

        $fields['list_spacing_start'] = array(
            'label' => esc_html__('List Padding Inline Start ', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'list',
            'default' => '10px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'description' => esc_html__('Adjust the padding on the inline start of the list.', 'divitorque'),
            'mobile_options'  => true,
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();
        $advanced_fields['fonts'] = array();
        $advanced_fields['text'] = array();
        $advanced_fields['link_options'] = array();

        $advanced_fields['fonts']['text'] = array(
            'label'       => esc_html__('Text', 'divitorque'),
            'css'         => array(
                'main'      => ".et_pb_column {$this->main_css_element} .torq-basic-list .torq-basic-list-child",
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
        global $global_basic_list_titles;
        global $global_basic_list_class;

        wp_enqueue_style('torq-basic-list');

        $this->torq_generate_styles($render_slug);

        $lists = $this->torq_list_item();

        $global_basic_list_titles = $global_basic_list_class = array();

        $output = sprintf(
            '<div class="torq-basic-list-container">
                <ul class="torq-basic-list">
                    %1$s
                </ul>
            </div>',
            $lists
        );

        return $output;
    }


    public function torq_list_item()
    {
        global $global_basic_list_titles;
        global $global_basic_list_class;

        $lists = '';

        $i = 0;

        if (!empty($global_basic_list_titles)) {
            foreach ($global_basic_list_titles as $list_title) {
                ++$i;

                $listItem = et_pb_multi_view_options($this)->render_element(
                    array(
                        'content'      => '{{list_title}}',
                        'custom_props' => array(
                            'list_title' => $list_title,
                        ),
                    )
                );

                $listClass = sprintf(
                    'torq-basic-list-child %1$s',
                    esc_attr(ltrim($global_basic_list_class[$i - 1])),
                );

                $lists .= sprintf(
                    '<li class="%1$s">
                        %2$s
                    </li>',
                    $listClass,
                    $listItem,
                );
            }
        }

        return $lists;
    }

    private function torq_generate_styles($render_slug)
    {
        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'below_item_spacing',
            'selector'       => 'div%%order_class%% .torq-basic-list .torq-basic-list-child',
            'css_property'   => 'margin-bottom',
            'render_slug'    => $render_slug,
        ]);

        $list_type = $this->props['list_type'];

        if ($list_type === 'disc') {
            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'list_type',
                'selector'       => 'div%%order_class%% .torq-basic-list',
                'css_property'   => 'list-style-type',
                'render_slug'    => $render_slug,
            ]);
        }

        if ($list_type === 'square') {
            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'list_type',
                'selector'       => 'div%%order_class%% .torq-basic-list',
                'css_property'   => 'list-style-type',
                'render_slug'    => $render_slug,
            ]);
        }

        if ($list_type === 'emoji') {
            ET_Builder_Element::set_style(
                $render_slug,
                array(
                    'selector'    => 'div%%order_class%% .torq-basic-list',
                    'declaration' => 'list-style-type:\'' . $this->props['list_emoji'] . '\' !important;',
                )
            );
        }

        if ($list_type === 'custom') {
            $this->generate_styles([
                'hover'          => false,
                'base_attr_name' => 'list_custom',
                'selector'       => 'div%%order_class%% .torq-basic-list',
                'css_property'   => 'list-style-type',
                'render_slug'    => $render_slug,
            ]);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'list_position',
            'selector'       => 'div%%order_class%% .torq-basic-list',
            'css_property'   => 'list-style-position',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'item_spacing_start',
            'selector'       => 'div%%order_class%% .torq-basic-list .torq-basic-list-child',
            'css_property'   => 'padding-inline-start',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'list_spacing_start',
            'selector'       => 'div%%order_class%% .torq-basic-list',
            'css_property'   => 'padding-inline-start',
            'render_slug'    => $render_slug,
        ]);
    }
}

new TORQ_BasicList;
