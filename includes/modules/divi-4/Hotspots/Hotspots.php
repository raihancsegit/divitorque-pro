<?php

class DTP_HotSpots extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_hotspot';
		$this->child_slug = 'torq_hotspot_child';
		$this->name       = esc_html__('Torq Hotspots', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'hotspot.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'image' => esc_html__('Image', 'divitorque'),
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
					'border'         => esc_html__('Border', 'divitorque'),
					'box_shadow'     => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'image'      => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-hotspots img',
			),
			'spot'       => array(
				'label'    => esc_html__('Spot', 'divitorque'),
				'selector' => '%%order_class%% .torq_hotspot_child',
			),
			'spot_inner' => array(
				'label'    => esc_html__('Spot Inner', 'divitorque'),
				'selector' => '%%order_class%% .dtp-hotspot-label',
			),
			'spot_icon'  => array(
				'label'    => esc_html__('Spot Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-hotspot-label i',
			),
			'wave'       => array(
				'label'    => esc_html__('Animated Wave', 'divitorque'),
				'selector' => '%%order_class%% .torq_hotspot_child:before',
			),
		);
	}

	public function get_fields()
	{
		$image = array(
			'image'     => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'image',
			),
			'image_alt' => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'image',
			),
		);

		$spot = array(
			'spot_height'     => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define custom height for the spot.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '40px',
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
				'default'        => '40px',
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
				'default'      => '#ffffff',
			),
			'spot_icon_size'  => array(
				'label'          => esc_html__('Icon/Image Size', 'divitorque'),
				'description'    => esc_html__('Control the size of the spot icon by increasing or decreasing the range.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '30px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'spot',
				'tab_slug'       => 'advanced',
			),
		);

		$tooltip = array(
			'tp_alignment'   => array(
				'label'            => esc_html__('Content Alignment', 'divitorque'),
				'description'      => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'module_align',
				'default_on_front' => 'left',
				'toggle_slug'      => 'tooltip',
				'tab_slug'         => 'advanced',
				'mobile_options'   => true,
			),
			'tp_width'       => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define tooltip width.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '250px',
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
				'default'        => '15px|15px|15px|15px',
				'mobile_options' => true,
			),
			'tp_arrow_color' => array(
				'label'        => esc_html__('Arrow Color', 'divitorque'),
				'description'  => esc_html__('Pick a color to use for the tooltip arrow.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'tooltip',
				'default'      => '#333333',
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
				'default'      => '#ffffff',
			),
			'tp_media_size'    => array(
				'label'          => esc_html__('Icon/Image Size', 'divitorque'),
				'description'    => esc_html__('Define icon/image size for the tooltip.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '60px',
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
				'default'        => 'initial',
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
				'default'        => '0px|0px|0px|0px',
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
			$this->default_color
		);

		$spacing = array(
			'tp_title_spacing' => array(
				'label'          => esc_html__('Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the title.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'default'        => '15px',
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
				'default'        => '0px',
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
				'default'        => '15px',
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
			'#333333'
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

		return array_merge($image, $spot, $spot_bg, $tooltip, $tooltip_media, $tooltip_bg, $tp_media_bg, $spacing);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['fonts']       = array();
		$advanced_fields['text_shadow'] = array();

		$advanced_fields['box_shadow']['spot'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'spot',
			'css'         => array(
				'main' => '%%order_class%% .dtp-hotspot-label',
			),
		);

		$advanced_fields['box_shadow']['tooltip'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'tooltip',
			'css'         => array(
				'main' => '%%order_class%% .tippy-box',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main' => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
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

		$advanced_fields['borders']['media'] = array(
			'toggle_slug' => 'tooltip_media',
			'css'         => array(
				'main' => array(
					'border_radii'  => '%%order_class%% .dtp-hotspot-tp-figure',
					'border_styles' => '%%order_class%% .dtp-hotspot-tp-figure',
				),
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
				'main' => array(
					'border_radii'  => '%%order_class%% .dtp-hotspot-label',
					'border_styles' => '%%order_class%% .dtp-hotspot-label',
				),
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
				'main' => '%%order_class%% .dtp-hotspot-label-text',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'spot_text',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main' => '%%order_class%% .dtp-hotspot-title',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'tooltip_text',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '18px',
			),
		);

		$advanced_fields['fonts']['desc'] = array(
			'css'             => array(
				'main' => '%%order_class%% .dtp-hotspot-desc',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'tooltip_text',
			'sub_toggle'      => 'desc',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['button']['tp_btn'] = array(
			'label'         => esc_html__('Button', 'divitorque'),
			'toggle_slug'   => 'tooltip_button',
			'css'           => array(
				'main' => '%%order_class%% .dtp-hotspot-btn-wrap .dtp-hotspot-btn',
			),
			'use_alignment' => false,
			'hide_icon'     => true,
			'box_shadow'    => array(
				'css' => array(
					'main' => '%%order_class%% .dtp-hotspot-btn-wrap .dtp-hotspot-btn',
				),
			),
		);

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_script('torq-hotspot');
		wp_enqueue_style('torq-hotspot');
		wp_enqueue_script('torq-tippy');
		wp_enqueue_style('torq-tippy');
		$this->render_module_css($render_slug);

		return sprintf(
			'<div class="dtp-module dtp-front dtp-hotspots" data-order="%4$s">
				<img class="dtp-hotspots-img-root" src="%1$s" alt="%2$s" />
				%3$s
			</div>',
			$this->props['image'],
			$this->props['image_alt'],
			$this->props['content'],
			self::get_module_order_class($render_slug)
		);
	}

	protected function render_module_css($render_slug)
	{
		$tp_width              = $this->props['tp_width'];
		$tp_media_size         = $this->props['tp_media_size'];
		$tp_arrow_color        = $this->props['tp_arrow_color'];
		$tp_media_color        = $this->props['tp_media_color'];
		$spot_icon_color       = $this->props['spot_icon_color'];
		$spot_icon_color_hover = $this->get_hover_value('spot_icon_color');

		// Spot.
		$this->get_responsive_styles(
			'spot_height',
			'%%order_class%% .dtp-hotspot-label, %%order_class%% .torq_hotspot_child',
			array('primary' => 'height'),
			array('default' => '40px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'spot_width',
			'%%order_class%% .dtp-hotspot-label, %%order_class%% .torq_hotspot_child',
			array('primary' => 'width'),
			array('default' => '40px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'spot_icon_size',
			'%%order_class%% .dtp-hotspot-label i',
			array('primary' => 'font-size'),
			array('default' => '30px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'spot_icon_size',
			'%%order_class%% .dtp-hotspot-label img',
			array('primary' => 'width'),
			array('default' => '20px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-hotspot-label i',
				'declaration' => sprintf(
					'color:%1$s;',
					$spot_icon_color
				),
			)
		);

		if (!empty($spot_icon_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .dtp-hotspot-label i',
					'declaration' => sprintf(
						'color:%1$s;',
						$spot_icon_color_hover
					),
				)
			);
		}

		$this->get_custom_bg_style($render_slug, 'spot', '%%order_class%% .dtp-hotspot-label', '%%order_class%% .dtp-hotspot-label:hover');

		// Tooltip.
		if (!empty($tp_width)) {
			$this->get_responsive_styles(
				'tp_width',
				'%%order_class%% .tippy-box',
				array('primary' => 'width'),
				array('default' => 'initial'),
				$render_slug
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .tippy-content',
				'declaration' => 'padding: 0!important;',
			)
		);

		$this->get_responsive_styles(
			'tp_alignment',
			'%%order_class%% .tippy-content',
			array('primary' => 'text-align'),
			array('default' => 'left'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .tippy-arrow',
				'declaration' => sprintf(
					'color:%1$s;',
					$tp_arrow_color
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%%',
				'declaration' => 'pointer-events: initial!important;',
			)
		);

		$this->get_responsive_styles(
			'tp_padding',
			'%%order_class%% .tippy-box',
			array(
				'primary'   => 'padding',
				'important' => true,
			),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		$this->get_custom_bg_style($render_slug, 'tooltip', '%%order_class%% .tippy-box', '%%order_class%% .tippy-box:hover');

		// Tooltip Media.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-hotspot-tp-icon i',
				'declaration' => sprintf(
					'color:%1$s;
					font-size:%2$s;',
					$tp_media_color,
					$tp_media_size
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-hotspot-tp-figure img',
				'declaration' => sprintf(
					'width:%1$s;',
					$tp_media_size
				),
			)
		);

		if (!empty($tp_media_height)) {
			$this->get_responsive_styles(
				'tp_media_height',
				'%%order_class%% .dtp-hotspot-tp-figure',
				array('primary' => 'height'),
				array('default' => 'auto'),
				$render_slug
			);
		}

		if (!empty($tp_media_width)) {
			$this->get_responsive_styles(
				'tp_media_width',
				'%%order_class%% .dtp-hotspot-tp-figure',
				array('primary' => 'width'),
				array('default' => 'auto'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'tp_media_padding',
			'%%order_class%% .dtp-hotspot-tp-figure',
			array('primary' => 'padding'),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		$this->get_custom_bg_style($render_slug, 'tp_media', '%%order_class%% .dtp-hotspot-tp-figure', '%%order_class%%:hover .dtp-hotspot-tp-figure');

		// Spacing.
		$this->get_responsive_styles(
			'tp_title_spacing',
			'%%order_class%% .dtp-hotspot-title',
			array('primary' => 'margin-top'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'tp_desc_spacing',
			'%%order_class%% .dtp-hotspot-desc',
			array('primary' => 'margin-top'),
			array('default' => '0px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'tp_btn_spacing',
			'%%order_class%% .dtp-hotspot-btn-wrap',
			array('primary' => 'margin-top'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_buttons_styles('tp_btn', $render_slug, '%%order_class%% .dtp-hotspot-btn-wrap .dtp-hotspot-btn');
	}

	public function add_new_child_text()
	{
		return esc_html__('Add New Hotspot', 'divitorque');
	}
}

new DTP_HotSpots();
