<?php

class TORQ_StatsGrid extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Torq Stats Grid', 'divitorque');
        $this->plural = esc_html__('Torq Stats Grid', 'divitorque');
        $this->slug = 'torq_stats_grid';
        $this->child_slug = 'torq_stats_grid_child';
        $this->vb_support = 'on';
        $this->child_item_text = esc_html__('Stat Item', 'divitorque');
        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Content', 'divitorque'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'grid_settings' => esc_html__('Grid Settings', 'divitorque'),
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
            )
        );
    }

    public function get_fields()
    {
        $fields = array();

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
        );

        $fields['icon_size'] = array(
            'label' => esc_html__('Icon Size', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon_settings',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Here you can adjust the size of the icon.', 'divitorque'),
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '16',
                'max' => '256',
                'step' => '1',
            ),
            'mobile_options' => true,
            'hover' => 'tabs',
        );

        $fields['icon_bottom_spacing'] = array(
            'label' => esc_html__('Below Item Spacing', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'icon_settings',
            'tab_slug'    => 'advanced',
            'description' => esc_html__('Adjust the spacing below each grid item.', 'divitorque'),
            'default' => '10px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options'  => true,
        );

        $fields['grid_columns'] = array(
            'label' => esc_html__('Columns', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'description' => esc_html__('Adjust the number of columns in the grid.', 'divitorque'),
            'default' => '3',
            'range_settings' => array(
                'min' => '1',
                'max' => '12',
                'step' => '1',
            ),
            'mobile_options'  => true,
            'toggle_slug' => 'grid_settings',
            'tab_slug'    => 'advanced',
        );

        $fields['grid_rows'] = array(
            'label' => esc_html__('Rows', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'description' => esc_html__('Adjust the number of rows in the grid.', 'divitorque'),
            'default' => '2',
            'range_settings' => array(
                'min' => '1',
                'max' => '12',
                'step' => '1',
            ),
            'mobile_options'  => true,
            'toggle_slug' => 'grid_settings',
            'tab_slug'    => 'advanced',
        );

        $fields['grid_gap'] = array(
            'label' => esc_html__('Gap', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'description' => esc_html__('Adjust the gap between grid items.', 'divitorque'),
            'default' => '40px',
            'default_unit' => 'px',
            'range_settings' => array(
                'min' => '0',
                'max' => '100',
                'step' => '1',
            ),
            'mobile_options'  => true,
            'toggle_slug' => 'grid_settings',
            'tab_slug'    => 'advanced',
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
            'toggle_slug' => 'content',
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

    public function render($attrs, $content, $render_slug)
    {
        wp_enqueue_style('torq-stats-grid');

        $this->torq_generate_styles($render_slug);

        $content = $this->props['content'];

        $output = sprintf(
            '<div class="torq-stats-grid">%1$s</div>',
            $content
        );

        return $output;
    }

    private function torq_generate_styles($render_slug)
    {

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_color',
            'selector'       => 'div%%order_class%% .stats-item .stats-icon',
            'css_property'   => 'color',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_bottom_spacing',
            'selector'       => 'div%%order_class%% .stats-item .icon-container',
            'css_property'   => 'margin-bottom',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_size',
            'selector'       => 'div%%order_class%% .stats-item .stats-icon',
            'css_property'   => 'font-size',
            'render_slug'    => $render_slug,
        ]);

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

        // Grid Styles
        $grid_columns = $this->_getResponsiveValues('grid_columns');
        $grid_rows = $this->_getResponsiveValues('grid_rows');

        $devices = ['desktop', 'tablet', 'phone'];

        foreach ($devices as $device) {

            $columns = is_array($grid_columns) ? ($grid_columns[$device] ?? '') : $grid_columns;
            $rows = is_array($grid_rows) ? ($grid_rows[$device] ?? '') : $grid_rows;

            if (!empty($columns) || !empty($rows)) {
                $this->apply_grid_styles($render_slug, $device, $columns, $rows);
            }
        }

        if (!is_array($grid_columns) && !is_array($grid_rows)) {
            $this->apply_grid_styles($render_slug, 'desktop', $grid_columns, $grid_rows);
        }

        // Grid Gap Styles
        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'grid_gap',
            'selector'       => 'div%%order_class%% .torq-stats-grid',
            'css_property'   => 'gap',
            'render_slug'    => $render_slug,
        ]);
    }

    private function apply_grid_styles($render_slug, $device, $columns, $rows)
    {
        $media_query = 'general';
        if ($device === 'tablet') {
            $media_query = ET_Builder_Element::get_media_query('max_width_980');
        } elseif ($device === 'phone') {
            $media_query = ET_Builder_Element::get_media_query('max_width_767');
        }

        // Construct the CSS declaration
        $declarationParts = [];
        if (!empty($columns)) {
            $declarationParts[] = "grid-template-columns: repeat($columns, 1fr)";
        }
        if (!empty($rows)) {
            $declarationParts[] = "grid-template-rows: repeat($rows, 1fr)";
        }

        $declaration = implode('; ', $declarationParts);

        ET_Builder_Element::set_style(
            $render_slug,
            [
                'selector'    => 'div%%order_class%% .torq-stats-grid',
                'declaration' => $declaration,
                'media_query' => $media_query
            ]
        );
    }
}

new TORQ_StatsGrid();
