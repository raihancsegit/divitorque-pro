<?php

class DTP_Horizontal_Timeline extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_timeline_horizontal';
		$this->child_slug = 'torq_timeline_horizontal_child';
		$this->name       = esc_html__('Torq Horizontal Timeline', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'timeline.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'icon'    => esc_html__('Icon', 'divitorque'),
					'content' => esc_html__('Content', 'divitorque'),
					'image'   => esc_html__('Image', 'divitorque'),
					'texts'   => array(
						'title'             => esc_html__('Texts', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'date'        => array(
								'name' => esc_html__('Date', 'divitorque'),
							),
							'title'       => array(
								'name' => esc_html__('Title', 'divitorque'),
							),
							'description' => array(
								'name' => esc_html__('Description', 'divitorque'),
							),
						),
					),
					'nav'     => array(
						'title'             => esc_html__('Navigation', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'nav_common' => array(
								'name' => esc_html__('Common', 'divitorque'),
							),
							'nav_left'   => array(
								'name' => esc_html__('Left', 'divitorque'),
							),
							'nav_right'  => array(
								'name' => esc_html__('Right', 'divitorque'),
							),
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'icon'        => array(
				'label'    => esc_html__('Icon', 'brain-divi-addons'),
				'selector' => '%%order_class%% .dtp-horizontal-timeline-icon',
			),
			'title'       => array(
				'label'    => esc_html__('Title', 'brain-divi-addons'),
				'selector' => '%%order_class%% .dtp-horizontal-timeline-title h4',
			),
			'description' => array(
				'label'    => esc_html__('Description', 'brain-divi-addons'),
				'selector' => '%%order_class%% .dtp-horizontal-timeline-desc',
			),
			'date'        => array(
				'label'    => esc_html__('Date', 'brain-divi-addons'),
				'selector' => '%%order_class%% .dtp-horizontal-timeline-date',
			),
			'image'       => array(
				'label'    => esc_html__('Image', 'brain-divi-addons'),
				'selector' => '%%order_class%% .dtp-horizontal-timeline-figure img',
			),
			'nav_prev'    => array(
				'label'    => esc_html__('Prev (Navigation)', 'brain-divi-addons'),
				'selector' => '%%order_class%% .slick-arrow.slick-prev',
			),
			'nav_next'    => array(
				'label'    => esc_html__('Next (Navigation)', 'brain-divi-addons'),
				'selector' => '%%order_class%% .slick-arrow.slick-next',
			),
		);
	}

	public function get_fields()
	{
		$settings = array(
			'content_placement' => array(
				'label'          => esc_html__('Content Placement', 'divitorque'),
				'description'    => esc_html__('Here you can define content placement.', 'divitorque'),
				'type'           => 'select',
				'toggle_slug'    => 'settings',
				'mobile_options' => true,
				'default'        => 'both',
				'options'        => array(
					'top'    => esc_html__('Top', 'divitorque'),
					'bottom' => esc_html__('Bottom', 'divitorque'),
					'both'   => esc_html__('Both', 'divitorque'),
				),
			),
			'use_arrow'         => array(
				'label'           => esc_html__('Use Content Arrow', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether arrow should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
			),
			'is_infinite'       => array(
				'label'           => esc_html__('Infinite Looping', 'divitorque'),
				'description'     => esc_html__('Choose whether the endless of times sliding should be played or not.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'show_if_not'     => array(
					'content_placement' => 'both',
				),
			),
			'slide_count'       => array(
				'label'          => esc_html__('Item to Show', 'divitorque'),
				'description'    => esc_html__('Define how many items you want to display in the carousel.', 'divitorque'),
				'type'           => 'select',
				'toggle_slug'    => 'settings',
				'mobile_options' => true,
				'default'        => '2',
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
			),
			'is_autoplay'       => array(
				'label'       => esc_html__('Autoplay', 'divitorque'),
				'description' => esc_html__('Here you can choose whether autoplay should be used.', 'divitorque'),
				'type'        => 'yes_no_button',
				'default'     => 'on',
				'toggle_slug' => 'settings',
				'sub_toggle'  => 'general',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),
			'autoplay_speed'    => array(
				'label'          => esc_html__('Autoplay Speed', 'divitorque'),
				'description'    => esc_html__('Here you can define sliding autoplay speed for the carousel.', 'divitorque'),
				'type'           => 'range',
				'default'        => '2000ms',
				'fixed_unit'     => 'ms',
				'toggle_slug'    => 'settings',
				'sub_toggle'     => 'general',
				'range_settings' => array(
					'step' => 100,
					'min'  => 0,
					'max'  => 10000,
				),
				'show_if'        => array('is_autoplay' => 'on'),
			),
			'animation_speed'   => array(
				'label'          => esc_html__('Sliding Speed', 'divitorque'),
				'description'    => esc_html__('Here you can define sliding Speed.', 'divitorque'),
				'type'           => 'range',
				'default'        => '700ms',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 50,
					'max'  => 20000,
				),
				'toggle_slug'    => 'settings',
			),
			'slide_spacing'     => array(
				'label'          => esc_html__('Spacing Spacing Between', 'divitorque'),
				'description'    => esc_html__('Here you can define spaces between carousel items.', 'divitorque'),
				'type'           => 'range',
				'default'        => '30px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'settings',
			),
		);

		$navigation = array(
			'nav_pos_y'           => array(
				'label'           => esc_html__('Vertical Position', 'divitorque'),
				'description'     => esc_html__('Define a value for the navigation vertical placement.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '48px',
				'default_unit'    => '%',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 1000,
				),
				'show_if_not'     => array('content_placement' => 'both'),
			),
			'nav_height'          => array(
				'label'           => esc_html__('Height', 'divitorque'),
				'description'     => esc_html__('Here you can define custom height for the navigation buttons.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '40px',
				'fixed_unit'      => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
			),
			'nav_width'           => array(
				'label'           => esc_html__('Width', 'divitorque'),
				'description'     => esc_html__('Here you can define custom width for the navigation buttons.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '40px',
				'fixed_unit'      => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
			),
			'nav_icon_size'       => array(
				'label'           => esc_html__('Icon Size', 'divitorque'),
				'description'     => esc_html__('Define icon size for the navigation.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '30px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 200,
				),
			),
			'nav_color'           => array(
				'label'       => esc_html__('Icon Color', 'divitorque'),
				'description' => esc_html__('Pick a color for the navigation icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'nav',
				'default'     => '#333',
				'sub_toggle'  => 'nav_common',
				'hover'       => 'tabs',
			),
			'nav_bg'              => array(
				'label'       => esc_html__('Background', 'divitorque'),
				'description' => esc_html__('Pick a color to use for navigation background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'nav',
				'default'     => '#ddd',
				'sub_toggle'  => 'nav_common',
				'hover'       => 'tabs',
			),
			'nav_border_width'    => array(
				'label'           => esc_html__('Border Width', 'divitorque'),
				'description'     => esc_html__('Define border width for the navigation.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '0px',
				'default_unit'    => 'px',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_common',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),
			'nav_border_color'    => array(
				'label'       => esc_html__('Border Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for navigation border.', 'divitorque'),
				'type'        => 'color-alpha',
				'default'     => '#333',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
				'hover'       => 'tabs',
			),
			'nav_border_style'    => array(
				'label'       => esc_html__('Border Type', 'divitorque'),
				'description' => esc_html__('Borders support various different styles, each of which will change the shape of the border element.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'solid',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_common',
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
			),

			// Left Arrow.
			'icon_left'           => array(
				'label'           => esc_html__('Prev Icon', 'divitorque'),
				'description'     => esc_html__('Define custom icon for the prev navigation button.', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_left',
			),

			'left_border_radius'  => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the prev nav. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'default'     => 'on|40px|40px|40px|40px',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_left',
			),

			// Right Arrow.
			'icon_right'          => array(
				'label'           => esc_html__('Next Icon', 'divitorque'),
				'description'     => esc_html__('Define custom icon for the next navigation button.', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'nav',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'nav_right',
			),

			'right_border_radius' => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the next nav. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'default'     => 'on|40px|40px|40px|40px',
				'toggle_slug' => 'nav',
				'tab_slug'    => 'advanced',
				'sub_toggle'  => 'nav_right',
			),
		);

		$content = array(
			'content_alignment' => array(
				'label'            => esc_html__('Alignment', 'divitorque'),
				'description'      => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'content',
				'tab_slug'         => 'advanced',
			),
			'content_padding'   => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the primary content. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'content',
				'default'        => '25px|25px|25px|25px',
			),
			'arrow_color'       => array(
				'label'       => esc_html__('Arrow Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the arrow.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'content',
				'default'     => '#efefef',
			),
		);

		$image = array(
			'image_spacing' => array(
				'label'          => esc_html__('Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of the image.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),
			'image_height'  => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('This sets a static height value for your image.', 'divitorque'),
				'type'           => 'range',
				'default'        => 'auto',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),
			'image_width'   => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('This sets a static width value for your image.', 'divitorque'),
				'type'           => 'range',
				'default'        => '100%',
				'mobile_options' => true,
				'default_unit'   => '%',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),
			'image_radius'  => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the image. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'default'     => 'off|0|0|0|0',
				'toggle_slug' => 'image',
				'tab_slug'    => 'advanced',
			),
		);

		$icon = array(
			'icon_position' => array(
				'label'       => esc_html__('Position', 'divitorque'),
				'description' => esc_html__('Here you can define icon placement.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => 'left',
				'options'     => array(
					'right'  => esc_html__('Right', 'divitorque'),
					'center' => esc_html__('Center', 'divitorque'),
					'left'   => esc_html__('Left', 'divitorque'),
				),
			),
			'icon_size'     => array(
				'label'          => esc_html__('Size', 'divitorque'),
				'description'    => esc_html__('Control the size of the icon by increasing or decreasing the range.', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
			'icon_color'    => array(
				'label'       => esc_html__('Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => '#333333',
			),
			'icon_height'   => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('This sets a static height value for your icon box.', 'divitorque'),
				'type'           => 'range',
				'default'        => '50px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
			'icon_width'    => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('This sets a static width value for your icon box.', 'divitorque'),
				'type'           => 'range',
				'default'        => '50px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
			'icon_spacing'  => array(
				'label'          => esc_html__('Spacing', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top/bottom of the icon.', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
			'line_color'    => array(
				'label'       => esc_html__('Line Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the line background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => '#efefef',
			),
			'line_width'    => array(
				'label'          => esc_html__('Line Thickness', 'divitorque'),
				'description'    => esc_html__('Define a value for the line thickness.', 'divitorque'),
				'type'           => 'range',
				'default'        => '2px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),
		);

		$texts = array(
			'title_spacing_bottom' => array(
				'label'           => esc_html__('Title Spacing Bottom', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom spacing at the bottom of the title.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => '10px',
				'fixed_unit'      => 'px',
				'toggle_slug'     => 'texts',
				'tab_slug'        => 'advanced',
				'sub_toggle'      => 'title',
				'mobile_options'  => true,
				'range_settings'  => array(
					'step' => 1,
					'min'  => 0,
					'max'  => 100,
				),
			),
		);

		$content_bg = $this->custom_background_fields('content', 'Content', 'advanced', 'content', array('color', 'gradient', 'image', 'hover'), array(), '#efefef');
		$icon_bg    = $this->custom_background_fields('icon', '', 'advanced', 'icon', array('color', 'gradient', 'hover'), array(), '#efefef');

		return array_merge($settings, $navigation, $image, $content, $content_bg, $icon, $icon_bg, $texts);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['fonts']       = array();
		$advanced_fields['text_shadow'] = array();

		$advanced_fields['box_shadow']['content'] = array(
			'css'         => array(
				'main'      => '%%order_class%% .dtp-horizontal-timeline-content',
				'important' => 'all',
			),
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'content',
		);

		$advanced_fields['borders']['content'] = array(
			'toggle_slug' => 'content',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-horizontal-timeline-content',
					'border_styles' => '%%order_class%% .dtp-horizontal-timeline-content',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-horizontal-timeline-icon',
					'border_styles' => '%%order_class%% .dtp-horizontal-timeline-icon',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii' => 'on|6px|6px|6px|6px',
			),
		);

		$advanced_fields['box_shadow']['icon'] = array(
			'css'         => array(
				'main'      => '%%order_class%% .dtp-horizontal-timeline-icon',
				'important' => 'all',
			),
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'icon',
		);
		$advanced_fields['fonts']['title']     = array(
			'label'           => esc_html__('Title', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-horizontal-timeline-title h4',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'font_size'       => array(
				'default' => '18px',
			),
		);

		$advanced_fields['fonts']['description'] = array(
			'label'           => esc_html__('Description', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-horizontal-timeline-desc',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'description',
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['date'] = array(
			'label'           => esc_html__('Date', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-horizontal-timeline-date',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'date',
			'font_size'       => array(
				'default' => '14px',
			),
		);

		return $advanced_fields;
	}

	protected function get_timeline_carousel_options_data()
	{
		$content_placement  = $this->props['content_placement'];
		$is_autoplay        = $this->props['is_autoplay'];
		$autoplay_speed     = $this->props['autoplay_speed'];
		$animation_speed    = $this->props['animation_speed'];
		$is_infinite        = 'on' === $this->props['is_infinite'] ? true : false;
		$icon_left          = esc_html(et_pb_process_font_icon($this->props['icon_left']));
		$icon_left          = !empty($icon_left) ? $icon_left : '4';
		$icon_right         = esc_html(et_pb_process_font_icon($this->props['icon_right']));
		$icon_right         = !empty($icon_right) ? $icon_right : '5';
		$slide_count        = $this->props['slide_count'];
		$slide_count_tablet = $this->props['slide_count_tablet'];
		$slide_count_phone  = $this->props['slide_count_phone'];

		$settings                  = array();
		$settings['responsive']    = array();
		$tablet                    = array();
		$phone                     = array();
		$settings['infinite']      = 'both' !== $content_placement ? $is_infinite : false;
		$settings['autoplay']      = 'on' === $is_autoplay ? true : false;
		$settings['autoplaySpeed'] = intval($autoplay_speed);
		$settings['speed']         = intval($animation_speed);
		$settings['slidesToShow']  = intval($slide_count);
		$settings['prevArrow']     = '<button type="button" data-icon="' . $icon_left . '" class="slick-arrow slick-prev">Prev</button>';
		$settings['nextArrow']     = '<button type="button" data-icon="' . $icon_right . '" class="slick-arrow slick-next">Prev</button>';

		// Responsive break point 980.
		$tablet['breakpoint'] = 980;
		if (!empty($slide_count_tablet)) {
			$tablet['settings']['slidesToShow'] = intval($slide_count_tablet);
		}

		array_push($settings['responsive'], $tablet);

		// Responsive break point 767.
		$phone['breakpoint'] = 767;
		if (!empty($slide_count_phone)) {
			$phone['settings']['slidesToShow'] = intval($slide_count_phone);
		}

		array_push($settings['responsive'], $phone);

		$carousel_options = sprintf('data-settings="%1$s"', htmlspecialchars(wp_json_encode($settings), ENT_QUOTES, 'UTF-8'));

		return $carousel_options;
	}

	protected function get_options_data()
	{
		$opts                      = array();
		$opts['content_placement'] = $this->props['content_placement'];
		$opts['icon_height']       = $this->props['icon_height'];
		$opts['icon_spacing']      = $this->props['icon_spacing'];

		$options = sprintf('data-options="%1$s"', htmlspecialchars(wp_json_encode($opts), ENT_QUOTES, 'UTF-8'));

		return $options;
	}

	public function render($attrs, $content, $render_slug)
	{
		if (empty($this->props['content'])) {
			return '<div class="dtp-horizontal-timeline dtp-horizontal-timeline-frontend"><h3>No timeline item was added!</h3></div>';
		} else {
			wp_enqueue_script('torq-slick');
			wp_enqueue_style('torq-slick');
			wp_enqueue_script('torq-horizontal-timeline');
			wp_enqueue_style('torq-horizontal-timeline');
			$this->render_module_css($render_slug);
			$order_class  = self::get_module_order_class($render_slug);
			$order_number = str_replace('_', '', str_replace($this->slug, '', $order_class));

			return sprintf(
				'<div id="dtp-horizontal-timeline-%5$s" class="dtp-horizontal-timeline dtp-horizontal-timeline-frontend %3$s" %2$s %4$s>
				%1$s
			</div>',
				$this->props['content'],
				$this->get_timeline_carousel_options_data(),
				$this->props['content_placement'],
				$this->get_options_data(),
				$order_number
			);
		}
	}

	protected function render_module_css($render_slug)
	{
		$this->render_nav_css($render_slug);
		dtp_inject_fa_icons($this->props['icon_left']);
		dtp_inject_fa_icons($this->props['icon_right']);

		$image_radius      = explode('|', $this->props['image_radius']);
		$icon_size         = $this->props['icon_size'];
		$icon_color        = $this->props['icon_color'];
		$icon_height       = $this->props['icon_height'];
		$icon_width        = $this->props['icon_width'];
		$line_width        = $this->props['line_width'];
		$line_color        = $this->props['line_color'];
		$content_alignment = $this->props['content_alignment'];
		$use_arrow         = $this->props['use_arrow'];
		$arrow_color       = $this->props['arrow_color'];
		$icon_position     = $this->props['icon_position'];
		$content_placement = $this->props['content_placement'];

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'icon_left',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-horizontal-timeline .slick-prev:before',
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
				'selector'       => '%%order_class%% .dtp-horizontal-timeline .slick-next:before',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		if ('on' === $use_arrow) {
			if ('both' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(even) .dtp-horizontal-timeline-content-wrap',
						'declaration' => 'transform: translateY(15px);',
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(odd) .dtp-horizontal-timeline-content-wrap',
						'declaration' => 'transform: translateY(-15px);',
					)
				);
			} elseif ('top' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-content-wrap',
						'declaration' => 'transform: translateY(-15px);padding-top: 15px;',
					)
				);
			} elseif ('bottom' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-content-wrap',
						'declaration' => 'transform: translateY(15px);padding-bottom: 15px;',
					)
				);
			}
		}

		if ('bottom' === $content_placement) {
			$this->get_responsive_styles(
				'nav_pos_y',
				'%%order_class%% .dtp-horizontal-timeline .slick-arrow',
				array('primary' => 'top'),
				array('default' => '48px'),
				$render_slug
			);
		} elseif ('top' === $content_placement) {
			$this->get_responsive_styles(
				'nav_pos_y',
				'%%order_class%% .dtp-horizontal-timeline .slick-arrow',
				array('primary' => 'bottom'),
				array('default' => '48px'),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow',
					'declaration' => 'top: auto!important;',
				)
			);
		}

		$this->get_responsive_styles(
			'slide_spacing',
			'%%order_class%% .dtp-horizontal-timeline .slick-slide',
			array('primary' => 'padding-left'),
			array('default' => '30px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'slide_spacing',
			'%%order_class%% .dtp-horizontal-timeline .slick-slide',
			array('primary' => 'padding-right'),
			array('default' => '30px'),
			$render_slug
		);

		if ('left' === $icon_position) {
			if ('both' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(odd) .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'left:calc(%1$s/2);transform: translateY(-50%%) translateX(-7px) rotate(45deg)!important;',
							$icon_width
						),
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(even) .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'left:calc(%1$s/2);transform: translateY(50%%) translateX(-7px) rotate(45deg)!important;',
							$icon_width
						),
					)
				);
			} elseif ('top' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'left:calc(%1$s/2);transform: translateY(-50%%) translateX(-7px) rotate(45deg)!important;',
							$icon_width
						),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'left:calc(%1$s/2);transform: translateY(50%%) translateX(-7px) rotate(45deg)!important;',
							$icon_width
						),
					)
				);
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-date',
					'declaration' => 'text-align: left;',
				)
			);
		} elseif ('right' === $icon_position) {
			if ('both' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(odd) .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'right:calc(%1$s/2);transform: translateY(-50%%) translateX(7px) rotate(45deg);',
							$icon_width
						),
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(even) .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'right:calc(%1$s/2);transform: translateY(50%%) translateX(7px) rotate(45deg);',
							$icon_width
						),
					)
				);
			} elseif ('top' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'right:calc(%1$s/2);transform: translateY(-50%%) translateX(7px) rotate(45deg);',
							$icon_width
						),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-arrow',
						'declaration' => sprintf(
							'right:calc(%1$s/2);transform: translateY(50%%) translateX(7px) rotate(45deg);',
							$icon_width
						),
					)
				);
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-icon',
					'declaration' => 'margin-left: auto;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-date',
					'declaration' => 'text-align: right;',
				)
			);
		} else {
			if ('both' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(odd) .dtp-horizontal-timeline-arrow',
						'declaration' => 'left:50%; transform: translateY(-50%) translateX(-7px) rotate(45deg);',
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide:nth-child(even) .dtp-horizontal-timeline-arrow',
						'declaration' => 'left:50%; transform: translateY(50%) translateX(-7px) rotate(45deg);',
					)
				);
			} elseif ('top' === $content_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .slick-slide .dtp-horizontal-timeline-arrow',
						'declaration' => 'left:50%; transform: translateY(-50%) translateX(-7px) rotate(45deg);',
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-arrow',
						'declaration' => 'left:50%; transform: translateY(50%) translateX(-7px) rotate(45deg);',
					)
				);
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-icon',
					'declaration' => 'margin-left: auto; margin-right: auto;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-date',
					'declaration' => 'text-align: center;',
				)
			);
		}

		// Content.
		if ('off' === $use_arrow) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-arrow',
					'declaration' => 'display:none;opacity:0;',
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-arrow,%%order_class%% .dtp-horizontal-timeline .dtp-horizontal-timeline-arrow:before',
					'declaration' => sprintf('background-color:%1$s;', $arrow_color),
				)
			);
		}

		$this->get_responsive_styles(
			'content_padding',
			'%%order_class%% .dtp-horizontal-timeline-content',
			array('primary' => 'padding'),
			array('default' => '25px|25px|25px|25px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline-content',
				'declaration' => sprintf('text-align:%1$s;', $content_alignment),
			)
		);

		$this->get_custom_bg_style($render_slug, 'content', '%%order_class%% .dtp-horizontal-timeline-content', '%%order_class%% .dtp-horizontal-timeline-item:hover .dtp-horizontal-timeline-content');

		$this->get_responsive_styles(
			'title_spacing_bottom',
			'%%order_class%% .dtp-horizontal-timeline-title',
			array('primary' => 'margin-bottom'),
			array('default' => '10px'),
			$render_slug
		);

		// Icon.
		$this->get_responsive_styles(
			'icon_spacing',
			'%%order_class%% .dtp-horizontal-timeline-icon',
			array('primary' => 'margin-top'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'icon_spacing',
			'%%order_class%% .dtp-horizontal-timeline-icon',
			array('primary' => 'margin-bottom'),
			array('default' => '15px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline-icon-wrap:before',
				'declaration' => sprintf(
					'background-color:%1$s;
					height:%2$s;',
					$line_color,
					$line_width
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline-icon',
				'declaration' => sprintf(
					'color:%1$s;
					font-size:%2$s;
					height:%3$s;
					width:%3$s;',
					$icon_color,
					$icon_size,
					$icon_height,
					$icon_width
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline-icon img',
				'declaration' => sprintf('width:%1$s;', $icon_size),
			)
		);

		$this->get_custom_bg_style($render_slug, 'icon', '%%order_class%% .dtp-horizontal-timeline-icon', '%%order_class%% .dtp-horizontal-timeline-item:hover .dtp-horizontal-timeline-icon');

		// Image.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline-figure',
				'declaration' => sprintf(
					'border-radius:%1$s %2$s %3$s %4$s;',
					$image_radius[1],
					$image_radius[2],
					$image_radius[3],
					$image_radius[4]
				),
			)
		);

		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .dtp-horizontal-timeline-figure',
			array('primary' => 'height'),
			array('default' => 'auto'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_width',
			'%%order_class%% .dtp-horizontal-timeline-figure',
			array('primary' => 'width'),
			array('default' => '100%'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_spacing',
			'%%order_class%% .dtp-horizontal-timeline-figure',
			array('primary' => 'margin-bottom'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .dtp-horizontal-timeline-figure img',
			array('primary' => 'height'),
			array('default' => 'auto'),
			$render_slug
		);

		if ('both' === $content_placement) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .slick-slide:nth-child(even) .dtp-horizontal-timeline-item',
					'declaration' => 'padding-top: calc(var(--main-height) - var(--header-height));',
				)
			);
		}
	}

	protected function render_nav_css($render_slug)
	{
		$nav_height                      = $this->props['nav_height'];
		$nav_height_tablet               = $this->props['nav_height_tablet'];
		$nav_height_phone                = $this->props['nav_height_phone'];
		$nav_height_last_edited          = $this->props['nav_height_last_edited'];
		$nav_height_responsive_status    = et_pb_get_responsive_status($nav_height_last_edited);
		$nav_width                       = $this->props['nav_width'];
		$nav_width_tablet                = $this->props['nav_width_tablet'] ? $this->props['nav_width_tablet'] : $nav_width;
		$nav_width_phone                 = $this->props['nav_width_phone'] ? $this->props['nav_width_phone'] : $nav_width_tablet;
		$nav_width_last_edited           = $this->props['nav_width_last_edited'];
		$nav_width_responsive_status     = et_pb_get_responsive_status($nav_width_last_edited);
		$nav_border_width                = $this->props['nav_border_width'];
		$nav_border_style                = $this->props['nav_border_style'];
		$nav_border_color                = $this->props['nav_border_color'];
		$nav_border_color_hover          = $this->get_hover_value('nav_border_color');
		$nav_color                       = $this->props['nav_color'];
		$nav_bg                          = $this->props['nav_bg'];
		$nav_color_hover                 = $this->get_hover_value('nav_color');
		$nav_bg_hover                    = $this->get_hover_value('nav_bg');
		$nav_icon_size_tablet            = $this->props['nav_icon_size_tablet'];
		$nav_icon_size_phone             = $this->props['nav_icon_size_phone'];
		$nav_icon_size_last_edited       = $this->props['nav_icon_size_last_edited'];
		$nav_icon_size_responsive_status = et_pb_get_responsive_status($nav_icon_size_last_edited);
		$nav_icon_size                   = $this->props['nav_icon_size'];
		$right_border_radius             = explode('|', $this->props['right_border_radius']);
		$left_border_radius              = explode('|', $this->props['left_border_radius']);

		// Arrow.
		$this->get_responsive_styles(
			'nav_pos_y',
			'%%order_class%% .dtp-horizontal-timeline .slick-arrow',
			array('primary' => 'top'),
			array('default' => '48px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow',
				'declaration' => sprintf(
					'height: %1$s; width: %2$s; color: %3$s; background: %4$s; border: %5$s %6$s %7$s;',
					$nav_height,
					$nav_width,
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
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow:hover',
					'declaration' => sprintf('color: %1$s;', $nav_color_hover),
				)
			);
		}

		if ($nav_bg_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow:hover',
					'declaration' => sprintf('background: %1$s;', $nav_bg_hover),
				)
			);
		}

		if ($nav_border_color_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow:hover',
					'declaration' => sprintf('border-color: %1$s;', $nav_border_color_hover),
				)
			);
		}

		// Arrow Responsive Height.
		if (!empty($nav_height_tablet) && $nav_height_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow',
					'declaration' => sprintf('height: %1$s; ', $nav_height_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);
		endif;

		if (!empty($nav_height_phone) && $nav_height_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow',
					'declaration' => sprintf('height: %1$s; ', $nav_height_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;

		// Arrow Responsive Width.
		if (!empty($nav_width_tablet) && $nav_width_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf(' width: %1$s; ', $nav_width_tablet),
				)
			);
		endif;

		if (!empty($nav_width_phone) && $nav_width_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow',
					'declaration' => sprintf('width: %1$s; ', $nav_width_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;

		// Arrow Icon.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow:before',
				'declaration' => sprintf(
					'font-size: %1$s;display: inline-block;',
					$nav_icon_size
				),
			)
		);

		// Arrow Icon Responsive.
		if (!empty($nav_icon_size_tablet) && $nav_icon_size_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow:before',
					'declaration' => sprintf(' font-size: %1$s; ', $nav_icon_size_tablet),
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				)
			);
		endif;

		if (!empty($nav_icon_size_phone) && $nav_icon_size_responsive_status) :
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-arrow:before',
					'declaration' => sprintf(' font-size: %1$s; ', $nav_icon_size_phone),
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				)
			);
		endif;

		// Arrow Border Radius.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-next',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$right_border_radius[1],
					$right_border_radius[2],
					$right_border_radius[3],
					$right_border_radius[4]
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-horizontal-timeline .slick-prev',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$left_border_radius[1],
					$left_border_radius[2],
					$left_border_radius[3],
					$left_border_radius[4]
				),
			)
		);
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Timeline Item', 'divitorque');
	}
}

new DTP_Horizontal_Timeline();
