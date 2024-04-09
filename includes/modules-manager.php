<?php

namespace DiviTorque;

use DiviTorque\AdminHelper;

/**
 * Class ModulesManager
 *
 * @package DiviTorque Pro
 */
final class ModulesManager
{
    /**
     * @var ModulesManager
     */
    private static $instance;

    /**
     * Get an instance of the ModulesManager
     *
     * @return ModulesManager
     */
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new ModulesManager();
        }

        return self::$instance;
    }

    /**
     * ModulesManager constructor.
     */
    public function __construct()
    {
        add_action('et_builder_ready', [$this, 'load_modules'], 9);
        add_filter('attachment_fields_to_edit', [$this, 'custom_fields_edit'], 10, 2);
        add_filter('attachment_fields_to_save', [$this, 'custom_fields_save'], 10, 2);
    }

    /**
     * Extract module information from the module.json file in each directory
     *
     * @return array
     */
    private static function extract_modules()
    {
        $modules = [];
        $path = __DIR__ . '/modules/divi-5/modules-json/';
        $directories = glob($path . '*', GLOB_ONLYDIR);

        foreach ($directories as $dir) {
            $module_file = $dir . '/module.json';

            if (file_exists($module_file)) {
                $module_data = json_decode(file_get_contents($module_file), true);

                if (isset($module_data['name'])) {
                    $module = [
                        'name' => str_replace('divitorque/', '', $module_data['name']),
                        'title' => $module_data['title'],
                    ];
                    if (isset($module_data['child_name'])) {
                        $module['child_name'] = str_replace('divitorque/', '', $module_data['child_name']);
                    }
                    $modules[] = $module;
                }
            }
        }

        return $modules;
    }


    /**
     * Get all modules
     *
     * @return array
     */
    public static function get_all_modules()
    {
        return self::extract_modules();
    }

    /**
     * Load active modules
     */
    public function load_modules()
    {
        if (!class_exists(\ET_Builder_Element::class)) {
            return;
        }

        $active_modules = $this->active_modules();

        foreach ($active_modules as $module) {

            $module_name = str_replace('-', '', ucwords($module, '-'));
            $module_path = sprintf('%1$s/modules/divi-4/%2$s/%2$s.php', __DIR__, $module_name);

            if (file_exists($module_path)) {
                require_once $module_path;
            }
        }
    }

    /**
     * Get active modules
     *
     * @return array
     */
    public function active_modules()
    {
        $all_modules = self::get_all_modules();
        $saved_modules = AdminHelper::get_modules();

        $active_modules = [];

        foreach ($saved_modules as $saved_module) {
            foreach ($all_modules as $module) {
                if ($saved_module === $module['name']) {
                    $active_modules[$saved_module] = $saved_module;
                    if (isset($module['child_name'])) {
                        $active_modules[$module['child_name']] = $module['child_name'];
                    }
                }
            }
        }

        return $active_modules;
    }

    public function custom_fields_edit($form_fields, $post)
    {
        $form_fields['gallery_tags'] = array(
            'label' => sprintf(__('%1s - Tags (Ex: Branding, Print)', 'divitorque'), 'Torque Gallery'),
            'input' => 'text',
            'value' => get_post_meta($post->ID, 'gallery_tags', true),
        );

        $form_fields['gallery_links'] = array(
            'label' => sprintf(__('%1s - Link', 'divitorque'), 'Torque Gallery'),
            'input' => 'text',
            'value' => get_post_meta($post->ID, 'gallery_links', true),
        );

        return $form_fields;
    }

    public function custom_fields_save($post, $attachment)
    {
        if (isset($attachment['gallery_tags'])) {
            update_post_meta($post['ID'], 'gallery_tags', $attachment['gallery_tags']);
        }

        if (isset($attachment['gallery_links'])) {
            update_post_meta($post['ID'], 'gallery_links', $attachment['gallery_links']);
        }

        return $post;
    }
}
