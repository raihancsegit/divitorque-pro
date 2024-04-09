<?php
class DTP_Business_Hour_Child extends DTP_Builder_Module
{
	public $slug                     = 'torq_business_hours_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'day';

	public function init()
	{
		$this->name = esc_html__('Business Hours Item', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
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
					'box_shadow' => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'day'       => array(
				'label'    => esc_html__('Day', 'divitorque'),
				'selector' => '.dtp-business-hour  %%order_class%% .dtp-business-hour-day',
			),
			'time'      => array(
				'label'    => esc_html__('Time', 'divitorque'),
				'selector' => '.dtp-business-hour  %%order_class%% .dtp-business-hour-time',
			),
			'separator' => array(
				'label'    => esc_html__('Separator', 'divitorque'),
				'selector' => '.dtp-business-hour  %%order_class%% .dtp-business-hour-separator',
			),
		);
	}

	public function get_fields()
	{
		$content = array(
			'day'  => array(
				'label'       => esc_html__('Day', 'divitorque'),
				'description' => esc_html__('Define the day your for business hour.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'time' => array(
				'label'       => esc_html__('Time', 'divitorque'),
				'description' => esc_html__('Define the time your for business hour.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),
		);

		$separator = array(
			'separator_type'   => array(
				'label'       => esc_html__('Separator Type', 'divitorque'),
				'description' => esc_html__('Select text separator type.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => 'relative',
				'options'     => array(
					'relative'       => esc_html__('Relative to Parent', 'divitorque'),
					'solid_border'   => esc_html__('Solid', 'divitorque'),
					'double_border'  => esc_html__('Double', 'divitorque'),
					'dotted_border'  => esc_html__('Dotted', 'divitorque'),
					'dashed_border'  => esc_html__('Dashed', 'divitorque'),
					'curved_pattern' => esc_html__('Curved', 'divitorque'),
					'zigzag_pattern' => esc_html__('Zigzag', 'divitorque'),
				),
			),
			'separator_gap'    => array(
				'label'          => esc_html__('Separator Spacing', 'divitorque'),
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
				'show_if_not'    => array(
					'separator_type' => 'relative',
				),
			),
			'separator_color'  => array(
				'label'       => esc_html__('Separator Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your text separator.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => '#dddddd',
				'show_if_not' => array(
					'separator_type' => 'relative',
				),
			),
			'separator_weight' => array(
				'label'          => esc_html__('Separator Weight', 'divitorque'),
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
				'show_if_not'    => array(
					'separator_type' => 'relative',
				),
			),
			'separator_height' => array(
				'label'          => esc_html__('Separator Height', 'divitorque'),
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
				'show_if_not'    => array(
					'separator_type' => 'relative',
				),
				'show_if'        => array(
					'separator_type' => array('curved_pattern', 'zigzag_pattern'),
				),
			),
		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__('Admin Label', 'divitorque'),
				'type'        => 'text',
				'description' => esc_html__('This will change the label of the item', 'divitorque'),
				'toggle_slug' => 'admin_label',
			),
		);

		return array_merge($content, $separator, $label);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields          = array();
		$advanced_fields['text']  = array();
		$advanced_fields['fonts'] = array();

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '.dtp-business-hour %%order_class%% .dtp-business-hour-child',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '.dtp-business-hour %%order_class%% .dtp-business-hour-child',
					'border_styles' => '.dtp-business-hour %%order_class%% .dtp-business-hour-child',
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

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'css'         => array(
				'main'      => '.dtp-business-hour %%order_class%% .dtp-business-hour-child',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'box_shadow',
		);

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '.dtp-business-hour %%order_class%% .dtp-business-hour-child',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['day'] = array(
			'label'           => esc_html__('Day', 'divitorque'),
			'css'             => array(
				'main'      => '.dtp-business-hour %%order_class%% .dtp-business-hour-day',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'day',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		$advanced_fields['fonts']['time'] = array(
			'label'           => esc_html__('Time', 'divitorque'),
			'css'             => array(
				'main'      => '.dtp-business-hour %%order_class%% .dtp-business-hour-time',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'time',
			'hide_text_align' => false,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		return $advanced_fields;
	}

	protected function render_day()
	{
		if (!empty($this->props['day'])) {
			return '<div class="dtp-business-hour-day">' . $this->props['day'] . '</div>';
		}
	}

	protected function render_time()
	{
		if (!empty($this->props['time'])) {
			return '<div class="dtp-business-hour-time">' . $this->props['time'] . '</div>';
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_css($render_slug);
		$this->add_classname('ba_et_pb_module');

		return sprintf(
			'<div class="dtp-module-child dtp-business-hour-child">
				%1$s
				<div class="dtp-business-hour-separator"></div>
				%2$s
             </div>',
			$this->render_day(),
			$this->render_time()
		);
	}

	protected function render_css($render_slug)
	{
		$type             = $this->props['separator_type'];
		$separator_height = $this->props['separator_height'];
		$separator_color  = $this->props['separator_color'];
		$separator_gap    = $this->props['separator_gap'];
		$separator_weight = $this->props['separator_weight'];

		if (!empty($this->props['separator_gap'])) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-business-hour %%order_class%% .dtp-business-hour-separator',
					'declaration' => sprintf(
						'margin-right: %1$s;
						margin-left: %1$s;',
						$separator_gap
					),
				)
			);
		}

		if ('relative' !== $type) {
			if ('#' === $separator_color[0]) {
				$separator_color = $this->hex_to_rgb($separator_color);
			}

			$_type = explode('_', $type);

			if ('border' === $_type[1]) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.dtp-business-hour %%order_class%% .dtp-business-hour-separator',
						'declaration' => sprintf(
							'border-top: %1$s %2$s %3$s;
							height: initial!important;
							background-image: initial!important;',
							$separator_weight,
							$_type[0],
							$separator_color
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
						'selector'    => '.dtp-business-hour %%order_class%% .dtp-business-hour-separator',
						'declaration' => sprintf(
							'background-image: url("%1$s");
							height: %2$s;
							border-top: 0!important;
							background-size: %2$s 100%%;',
							$pattern_bg,
							$separator_height
						),
					)
				);
			}
		}
	}
}

new DTP_Business_Hour_Child();
