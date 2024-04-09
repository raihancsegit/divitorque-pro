<?php

class TORQ_PricingTable extends TORQ_Builder_Module
{
    public function init()
    {
        parent::init();

        $this->name = esc_html__('Torq Pricing Table', 'divitorque');
        $this->plural = esc_html__('Torq Pricing Tables', 'divitorque');
        $this->slug = 'torq_pricing_table';
        $this->vb_support = 'on';
        $this->child_slug = 'torq_pricing_table_child';
        $this->child_item_text = esc_html__('Feature', 'divitorque');

        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Settings', 'divitorque'),
                    'pricing' => esc_html__('Pricing', 'divitorque'),
                    'features' => esc_html__('Features', 'divitorque'),
                    'footer' => esc_html__('Footer', 'divitorque'),
                    'ribbon' => esc_html__('Ribbon', 'divitorque'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'table_style' => esc_html__('Table Style', 'divitorque'),
                    'table_header' => esc_html__('Header', 'divitorque'),
                    'table_pricing'     => array(
                        'title'             => esc_html__('Pricing', 'divitorque'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => array(
                            'price'       => array(
                                'name' => esc_html__('Price', 'divitorque'),
                            ),
                            'period'       => array(
                                'name' => esc_html__('Period', 'divitorque'),
                            ),
                            'sale'       => array(
                                'name' => esc_html__('Sale Price', 'divitorque'),
                            ),
                        ),
                    ),
                    'table_features' => esc_html__('Features', 'divitorque'),
                    'table_footer' => esc_html__('Footer', 'divitorque'),
                    'table_icon' => esc_html__('Icon Settings', 'divitorque'),
                ),
            ),
        );

        $this->custom_css_fields = array(
            'pricing_table'   => array(
                'label'    => esc_html__('Table', 'divitorque'),
                'selector' => '%%order_class%% .torq-pricing-table',
            ),
            'pricing_table_body'   => array(
                'label'    => esc_html__('Content Body', 'divitorque'),
                'selector' => '%%order_class%% .torq-pricing-table-body',
            ),
            'pricing_table_header'   => array(
                'label'    => esc_html__('Header', 'divitorque'),
                'selector' => '%%order_class%% .torq-pricing-table-header',
            ),
            'pricing_table_price'   => array(
                'label'    => esc_html__('Price', 'divitorque'),
                'selector' => '%%order_class%% .torq-pricing-table-price',
            ),
            'pricing_table_features'   => array(
                'label'    => esc_html__('Features', 'divitorque'),
                'selector' => '%%order_class%% .torq-pricing-table-features',
            ),
            'pricing_table_footer'   => array(
                'label'    => esc_html__('Footer', 'divitorque'),
                'selector' => '%%order_class%% .torq-pricing-table-footer',
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['pricing_style'] = array(
            'label' => esc_html__('Pricing Style', 'divitorque'),
            'type' => 'select',
            'options' => array(
                'default-style' => esc_html__('Default Style', 'divitorque'),
                'style-1' => esc_html__('Style 1', 'divitorque'),
                'style-2' => esc_html__('Style 2', 'divitorque'),
                'style-3' => esc_html__('Style 3', 'divitorque'),
            ),
            'default' => 'default-style',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Select the pricing style.', 'divitorque'),
        );

        // Icon
        $fields['icon'] = array(
            'label' => esc_html__('Icon', 'divitorque'),
            'type' => 'select_icon',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Select an icon for the pricing table.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-2', 'style-3'),
            ),
        );

        $fields['icon_size'] = array(
            'label' => esc_html__('Icon Size', 'divitorque'),
            'type' => 'range',
            'toggle_slug' => 'table_icon',
            'description' => esc_html__('Adjust the size of the icon.', 'divitorque'),
            'range_settings' => array(
                'min' => '1',
                'max' => '200',
                'step' => '1',
            ),
            'default'                => '36px',
            'option_category'        => 'layout',
            'tab_slug'               => 'advanced',
            'mobile_options'         => true,
            'validate_unit'          => true,
            'allowed_units'          => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
            'responsive'             => true,
            'mobile_options'         => true,
            'sticky'                 => true,
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-2', 'style-3'),
            ),
        );

