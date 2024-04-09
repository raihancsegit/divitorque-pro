<?php
class DTP_Builder_Module extends ET_Builder_Module
{

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Divi Torque',
		'author_uri' => 'https://divitorque.com/',
	);

	protected $folder_name = 'et_pb_divi_torque_pro';

	public $default_color = '#5b2cff';

	protected function custom_background_fields(
		$option_name,
		$option_label,
		$tab_slug,
		$toggle_slug,
		$background_tab,
		$show_if,
		$default
	) {
		$color           = array();
		$image           = array();
		$gradient        = array();
		$advanced_fields = array();
		$help_text       = esc_html__('Adjust the background style of this element by customizing the background color', 'divitorque');

		if (in_array('color', $background_tab, true)) {
			$color = $this->generate_background_options(
				"{$option_name}_bg",
				'color',
				$tab_slug,
				$toggle_slug,
				"{$option_name}_bg_color"
			);
		}

		if (in_array('gradient', $background_tab, true)) {
			$help_text = $help_text . ', ' . esc_html__('gradient', 'divitorque');
			$gradient  = $this->generate_background_options(
				"{$option_name}_bg",
				'gradient',
				$tab_slug,
				$toggle_slug,
				"{$option_name}_bg_color"
			);
		}

		if (in_array('image', $background_tab, true)) {
			$help_text = $help_text . ', ' . esc_html__('image', 'divitorque');
			$image     = $this->generate_background_options(
				"{$option_name}_bg",
				'image',
				$tab_slug,
				$toggle_slug,
				"{$option_name}_bg_color"
			);
		}

		$advanced_fields["{$option_name}_bg_color"] = array(
			'label'             => sprintf('%1$s %2$s', $option_label, esc_html__('Background', 'divitorque')),
			'description'       => $help_text . '.',
			'type'              => 'background-field',
			'base_name'         => "{$option_name}_bg",
			'context'           => "{$option_name}_bg_color",
			'option_category'   => 'layout',
			'custom_color'      => true,
			'default'           => $default,
			'tab_slug'          => $tab_slug,
			'toggle_slug'       => $toggle_slug,
			'show_if'           => $show_if,
			'background_fields' => array_merge($color, $gradient, $image),
		);

		if (in_array('hover', $background_tab, true)) {
			$advanced_fields["{$option_name}_bg_color"]['hover'] = 'tabs';
		}

		$skip = $this->generate_background_options(
			"{$option_name}_bg",
			'skip',
			$tab_slug,
			$toggle_slug,
			"{$option_name}_bg_color"
		);

		$advanced_fields = array_merge($advanced_fields, $skip);

		return $advanced_fields;
	}

	protected function get_custom_gradient($args)
	{
		$defaults = apply_filters(
			'et_pb_default_gradient',
			[
				'repeat'           => ET_Global_Settings::get_value('all_background_gradient_repeat'),
				'type'             => ET_Global_Settings::get_value('all_background_gradient_type'),
				'direction'        => ET_Global_Settings::get_value('all_background_gradient_direction'),
				'radial_direction' => ET_Global_Settings::get_value('all_background_gradient_direction_radial'),
				'stops'            => ET_Global_Settings::get_value('all_background_gradient_stops'),
				'unit'             => ET_Global_Settings::get_value('all_background_gradient_unit'),
			]
		);

		$args  = wp_parse_args(array_filter($args), $defaults);
		$stops = str_replace('|', ', ', $args['stops']);

		switch ($args['type']) {
			case 'conic':
				$type      = 'conic';
				$direction = "from {$args['direction']} at {$args['radial_direction']}";
				break;
			case 'elliptical':
				$type      = 'radial';
				$direction = "ellipse at {$args['radial_direction']}";
				break;
			case 'radial':
			case 'circular':
				$type      = 'radial';
				$direction = "circle at {$args['radial_direction']}";
				break;
			case 'linear':
			default:
				$type      = 'linear';
				$direction = $args['direction'];
		}

		if ('on' === $args['repeat']) {
			$type = 'repeating-' . $type;
		}

		return esc_html(
			"{$type}-gradient( {$direction}, {$stops} )"
		);
	}

	protected function process_custom_background_fields($option_name, $hover_suffix)
	{
		// Background Options Styling.
		$background_base_name                     = "{$option_name}_bg";
		$background_prefix                        = "{$background_base_name}_";
		$background_style                         = '';
		$background_image_style                   = '';
		$background_images                        = array();
		$has_background_color_gradient            = false;
		$background_color_gradient_overlays_image = 'off';

		// A. Background Gradient.
		$use_background_color_gradient = isset($this->props["{$background_prefix}use_color_gradient{$hover_suffix}"]) ? $this->props["{$background_prefix}use_color_gradient{$hover_suffix}"] : '';

		if ('on' === $use_background_color_gradient) {
			$background_color_gradient_overlays_image = isset($this->props["{$background_prefix}color_gradient_overlays_image{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_overlays_image{$hover_suffix}"] : 'off';
			$type = isset($this->props["{$background_prefix}color_gradient_type{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_type{$hover_suffix}"] : '';
			$direction = isset($this->props["{$background_prefix}color_gradient_direction{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_direction{$hover_suffix}"] : '';
			$radial_direction = isset($this->props["{$background_prefix}color_gradient_direction_radial{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_direction_radial{$hover_suffix}"] : '';
			$color_gradient_stops = isset($this->props["{$background_prefix}color_gradient_stops{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_stops{$hover_suffix}"] : $this->props["{$background_prefix}color_gradient_stops"];
			$repeat = isset($this->props["{$background_prefix}color_gradient_repeat{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_repeat{$hover_suffix}"] : $this->props["{$background_prefix}color_gradient_repeat"];
			$unit = isset($this->props["{$background_prefix}color_gradient_unit{$hover_suffix}"]) ? $this->props["{$background_prefix}color_gradient_unit{$hover_suffix}"] : $this->props["{$background_prefix}color_gradient_unit"];

			$gradient_properties = array(
				'type'             => $type,
				'direction'        => $direction,
				'radial_direction' => $radial_direction,
				'stops'            => $color_gradient_stops,
				'repeat'           => $repeat,
				'unit'             => $unit,
			);

			// Save background gradient into background images list.
			$background_gradient = $this->get_custom_gradient($gradient_properties);
			$background_images[] = $background_gradient;

			// Flag to inform BG Color if current module has Gradient.
			$has_background_color_gradient = true;
		}

		// Background Image.
		$bg_image           = isset($this->props["{$option_name}_bg_image{$hover_suffix}"]) ? $this->props["{$option_name}_bg_image{$hover_suffix}"] : '';
		$parallax           = isset($this->props["{$option_name}_bg_parallax{$hover_suffix}"]) ? $this->props["{$option_name}_bg_parallax{$hover_suffix}"] : '';
		$is_bg_image_active = '' !== $bg_image && 'on' !== $parallax;

		if ($is_bg_image_active) {
			$has_bg_image = true;

			$bg_size = isset($this->props["{$option_name}_bg_size{$hover_suffix}"]) ? $this->props["{$option_name}_bg_size{$hover_suffix}"] : '';
			if ('' !== $bg_size) {
				$background_style .= sprintf(
					'background-size: %1$s !important; ',
					esc_html($bg_size)
				);
			}

			$bg_position = isset($this->props["{$option_name}_bg_position{$hover_suffix}"]) ? $this->props["{$option_name}_bg_position{$hover_suffix}"] : '';
			if ('' !== $bg_position) {
				$background_style .= sprintf(
					'background-position: %1$s !important; ',
					esc_html(str_replace('_', ' ', $bg_position))
				);
			}

			$bg_repeat = isset($this->props["{$option_name}_bg_repeat{$hover_suffix}"]) ? $this->props["{$option_name}_bg_repeat{$hover_suffix}"] : '';
			if ('' !== $bg_repeat) {
				$background_style .= sprintf(
					'background-repeat: %1$s !important; ',
					esc_html($bg_repeat)
				);
			}

			$bg_blend = isset($this->props["{$option_name}_bg_blend{$hover_suffix}"]) ? $this->props["{$option_name}_bg_blend{$hover_suffix}"] : '';
			if ('' !== $bg_blend) {
				$background_style .= sprintf(
					'background-blend-mode: %1$s !important;',
					esc_html($bg_blend)
				);
			}

			$background_images[] = sprintf('url(%1$s)', esc_html($bg_image));
		} else {
			$has_bg_image = false;
		}

		if (!empty($background_images)) {
			// The browsers stack the images in the opposite order to what you'd expect.
			if ('on' !== $background_color_gradient_overlays_image) {
				$background_images = array_reverse($background_images);
			}

			// Set background image styles only it's different compared to the larger device.
			$background_image_style = join(', ', $background_images);

			$background_style .= sprintf(
				'background-image: %1$s !important;',
				esc_html($background_image_style)
			);
		}

		// B. Background Color.
		if (!$has_background_color_gradient || !$has_bg_image) {
			$background_color = isset($this->props["{$background_prefix}color{$hover_suffix}"]) ? $this->props["{$background_prefix}color{$hover_suffix}"] : '';
			if ('' !== $background_color) {
				$background_style .= sprintf(
					'background-color: %1$s%2$s; ',
					esc_html($background_color),
					esc_html(' !important')
				);
			}
		}

		return $background_style;
	}

	public static function process_flex_style($val, $type, $important)
	{
		$flex_val = 'center';
		if ('left' === $val) {
			$flex_val = 'flex-start';
		} elseif ('right' === $val) {
			$flex_val = 'flex-end';
		}

		return sprintf(
			'%1$s:%2$s%3$s;',
			$type,
			$flex_val,
			$important ? '!important;' : ''
		);
	}

	public static function process_margin_padding(
		$val,
		$type,
		$imp
	) {
		$_top     = '';
		$_right   = '';
		$_bottom  = '';
		$_left    = '';
		$imp_text = '';
		$_val     = explode('|', $val);

		if ($imp) {
			$imp_text = '!important';
		}

		if (isset($_val[0]) && !empty($_val[0])) {
			$_top = "{$type}-top:" . $_val[0] . $imp_text . ';';
		}

		if (isset($_val[1]) && !empty($_val[1])) {
			$_right = "{$type}-right:" . $_val[1] . $imp_text . ';';
		}

		if (isset($_val[2]) && !empty($_val[2])) {
			$_bottom = "{$type}-bottom:" . $_val[2] . $imp_text . ';';
		}

		if (isset($_val[3]) && !empty($_val[3])) {
			$_left = "{$type}-left:" . $_val[3] . $imp_text . ';';
		}

		return esc_html("{$_top} {$_right} {$_bottom} {$_left}");
	}

	public function get_conditional_responsive_styles($styles, $data, $style)
	{
		$important = isset($styles['important']) ? $styles['important'] : false;

		if ('padding' === $style || 'margin' === $style) {
			return $this->process_margin_padding($data, $style, $important);
		} elseif ('align-self' === $style || 'align-items' === $style || 'justify-content' === $style) {
			return $this->process_flex_style($data, $style, $important);
		} elseif ('flex' === $style) {
			return 'flex: 0 0 ' . $data . ';';
		} else {
			return sprintf(
				'
                %1$s:%2$s%3$s;',
				$style,
				$data,
				$important ? '!important;' : ''
			);
		}
	}

	protected function get_responsive_styles(
		$opt_name,
		$selector,
		$styles = null,
		$pre_values = null,
		$render_slug = null
	) {
		$styles     = !empty($styles) ? $styles : array();
		$pre_values = !empty($pre_values) ? $pre_values : array();
		$is_enabled = false;
		$style      = isset($styles['primary']) ? $styles['primary'] : '';
		$_data      = $this->props[$opt_name];

		if (isset($this->props["{$opt_name}_last_edited"])) {
			$is_enabled = et_pb_get_responsive_status($this->props["{$opt_name}_last_edited"]);
		}

		if (empty($_data) && !empty($pre_values)) {
			$is_default = true;
			if (!empty($pre_values['conditional'])) {
				foreach ($pre_values['conditional']['values'] as $value) {
					$property_val = $this->props[$pre_values['conditional']['name']];
					if ($property_val === $value['a']) {
						$_data      = $value['b'];
						$is_default = false;
					}
				}
			}

			if ($is_default) {
				$_data = isset($pre_values['default']) ? $pre_values['default'] : '';
			}
		}

		if (!empty($_data)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => $this->get_conditional_responsive_styles($styles, $_data, $style),
				)
			);

			if (!empty($styles['secondary'])) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => isset($styles['secondary']) ? isset($styles['secondary']) : '',
					)
				);
			}
		}

		if ($is_enabled) {
			$_data_tablet = $this->props["{$opt_name}_tablet"];
			$_data_phone  = $this->props["{$opt_name}_phone"];

			if (!empty($_data_tablet)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
						'declaration' => $this->get_conditional_responsive_styles($styles, $_data_tablet, $style),
					)
				);

				if (!empty($styles['secondary'])) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => $selector,
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => $styles['secondary'],
						)
					);
				}
			}

			if (!empty($_data_phone)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
						'declaration' => $this->get_conditional_responsive_styles($styles, $_data_phone, $style),
					)
				);

				if (!empty($styles['secondary'])) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => $selector,
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => $styles['secondary'],
						)
					);
				}
			}
		}
	}

	protected function get_absolute_element_options($prefix, $label, $slug, $defaults, $show_if)
	{
		$fields = array(
			"{$prefix}_position"    => array(
				'label'       => $label . esc_html__(' Position', 'divitorque'),
				'description' => esc_html__('Select ', 'divitorque') . $label . esc_html__(' placement.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'default'     => $defaults['position'],
				'options'     => array(
					'left_top'     => esc_html__('Left Top', 'divitorque'),
					'left_bottom'  => esc_html__('Left Bottom', 'divitorque'),
					'right_top'    => esc_html__('Right Top', 'divitorque'),
					'right_bottom' => esc_html__('Right Bottom', 'divitorque'),
				),
				'show_if'     => $show_if,
			),

			"{$prefix}_is_center_x" => array(
				'label'           => esc_html__('Use Horizontal Position Center', 'divitorque'),
				'description'     => esc_html__('If enabled ', 'divitorque') . $label . esc_html__(' will be in horizontally center position.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => $slug,
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),

			"{$prefix}_offset_x"    => array(
				'label'          => esc_html__('Horizontal Offset', 'divitorque'),
				'description'    => $label . esc_html__(' Horizontal offset value.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => $defaults['offset_x'],
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'toggle_slug'    => $slug,
				'tab_slug'       => 'advanced',
				'show_if'        => array_merge(array("{$prefix}_is_center_x" => 'off'), $show_if),
			),

			"{$prefix}_is_center_y" => array(
				'label'           => esc_html__('Use Vertical Position Center', 'divitorque'),
				'description'     => esc_html__('If enabled ', 'divitorque') . $label . esc_html__(' will be in vertically center position.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'toggle_slug'     => $slug,
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
			),

			"{$prefix}_offset_y"    => array(
				'label'          => esc_html__('Vertical Offset', 'divitorque'),
				'description'    => $label . esc_html__(' vertical offset value.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => $defaults['offset_y'],
				'range_settings' => array(
					'min'  => -600,
					'max'  => 600,
					'step' => 1,
				),
				'toggle_slug'    => $slug,
				'tab_slug'       => 'advanced',
				'show_if'        => array_merge(array("{$prefix}_is_center_y" => 'off'), $show_if),
			),
		);

		return $fields;
	}

	protected function get_badge_options($prefix, $label, $slug, $defaults)
	{
		$fields = array(
			"{$prefix}_padding" => array(
				'label'          => $label . esc_html__(' Padding', 'divitorque'),
				'description'    => esc_html__('Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => $slug,
				'default'        => $defaults['padding'],
			),
		);

		$badge_opts = $this->get_absolute_element_options('badge', $label, 'badge', $defaults, array());
		$badge_bg   = $this->custom_background_fields('badge', $label, 'advanced', 'badge', array('color', 'gradient', 'hover'), array(), $defaults['bg']);
		return array_merge($badge_opts, $fields, $badge_bg);
	}

	protected function get_absolute_element_styles($render_slug, $prefix, $selector)
	{
		$position    = $this->props["{$prefix}_position"];
		$_position   = explode('_', $position);
		$offset_x    = "{$prefix}_offset_x";
		$offset_y    = "{$prefix}_offset_y";
		$is_center_y = $this->props["{$prefix}_is_center_y"];
		$is_center_x = $this->props["{$prefix}_is_center_x"];
		$val_x       = 0;
		$val_y       = 0;

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => 'position: absolute; z-index: 999;',
			)
		);

		if ('on' === $is_center_x) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => "{$_position[0]}: 50%;",
				)
			);
		} else {
			$this->get_responsive_styles(
				$offset_x,
				$selector,
				array('primary' => $_position[0]),
				array(),
				$render_slug
			);
		}

		if ('on' === $is_center_y) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => "{$_position[1]}: 50%;",
				)
			);
		} else {
			$this->get_responsive_styles(
				$offset_y,
				$selector,
				array('primary' => $_position[1]),
				array(),
				$render_slug
			);
		}

		if ('right_top' === $position) {
			if ('on' === $is_center_y) {
				$val_y = '-50%';
			}

			if ('on' === $is_center_x) {
				$val_x = '50%';
			}
		} elseif ('right_bottom' === $position) {
			if ('on' === $is_center_y) {
				$val_y = '50%';
			}

			if ('on' === $is_center_x) {
				$val_x = '50%';
			}
		} elseif ('left_bottom' === $position) {
			if ('on' === $is_center_y) {
				$val_y = '50%';
			}

			if ('on' === $is_center_x) {
				$val_x = '-50%';
			}
		} elseif ('left_top' === $position) {
			if ('on' === $is_center_y) {
				$val_y = '-50%';
			}

			if ('on' === $is_center_x) {
				$val_x = '-50%';
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => "
                transform : translateX({$val_x}) translateY({$val_y});
            ",
			)
		);
	}

	protected function get_badge_styles($render_slug, $prefix, $selector, $hover_selector)
	{
		$this->get_absolute_element_styles($render_slug, $prefix, $selector);
		$this->get_custom_bg_style($render_slug, 'badge', $selector, $hover_selector);

		$this->get_responsive_styles(
			$prefix . '_padding',
			$selector,
			array('primary' => 'padding'),
			array(),
			$render_slug
		);
	}

	protected function get_custom_bg_style($render_slug, $opt_slug, $selector, $hover_selector)
	{
		$_bg = $this->process_custom_background_fields($opt_slug, '');

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => $_bg,
			)
		);

		$_bg_hover = $this->process_custom_background_fields($opt_slug, '__hover');

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $hover_selector,
				'declaration' => $_bg_hover,
			)
		);
	}

	protected function get_overlay_option_fields($opt_slug, $hover_status, $show_if)
	{
		$show_if = !empty($show_if) ? $show_if : array();
		$fields  = array(
			'overlay_on_hover'     => array(
				'label'           => esc_html__('Show Overlay on Hover', 'divitorque'),
				'description'     => esc_html__('Enable overlay during hover.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'tab_slug'        => 'advanced',
				'default'         => $hover_status,
				'toggle_slug'     => $opt_slug,
				'show_if'         => $show_if,
			),
			'overlay_hover_speed'  => array(
				'label'          => esc_html__('Overlay Hover Speed', 'divitorque'),
				'description'    => esc_html__('Set how long it will take for the overlay to be visible', 'divitorque'),
				'type'           => 'range',
				'fixed_unit'     => 'ms',
				'default'        => '300ms',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 5000,
					'step' => 50,
				),
				'toggle_slug'    => $opt_slug,
				'tab_slug'       => 'advanced',
				'show_if'        => array_merge(array('overlay_on_hover' => 'on'), $show_if),
			),
			'overlay_icon'         => array(
				'label'           => esc_html__('Overlay Icon', 'divitorque'),
				'description'     => esc_html__('Select icon for the overlay', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => $opt_slug,
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
			),
			'overlay_icon_color'   => array(
				'label'       => esc_html__('Overlay Icon Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your overlay icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => $opt_slug,
				'show_if'     => $show_if,
				'hover'       => 'tabs',
			),
			'overlay_icon_size'    => array(
				'label'          => esc_html__('Overlay Icon Size', 'divitorque'),
				'description'    => esc_html__('Here you can define a icon size for your overlay icon.', 'divitorque'),
				'type'           => 'range',
				'default'        => '32px',
				'hover'          => 'tabs',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => $opt_slug,
				'tab_slug'       => 'advanced',
				'show_if'        => $show_if,
			),
			'overlay_icon_opacity' => array(
				'label'          => esc_html__('Overlay Icon Opacity', 'divitorque'),
				'description'    => esc_html__('Select the opacity of the overlay icon. Set the value from 0 - 1. The lower value, the more transparent.', 'divitorque'),
				'type'           => 'range',
				'default'        => '1',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => .02,
				),
				'toggle_slug'    => $opt_slug,
				'tab_slug'       => 'advanced',
				'show_if'        => $show_if,
				'hover'          => 'tabs',
			),
		);

		$overlay = $this->custom_background_fields(
			'overlay',
			esc_html__('Overlay', 'divitorque'),
			'advanced',
			$opt_slug,
			array('color', 'gradient'),
			$show_if,
			''
		);

		return array_merge($overlay, $fields);
	}

	protected function get_overlay_style(
		$render_slug,
		$photo_opt_name,
		$hover_element = null
	) {
		if (empty($hover_element)) {
			$hover_element = '%%order_class%%';
		}

		$overlay_icon_color         = $this->props['overlay_icon_color'];
		$overlay_on_hover           = $this->props['overlay_on_hover'];
		$overlay_hover_speed        = $this->props['overlay_hover_speed'];
		$overlay_icon_color_hover   = $this->get_hover_value('overlay_icon_color');
		$overlay_icon_size          = $this->props['overlay_icon_size'];
		$overlay_icon_size_hover    = $this->get_hover_value('overlay_icon_size');
		$overlay_icon_opacity       = $this->props['overlay_icon_opacity'];
		$overlay_icon_opacity_hover = $this->get_hover_value('overlay_icon_opacity');

		if (!empty($photo_opt_name)) {
			$raddi = isset($this->props["border_radii_{$photo_opt_name}"]) ? $this->props["border_radii_{$photo_opt_name}"] : '';
			if (!empty($raddi)) {
				$raddi   = explode('|', $raddi);
				$raddi_1 = $raddi[1] !== '' ? $raddi[1] : '0';
				$raddi_2 = $raddi[2] !== '' ? $raddi[2] : '0';
				$raddi_3 = $raddi[3] !== '' ? $raddi[3] : '0';
				$raddi_4 = $raddi[4] !== '' ? $raddi[4] : '0';

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-overlay',
						'declaration' => sprintf(
							'
                        border-radius: %1$s %2$s %3$s %4$s;',
							$raddi_1,
							$raddi_2,
							$raddi_3,
							$raddi_4
						),
					)
				);
			}
		}

		if ('on' === $overlay_on_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-overlay',
					'declaration' => 'opacity:0;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .dtp-overlay',
					'declaration' => 'opacity:1;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-overlay',
				'declaration' => sprintf(
					'color: %1$s;
					transition: all %2$s;',
					$overlay_icon_color,
					$overlay_hover_speed
				),
			)
		);

		if (!empty($overlay_icon_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .dtp-overlay',
					'declaration' => sprintf('color: %1$s;', $overlay_icon_color_hover),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-overlay .dtp-overlay-icon',
				'declaration' => "font-size:{$overlay_icon_size};",
			)
		);

		if (!empty($overlay_icon_size_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .dtp-overlay .dtp-overlay-icon',
					'declaration' => "font-size:{$overlay_icon_size_hover};",
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-overlay .dtp-overlay-icon',
				'declaration' => "opacity:{$overlay_icon_opacity};",
			)
		);

		if (!empty($overlay_icon_opacity_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $hover_element . ':hover .dtp-overlay .dtp-overlay-icon',
					'declaration' => "opacity:{$overlay_icon_opacity_hover};",
				)
			);
		}

		// Overlay background.
		$this->get_custom_bg_style($render_slug, 'overlay', '%%order_class%% .dtp-overlay', '');
	}

	protected function get_carousel_option_fields($supports = null, $default = null, $show_if = null)
	{
		$aditional   = array();
		$slide_count = isset($default['slide_count']) ? $default['slide_count'] : '3';
		$supports    = !empty($supports) ? $supports : array();
		$default     = !empty($default) ? $default : array();
		$show_if     = !empty($show_if) ? $show_if : array();

		$fields = array(

			// Carousel Settings.
			'animation_speed'         => array(
				'label'           => esc_html__('Animation Speed', 'divitorque'),
				'description'     => esc_html__('Here you can define sliding Speed.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '700ms',
				'fixed_unit'      => 'ms',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'range_settings'  => array(
					'step' => 100,
					'min'  => 0,
					'max'  => 10000,
				),
				'show_if'         => $show_if,
			),

			'is_autoplay'             => array(
				'label'       => esc_html__('Autoplay', 'divitorque'),
				'description' => esc_html__('Here you can choose whether autoplay should be used.', 'divitorque'),
				'type'        => 'yes_no_button',
				'default'     => 'on',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'general',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'     => $show_if,
			),

			'autoplay_speed'          => array(
				'label'          => esc_html__('Autoplay Speed', 'divitorque'),
				'description'    => esc_html__('Here you can define sliding autoplay speed for the carousel.', 'divitorque'),
				'type'           => 'range',
				'default'        => '2000ms',
				'fixed_unit'     => 'ms',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'range_settings' => array(
					'step' => 100,
					'min'  => 0,
					'max'  => 10000,
				),
				'show_if'        => array_merge($show_if, array('is_autoplay' => 'on')),
			),

			'use_nav'                 => array(
				'label'           => esc_html__('Use Navigation', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether navigation should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'mobile_options'  => true,
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'use_pagi'                => array(
				'label'           => esc_html__('Use Pagination', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether pagination should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'mobile_options'  => true,
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'is_variable_width'       => array(
				'label'           => esc_html__('Use Fixed Width Slide', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether fixed width slider item should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'slide_width'             => array(
				'label'          => esc_html__('Slide Width', 'divitorque'),
				'description'    => esc_html__('Define fixed width for the slides.', 'divitorque'),
				'type'           => 'range',
				'default'        => '360px',
				'fixed_unit'     => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'show_if'        => array_merge($show_if, array('is_variable_width' => 'on')),
			),

			'slide_count'             => array(
				'label'          => esc_html__('Slides To Show', 'divitorque'),
				'description'    => esc_html__('Define how many items you want to display in the carousel.', 'divitorque'),
				'type'           => 'select',
				'default'        => $slide_count,
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'mobile_options' => true,
				'options'        => array(
					'1' => esc_html__('1', 'divitorque'),
					'2' => esc_html__('2', 'divitorque'),
					'3' => esc_html__('3', 'divitorque'),
					'4' => esc_html__('4', 'divitorque'),
					'5' => esc_html__('5', 'divitorque'),
					'6' => esc_html__('6', 'divitorque'),
					'7' => esc_html__('7', 'divitorque'),
					'8' => esc_html__('8', 'divitorque'),
				),
				'show_if'        => array_merge($show_if, array('is_variable_width' => 'off')),
			),

			'slide_spacing'           => array(
				'label'          => esc_html__('Slide Spacing', 'divitorque'),
				'description'    => esc_html__('Here you can define spaces between carousel items.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'general',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'show_if'        => $show_if,
			),

			'use_both_side_spacing'   => array(
				'label'           => esc_html__('Apply Spacing on First & Last Item', 'divitorque'),
				'description'     => esc_html__('If enable slide spacing will be applied to the first and last item.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => array_merge($show_if, array('is_vertical' => 'off')),
			),

			'is_infinite'             => array(
				'label'           => esc_html__('Infinite looping', 'divitorque'),
				'description'     => esc_html__('Choose whether the endless of times sliding should be played or not.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'css_transition'          => array(
				'label'       => esc_html__('Sliding CSS Transition', 'divitorque'),
				'description' => esc_html__('Define sliding CSS transition during the carousel animation.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'ease-in-out',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'advanced',
				'options'     => array(
					'linear'      => esc_html__('linear', 'divitorque'),
					'ease-in'     => esc_html__('ease-in', 'divitorque'),
					'ease-in-out' => esc_html__('ease-in-out', 'divitorque'),
				),
				'show_if'     => $show_if,
			),

			'is_swipe'                => array(
				'label'           => esc_html__('Swipe', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether carousel swipe should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'mobile_options'  => true,
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'slide_to_scroll'         => array(
				'label'           => esc_html__('Items to Scroll', 'divitorque'),
				'description'     => esc_html__('Define how many slides to move at once.', 'divitorque'),
				'type'            => 'range',
				'default'         => '1',
				'option_category' => 'basic_option',
				'unitless'        => true,
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 20,
				),
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'show_if'         => $show_if,
			),

			'is_vertical'             => array(
				'label'           => esc_html__('Vertical Mode', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether carousel vertical mode should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'is_center'               => array(
				'label'           => esc_html__('Center Mode', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether center mode should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			'center_mode_type'        => array(
				'label'       => esc_html__('Center Mode Type', 'divitorque'),
				'description' => esc_html__('Define center mode type from the list.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'classic',
				'toggle_slug' => 'carousel_settings',
				'sub_toggle'  => 'advanced',
				'options'     => array(
					'classic'     => esc_html__('Classic', 'divitorque'),
					'highlighted' => esc_html__('Highlighted', 'divitorque'),
				),

				'show_if'     => array_merge($show_if, array('is_center' => 'on')),
			),

			'center_padding'          => array(
				'label'          => esc_html__('Center Padding', 'divitorque'),
				'description'    => esc_html__('Define side padding when in center mode.', 'divitorque'),
				'type'           => 'range',
				'default'        => '70px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'mobile_options' => true,
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'advanced',
				'show_if'        => array_merge(
					$show_if,
					array(
						'is_center'         => 'on',
						'center_mode_type'  => 'classic',
						'is_variable_width' => 'off',
					)
				),
			),

			'wait_for_animate'        => array(
				'label'           => esc_html__('Wait For Animate', 'divitorque'),
				'description'     => esc_html__(
					'Ignores requests to advance the slide while animating
				.',
					'divitorque'
				),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			),

			// Carousel style.
			'carousel_spacing_top'    => array(
				'label'          => esc_html__('Wrapper Spacing Top', 'divitorque'),
				'description'    => esc_html__('Define spacing at the top of the carousel.', 'divitorque'),
				'type'           => 'range',
				'default'        => '0px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'advanced',
				'mobile_options' => true,
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'        => $show_if,
			),

			'carousel_spacing_bottom' => array(
				'label'          => esc_html__('Wrapper Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Define spacing at the bottom of the carousel.', 'divitorque'),
				'type'           => 'range',
				'default'        => '0px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'carousel_settings',
				'sub_toggle'     => 'advanced',
				'mobile_options' => true,
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'        => $show_if,
			),

			// Navigation.
			'nav_icon_prev'               => array(
				'label'           => esc_html__('Prev Icon', 'divitorque'),
				'description'     => esc_html__('Define custom icon for the prev navigation button.', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
				'default'         => '&#x34;||divi||400',
			),

			'nav_icon_next'              => array(
				'label'           => esc_html__('Next Icon', 'divitorque'),
				'description'     => esc_html__('Define custom icon for the next navigation button.', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'show_if'         => $show_if,
				'default'         => '&#x35;||divi||400',
			),

			'nav_size'              => array(
				'label'           => esc_html__('Size', 'divitorque'),
				'description'     => esc_html__('Here you can define custom size for the arrows.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '40px',
				'fixed_unit'      => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
				'show_if'         => $show_if,
			),

			'nav_color'               => array(
				'label'       => esc_html__('Icon Color', 'divitorque'),
				'description' => esc_html__('Pick a color for the navigation icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'nav',
				'default'     => '#333333',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'nav_bg'                  => array(
				'label'       => esc_html__('Background', 'divitorque'),
				'description' => esc_html__('Pick a color to use for navigation background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'nav',
				'default'     => '#ddd',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'nav_pos_y'               => array(
				'label'           => esc_html__('Vertical Position', 'divitorque'),
				'description'     => esc_html__('Define a value for the navigation vertical placement.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '50%',
				'mobile_options'  => true,
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => -150,
					'max'  => 500,
					'step' => 1,
				),
				'show_if'         => $show_if,
			),

			'nav_pos_x'               => array(
				'label'           => esc_html__('Horizontal Position', 'divitorque'),
				'description'     => esc_html__('Define a value for the navigation horizontal placement.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'default'         => '-15px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => -300,
					'max'  => 300,
					'step' => 1,
				),
				'show_if'         => $show_if,
			),

			'nav_border_width'        => array(
				'label'           => esc_html__('Border Width', 'divitorque'),
				'description'     => esc_html__('Define border width for the navigation.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '0px',
				'default_unit'    => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'show_if'         => $show_if,
			),

			'nav_border_color'        => array(
				'label'       => esc_html__('Border Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for navigation border.', 'divitorque'),
				'type'        => 'color-alpha',
				'default'     => '#333',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'nav_border_style'        => array(
				'label'       => esc_html__('Border Type', 'divitorque'),
				'description' => esc_html__('Borders support various different styles, each of which will change the shape of the border element.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'solid',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'options'     => array(
					'solid'  => esc_html__('Solid', 'divitorque'),
					'dashed' => esc_html__('Dashed', 'divitorque'),
					'dotted' => esc_html__('Dotted', 'divitorque'),
					'double' => esc_html__('Double', 'divitorque'),
					'groove' => esc_html__('Groove', 'divitorque'),
					'ridge'  => esc_html__('Ridge', 'divitorque'),
					'inset'  => esc_html__('Inset', 'divitorque'),
					'outset' => esc_html__('Outset', 'divitorque'),
					'none'   => esc_html__('None', 'divitorque'),
				),
				'show_if'     => $show_if,
			),

			'nav_border_radius'      => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the prev nav. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'default'     => 'on|40px|40px|40px|40px',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'show_if'     => $show_if,
			),

			// pagination
			'pagi_type'               => array(
				'label'       => esc_html__('Type', 'divitorque'),
				'description' => esc_html__('Define pagination type from the list.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'dot',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'tab_slug'    => 'advanced',
				'options'     => array(
					'dot'    => esc_html__('Dot', 'divitorque'),
					'number' => esc_html__('Number', 'divitorque'),
				),
				'show_if'     => $show_if,
			),

			'pagi_alignment'          => array(
				'label'            => esc_html__('Alignment', 'divitorque'),
				'description'      => esc_html__('Align pagination to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'module_align',
				'default_on_front' => 'center',
				'default'          => 'center',
				'toggle_slug'      => 'pagi',
				'sub_toggle'       => 'pagi_common',
				'tab_slug'         => 'advanced',
				'show_if'          => $show_if,
			),

			'pagi_color'              => array(
				'label'       => esc_html__('Text Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the pagination text.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'default'     => '#333333',
				'hover'       => 'tabs',
				'show_if'     => array_merge($show_if, array('pagi_type' => 'number')),
			),

			'pagi_text'               => array(
				'label'           => esc_html__('Text Size', 'divitorque'),
				'description'     => esc_html__('Define a size to use for the pagination text.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '18px',
				'toggle_slug'     => 'pagi',
				'sub_toggle'      => 'pagi_common',
				'tab_slug'        => 'advanced',
				'show_if'         => array_merge($show_if, array('pagi_type' => 'number')),
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
			),

			'pagi_bg'                 => array(
				'label'       => esc_html__('Background', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the pagination background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'default'     => '#dddddd',
				'hover'       => 'tabs',
				'show_if'     => $show_if,
			),

			'pagi_height'             => array(
				'label'           => esc_html__('Height', 'divitorque'),
				'description'     => esc_html__('Define a height for the pagination dots.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'toggle_slug'     => 'pagi',
				'sub_toggle'      => 'pagi_common',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
				'show_if'         => $show_if,
			),

			'pagi_width'              => array(
				'label'           => esc_html__('Width', 'divitorque'),
				'description'     => esc_html__('Define a width for the pagination dots.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'toggle_slug'     => 'pagi',
				'sub_toggle'      => 'pagi_common',
				'tab_slug'        => 'advanced',
				'range_settings'  => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 50,
				),
				'show_if'         => $show_if,
			),

			'pagi_radius'             => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the dots. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'default'     => 'on|10px|10px|10px|10px',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_common',
				'tab_slug'    => 'advanced',
				'show_if'     => $show_if,
			),

			'pagi_pos_y'              => array(
				'label'          => esc_html__('Vertical Position', 'divitorque'),
				'description'    => esc_html__('Define a value for the pagination vertical placement.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'toggle_slug'    => 'pagi',
				'sub_toggle'     => 'pagi_common',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'min'  => -400,
					'max'  => 400,
					'step' => 1,
				),
				'show_if'        => $show_if,
			),

			'pagi_spacing'            => array(
				'label'          => esc_html__('Spacing', 'divitorque'),
				'description'    => esc_html__('Define spacing between pagination dots.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'pagi',
				'sub_toggle'     => 'pagi_common',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'show_if'        => $show_if,
			),

			'pagi_bg_active'          => array(
				'label'       => esc_html__('Background', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the active pagination dot.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_active',
				'show_if'     => $show_if,
			),

			'pagi_text_active'        => array(
				'label'       => esc_html__('Text Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the active pagination text.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'pagi',
				'sub_toggle'  => 'pagi_active',
				'show_if'     => $show_if,
			),

			'pagi_width_active'       => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Define a width for the active pagination dot.', 'divitorque'),
				'type'           => 'range',
				'fixed_unit'     => 'px',
				'toggle_slug'    => 'pagi',
				'sub_toggle'     => 'pagi_active',
				'tab_slug'       => 'advanced',
				'range_settings' => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
				'show_if'        => $show_if,
			),
		);

		if (in_array('lightbox', $supports, true)) {
			$aditional['use_lightbox'] = array(
				'label'           => esc_html__('Open Image in Lightbox', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether image should be opened with lightbox.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'advanced',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'         => $show_if,
			);
		}

		if (in_array('equal_height', $supports, true)) {
			$aditional['is_equal_height'] = array(
				'label'           => esc_html__('Equalize Item Height', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'description'     => esc_html__('Enable this to Equalize all Carousel items with same height.', 'divitorque'),
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'carousel_settings',
				'sub_toggle'      => 'general',
				'show_if'         => $show_if,
			);
		}

		return array_merge($fields, $aditional);
	}

	protected function render_default_nav_css($render_slug)
	{
		$nav_pos_y                   = $this->props['nav_pos_y'];
		$nav_pos_y_tablet            = $this->props['nav_pos_y_tablet'];
		$nav_pos_y_phone             = $this->props['nav_pos_y_phone'];
		$nav_pos_y_last_edited       = $this->props['nav_pos_y_last_edited'];
		$nav_pos_y_responsive_status = et_pb_get_responsive_status($nav_pos_y_last_edited);

		$nav_pos_x                   = $this->props['nav_pos_x'];
		$nav_pos_x_tablet            = $this->props['nav_pos_x_tablet'];
		$nav_pos_x_phone             = $this->props['nav_pos_x_phone'];
		$nav_pos_x_last_edited       = $this->props['nav_pos_x_last_edited'];
		$nav_pos_x_responsive_status = et_pb_get_responsive_status($nav_pos_x_last_edited);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-arrow',
				'declaration' => sprintf(' top: %1$s; ', $nav_pos_y),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-next',
				'declaration' => sprintf('right: %1$s;', $nav_pos_x),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .slick-prev',
				'declaration' => sprintf('left: %1$s; ', $nav_pos_x),
			)
		);

		if (!empty($nav_pos_x_tablet) && $nav_pos_x_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'declaration' => sprintf('right: %1$s;', $nav_pos_x_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf('left: %1$s; ', $nav_pos_x_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);
		endif;

		if (!empty($nav_pos_x_phone) && $nav_pos_x_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-next',
					'declaration' => sprintf('right: %1$s;', $nav_pos_x_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-prev',
					'declaration' => sprintf('left: %1$s; ', $nav_pos_x_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;

		if (!empty($nav_pos_y_tablet) && $nav_pos_y_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-arrow',
					'declaration' => sprintf('top: %1$s; ', $nav_pos_y_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);
		endif;

		if (!empty($nav_pos_y_phone) && $nav_pos_y_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-arrow',
					'declaration' => sprintf('top: %1$s; ', $nav_pos_y_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;
	}

	protected function render_pagination_css($render_slug)
	{
		$pagi_type         = $this->props['pagi_type'];
		$pagi_text         = $this->props['pagi_text'];
		$pagi_color        = $this->props['pagi_color'];
		$pagi_color_hover  = $this->get_hover_value('pagi_color');
		$pagi_bg           = $this->props['pagi_bg'];
		$pagi_bg_hover     = $this->get_hover_value('pagi_bg');
		$pagi_bg_active    = $this->props['pagi_bg_active'];
		$pagi_alignment    = $this->props['pagi_alignment'];
		$pagi_pos_y        = $this->props['pagi_pos_y'];
		$pagi_spacing      = $this->props['pagi_spacing'];
		$pagi_height       = $this->props['pagi_height'];
		$pagi_width        = $this->props['pagi_width'];
		$pagi_width_active = $this->props['pagi_width_active'];
		$pagi_text_active  = $this->props['pagi_text_active'];
		$pagi_radius       = explode('|', $this->props['pagi_radius']);

		if ($pagi_type === 'dot') {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-dots li button',
					'declaration' => 'font-size: 0!important;',
				)
			);
		} elseif ($pagi_type === 'number') {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-dots li button',
					'declaration' => "font-size: {$pagi_text}!important; color: {$pagi_color};",
				)
			);

			if (!empty($pagi_color_hover)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-carousel .slick-dots li:hover button',
						'declaration' => "color: {$pagi_color_hover};",
					)
				);
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-dots',
				'declaration' => sprintf(' text-align: %1$s; transform: translateY(%2$s); ', $pagi_alignment, $pagi_pos_y),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-dots li',
				'declaration' => sprintf(' margin: 0 %1$s;', $pagi_spacing),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-dots li button',
				'declaration' => sprintf(
					' background: %1$s; height: %2$s; width: %3$s; border-radius: %4$s %5$s %6$s %7$s;',
					$pagi_bg,
					$pagi_height,
					$pagi_width,
					$pagi_radius[1],
					$pagi_radius[2],
					$pagi_radius[3],
					$pagi_radius[4]
				),
			)
		);

		if (!empty($pagi_bg_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-dots li:hover button',
					'declaration' => sprintf(' background: %1$s;', $pagi_bg_hover),
				)
			);
		}

		if (!empty($pagi_bg_active)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-dots li.slick-active button',
					'declaration' => sprintf('background: %1$s;', $pagi_bg_active),
				)
			);
		}

		if (!empty($pagi_width_active)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-dots li.slick-active button',
					'declaration' => sprintf('width: %1$s;', $pagi_width_active),
				)
			);
		}

		if (!empty($pagi_text_active)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-dots li.slick-active button',
					'declaration' => sprintf('color: %1$s;', $pagi_text_active),
				)
			);
		}
	}

	protected function render_carousel_css($render_slug)
	{
		$nav_size                                = $this->props['nav_size'];
		$nav_size_tablet                         = $this->props['nav_size_tablet'];
		$nav_size_phone                          = $this->props['nav_size_phone'];
		$nav_size_last_edited                    = $this->props['nav_size_last_edited'];
		$nav_size_responsive_status              = et_pb_get_responsive_status($nav_size_last_edited);
		$nav_border_width                          = $this->props['nav_border_width'];
		$nav_border_style                          = $this->props['nav_border_style'];
		$nav_border_color                          = $this->props['nav_border_color'];
		$nav_border_color_hover                    = $this->get_hover_value('nav_border_color');
		$nav_color                                 = $this->props['nav_color'];
		$nav_bg                                    = $this->props['nav_bg'];
		$nav_color_hover                           = $this->get_hover_value('nav_color');
		$nav_bg_hover                              = $this->get_hover_value('nav_bg');
		$nav_border_radius                       = explode('|', $this->props['nav_border_radius']);
		$slide_spacing                             = $this->props['slide_spacing'];
		$use_both_side_spacing                     = $this->props['use_both_side_spacing'];
		$is_variable_width                         = $this->props['is_variable_width'];
		$slide_width                               = $this->props['slide_width'];
		$slide_width_tablet                        = $this->props['slide_width_tablet'];
		$slide_width_phone                         = $this->props['slide_width_phone'];
		$slide_width_last_edited                   = $this->props['slide_width_last_edited'];
		$slide_width_responsive_status             = et_pb_get_responsive_status($slide_width_last_edited);
		$is_vertical                               = $this->props['is_vertical'];
		$carousel_spacing_top                      = $this->props['carousel_spacing_top'];
		$carousel_spacing_top_tablet               = $this->props['carousel_spacing_top_tablet'];
		$carousel_spacing_top_phone                = $this->props['carousel_spacing_top_phone'];
		$carousel_spacing_top_last_edited          = $this->props['carousel_spacing_top_last_edited'];
		$carousel_spacing_top_responsive_status    = et_pb_get_responsive_status($carousel_spacing_top_last_edited);
		$animation_speed                           = $this->props['animation_speed'];
		$carousel_spacing_bottom                   = $this->props['carousel_spacing_bottom'];
		$carousel_spacing_bottom_tablet            = $this->props['carousel_spacing_bottom_tablet'];
		$carousel_spacing_bottom_phone             = $this->props['carousel_spacing_bottom_phone'];
		$carousel_spacing_bottom_last_edited       = $this->props['carousel_spacing_bottom_last_edited'];
		$carousel_spacing_bottom_responsive_status = et_pb_get_responsive_status($carousel_spacing_bottom_last_edited);

		if (function_exists('dtp_inject_fa_icons')) {
			dtp_inject_fa_icons($this->props['nav_icon_prev']);
			dtp_inject_fa_icons($this->props['nav_icon_next']);
		}

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'icon_left',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-carousel .slick-prev:before',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'icon_right',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-carousel .slick-next:before',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-centered--highlighted .slick-slide',
				'declaration' => sprintf('transition: transform %1$s;', $animation_speed),
			)
		);

		// Carousel Spacing Top - Bottom.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-track',
				'declaration' => sprintf('padding-top: %1$s; padding-bottom: %2$s;', $carousel_spacing_top, $carousel_spacing_bottom),
			)
		);

		// Carousel Spacing Top Tablet.
		if ($carousel_spacing_top_tablet && $carousel_spacing_top_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf('padding-top: %1$s;', $carousel_spacing_top_tablet),
				)
			);
		}

		// Carousel Spacing Top Phone.
		if ($carousel_spacing_top_phone && $carousel_spacing_top_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf('padding-top: %1$s;', $carousel_spacing_top_phone),
				)
			);
		}

		// Carousel Spacing Bottom Tablet.
		if ($carousel_spacing_bottom_tablet && $carousel_spacing_bottom_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf('padding-bottom: %1$s;', $carousel_spacing_bottom_tablet),
				)
			);
		}

		// Carousel Spacing Bottom Phone.
		if ($carousel_spacing_bottom_phone && $carousel_spacing_bottom_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-track',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf('padding-bottom: %1$s;', $carousel_spacing_bottom_phone),
				)
			);
		}

		// Slide  Width.
		if ('on' === $is_variable_width) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-slide',
					'declaration' => sprintf('width: %1$s;', $slide_width),
				)
			);

			// Slide  Width Tablet.
			if (!empty($slide_width_tablet) && $slide_width_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-carousel .slick-slide',
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
						'declaration' => sprintf('width: %1$s;', $slide_width_tablet),
					)
				);
			}

			// Slide  Width Phone.
			if (!empty($slide_width_phone) && $slide_width_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-carousel .slick-slide',
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
						'declaration' => sprintf('width: %1$s;', $slide_width_phone),
					)
				);
			}
		}

		// Slide Spacing.
		if ('off' === $is_vertical) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-slide, .et-db #et-boc %%order_class%% .dtp-carousel .slick-slide',
					'declaration' => sprintf(' padding-left: %1$s!important; padding-right: %1$s!important;', $slide_spacing),
				)
			);

			if ('off' === $use_both_side_spacing) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-carousel .slick-list, .et-db #et-boc %%order_class%% .dtp-carousel .slick-list',
						'declaration' => sprintf(' margin-left: -%1$s!important; margin-right: -%1$s!important;', $slide_spacing),
					)
				);
			}
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-slide, .et-db #et-boc %%order_class%% .dtp-carousel .slick-slide',
					'declaration' => sprintf(' padding-top: %1$s!important; padding-bottom: %1$s!important;', $slide_spacing),
				)
			);
		}

		// Arrow.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-arrow',
				'declaration' => sprintf(
					'height: %1$s; width: %1$s; color: %2$s; background: %3$s; border: %4$s %4$s %6$s;',
					$nav_size,
					$nav_color,
					$nav_bg,
					$nav_border_width,
					$nav_border_style,
					$nav_border_color
				),
			)
		);

		// Arrow hover.
		if ($nav_color_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow:hover',
					'declaration' => sprintf('color: %1$s;', $nav_color_hover),
				)
			);
		}

		if ($nav_bg_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow:hover',
					'declaration' => sprintf('background: %1$s;', $nav_bg_hover),
				)
			);
		}

		if ($nav_border_color_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow:hover',
					'declaration' => sprintf('border-color: %1$s;', $nav_border_color_hover),
				)
			);
		}

		// Arrow Responsive Height.
		if (!empty($nav_size_tablet) && $nav_size_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow',
					'declaration' => sprintf('height: %1$s; width: %1$s;', $nav_size_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);
		endif;

		if (!empty($nav_size_phone) && $nav_size_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow',
					'declaration' => sprintf('height: %1$s; width: %1$s;', $nav_size_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;

		// Arrow Icon
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-arrow:before',
				'declaration' => sprintf(
					'font-size: calc(%1$s * .75); display: inline-block;',
					$nav_size
				),
			)
		);

		// Arrow Icon Responsive
		if (!empty($nav_size_tablet) && $nav_size_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow:before',
					'declaration' => sprintf(' font-size: calc(%1$s * .75);', $nav_size_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);
		endif;

		if (!empty($nav_size_phone) && $nav_size_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-carousel .slick-arrow:before',
					'declaration' => sprintf(' font-size: calc(%1$s * .75);', $nav_size_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;

		// Arrow Border Radius
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-carousel .slick-arrow',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$nav_border_radius[1],
					$nav_border_radius[2],
					$nav_border_radius[3],
					$nav_border_radius[4]
				),
			)
		);

		// Arrows
		$this->render_default_nav_css($render_slug);
		// Carousel Pagination : Dots
		$this->render_pagination_css($render_slug);
	}

	protected function get_carousel_options_data()
	{
		$is_autoplay            = $this->props['is_autoplay'];
		$css_transition         = $this->props['css_transition'];
		$autoplay_speed         = $this->props['autoplay_speed'];
		$animation_speed        = $this->props['animation_speed'];
		$is_center              = $this->props['is_center'];
		$center_mode_type       = $this->props['center_mode_type'];
		$is_vertical            = $this->props['is_vertical'];
		$is_infinite            = $this->props['is_infinite'];
		$icon_left              = esc_html(et_pb_process_font_icon($this->props['nav_icon_prev']));
		$icon_left              = !empty($icon_left) ? $icon_left : '4';
		$icon_right             = esc_html(et_pb_process_font_icon($this->props['nav_icon_next']));
		$icon_right             = !empty($icon_right) ? $icon_right : '5';
		$is_variable_width      = $this->props['is_variable_width'];
		$wait_for_animate       = $this->props['wait_for_animate'];
		$center_padding         = $this->props['center_padding'];
		$center_padding_tablet  = $this->props['center_padding_tablet'];
		$center_padding_phone   = $this->props['center_padding_phone'];
		$slide_count            = $this->props['slide_count'];
		$slide_count_tablet     = $this->props['slide_count_tablet'];
		$slide_count_phone      = $this->props['slide_count_phone'];
		$is_nav                 = $this->props['use_nav'];
		$is_nav_tablet          = $this->props['use_nav_tablet'];
		$is_nav_phone           = $this->props['use_nav_phone'];
		$is_pagi                = $this->props['use_pagi'];
		$is_pagi_tablet         = $this->props['use_pagi_tablet'];
		$is_pagi_phone          = $this->props['use_pagi_phone'];
		$is_swipe               = $this->props['is_swipe'];
		$is_swipe_tablet        = $this->props['is_swipe_tablet'];
		$is_swipe_phone         = $this->props['is_swipe_phone'];
		$slide_to_scroll        = $this->props['slide_to_scroll'];
		$slide_to_scroll_tablet = $this->props['slide_to_scroll_tablet'];
		$slide_to_scroll_phone  = $this->props['slide_to_scroll_phone'];

		if ($is_variable_width === 'on') {
			$slide_count = 1;
		}

		$settings                   = array();
		$settings['responsive']     = array();
		$tablet                     = array();
		$phone                      = array();
		$settings['cssEase']        = $css_transition;
		$settings['swipe']          = $is_swipe === 'on' ? true : false;
		$settings['variableWidth']  = $is_variable_width === 'on' ? true : false;
		$settings['dots']           = $is_pagi === 'on' ? true : false;
		$settings['arrows']         = $is_nav === 'on' ? true : false;
		$settings['infinite']       = $is_infinite === 'on' ? true : false;
		$settings['autoplay']       = $is_autoplay === 'on' ? true : false;
		$settings['autoplaySpeed']  = intval($autoplay_speed);
		$settings['speed']          = intval($animation_speed);
		$settings['slidesToShow']   = intval($slide_count);
		$settings['slidesToScroll'] = intval($slide_to_scroll);
		$settings['centerPadding']  = ($is_variable_width === 'off' && $center_mode_type === 'classic') ? $center_padding : 0;
		$settings['centerMode']     = $is_center === 'on' ? true : false;
		$settings['vertical']       = $is_vertical === 'on' ? true : false;
		$settings['prevArrow']      = '<button type="button" data-icon="' . $icon_left . '" class="slick-arrow slick-prev">Prev</button>';
		$settings['nextArrow']      = '<button type="button" data-icon="' . $icon_right . '" class="slick-arrow slick-next">Prev</button>';

		if ($wait_for_animate === 'off') {
			$settings['waitForAnimate'] = false;
		}

		// Responsive break point 980
		$tablet['breakpoint'] = 980;

		if ('off' === $is_variable_width && !empty($slide_count_tablet)) {
			$tablet['settings']['slidesToShow'] = intval($slide_count_tablet);
		}

		if (!empty($slide_to_scroll_tablet)) {
			$tablet['settings']['slidesToScroll'] = intval($slide_to_scroll_tablet);
		}

		if (!empty($is_pagi_tablet)) {
			$tablet['settings']['dots'] = 'on' === $is_pagi_tablet ? true : false;
		}

		if (!empty($is_nav_tablet)) {
			$tablet['settings']['arrows'] = 'on' === $is_nav_tablet ? true : false;
		}

		if (!empty($is_swipe_tablet)) {
			$tablet['settings']['swipe'] = 'on' === $is_swipe_tablet ? true : false;
		}

		if ('off' === $is_variable_width && 'classic' === $center_mode_type && !empty($center_padding_tablet)) {
			$tablet['settings']['centerPadding'] = $center_padding_tablet;
		}

		array_push($settings['responsive'], $tablet);

		// Responsive break point 767.
		$phone['breakpoint'] = 767;

		if ('off' === $is_variable_width && !empty($slide_count_phone)) {
			$phone['settings']['slidesToShow'] = intval($slide_count_phone);
		}

		if (!empty($slide_to_scroll_phone)) {
			$phone['settings']['slidesToScroll'] = intval($slide_to_scroll_phone);
		}

		if (!empty($is_pagi_phone)) {
			$phone['settings']['dots'] = 'on' === $is_pagi_phone ? true : false;
		}

		if (!empty($is_nav_phone)) {
			$phone['settings']['arrows'] = 'on' === $is_nav_phone ? true : false;
		}

		if (!empty($is_swipe_phone)) {
			$phone['settings']['swipe'] = 'on' === $is_swipe_phone ? true : false;
		}

		if ('off' === $is_variable_width && 'classic' === $center_mode_type && !empty($center_padding_phone)) {
			$phone['settings']['centerPadding'] = $center_padding_phone;
		}

		array_push($settings['responsive'], $phone);

		$carousel_options = sprintf('data-settings="%1$s"', htmlspecialchars(wp_json_encode($settings), ENT_QUOTES, 'UTF-8'));

		return $carousel_options;
	}

	protected function get_buttons_styles($prefix, $render_slug, $selector)
	{
		$custom_padding                   = isset($this->props["{$prefix}_custom_padding"]) ? $this->props["{$prefix}_custom_padding"] : '';
		$custom_padding_tablet            = isset($this->props["{$prefix}_custom_padding_tablet"]) ? $this->props["{$prefix}_custom_padding_tablet"] : '';
		$custom_padding_phone             = isset($this->props["{$prefix}_custom_padding_phone"]) ? $this->props["{$prefix}_custom_padding_phone"] : '';
		$custom_padding_hover             = isset($this->props["{$prefix}_custom_padding"]) ? $this->get_hover_value("{$prefix}_custom_padding") : '';
		$custom_padding_last_edited       = isset($this->props["{$prefix}_custom_padding_last_edited"]) ? $this->props["{$prefix}_custom_padding_last_edited"] : '';
		$custom_padding_responsive_status = et_pb_get_responsive_status($custom_padding_last_edited);
		$icon_placement                   = isset($this->props["{$prefix}_icon_placement"]) ? $this->props["{$prefix}_icon_placement"] : '';
		$use_icon                         = isset($this->props["{$prefix}_use_icon"]) ? $this->props["{$prefix}_use_icon"] : '';
		$is_custom                        = isset($this->props["custom_{$prefix}"]) ? $this->props["custom_{$prefix}"] : '';

		if ('on' === $is_custom) {
			if (!empty($custom_padding)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}, .et-db #et-boc {$selector}",
						'declaration' => $this->process_margin_padding($custom_padding, 'padding', true),
					)
				);
			}

			if (!empty($custom_padding_hover)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}:hover, .et-db #et-boc {$selector}:hover",
						'declaration' => $this->process_margin_padding($custom_padding_hover, 'padding', true),
					)
				);
			} else {
				if (!empty($custom_padding)) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => "body #page-container {$selector}:hover, .et-db #et-boc {$selector}:hover",
							'declaration' => $this->process_margin_padding($custom_padding, 'padding', true),
						)
					);
				}
			}

			if (!empty($custom_padding_tablet) && $custom_padding_responsive_status) :
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}, .et-db #et-boc {$selector}",
						'declaration' => $this->process_margin_padding($custom_padding_tablet, 'padding', true),
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					)
				);
			endif;

			if (!empty($custom_padding_phone) && $custom_padding_responsive_status) :
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}, .et-db #et-boc {$selector}",
						'declaration' => $this->process_margin_padding($custom_padding_phone, 'padding', true),
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					)
				);
			endif;

			if ('on' === $use_icon && 'right' === $icon_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => "body #page-container {$selector}:after, .et-db #et-boc {$selector}:after",
						'declaration' => '
                        display: inline-block;
                        content: attr(data-icon)!important;',
					)
				);
			}
		}
	}

	protected function get_image_hover_animations()
	{
		return array(
			'none'        => esc_html__('None', 'divitorque'),
			'zoom-in'     => esc_html__('Zoom In', 'divitorque'),
			'zoom-out'    => esc_html__('Zoom Out', 'divitorque'),
			'pulse'       => esc_html__('Pulse', 'divitorque'),
			'bounce'      => esc_html__('Bounce', 'divitorque'),
			'flash'       => esc_html__('Flash', 'divitorque'),
			'rubberBand'  => esc_html__('Rubber Band', 'divitorque'),
			'shake'       => esc_html__('Shake', 'divitorque'),
			'swing'       => esc_html__('Swing', 'divitorque'),
			'tada'        => esc_html__('Tada', 'divitorque'),
			'wobble'      => esc_html__('Wobble', 'divitorque'),
			'jello'       => esc_html__('Jello', 'divitorque'),
			'heartBeat'   => esc_html__('Heart Beat', 'divitorque'),
			'bounceIn'    => esc_html__('Bounce In', 'divitorque'),
			'fadeIn'      => esc_html__('Fade In', 'divitorque'),
			'flip'        => esc_html__('Flip', 'divitorque'),
			'rotateIn'    => esc_html__('Rotate In', 'divitorque'),
			'slideInUp'   => esc_html__('Slide In Up', 'divitorque'),
			'slideInDown' => esc_html__('Slide In Down', 'divitorque'),
		);
	}

	protected function hex_to_rgb($hex)
	{
		$hex      = str_replace('#', '', $hex);
		$length   = strlen($hex);
		$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
		$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
		$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));

		return sprintf('rgba(%1$s,%2$s,%3$s,1)', $rgb['r'], $rgb['g'], $rgb['b']);
	}

	protected function get_pattern($name, $color, $weight)
	{
		$pattern = array(
			'curved' => "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='" . $color . "' stroke-width='" . $weight . "' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpath d='M0,6c6,0,6,13,12,13S18,6,24,6'/%3E%3C/svg%3E",

			'zigzag' => "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='" . $color . "' stroke-width='" . $weight . "' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpolyline points='0,18 12,6 24,18 '/%3E%3C/svg%3E",

			'square' => "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' fill='none' stroke='" . $color . "' stroke-width='" . $weight . "' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpolyline points='0,6 6,6 6,18 18,18 18,6 24,6 '/%3E%3C/svg%3E",

			'curly'  => "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' fill='none' stroke='" . $color . "' stroke-width='" . $weight . "' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpath d='M0,21c3.3,0,8.3-0.9,15.7-7.1c6.6-5.4,4.4-9.3,2.4-10.3c-3.4-1.8-7.7,1.3-7.3,8.8C11.2,20,17.1,21,24,21'/%3E%3C/svg%3E",
		);

		return $pattern[$name];
	}

	protected function get_masking_shapes()
	{
		return array();
	}

	public static function get_no_results_template($heading_tag = 'h1')
	{
		global $et_no_results_heading_tag;
		$et_no_results_heading_tag = $heading_tag;
		ob_start();

		if (et_is_builder_plugin_active()) {
			include ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php';
		} else {
			get_template_part('includes/no-results', 'index');
		}

		return ob_get_clean();
	}

	public static function filter_invalid_term_ids($term_ids, $taxonomy)
	{
		$valid_term_ids = array();

		foreach ($term_ids as $term_id) {
			$term_id = intval($term_id);
			$term    = term_exists($term_id, $taxonomy);
			if (!empty($term)) {
				$valid_term_ids[] = $term_id;
			}
		}

		return $valid_term_ids;
	}

	protected static function filter_meta_categories($categories, $post_id = 0, $taxonomy = 'category')
	{
		$raw_term_ids = is_array($categories) ? $categories : explode(',', $categories);

		if (in_array('all', $raw_term_ids, true)) {
			return array();
		}

		$term_ids = array();

		foreach ($raw_term_ids as $value) {
			if ('current' === $value) {
				if ($post_id > 0) {
					$post_terms = wp_get_object_terms($post_id, $taxonomy);

					if (is_wp_error($post_terms)) {
						continue;
					}

					$term_ids = array_merge($term_ids, wp_list_pluck($post_terms, 'term_id'));
				} else {
					$is_category = 'category' === $taxonomy && is_category();
					$is_tag      = !$is_category && 'post_tag' === $taxonomy && is_tag();
					$is_tax      = !$is_category && !$is_tag && is_tax($taxonomy);

					if ($is_category || $is_tag || $is_tax) {
						$term_ids[] = get_queried_object()->term_id;
					}
				}

				continue;
			}

			$term_ids[] = (int) $value;
		}

		$term_ids = self::filter_invalid_term_ids(array_unique(array_filter($term_ids)), $taxonomy);

		return $term_ids;
	}

	protected static function filter_include_categories($include_categories, $post_id = 0, $taxonomy = 'category')
	{
		$categories = array();

		if (!empty($include_categories)) {
			if (is_singular() || wp_doing_ajax()) {
				$post_id    = $post_id > 0 ? $post_id : self::get_current_post_id_reverse();
				$categories = self::filter_meta_categories($include_categories, $post_id, $taxonomy);
			} else {
				$categories = self::filter_meta_categories($include_categories, 0, $taxonomy);
			}
		}

		return $categories;
	}
}
