<?php

namespace DiviTorque;

class License
{
    public $api_url;

    public function __construct($api_url)
    {
        $this->api_url       = $api_url;
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes()
    {
        register_rest_route(
            'divitorque-pro/v1',
            '/toggle_license',
            [
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [$this, 'toggle_license'],
                    'args'                => array(
                        'key'    => array(
                            'type'              => 'string',
                            'sanitize_callback' => function ($key) {
                                return (string) esc_attr($key);
                            },
                            'validate_callback' => function ($key) {
                                return is_string($key);
                            },
                        ),
                        'action' => array(
                            'type'              => 'string',
                            'sanitize_callback' => function ($key) {
                                return (string) esc_attr($key);
                            },
                            'validate_callback' => function ($key) {
                                return in_array($key, ['activate', 'deactivate'], true);
                            },
                        ),
                    ),
                    'permission_callback' => function () {
                        return current_user_can('manage_options');
                    },
                ]
            ]
        );
    }

    public function toggle_license($request)
    {

        $params        = $request->get_json_params();
        $license_key   = $params['key'];
        $action        = $params['action'];
        $is_valid      = false;
        $error_message = '';

        if (!isset($license_key) || !isset($action)) {
            return new \WP_REST_Response(
                [
                    'success' => $is_valid,
                    'message' => __('Unauthorized request', 'divitorque'),
                ],
                401
            );
        }

        $instance = 'activate' === $action ? ['instance_name' => home_url()] : ['instance_id' => self::get_instance_id()];

        $activation_url = add_query_arg(
            [
                'license_key' => $license_key,
                $instance,
            ],
            $this->api_url . '/' . $action
        );

        $response = wp_remote_get($activation_url, [
            'sslverify' => false,
            'timeout' => 10,
        ]);

        if (!is_wp_error($response)) {
            if (200 === wp_remote_retrieve_response_code($response)) {
                $is_valid     = true;
                $response_body = json_decode(wp_remote_retrieve_body($response), true);
                self::save_data($response_body, $action);
            } else {
                $error_message = wp_remote_retrieve_response_message($response);
                return new \WP_REST_Response(
                    [
                        'message' => $error_message,
                        'success' => false,
                    ]
                );
            }
        } else {
            $error_message = $response->get_error_message();
            return new \WP_REST_Response(
                [
                    'message' => $error_message,
                    'success' => false,
                ]
            );
        }

        return new \WP_REST_Response(
            [
                'success' => $is_valid,
                'message' => 'activate' === $action ? __('Activated', 'divitorque') : __('Deactivated', 'divitorque'),
                'license' => [
                    'status' => isset($response_body['data']['license_key']['status']) ? $response_body['data']['license_key']['status'] : '',
                    'key' => isset($response_body['data']['license_key']['key']) ? $response_body['data']['license_key']['key'] : '',
                ],
            ],

            $is_valid ? 200 : 400
        );
    }

    private static function save_data($data, $action)
    {
        if ('activate' === $action) {
            update_option('dtp_license_data', $data['data']);
            set_transient('dtp_license_data', $data['data'], 12 * HOUR_IN_SECONDS);

            $license_key = $data['data']['license_key']['key'];
            $license_status = $data['data']['license_key']['status'];
            $instance_id = $data['data']['instance']['id'];

            update_option('dtp_license_key', $license_key);
            update_option('dtp_license_status', $license_status);
            update_option('dtp_instance_id', $instance_id);
        } else if ('deactivate' === $action) {
            delete_option('dtp_license_data');
            delete_option('dtp_license_key');
            delete_option('dtp_license_status');
            delete_option('dtp_instance_id');

            delete_transient('dtp_license_data');
        }
    }

    public static function get_license_key()
    {
        return get_option('dtp_license_key');
    }

    public static function get_license_status()
    {
        return get_option('dtp_license_status');
    }

    public static function get_instance_id()
    {
        return get_option('dtp_instance_id');
    }
}
