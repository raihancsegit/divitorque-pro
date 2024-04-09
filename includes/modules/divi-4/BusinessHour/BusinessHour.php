<?php
class DTP_Business_Hour extends DTP_Builder_Module
{
	public $slug       = 'torq_business_hours';
	public $vb_support = 'on';
	public $child_slug = 'torq_business_hours_child';

	public function init()
	{
		$this->name      = esc_html__('Torq Business Hours', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'business-hour.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__('Content', 'divitorque'),
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general'    => esc_html__('General', 'divitorque'),
					'title_text' => esc_html__('Title Text', 'divitorque'),
					'texts'      => array(
						'title'             => esc_html__('Day & Time', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'day'  => array(
								'name' => esc_html__('Day', 'divitorque'),
							),
							'time' => array(
								'name' => esc_html__('Time', 'divitorque'),
							),
						),
					),
					'separator'  => esc_html__('Day-Time Separator', 'divitorque'),
					'border'     => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'day'       => array(
				'label'    => esc_html__('Day', 'divitorque'),
				'selector' => '%%order_class%% .dtp-business-hour-day',
			),
			'time'      => array(
				'label'    => esc_html__('Time', 'divitorque'),
				'selector' => '%%order_class%% .dtp-business-hour-time',
			),
			'separator' => array(
				'label'    => esc_html__('Separator', 'divitorque'),
				'selector' => '%%order_class%% .dtp-business-hour-separator',
			),
		);
	}

