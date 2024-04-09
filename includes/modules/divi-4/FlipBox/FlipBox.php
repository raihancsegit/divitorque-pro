<?php
class DTP_Flip_Box extends DTP_Builder_Module
{
	public function init()
	{
		$this->name       = esc_html__('Torq Flip Box', 'divitorque');
		$this->slug       = 'torq_flip_box';
		$this->vb_support = 'on';
		$this->icon_path  = plugin_dir_path(__FILE__) . 'flip-box.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'front'    => esc_html__('Front Side', 'divitorque'),
					'back'     => esc_html__('Back Side', 'divitorque'),
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'front'       => esc_html__('Front Side', 'divitorque'),
					'back'        => esc_html__('Back Side', 'divitorque'),
					'front_media' => esc_html__('Front Media', 'divitorque'),
					'back_media'  => esc_html__('Back Media', 'divitorque'),
					'front_text'  => array(
						'title'             => esc_html__('Front Texts', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__('Title', 'divitorque'),
							),
							'subtitle'    => array(
								'name' => esc_html__('Subtitle', 'divitorque'),
							),
							'description' => array(
								'name' => esc_html__('Description', 'divitorque'),
							),
						),
					),
					'back_text'   => array(
						'title'             => esc_html__('Back Texts', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__('Title', 'divitorque'),
							),
							'subtitle'    => array(
								'name' => esc_html__('Subtitle', 'divitorque'),
							),
							'description' => array(
								'name' => esc_html__('Description', 'divitorque'),
							),
						),
					),
					'button'      => esc_html__('Button', 'divitorque'),
					'border'      => esc_html__('Border', 'divitorque'),
					'box_shadow'  => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'front_icon'      => array(
				'label'    => esc_html__('Front Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-icon-front i',
			),
			'front_img'       => array(
				'label'    => esc_html__('Front Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-figure-front img',
			),
			'front_title'     => array(
				'label'    => esc_html__('Front Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-title-front',
			),
			'front_sub_title' => array(
				'label'    => esc_html__('Front Sub Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-subtitle-front',
			),
			'front_desc'      => array(
				'label'    => esc_html__('Front Description', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-desc-front',
			),
			'back_icon'       => array(
				'label'    => esc_html__('Back Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-icon-back i',
			),
			'back_img'        => array(
				'label'    => esc_html__('Back Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-figure-back img',
			),
			'back_title'      => array(
				'label'    => esc_html__('Back Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-title-back',
			),
			'back_sub_title'  => array(
				'label'    => esc_html__('Back Sub Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-subtitle-back',
			),
			'back_desc'       => array(
				'label'    => esc_html__('Back Description', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-desc-front',
			),
			'back_btn'        => array(
				'label'    => esc_html__('Back Button', 'divitorque'),
				'selector' => '%%order_class%% .dtp-flip-box-btn',
			),
		);
	}

	public function get_fields()
	{
		$front_content = array(
			'front_media_type'  => array(
				'label'       => esc_html__('Media Type', 'divitorque'),
				'description' => esc_html__('Select front side media type.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'front',
				'default'     => 'icon',
				'options'     => array(
					'none'  => esc_html__('None', 'divitorque'),
					'icon'  => esc_html__('Icon', 'divitorque'),
					'image' => esc_html__('Image', 'divitorque'),
				),
			),
			'front_icon'        => array(
				'label'       => esc_html__('Select Icon', 'divitorque'),
				'description' => esc_html__('Select front side icon.', 'divitorque'),
				'type'        => 'select_icon',
				'default'     => '&#xe60c;||divi||400',
				'toggle_slug' => 'front',
				'tab_slug'    => 'general',
				'show_if'     => array(
					'front_media_type' => 'icon',
				),
			),
			'front_img'         => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display for the front side.', 'divitorque'),
				'type'               => 'upload',
				'default'            => DTP_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'front',
				'show_if'            => array(
					'front_media_type' => 'image',
				),
			),
			'front_img_alt'     => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Define the front side image alt text for your flip box.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'front',
				'show_if'     => array(
					'front_media_type' => 'image',
				),
			),
			'front_title'       => array(
				'label'           => esc_html__('Front Title', 'divitorque'),
				'description'     => esc_html__('Define the front side title for your flip box.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
			'front_subtitle'    => array(
				'label'           => esc_html__('Front Sub Title', 'divitorque'),
				'description'     => esc_html__('Define the front side sub-title for your flip box.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
			'front_description' => array(
				'label'           => esc_html__('Front Description', 'divitorque'),
				'description'     => esc_html__('Define the front side description text for your flip box.', 'divitorque'),
				'type'            => 'textarea',
				'toggle_slug'     => 'front',
				'dynamic_content' => 'text',
			),
		);

		$back_content = array(
			'back_media_type'  => array(
				'label'       => esc_html__('Media Type', 'divitorque'),
				'description' => esc_html__('Select back side media type.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'back',
				'default'     => 'icon',
				'options'     => array(
					'none'  => esc_html__('None', 'divitorque'),
					'icon'  => esc_html__('Icon', 'divitorque'),
					'image' => esc_html__('Image', 'divitorque'),
				),
			),
			'back_icon'        => array(
				'label'       => esc_html__('Select Icon', 'divitorque'),
				'description' => esc_html__('Select back side icon.', 'divitorque'),
				'type'        => 'select_icon',
				'toggle_slug' => 'back',
				'default'     => '&#x2b;||divi||400',
				'tab_slug'    => 'general',
				'show_if'     => array(
					'back_media_type' => 'icon',
				),
			),
			'back_img'         => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display for the back side.', 'divitorque'),
				'type'               => 'upload',
				'default'            => DTP_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'back',
				'show_if'            => array(
					'back_media_type' => 'image',
				),
			),
			'back_img_alt'     => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Define the back side image alt text for your flip box.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'back',
				'show_if'     => array(
					'back_media_type' => 'image',
				),
			),
			'back_title'       => array(
				'label'           => esc_html__('Back Title', 'divitorque'),
				'description'     => esc_html__('Define the back side title for your flip box.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'back_subtitle'    => array(
				'label'           => esc_html__('Back Sub Title', 'divitorque'),
				'description'     => esc_html__('Define the back side sub-title for your flip box.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'back_description' => array(
				'label'           => esc_html__('Back Description', 'divitorque'),
				'description'     => esc_html__('Define the back side description text for your flip box.', 'divitorque'),
				'type'            => 'textarea',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
			),
			'use_button'       => array(
				'label'           => esc_html__('Use Button', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether button should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'back',
			),
			'button_text'      => array(
				'label'           => esc_html__('Button Text', 'divitorque'),
				'description'     => esc_html__('Here you can define the button text.', 'divitorque'),
				'type'            => 'text',
				'default'         => 'Click Here',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'button_link'      => array(
				'label'           => esc_html__('Button Link', 'divitorque'),
				'description'     => esc_html__('Define the button link url for your button.', 'divitorque'),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'back',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
			'is_new_window'    => array(
				'label'           => esc_html__('Open Button link in new window', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether button URL should be opened in new window.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'back',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),
		);

		$settings = array(
			'animation_type'     => array(
				'label'       => esc_html__('Animation Type', 'divitorque'),
				'description' => esc_html__('Select the animation type.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'flip',
				'options'     => array(
					'flip'      => esc_html__('Flip', 'divitorque'),
					'diagonal'  => esc_html__('Flip Diagonal', 'divitorque'),
					'shake'     => esc_html__('Flip Shake', 'divitorque'),
					'push'      => esc_html__('Push', 'divitorque'),
					'slide'     => esc_html__('Slide', 'divitorque'),
					'fade'      => esc_html__('Fade', 'divitorque'),
					'zoom_in'   => esc_html__('Zoom In', 'divitorque'),
					'zoom_out'  => esc_html__('Zoom Out', 'divitorque'),
					'rotate_3d' => esc_html__('Rotate 3D', 'divitorque'),
					'open_up'   => esc_html__('Open Up', 'divitorque'),
				),
			),
			'flank_color'        => array(
				'label'        => esc_html__('Divider Flank Color', 'divitorque'),
				'description'  => esc_html__('Pick a color to use for the flank color.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'default'      => '#dddddd',
				'toggle_slug'  => 'settings',
				'show_if'      => array(
					'animation_type' => 'rotate_3d',
				),
			),
			'direction'          => array(
				'label'       => esc_html__('Animation Direction', 'divitorque'),
				'description' => esc_html__('Select the animation direction.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'right',
				'options'     => array(
					'up'    => esc_html__('Up', 'divitorque'),
					'right' => esc_html__('Right', 'divitorque'),
					'down'  => esc_html__('Down', 'divitorque'),
					'left'  => esc_html__('Left', 'divitorque'),
				),
				'show_if'     => array(
					'animation_type' => array('flip', 'push', 'slide'),
				),
			),
			'direction_diagonal' => array(
				'label'       => esc_html__('Animation Direction', 'divitorque'),
				'description' => esc_html__('Select the animation direction.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'right',
				'options'     => array(
					'right' => esc_html__('Right', 'divitorque'),
					'left'  => esc_html__('Left', 'divitorque'),
				),
				'show_if'     => array(
					'animation_type' => 'diagonal',
				),
			),
			'direction_alt'      => array(
				'label'       => esc_html__('Animation Direction', 'divitorque'),
				'description' => esc_html__('Select the animation direction.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'h',
				'options'     => array(
					'v' => esc_html__('Vertical', 'divitorque'),
					'h' => esc_html__('Horizontal', 'divitorque'),
				),
				'show_if'     => array(
					'animation_type' => 'rotate_3d',
				),
			),
			'animation_3d'       => array(
				'label'           => esc_html__('Use 3d Animation', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether 3d animation should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'settings',
				'show_if'         => array(
					'animation_type' => 'flip',
				),
			),
			'duration'           => array(
				'label'          => esc_html__('Animation Duration', 'divitorque'),
				'description'    => esc_html__('Define the length of time that the animation takes.', 'divitorque'),
				'type'           => 'range',
				'default'        => '600ms',
				'fixed_unit'     => 'ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 50,
					'max'  => 3000,
				),
				'toggle_slug'    => 'settings',
			),
			'main_height'        => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Define height for your flip box.', 'divitorque'),
				'type'           => 'range',
				'default'        => '300px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'settings',
			),
		);

		$front_media = array(
			'front_img_position' => array(
				'label'       => esc_html__('Position', 'divitorque'),
				'description' => esc_html__('Select image position for the front side.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'front_media',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'left'   => esc_html__('Left', 'divitorque'),
					'center' => esc_html__('Center', 'divitorque'),
					'right'  => esc_html__('Right', 'divitorque'),
				),
			),
			'front_img_padding'  => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom padding for your front side icon/image.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'front_media_type' => 'image',
				),
			),
			'front_icon_color'   => array(
				'label'        => esc_html__('Icon Color', 'divitorque'),
				'description'  => esc_html__('Here you can define a custom color for your front side icon.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'front_media',
				'show_if'      => array(
					'front_media_type' => 'icon',
				),
			),
			'front_icon_size'    => array(
				'label'          => esc_html__('Icon Size', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom size for your front side icon.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '60px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'front_media_type' => 'icon',
				),
			),
			'front_img_height'   => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom height for your front side image/icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
			),
			'front_img_width'    => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom width for your front side image/icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'front_media',
				'tab_slug'       => 'advanced',
			),
		);

		$back_media = array(
			'back_img_position' => array(
				'label'       => esc_html__('Position', 'divitorque'),
				'description' => esc_html__('Select image position for the back side.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'back_media',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__('Left', 'divitorque'),
					'center'     => esc_html__('Center', 'divitorque'),
					'flex-end'   => esc_html__('Right', 'divitorque'),
				),
			),
			'back_img_padding'  => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom padding for your back side icon/image.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'back_media_type' => 'image',
				),
			),
			'back_icon_color'   => array(
				'label'        => esc_html__('Icon Color', 'divitorque'),
				'description'  => esc_html__('Here you can define a custom color for your back side icon.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'back_media',
				'show_if'      => array(
					'back_media_type' => 'icon',
				),
			),
			'back_icon_size'    => array(
				'label'          => esc_html__('Icon Size', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom size for your back side icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '60px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'back_media_type' => 'icon',
				),
			),
			'back_img_height'   => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom height for your back side image/icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
			),
			'back_img_width'    => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom width for your back side image/icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'back_media',
				'tab_slug'       => 'advanced',
			),
		);

		$front_design = array(
			'front_alignment'   => array(
				'label'            => esc_html__('Content Alignment', 'divitorque'),
				'description'      => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'text_align',
				'default_on_front' => 'center',
				'toggle_slug'      => 'front',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'front_align_items' => array(
				'label'       => esc_html__('Content Vertical Alignment', 'divitorque'),
				'description' => esc_html__('Select front side content vertical alignment.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'front',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__('Start', 'divitorque'),
					'center'     => esc_html__('Center', 'divitorque'),
					'flex-end'   => esc_html__('End', 'divitorque'),
				),
			),
			'front_padding'     => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front',
				'tab_slug'       => 'advanced',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
			),
			'front_ct_padding'  => array(
				'label'          => esc_html__('Content Padding', 'divitorque'),
				'description'    => esc_html__('Set front side card content padding.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'front',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$back_design = array(
			'back_alignment'   => array(
				'label'            => esc_html__('Content Alignment', 'divitorque'),
				'description'      => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'text_align',
				'default_on_front' => 'center',
				'toggle_slug'      => 'back',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'back_align_items' => array(
				'label'       => esc_html__('Content Vertical Alignment', 'divitorque'),
				'description' => esc_html__('Select back side content vertical alignment.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'back',
				'tab_slug'    => 'advanced',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__('Start', 'divitorque'),
					'center'     => esc_html__('Center', 'divitorque'),
					'flex-end'   => esc_html__('End', 'divitorque'),
				),
			),
			'back_padding'     => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back',
				'tab_slug'       => 'advanced',
				'default'        => '30px|30px|30px|30px',
				'mobile_options' => true,
			),
			'back_ct_padding'  => array(
				'label'          => esc_html__('Content Padding', 'divitorque'),
				'description'    => esc_html__('Set back side card content padding.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'back',
				'tab_slug'       => 'advanced',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
			),
		);

		$front_bg = $this->custom_background_fields(
			'front',
			'',
			'advanced',
			'front',
			array('color', 'gradient', 'image'),
			array(),
			'#efefef'
		);

		$back_bg = $this->custom_background_fields(
			'back',
			'',
			'advanced',
			'back',
			array('color', 'gradient', 'image'),
			array(),
			'#efefef'
		);

		$front_img_bg = $this->custom_background_fields(
			'front_img',
			'',
			'advanced',
			'front_media',
			array('color', 'gradient', 'image'),
			array(),
			''
		);

		$back_img_bg = $this->custom_background_fields(
			'back_img',
			'',
			'advanced',
			'back_media',
			array('color', 'gradient', 'image'),
			array(),
			''
		);

		$texts_spacing = array(
			'front_subtitle_spacing' => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the front card subtitle.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '10px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'front_text',
				'sub_toggle'     => 'subtitle',
				'tab_slug'       => 'advanced',
			),
			'back_subtitle_spacing'  => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the back card subtitle.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '10px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'back_text',
				'sub_toggle'     => 'subtitle',
				'tab_slug'       => 'advanced',
			),
			'front_desc_spacing'     => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the front card description.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '10px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'front_text',
				'sub_toggle'     => 'description',
				'tab_slug'       => 'advanced',
			),
			'back_desc_spacing'      => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the back card description.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '10px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'back_text',
				'sub_toggle'     => 'description',
				'tab_slug'       => 'advanced',
			),
		);

		$button = array(
			'btn_spacing' => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the back card button.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '15px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 150,
				),
				'toggle_slug'    => 'button',
				'tab_slug'       => 'advanced',
			),
		);

		return array_merge(
			$front_content,
			$back_content,
			$settings,
			$front_design,
			$back_design,
			$front_media,
			$back_media,
			$back_bg,
			$front_bg,
			$front_img_bg,
			$back_img_bg,
			$texts_spacing,
			$button
		);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['box_shadow']['card'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '%%order_class%% .dtp-flip-box-card',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['card'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-flip-box-card',
					'border_styles' => '%%order_class%% .dtp-flip-box-card',
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

		$advanced_fields['borders']['front_media'] = array(
			'toggle_slug' => 'front_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-flip-box-figure-front',
					'border_styles' => '%%order_class%% .dtp-flip-box-figure-front',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['back_media'] = array(
			'toggle_slug' => 'back_media',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-flip-box-figure-back',
					'border_styles' => '%%order_class%% .dtp-flip-box-figure-back',
				),
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['front_title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-flip-box-title-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '26px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		$advanced_fields['fonts']['front_description'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-flip-box-desc-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'description',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['fonts']['back_title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-flip-box-title-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '26px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		$advanced_fields['fonts']['back_description'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-flip-box-desc-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'description',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['button']['back_btn'] = array(
			'label'          => esc_html__('Button', 'divitorque'),
			'toggle_slug'    => 'button',
			'css'            => array(
				'main'      => '%%order_class%% .dtp-flip-box-btn',
				'important' => 'all',
			),
			'use_alignment'  => false,
			'box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .dtp-flip-box-btn',
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

		$advanced_fields['fonts']['front_subtitle'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-flip-box-subtitle-front',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'front_text',
			'sub_toggle'      => 'subtitle',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '18px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		$advanced_fields['fonts']['back_subtitle'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-flip-box-subtitle-back',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'back_text',
			'sub_toggle'      => 'subtitle',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '18px',
			),
			'line_height'     => array(
				'default' => '1.5em',
			),
		);

		return $advanced_fields;
	}

	public function render_icon_front()
	{
		$icon_name = esc_attr(et_pb_process_font_icon($this->props['front_icon']));

		return sprintf(
			'<div class="dtp-flip-box-icon dtp-flip-box-icon-front">
                <i class="dtp-et-icon">%1$s</i>
            </div>',
			$icon_name
		);
	}

	public function render_icon_back()
	{
		$icon_name = esc_attr(et_pb_process_font_icon($this->props['back_icon']));
		return sprintf(
			'<div class="dtp-flip-box-icon dtp-flip-box-icon-back">
                <i class="dtp-et-icon">%1$s</i>
            </div>',
			$icon_name
		);
	}

	public function render_img_front()
	{
		return sprintf(
			'<div class="dtp-flip-box-img-front">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['front_img'],
			$this->props['front_img_alt']
		);
	}

	public function render_img_back()
	{
		return sprintf(
			'<div class="dtp-flip-box-img-back">
                <img src="%1$s" alt="%2$s"/>
            </div>',
			$this->props['back_img'],
			$this->props['back_img_alt']
		);
	}

	public function render_media_front()
	{
		$front_icon       = $this->props['front_icon'];
		$front_media_type = $this->props['front_media_type'];
		$front_img        = $this->props['front_img'];

		if ('none' === $front_media_type) {
			return;
		}

		if (!empty($front_icon) || !empty($front_img)) {
			if ('icon' === $front_media_type) {
				$media = $this->render_icon_front();
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['front_icon']);
			} elseif ('image' === $front_media_type) {
				$media = $this->render_img_front();
			}

			return sprintf(
				'<div class="dtp-flip-box-figure-front">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_media_back()
	{
		$back_icon       = $this->props['back_icon'];
		$back_media_type = $this->props['back_media_type'];
		$back_img        = $this->props['back_img'];

		if ('none' === $back_media_type) {
			return;
		}

		if (!empty($back_icon) || !empty($back_img)) {
			if ('icon' === $back_media_type) {
				$media = $this->render_icon_back();
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['back_icon']);
			} elseif ('image' === $back_media_type) {
				$media = $this->render_img_back();
			}

			return sprintf(
				'<div class="dtp-flip-box-figure-back">
					%1$s
				</div>',
				$media
			);
		}
	}

	public function render_title_front()
	{
		$front_title = $this->props['front_title'];
		if (!empty($front_title)) {
			return sprintf(
				'<h2 class="dtp-flip-box-title-front">%1$s</h2>',
				$front_title
			);
		}
	}

	public function render_title_back()
	{
		$back_title = $this->props['back_title'];
		if (!empty($back_title)) {
			return sprintf(
				'<h2 class="dtp-flip-box-title-back">%1$s</h2>',
				$back_title
			);
		}
	}

	public function render_subtitle_front()
	{
		$front_subtitle = $this->props['front_subtitle'];
		if (!empty($front_subtitle)) {
			return sprintf(
				'<h4 class="dtp-flip-box-subtitle-front">%1$s</h4>',
				$front_subtitle
			);
		}
	}

	public function render_subtitle_back()
	{
		$back_subtitle = $this->props['back_subtitle'];
		if (!empty($back_subtitle)) {
			return sprintf(
				'<h4 class="dtp-flip-box-subtitle-back">%1$s</h4>',
				$back_subtitle
			);
		}
	}

	public function render_description_front()
	{
		$description = $this->props['front_description'];
		if (!empty($description)) {
			return sprintf(
				'<div class="dtp-flip-box-desc-front">%1$s</div>',
				$description
			);
		}
	}

	public function render_description_back()
	{
		$description = $this->props['back_description'];
		if (!empty($description)) {
			return sprintf(
				'<div class="dtp-flip-box-desc-back">%1$s</div>',
				$description
			);
		}
	}

	public function render_module_button()
	{
		if ('on' === $this->props['use_button']) {
			$button_custom = $this->props['custom_back_btn'];
			$button_text   = isset($this->props['button_text']) ? $this->props['button_text'] : 'Click Here';
			$button_link   = isset($this->props['button_link']) ? $this->props['button_link'] : '#';
			$button_url    = trim($button_link);
			$new_tab       = $this->props['is_new_window'];

			$custom_icon_values = et_pb_responsive_options()->get_property_values($this->props, 'back_btn_icon');
			$custom_icon        = isset($custom_icon_values['desktop']) ? $custom_icon_values['desktop'] : '';
			$custom_icon_tablet = isset($custom_icon_values['tablet']) ? $custom_icon_values['tablet'] : '';
			$custom_icon_phone  = isset($custom_icon_values['phone']) ? $custom_icon_values['phone'] : '';
			$multi_view         = et_pb_multi_view_options($this);

			if (function_exists('dtp_inject_fa_icons')) {
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['back_btn_icon']);
			}

			$button = $this->render_button(
				array(
					'button_id'           => $this->module_id(false),
					'button_classname'    => array('dtp-flip-box-btn'),
					'button_custom'       => $button_custom,
					'button_text'         => $button_text,
					'button_text_escaped' => true,
					'button_url'          => $button_url,
					'custom_icon'         => $custom_icon,
					'custom_icon_tablet'  => $custom_icon_tablet,
					'custom_icon_phone'   => $custom_icon_phone,
					'url_new_window'      => $new_tab,
					'has_wrapper'         => false,
					'multi_view_data'     => $multi_view->render_attrs(
						array(
							'content'        => '{{button_text}}',
							'hover_selector' => '%%order_class%% .dtp-flip-box-btn',
							'visibility'     => array(
								'button_text' => '__not_empty',
							),
						)
					),
				)
			);

			return sprintf(
				'<div class="dtp-flip-box-btn-wrap">
                    %1$s
                </div>',
				$button
			);
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_css($render_slug);
		wp_enqueue_style('torq-flip-box');
		$animation_type     = $this->props['animation_type'];
		$animation_3d       = $this->props['animation_3d'];
		$direction          = $this->props['direction'];
		$direction_alt      = $this->props['direction_alt'];
		$direction_diagonal = $this->props['direction_diagonal'];
		$classes            = array();

		array_push($classes, 'dtp-flip-box--' . $animation_type);

		if ('on' === $animation_3d) {
			array_push($classes, 'dtp-flip-box-3d');
		}

		if (
			'flip' === $animation_type ||
			'slide' === $animation_type ||
			'push' === $animation_type
		) {
			array_push($classes, "dtp-$animation_type-$direction");
		}

		if ('diagonal' === $animation_type) {
			array_push($classes, "dtp-$animation_type-$direction_diagonal");
		}

		if ('rotate_3d' === $animation_type) {
			array_push($classes, "dtp-$animation_type-$direction_alt");
		}

		return sprintf(
			'<div class="dtp-module dtp-flip-box %1$s">
                <div class="dtp-flip-box-inner">
					<div class="dtp-flip-box-card-container">
						<div class="dtp-flip-box-front-card dtp-flip-box-card">
							<div class="dtp-flip-box-card-inner">
								<div class="dtp-flip-box-front-content dtp-flip-box-content">
									%2$s
									<div class="dtp-flip-box-content-wrap">
										%3$s
										%9$s
										%6$s
									</div>
								</div>
							</div>
						</div>
						<div class="dtp-flip-box-back-card dtp-flip-box-card">
							<div class="dtp-flip-box-card-inner">
								<div class="dtp-flip-box-back-content dtp-flip-box-content">
									%4$s
									<div class="dtp-flip-box-content-wrap">
										%5$s
										%10$s
										%7$s
										%8$s
									</div>
								</div>
							</div>
						</div>
						<div class="dtp-flank"></div>
					</div>
				</div>
            </div>',
			join(' ', $classes), // 1.
			$this->render_media_front(), // 2.
			$this->render_title_front(), // 3.
			$this->render_media_back(), // 4.
			$this->render_title_back(), // 5.
			$this->render_description_front(), // 6.
			$this->render_description_back(), // 7.
			$this->render_module_button(), // 8.
			$this->render_subtitle_front(), // 9.
			$this->render_subtitle_back() // 10
		);
	}

	public function render_css($render_slug)
	{
		$front_img_position = $this->props['front_img_position'];
		$animation_type     = $this->props['animation_type'];
		$direction_alt      = $this->props['direction_alt'];
		$front_icon_size    = $this->props['front_icon_size'];
		$back_icon_color    = $this->props['back_icon_color'];
		$front_icon_color   = $this->props['front_icon_color'];
		$front_img_width    = $this->props['front_img_width'];
		$front_img_height   = $this->props['front_img_height'];
		$back_img_width     = $this->props['back_img_width'];
		$back_icon_size     = $this->props['back_icon_size'];
		$back_img_height    = $this->props['back_img_height'];
		$back_img_position  = $this->props['back_img_position'];
		$duration           = $this->props['duration'];
		$main_height        = $this->props['main_height'];
		$flank_color        = $this->props['flank_color'];
		$front_align_items  = $this->props['front_align_items'];
		$back_align_items   = $this->props['back_align_items'];

		if ('rotate_3d' === $animation_type) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-inner .dtp-flank',
					'declaration' => sprintf(
						'background: %1$s;',
						$flank_color
					),
				)
			);

			if ('v' === $direction_alt) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-flip-box-inner .dtp-flank',
						'declaration' => sprintf(
							'transform: rotateX(-90deg) translateZ(calc(%1$s - 100px))!important;',
							$main_height
						),
					)
				);
			}
		}

		$this->get_responsive_styles(
			'main_height',
			'%%order_class%% .dtp-flip-box-inner',
			array('primary' => 'height'),
			array('default' => '300px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-flip-box-front-card, %%order_class%% .dtp-flip-box-back-card, %%order_class%% .dtp-flip-box-card-container',
				'declaration' => "transition: all $duration ease;",
			)
		);

		// Front Side.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-flip-box-front-card',
				'declaration' => sprintf(
					'align-items: %1$s;',
					$front_align_items
				),
			)
		);

		if ('center' !== $front_img_position) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-front-content',
					'declaration' => sprintf(
						'align-items: %1$s;',
						$front_align_items
					),
				)
			);
		}

		$this->get_responsive_styles(
			'front_alignment',
			'%%order_class%% .dtp-flip-box-front-card',
			array('primary' => 'text-align'),
			array('default' => 'auto'),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_padding',
			'%%order_class%% .dtp-flip-box-front-card',
			array('primary' => 'padding'),
			array('default' => '30px|30px|30px|30px'),
			$render_slug
		);

		if ('center' !== $front_img_position) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-front-content',
					'declaration' => 'display: flex;',
				)
			);
		}

		if ('right' === $front_img_position) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-front-content',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-flip-box-icon-front',
				'declaration' => sprintf(
					'font-size: %1$s;',
					$front_icon_size
				),
			)
		);

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'front_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-flip-box-icon-front',
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
				'base_attr_name' => 'back_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-flip-box-icon-back',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		if (!empty($front_icon_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-icon-front',
					'declaration' => sprintf(
						'color: %1$s;',
						$front_icon_color
					),
				)
			);
		}

		if (!empty($front_img_width)) {
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .dtp-flip-box-figure-front',
				array('primary' => 'width'),
				array('default' => 'auto'),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .dtp-flip-box-figure-front',
				array('primary' => 'max-width'),
				array('default' => 'auto'),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_width',
				'%%order_class%% .dtp-flip-box-figure-front',
				array('primary' => 'flex'),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if (!empty($front_img_height)) {
			$this->get_responsive_styles(
				'front_img_height',
				'%%order_class%% .dtp-flip-box-figure-front',
				array('primary' => 'height'),
				array('default' => 'auto'),
				$render_slug
			);
			$this->get_responsive_styles(
				'front_img_height',
				'%%order_class%% .dtp-flip-box-figure-front img',
				array('primary' => 'height'),
				array('default' => 'auto'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'front_img_padding',
			'%%order_class%% .dtp-flip-box-figure-front img',
			array('primary' => 'padding'),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_ct_padding',
			'%%order_class%% .dtp-flip-box-front-card .dtp-flip-box-content-wrap',
			array('primary' => 'padding'),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		// Back Side.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-flip-box-back-card',
				'declaration' => sprintf(
					'align-items: %1$s;',
					$back_align_items
				),
			)
		);

		if ('center' !== $back_img_position) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-back-content',
					'declaration' => sprintf(
						'align-items: %1$s;',
						$back_align_items
					),
				)
			);
		}

		$this->get_responsive_styles(
			'back_alignment',
			'%%order_class%% .dtp-flip-box-back-card',
			array('primary' => 'text-align'),
			array('default' => 'auto'),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_padding',
			'%%order_class%% .dtp-flip-box-back-card',
			array('primary' => 'padding'),
			array('default' => '30px|30px|30px|30px'),
			$render_slug
		);

		if ('center' !== $back_img_position) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-back-content',
					'declaration' => 'display: flex;',
				)
			);
		}

		if ('right' === $back_img_position) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-back-content',
					'declaration' => 'flex-direction: row-reverse;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-flip-box-icon-back',
				'declaration' => sprintf(
					'font-size: %1$s;',
					$back_icon_size
				),
			)
		);

		if (!empty($back_icon_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-flip-box-icon-back',
					'declaration' => sprintf(
						'color: %1$s;',
						$back_icon_color
					),
				)
			);
		}

		if (!empty($back_img_width)) {
			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .dtp-flip-box-figure-back',
				array('primary' => 'width'),
				array('default' => 'auto'),
				$render_slug
			);

			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .dtp-flip-box-figure-back',
				array('primary' => 'max-width'),
				array('default' => 'auto'),
				$render_slug
			);

			$this->get_responsive_styles(
				'back_img_width',
				'%%order_class%% .dtp-flip-box-figure-back',
				array('primary' => 'flex'),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if (!empty($back_img_height)) {
			$this->get_responsive_styles(
				'back_img_height',
				'%%order_class%% .dtp-flip-box-figure-back',
				array('primary' => 'height'),
				array('default' => 'auto'),
				$render_slug
			);
			$this->get_responsive_styles(
				'back_img_height',
				'%%order_class%% .dtp-flip-box-figure-back img',
				array('primary' => 'height'),
				array('default' => 'auto'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'back_img_padding',
			'%%order_class%% .dtp-flip-box-figure-back img',
			array('primary' => 'padding'),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_ct_padding',
			'%%order_class%% .dtp-flip-box-back-card .dtp-flip-box-content-wrap',
			array('primary' => 'padding'),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		// Texts Spacing.
		$this->get_responsive_styles(
			'front_subtitle_spacing',
			'%%order_class%% .dtp-flip-box-subtitle-front',
			array('primary' => 'margin-top'),
			array('default' => '10px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_subtitle_spacing',
			'%%order_class%% .dtp-flip-box-subtitle-back',
			array('primary' => 'margin-top'),
			array('default' => '10px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'front_desc_spacing',
			'%%order_class%% .dtp-flip-box-desc-front',
			array('primary' => 'margin-top'),
			array('default' => '10px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'back_desc_spacing',
			'%%order_class%% .dtp-flip-box-desc-back',
			array('primary' => 'margin-top'),
			array('default' => '10px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'btn_spacing',
			'%%order_class%% .dtp-flip-box-btn-wrap',
			array('primary' => 'margin-top'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_custom_bg_style($render_slug, 'front', '%%order_class%% .dtp-flip-box-front-card', '');
		$this->get_custom_bg_style($render_slug, 'back', '%%order_class%% .dtp-flip-box-back-card', '');
		$this->get_custom_bg_style($render_slug, 'front_img', '%%order_class%% .dtp-flip-box-figure-front', '');
		$this->get_custom_bg_style($render_slug, 'back_img', '%%order_class%% .dtp-flip-box-figure-back', '');
		$this->get_buttons_styles('button', $render_slug, '%%order_class%% .dtp-flip-box-back-card .et_pb_button');
	}
}

new DTP_Flip_Box();
