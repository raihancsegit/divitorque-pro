<?php

class DTP_Social_Share  extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_social_share';
		$this->child_slug = 'torq_social_share_child';
		$this->name       = esc_html__('Torq Social Share', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'social-share.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general'    => esc_html__('General', 'divitorque'),
					'icon'       => esc_html__('Icon', 'divitorque'),
					'text'       => esc_html__('Text', 'divitorque'),
					'border'     => esc_html__('Border', 'divitorque'),
					'box_shadow' => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'icon_wrap' => array(
				'label'    => esc_html__('Icon Wrapper', 'divitorque'),
				'selector' => '%%order_class%% .dtp-social-share-icon',
			),
			'icon'      => array(
				'label'    => esc_html__('Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-social-share-icon svg',
			),
			'text'      => array(
				'label'    => esc_html__('Share Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-social-share-text',
			),
		);
	}

	public function get_fields()
	{
		$settings = array(
			'placement'         => array(
				'label'       => esc_html__('Placement', 'divitorque'),
				'description' => esc_html__('Here you can define button placement.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'horizontal',
				'options'     => array(
					'horizontal' => esc_html__('Horizontal', 'divitorque'),
					'vertical'   => esc_html__('Vertical', 'divitorque'),
				),
			),
			'layout'            => array(
				'label'       => esc_html__('Layout', 'divitorque'),
				'description' => esc_html__('Here you can define button layout.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'modern',
				'options'     => array(
					'classic' => esc_html__('Classic', 'divitorque'),
					'modern'  => esc_html__('Modern', 'divitorque'),
				),
			),
			'display_type'      => array(
				'label'       => esc_html__('Display Type', 'divitorque'),
				'description' => esc_html__('Here you can define button display type.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'block',
				'options'     => array(
					'block'        => esc_html__('Block', 'divitorque'),
					'inline-block' => esc_html__('Inline Block', 'divitorque'),
				),
				'show_if'     => array(
					'placement' => 'vertical',
				),
			),
			'show_icon'         => array(
				'label'       => esc_html__('Show Icon', 'divitorque'),
				'description' => esc_html__('Here you can choose whether icon should be displayed.', 'divitorque'),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'on',
				'toggle_slug' => 'settings',
			),
			'show_arrow'        => array(
				'label'       => esc_html__('Show Icon Arrow', 'divitorque'),
				'description' => esc_html__('Here you can choose whether icon shape should be displayed.', 'divitorque'),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'off',
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'layout'    => 'modern',
					'show_icon' => 'on',
				),
			),
			'icon_placement'    => array(
				'label'           => esc_html__('Icon Placement', 'divitorque'),
				'description'     => esc_html__('Align icon to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'module_align',
				'default'         => 'left',
				'toggle_slug'     => 'settings',
				'show_if'         => array(
					'show_icon' => 'on',
					'layout'    => 'modern',
				),
			),
			'content_alignment' => array(
				'label'           => esc_html__('Content Alignment', 'divitorque'),
				'description'     => esc_html__('Align button content to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'module_align',
				'default'         => 'center',
				'toggle_slug'     => 'settings',
				'mobile_options'  => true,
				'show_if'         => array(
					'layout' => 'classic',
				),
			),
			'show_text'         => array(
				'label'       => esc_html__('Show Share Text', 'divitorque'),
				'description' => esc_html__('Here you can choose whether share text should be displayed.', 'divitorque'),
				'type'        => 'yes_no_button',
				'options'     => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'     => 'on',
				'toggle_slug' => 'settings',
			),
			'items_per_row'     => array(
				'label'          => esc_html__('Buttons Per Row', 'divitorque'),
				'description'    => esc_html__('Define total numbers of buttons per row.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'unitless'       => true,
				'default'        => 'auto',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 20,
				),
				'toggle_slug'    => 'settings',
				'show_if'        => array(
					'placement' => 'horizontal',
				),
			),
			'item_alignment'    => array(
				'label'           => esc_html__('Buttons Alignment', 'divitorque'),
				'description'     => esc_html__('Align buttons to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'mobile_options'  => true,
				'options_icon'    => 'module_align',
				'default'         => 'left',
				'toggle_slug'     => 'settings',
			),
			'item_spacing'      => array(
				'label'          => esc_html__('Button Spacing', 'divitorque'),
				'description'    => esc_html__('Define spacing between share buttons.', 'divitorque'),
				'type'           => 'range',
				'default'        => '5px',
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

		$general = array(
			'btn_padding' => array(
				'label'       => esc_html__('Button Padding', 'divitorque'),
				'description' => esc_html__('Define custom padding for the button. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'        => 'custom_padding',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'general',
			),
		);

		$icon = array(
			'icon_spacing' => array(
				'label'          => esc_html__('Icon Spacing Gap', 'divitorque'),
				'description'    => esc_html__('Define custom spacing for the icon.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'show_text' => 'on',
				),
			),
			'arrow_color'  => array(
				'label'       => esc_html__('Arrow Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your icon arrow.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => 'rgba(0,0,0,.3)',
				'hover'       => 'tabs',
				'show_if'     => array(
					'show_arrow' => 'on',
				),
			),
			'icon_color'   => array(
				'label'       => esc_html__('Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => '#ffffff',
				'hover'       => 'tabs',
			),
			'icon_size'    => array(
				'label'          => esc_html__('Size', 'divitorque'),
				'description'    => esc_html__('Control the size of the icon by increasing or decreasing the font size.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'fixed_unit'     => 'px',
				'default'        => '20px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'hover'          => 'tabs',
			),
			'icon_height'  => array(
				'label'          => esc_html__('Wrapper Height', 'divitorque'),
				'description'    => esc_html__('Here you can define static height for the icon wrapper element.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'layout' => 'modern',
				),
			),
			'icon_width'   => array(
				'label'          => esc_html__('Wrapper Width', 'divitorque'),
				'description'    => esc_html__('Here you can define static width for the icon wrapper element.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'layout' => 'modern',
				),
			),
			'icon_bg'      => array(
				'label'       => esc_html__('Background Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the icon background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
			),

			'icon_padding' => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the icon. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'default'        => '0px|0px|0px|0px',
			),
		);

		$button_bg = $this->custom_background_fields(
			'btn',
			__('Button', 'divitorque'),
			'advanced',
			'general',
			array('color', 'gradient', 'image', 'hover'),
			array(),
			''
		);

		return array_merge($icon, $settings, $general, $button_bg);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                 = array();
		$advanced_fields['text']         = array();
		$advanced_fields['text_shadow']  = array();
		$advanced_fields['fonts']        = array();
		$advanced_fields['link_options'] = array();

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'margin'    => '%%order_class%%.et_pb_module',
				'padding'   => '%%order_class%%.et_pb_module',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['item'] = array(
			'label_prefix' => esc_html__('Button', 'divitorque'),
			'toggle_slug'  => 'general',
			'css'          => array(
				'main' => array(
					'border_radii'  => '%%order_class%% .dtp-social-share-btn-inner',
					'border_styles' => '%%order_class%% .dtp-social-share-btn-inner',
				),
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

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__('Button Box Shadow', 'divitorque'),
			'toggle_slug' => 'general',
			'css'         => array(
				'main'      => '%%order_class%% .dtp-social-share-btn-inner',
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
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-social-share-icon',
					'border_styles' => '%%order_class%% .dtp-social-share-icon',
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

		$advanced_fields['fonts']['share'] = array(
			'css'         => array(
				'main'      => '%%order_class%% .dtp-social-share-text',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'text',
			'font_size'   => array(
				'default' => '14px',
			),
		);

		$advanced_fields['box_shadow']['icon'] = array(
			'label'       => esc_html__('Icon Box Shadow', 'divitorque'),
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => '%%order_class%% .dtp-social-share-icon',
				'important' => 'all',
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

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_script('torq-social-share');
		wp_enqueue_style('torq-social-share');
		$this->apply_css($render_slug);

		return sprintf(
			'<div class="dtp-module dtp-module-parent dtp-social-share">
				%1$s
			</div>',
			$this->props['content']
		);
	}

	public function apply_css($render_slug)
	{
		$layout                          = $this->props['layout'];
		$placement                       = $this->props['placement'];
		$icon_height                     = $this->props['icon_height'];
		$btn_padding                     = $this->props['btn_padding'];
		$icon_width                      = $this->props['icon_width'];
		$show_text                       = $this->props['show_text'];
		$icon_color                      = $this->props['icon_color'];
		$show_icon                       = $this->props['show_icon'];
		$icon_bg                         = $this->props['icon_bg'];
		$icon_placement                  = $this->props['icon_placement'];
		$item_spacing                    = $this->props['item_spacing'];
		$item_spacing_tablet             = $this->props['item_spacing_tablet'];
		$item_spacing_phone              = $this->props['item_spacing_phone'];
		$item_spacing_last_edited        = $this->props['item_spacing_last_edited'];
		$item_spacing_responsive_status  = et_pb_get_responsive_status($item_spacing_last_edited);
		$items_per_row                   = $this->props['items_per_row'];
		$items_per_row_tablet            = $this->props['items_per_row_tablet'];
		$items_per_row_phone             = $this->props['items_per_row_phone'];
		$items_per_row_last_edited       = $this->props['items_per_row_last_edited'];
		$items_per_row_responsive_status = et_pb_get_responsive_status($items_per_row_last_edited);
		$icon_color_hover                = $this->get_hover_value('icon_color');
		$icon_size_hover                 = $this->get_hover_value('icon_size');
		$icon_bg_hover                   = $this->get_hover_value('icon_bg');
		$arrow_color                     = $this->props['arrow_color'];
		$show_arrow                      = $this->props['show_arrow'];
		$arrow_color_hover               = $this->get_hover_value('arrow_color');

		// Button Background.
		$this->get_custom_bg_style(
			$render_slug,
			'btn',
			'%%order_class%% .dtp-social-share-btn .dtp-social-share-btn-inner',
			'%%order_class%% .dtp-social-share-btn:hover .dtp-social-share-btn-inner'
		);

		// Text.
		if ('off' === $show_arrow) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-shape',
					'declaration' => 'display: none!important;',
				)
			);
		}

		// Text.
		if ('off' === $show_text) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-text',
					'declaration' => 'display: none!important;',
				)
			);
		}

		// Button Padding.
		if (!empty($btn_padding)) {
			$this->get_responsive_styles(
				'btn_padding',
				'%%order_class%% .dtp-social-share-btn-inner a',
				array('primary' => 'padding'),
				array('default' => '0|0|0|0'),
				$render_slug
			);
		}

		// Show Hide Icon.
		if ('off' === $show_icon) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-icon',
					'declaration' => 'display: none!important;',
				)
			);
		}

		// Icon Padding.
		$this->get_responsive_styles(
			'icon_padding',
			'%%order_class%% .dtp-social-share-icon',
			array('primary' => 'padding'),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		// Button layout.
		if ('modern' === $this->props['layout']) {
			if ('center' !== $icon_placement) {
				if (empty($icon_bg)) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-social-share-icon',
							'declaration' => 'background: rgba(0,0,0,.3);',
						)
					);
				}

				if (empty($icon_height)) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-social-share-icon',
							'declaration' => 'height: 46px;',
						)
					);
				}

				if (empty($icon_width)) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-social-share-icon',
							'declaration' => 'width: 46px;',
						)
					);

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-social-share-icon',
							'declaration' => 'flex: 0 0 46px;',
						)
					);
				}
			}

			if (!empty($icon_height)) {
				$this->get_responsive_styles(
					'icon_height',
					'%%order_class%% .dtp-social-share-icon',
					array('primary' => 'height'),
					array('default' => ''),
					$render_slug
				);
			}

			if (!empty($icon_width)) {
				$this->get_responsive_styles(
					'icon_width',
					'%%order_class%% .dtp-social-share-icon',
					array('primary' => 'width'),
					array('default' => ''),
					$render_slug
				);

				$this->get_responsive_styles(
					'icon_width',
					'%%order_class%% .dtp-social-share-icon',
					array('primary' => 'flex'),
					array('default' => ''),
					$render_slug
				);
			}

			// Icon Spacing.
			if ('on' === $show_text) {
				if ('left' === $icon_placement) {
					$this->get_responsive_styles(
						'icon_spacing',
						'%%order_class%% .dtp-social-share-icon',
						array('primary' => 'margin-right'),
						array('default' => '10px'),
						$render_slug
					);
				} elseif ('right' === $icon_placement) {
					$this->get_responsive_styles(
						'icon_spacing',
						'%%order_class%% .dtp-social-share-icon',
						array('primary' => 'margin-left'),
						array('default' => '10px'),
						$render_slug
					);
				} else {
					$this->get_responsive_styles(
						'icon_spacing',
						'%%order_class%% .dtp-social-share-icon',
						array('primary' => 'margin-bottom'),
						array('default' => '10px'),
						$render_slug
					);
				}

				// Button Padding.
				if (empty($btn_padding)) {
					if ('right' === $icon_placement) {
						ET_Builder_Element::set_style(
							$render_slug,
							array(
								'selector'    => '%%order_class%% .dtp-social-share-btn-inner a',
								'declaration' => 'padding-left: 20px;',
							)
						);
					} elseif ('left' === $icon_placement) {
						ET_Builder_Element::set_style(
							$render_slug,
							array(
								'selector'    => '%%order_class%% .dtp-social-share-btn-inner a',
								'declaration' => 'padding-right: 20px;',
							)
						);
					} else {
						ET_Builder_Element::set_style(
							$render_slug,
							array(
								'selector'    => '%%order_class%% .dtp-social-share-btn-inner a',
								'declaration' => 'padding: 20px;',
							)
						);

						ET_Builder_Element::set_style(
							$render_slug,
							array(
								'selector'    => '%%order_class%% .dtp-social-share-btn a',
								'declaration' => 'flex-direction: column; justify-content: center;',
							)
						);
					}
				}
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-text',
					'declaration' => 'width: 100%;',
				)
			);

			if ('off' === $show_icon) {
				if (empty($btn_padding)) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-social-share-btn-inner a',
							'declaration' => 'padding: 10px 20px;',
						)
					);
				}
			}

			// Icon Placement.
			if ('center' === $icon_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-social-share-btn a',
						'declaration' => 'flex-direction: column !important; justify-content: center;',
					)
				);

				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-social-share .dtp-social-share-text',
						'declaration' => 'text-align: center;',
					)
				);
			} elseif ('right' === $icon_placement) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-social-share-btn a',
						'declaration' => 'flex-direction: row-reverse !important;',
					)
				);
			}
		} elseif ('classic' === $layout) {
			$this->get_responsive_styles(
				'content_alignment',
				'%%order_class%% .dtp-social-share .dtp-social-share-btn a',
				array('primary' => 'justify-content'),
				array('default' => 'center'),
				$render_slug
			);

			if (empty($btn_padding)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-social-share-btn-inner a',
						'declaration' => 'padding: 10px 25px;',
					)
				);
			}

			if ('on' === $show_text) {
				$this->get_responsive_styles(
					'icon_spacing',
					'%%order_class%% .dtp-social-share-icon',
					array('primary' => 'margin-right'),
					array('default' => '10px'),
					$render_slug
				);
			}
		}

		// Button Placement.
		if ('vertical' === $this->props['placement']) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share',
					'declaration' => 'flex-direction: column;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_social_share_child, %%order_class%% .torq_social_share_child .dtp-social-share-btn',
					'declaration' => sprintf(
						'display: %1$s!important;',
						$this->props['display_type']
					),
				)
			);

			if ('block' === $this->props['display_type']) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_social_share_child, %%order_class%% .torq_social_share_child .dtp-social-share-btn',
						'declaration' => 'width:100%!important;',
					)
				);
			}
		}

		$this->get_responsive_styles(
			'icon_size',
			'%%order_class%% .dtp-social-share-icon-el svg',
			array('primary' => 'flex'),
			array('default' => '20px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'icon_size',
			'%%order_class%% .dtp-social-share-icon-el svg',
			array('primary' => 'width'),
			array('default' => '20px'),
			$render_slug
		);

		// Arrow Color.
		if (!empty($arrow_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-shape svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$arrow_color
					),
				)
			);
		}

		// Arrow Color Hover.
		if (!empty($arrow_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-btn:hover .dtp-social-share-shape svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$arrow_color_hover
					),
				)
			);
		}

		if (!empty($icon_size_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'width: %1$s;',
						$icon_size_hover
					),
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'flex: 0 0 %1$s;',
						$icon_size_hover
					),
				)
			);
		}

		if (!empty($icon_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$icon_color
					),
				)
			);
		}

		if (!empty($icon_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$icon_color_hover
					),
				)
			);
		}

		if (!empty($icon_bg)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-icon',
					'declaration' => sprintf(
						'background: %1$s;',
						$icon_bg
					),
				)
			);
		}

		if (!empty($icon_bg_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon',
					'declaration' => 'background:' . $icon_bg_hover . ';',
				)
			);
		}

		// General.
		$item_alignment_property = 'vertical' === $this->props['placement'] ? 'align-items' : 'justify-content';
		$this->get_responsive_styles(
			'item_alignment',
			'%%order_class%% .dtp-social-share',
			array('primary' => $item_alignment_property),
			array('default' => 'left'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .torq_social_share_child',
				'declaration' => sprintf(
					'padding: %1$s;',
					$item_spacing
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-social-share',
				'declaration' => sprintf(
					'margin: -%1$s;',
					$item_spacing
				),
			)
		);

		if ($item_spacing_tablet && $item_spacing_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_social_share_child',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf(
						'padding: %1$s;',
						$item_spacing_tablet
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf(
						'margin: -%1$s;',
						$item_spacing_tablet
					),
				)
			);
		}

		if ($item_spacing_phone && $item_spacing_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_social_share_child',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf(
						'padding: %1$s;',
						$item_spacing_phone
					),
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf(
						'margin: -%1$s;',
						$item_spacing_phone
					),
				)
			);
		}

		// Items Per Row.
		if (
			'horizontal' === $placement &&
			'auto' !== $items_per_row &&
			0 < $items_per_row
		) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_social_share_child',
					'declaration' => sprintf(
						'max-width: calc(100%% / %1$s);
						flex: 0 0 calc(100%% / %1$s);',
						$items_per_row
					),
				)
			);

			if ($items_per_row_tablet && $items_per_row_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_social_share_child',
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
						'declaration' => sprintf(
							'max-width: calc(100%% / %1$s);
							flex: 0 0 calc(100%% / %1$s);',
							$items_per_row_tablet
						),
					)
				);
			}

			if ($items_per_row_phone && $items_per_row_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_social_share_child',
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
						'declaration' => sprintf(
							'max-width: calc(100%% / %1$s);
							flex: 0 0 calc(100%% / %1$s);',
							$items_per_row_phone
						),
					)
				);
			}
		}
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Social Media', 'divitorque');
	}
}

new DTP_Social_Share();
