<?php

namespace DiviTorque;

/**
 * BackendHelpers
 * 
 * This class is used to add helper functions to the backend builder
 * 
 * @package DiviTorque
 */
class BackendHelpers
{

    /**
     * Add the static asset helpers to the page
     * 
     * @param array $exists
     * 
     * @return array
     */
    private function dummyData()
    {
        return array(
            'title'    => _x('Your Title Goes Here', 'Modules dummy content', 'divitorque'),
            'subtitle' => _x('Subtitle goes Here', 'divitorque'),
            'body'     => _x(
                '<p>Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings and even apply custom CSS to this text in the module Advanced settings.</p>',
                'divitorque'
            ),
        );
    }

    /**
     * Add the static asset helpers to the page
     * 
     * @param array $exists
     * 
     * @return array
     */
    public function static_asset_helpers($exists = array())
    {
        $dummyData = $this->dummyData();

        // Pricing Table
        $features = [
            ['name' => __('Unlimited Website Usage', 'divitorque'), 'use_icon' => 'on', 'icon' => '&#xf058;||fa||900'],
            ['name' => __('Product Updates', 'divitorque'), 'use_icon' => 'on', 'icon' => '&#xf058;||fa||900'],
            ['name' => __('1 Year Support', 'divitorque'), 'use_icon' => 'on', 'icon' => '&#xf058;||fa||900'],
            ['name' => __('One Time Fee', 'divitorque'), 'use_icon' => 'on', 'icon' => '&#xf057;||fa||900', 'not_included' => 'on']
        ];

        $torq_pricing_table_child = $this->generate_module_shortcodes('torq_pricing_table_child', $features);

        // Basic List
        $torq_basic_list_child = $this->generate_module_shortcodes('torq_basic_list_child', [
            ['title' => __('List Item 1', 'divitorque')],
            ['title' => __('List Item 2', 'divitorque')],
            ['title' => __('List Item 4', 'divitorque')],
            ['title' => __('List Item 5', 'divitorque')],
            ['title' => __('List Item 3', 'divitorque')]
        ]);

        // Checkmark List
        $torq_checkmark_list_child = $this->generate_module_shortcodes('torq_checkmark_list_child', [
            ['title' => __('List Item 1', 'divitorque'), 'list_type' => 'positive'],
            ['title' => __('List Item 2', 'divitorque'), 'list_type' => 'positive'],
            ['title' => __('List Item 4', 'divitorque'), 'list_type' => 'positive'],
            ['title' => __('List Item 5', 'divitorque'), 'list_type' => 'negative'],
            ['title' => __('List Item 3', 'divitorque'), 'list_type' => 'negative']
        ]);

        // Icon List
        $torq_icon_list_child = $this->generate_module_shortcodes('torq_icon_list_child', [
            ['title' => __('List Item 1', 'divitorque'), 'font_icon' => '&#xf206;||fa||900'],
            ['title' => __('List Item 2', 'divitorque'), 'font_icon' => '&#xf207;||fa||900'],
            ['title' => __('List Item 4', 'divitorque'), 'font_icon' => '&#xf058;||fa||900'],
        ]);

        // Stats Grid
        $statsData = [
            ['title' => '10M+', 'icon' => '&#xf411;', 'content' => 'Active Installs'],
            ['title' => '5.5K', 'icon' => '&#xf004;', 'content' => '5 Star Reviews'],
            ['title' => '104K', 'icon' => '&#xf167;', 'content' => 'YouTube Subscribers'],
            ['title' => '220k', 'icon' => '&#xf39e;', 'content' => 'Facebook Followers'],
            ['title' => '107K', 'icon' => '&#xf16d;', 'content' => 'Instagram Followers'],
            ['title' => '20k', 'icon' => '&#xf099;', 'content' => 'Twitter Followers'],
        ];

        $shortcodes = array_map(function ($stat) {
            return [
                'title' => __($stat['title'], 'divitorque'),
                'use_icon' => 'on',
                'font_icon' => "{$stat['icon']}||" . 'fa||400',
                'content' => $stat['content'],
                'icon_size' => '32px'
            ];
        }, $statsData);

        $torq_stats_grid_child = $this->generate_module_shortcodes('torq_stats_grid_child', $shortcodes);

        // Helpers - These are the default values for the modules
        $helpers = [
            'defaults' => [

                // Pricing Table
                'torq_pricing_table' => array_merge($dummyData, [
                    'content'   => et_fb_process_shortcode($torq_pricing_table_child),
                    'icon'      => '&#xf206;||fa||900',
                    'title'     => _x('Agency', 'Modules dummy content', 'divitorque'),
                    'subtitle'  => _x('Unlimited Websites', 'Modules dummy content', 'divitorque'),
                    'price'     => _x('89', 'Modules dummy content', 'divitorque'),
                    'sale_price' => _x('79', 'Modules dummy content', 'divitorque'),
                    'price_currency'  => _x('$', 'Modules dummy content', 'divitorque'),
                    'price_period'  => _x('month', 'Modules dummy content', 'divitorque'),
                    'period_separator'  => _x('/', 'Modules dummy content', 'divitorque'),
                    'table_padding' => '30px|30px|30px|30px|true|true',
                    'button_text' => _x('Get Started', 'Modules dummy content', 'divitorque'),
                    'button_url' => '#',
                    'custom_button' => 'on',
                    'button_text_size' => '16px',
                    'button_use_icon' => 'off',
                    'button_bg_color' => '#00c853',
                    'button_border_width' => '0px',
                ]),

                // Basic List 
                'torq_basic_list' => [
                    'content' => et_fb_process_shortcode($torq_basic_list_child),
                    'list_type' => 'emoji',
                    'list_emoji' => '👉',
                ],

                // Checkmark List
                'torq_checkmark_list' => [
                    'content' => et_fb_process_shortcode($torq_checkmark_list_child),
                    'icon_positive' => '&#xf058;||fa||900',
                    'icon_negative' => '&#xf057;||fa||900',
                    'icon_positive_color' => '#00c853',
                    'icon_negative_color' => '#FF0000',
                ],

                // Icon List
                'torq_icon_list' => [
                    'content' => et_fb_process_shortcode($torq_icon_list_child),
                    'icon_color' => '#13142D',
                    'icon_bg_color' => '#F8954F',
                ],

                // Star Rating
                'torq_star_rating' => [
                    'rating' => '4.7',
                    'show_label' => 'on',
                    'label' => _x('Rating 4.7/5', 'Modules dummy content', 'divitorque'),
                    'star_color' => '#FF9529',
                    'unmarked_star_color' => '#D3D3D3',
                ],

                // Stats Grid
                'torq_stats_grid' => [
                    'content' => et_fb_process_shortcode($torq_stats_grid_child),
                ]
            ]
        ];

        return array_merge_recursive($exists, $helpers);
    }

