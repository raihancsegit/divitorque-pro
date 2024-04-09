<?php

namespace DiviTorque;

use DiviTorque\DiviContactFormFinder;
use DiviTorque\Helpers;

class DiviContactForm
{
    private static $instance;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DiviContactForm;
        }
        return self::$instance;
    }

    public function __construct()
    {
        $forms = DiviContactFormFinder::get_instance()->extract_divi_forms();

        if (!empty($forms)) {
            foreach ($forms as $form) {
                $this->store_divi_forms($form);
            }
        }

        add_action('et_pb_contact_form_submit', array($this, 'store_divi_form_entries'), 10, 3);
    }

    public function store_divi_forms($data)
    {

        $unique_id = $data['unique_id'];
        $createdBy = get_current_user_id();
        $now = current_time('mysql');

        $insertData = [
            'title'      => $data['title'],
            'unique_id'  => $unique_id,
            'created_by' => $createdBy,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        global $wpdb;

        $table_name = $wpdb->prefix . 'torq_divi_forms';

        $id = $wpdb->get_var("SELECT id FROM $table_name WHERE unique_id = '$unique_id'");

        if ($id) {
            $wpdb->update($table_name, $insertData, ['id' => $id]);
            return;
        }

        $wpdb->insert($table_name, $insertData);
    }


    public function store_divi_form_entries($et_pb_contact_form_submit, $et_contact_error, $contact_form_info)
    {

        if ($et_contact_error) {
            return;
        }

        $unique_id = $contact_form_info['contact_form_unique_id'];
        $post_id = $contact_form_info['post_id'];
        $form_id   = "$post_id-$unique_id";

        $response = [];
        $fields = $et_pb_contact_form_submit;

        foreach ($fields as $key => $field) {
            $response[$key] = $field['value'];
        }

        $response = wp_json_encode($response);

        $browser = Helpers::get_browser();
        $device = Helpers::get_device();
        $ip = Helpers::get_ip();
        $city = Helpers::get_city();
        $country = Helpers::get_country();

        global $wpdb;
        $table_name = $wpdb->prefix . 'torq_divi_forms_entries';
        $wpdb->insert(
            $table_name,
            array(
                'form_id' => $form_id,
                'response' => $response,
                'browser' => $browser,
                'device' => $device,
                'ip' => $ip,
                'city' => $city,
                'country' => $country,
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql'),
                'post_id' => $post_id,
                'status' => 'unread',
            )
        );
    }
}
