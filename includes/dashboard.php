<?php

namespace DiviTorque;

use DiviTorque\License;
use DiviTorque\ModulesManager;

class Dashboard
{
    private static $instance;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    public function admin_menu()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        add_menu_page(
            __('Divi Torque Pro', 'divitorque'),
            __('Divi Torque Pro', 'divitorque'),
            'manage_options',
            DTP_SLUG,
            [$this, 'load_page'],
            $this->menu_icon(),
            90
        );
    }

    public function load_page()
    {
        $this->enqueue_scripts();
        echo '<div id="divitorque-root"></div>';
    }

    public function enqueue_scripts()
    {

        $manifest_json   = file_get_contents(DTP_PLUGIN_PATH . 'assets/mix-manifest.json');
        $manifest_json   = json_decode($manifest_json, true);
        $dashboardJS     = DTP_PLUGIN_URL . 'assets' . $manifest_json['/js/dashboard.js'];
        $dashboardCSS    = DTP_PLUGIN_URL . 'assets' . $manifest_json['/css/dashboard.css'];

        wp_enqueue_script(DTP_SLUG . '-app', $dashboardJS, $this->wp_deps(), DTP_VERSION, true);
        wp_enqueue_style(DTP_SLUG . '-app', $dashboardCSS, ['wp-components'], DTP_VERSION);

        $module_info = ModulesManager::get_all_modules();

        $localize = apply_filters(
            'divitorque_admin_localize',
            array(

                'root'           => esc_url_raw(get_rest_url()),
                'nonce'          => wp_create_nonce('wp_rest'),
                'assetsPath'     => esc_url_raw(DTP_PLUGIN_ASSETS),
                'self_hosted'    => DTP_SELF_HOSTED_ACTIVE,
                'version'        => DTP_VERSION,
                'home_slug'      => DTP_SLUG,
                'license'        => array(
                    'status' => License::get_license_status(),
                    'key'    => License::get_license_key(),
                ),
                'module_info'        => $module_info
            )
        );

        wp_localize_script(DTP_SLUG . '-app', 'diviTorque', $localize);
    }

    public function wp_deps()
    {
        $deps = [
            'react',
            'wp-api',
            'wp-i18n',
            'lodash',
            'wp-components',
            'wp-element',
            'wp-api-fetch',
            'wp-core-data',
            'wp-data',
            'wp-dom-ready',
        ];

        return $deps;
    }

    public function menu_icon()
    {
        return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0wIDMwQzAgMTMuNDMxNSAxMy40MzE2IDAgMzAgMEM0Ni41Njg0IDAgNjAgMTMuNDMxNSA2MCAzMEM2MCA0Ni41Njg1IDQ2LjU2ODQgNjAgMzAgNjBDMTMuNDMxNiA2MCAwIDQ2LjU2ODUgMCAzMFpNMTEuMzMxNSAyOC41NDc1QzExLjE4MzYgMjguNjgzNiAxMC45ODc4IDI4Ljc2MTIgMTAuNzkxNSAyOC43NjEyQzEwLjYyODQgMjguNzYxMiAxMC40NjUzIDI4LjcwNzUgMTAuMzMwMSAyOC42MTExQzEwLjEzNjcgMjguNDczNCAxMCAyOC4yNDg5IDEwIDI3Ljk2OTZWMjcuNjUzQzEwLjA3OTEgMjcuMzM2MyAxMC4zOTYgMjcuMDk4OSAxMC43OTE1IDI3LjA5ODlDMTEuMTg3NSAyNy4xNzggMTEuNTgzIDI3LjQ5NDYgMTEuNTgzIDI3Ljk2OTZDMTEuNTgzIDI4LjIwOTQgMTEuNDgyNCAyOC40MDg3IDExLjMzMTUgMjguNTQ3NVpNMzAuMTA2OSA1MC43NjgyQzQxLjM0ODEgNTAuNzY4MiA1MC41MzA4IDQxLjY2NDYgNTAuNTMwOCAzMC40MjM2QzUwLjUzMDggMTkuMTgyNyA0MS40MjcyIDEwIDMwLjE4NiAxMEMyNi4xNDg5IDEwIDIyLjQyODIgMTEuMTg3NCAxOS4yNjE3IDEzLjE2NjVDMTUuNjk5NyAxNS40NjIyIDEyLjg1MDEgMTguNzg2OSAxMS4yNjY2IDIyLjc0NUMxMS4wMjkzIDIzLjQ1NzQgMTAuNjMzMyAyNC42NDQ5IDEwLjM5NiAyNS41MTU2QzEwLjM0NDcgMjUuNzczMiAxMC40NjA0IDI2LjAzMDYgMTAuNjU3MiAyNi4yMDFDMTAuNzYyNyAyNi4yOTI1IDEwLjg5MTEgMjYuMzU4OCAxMS4wMjkzIDI2LjM4NjVDMTEuNTAzOSAyNi40NjU2IDExLjg5OTkgMjYuMjI4MSAxMS45NzkgMjUuODMyM0MxMi4wMTk1IDI1LjY2OTQgMTIuMTAyMSAyNS40MjMgMTIuMTcyOSAyNS4yMTEyQzEyLjIzOTcgMjUuMDExIDEyLjI5NTkgMjQuODQxNyAxMi4yOTU5IDI0LjgwMzJDMTIuNDU0MSAyNC40MDczIDEyLjg1MDEgMjQuMTY5OSAxMy4yNDU2IDI0LjMyODJDMTMuNTYyNSAyNC40ODY2IDEzLjc5OTggMjQuODAzMiAxMy43OTk4IDI1LjExOTlDMTMuNzIwNyAyNS4xOTkgMTMuNzIwNyAyNS4xOTkgMTMuNzIwNyAyNS4yNzgyQzEzLjQwMzggMjYuNDY1NiAxMy4wODc0IDI3Ljg5MDUgMTMuMDA4MyAyOS4yMzYyQzEyLjkyOTIgMjkuNjMyMSAxMy4yNDU2IDMwLjAyNzggMTMuNzIwNyAzMC4wMjc4QzE0LjExNjcgMzAuMTA3MSAxNC41MTIyIDI5LjcxMTIgMTQuNTEyMiAyOS4zMTU0QzE0LjUxMjIgMjkuMjc1OSAxNC41MzIyIDI5LjA3NzkgMTQuNTUxOCAyOC44OEMxNC41NzEzIDI4LjY4MjEgMTQuNTkxMyAyOC40ODQxIDE0LjU5MTMgMjguNDQ0NkMxNC44MjkxIDI3LjAxOTcgMTUuMjI0NiAyNS41OTQ4IDE1Ljc3ODggMjQuMjQ5QzE1Ljg1NzkgMjQuMDExNiAxNi4wMTYxIDIzLjg1MzMgMTYuMDk1NyAyMy42MTU3QzE2LjI1MzkgMjMuMjk5MSAxNi43MjkgMjMuMTQwNyAxNy4xMjQ1IDIzLjI5OTFIMTcuMjAzNkMxNy41OTk2IDIzLjQ1NzQgMTcuNzU3OCAyMy44NTMzIDE3LjU5OTYgMjQuMjQ5QzE3LjUyMDUgMjQuMzI4MiAxNy4wNDU0IDI1LjE5OSAxNi43MjkgMjYuNTQ0N0MxNi41NzAzIDI2Ljk0MDYgMTYuODg3MiAyNy40MTU1IDE3LjM2MjMgMjcuNDk0NkMxNy43NTc4IDI3LjU3MzkgMTguMDc0NyAyNy4zMzYzIDE4LjIzMjkgMjYuOTQwNkMxOC41NDkzIDI1LjkxMTUgMTkuMDI0NCAyNC44ODIzIDE5LjEwMzUgMjQuNzI0QzIwLjIxMTkgMjIuNTA3NCAyMS45NTM2IDIwLjY4NjggMjQuMDkwOCAxOS40OTk0QzI1LjgzMjUgMTguNDcwMiAyNy44OTA2IDE3LjkxNjEgMzAuMTA2OSAxNy45MTYxQzM2Ljk5NDEgMTcuOTE2MSA0Mi41MzU2IDIzLjQ1NzQgNDIuNTM1NiAzMC4zNDQ1QzQyLjUzNTYgMzYuNjc3NCAzNy44NjQ3IDQxLjgyMjkgMzEuODQ4NiA0Mi42OTM2VjI5LjA3NzlDMzEuODQ4NiAyNi44NjEzIDMwLjEwNjkgMjUuMTE5OSAyNy44OTA2IDI1LjExOTlDMjUuNjczOCAyNS4xMTk5IDIzLjkzMjYgMjYuODYxMyAyMy45MzI2IDI5LjA3NzlWNDYuODEwMUMyMy45MzI2IDQ5LjAyNjYgMjUuNjczOCA1MC43NjgyIDI3Ljg5MDYgNTAuNzY4MkgzMC4xMDY5WiIgZmlsbD0iIzFGMjkzNyIvPgo8L3N2Zz4K';
    }
}
