<?php
class DTP_Image_Scroll extends DTP_Builder_Module
{
	public $slug       = 'torq_img_scroll';
	public $vb_support = 'on';

	public function init()
	{
		$this->name      = esc_html__('Torq Image Scroll', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'image-scrolling.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__('Content', 'divitorque'),
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'image'   => esc_html__('Image', 'divitorque'),
					'overlay' => esc_html__('Overlay', 'divitorque'),
					'icon'    => esc_html__('Icon', 'divitorque'),
					'border'  => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'image' => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-image-scroll img',
			),
			'icon'  => array(
				'label'    => esc_html__('Direction Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-image-scroll-icon-el',
			),
		);
	}

	public function get_fields()
	{
		$fields = array(

			// content.
			'image'             => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'toggle_slug'        => 'content',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
			),

			'image_alt'         => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),

			'show_icon'         => array(
				'label'       => esc_html__('Show Direction Icon', 'divitorque'),
				'description' => esc_html__('Here you can choose whether direction icon should be displayed.', 'divitorque'),
				'type'        => 'yes_no_button',
				'default'     => 'off',
				'toggle_slug' => 'content',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),

			'icon'              => array(
				'label'           => esc_html__('Select Icon', 'divitorque'),
				'description'     => esc_html__('Select direction icon.', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'default'         => '&#x2a;||divi||400',
				'show_if'         => array(
					'show_icon' => 'on',
					'use_image' => 'off',
				),
			),

			'use_image'         => array(
				'label'           => esc_html__('Use Icon Image', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether icon image should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
				'show_if'         => array(
					'show_icon' => 'on',
				),
			),

			'icon_image'        => array(
				'label'              => esc_html__('Upload Icon Image', 'divitorque'),
				'description'        => esc_html__('Upload an icon image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Icon', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Icon', 'divitorque'),
				'update_text'        => esc_attr__('Set As Icon', 'divitorque'),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'use_image' => 'on',
					'show_icon' => 'on',
				),
			),

			// settings.
			'use_icon_anim'     => array(
				'label'       => esc_html__('Use Icon Animation', 'divitorque'),
				'description' => esc_html__('Here you can choose whether icon animation should be used.', 'divitorque'),
				'type'        => 'yes_no_button',
				'default'     => 'off',
				'toggle_slug' => 'content',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'show_if'     => array(
					'show_icon' => 'on',
				),
			),

			'scroll_type'       => array(
				'label'       => esc_html__('Scroll Type', 'divitorque'),
				'description' => esc_html__('Here you can define scroll type.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'on_hover',
				'options'     => array(
					'on_hover'  => esc_html__('On Mouse Hover', 'divitorque'),
					'on_scroll' => esc_html__('On Mouse Scroll', 'divitorque'),
				),
				'toggle_slug' => 'settings',
			),

			'scroll_dir_scroll' => array(
				'label'       => esc_html__('Scroll Direction', 'divitorque'),
				'description' => esc_html__('Here you can define scroll direction.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'vertical',
				'options'     => array(
					'vertical'   => esc_html__('Vertical', 'divitorque'),
					'horizontal' => esc_html__('Horizontal', 'divitorque'),
				),
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'scroll_type' => 'on_scroll',
				),
			),

			'scroll_dir_hover'  => array(
				'label'       => esc_html__('Scroll Direction', 'divitorque'),
				'description' => esc_html__('Here you can define scroll direction.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'Y_btt',
				'options'     => array(
					'Y_btt' => esc_html__('Bottom to Top', 'divitorque'),
					'Y_ttb' => esc_html__('Top to Bottom', 'divitorque'),
					'X_ltr' => esc_html__('Left to Right', 'divitorque'),
					'X_rtl' => esc_html__('Right to Left', 'divitorque'),
				),
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'scroll_type' => 'on_hover',
				),
			),

			'scroll_speed'      => array(
				'label'          => esc_html__('Scroll Speed', 'divitorque'),
				'description'    => esc_html__('Define timing for the scroll event.', 'divitorque'),
				'type'           => 'range',
				'default'        => '700ms',
				'fixed_unit'     => 'ms',
				'default_unit'   => 'ms',
				'range_settings' => array(
					'min'  => '50',
					'max'  => '1000',
					'step' => '50',
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'scroll_type' => 'on_hover',
				),
			),

			// image.
			'img_height'        => array(
				'label'          => esc_html__('Image Height', 'divitorque'),
				'description'    => esc_html__('Define static height for the image.', 'divitorque'),
				'type'           => 'range',
				'default'        => '200px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '800',
					'step' => '1',
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'image',
				'mobile_options' => true,
			),

			// overlay.
			'use_overlay'       => array(
				'label'           => esc_html__('Use Image Overlay', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether image overlay should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
			),

			// icon.
			'icon_color'        => array(
				'label'       => esc_html__('Icon Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2EA3F2',
				'toggle_slug' => 'icon',
				'show_if'     => array(
					'use_image' => 'off',
					'show_icon' => 'on',
				),
			),

			'icon_size'         => array(
				'label'          => esc_html__('Icon Size', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom size for your icon.', 'divitorque'),
				'type'           => 'range',
				'default'        => '48px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_icon' => 'on',
				),
			),
		);

		$overlay_bg = $this->custom_background_fields(
			'overlay',
			esc_html__('Overlay', 'divitorque'),
			'advanced',
			'overlay',
			array('color', 'gradient'),
			array('use_overlay' => 'on'),
			'rgba(255,255,255,0.39)'
		);

		return array_merge($fields, $overlay_bg);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['borders']['icon'] = array(
			'label_prefix' => esc_html__('Icon', 'divitorque'),
			'toggle_slug'  => 'icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-image-scroll-icon-el',
					'border_styles' => '%%order_class%% .dtp-image-scroll-icon-el',
				),
				'important' => 'all',
			),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

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
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}

	public function render_icon()
	{
		$show_icon  = $this->props['show_icon'];
		$use_image  = $this->props['use_image'];
		$icon_image = $this->props['icon_image'];
		$icon       = $this->props['icon'];

		if ($show_icon === 'on') {
			if ($use_image === 'on') {
				return sprintf(
					'
                    <div class="dtp-image-scroll-icon">
                        <div class="dtp-image-scroll-icon-el">
                            <img src="%1$s" alt=""/>
                        </div>
                    </div>',
					$icon_image
				);
			} else {
				$icon = esc_attr(et_pb_process_font_icon($icon));
				dtp_inject_fa_icons($this->props['icon']);
				return sprintf(
					'
                    <div class="dtp-image-scroll-icon dtp-et-font-icon">
                        <div class="dtp-image-scroll-icon-el">
                            %1$s
                        </div>
                    </div>',
					$icon
				);
			}
		}
	}

	public function render_overlay()
	{
		$use_overlay = $this->props['use_overlay'];
		if ('on' === $use_overlay) {
			return '<div class="dtp-image-scroll-overlay"></div>';
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_style('torq-image-scroll');
		wp_enqueue_script('torq-image-scroll');
		$image             = $this->props['image'];
		$image_alt         = $this->props['image_alt'];
		$scroll_type       = $this->props['scroll_type'];
		$scroll_dir_hover  = $this->props['scroll_dir_hover'];
		$scroll_dir_scroll = $this->props['scroll_dir_scroll'];

		// Render CSS.
		$this->render_css($render_slug);

		if (!empty($image)) {
			return sprintf(
				'
                <div class="dtp-module dtp-image-scroll" data-dir-hover="%5$s" data-dir-scroll="%6$s">
                    %1$s
                    <div class="scroll-figure-wrap">
                        %2$s
                        <img class="dtp-image-scroll-el" src="%3$s" alt="%4$s" />
                    </div>
                </div>',
				$this->render_icon(),
				$this->render_overlay(),
				$image,
				$image_alt,
				$scroll_type === 'on_hover' ? $scroll_dir_hover : 'none',
				$scroll_type === 'on_scroll' ? $scroll_dir_scroll : 'none'
			);
		} else {
			return '<div class="dtp-module dtp-image-scroll"></div>';
		}
	}

	protected function render_css($render_slug)
	{
		$icon_color                   = $this->props['icon_color'];
		$use_image                    = $this->props['use_image'];
		$show_icon                    = $this->props['show_icon'];
		$use_icon_anim                = $this->props['use_icon_anim'];
		$icon_size                    = $this->props['icon_size'];
		$scroll_speed                 = $this->props['scroll_speed'];
		$scroll_type                  = $this->props['scroll_type'];
		$scroll_dir_scroll            = $this->props['scroll_dir_scroll'];
		$scroll_dir_hover             = $this->props['scroll_dir_hover'];
		$img_height                   = $this->props['img_height'];
		$img_height_tablet            = $this->props['img_height_tablet'];
		$img_height_phone             = $this->props['img_height_phone'];
		$img_height_last_edited       = $this->props['img_height_last_edited'];
		$img_height_responsive_status = et_pb_get_responsive_status($img_height_last_edited);

		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-image-scroll-icon-el',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		if ($use_icon_anim === 'on') {
			$anim_dir = '';
			if ($scroll_type === 'on_scroll') {
				if ($scroll_dir_scroll === 'vertical') {
					$anim_dir = 'Y';
				} else {
					$anim_dir = 'X';
				}
			} else {
				$anim_dir = $scroll_dir_hover[0];
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-image-scroll-icon-el',
					'declaration' => sprintf(
						'
                    animation-name: dtp-scroll-%1$s;
                    animation-duration: .5s;
                    animation-iteration-count: infinite;
                    animation-direction: alternate;
                    animation-timing-function: ease-in-out;',
						$anim_dir
					),
				)
			);
		}

		// Icon
		if ($show_icon === 'on') {
			if ($use_image === 'off') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll-icon-el',
						'declaration' => sprintf('color: %1$s; font-size: %2$s;', $icon_color, $icon_size),
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll-icon img',
						'declaration' => sprintf('width: %1$s; ', $icon_size),
					)
				);
			}
		}

		// Scroll
		if ($scroll_type === 'on_scroll') {
			if ($scroll_dir_scroll === 'vertical') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll',
						'declaration' => 'overflow-y: auto;overflow-x:hidden;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
						'declaration' => 'max-width: 100%;width: 100%;',
					)
				);
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll',
						'declaration' => 'overflow-y:hidden;overflow-x: auto;',
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
						'declaration' => 'height: 100%; max-width: none;width: auto;',
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .scroll-figure-wrap',
						'declaration' => 'height: 100%;width: 100%;',
					)
				);
			}
		} elseif ($scroll_type === 'on_hover') {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .scroll-figure-wrap',
					'declaration' => 'height:100%;width:100%;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-image-scroll',
					'declaration' => 'overflow: hidden;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
					'declaration' => sprintf('position:absolute;transition: %1$s;', $scroll_speed),
				)
			);

			if ($scroll_dir_hover === 'X_ltr' || $scroll_dir_hover === 'X_rtl') {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
						'declaration' => 'height: 100%; max-width: none;width: auto;top:0;',
					)
				);

				if ($scroll_dir_hover === 'X_ltr') {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
							'declaration' => 'right:0;',
						)
					);
				} elseif ($scroll_dir_hover === 'X_rtl') {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
							'declaration' => 'left:0;',
						)
					);
				}
			} else {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
						'declaration' => 'max-width: 100%;width: 100%; left:0;',
					)
				);

				if ($scroll_dir_hover === 'Y_ttb') {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
							'declaration' => 'bottom:0;',
						)
					);
				} elseif ($scroll_dir_hover === 'Y_btt') {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-image-scroll .dtp-image-scroll-el',
							'declaration' => 'top:0;',
						)
					);
				}
			}
		}

		// image height
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-scroll',
				'declaration' => sprintf('height: %1$s;', $img_height),
			)
		);

		if ($img_height_tablet && $img_height_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-image-scroll',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf('height: %1$s;', $img_height_tablet),
				)
			);
		}

		if ($img_height_phone && $img_height_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-image-scroll',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf('height: %1$s;', $img_height_phone),
				)
			);
		}

		// overlay
		$this->get_custom_bg_style($render_slug, 'overlay', '%%order_class%% .dtp-image-scroll-overlay', '');
	}
}

new DTP_Image_Scroll();
