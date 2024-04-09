<?php

class TORQ_Builder_Module_Countdown extends TORQ_Builder_Module
{
    public function init()
    {
        $this->name = esc_html__('Torq Countdown', 'divitorque');
        $this->plural = esc_html__('Torq Countdowns', 'divitorque');
        $this->slug = 'torq_countdown';
        $this->vb_support = 'on';

        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Countdown', 'divitorque'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'boxs' => esc_html__('Boxs', 'divitorque'),
                    'content' => esc_html__('Content', 'divitorque'),
                ),
            ),
        );
    }

    public function get_fields()
    {
        $fields = array();

        $fields['countdown_type'] = array(
            'label' => esc_html__('Type', 'divitorque'),
            'type' => 'select',
            'options' => array(
                'due_date' => esc_html__('Due Date', 'divitorque'),
                'evergreen' => esc_html__('Evergreen', 'divitorque'),
            ),
            'default' => 'due_date',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Select the type of countdown you want to display.', 'divitorque'),
        );

        $fields['due_date'] = array(
            'label' => esc_html__('Due Date', 'divitorque'),
            'type' => 'date_picker',
            'default' => '',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Date set according to your timezone: UTC+0.', 'divitorque'),
            'show_if' => array(
                'countdown_type' => 'due_date',
            ),
        );

        $fields['evergreen_hours'] = array(
            'label' => esc_html__('Hours', 'divitorque'),
            'type' => 'text',
            'option_category'  => 'basic_option',
            'default' => 0,
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Set the number of hours for the countdown.', 'divitorque'),
            'show_if' => array(
                'countdown_type' => 'evergreen',
            ),
        );

        $fields['evergreen_minutes'] = array(
            'label' => esc_html__('Minutes', 'divitorque'),
            'type' => 'text',
            'default' => 0,
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Set the number of minutes for the countdown.', 'divitorque'),
            'show_if' => array(
                'countdown_type' => 'evergreen',
            ),
        );

        $fields['countdown_view'] = array(
            'label' => esc_html__('View', 'divitorque'),
            'type' => 'select',
            'options' => array(
                'column' => esc_html__('Block', 'divitorque'),
                'row' => esc_html__('Inline', 'divitorque'),
            ),
            'default' => 'block',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Select the view of the countdown you want to display.', 'divitorque'),
        );

        $fields['days'] = array(
            'label' => esc_html__('Days', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'on',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Turn on if you want to show the days.', 'divitorque'),
        );

        $fields['hours'] = array(
            'label' => esc_html__('Hours', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'on',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Turn on if you want to show the hours.', 'divitorque'),
        );

        $fields['minutes'] = array(
            'label' => esc_html__('Minutes', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'on',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Turn on if you want to show the minutes.', 'divitorque'),
        );

        $fields['seconds'] = array(
            'label' => esc_html__('Seconds', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'on',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Turn on if you want to show the seconds.', 'divitorque'),
        );

        $fields['label'] = array(
            'label' => esc_html__('Show Label', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'on',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Turn on if you want to show the label.', 'divitorque'),
        );

        $fields['custom_label'] = array(
            'label' => esc_html__('Custom Label', 'divitorque'),
            'type' => 'yes_no_button',
            'options' => array(
                'on' => esc_html__('Show', 'divitorque'),
                'off' => esc_html__('Hide', 'divitorque'),
            ),
            'default' => 'off',
            'toggle_slug' => 'main_content',
            'show_if' => array(
                'label' => 'on',
            ),
            'description' => esc_html__('Turn on if you want to show the custom label.', 'divitorque'),
        );

        $fields['custom_label_days'] = array(
            'label' => esc_html__('Custom Label Days', 'divitorque'),
            'type' => 'text',
            'default' => esc_html__('Days', 'divitorque'),
            'toggle_slug' => 'main_content',
            'show_if' => array(
                'custom_label' => 'on',
            ),
            'description' => esc_html__('Enter the custom label for days.', 'divitorque'),
        );

        $fields['custom_label_hours'] = array(
            'label' => esc_html__('Custom Label Hours', 'divitorque'),
            'type' => 'text',
            'default' => esc_html__('Hours', 'divitorque'),
            'toggle_slug' => 'main_content',
            'show_if' => array(
                'custom_label' => 'on',
            ),
            'description' => esc_html__('Enter the custom label for hours.', 'divitorque'),
        );

        $fields['custom_label_minutes'] = array(
            'label' => esc_html__('Custom Label Minutes', 'divitorque'),
            'type' => 'text',
            'default' => esc_html__('Minutes', 'divitorque'),
            'toggle_slug' => 'main_content',
            'show_if' => array(
                'custom_label' => 'on',
            ),
            'description' => esc_html__('Enter the custom label for minutes.', 'divitorque'),
        );

        $fields['custom_label_seconds'] = array(
            'label' => esc_html__('Custom Label Seconds', 'divitorque'),
            'type' => 'text',
            'default' => esc_html__('Seconds', 'divitorque'),
            'toggle_slug' => 'main_content',
            'show_if' => array(
                'custom_label' => 'on',
            ),
            'description' => esc_html__('Enter the custom label for seconds.', 'divitorque'),
        );

        $fields['after_action'] = array(
            'label' => esc_html__('After Action', 'divitorque'),
            'type' => 'select',
            'options' => array(
                '' => esc_html__('No Action', 'divitorque'),
                'hide' => esc_html__('Hide', 'divitorque'),
                'redirect' => esc_html__('Redirect', 'divitorque'),
                'message' => esc_html__('Message', 'divitorque'),
            ),
            'default' => 'hide',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Select the action you want to take after the countdown is over.', 'divitorque'),
        );

        $fields['redirect_url'] = array(
            'label' => esc_html__('Redirect URL', 'divitorque'),
            'type' => 'text',
            'default' => '',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the URL you want to redirect to after the countdown is over.', 'divitorque'),
            'show_if' => array(
                'after_action' => 'redirect',
            ),
        );

        $fields['expire_message'] = array(
            'label' => esc_html__('Message', 'divitorque'),
            'type' => 'text',
            'default' => '',
            'toggle_slug' => 'main_content',
            'description' => esc_html__('Enter the message you want to display after the countdown is over.', 'divitorque'),
            'show_if' => array(
                'after_action' => 'message',
            ),
        );

        $fields['box_spacing'] = array(
            'label' => esc_html__('Spacing between', 'divitorque'),
            'type'            => 'range',
            'option_category' => 'basic_option',
            'default_unit'    => 'px',
            'default'         => '10px',
            'mobile_options'  => true,
            'range_settings'  => array(
                'min'  => 0,
                'step' => 1,
                'max'  => 200,
            ),
            'toggle_slug'     => 'boxs',
            'tab_slug'        => 'advanced',
            'description' => esc_html__('Enter the spacing between the box number and label.', 'divitorque'),
        );

        $fields['box_text_spacing'] = array(
            'label' => esc_html__('Number and Label Spacing', 'divitorque'),
            'type'            => 'range',
            'option_category' => 'basic_option',
            'default_unit'    => 'px',
            'default'         => '0px',
            'mobile_options'  => true,
            'range_settings'  => array(
                'min'  => 0,
                'step' => 1,
                'max'  => 200,
            ),
            'toggle_slug'     => 'boxs',
            'tab_slug'        => 'advanced',
            'description' => esc_html__('Enter the spacing between the box number and label.', 'divitorque'),
        );

        $fields['box_background_color'] = array(
            'label'       => esc_html__('Background color', 'divitorque'),
            'description' => esc_html__('Select the background color of the box.', 'divitorque'),
            'type'        => 'color-alpha',
            'toggle_slug' => 'boxs',
            'tab_slug'   => 'advanced',
        );

        $fields['box_padding'] = array(
            'label'           => esc_html__('Padding', 'divitorque'),
            'type'            => 'custom_margin',
            'option_category' => 'basic_option',
            'mobile_options'  => true,
            'responsive'      => true,
            'default'         => '10px|10px|10px|10px',
            'toggle_slug' => 'boxs',
            'tab_slug'   => 'advanced',
        );

        return $fields;
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();
        $advanced_fields['text'] = array();

        $advanced_fields['borders']['boxs'] = array(
            'label_prefix' => esc_html__('Boxs', 'divitorque'),
            'css'          => array(
                'main'      => array(
                    'border_radii'  => '%%order_class%% .torq-time-box',
                    'border_styles' => '%%order_class%% .torq-time-box',
                ),
                'important' => 'all',
            ),
            'defaults'     => array(),
            'toggle_slug'  => 'boxs',
            'tab_slug'    => 'advanced',
        );

        $advanced_fields['box_shadow']['boxs'] = array(
            'label'       => esc_html__('Box Shadow', 'divitorque'),
            'css'         => array(
                'main'      => '%%order_class%% .torq-time-box',
                'important' => 'all',
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug'  => 'boxs',
        );

        $advanced_fields['fonts']['numbers'] = array(
            'label'       => esc_html__('Numbers', 'divitorque'),
            'css'         => array(
                'main'      => ".et_pb_column {$this->main_css_element} .torq-countdown span.torq-time",
                'important' => 'all',
            ),
            'line_height' => array(
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
        );

        $advanced_fields['fonts']['labels'] = array(
            'label'       => esc_html__('Labels', 'divitorque'),
            'css'         => array(
                'main'      => ".et_pb_column {$this->main_css_element} .torq-countdown span.torq-label",
                'important' => 'all',
            ),
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
        wp_enqueue_script('torq-countdown');
        wp_enqueue_style('torq-countdown');

        $this->torq_generate_styles($render_slug);

        $dataAttribute = '';

        $due_date = $this->props['due_date'];

        $dataAttribute .= 'data-type="' . $this->props['countdown_type'] . '" ';

        if ('evergreen' === $this->props['countdown_type']) {
            $dataAttribute .= 'data-evergreen-interval="' . $this->dito_evergreen_interval($this->props) . '" ';
        } else {
            $due_date = $this->dito_duedate_timestamp($due_date);
        }

        if ('' !== $this->props['after_action']) {
            $actions = $this->dito_actions($this->props);
            if ($actions) {
                $dataAttribute .= 'data-actions=\'' . htmlspecialchars(wp_json_encode($actions), ENT_QUOTES, 'UTF-8') . '\' ';
            }
        }

        $dataAttribute .= 'data-date="' . $due_date . '" ';

        $countdownData = $dataAttribute;
        $output = '<div class="torq-countdown" ' . $countdownData . '>';

        $output .= '<div class="torq-countdown-container">';
        $times = ['days', 'hours', 'minutes', 'seconds'];
        foreach ($times as $time) {
            $output .= $this->dito_time_box_html($time);
        }
        $output .= '</div>';

        if ('message' === $this->props['after_action']) {
            $output .= '<div class="torq-countdown-expire-message">' . $this->props['message'] . '</div>';
        }

        $output .= '</div>';

        return $output;
    }

    public function multi_view_filter_value($raw_value, $args)
    {
    }


    private function dito_time_box_html($time)
    {

        if ($this->props[$time] === 'off') {
            return '';
        }

        $timeValue = 0;
        $labelValue = '';

        if ($this->props['label'] !== 'off' && $this->props['custom_label']) {
            $custom_label_var = 'custom_label_' . $time;
            if (!empty($this->props[$custom_label_var])) {
                $labelValue = $this->props[$custom_label_var];
            }
        }

        if ($this->props['label'] !== 'off' && empty($labelValue)) {
            $labelValue = ucfirst($time);
        }

        return sprintf(
            '
                <div class="torq-time-box">
                    <span class="torq-time torq-%s">%s</span>%s
                </div>',
            $time,
            $timeValue,
            !empty($labelValue) ? '<span class="torq-label">' . $labelValue . '</span>' : ''
        );
    }

    private function dito_evergreen_interval($props)
    {
        $hours = empty($props['evergreen_hours']) ? 0 : ($props['evergreen_hours'] * HOUR_IN_SECONDS);
        $minutes = empty($props['evergreen_minutes']) ? 0 : ($props['evergreen_minutes'] * MINUTE_IN_SECONDS);
        $evergreen_interval = $hours + $minutes;

        return $evergreen_interval;
    }

    private function dito_duedate_timestamp($due_date)
    {
        $wp_timezone = new \DateTimeZone(wp_timezone_string());
        $due_date = new \DateTime($due_date, $wp_timezone);
        return $due_date->getTimestamp();
    }

    private function dito_actions($props)
    {
        $after_action = $props['after_action'];
        $redirect_url = $props['redirect_url'];
        $message = $props['expire_message'];

        $actions = [];

        if ('redirect' === $after_action && !empty($redirect_url)) {
            $actions['type'] = $after_action;
            $actions['redirect'] = $redirect_url;
        }

        if ('message' === $after_action && !empty($message)) {
            $actions['type'] = $after_action;
            $actions['message'] = $message;
        }

        if ('hide' === $after_action) {
            $actions['type'] = $after_action;
        }


        return $actions;
    }

    private function torq_generate_styles($render_slug)
    {

        $box_padding = $this->props['box_padding'];

        if ($box_padding) {
            $value = explode('|', $box_padding);

            $this->props['box_padding'] = ($value[0] ? $value[0] : 0) . ' ' . ($value[1] ? $value[1] : 0) . ' ' . ($value[2] ? $value[2] : 0) . ' ' . ($value[3] ? $value[3] : 0);
        }

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'box_spacing',
                'selector'       => 'div%%order_class%% .torq-countdown-container',
                'css_property'   => 'gap',
                'render_slug'    => $render_slug,
            ]
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'box_padding',
                'selector'       => 'div%%order_class%% .torq-time-box',
                'css_property'   => 'padding',
                'render_slug'    => $render_slug,
                'type'           => 'custom_margin',
            ]
        );

        $this->generate_styles(
            array(
                'base_attr_name' => 'box_background_color',
                'selector'       => 'div%%order_class%% .torq-time-box',
                'css_property'   => 'background-color',
                'render_slug'    => $render_slug,
                'type'           => 'color',
            )
        );

        $this->generate_styles(
            array(
                'base_attr_name' => 'countdown_view',
                'selector'       => 'div%%order_class%% .torq-time-box',
                'css_property'   => 'flex-direction',
                'render_slug'    => $render_slug,
            )
        );

        $this->generate_styles(
            [
                'hover'          => false,
                'base_attr_name' => 'box_text_spacing',
                'selector'       => 'div%%order_class%% .torq-time-box',
                'css_property'   => 'gap',
                'render_slug'    => $render_slug,
            ]
        );
    }
}

new TORQ_Builder_Module_Countdown;
