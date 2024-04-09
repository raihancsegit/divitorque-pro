<?php

namespace DiviTorque;

use DiviTorque\Database;
use DiviTorque\AdminHelper;
use DiviTorque\AssetsManager;
use DiviTorque\RestApi;
use DiviTorque\Dashboard;
use DiviTorque\DiviContactForm;
use DiviTorque\ModulesManager;
use DiviTorque\Attachment;
use DiviTorque\License;
use DiviTorque\Updater;

/**
 * Main class plugin
 */
class PluginLoader
{

    /**
     * @var PluginLoader
     */
    private static $instance;

    /**
     * Get an instance of the PluginLoader
     *
     * @return PluginLoader
     */
    public static function get_instance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof PluginLoader))
            self::$instance = new PluginLoader;

        return self::$instance;
    }

    /**
     * PluginLoader constructor.
     */
    public function __construct()
    {
        if ('true' === DTP_SELF_HOSTED_ACTIVE) {
            new License(DTP_API_URL);
            new Updater(
                DTP_BASENAME,
                DTP_BASENAME_DIR,
                DTP_VERSION,
                DTP_API_URL
            );
        }

        AssetsManager::get_instance();
        RestApi::get_instance();
        Dashboard::get_instance();
        DiviContactForm::get_instance();

        add_action('divi_extensions_init', array($this, 'init_extension'));
        add_action('plugins_loaded', array($this, 'load_textdomain'), 15);
        add_filter('plugin_action_links_' . DTP_BASENAME, array($this, 'add_plugin_action_links'));
        register_activation_hook(DTP_BASENAME, array($this, 'activation'));
    }

    /**
     * Run the activation of the plugin
     */
    public function activation()
    {
        self::init();
        Database::migrate();
    }

    /**
     * Initialize the plugin
     */
    public static function init()
    {
        $module_status = get_option('_divitorque_modules', array());
        $modules    = AdminHelper::get_modules();

        if (empty($module_status)) {

            foreach ($modules as $module) {
                $module_status[$module] = $module;
            }

            update_option('_divitorque_modules', $module_status);
        }
    }

    /**
     * Load the text domain of the plugin
     */
    public function load_textdomain()
    {
        load_plugin_textdomain('divitorque', false, DTP_BASENAME_DIR . '/languages');
    }

    /**
     * Add plugin action links
     *
     * @param $links
     * @return array
     */
    public function add_plugin_action_links($links)
    {
        $links[] = '<a href="https://divitorque.com/docs/" target="_blank">' . __('Docs', 'divitorque') . '</a>';
        $links[] = '<a href="' . admin_url('admin.php?page=divitorque-pro') . '">' . __('Settings', 'divitorque') . '</a>';
        return $links;
    }

    /**
     *  Load the extensions.
     *
     * @return void
     */
    public function init_extension()
    {
        ModulesManager::get_instance();
    }
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
PluginLoader::get_instance();
