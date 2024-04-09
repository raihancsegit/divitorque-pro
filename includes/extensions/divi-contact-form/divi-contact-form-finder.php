<?php

namespace DiviTorque;

use DiviTorque\Helpers;

class DiviContactFormFinder
{
    private static $instance;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DiviContactFormFinder;
        }
        return self::$instance;
    }

    public function extract_divi_forms()
    {
        $form_posts = Helpers::get_divi_forms();

        $data = array();

        if (empty($form_posts)) {
            return $data;
        }

        foreach ($form_posts as $form_post) {
            $forms = $this->find_forms_in_post($form_post['post_content']);

            if (empty($forms)) {
                continue;
            }

            foreach ($forms as $form) {
                $extracted_forms = $this->extract_form_shortcode($form[0]);

                if (empty($extracted_forms)) {
                    continue;
                }

                $data = array_merge($data, $this->process_extracted_forms($extracted_forms, $form_post));
            }
        }

        return $data;
    }

    private function find_forms_in_post($post_content)
    {
        $shortcode_regex = '/\[et_pb_contact_form(.*?)](.+?)\[\/et_pb_contact_form]/';
        preg_match_all($shortcode_regex, $post_content, $forms, PREG_SET_ORDER);
        return $forms;
    }

    private function extract_form_shortcode($content)
    {
        $form_shortcode = get_shortcode_regex(['et_pb_contact_form']);
        preg_match_all('/' . $form_shortcode . '/', $content, $extracted_forms, PREG_SET_ORDER);
        return $extracted_forms;
    }

    private function process_extracted_forms($extracted_forms, $form_post)
    {

        $data = array();

        foreach ($extracted_forms as $extracted_form) {

            $form_attributes = shortcode_parse_atts($extracted_form[3]);

            $unique_id       = isset($form_attributes['_unique_id']) ? $form_attributes['_unique_id'] : '';

            if (empty($unique_id)) {
                continue;
            }

            $combined_id   = sprintf('%d-%s', $form_post['ID'], $unique_id);
            $form_title    = isset($form_attributes['admin_label']) ? $form_attributes['admin_label'] : '';


            $data[]  = [
                'title' => $form_title,
                'page_title' => $form_post['post_title'],
                'unique_id' => $combined_id,
            ];
        }

        return $data;
    }
}
