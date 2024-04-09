<?php
class DTP_Blurb extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_blurb';
		$this->name       = esc_html__('Torq Blurb', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'blurb.svg';

		$this->settings_modal_toggles = array(

			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'general'      => esc_html__('General', 'divitorque'),
					'main_element' => esc_html__('Media', 'divitorque'),
					'overlay'      => esc_html__('Overlay', 'divitorque'),
					'title'        => esc_html__('Title', 'divitorque'),
					'header'       => array(
						'title'             => esc_html__('Heading Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'h1' => array(
								'name' => 'H1',
								'icon' => 'text-h1',
							),
							'h2' => array(
								'name' => 'H2',
								'icon' => 'text-h2',
							),
							'h3' => array(
								'name' => 'H3',
								'icon' => 'text-h3',
							),
							'h4' => array(
								'name' => 'H4',
								'icon' => 'text-h4',
							),
							'h5' => array(
								'name' => 'H5',
								'icon' => 'text-h5',
							),
							'h6' => array(
								'name' => 'H6',
								'icon' => 'text-h6',
							),
						),
					),
					'button'       => esc_html__('Button', 'divitorque'),
					'border'       => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'  => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-info-box .dtp-info-box-figure img',
			),
			'icon'   => array(
				'label'    => esc_html__('Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-info-box-icon i',
			),
			'video'  => array(
				'label'    => esc_html__('Video', 'divitorque'),
				'selector' => '%%order_class%% .dtp-info-box-video video',
			),
			'title'  => array(
				'label'    => esc_html__('Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-info-box-title',
			),
			'button' => array(
				'label'    => esc_html__('Button', 'divitorque'),
				'selector' => '%%order_class%% .dtp-btn-info-box',
			),
		);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['borders']['box'] = array(
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
					'color' => '#333',
					'style' => 'solid',
				),
			),
			'toggle_slug' => 'border',
		);

		$advanced_fields['borders']['photo'] = array(
			'toggle_slug' => 'main_element',
			'tab_slug'    => 'advanced',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-info-box-figure, %%order_class%% .dtp-info-box-icon, %%order_class%% .dtp-content-video',
					'border_styles' => '%%order_class%% .dtp-info-box-figure, %%order_class%% .dtp-info-box-icon, %%order_class%% .dtp-content-video',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#e5e5e5',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
		);

		$advanced_fields['button']['button'] = array(
			'label'         => esc_html__('Button', 'divitorque'),
			'css'           => array(
				'main'      => '%%order_class%% .dtp-btn-info-box',
				'important' => 'all',
			),
			'use_alignment' => false,
		);

		$advanced_fields['fonts'] = array(
			'title'    => array(
				'label'           => esc_html__('Title', 'divitorque'),
				'css'             => array(
					'main'      => '%%order_class%% .dtp-info-box-title',
					'important' => 'all',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'title',
				'hide_text_align' => false,
				'header_level'    => array(
					'default' => 'h2',
				),
				'line_height'     => array(
					'default'        => '1em',
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
				),
				'font_size'       => array(
					'default' => '26px',
				),
			),

			'body'     => array(
				'label'          => esc_html__('Body', 'divitorque'),
				'css'            => array(
					'main'        => '%%order_class%% .dtp-mce-content',
					'line_height' => '%%order_class%% .dtp-mce-content p',
					'text_align'  => '%%order_class%% .dtp-mce-content',
					'text_shadow' => '%%order_class%% .dtp-mce-content',
					'important'   => 'all',
				),
				'block_elements' => array(
					'tabbed_subtoggles' => true,
					'css'               => array(
						'main'      => '%%order_class%% .dtp-mce-content',
						'important' => 'all',
					),
				),
			),

			'header'   => array(
				'label'       => esc_html__('Heading', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-mce-content h1',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => absint(et_get_option('body_header_size', '30')) . 'px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h1',
			),
			'header_2' => array(
				'label'       => esc_html__('Heading 2', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-mce-content h2',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '26px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h2',
			),
			'header_3' => array(
				'label'       => esc_html__('Heading 3', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-mce-content h3',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '22px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h3',
			),
			'header_4' => array(
				'label'       => esc_html__('Heading 4', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-mce-content h4',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '18px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h4',
			),
			'header_5' => array(
				'label'       => esc_html__('Heading 5', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-mce-content h5',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '16px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h5',
			),
			'header_6' => array(
				'label'       => esc_html__('Heading 6', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-mce-content h6',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '14px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h6',
			),
		);

		return $advanced_fields;
	}

	public function get_fields()
	{
		$fields = array(

			'main_figure'          => array(
				'label'       => esc_html__('Media Element', 'divitorque'),
				'description' => esc_html__('Choose icon/image/video for the blurb media.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => 'image',
				'options'     => array(
					'image' => esc_html__('Image', 'divitorque'),
					'video' => esc_html__('Video', 'divitorque'),
					'icon'  => esc_html__('Icon', 'divitorque'),
				),
			),

			'photo'                => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display for the blurb.', 'divitorque'),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'main_figure' => 'image',
				),
			),

			'video'                => array(
				'label'              => esc_html__('Video MP4 File Or Youtube URL', 'divitorque'),
				'description'        => esc_html__('Upload MP4 video file or type youtube URL which would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'data_type'          => 'video',
				'upload_button_text' => esc_attr__('Upload a video', 'divitorque'),
				'choose_text'        => esc_attr__('Choose a Video MP4 File', 'divitorque'),
				'update_text'        => esc_attr__('Set As Video', 'divitorque'),
				'description'        => esc_html__('Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'divitorque'),
				'toggle_slug'        => 'content',
				'computed_affects'   => array('__video'),
				'show_if'            => array(
					'main_figure' => 'video',
				),
			),

			'icon'                 => array(
				'label'       => esc_html__('Select Icon', 'divitorque'),
				'description' => esc_html__('Select icon for the blurb.', 'divitorque'),
				'type'        => 'select_icon',
				'toggle_slug' => 'content',
				'tab_slug'    => 'general',
				'default'     => '&#x2b;||divi||400',
				'show_if'     => array(
					'main_figure' => 'icon',
				),
			),

			'title'                => array(
				'label'           => esc_html__('Title', 'divitorque'),
				'description'     => esc_html__('Define the title for your blurb.', 'divitorque'),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'content',
			),

			'body_text'         => array(
				'label'           => esc_html__('Body', 'divitorque'),
				'description'     => esc_html__('Define the body text for your blurb.', 'divitorque'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'use_button'           => array(
				'label'       => esc_html__('Use Button', 'divitorque'),
				'description' => esc_html__('Here you can choose whether button should be used.', 'divitorque'),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'on',
				'toggle_slug' => 'content',
			),

			'button_text'          => array(
				'label'           => esc_html__('Button Text', 'divitorque'),
				'description'     => esc_html__('Define the button text for your blurb.', 'divitorque'),
				'type'            => 'text',
				'default'         => 'Click Here',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			'button_link'          => array(
				'label'           => esc_html__('Button Link', 'divitorque'),
				'description'     => esc_html__('Define the button link url for your blurb.', 'divitorque'),
				'type'            => 'text',
				'default'         => '',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			'is_new_wndow'         => array(
				'label'           => esc_html__('Open Button link in new window', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether button URL should be opened in new window.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
				'show_if'         => array(
					'use_button' => 'on',
				),
			),

			// video overlay.
			'use_overlay'          => array(
				'label'           => esc_html__('Use Overlay Image', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether video overlay should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'overlay',
				'show_if'         => array(
					'main_figure' => 'video',
				),
			),

			'vo_src'               => array(
				'label'              => esc_html__('Overlay Image', 'divitorque'),
				'description'        => esc_html__('Upload an overlay image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'overlay',
				'show_if'            => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			'vo_icon_color'        => array(
				'label'       => esc_html__('Overlay Icon Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your overlay icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'overlay',
				'show_if'     => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			'vo_icon_size'         => array(
				'label'           => esc_html__('Overlay Icon Size', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom size for your overlay icon.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => '6rem',
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'     => 'overlay',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			'vo_bg'                => array(
				'label'       => esc_html__('Overlay background', 'divitorque'),
				'description' => esc_html__('Here you can define a custom background color for your overlay.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'overlay',
				'show_if'     => array(
					'main_figure' => 'video',
					'use_overlay' => 'on',
				),
			),

			// blurb.
			'equalize_content'     => array(
				'label'       => esc_html__('Equalize Content Height', 'divitorque'),
				'description' => esc_html__('Here you can equalize content heights for the both sides.', 'divitorque'),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'off',
				'toggle_slug' => 'general',
				'tab_slug'    => 'advanced',
				'show_if'     => array(
					'main_figure'      => 'image',
					'figure_placement' => array('left', 'right'),
				),
			),
			'content_alignment'    => array(
				'label'            => esc_html__('Content Alignment', 'divitorque'),
				'description'      => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'general',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'align_items'          => array(
				'label'       => esc_html__('Vertical Alignment', 'divitorque'),
				'description' => esc_html__('Choose content vertical alignment.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'general',
				'tab_slug'    => 'advanced',
				'default'     => 'flex-start',
				'options'     => array(
					'flex-start' => esc_html__('Top', 'divitorque'),
					'center'     => esc_html__('Center', 'divitorque'),
					'flex-end'   => esc_html__('Bottom', 'divitorque'),
				),
				'show_if'     => array(
					'figure_placement' => array('left', 'right'),
					'equalize_content' => 'off',
					'main_figure'      => 'image',
				),
			),
			'content_padding'      => array(
				'label'          => esc_html__('Content Padding', 'divitorque'),
				'description'    => esc_html__('Define custom content padding for the blurb content. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'toggle_slug'    => 'general',
				'tab_slug'       => 'advanced',
				'default'        => '15px|0px|0px|0px',
				'mobile_options' => true,
			),

			// figure.
			'figure_placement'     => array(
				'label'       => esc_html__('Media Placement', 'divitorque'),
				'description' => esc_html__('Choose icon/image placement.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'main_element',
				'tab_slug'    => 'advanced',
				'default'     => 'top',
				'options'     => array(
					'top'   => esc_html__('Top', 'divitorque'),
					'left'  => esc_html__('Left', 'divitorque'),
					'right' => esc_html__('Right', 'divitorque'),
				),
				'show_if_not' => array(
					'main_figure' => 'video',
				),
			),
			'icon_color'           => array(
				'label'       => esc_html__('Icon Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'main_element',
				'default'     => '#333',
				'hover'       => 'tabs',
				'show_if'     => array(
					'main_figure' => 'icon',
				),
			),

			'icon_size'            => array(
				'label'           => esc_html__('Icon Size', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom size for your icon.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => '45px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'     => 'main_element',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
				'show_if'         => array(
					'main_figure' => 'icon',
				),
			),

			'image_width'          => array(
				'label'          => esc_html__('Image Width', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom width for your image.', 'divitorque'),
				'type'           => 'range',
				'default'        => '100%',
				'default_unit'   => '%',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'show_if'        => array(
					'main_figure' => 'image',
				),
				'toggle_slug'    => 'main_element',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'main_figure' => 'image',
				),
			),

			'image_height'         => array(
				'label'           => esc_html__('Image Height', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom height for your image.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => 'auto',
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'     => 'main_element',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'main_figure'      => 'image',
					'equalize_content' => 'off',
				),
			),

			'img_anim'             => array(
				'label'       => esc_html__('Hover Animation', 'divitorque'),
				'description' => esc_html__('Select image hover animation.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'none',
				'options'     => array(
					'none'         => esc_html__('None', 'divitorque'),
					'zoom-in'      => esc_html__('Zoom In', 'divitorque'),
					'zoom-out'     => esc_html__('Zoom Out', 'divitorque'),
					'pulse'        => esc_html__('Pulse', 'divitorque'),
					'bounce'       => esc_html__('Bounce', 'divitorque'),
					'flash'        => esc_html__('Flash', 'divitorque'),
					'rubberBand'   => esc_html__('Rubber Band', 'divitorque'),
					'shake'        => esc_html__('Shake', 'divitorque'),
					'swing'        => esc_html__('Swing', 'divitorque'),
					'tada'         => esc_html__('Tada', 'divitorque'),
					'wobble'       => esc_html__('Wobble', 'divitorque'),
					'jello'        => esc_html__('Jello', 'divitorque'),
					'heartBeat'    => esc_html__('Heart Beat', 'divitorque'),
					'bounceIn'     => esc_html__('Bounce In', 'divitorque'),
					'fadeIn'       => esc_html__('Fade In', 'divitorque'),
					'flip'         => esc_html__('Flip', 'divitorque'),
					'lightSpeedIn' => esc_html__('Light Speed In', 'divitorque'),
					'rotateIn'     => esc_html__('Rotate In', 'divitorque'),
					'slideInUp'    => esc_html__('Slide In Up', 'divitorque'),
					'slideInDown'  => esc_html__('Slide In Down', 'divitorque'),
				),
				'show_if'     => array(
					'main_figure' => 'image',
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'main_element',
			),

			'icon_padding'         => array(
				'label'          => esc_html__('Icon Padding', 'divitorque'),
				'description'    => esc_html__('Define custom icon padding for the blurb icon. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'main_element',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'main_figure' => 'icon',
				),
			),
			'use_icon_box'         => array(
				'label'       => esc_html__('Use Icon Box', 'divitorque'),
				'description' => esc_html__('Here you can choose whether icon box should be used.', 'divitorque'),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'off',
				'toggle_slug' => 'main_element',
				'tab_slug'    => 'advanced',
				'show_if'     => array(
					'main_figure' => 'icon',
				),
			),
			'icon_bg'              => array(
				'label'       => esc_html__('Icon Background', 'divitorque'),
				'description' => esc_html__('Here you can define a custom background color for your icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'main_element',
				'default'     => 'transparent',
				'hover'       => 'tabs',
				'show_if'     => array(
					'use_icon_box' => 'on',
					'main_figure'  => 'icon',
				),
			),
			'icon_height'          => array(
				'label'           => esc_html__('Icon Height', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom height for your icon box.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => '80px',
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'     => 'main_element',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'use_icon_box' => 'on',
					'main_figure'  => 'icon',
				),
			),
			'icon_width'           => array(
				'label'           => esc_html__('Icon Width', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom height for your icon box.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default_unit'    => 'px',
				'default'         => '80px',
				'mobile_options'  => true,
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'     => 'main_element',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'use_icon_box' => 'on',
					'main_figure'  => 'icon',
				),
			),
			// Button.
			'btn_spacing_top'      => array(
				'label'           => esc_html__('Button Spacing Top', 'divitorque'),
				'description'     => esc_html__('Here you can define a custom spacing at the top of the button.', 'divitorque'),
				'type'            => 'range',
				'default'         => '15px',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'allowed_units'   => array('px'),
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'     => 'button',
				'tab_slug'        => 'advanced',
			),

			'title_bottom_spacing' => array(
				'label'          => esc_html__('Title Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of the title.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'title',
				'tab_slug'       => 'advanced',
			),

			// computed fields.
			'__video'              => array(
				'type'                => 'computed',
				'computed_callback'   => array('DTP_Info_Box', 'get_new_video'),
				'computed_depends_on' => array(
					'video',
				),
				'computed_minimum'    => array(
					'video',
				),
			),
		);

		$overlay = $this->get_overlay_option_fields('overlay', 'on', array('main_figure' => 'image'));

		return array_merge($fields, $overlay);
	}

	public function get_new_video($args = array(), $conditional_tags = array(), $current_page = array())
	{
		return false;
	}

	public function render_figure()
	{
		if ('image' === $this->props['main_figure']) {
			$processed_overlay_icon = esc_attr(et_pb_process_font_icon($this->props['overlay_icon']));
			$overlay_icon           = !empty($processed_overlay_icon) ? $processed_overlay_icon : '';
			$photo                  = $this->props['photo'];
			dtp_inject_fa_icons($this->props['overlay_icon']);
			return sprintf(
				'<div class="dtp-overlay"><i class="dtp-overlay-icon">%2$s</i></div>
				<img class="dtp-info-box-img dtp-swapped-img" src="%1$s" alt=""/>',
				$photo,
				$overlay_icon
			);
		} elseif ('icon' === $this->props['main_figure']) {
			$icon_name = esc_attr(et_pb_process_font_icon($this->props['icon']));

			// Inject Font Awesome Manually!.
			dtp_inject_fa_icons($this->props['icon']);

			return sprintf(
				'<span class="dtp-info-box-icon">
					<i class="dtp-et-icon">%1$s</i>
				</span>',
				$icon_name
			);
		} else {
			$video_src    = '';
			$overlay_html = '';
			$overlay_src  = $this->props['vo_src'];

			if (false !== et_pb_check_oembed_provider(esc_url($this->props['video']))) {
				$video_src = wp_oembed_get(esc_url($this->props['video']));
			} else {
				$video     = $this->props['video'];
				$video_src = sprintf('<video controls><source type="video/mp4" src="%1$s"></video>', $video);
			}

			if (!empty($overlay_src)) {
				$overlay_html = sprintf(
					'<div style="background-image: url(%1$s)" class="et_pb_video_overlay">
						<div class="et_pb_video_overlay_hover">
							<a href="#" class="et_pb_video_play"></a>
						</div>
					</div>',
					$overlay_src
				);
			}

			return sprintf(
				'<div class="dtp-content-video et_pb_video">
					<div class="et_pb_video_box dtp-content-video-wrap">
						%1$s
					</div>
					%2$s
				</div>',
				$video_src,
				$overlay_html
			);
		}
	}

	public function render_title()
	{
		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level($title_level, 'h2');
		$processed_title_level = esc_html($processed_title_level);

		if (!empty($title_text)) {
			return sprintf('<%2$s class="dtp-info-box-title">%1$s</%2$s>', $title_text, $processed_title_level);
		}
	}

	public function _render_button()
	{
		if ('on' === $this->props['use_button']) {
			$button_custom = $this->props['custom_button'];
			$button_text   = isset($this->props['button_text']) ? $this->props['button_text'] : 'Button';
			$button_link   = isset($this->props['button_link']) ? $this->props['button_link'] : '#';
			$button_url    = trim($button_link);
			$button_rel    = isset($this->props['button_rel']) ? $this->props['button_rel'] : '';
			$new_tab       = $this->props['is_new_wndow'];

			$custom_icon_values = et_pb_responsive_options()->get_property_values($this->props, 'button_icon');
			$custom_icon        = isset($custom_icon_values['desktop']) ? $custom_icon_values['desktop'] : '';
			$custom_icon_tablet = isset($custom_icon_values['tablet']) ? $custom_icon_values['tablet'] : '';
			$custom_icon_phone  = isset($custom_icon_values['phone']) ? $custom_icon_values['phone'] : '';
			$multi_view         = et_pb_multi_view_options($this);

			if (function_exists('dtp_inject_fa_icons')) {
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['button_icon']);
			}

			$button = $this->render_button(
				array(
					'button_id'           => $this->module_id(false),
					'button_classname'    => array('dtp-btn-default', 'dtp-btn-info-box'),
					'button_custom'       => $button_custom,
					'button_text'         => $button_text,
					'button_rel'          => $button_rel,
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
							'hover_selector' => '%%order_class%% .dtp-btn-info-box',
							'visibility'     => array(
								'button_text' => '__not_empty',
							),
						)
					),
				)
			);

			return sprintf(
				'<div class="dtp-info-box-btn">
                    %1$s
                </div>',
				$button
			);
		}
	}

	public function render_MCE()
	{
		$body_text = $this->props['body_text'];
		$content      = force_balance_tags($body_text);
		$content      = preg_replace('~\s?<p></p>\s?~', '', $content);

		if (!empty($content)) {
			return sprintf('<div class="dtp-mce-content">%1$s</div>', $content);
		}
	}

	public function render_main_element()
	{
		$photo = $this->props['photo'];
		$icon  = $this->props['icon'];
		$video = $this->props['video'];

		if (!empty($photo) || !empty($icon) || !empty($video)) {
			return sprintf('<div class="dtp-info-box-figure"> %1$s</div>', $this->render_figure());
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_style('torq-blurb');
		$this->render_css($render_slug);
		$this->remove_classname('et_pb_module');
		$this->add_classname('ba_et_pb_module');

		return sprintf(
			'<div class="dtp-info-box dtp-swapped-img-selector dtp-hover--%1$s">
			    %2$s
                <div class="dtp-info-box-content">
                    %3$s %4$s %5$s
                </div>
		    </div>',
			$this->props['img_anim'],
			$this->render_main_element(),
			$this->render_title(),
			$this->render_MCE(),
			$this->_render_button()
		);
	}

	public function render_css($render_slug)
	{
		$main_figure      = $this->props['main_figure'];
		$use_icon_box     = $this->props['use_icon_box'];
		$align_items      = $this->props['align_items'];
		$equalize_content = $this->props['equalize_content'];
		$figure_placement = $this->props['figure_placement'];
		$image_height     = $this->props['image_height'];
		$icon_bg_hover    = $this->get_hover_value('icon_bg');
		$icon_color_hover = $this->get_hover_value('icon_color');
		$vo_icon_color    = $this->props['vo_icon_color'];
		$vo_icon_size     = $this->props['vo_icon_size'];
		$vo_bg            = $this->props['vo_bg'];

		if ('video' !== $main_figure) {
			if ('top' !== $figure_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-info-box',
						'declaration' => 'display: flex;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-info-box-content',
						'declaration' => 'flex: 1 1;',
					)
				);
			}

			if ('right' === $figure_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-info-box',
						'declaration' => 'flex-direction: row-reverse;',
					)
				);
			}
		}

		// Media Image.
		if ('image' === $main_figure) {
			$this->get_responsive_styles(
				'image_width',
				'%%order_class%% .dtp-info-box .dtp-info-box-figure',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array('default' => '100%'),
				$render_slug
			);
			$this->get_responsive_styles(
				'image_width',
				'%%order_class%% .dtp-info-box .dtp-info-box-figure',
				array(
					'primary'   => 'flex',
					'important' => true,
				),
				array('default' => '100%'),
				$render_slug
			);

			if ('off' === $equalize_content) {
				if ('top' !== $figure_placement && 'auto' !== $image_height) {
					$this->get_responsive_styles(
						'image_height',
						'%%order_class%% .dtp-info-box .dtp-info-box-figure',
						array(
							'primary'   => 'height',
							'important' => true,
						),
						array('default' => '100%'),
						$render_slug
					);

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-info-box .dtp-info-box-figure img',
							'declaration' => 'height: 100%; object-fit: cover;width:100%;',
						)
					);

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-info-box',
							'declaration' => sprintf('align-items: %1$s !important;', $align_items),
						)
					);
				}
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-info-box .dtp-info-box-figure img',
						'declaration' => 'height: 100%; object-fit: cover;width:100%;',
					)
				);
			}
		}

		// Button.
		$this->get_buttons_styles('button', $render_slug, '%%order_class%% .dtp-info-box .dtp-btn-info-box');

		$this->get_responsive_styles(
			'btn_spacing_top',
			'%%order_class%% .dtp-info-box-btn',
			array(
				'primary'   => 'padding-top',
				'important' => false,
			),
			array('default' => '15px'),
			$render_slug
		);

		// Texts.
		$this->get_responsive_styles(
			'title_bottom_spacing',
			'%%order_class%% .dtp-info-box-title',
			array(
				'primary'   => 'padding-bottom',
				'important' => true,
			),
			array('default' => '10px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'content_alignment',
			'%%order_class%%',
			array(
				'primary'   => 'text-align',
				'important' => false,
			),
			array('default' => 'left'),
			$render_slug
		);

		// Content Padding.
		$this->get_responsive_styles(
			'content_padding',
			'%%order_class%% .dtp-info-box-content',
			array(
				'primary'   => 'padding',
				'important' => false,
			),
			array('default' => '15px|0px|0px|0px'),
			$render_slug
		);

		// Icon.
		if ('icon' === $main_figure) {
			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtp-info-box-icon',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);

			if ('on' === $use_icon_box) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-info-box-icon',
						'declaration' => sprintf('background: %1$s;', $this->props['icon_bg']),
					)
				);

				if (!empty($icon_bg_hover)) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-info-box-icon:hover',
							'declaration' => sprintf('background: %1$s', $icon_bg_hover),
						)
					);
				}

				$this->get_responsive_styles(
					'icon_height',
					'%%order_class%% .dtp-info-box-icon',
					array(
						'primary'   => 'height',
						'important' => false,
					),
					array('default' => '80px'),
					$render_slug
				);

				$this->get_responsive_styles(
					'icon_width',
					'%%order_class%% .dtp-info-box-icon',
					array(
						'primary'   => 'width',
						'important' => false,
					),
					array('default' => '80px'),
					$render_slug
				);
			}
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-info-box-icon i',
				'declaration' => sprintf('color: %1$s;', $this->props['icon_color']),
			)
		);

		$this->get_responsive_styles(
			'icon_size',
			'%%order_class%% .dtp-info-box-icon i',
			array(
				'primary'   => 'font-size',
				'important' => false,
			),
			array('default' => '45px'),
			$render_slug
		);

		if (!empty($icon_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-info-box-icon:hover i',
					'declaration' => sprintf('color: %1$s;', $icon_color_hover),
				)
			);
		}

		// Icon Padding.
		$this->get_responsive_styles(
			'icon_padding',
			'%%order_class%% .dtp-info-box-icon',
			array(
				'primary'   => 'padding',
				'important' => false,
			),
			array('default' => '0px|0px|0px|0px'),
			$render_slug
		);

		// Overlay Styles.
		$this->get_overlay_style($render_slug, 'photo', '%%order_class%%');

		// video Icon.
		if (!empty($vo_icon_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .et_pb_video_overlay .et_pb_video_play',
					'declaration' => sprintf('color: %1$s;', $vo_icon_color),
				)
			);
		}

		if (!empty($vo_icon_size)) {
			$this->get_responsive_styles(
				'vo_icon_size',
				'%%order_class%% .et_pb_video_overlay .et_pb_video_play',
				array(
					'primary'   => 'font-size',
					'important' => false,
				),
				array('default' => '6rem'),
				$render_slug
			);
		}

		if (!empty($vo_bg)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .et_pb_video_overlay_hover:hover',
					'declaration' => sprintf('background: %1$s;', $vo_bg),
				)
			);
		}

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'overlay_icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-overlay .dtp-overlay-icon',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);
	}
}

new DTP_Blurb();
