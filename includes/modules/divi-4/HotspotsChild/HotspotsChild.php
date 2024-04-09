<?php
class DTP_Hotspots_Child extends DTP_Builder_Module
{
	public function init()
	{
		$this->slug                     = 'torq_hotspot_child';
		$this->vb_support               = 'on';
		$this->type                     = 'child';
		$this->child_title_var          = 'admin_title';
		$this->child_title_fallback_var = 'tooltip_title';
		$this->name                     = esc_html__('Hotspot', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'spot'     => esc_html__('Spot', 'divitorque'),
					'tooltip'  => esc_html__('Tooltip', 'divitorque'),
					'settings' => array(
						'title'             => esc_html__('Settings', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'spot'    => array(
								'name' => esc_html__('Spot', 'divitorque'),
							),
							'tooltip' => array(
								'name' => esc_html__('Tooltip', 'divitorque'),
							),
						),
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'spot'           => esc_html__('Spot', 'divitorque'),
					'spot_text'      => esc_html__('Spot Text', 'divitorque'),
					'tooltip'        => esc_html__('Tooltip', 'divitorque'),
					'tooltip_media'  => esc_html__('Tooltip Media', 'divitorque'),
					'tooltip_text'   => array(
						'title'             => esc_html__('Tooltip Texts', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title' => array(
								'name' => esc_html__('Title', 'divitorque'),
							),
							'desc'  => array(
								'name' => esc_html__('Description', 'divitorque'),
							),
						),
					),
					'tooltip_button' => esc_html__('Tooltip Button', 'divitorque'),
					'box_shadow'     => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'      => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '.dtp-hotspot %%order_class%% .dtp-hotspots img',
			),
			'spot'       => array(
				'label'    => esc_html__('Spot', 'divitorque'),
				'selector' => '.dtp-hotspot %%order_class%% .torq_hotspot_child',
			),
			'spot_inner' => array(
				'label'    => esc_html__('Spot Inner', 'divitorque'),
				'selector' => '.dtp-hotspot %%order_class%% .dtp-hotspot-label',
			),
			'spot_icon'  => array(
				'label'    => esc_html__('Spot Icon', 'divitorque'),
				'selector' => '.dtp-hotspot %%order_class%% .dtp-hotspot-label i',
			),
			'wave'       => array(
				'label'    => esc_html__('Animated Wave', 'divitorque'),
				'selector' => '.dtp-hotspot %%order_class%% .torq_hotspot_child:before',
			),
		);
	}

	public function get_fields()
	{
		$spot_content = array(
			'spot_type'      => array(
				'label'       => esc_html__('Spot Type', 'divitorque'),
				'description' => esc_html__('Define spot type.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'spot',
				'default'     => 'icon',
				'options'     => array(
					'icon'  => esc_html__('Icon', 'divitorque'),
					'text'  => esc_html__('Text', 'divitorque'),
					'image' => esc_html__('Image', 'divitorque'),
				),
			),
			'spot_icon'      => array(
				'label'       => esc_html__('Select Icon', 'divitorque'),
				'description' => esc_html__('Choose an icon to display with your spot.', 'divitorque'),
				'type'        => 'select_icon',
				'toggle_slug' => 'spot',
				'show_if'     => array(
					'spot_type' => 'icon',
				),
			),
			'spot_image'     => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'spot',
				'show_if'            => array(
					'spot_type' => 'image',
				),
			),
			'spot_image_alt' => array(
				'label'           => esc_html__('Image Alt Text', 'divitorque'),
				'description'     => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'spot',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'spot_type' => 'image',
				),
			),
			'spot_text'      => array(
				'label'           => esc_html__('Spot Text', 'divitorque'),
				'description'     => esc_html__('Define the spot text for your hotspot.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'spot',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'spot_type' => 'text',
				),
			),
		);

		$tooltip_content = array(
			'media_type'          => array(
				'label'       => esc_html__('Media Type', 'divitorque'),
				'description' => esc_html__('Define media type for your tooltip.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'tooltip',
				'default'     => 'none',
				'options'     => array(
					'none'  => esc_html__('None', 'divitorque'),
					'icon'  => esc_html__('Icon', 'divitorque'),
					'image' => esc_html__('Image', 'divitorque'),
				),
			),
			'tooltip_icon'        => array(
				'label'       => esc_html__('Select Icon', 'divitorque'),
				'description' => esc_html__('Choose an icon to display with your tooltip.', 'divitorque'),
				'type'        => 'select_icon',
				'toggle_slug' => 'tooltip',
				'show_if'     => array(
					'media_type' => 'icon',
				),
			),
			'tooltip_image'       => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'tooltip',
				'show_if'            => array(
					'media_type' => 'image',
				),
			),
			'tooltip_image_alt'   => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'tooltip',
				'show_if'     => array(
					'media_type' => 'image',
				),
			),
			'tooltip_title'       => array(
				'label'           => esc_html__('Title', 'divitorque'),
				'description'     => esc_html__('Input the title text for your tooltip.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'tooltip',
				'dynamic_content' => 'text',
			),
			'tooltip_description' => array(
				'label'           => esc_html__('Description', 'divitorque'),
				'description'     => esc_html__('Input the description text for your tooltip.', 'divitorque'),
				'type'            => 'textarea',
				'toggle_slug'     => 'tooltip',
				'dynamic_content' => 'text',
			),
			'use_button'          => array(
				'label'           => esc_html__('Use Button', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether button should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'tooltip',
			),
			'button_text'         => array(
				'label'           => esc_html__('Button Text', 'divitorque'),
				'description'     => esc_html__('Define the button text for your button.', 'divitorque'),
				'type'            => 'text',
				'default'         => 'Click Here',
				'toggle_slug'     => 'tooltip',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'button_link'         => array(
				'label'           => esc_html__('Button Link', 'divitorque'),
				'description'     => esc_html__('Define the button link url for your button.', 'divitorque'),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'tooltip',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'is_new_window'       => array(
				'label'           => esc_html__('Open Button link in new window', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether button URL should be opened in new window.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'tooltip',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
		);

		$settings = array(
			'use_animation'     => array(
				'label'           => esc_html__('Use Animation', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether animation should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'spot',
			),
			'spot_pos_y'        => array(
				'label'       => esc_html__('Vertical Position', 'divitorque'),
				'description' => esc_html__('Define vertical position for the spot.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'spot',
				'default'     => 'top',
				'options'     => array(
					'top'    => esc_html__('Top', 'divitorque'),
					'bottom' => esc_html__('Bottom', 'divitorque'),
				),
			),
			'spot_offset_y'     => array(
				'label'          => esc_html__('Vertical Offset', 'divitorque'),
				'description'    => esc_html__('Set vertical offset value for the spot.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => '%',
				'default'        => '40%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'settings',
				'tab_slug'       => 'general',
				'sub_toggle'     => 'spot',
			),
			'spot_pos_x'        => array(
				'label'       => esc_html__('Horizontal Position', 'divitorque'),
				'description' => esc_html__('Define horizontal position for the spot.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'spot',
				'default'     => 'left',
				'options'     => array(
					'left'  => esc_html__('Left', 'divitorque'),
					'right' => esc_html__('Right', 'divitorque'),
				),
			),
			'spot_offset_x'     => array(
				'label'          => esc_html__('Horizontal Offset', 'divitorque'),
				'description'    => esc_html__('Set horizontal offset value for the spot.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => '%',
				'default'        => '40%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'settings',
				'tab_slug'       => 'general',
				'sub_toggle'     => 'spot',
			),

			'tooltip_event'     => array(
				'label'       => esc_html__('Trigger Event', 'divitorque'),
				'description' => esc_html__('Here you can define tooltip trigger event.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'tooltip',
				'default'     => 'mouseenter',
				'options'     => array(
					'mouseenter' => esc_html__('Mouse Hover', 'divitorque'),
					'click'      => esc_html__('Mouse Click', 'divitorque'),
				),
			),
			'tooltip_placement' => array(
				'label'       => esc_html__('Placement', 'divitorque'),
				'description' => esc_html__('Define tooltip placement.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'tooltip',
				'default'     => 'bottom',
				'options'     => array(
					'top'    => esc_html__('Top', 'divitorque'),
					'bottom' => esc_html__('Bottom', 'divitorque'),
					'left'   => esc_html__('Left', 'divitorque'),
					'right'  => esc_html__('Right', 'divitorque'),
				),
			),
			'tooltip_animation' => array(
				'label'       => esc_html__('Animation', 'divitorque'),
				'description' => esc_html__('Define tooltip animation.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'tab_slug'    => 'general',
				'sub_toggle'  => 'tooltip',
				'default'     => 'top',
				'options'     => array(
					'fade'                 => esc_html__('Fade', 'divitorque'),
					'scale'                => esc_html__('Scale', 'divitorque'),
					'perspective'          => esc_html__('Perspective', 'divitorque'),
					'shift-away-extreme'   => esc_html__('Shift Away', 'divitorque'),
					'shift-toward-extreme' => esc_html__('Shift Toward', 'divitorque'),
				),
			),
			'use_arrow'         => array(
				'label'           => esc_html__('Use Arrow', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether arrow should be displayed.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'tab_slug'        => 'general',
				'sub_toggle'      => 'tooltip',
			),
		);

		$spot = array(
			'spot_height'     => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define custom height for the spot.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'spot',
				'tab_slug'       => 'advanced',
			),
			'spot_width'      => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define custom width for the spot.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'spot',
				'tab_slug'       => 'advanced',
			),
			'spot_icon_color' => array(
				'label'        => esc_html__('Icon Color', 'divitorque'),
				'description'  => esc_html__('Pick a color to use for the spot icon.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'spot',
				'hover'        => 'tabs',
			),
			'spot_icon_size'  => array(
				'label'          => esc_html__('Icon/Image Size', 'divitorque'),
				'description'    => esc_html__('Control the size of the spot icon by increasing or decreasing the range.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'spot',
				'tab_slug'       => 'advanced',
			),
			'wave_bg'         => array(
				'label'        => esc_html__('Animated Wave Color', 'divitorque'),
				'description'  => esc_html__('.', 'divitorque'),
				'type'         => 'color-alpha',
				'default'      => '#ffffff',
				'custom_color' => true,
				'toggle_slug'  => 'spot',
				'tab_slug'     => 'advanced',
				'show_if'      => array(
					'use_animation' => 'on',
				),
			),
			'wave_radius'     => array(
				'label'       => esc_html__('Wave Border Radius', 'divitorque'),
				'description' => esc_html__('.', 'divitorque'),
				'type'        => 'border-radius',
				'default'     => 'off|50%|50%|50%|50%',
				'toggle_slug' => 'spot',
				'tab_slug'    => 'advanced',
				'show_if'     => array(
					'use_animation' => 'on',
				),
			),
		);

		$tooltip = array(
			'tp_alignment'   => array(
				'label'           => esc_html__('Content Alignment', 'divitorque'),
				'description'     => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'module_align',
				'toggle_slug'     => 'tooltip',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
			),
			'tp_width'       => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define tooltip width.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 600,
				),
				'toggle_slug'    => 'tooltip',
				'tab_slug'       => 'advanced',
			),
			'tp_padding'     => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the tooltip. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'tooltip',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),
			'tp_arrow_color' => array(
				'label'        => esc_html__('Arrow Color', 'divitorque'),
				'description'  => esc_html__('Pick a color to use for the tooltip arrow.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'tooltip',
			),
		);

		$tooltip_media = array(
			'tp_media_color'   => array(
				'label'        => esc_html__('Icon Color', 'divitorque'),
				'description'  => esc_html__('Pick a color to use for the tooltip media icon.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'tooltip_media',
			),
			'tp_media_size'    => array(
				'label'          => esc_html__('Icon/Image Size', 'divitorque'),
				'description'    => esc_html__('Define icon/image size for the tooltip.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'tooltip_media',
				'tab_slug'       => 'advanced',
			),
			'tp_media_height'  => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Define a static height for the tooltip media.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'tooltip_media',
				'tab_slug'       => 'advanced',
			),
			'tp_media_width'   => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Define a static width for the tooltip media.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'tooltip_media',
				'tab_slug'       => 'advanced',
			),
			'tp_media_padding' => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the tooltip media. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'tooltip_media',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),
		);

		$spot_bg = $this->custom_background_fields(
			'spot',
			'',
			'advanced',
			'spot',
			array('color', 'gradient', 'image'),
			array(),
			''
		);

		$spacing = array(
			'tp_title_spacing' => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the title.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'tooltip_text',
				'sub_toggle'     => 'title',
				'tab_slug'       => 'advanced',
			),
			'tp_desc_spacing'  => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the description.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'tooltip_text',
				'sub_toggle'     => 'desc',
				'tab_slug'       => 'advanced',
			),
			'tp_btn_spacing'   => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the button.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'tooltip_button',
				'tab_slug'       => 'advanced',
			),
		);

		$tooltip_bg = $this->custom_background_fields(
			'tooltip',
			'',
			'advanced',
			'tooltip',
			array('color', 'gradient', 'image'),
			array(),
			''
		);

		$tp_media_bg = $this->custom_background_fields(
			'tp_media',
			'',
			'advanced',
			'tooltip_media',
			array('color', 'gradient', 'image'),
			array(),
			''
		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__('Admin Label', 'divitorque'),
				'type'        => 'text',
				'description' => esc_html__('This will change the label of the item', 'divitorque'),
				'toggle_slug' => 'admin_label',
			),
		);

		return array_merge($label, $spot_content, $tooltip_content, $settings, $spot, $spot_bg, $tooltip, $tooltip_media, $tooltip_bg, $tp_media_bg, $spacing);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                   = array();
		$advanced_fields['text']           = array();
		$advanced_fields['borders']        = array();
		$advanced_fields['fonts']          = array();
		$advanced_fields['text_shadow']    = array();
		$advanced_fields['max_width']      = array();
		$advanced_fields['margin_padding'] = array();
		$advanced_fields['background']     = array();
		$advanced_fields['link_options']   = array();

		$advanced_fields['box_shadow']['spot'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'spot',
			'css'         => array(
				'main'      => '.dtp-hotspots %%order_class%% .dtp-hotspot-label',
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['tooltip'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'tooltip',
			'css'         => array(
				'main'      => '.dtp-hotspots %%order_class%% .tippy-box',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['media'] = array(
			'toggle_slug' => 'tooltip_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .tippy-box .dtp-hotspot-tp-figure',
					'border_styles' => '%%order_class%% .tippy-box .dtp-hotspot-tp-figure',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0|0|0|0',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['spot'] = array(
			'toggle_slug' => 'spot',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '.dtp-hotspots %%order_class%% .dtp-hotspot-label',
					'border_styles' => '.dtp-hotspots %%order_class%% .dtp-hotspot-label',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|50%|50%|50%|50%',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['fonts']['spot'] = array(
			'css'             => array(
				'main'      => '.dtp-hotspots %%order_class%% .dtp-hotspot-label-text',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'spot_text',
			'hide_text_align' => true,
		);

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .tippy-box .dtp-hotspot-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'tooltip_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
		);

		$advanced_fields['fonts']['desc'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .tippy-box .dtp-hotspot-desc',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'tooltip_text',
			'sub_toggle'      => 'desc',
			'hide_text_align' => true,
		);

		$advanced_fields['button']['tp_btn'] = array(
			'label'          => esc_html__('Button', 'divitorque'),
			'toggle_slug'    => 'tooltip_button',
			'css'            => array(
				'main'      => '.dtp-hotspots %%order_class%% .dtp-hotspot-btn-wrap .dtp-hotspot-btn',
				'important' => 'all',
			),
			'use_alignment'  => false,
			'hide_icon'      => true,
			'box_shadow'     => array(
				'css' => array(
					'main'      => '.dtp-hotspots %%order_class%% .dtp-hotspot-btn-wrap .dtp-hotspot-btn',
					'important' => 'all',
				),
			),
			'borders'        => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);

		return $advanced_fields;
	}

	public function render_tooltip_title()
	{
		$tooltip_title = $this->props['tooltip_title'];
		if (!empty($tooltip_title)) {
			return sprintf(
				'<h4 class="dtp-hotspot-title">%1$s</h4>',
				$tooltip_title
			);
		}
	}

	public function render_tooltip_description()
	{
		$tooltip_description = $this->props['tooltip_description'];
		if (!empty($tooltip_description)) {
			return sprintf(
				'<div class="dtp-hotspot-desc">%1$s</div>',
				$tooltip_description
			);
		}
	}

	public function render_tooltip_icon()
	{
		$selected_icon = esc_attr(et_pb_process_font_icon($this->props['tooltip_icon']));
		$icon_name     = $selected_icon ? $selected_icon : '';

		return sprintf(
			'<div class="dtp-hotspot-tp-icon">
                <i class="dtp-et-icon">%1$s</i>
            </div>',
			$icon_name
		);
	}

	public function render_tooltip_image()
	{
		return sprintf(
			'<div class="dtp-hotspot-tp-img">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['tooltip_image'],
			$this->props['tooltip_image_alt']
		);
	}

	public function render_media()
	{
		$tooltip_icon  = $this->props['tooltip_icon'];
		$media_type    = $this->props['media_type'];
		$tooltip_image = $this->props['tooltip_image'];

		if ('none' === $media_type) {
			return;
		}

		if (!empty($tooltip_icon) || !empty($tooltip_image)) {
			if ('icon' === $media_type) {
				if (function_exists('dtp_inject_fa_icons')) {
					// Inject Font Awesome Manually!.
					dtp_inject_fa_icons($this->props['tooltip_icon']);
				}

				$media = $this->render_tooltip_icon();
			} elseif ('image' === $media_type) {
				$media = $this->render_tooltip_image();
			}

			return sprintf(
				'<div class="dtp-hotspot-tp-figure">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_spot()
	{
		$spot_type      = $this->props['spot_type'];
		$spot_image     = $this->props['spot_image'];
		$spot_text      = $this->props['spot_text'];
		$spot_image_alt = $this->props['spot_image_alt'];
		$label          = '';

		if ('icon' === $spot_type) {
			$icon_name = esc_attr(et_pb_process_font_icon($this->props['spot_icon']));

			if (function_exists('dtp_inject_fa_icons')) {
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['spot_icon']);
			}

			$label = sprintf(
				'<i class="dtp-et-icon">%1$s</i>',
				$icon_name
			);
		} elseif ('image' === $spot_type) {
			if (!empty($this->props['spot_image'])) {
				$label = sprintf(
					'<img src="%1$s" alt="%2$s"/>',
					$spot_image,
					$spot_image_alt
				);
			}
		} elseif ('text' === $spot_type) {
			$label = sprintf(
				'<div class="dtp-hotspot-label-text">%1$s</div>',
				$spot_text
			);
		}

		return sprintf(
			'<div class="dtp-hotspot-label">%1$s</div>',
			$label
		);
	}

	public function render_hotspot_button()
	{
		if ('on' === $this->props['use_button']) {
			$button_custom = $this->props['custom_tp_btn'];
			$button_text   = isset($this->props['button_text']) ? $this->props['button_text'] : 'Click Here';
			$button_link   = isset($this->props['button_link']) ? $this->props['button_link'] : '#';
			$button_url    = trim($button_link);
			$new_tab       = $this->props['is_new_window'];

			$button_output = $this->render_button(
				array(
					'button_classname' => array('dtp-hotspot-btn'),
					'button_custom'    => $button_custom,
					'button_text'      => $button_text,
					'button_url'       => $button_url,
					'has_wrapper'      => false,
					'url_new_window'   => $new_tab,
				)
			);

			return sprintf(
				'<div class="dtp-hotspot-btn-wrap">
                    %1$s
                </div>',
				$button_output
			);
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_module_css($render_slug);
		$this->remove_classname('et_pb_module');
		$tooltip_event     = $this->props['tooltip_event'];
		$tooltip_placement = $this->props['tooltip_placement'];
		$tooltip_animation = $this->props['tooltip_animation'];
		$use_arrow         = $this->props['use_arrow'];
		$settings          = array();

		$settings['order_class'] = self::get_module_order_class($render_slug);
		$settings['trigger']     = $tooltip_event;
		$settings['placement']   = $tooltip_placement;
		$settings['animation']   = $tooltip_animation;
		$settings['arrow']       = 'on' === $use_arrow ? true : false;

		$data_settings = sprintf('data-settings="%1$s"', htmlspecialchars(wp_json_encode($settings), ENT_QUOTES, 'UTF-8'));

		return sprintf(
			'<div class="dtp-hotspot" %1$s>
				%2$s
				<div class="dtp-hotspot-tooltip">
					%3$s
					%4$s
					%5$s
					%6$s
				</div>
			</div>',
			$data_settings,
			$this->render_spot(),
			$this->render_media(),
			$this->render_tooltip_title(),
			$this->render_tooltip_description(),
			$this->render_hotspot_button()
		);
	}

	protected function render_module_css($render_slug)
	{
		$spot_height           = $this->props['spot_height'];
		$spot_width            = $this->props['spot_width'];
		$spot_icon_size        = $this->props['spot_icon_size'];
		$spot_icon_color       = $this->props['spot_icon_color'];
		$spot_icon_color_hover = $this->get_hover_value('spot_icon_color');
		$tp_width              = $this->props['tp_width'];
		$tp_alignment          = $this->props['tp_alignment'];
		$tp_arrow_color        = $this->props['tp_arrow_color'];
		$tp_padding            = $this->props['tp_padding'];
		$tp_media_color        = $this->props['tp_media_color'];
		$tp_media_size         = $this->props['tp_media_size'];
		$tp_media_height       = $this->props['tp_media_height'];
		$tp_media_width        = $this->props['tp_media_width'];
		$tp_media_padding      = $this->props['tp_media_padding'];
		$tp_title_spacing      = $this->props['tp_title_spacing'];
		$tp_desc_spacing       = $this->props['tp_desc_spacing'];
		$tp_btn_spacing        = $this->props['tp_btn_spacing'];
		$spot_pos_y            = $this->props['spot_pos_y'];
		$spot_pos_x            = $this->props['spot_pos_x'];
		$wave_bg               = $this->props['wave_bg'];
		$wave_radius           = explode('|', $this->props['wave_radius']);

		// Spot.
		if (!empty($spot_height)) {
			$this->get_responsive_styles(
				'spot_height',
				'%%order_class%% .dtp-hotspot .dtp-hotspot-label, .dtp-hotspots %%order_class%%.torq_hotspot_child',
				array(
					'primary'   => 'height',
					'important' => true,
				),
				array('default' => '40px'),
				$render_slug
			);
		}

		if (!empty($spot_width)) {
			$this->get_responsive_styles(
				'spot_width',
				'%%order_class%% .dtp-hotspot .dtp-hotspot-label, .dtp-hotspots %%order_class%%.torq_hotspot_child',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array('default' => '40px'),
				$render_slug
			);
		}

		if (!empty($spot_icon_size)) {
			$this->get_responsive_styles(
				'spot_icon_size',
				'.dtp-hotspots %%order_class%% .dtp-hotspot-label i',
				array(
					'primary'   => 'font-size',
					'important' => true,
				),
				array('default' => '20px'),
				$render_slug
			);

			$this->get_responsive_styles(
				'spot_icon_size',
				'.dtp-hotspots %%order_class%% .dtp-hotspot-label img',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array('default' => '20px'),
				$render_slug
			);
		}

		if (!empty($spot_icon_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-hotspots %%order_class%% .dtp-hotspot-label i',
					'declaration' => sprintf(
						'color:%1$s;',
						$spot_icon_color
					),
				)
			);
		}

		if (!empty($spot_icon_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-hotspots %%order_class%%:hover .dtp-hotspot-label i',
					'declaration' => sprintf(
						'color:%1$s;',
						$spot_icon_color_hover
					),
				)
			);
		}

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'spot_icon',
				'important'      => true,
				'selector'       => '.dtp-hotspots %%order_class%% .dtp-hotspot-label i',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		$this->get_custom_bg_style($render_slug, 'spot', '.dtp-hotspots %%order_class%% .dtp-hotspot-label', '.dtp-hotspots %%order_class%% .dtp-hotspot-label:hover');

		// Tooltip.
		if (!empty($tp_width)) {
			$this->get_responsive_styles(
				'tp_width',
				'body %%order_class%% .tippy-box',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if (!empty($tp_alignment)) {
			$this->get_responsive_styles(
				'tp_alignment',
				'%%order_class%% .tippy-box .tippy-content',
				array(
					'primary'   => 'text-align',
					'important' => true,
				),
				array('default' => 'left'),
				$render_slug
			);
		}

		if (!empty($tp_arrow_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .tippy-box .tippy-arrow',
					'declaration' => sprintf(
						'color:%1$s;',
						$tp_arrow_color
					),
				)
			);
		}

		if (!empty($tp_padding)) {
			$this->get_responsive_styles(
				'tp_padding',
				'body %%order_class%% .tippy-box',
				array(
					'primary'   => 'padding',
					'important' => true,
				),
				array('default' => '0|0|0|0'),
				$render_slug
			);
		}

		$this->get_custom_bg_style($render_slug, 'tooltip', 'body %%order_class%% .tippy-box', 'body %%order_class%% .tippy-box:hover');

		// Tooltip Media.
		if (!empty($tp_media_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .tippy-box .dtp-hotspot-tp-icon i',
					'declaration' => sprintf(
						'color:%1$s;',
						$tp_media_color
					),
				)
			);
		}

		if (!empty($tp_media_size)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .tippy-box .dtp-hotspot-tp-icon i',
					'declaration' => sprintf(
						'font-size:%1$s;',
						$tp_media_size
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .tippy-box .dtp-hotspot-tp-figure img',
					'declaration' => sprintf(
						'width:%1$s;',
						$tp_media_size
					),
				)
			);
		}

		if (!empty($tp_media_height)) {
			$this->get_responsive_styles(
				'tp_media_height',
				'%%order_class%% .tippy-box .dtp-hotspot-tp-figure',
				array(
					'primary'   => 'height',
					'important' => true,
				),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if (!empty($tp_media_width)) {
			$this->get_responsive_styles(
				'tp_media_width',
				'%%order_class%% .tippy-box .dtp-hotspot-tp-figure',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if (!empty($tp_media_padding)) {
			$this->get_responsive_styles(
				'tp_media_padding',
				'%%order_class%% .tippy-box .dtp-hotspot-tp-figure',
				array(
					'primary'   => 'padding',
					'important' => true,
				),
				array('default' => '0|0|0|0'),
				$render_slug
			);
		}

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'tooltip_icon',
				'important'      => true,
				'selector'       => '.dtp-hotspots %%order_class%% .dtp-hotspot-tp-icon i',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		$this->get_custom_bg_style($render_slug, 'tp_media', '%%order_class%% .tippy-box .dtp-hotspot-tp-figure', '%%order_class%%:hover .tippy-box .dtp-hotspot-tp-figure');

		// Spacing.
		if (!empty($tp_title_spacing)) {
			$this->get_responsive_styles(
				'tp_title_spacing',
				'%%order_class%% .tippy-box .dtp-hotspot-title',
				array(
					'primary'   => 'margin-top',
					'important' => true,
				),
				array('default' => ''),
				$render_slug
			);
		}

		if (!empty($tp_desc_spacing)) {
			$this->get_responsive_styles(
				'tp_desc_spacing',
				'%%order_class%% .tippy-box .dtp-hotspot-desc',
				array(
					'primary'   => 'margin-top',
					'important' => true,
				),
				array('default' => '0px'),
				$render_slug
			);
		}

		if (!empty($tp_btn_spacing)) {
			$this->get_responsive_styles(
				'tp_btn_spacing',
				'%%order_class%% .tippy-box .dtp-hotspot-btn-wrap',
				array(
					'primary'   => 'margin-top',
					'important' => true,
				),
				array('default' => '15px'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'spot_offset_y',
			'%%order_class%%',
			array('primary' => $spot_pos_y),
			array('default' => '40%'),
			$render_slug
		);

		$this->get_responsive_styles(
			'spot_offset_x',
			'%%order_class%%',
			array('primary' => $spot_pos_x),
			array('default' => '40%'),
			$render_slug
		);

		if ('on' === $this->props['use_animation']) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:before',
					'declaration' => sprintf(
						'position: absolute;
						height: 100%%;
						width: 100%%;
						left: 0;
						top: 0;
						-webkit-animation: hpAnimation 2s infinite;
						animation: hpAnimation 2s infinite;
						content: "";
						-webkit-box-shadow: 0 0 0 15px %1$s, 0 0 0 30px %1$s, 0 0 0 45px %1$s;
						  box-shadow: 0 0 0 15px %1$s, 0 0 0 30px %1$s, 0 0 0 45px %1$s;
						  border-radius: %2$s %3$s %4$s %5$s;',
						$wave_bg,
						$wave_radius[1],
						$wave_radius[2],
						$wave_radius[3],
						$wave_radius[4]
					),
				)
			);
		}

		$this->get_buttons_styles('tp_btn', $render_slug, '.dtp-hotspots %%order_class%% .dtp-hotspot-btn-wrap .dtp-hotspot-btn');
	}
}

new DTP_Hotspots_Child();
