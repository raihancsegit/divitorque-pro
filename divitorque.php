<?php

/**
 * Plugin Name: Divi Torque Pro
 * Plugin URI: https://divitorque.com
 * Description: Powerful divi modules to create powerful websites.
 * Author: WPPaw
 * Author URI: https://wppaw.com
 * Version: 1.2.0
 * Text Domain: divitorque
 * Domain Path: /languages
 * 
 * @package divitorque-pro
 */

// don't call the file directly
if (!defined('ABSPATH'))
    exit;

// Defining constants
define('DTP_SLUG', 'divitorque-pro');
define('DTP_VERSION', '1.2.0');
define('DTP_BASENAME', plugin_basename(__FILE__));
define('DTP_BASENAME_DIR', plugin_basename(__DIR__));
define('DTP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('DTP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DTP_PLUGIN_ASSETS', trailingslashit(DTP_PLUGIN_URL . 'assets'));

// #ET_MARKETPLACE
define('DTP_SELF_HOSTED_ACTIVE', 'true');

if (!defined('DTP_API_URL')) {
    define('DTP_API_URL', 'https://divitorque.com/wp-json/lsq/v1');
}

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    return;
}

require __DIR__ . '/vendor/autoload.php';

require_once 'plugin-loader.php';