        $fields['icon_area_width'] = array(
            'label' => esc_html__('Area Width', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'table_icon',
            'tab_slug'        => 'advanced',
            'description' => esc_html__('Adjust the width of the icon area.', 'divitorque'),
            'default' => '80px',
            'range_settings' => array(
                'min' => '1',
                'max' => '200',
                'step' => '1',
            ),
            'mobile_options'         => true,
            'validate_unit'          => true,
            'allowed_units'          => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
            'responsive'             => true,
            'mobile_options'         => true,
            'sticky'                 => true,
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-2', 'style-3'),
            ),
        );

        $fields['icon_area_height'] = array(
            'label' => esc_html__('Area Height', 'divitorque'),
            'type' => 'range',
            'option_category' => 'basic_option',
            'toggle_slug' => 'table_icon',
            'tab_slug'        => 'advanced',
            'description' => esc_html__('Adjust the height of the icon area.', 'divitorque'),
            'default' => '80px',
            'range_settings' => array(
                'min' => '1',
                'max' => '200',
                'step' => '1',
            ),
            'mobile_options'         => true,
            'validate_unit'          => true,
            'allowed_units'          => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
            'responsive'             => true,
            'mobile_options'         => true,
            'sticky'                 => true,
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-2', 'style-3'),
            ),
        );

        $fields['icon_color'] = array(
            'label' => esc_html__('Color', 'divitorque'),
            'type'           => 'color-alpha',
            'option_category' => 'basic_option',
            'toggle_slug'     => 'table_icon',
            'tab_slug'        => 'advanced',
            'hover'           => 'tabs',
            'description'     => esc_html__('Adjust the color of the icon.', 'divitorque'),
            'mobile_options'    => true,
            'sticky'            => true,
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-2', 'style-3'),
            ),

        );

        $fields['icon_background_color'] = array(
            'label' => esc_html__('Background Color', 'divitorque'),
            'type'           => 'color-alpha',
            'option_category' => 'basic_option',
            'toggle_slug'   => 'table_icon',
            'tab_slug'        => 'advanced',
            'description'   => esc_html__('Adjust the background color of the icon area.', 'divitorque'),
            'hover'           => 'tabs',
            'mobile_options' => true,
            'sticky'         => true,
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-2', 'style-3'),
            ),
        );

        // Header
        $fields['title'] = array(
            'label' => esc_html__('Title', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the title for the pricing table.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover'           => 'tabs',

        );

        $fields['subtitle'] = array(
            'label' => esc_html__('Sub Title', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'description' => esc_html__('Enter the description for the pricing table.', 'divitorque'),
            'toggle_slug' => 'main_content',
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if' => array(
                'pricing_style' => array('default-style', 'style-1', 'style-2', 'style-3'),
            ),
        );

        $fields['header_padding'] = array(
            'label'           => esc_html__('Padding', 'divitorque'),
            'type'            => 'custom_margin',
            'option_category' => 'basic_option',
            'mobile_options'  => true,
            'responsive'      => true,
            'toggle_slug'     => 'table_header',
            'tab_slug'        => 'advanced',
        );

        $fields['header_background_color'] = array(
            'label' => esc_html__('Background Color', 'divitorque'),
            'type'           => 'color-alpha',
            'option_category' => 'basic_option',
            'toggle_slug'   => 'table_header',
            'tab_slug'        => 'advanced',
            'description'   => esc_html__('Adjust the background color of the header area.', 'divitorque'),
            'hover'           => 'tabs',
            'mobile_options' => true,
            'sticky'         => true,
        );

        $fields['_table_header_title'] = array(
            'type'        => 'torq_separator',
            '_text'       => __('Title and Subtitle', 'divitorque'),
            'toggle_slug'     => 'table_header',
            'tab_slug'        => 'advanced',
        );

        // Pricing
        $fields['price'] = array(
            'label' => esc_html__('Price', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enter the price for the pricing table.', 'divitorque'),
            'dynamic_content' => 'text',
            'hover'       => 'tabs',
        );

        $fields['price_suffix'] = array(
            'label' => esc_html__('Price Suffix', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enter the price suffix for the pricing table.', 'divitorque'),
            'dynamic_content' => 'text',
            'hover'       => 'tabs',
            'show_if' => array(
                'sale_price_on' => 'on',
            ),
        );

        $fields['sale_price_on'] = array(
            'label' => esc_html__('On Sale?', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('No', 'divitorque'),
                'off' => esc_html__('Off', 'divitorque'),
            ),
            'default' => 'off',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enable sale price for the pricing table.', 'divitorque'),
            'hover' => 'tabs',
        );

        $fields['sale_price'] = array(
            'label' => esc_html__('Sale Price', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enter the sale price for the pricing table.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover' => 'tabs',
            'show_if' => array(
                'sale_price_on' => 'on',
            ),
        );

        $fields['op_position'] = array(
            'label' => esc_html__('Position', 'divitorque'),
            'type'           => 'select',
            'option_category' => 'basic_option',
            'default'         => 'above',
            'options'         => array(
                'above' => esc_html__('Above', 'divitorque'),
                'side'  => esc_html__('Side by Side', 'divitorque'),
            ),
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Select the position of the original price.', 'divitorque'),
            'show_if' => array(
                'sale_price_on' => 'on',
            ),
        );

        $fields['price_currency'] = array(
            'label' => esc_html__('Currency Symbol', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enter the currency for the pricing table.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover'           => 'tabs',
        );

        $fields['price_background_color'] = array(
            'label' => esc_html__('Price Background Color', 'divitorque'),
            'type' => 'color-alpha',
            'option_category' => 'basic_option',
            'toggle_slug' => 'table_pricing',
            'tab_slug'        => 'advanced',
            'toggle_slug'    => 'table_pricing',
            'description' => esc_html__('Select the background color for the price.', 'divitorque'),
            'mobile_options'  => true,
            'hover'           => 'tabs',
        );

        $fields['price_period'] = array(
            'label' => esc_html__('Period', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enter the period for the pricing table.', 'divitorque'),
        );

        $fields['period_separator'] = array(
            'label' => esc_html__('Period Separator', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'pricing',
            'description' => esc_html__('Enter the period separator for the pricing table.', 'divitorque'),
        );

        // Pricing box
        $fields['table_padding'] = array(
            'label'           => esc_html__('Padding', 'divitorque'),
            'type'            => 'custom_margin',
            'option_category' => 'basic_option',
            'mobile_options'  => true,
            'responsive'      => true,
            'toggle_slug' => 'table_style',
            'tab_slug'   => 'advanced',
        );

        $fields['content_alignment'] = array(
            'label'           => esc_html__('Content Alignment', 'divitorque'),
            'type'            => 'text_align',
            'option_category' => 'basic_option',
            'options'         => et_builder_get_text_orientation_options(array('justified')),
            'mobile_options'  => true,
            'responsive'      => true,
            'toggle_slug'     => 'table_style',
            'tab_slug'        => 'advanced',
            'default'         => 'center',
        );

        // Features
        $fields['features_padding'] = array(
            'label'           => esc_html__('Padding', 'divitorque'),
            'type'            => 'custom_margin',
            'option_category' => 'basic_option',
            'mobile_options'  => true,
            'responsive'      => true,
            'toggle_slug'     => 'table_features',
            'tab_slug'        => 'advanced',
        );

        // Buttons 
        $fields['button_on'] = array(
            'label' => esc_html__('Display Button', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'on',
            'toggle_slug' => 'footer',
            'description' => esc_html__('Enable button for the pricing table.', 'divitorque'),
            'hover' => 'tabs',
        );

        $fields['button_text'] = array(
            'label' => esc_html__('Button Text', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'footer',
            'description' => esc_html__('Enter the button text for the pricing table.', 'divitorque'),
            'dynamic_content' => 'text',
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if' => array(
                'button_on' => 'on',
            ),
        );

        $fields['url_new_window'] = array(
            'label'            => esc_html__('Button Link Target', 'divitorque'),
            'type'             => 'select',
            'option_category'  => 'configuration',
            'options'          => array(
                'off' => esc_html__('In The Same Window', 'divitorque'),
                'on'  => esc_html__('In The New Tab', 'divitorque'),
            ),
            'toggle_slug' => 'footer',
            'description'      => esc_html__('Here you can choose whether or not your link opens in a new window', 'divitorque'),
            'show_if' => array(
                'button_on' => 'on',
            ),
        );

        $fields['button_url'] = array(
            'label' => esc_html__('Button URL', 'divitorque'),
            'type' => 'text',
            'option_category' => 'basic_option',
            'toggle_slug' => 'footer',
            'description' => esc_html__('Enter the button URL for the pricing table.', 'divitorque'),
            'dynamic_content' => 'url',
            'mobile_options'  => true,
            'hover'           => 'tabs',
            'show_if' => array(
                'button_on' => 'on',
            ),
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();
        $advanced_fields['text'] = array();

        $advanced_fields['borders']['default'] = array(
            'label_prefix' => esc_html__('', 'divitorque'),
            'css'          => array(
                'main'      => array(
                    'border_radii'  => 'div%%order_class%%',
                    'border_styles' => 'div%%order_class%%',
                ),
                'important' => 'all',
            ),
        );

        $advanced_fields['box_shadow']['default'] = array(
            'label'       => esc_html__('Box Shadow', 'divitorque'),
            'css'         => array(
                'main'      => 'div%%order_class%%',
                'important' => 'all',
            ),
        );

        $advanced_fields['borders']['table_style'] = array(
            'label_prefix' => esc_html__('', 'divitorque'),
            'css'          => array(
                'main'      => array(
                    'border_radii'  => 'div%%order_class%% .torq-pricing-table',
                    'border_styles' => 'div%%order_class%% .torq-pricing-table',
                ),
                'important' => 'all',
            ),
            'defaults'     => array(),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_style',
        );

        $advanced_fields['box_shadow']['table_style'] = array(
            'label'       => esc_html__('Box Shadow', 'divitorque'),
            'css'         => array(
                'main'      => '%%order_class%% .torq-pricing-table',
                'important' => 'all',
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_style',
        );

        $advanced_fields['fonts']['header_title'] = array(
            'label'       => esc_html__('Title', 'divitorque'),
            'css'         => array(
                'main'      => ".et_pb_column {$this->main_css_element} .torq-pricing-table-title",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_header',
        );

        $advanced_fields['fonts']['header_subtitle'] = array(
            'label'       => esc_html__('Subtitle', 'divitorque'),
            'css'         => array(
                'main'      => ".et_pb_column {$this->main_css_element} .torq-pricing-table-subtitle",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_header',
        );

        $advanced_fields['fonts']['price'] = array(
            'label'       => esc_html__('Price', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .torq-pricing-table-price .original-price",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),

            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_pricing',
            'sub_toggle'     => 'price',
        );

        $advanced_fields['fonts']['currency'] = array(
            'label'       => esc_html__('Currency', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .torq-pricing-table-price .original-price .currency",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),

            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_pricing',
            'sub_toggle'     => 'price',
        );

        $advanced_fields['fonts']['price_period'] = array(
            'label'       => esc_html__('Period', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .torq-pricing-table-price .period",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_pricing',
            'sub_toggle'     => 'period',
        );

        $advanced_fields['fonts']['sale_price'] = array(
            'label'       => esc_html__('Sale Price', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .torq-pricing-table-price .sale-price",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_pricing',
            'sub_toggle'     => 'sale',
            'depends_show_if' => 'on',
            'hide_text_shadow'  => true,
        );

        $advanced_fields['fonts']['sale_currency'] = array(
            'label'       => esc_html__('Currency', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .torq-pricing-table-price .sale-price .currency",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_pricing',
            'sub_toggle'     => 'sale',
            'depends_show_if' => 'on',
            'hide_text_shadow'  => true,
        );

        $advanced_fields['fonts']['features'] = array(
            'label'       => esc_html__('', 'divitorque'),
            'css'         => array(
                'main'      => "{$this->main_css_element} .torq-pricing-table .torq-pricing-table-feature",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_features',
        );

        $advanced_fields['borders']['features'] = array(
            'label_prefix' => esc_html__('', 'divitorque'),
            'css'          => array(
                'main'      => array(
                    'border_radii'  => "{$this->main_css_element} .torq-pricing-table .torq-pricing-table-feature",
                    'border_styles' => "{$this->main_css_element} .torq-pricing-table .torq-pricing-table-feature",
                ),
                'important' => 'all',
            ),
            'defaults'     => array(),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_features',
        );

        $advanced_fields['button'] = array(
            'button' => array(
                'label'       => esc_html__('Button', 'divitorque'),
                'css'            => array(
                    'main'      => "{$this->main_css_element} .torq-pricing-table-button",
                ),
                'tab_slug'       => 'advanced',
                'toggle_slug'    => 'table_footer',
            ),
        );

        $advanced_fields['borders']['table_icon'] = array(
            'label_prefix' => esc_html__('', 'divitorque'),
            'css'          => array(
                'main'      => array(
                    'border_radii'  => 'div%%order_class%%  .torq-pricing-table .torq-pricing-table-icon .torq-icon',
                    'border_styles' => 'div%%order_class%%  .torq-pricing-table .torq-pricing-table-icon .torq-icon',
                ),
                'important' => 'all',
            ),
            'defaults'     => array(),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_icon',
        );

        $advanced_fields['box_shadow']['table_icon'] = array(
            'label'       => esc_html__('Box Shadow', 'divitorque'),
            'css'         => array(
                'main'      => '%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
                'important' => 'all',
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'table_icon',
        );

        return $advanced_fields;
    }

    public function render($attrs, $content, $render_slug)
    {
        parent::render($attrs, $content, $render_slug);

        wp_enqueue_style('torq-pricing-table');
        $this->torq_generate_styles($render_slug);

        $props = $this->props;
        $multi_view = et_pb_multi_view_options($this);
        $content = $this->content;

        return sprintf(
            '<div class="torq-pricing-table %s">
                <div class="torq-pricing-table-body">
                    %s
                    %s
                    %s
                    %s
                </div>
                %s
            </div>',
            $props['pricing_style'],
            $this->_renderIcon($props),
            $this->_renderHeader($props, $multi_view),
            $this->_renderPrice($props),
            $this->getFeatures($content),
            $this->_renderFooter($props, $multi_view)
        );
    }

    private function _renderIcon($props)
    {
        if (!in_array($props['pricing_style'], ['default-style', 'style-2', 'style-3'])) {
            return '';
        }

        dtp_inject_fa_icons($props['icon']);

        return sprintf(
            '
            <div class="torq-pricing-table-icon">
                <i class="torq-icon dtq-et-icon">%s</i>
            </div>',
            esc_attr(et_pb_process_font_icon($props['icon']))
        );
    }

    private function _renderHeader($props, $multi_view)
    {
        $headerContent = [];

        if ($props['title']) {
            $headerContent[] = $multi_view->render_element([
                'tag'     => 'h3',
                'content' => '{{title}}',
                'attrs'   => ['class' => 'torq-pricing-table-title'],
            ]);
        }

        if ($props['subtitle'] && $props['pricing_style']) {
            $headerContent[] = sprintf('<p class="torq-pricing-table-subtitle">%s</p>', $props['subtitle']);
        }

        return sprintf(
            '<div class="torq-pricing-table-header">
                %s
            </div>',
            implode('', $headerContent)
        );
    }

    private function getFeatures($content)
    {
        return sprintf(
            '<ul class="torq-pricing-table-features">
                %s
            </ul>',
            $content
        );
    }

    private function _renderPrice($props)
    {
        $originalPriceFormat = '<span class="original-price">%s <span class="currency">%s</span>%s</span>';
        $original_price = sprintf($originalPriceFormat, $props['price_suffix'], $props['price_currency'], $props['price']);

        $periodSegment = '<span class="period">%s%s</span>';
        $period = sprintf($periodSegment, $props['period_separator'], $props['price_period']);

        if ($props['sale_price_on'] === 'on') {
            $salePriceFormat = '<span class="price-tag sale-on %s">%s<span class="sale-price"><span class="currency">%s</span>%s%s</span></span>';
            $priceHtml = sprintf($salePriceFormat, $props['op_position'], $original_price, $props['price_currency'], $props['sale_price'], $period);
        } else {
            $regularPriceFormat = '<span class="price-tag">%s%s</span>';
            $priceHtml = sprintf($regularPriceFormat, $original_price, $period);
        }

        return sprintf('<div class="torq-pricing-table-price">%s</div>', $priceHtml);
    }


    private function _renderFooter($props, $multi_view)
    {
        if ($props['button_on'] === 'off') {
            return '';
        }

        $classes = 'torq-button torq-pricing-table-button';
        $button  = $this->_createButton($props, $multi_view, $classes);

        return sprintf(
            '<div class="torq-pricing-table-footer">%s</div>',
            et_core_esc_previously($button)
        );
    }

    private function torq_generate_styles($render_slug)
    {
        $this->generate_styles([
            'utility_arg'    => 'icon_font_family',
            'render_slug'    => $render_slug,
            'base_attr_name' => 'icon',
            'important'      => true,
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
            'processor'      => ['ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon'],
        ]);

        $table_padding = $this->props['table_padding'];

        if ($table_padding) {
            $value = explode('|', $table_padding);

            $this->props['table_padding'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'table_padding',
            'selector'       => 'div%%order_class%% .torq-pricing-table',
            'css_property'   => 'padding',
            'render_slug'    => $render_slug,
            'type'           => 'custom_margin',
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'content_alignment',
            'selector'       => 'div%%order_class%% .torq-pricing-table',
            'css_property'   => 'text-align',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_size',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
            'css_property'   => 'font-size',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_color',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
            'css_property'   => 'color',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_background_color',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
            'css_property'   => 'background-color',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_area_height',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
            'css_property'   => 'height',
            'render_slug'    => $render_slug,
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'icon_area_width',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-icon .torq-icon',
            'css_property'   => 'width',
            'render_slug'    => $render_slug,
        ]);

        $header_padding = $this->props['header_padding'];

        if ($header_padding) {
            $value = explode('|', $header_padding);

            $this->props['header_padding'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'header_padding',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-header',
            'css_property'   => 'padding',
            'render_slug'    => $render_slug,
            'type'           => 'custom_margin',
        ]);

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'header_background_color',
            'selector'       => 'div%%order_class%% .torq-pricing-table .torq-pricing-table-header',
            'css_property'   => 'background-color',
            'render_slug'    => $render_slug,
        ]);

        // Features
        $features_padding = $this->props['features_padding'];

        if ($features_padding) {
            $value = explode('|', $features_padding);

            $this->props['features_padding'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }

        $this->generate_styles([
            'hover'          => false,
            'base_attr_name' => 'features_padding',
            'selector'       => 'div%%order_class%% .torq-pricing-table-features',
            'css_property'   => 'padding',
            'render_slug'    => $render_slug,
            'type'           => 'custom_margin',
        ]);
    }
}

new TORQ_PricingTable;