    /**
     * Generate the shortcodes for the child modules
     * 
     * @param string $child_name
     * @param array $optionsArray
     * 
     * @return string
     */
    private function generate_module_shortcodes($child_name, $optionsArray)
    {
        return implode('', array_map(function ($options) use ($child_name) {
            return $this->dummy_module_shortcode($child_name, $options);
        }, $optionsArray));
    }

    /**
     * Generate a dummy shortcode for a child module
     * 
     * @param string $child_name
     * @param array $options
     * 
     * @return string
     */
    private function dummy_module_shortcode($child_name, $options)
    {
        $shortcode = sprintf('[%1$s', $child_name);
        foreach ($options as $key => $value) {
            $shortcode .= sprintf(' %1$s="%2$s"', $key, $value);
        }
        $shortcode .= sprintf('][/%1$s]', $child_name);
        return $shortcode;
    }

    /**
     * Add the static asset helpers to the page
     * 
     * @param string $content
     * 
     * @return string
     */
    public function asset_helpers($content)
    {
        $helpers = $this->static_asset_helpers();
        return $content . sprintf(
            ';window.TORQBuilderBackend=%1$s; jQuery.extend(true, window.ETBuilderBackend, %1$s);',
            et_fb_remove_site_url_protocol(wp_json_encode($helpers))
        );
    }
}
