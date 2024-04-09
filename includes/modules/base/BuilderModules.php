<?php

abstract class TORQ_Builder_Module extends ET_Builder_Module
{
    protected $module_credits = array(
        'module_uri' => '',
        'author'     => 'Divi Torque',
        'author_uri' => 'https://divitorque.com/',
    );

    protected $folder_name = 'et_pb_divi_torque_pro';

    protected function _createButton($props, $multi_view, $classes)
    {

        $custom_icon_values = et_pb_responsive_options()->get_property_values($this->props, 'button_icon');

        return $this->render_button(
            [
                'button_id'           => $this->module_id(false),
                'button_classname'    => explode(' ', $classes),
                'button_rel'          => $props['button_rel'],
                'button_text'         => $props['button_text'],
                'button_text_escaped' => true,
                'button_url'          => $props['button_url'],
                'custom_icon'         => $custom_icon_values['desktop'] ?? '',
                'custom_icon_tablet'  => $custom_icon_values['tablet'] ?? '',
                'custom_icon_phone'   => $custom_icon_values['phone'] ?? '',
                'has_wrapper'         => false,
                'url_new_window'      => $props['url_new_window'],
                'multi_view_data'     => $multi_view->render_attrs(
                    [
                        'content'        => '{{button_text}}',
                        'hover_selector' => '%%order_class%% .torq-button',
                        'visibility'     => ['button_text' => '__not_empty'],
                    ]
                ),
            ]
        );
    }

    protected function _getResponsiveValues($optionName, $presetValues = null)
    {
        $presetValues = $presetValues ?? [];
        $responsiveEnabled = false;
        $mainData = $this->props[$optionName];
        $responsiveStatus = $this->props["{$optionName}_last_edited"] ?? null;

        if ($responsiveStatus) {
            $responsiveEnabled = et_pb_get_responsive_status($responsiveStatus);
        }

        // Handle preset conditional values
        if (empty($mainData) && isset($presetValues['conditional'])) {
            foreach ($presetValues['conditional']['values'] as $value) {
                $propValue = $this->props[$presetValues['conditional']['name']];
                if ($propValue === $value['a']) {
                    $mainData = $value['b'];
                    break;
                }
            }
        }

        // Handle preset default values
        $mainData = $mainData ?: ($presetValues['default'] ?? '');

        // If responsive is enabled, return an array of values for all devices.
        if ($responsiveEnabled) {
            return [
                'desktop' => $mainData,
                'tablet'  => $this->props["{$optionName}_tablet"] ?? '',
                'phone'   => $this->props["{$optionName}_phone"] ?? '',
            ];
        }

        // If not, return just the desktop value.
        return $mainData;
    }
}
