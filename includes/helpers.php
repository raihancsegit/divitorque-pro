<?php

namespace DiviTorque;

class Helpers
{
    public static function init($output = OBJECT)
    {
        $_instance         = new static();
        $_instance->output = $output;

        return $_instance;
    }

    public static function render_attributes($attributes)
    {
        $return = '';

        foreach ($attributes as $name => $value) {

            if (is_array($value) && 'class' == $name) {
                $value = implode(' ', $value);
            }

            // If the attribute is JSON-encoded, use it directly without esc_attr
            if ($name === 'data-config') {
                $return .= ' ' . $name . "='" . $value . "'";
                continue;
            }

            // Handle other attributes
            if (in_array($name, array('alt', 'rel', 'title'))) {
                $value = str_replace('<script', '&lt;script', $value);
                $value = wp_strip_all_tags(htmlspecialchars($value));
                $value = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $value);
            }

            $return .= ' ' . esc_attr($name) . '="' . esc_attr($value) . '"';
        }

        return $return;
    }


    public static function get_image_sizes()
    {

        $default_image_sizes = ['thumbnail', 'medium', 'medium_large', 'large'];
        $image_sizes         = [];
        foreach ($default_image_sizes as $size) {
            $image_sizes[$size] = [
                'width'  => (int) get_option($size . '_size_w'),
                'height' => (int) get_option($size . '_size_h'),
                'crop'   => (bool) get_option($size . '_crop'),
            ];
        }

        $sizes = [];

        foreach ($image_sizes as $size_key => $size_attributes) {
            $control_title    = ucwords(str_replace('_', ' ', $size_key));
            $sizes[$size_key] = $control_title;
        }

        $sizes['full'] = __('Full', 'divi-pro-gallery');

        return $sizes;
    }

    public static function get_responsive_options($option_name, $props)
    {

        $option                = [];
        $last_edited           = $props["{$option_name}_last_edited"];
        $get_responsive_status = et_pb_get_responsive_status($last_edited);
        $is_responsive_enabled = isset($last_edited) ? $get_responsive_status : false;
        $option_name_tablet    = "{$option_name}_tablet";
        $option_name_phone     = "{$option_name}_phone";

        $option["responsive_status"] = $is_responsive_enabled ? true : false;

        if ($is_responsive_enabled && !empty($props[$option_name_tablet])) {
            $option["tablet"] = $props[$option_name_tablet];
        } else {
            $option["tablet"] = $props[$option_name];
        }

        if ($is_responsive_enabled && !empty($props[$option_name_phone])) {
            $option["phone"] = $props[$option_name_phone];
        } else {
            $option["phone"] = $props[$option_name];
        }

        $option["desktop"] = $props[$option_name];

        return $option;
    }

    public static function get_divi_forms()
    {
        global $wpdb;

        $sql_query = "
            SELECT `ID`, `post_content`, `post_title`
            FROM {$wpdb->posts}
            WHERE post_status = 'publish'
            AND post_type = 'page'
            AND post_content LIKE '%et_pb_contact_form%';
        ";

        $results = $wpdb->get_results($sql_query, ARRAY_A);

        return $results;
    }

    public static function get_browser()
    {
        $browser = get_browser(null, true);

        return $browser['browser'];
    }

    public static function get_device()
    {
        $device = 'desktop';

        if (wp_is_mobile()) {
            $device = 'mobile';
        }

        return $device;
    }

    public static function get_ip()
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    public static function get_city()
    {
        $ip = self::get_ip();

        $url = "http://ip-api.com/json/{$ip}";

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);

        $data = json_decode($body, true);

        if (isset($data['city'])) {
            return $data['city'];
        }

        return false;
    }

    public static function get_country()
    {
        $ip = self::get_ip();

        $url = "http://ip-api.com/json/{$ip}";

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);

        $data = json_decode($body, true);

        if (isset($data['country'])) {
            return $data['country'];
        }

        return false;
    }

    public static function array_flatten($array)
    {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, self::array_flatten($value));
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }
}
