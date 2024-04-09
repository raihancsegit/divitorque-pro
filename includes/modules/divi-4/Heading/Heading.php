<?php
class DTP_Heading extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_heading';
		$this->name       = esc_html__('Torq Heading', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'heading.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'common' => esc_html__('General', 'divitorque'),
					'text'   => esc_html__('Text', 'divitorque'),
					'before' => array(
						'title'             => esc_html__('Before Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__('General', 'divitorque'),
							),
							'text'    => array(
								'name' => esc_html__('Typography', 'divitorque'),
							),
						),
					),
					'center_text' => array(
						'title'             => esc_html__('Center Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__('General', 'divitorque'),
							),
							'text'    => array(
								'name' => esc_html__('Typography', 'divitorque'),
							),
						),
					),
					'after'      => array(
						'title'             => esc_html__('After Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__('General', 'divitorque'),
							),
							'text'    => array(
								'name' => esc_html__('Typography', 'divitorque'),
							),
						),
					),
					'bg_text'     => array(
						'title'             => esc_html__('Background Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__('General', 'divitorque'),
							),
							'text'    => array(
								'name' => esc_html__('Typography', 'divitorque'),
							),
						),
					),
					'highlighter' => esc_html__('Highlighter', 'divitorque'),
					'border'      => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'before' => array(
				'label'    => esc_html__('Before Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-heading-before',
			),
			'center' => array(
				'label'    => esc_html__('Center Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-heading-center',
			),
			'after' => array(
				'label'    => esc_html__('After Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-heading-after',
			),
			'bg'     => array(
				'label'    => esc_html__('Background Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-heading:after',
			),
			'border' => array(
				'label'    => esc_html__('Border', 'divitorque'),
				'selector' => '%%order_class%% .dtp-heading-border',
			),
		);
	}

	protected function get_text_fields($opt_name, $slug, $name)
	{
		$fields = array(
			"{$opt_name}_bg"           => array(
				'label'       => esc_html__('Background Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the background area behind the ', 'divitorque') . $name,
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'general',
			),

			"{$opt_name}_padding"      => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the', 'divitorque') . $name,
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => $slug,
				'sub_toggle'     => 'general',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),

			"{$opt_name}_margin"       => array(
				'label'          => esc_html__('Margin', 'divitorque'),
				'description'    => esc_html__('Here you can define custom margin for the', 'divitorque') . $name,
				'type'           => 'custom_margin',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => $slug,
				'sub_toggle'     => 'general',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),

			"{$opt_name}_radius"       => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of this element. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'general',
				'default'     => 'off|0px|0px|0px|0px',
			),

			"{$opt_name}_border_type"  => array(
				'label'       => esc_html__('Border Type', 'divitorque'),
				'description' => esc_html__('Borders support various different styles, each of which will change the shape of the border element.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'general',
				'default'     => 'none',
				'options'     => array(
					'none'   => esc_html__('None', 'divitorque'),
					'solid'  => esc_html__('Solid', 'divitorque'),
					'dashed' => esc_html__('Dashed', 'divitorque'),
					'dotted' => esc_html__('Dotted', 'divitorque'),
					'double' => esc_html__('Double', 'divitorque'),
					'groove' => esc_html__('Groove', 'divitorque'),
					'ridge'  => esc_html__('Ridge', 'divitorque'),
					'inset'  => esc_html__('Inset', 'divitorque'),
					'outset' => esc_html__('Outset', 'divitorque'),
				),
			),

			"{$opt_name}_border_pos"   => array(
				'label'       => esc_html__('Border Position', 'divitorque'),
				'description' => esc_html__('Select the place where you want to display border.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'general',
				'default'     => 'bottom',
				'options'     => array(
					'top'        => esc_html__('Top', 'divitorque'),
					'bottom'     => esc_html__('Bottom', 'divitorque'),
					'top_bottom' => esc_html__('Top & Bottom', 'divitorque'),
				),
				'show_if_not' => array(
					"{$opt_name}_border_type" => 'none',
				),
			),

			"{$opt_name}_border_width" => array(
				'label'          => esc_html__('Border Weight', 'divitorque'),
				'description'    => esc_html__('Increase or decrease the border weight.', 'divitorque'),
				'type'           => 'range',
				'default'        => '1px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'general',
				'show_if_not' => array(
					"{$opt_name}_border_type" => 'none',
				),
			),

			"{$opt_name}_border_color" => array(
				'label'       => esc_html__('Border Color', 'divitorque'),
				'description' => esc_html__('Choose your desired color for the border shape.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#333',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'general',
				'show_if_not' => array(
					"{$opt_name}_border_type" => 'none',
				),
			),

			"{$opt_name}_stroke"       => array(
				'label'          => esc_html__('Text Stroke', 'divitorque'),
				'description'    => esc_html__('Define text stroke width for the ', 'divitorque') . $name,
				'type'           => 'range',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'text',
			),

			"{$opt_name}_stroke_color" => array(
				'label'       => esc_html__('Stroke Color', 'divitorque'),
				'description' => esc_html__('Define text stroke color for the ', 'divitorque') . $name,
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => $slug,
				'sub_toggle'  => 'text',
			),
		);

		return $fields;
	}

	public function get_fields()
	{
		$fields = array(
			'prefix'               => array(
				'label'       => esc_html__('Before Text', 'divitorque'),
				'description' => esc_html__('The before text for the heading.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'center_text'          => array(
				'label'       => esc_html__('Center Text', 'divitorque'),
				'description' => esc_html__('Define the center text for the heading.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'suffix'               => array(
				'label'       => esc_html__('After Text', 'divitorque'),
				'description' => esc_html__('The after text for the heading.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'bg_text'              => array(
				'label'       => esc_html__('Background Text', 'divitorque'),
				'description' => esc_html__('The background text for the heading.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'link_url'             => array(
				'label'           => esc_html__('Link URL', 'divitorque'),
				'description'     => esc_html__('Type the URL if you want to link your heading.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'url',
			),

			'tag'                  => array(
				'label'       => esc_html__('HTML Tag', 'divitorque'),
				'description' => esc_html__('You can change the html tag for this heading module by choosing anything from H1 through H6. Higher heading levels are smaller and less significant.', 'divitorque'),
				'type'        => 'multiple_buttons',
				'toggle_slug' => 'content',
				'default'     => 'h1',
				'options'     => array(
					'h1' => array('title' => esc_html__('H1', 'divitorque')),
					'h2' => array('title' => esc_html__('H2', 'divitorque')),
					'h3' => array('title' => esc_html__('H3', 'divitorque')),
					'h4' => array('title' => esc_html__('H4', 'divitorque')),
					'h5' => array('title' => esc_html__('H5', 'divitorque')),
					'h6' => array('title' => esc_html__('H6', 'divitorque')),
				),
			),

			// Common.
			'type'                 => array(
				'label'       => esc_html__('Text Type', 'divitorque'),
				'description' => esc_html__('Define the text layout type for the heading.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'common',
				'default'     => 'row',
				'options'     => array(
					'row'    => esc_html__('Inline', 'divitorque'),
					'column' => esc_html__('Block', 'divitorque'),
				),
			),

			'text_alignment'       => array(
				'label'            => esc_html__('Text Alignment', 'divitorque'),
				'description'      => esc_html__('Align text to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'default_on_front' => 'center',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'common',
				'mobile_options'   => true,
			),

			// Bg Text.
			'bg_pos_y'             => array(
				'label'          => esc_html__('Vertical Position', 'divitorque'),
				'description'    => esc_html__('Define the value for the vertical position of the background text.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '50%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => -1000,
					'max'  => 1000,
					'step' => 1,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'bg_text',
				'sub_toggle'  => 'general',
			),

			'bg_pos_x'             => array(
				'label'          => esc_html__('Horizontal Position', 'divitorque'),
				'description'    => esc_html__('Define the value for the horizontal position of the background text.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '50%',
				'range_settings' => array(
					'min'  => -1000,
					'max'  => 1000,
					'step' => 1,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'bg_text',
				'sub_toggle'  => 'general',
			),

			// border.
			'use_border'           => array(
				'label'           => esc_html__('Use Highlighter', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether highlighter shape should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'on',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
			),

			'border_placement'     => array(
				'label'       => esc_html__('Placement', 'divitorque'),
				'description' => esc_html__('Define the horizontal/vertical highlighter placement from the list.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'default'     => 'horizontal',
				'options'     => array(
					'horizontal' => esc_html__('Horizontal', 'divitorque'),
					'vertical'   => esc_html__('Vertical', 'divitorque'),
				),
				'show_if'     => array(
					'use_border' => 'on',
				),
			),

			'border_type'          => array(
				'label'       => esc_html__('Type', 'divitorque'),
				'description' => esc_html__('Select different types of highlighter for the heading.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'default'     => 'pattern',
				'options'     => array(
					'classic' => esc_html__('Classic', 'divitorque'),
					'pattern' => esc_html__('Pattern', 'divitorque'),
				),
				'show_if'     => array(
					'border_placement' => 'horizontal',
					'use_border'       => 'on',
				),
			),

			'border_style_classic' => array(
				'label'       => esc_html__('Style', 'divitorque'),
				'description' => esc_html__('Highlighter support various different styles, each of which will change the shape of the highlighter element.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'default'     => 'double',
				'options'     => array(
					'solid'  => esc_html__('Solid', 'divitorque'),
					'double' => esc_html__('Double', 'divitorque'),
					'dotted' => esc_html__('Dotted', 'divitorque'),
					'dashed' => esc_html__('Dashed', 'divitorque'),
				),
				'show_if'     => array(
					'border_placement' => 'horizontal',
					'use_border'       => 'on',
					'border_type'      => 'classic',
				),
			),
			'border_style_pattern' => array(
				'label'       => esc_html__('Style', 'divitorque'),
				'description' => esc_html__('Highlighter support various different styles, each of which will change the shape of the highlighter element.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'default'     => 'curved',
				'options'     => array(
					'curved' => esc_html__('Curved', 'divitorque'),
					'zigzag' => esc_html__('Zigzag', 'divitorque'),
					'square' => esc_html__('Square', 'divitorque'),
					'curly'  => esc_html__('Curly', 'divitorque'),
				),
				'show_if'     => array(
					'border_placement' => 'horizontal',
					'use_border'       => 'on',
					'border_type'      => 'pattern',
				),
			),

			'border_color'         => array(
				'label'       => esc_html__('Color', 'divitorque'),
				'description' => esc_html__('Choose your desired color for the highlighter shape.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'default'     => $this->default_color,
				'show_if'     => array(
					'use_border' => 'on',
				),
			),

			'border_radius'        => array(
				'label'           => esc_html__('Border Radius', 'divitorque'),
				'description'     => esc_html__('Here you can control the corner radius of the border. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '0px',
				'fixed_unit'      => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border' => 'on',
				),
			),

			'border_weight'        => array(
				'label'           => esc_html__('Weight', 'divitorque'),
				'description'     => esc_html__('Increase or decrease the highlighter weight.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '3px',
				'fixed_unit'      => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border'       => 'on',
					'border_placement' => 'horizontal',
				),
			),

			'border_height'        => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Increase or decrease the highlighter height.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border'       => 'on',
					'border_placement' => 'horizontal',
					'border_type'      => array('curved_pattern', 'zigzag_pattern'),
				),
			),

			'border_height_alt'    => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Increase or decrease the highlighter height.', 'divitorque'),
				'type'           => 'range',
				'default'        => '200px',
				'fixed_unit'     => 'px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border'       => 'on',
					'border_placement' => 'vertical',
				),
			),

			'border_width'         => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can set a custom width for the highlighter element.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '100px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 800,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border' => 'on',
				),
			),

			'border_pos_y'         => array(
				'label'          => esc_html__('Vertical Position', 'divitorque'),
				'description'    => esc_html__('Define a custom value for the border vertical position.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '-25px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => -500,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border' => 'on',
				),
			),

			'use_pos_x_center'     => array(
				'label'           => esc_html__('Use Horizontal Position Center', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether highlighter should be used horizontally center.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'on',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border'       => 'on',
					'border_placement' => 'horizontal',
				),
			),

			'border_pos_x'         => array(
				'label'          => esc_html__('Horizontal Position', 'divitorque'),
				'description'    => esc_html__('Define a custom value for the highlighter horizontal position.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '0px',
				'range_settings' => array(
					'min'  => -500,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'highlighter',
				'show_if'     => array(
					'use_border'       => 'on',
					'use_pos_x_center' => 'off',
				),
			),
		);

		$before      = $this->get_text_fields('bt', 'before', __('before text.', 'divitorque'));
		$center_text = $this->get_text_fields('ct', 'center_text', __('center text.', 'divitorque'));
		$after      = $this->get_text_fields('at', 'after', __('after text.', 'divitorque'));

		return array_merge($fields, $before, $center_text, $after);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields = array();
		$advanced_fields['text_shadow']   = array();
		$advanced_fields['text']          = array();

		$advanced_fields['fonts']['main'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-heading',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '30px',
			),
		);

		$advanced_fields['fonts']['bt'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-heading-before',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'before',
			'sub_toggle'      => 'text',
			'hide_text_align' => true,
		);

		$advanced_fields['fonts']['ct'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-heading-center',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'center_text',
			'sub_toggle'      => 'text',
			'hide_text_align' => true,
		);

		$advanced_fields['fonts']['at'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-heading-after',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'after',
			'sub_toggle'      => 'text',
			'hide_text_align' => true,
		);

		$advanced_fields['fonts']['bg'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-heading:after',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'bg_text',
			'sub_toggle'      => 'text',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '60px',
			),
		);

		return $advanced_fields;
	}

	public function _render_link_href($url)
	{
		if (!empty($url)) {
			return sprintf('href="%1$s"', $url);
		}
	}

	public function _render_element($props, $class)
	{
		$props = $this->props[$props];

		if (!empty($props)) {
			return sprintf('<span class="dtp-heading-%1$s">%2$s</span>', $class, $props);
		}
	}

	public function _render_border()
	{
		if ('on' === $this->props['use_border']) {
			return '<span class="dtp-heading-border"></span>';
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->apply_css($render_slug);
		wp_enqueue_style('torq-heading');

		$type      = $this->props['type'];
		$bg_text   = $this->props['bg_text'];
		$inner_tag = $this->props['tag'];
		$link_url  = $this->props['link_url'];
		$tag       = !empty($link_url) ? 'a' : 'div';

		return sprintf(
			'<%1$s %2$s class="dtp-module dtp-module-pro dtp-heading-wrap">
                <%3$s class="dtp-heading" data-bg="%4$s">
                    %5$s%9$s%6$s%10$s%7$s%8$s
                </%3$s>
            </%1$s>',
			$tag,
			$this->_render_link_href($link_url),
			$inner_tag,
			$bg_text,
			$this->_render_element('prefix', 'before'),
			$this->_render_element('center_text', 'center'),
			$this->_render_element('suffix', 'after'),
			$this->_render_border(),
			('row' === $type && !empty($this->props['prefix'])) ? '&nbsp;' : '',
			('row' === $type && !empty($this->props['suffix'])) ? '&nbsp;' : ''
		);
	}

	public function get_text_styles($render_slug, $before, $selector)
	{
		$bg           = $this->props[$before . '_bg'];
		$color        = $this->props[$before . '_text_color'];
		$stroke       = $this->props[$before . '_stroke'];
		$stroke_color = $this->props[$before . '_stroke_color'];
		$border_type  = $this->props[$before . '_border_type'];
		$border_pos   = $this->props[$before . '_border_pos'];
		$border_width = $this->props[$before . '_border_width'];
		$border_color = $this->props[$before . '_border_color'];
		$radius       = explode('|', $this->props[$before . '_radius']);
		$padding      = $before . '_padding';
		$margin       = $before . '_margin';

		if (!empty($stroke)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => sprintf(
						'
                    -webkit-text-stroke-width: %1$s;
                    -webkit-text-stroke-color: %2$s;',
						$stroke,
						$stroke_color
					),
				)
			);
		}

		if (!empty($color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => $selector,
					'declaration' => sprintf(
						'-webkit-text-fill-color: %1$s;',
						$color
					),
				)
			);
		}

		if ($border_type !== 'none') {
			if ($border_pos === 'top' || $border_pos === 'top_bottom') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => sprintf(
							'border-top: %1$s %2$s %3$s;',
							$border_width,
							$border_type,
							$border_color
						),
					)
				);
			}

			if ($border_pos === 'bottom' || $border_pos === 'top_bottom') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => $selector,
						'declaration' => sprintf(
							'border-bottom: %1$s %2$s %3$s;',
							$border_width,
							$border_type,
							$border_color
						),
					)
				);
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => $selector,
				'declaration' => sprintf(
					'
                background   : %1$s;
                border-radius: %2$s %3$s %4$s %5$s;',
					$bg,
					$radius[1],
					$radius[2],
					$radius[3],
					$radius[4]
				),
			)
		);

		$this->get_responsive_styles(
			$padding,
			$selector,
			array('primary' => 'padding'),
			array('default' => '0px|0px|0px|0px'),
			$render_slug
		);

		$this->get_responsive_styles(
			$margin,
			$selector,
			array('primary' => 'margin'),
			array('default' => '0px|0px|0px|0px'),
			$render_slug
		);
	}

	public function apply_css($render_slug)
	{
		$type                 = $this->props['type'];
		$bg_text              = $this->props['bg_text'];
		$border_color         = $this->props['border_color'];
		$border_type          = $this->props['border_type'];
		$border_weight        = $this->props['border_weight'];
		$use_border           = $this->props['use_border'];
		$border_height        = $this->props['border_height'];
		$border_height_alt    = $this->props['border_height_alt'];
		$border_placement     = $this->props['border_placement'];
		$border_radius        = $this->props['border_radius'];
		$use_pos_x_center     = $this->props['use_pos_x_center'];
		$text_alignment       = $this->props['text_alignment'];
		$border_style_pattern = $this->props['border_style_pattern'];
		$border_style_classic = $this->props['border_style_classic'];

		// Border type.
		if ('on' === $use_border) {
			if ('horizontal' === $border_placement) {
				if ('#' === $border_color[0]) {
					$border_color = $this->hex_to_rgb($border_color);
				}

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading-border',
						'declaration' => sprintf(
							'transform: translateY(-50%%) translateX(-50%%);
                        	overflow     : hidden;
                        	border-radius: %1$s;',
							$border_radius
						),
					)
				);
				$this->get_responsive_styles(
					'border_width',
					'%%order_class%% .dtp-heading-border',
					array('primary' => 'width'),
					array('default' => '100px'),
					$render_slug
				);

				$this->get_responsive_styles(
					'border_pos_y',
					'%%order_class%% .dtp-heading-border',
					array('primary' => 'bottom'),
					array('default' => '0px'),
					$render_slug
				);

				if ($use_pos_x_center === 'on') {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-heading-border',
							'declaration' => 'transform: translateY(-50%) translateX(-50%); left: 50%;',
						)
					);
				} else {
					$this->get_responsive_styles(
						'border_pos_x',
						'%%order_class%% .dtp-heading-border',
						array('primary' => 'left'),
						array('default' => '0px'),
						$render_slug
					);
				}

				if ('classic' === $border_type) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-heading-border',
							'declaration' => sprintf(
								'border-top: %1$s %2$s %3$s;',
								$border_weight,
								$border_style_classic,
								$border_color
							),
						)
					);
				} elseif ('pattern' === $border_type) {
					$pattern_bg = $this->get_pattern($border_style_pattern, $border_color, $border_weight);

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-heading-border',
							'declaration' => sprintf(
								'background-image: url("%1$s");
                            	height         : %2$s;
                            	background-size: %2$s 100%%;',
								$pattern_bg,
								$border_height
							),
						)
					);
				}
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading-border',
						'declaration' => sprintf(
							'border-radius: %1$s;
                        	background: %2$s;
                        	height    : %3$s;',
							$border_radius,
							$border_color,
							$border_height_alt
						),
					)
				);

				$this->get_responsive_styles(
					'border_width',
					'%%order_class%% .dtp-heading-border',
					array('primary' => 'width'),
					array('default' => '10px'),
					$render_slug
				);

				$this->get_responsive_styles(
					'border_pos_y',
					'%%order_class%% .dtp-heading-border',
					array('primary' => 'top'),
					array('default' => '0px'),
					$render_slug
				);

				$this->get_responsive_styles(
					'border_pos_x',
					'%%order_class%% .dtp-heading-border',
					array('primary' => 'left'),
					array('default' => '0px'),
					$render_slug
				);
			}
		}

		// bg text.
		if (!empty($bg_text)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-heading:after',
					'declaration' => '
                    content    : attr(data-bg);
                    position   : absolute;
                    z-index    : -1;
                    font-size  : 60px;
                    white-space: nowrap;
                    line-height: 1;
                    transform  : translateY(-50%) translateX(-50%);',
				)
			);

			$this->get_responsive_styles(
				'bg_pos_y',
				'%%order_class%% .dtp-heading:after',
				array('primary' => 'top'),
				array('default' => '50%'),
				$render_slug
			);

			$this->get_responsive_styles(
				'bg_pos_x',
				'%%order_class%% .dtp-heading:after',
				array('primary' => 'left'),
				array('default' => '50%'),
				$render_slug
			);
		}

		// type.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-heading',
				'declaration' => sprintf('flex-direction: %1$s;', $type),
			)
		);

		if ($type === 'row') {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-heading',
					'declaration' => 'align-items: center;',
				)
			);
		}

		// Alignment.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-heading',
				'declaration' => sprintf('text-align: %1$s;', $text_alignment),
			)
		);

		if ($type === 'row') {
			if ($text_alignment === 'right') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading',
						'declaration' => 'justify-content: flex-end;',
					)
				);
			} elseif ($text_alignment === 'center') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading',
						'declaration' => 'justify-content: center;',
					)
				);
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-heading',
					'declaration' => 'width: 100%;',
				)
			);
		} else {
			if ($text_alignment === 'left') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading span',
						'declaration' => 'align-self: flex-start;',
					)
				);
			} elseif ($text_alignment === 'right') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading span',
						'declaration' => 'align-self: flex-end;',
					)
				);
			} elseif ($text_alignment === 'center') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-heading span',
						'declaration' => 'align-self: center;',
					)
				);
			}
		}

		$this->get_text_styles($render_slug, 'bt', '%%order_class%% .dtp-heading-before');
		$this->get_text_styles($render_slug, 'ct', '%%order_class%% .dtp-heading-center');
		$this->get_text_styles($render_slug, 'at', '%%order_class%% .dtp-heading-after');
	}
}

new DTP_Heading();