	public function get_fields()
	{
		$settings = array(
			'item_spacing'   => array(
				'label'          => esc_html__('Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of each item.', 'divitorque'),
				'type'           => 'range',
				'default'        => '25px',
				'fixed_unit'     => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'settings',
			),
			'show_separator' => array(
				'label'           => esc_html__('Day Time Separator', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether a separator should be used between day and time.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),
			'show_divider'   => array(
				'label'           => esc_html__('Column Divider', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether a divider should be used at the bottom of each item.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),
			'divider_type'   => array(
				'label'       => esc_html__('Divider Type', 'divitorque'),
				'description' => esc_html__('Select item divider type.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'solid_border',
				'options'     => array(
					'solid_border'   => esc_html__('Solid', 'divitorque'),
					'double_border'  => esc_html__('Double', 'divitorque'),
					'dotted_border'  => esc_html__('Dotted', 'divitorque'),
					'dashed_border'  => esc_html__('Dashed', 'divitorque'),
					'curved_pattern' => esc_html__('Curved', 'divitorque'),
					'zigzag_pattern' => esc_html__('Zigzag', 'divitorque'),
				),
				'show_if'     => array(
					'show_divider' => 'on',
				),
			),
			'divider_color'  => array(
				'label'       => esc_html__('Divider Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your item divider.', 'divitorque'),
				'type'        => 'color-alpha',
				'toggle_slug' => 'settings',
				'default'     => '#dddddd',
				'show_if'     => array(
					'show_divider' => 'on',
				),
			),
			'divider_weight' => array(
				'label'          => esc_html__('Divider Weight', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom depth for your item divider.', 'divitorque'),
				'type'           => 'range',
				'default'        => '1px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'show_divider' => 'on',
				),
			),
			'divider_height' => array(
				'label'          => esc_html__('Divider Height', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom height for your item divider.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'show_divider' => 'on',
					'divider_type' => array('curved_pattern', 'zigzag_pattern'),
					'label'        => esc_html__('', 'divitorque'),
				),
			),
		);

		$general = array(
			'day_text_width'  => array(
				'label'          => esc_html__('Day Text Width', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom width for your day text.', 'divitorque'),
				'type'           => 'range',
				'default'        => 'auto',
				'default_unit'   => '%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'general',
			),
			'time_text_width' => array(
				'label'          => esc_html__('Time Text Width', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom width for your time text.', 'divitorque'),
				'type'           => 'range',
				'default'        => 'auto',
				'default_unit'   => '%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'general',
			),
			'item_padding'    => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom padding for each item.', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'general',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$separator = array(
			'separator_type'   => array(
				'label'       => esc_html__('Type', 'divitorque'),
				'description' => esc_html__('Select text separator type.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => 'solid_border',
				'options'     => array(
					'solid_border'   => esc_html__('Solid', 'divitorque'),
					'double_border'  => esc_html__('Double', 'divitorque'),
					'dotted_border'  => esc_html__('Dotted', 'divitorque'),
					'dashed_border'  => esc_html__('Dashed', 'divitorque'),
					'curved_pattern' => esc_html__('Curved', 'divitorque'),
					'zigzag_pattern' => esc_html__('Zigzag', 'divitorque'),
				),
				'show_if'     => array(
					'show_separator' => 'on',
				),
			),
			'separator_gap'    => array(
				'label'          => esc_html__('Spacing', 'divitorque'),
				'description'    => esc_html__('Define separator both side spacing.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'show_separator' => 'on',
				),
			),
			'separator_color'  => array(
				'label'       => esc_html__('Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your text separator.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => '#dddddd',
				'show_if'     => array(
					'show_separator' => 'on',
				),
			),
			'separator_weight' => array(
				'label'          => esc_html__('Weight', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom depth for your text separator', 'divitorque'),
				'type'           => 'range',
				'default'        => '1px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'show_separator' => 'on',
				),
			),
			'separator_height' => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom height for your text separator', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'show_separator' => 'on',
					'separator_type' => array('curved_pattern', 'zigzag_pattern'),
				),
			),
		);

		$item_bg = $this->custom_background_fields(
			'item',
			esc_html__('Item', 'divitorque'),
			'advanced',
			'general',
			array('color', 'gradient', 'hover', 'image'),
			array(),
			''
		);

		return array_merge($settings, $separator, $general, $item_bg);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['item'] = array(
			'label_prefix' => esc_html__('Item', 'divitorque'),
			'toggle_slug'  => 'general',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-business-hour-child',
					'border_styles' => '%%order_class%% .dtp-business-hour-child',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__('Item Box Shadow', 'divitorque'),
			'css'         => array(
				'main'      => '%%order_class%% .dtp-business-hour-child',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'general',
		);

		$advanced_fields['fonts']['day'] = array(
			'label'           => esc_html__('Day', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-business-hour-day',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'day',
			'hide_text_align' => false,
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['time'] = array(
			'label'           => esc_html__('Time', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-business-hour-time',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'time',
			'hide_text_align' => false,
			'font_size'       => array(
				'default' => '14px',
			),
		);

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_css($render_slug);
		wp_enqueue_style('torq-business-hour');
		$content = $this->props['content'];

		if (empty($content)) {
			$content = '<h3>No business hour was added!</h3>';
		}

		return sprintf(
			'<div class="dtp-module dtp-business-hour">
				<div class="dtp-business-hour-content">
					%1$s
           	 	</div>
            </div>',
			$content
		);
	}

	protected function render_css($render_slug)
	{
		if ('off' === $this->props['show_separator']) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-business-hour-separator',
					'declaration' => 'display: none!important;',
				)
			);
		}

		if ('auto' !== $this->props['time_text_width']) {
			$this->get_responsive_styles(
				'time_text_width',
				'%%order_class%% .dtp-business-hour-time',
				array(
					'primary'   => 'flex',
					'important' => false,
				),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if ('auto' !== $this->props['day_text_width']) {
			$this->get_responsive_styles(
				'day_text_width',
				'%%order_class%% .dtp-business-hour-day',
				array(
					'primary'   => 'flex',
					'important' => false,
				),
				array('default' => 'auto'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'item_padding',
			'%%order_class%% .torq_business_hours_child .dtp-business-hour-child',
			array(
				'primary'   => 'padding',
				'important' => true,
			),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .torq_business_hours_child',
				'declaration' => sprintf(
					'margin-bottom: %1$s!important;',
					$this->props['item_spacing']
				),
			)
		);

		if ('on' === $this->props['show_divider']) {
			$divider_color  = $this->props['divider_color'];
			$divider_weight = $this->props['divider_weight'];
			$divider_height = $this->props['divider_height'];

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_business_hours_child',
					'declaration' => sprintf(
						'padding-bottom: %1$s!important;',
						$this->props['item_spacing']
					),
				)
			);
			if ('#' === $divider_color[0]) {
				$divider_color = $this->hex_to_rgb($divider_color);
			}

			$divider_type = explode('_', $this->props['divider_type']);

			if ('border' === $divider_type[1]) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_business_hours_child',
						'declaration' => sprintf(
							'border-bottom: %1$s %2$s %3$s;',
							$divider_weight,
							$divider_type[0],
							$divider_color
						),
					)
				);
			} else {
				if ('curved' === $divider_type[0] || 'zigzag' === $divider_type[0]) {
					$pattern_bg = $this->get_pattern($divider_type[0], $divider_color, $divider_weight);
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_business_hours_child:after',
						'declaration' => sprintf(
							'content: "";
							position: absolute;
							background-image: url("%1$s");
							height: %2$s;
							background-size: %2$s 100%%;
							bottom: calc(-%2$s / 2);',
							$pattern_bg,
							$divider_height
						),
					)
				);
			}
		}

		// Separator.
		if (!empty($this->props['separator_gap'])) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-business-hour-separator',
					'declaration' => sprintf(
						'margin-right: %1$s;
						margin-left: %1$s;',
						$this->props['separator_gap']
					),
				)
			);
		}

		$separator_color  = $this->props['separator_color'];
		$separator_weight = $this->props['separator_weight'];
		$separator_height = $this->props['separator_height'];
		$type             = $this->props['separator_type'];

		if ('none_all' !== $type) {
			if ('#' === $separator_color[0]) {
				$separator_color = $this->hex_to_rgb($separator_color);
			}

			$_type = explode('_', $type);

			if ('border' === $_type[1]) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-business-hour-separator',
						'declaration' => sprintf(
							'border-top: %1$s %2$s %3$s;
							height: %4$s;',
							$separator_weight,
							$_type[0],
							$separator_color,
							$separator_weight
						),
					)
				);
			} else {
				if ('curved' === $_type[0] || 'zigzag' === $_type[0]) {
					$pattern_bg = $this->get_pattern($_type[0], $separator_color, $separator_weight);
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-business-hour-separator',
						'declaration' => sprintf(
							'background-image: url("%1$s");
							height: %2$s;
							background-size: %2$s 100%%;',
							$pattern_bg,
							$separator_height
						),
					)
				);
			}
		}

		$this->get_custom_bg_style($render_slug, 'item', '%%order_class%% .dtp-business-hour-child', '%%order_class%% .dtp-business-hour-child:hover');
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Day', 'divitorque');
	}
}

new DTP_Business_Hour();
