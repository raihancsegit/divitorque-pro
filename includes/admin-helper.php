<?php

namespace DiviTorque;

use DiviTorque\ModulesManager;

class AdminHelper
{

    public static function get_common_settings()
    {
        $options = array(
            'modules_settings' => self::get_modules(),
        );

        return $options;
    }

    public static function get_options()
    {
        $general_settings = self::get_common_settings();
        $options = apply_filters('divitorque_global_data_options', $general_settings);

        return $options;
    }

    public static function get_modules()
    {

        $all_modules    = ModulesManager::get_all_modules();
        $default_modules = array();

        foreach ($all_modules as $name => $value) {
            $_name                          = str_replace('divitorque/', '', $value['name']);
            $default_modules[$_name]        = $_name;
        }

        $saved_modules   = get_option('_divitorque_modules', array());

        return wp_parse_args($saved_modules, $default_modules);
    }
}
