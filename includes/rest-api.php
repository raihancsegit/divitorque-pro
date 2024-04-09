<?php

namespace DiviTorque;

use DiviTorque\AdminHelper;

class RestApi
{
    private static $instance;
    public $namespace = 'divitorque-pro/v1';

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes()
    {
        register_rest_route(
            $this->namespace,
            '/get_templates',
            array(
                'methods'  => \WP_REST_Server::READABLE,
                'callback' => array($this, 'get_templates'),
                'permission_callback' => array($this, 'edit_posts_permission'),
            )
        );

        register_rest_route(
            $this->namespace,
            '/get_common_settings',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback' => array($this, 'get_common_settings'),
                    'permission_callback' => array($this, 'get_permissions_check'),
                ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/save_common_settings',
            array(
                array(
                    'methods'             => \WP_REST_Server::EDITABLE,
                    'callback' => array($this, 'save_common_settings'),
                    'permission_callback' => array($this, 'get_permissions_check'),
                ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/get_form_data',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback' => array($this, 'get_form_data'),
                    'permission_callback' => array($this, 'get_permissions_check'),
                ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/get_form_entries',
            array(
                array(
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback' => array($this, 'get_form_entries'),
                    'permission_callback' => array($this, 'get_permissions_check'),
                ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/delete_form_entries',
            array(
                array(
                    'methods'             => \WP_REST_Server::DELETABLE,
                    'callback' => array($this, 'delete_form_entries'),
                    'permission_callback' => array($this, 'edit_posts_permission'),
                ),
            )
        );

        register_rest_route(
            $this->namespace,
            '/export_form_entries',
            array(
                'methods'             => \WP_REST_Server::EDITABLE,
                'callback' => array($this, 'export_form_entries'),
                'permission_callback' => array($this, 'get_permissions_check'),
            )
        );
    }

    public function edit_posts_permission()
    {
        return current_user_can('edit_posts');
    }

    public function get_permissions_check($request)
    {
        if (!current_user_can('manage_options')) {
            return new \WP_Error('rest_forbidden', esc_html__('You cannot view the templates resource.'), array('status' => $this->authorization_status_code()));
        }

        return true;
    }

    public function authorization_status_code()
    {
        $status = 401;

        if (is_user_logged_in()) {
            $status = 403;
        }

        return $status;
    }

    public function get_templates(\WP_REST_Request $request)
    {
        $type = $request->get_param('type');

        $url = 'https://library.divitorque.com/wp-json/templates/get_templates';

        if ($type) {
            $url .= '?type=' . urlencode($type);
        }

        $transient_name = 'divitorque_templates_' . md5($type);
        $templates = get_transient($transient_name, false);

        if (!$templates) {
            $response = wp_remote_get($url);

            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $templates = json_decode($body, true);

                if (is_array($templates)) {
                    set_transient($transient_name, $templates, DAY_IN_SECONDS);
                }
            } else {
                $templates = array();
            }
        }

        return $templates;
    }

    public function get_common_settings(\WP_REST_Request $request)
    {
        $options = AdminHelper::get_options();

        return $options;
    }

    public function save_common_settings(\WP_REST_Request $request)
    {
        $params = $request->get_params();

        $modules = $params['modules_settings'];

        update_option('_divitorque_modules', $modules);

        return array(
            'success' => true,
        );
    }

    public function get_form_data()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'torq_divi_forms';
        $entries_table_name = $wpdb->prefix . 'torq_divi_forms_entries';
        $results = $wpdb->get_results("SELECT * FROM $table_name");

        $form_data = array();
        $entries_count = 0;

        foreach ($results as $result) {
            $created_by = get_userdata($result->created_by);
            $form_data[] = array(
                'id' => $result->id,
                'title' => $result->title,
                'unique_id' => $result->unique_id,
                'created_by' => $created_by->display_name,
                'entries' => $entries_count
            );
        }

        return $form_data;
    }

    public function get_form_entries(\WP_REST_Request $request)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'torq_divi_forms_entries';
        $params = $request->get_params();
        $form_id = $params['form_id'];

        if (isset($form_id)) {
            $query = $wpdb->prepare("SELECT * FROM $table_name WHERE form_id = %s", $form_id);
            $results = $wpdb->get_results($query);
        } else {
            $results = $wpdb->get_results("SELECT * FROM $table_name");
        }

        $form_entries = array();

        foreach ($results as $result) {
            $form_entries[] = array(
                'id' => $result->id,
                'form_id' => $result->form_id,
                'response' => $result->response,
                'status' => $result->status,
                'created_at' => $result->created_at,
            );
        }

        return $form_entries;
    }

    public function delete_form_entries(\WP_REST_Request $request)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'torq_divi_forms_entries';
        $params = $request->get_params();
        $form_id = $params['form_id'];
        $entries = $params['entries'];

        if (isset($form_id) && !empty($entries)) {
            $placeholders = implode(', ', array_fill(0, count($entries), '%d'));
            $query = $wpdb->prepare(
                "DELETE FROM $table_name WHERE form_id = %s AND id IN ($placeholders)",
                array_merge([$form_id], $entries)
            );

            $result = $wpdb->query($query);

            if ($result !== false) {
                return ['success' => true, 'deleted' => $result];
            } else {
                return new \WP_Error('rest_delete_entries_failed', 'Failed to delete form entries', ['status' => 500]);
            }
        } else {
            return new \WP_Error('rest_missing_parameters', 'Missing form_id or entries parameters', ['status' => 400]);
        }
    }

    public function export_form_entries(\WP_REST_Request $request)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'torq_divi_forms_entries';
        $params = $request->get_params();
        $form_id = $params['form_id'];
        $entries = $params['entries'];

        // Remove the return statement from here

        if (isset($form_id) && !empty($entries)) {
            $placeholders = implode(', ', array_fill(0, count($entries), '%d'));
            $query = $wpdb->prepare(
                "SELECT * FROM $table_name WHERE form_id = %s AND id IN ($placeholders)",
                array_merge([$form_id], $entries)
            );

            $results = $wpdb->get_results($query);

            if ($results !== false) {
                $csv = fopen('php://memory', 'w');

                $headers = array(
                    'id',
                    'form_id',
                    'response',
                    'status',
                    'created_at',
                );

                fputcsv($csv, $headers);

                foreach ($results as $result) {
                    fputcsv($csv, array(
                        $result->id,
                        $result->form_id,
                        $result->response,
                        $result->status,
                        $result->created_at,
                    ));
                }

                rewind($csv);

                $csv_data = stream_get_contents($csv);

                fclose($csv);

                return array(
                    'success' => true,
                    'data' => $csv_data,
                );
            } else {
                return new \WP_Error('rest_export_entries_failed', 'Failed to export form entries', ['status' => 500]);
            }
        } else {
            return new \WP_Error('rest_missing_parameters', 'Missing form_id or entries parameters', ['status' => 400]);
        }
    }
}
