<?php
class DTP_Alert extends DTP_Builder_Module
{

	public function init()
	{
		$this->slug       = 'torq_alert';
		$this->vb_support = 'on';
		$this->name       = esc_html__('Torq Alert', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'alert.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__('Content', 'divitorque'),
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'icon'    => esc_html__('Icon', 'divitorque'),
					'dismiss' => esc_html__('Dismiss', 'divitorque'),
					'text'    => esc_html__('Text', 'divitorque'),
					'title'   => esc_html__('Title', 'divitorque'),
					'description' => array(
						'title'             => esc_html__('Description', 'divitorque'),
						'tabbed_subtoggles' => true,
					),
					'border'  => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'icon_wrapper' => array(
				'label'    => esc_html__('Icon Wrapper', 'divitorque'),
				'selector' => '%%order_class%% .dtp-alert .dtp-alert-icon',
			),
			'icon'         => array(
				'label'    => esc_html__('Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-alert .dtp-alert-icon .dtp-alert-icon-inner',
			),
			'title'        => array(
				'label'    => esc_html__('Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-alert .dtp-alert-title',
			),
			'desc'         => array(
				'label'    => esc_html__('Description', 'divitorque'),
				'selector' => '%%order_class%% .dtp-alert .dtp-alert-desc',
			),
		);
	}

	public function get_fields()
	{
		$content = array(
			'use_icon'    => array(
				'label'           => esc_html__('Use Icon', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether icon set below should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'content',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),
			'icon'        => array(
				'label'           => esc_html__('Select Icon', 'divitorque'),
				'description'     => esc_html__('Choose an icon to display with your alert.', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'default'     => '&#xf0f3;||fa||400',
				'tab_slug'        => 'general',
				'show_if'         => array(
					'use_icon' => 'on',
				),
			),
			'image'       => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'content',
				'dynamic_content'    => 'image',
				'show_if'            => array(
					'use_icon' => 'off',
				),
			),
			'image_alt'   => array(
				'label'       => esc_html__('Image Alt', 'divitorque'),
				'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
				'show_if'     => array(
					'use_icon' => 'off',
				),
			),
			'title'       => array(
				'label'           => esc_html__('Title', 'divitorque'),
				'description'     => esc_html__('Define the title text for your alert.', 'divitorque'),
				'type'            => 'text',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'content',
			),
			'description' => array(
				'label'           => esc_html__('Description', 'divitorque'),
				'description'     => esc_html__('Define the description text for your alert.', 'divitorque'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'dynamic_content' => 'text',
				'toggle_slug'     => 'content',
			),
		);

		$settings = array(
			'alert_type'   => array(
				'label'       => esc_html__('Type', 'divitorque'),
				'description' => esc_html__('Here you can define different types of pre made alert layout.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'success',
				'options'     => array(
					'success'  => esc_html__('Success', 'divitorque'),
					'danger'  => esc_html__('Danger', 'divitorque'),
					'warning' => esc_html__('Warning', 'divitorque'),
					'info'    => esc_html__('Info', 'divitorque'),
					'light'   => esc_html__('Light', 'divitorque'),
					'dark'    => esc_html__('Dark', 'divitorque'),
					'ltdark'  => esc_html__('Light Dark', 'divitorque'),
				),
			),
			'show_dismiss' => array(
				'label'           => esc_html__('Show Dismiss Button', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether dismiss button should be displayed.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'on',
				'toggle_slug'     => 'settings',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),
			'align_items'  => array(
				'label'       => esc_html__('Content Vertical Alignment', 'divitorque'),
				'description' => esc_html__('Here you can set the vertical content alignment.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'center',
				'options'     => array(
					'flex-start' => esc_html__('Top', 'divitorque'),
					'center'     => esc_html__('Center', 'divitorque'),
					'flex-end'   => esc_html__('Bottom', 'divitorque'),
				),
			),
		);

		$icon = array(
			'icon_size'    => array(
				'label'          => esc_html__('Icon Size', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom size for your alert icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '20px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),

			'icon_color'   => array(
				'label'       => esc_html__('Icon Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
				'show_if'     => array(
					'use_icon' => 'on',
				),
			),

			'icon_spacing' => array(
				'label'          => esc_html__('Icon Spacing', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing between icon and content.', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'icon',
				'tab_slug'       => 'advanced',
			),

			'use_icon_box' => array(
				'label'           => esc_html__('Use Icon Box', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether icon should display within a box.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'default'         => 'off',
				'toggle_slug'     => 'icon',
				'tab_slug'        => 'advanced',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
			),
			'icon_width'   => array(
				'label'          => esc_html__('Icon Box Width', 'divitorque'),
				'description'    => esc_html__('Define static width for the icon box.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '80px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 500,
				),
				'toggle_slug'    => 'icon',
				'sub_toggle'     => 'icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'use_icon_box' => 'on',
				),
			),

			'icon_height'  => array(
				'label'          => esc_html__('Icon Box Height', 'divitorque'),
				'description'    => esc_html__('Define static height for the icon box.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '80px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 1,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'    => 'icon',
				'sub_toggle'     => 'icon',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'use_icon_box' => 'on',
				),
			),
		);

		$dismiss = array(
			'dismiss_size'    => array(
				'label'          => esc_html__('Dismiss Size', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom size for the dismiss icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '22px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'dismiss',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_dismiss' => 'on',
				),
			),

			'dismiss_color'   => array(
				'label'       => esc_html__('Dismiss Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the dismiss icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'dismiss',
				'hover'       => 'tabs',
				'show_if'     => array(
					'show_dismiss' => 'on',
				),
			),

			'dismiss_spacing' => array(
				'label'          => esc_html__('Dismiss Spacing Gap', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing between dismiss icon and content.', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				),
				'toggle_slug'    => 'dismiss',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'show_dismiss' => 'on',
				),
			),
		);

		$icon_bg = $this->custom_background_fields(
			'icon',
			esc_html__('Icon Box', 'divitorque'),
			'advanced',
			'icon',
			array('color', 'gradient', 'hover'),
			array('use_icon_box' => 'on'),
			''
		);

		$title = array(
			'title_spacing' => array(
				'label'          => esc_html__('Title Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of the title.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => '0px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'title',
				'tab_slug'       => 'advanced',
			),
		);
		return array_merge($content, $settings, $icon, $icon_bg, $dismiss, $title);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields               = array();
		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%%.et_pb_module',
				'important' => 'all',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'        => esc_html__('Title', 'divitorque'),
			'css'          => array(
				'main'      => '%%order_class%% .dtp-alert-title',
				'important' => 'all',
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'title',
			'header_level' => array(
				'default' => 'h3',
			),
			'font_size'    => array(
				'default' => '16px',
			),
			'line_height'  => array(
				'default' => '1.7em',
			),
		);

		$advanced_fields['fonts']['desc'] = array(
			'label'          => esc_html__('Description', 'divitorque'),
			'toggle_slug'  => 'description',
			'css'            => array(
				'main'        => '%%order_class%% .dtp-alert-desc',
				'line_height' => '%%order_class%% .dtp-alert-desc',
				'text_align'  => '%%order_class%% .dtp-alert-desc',
				'text_shadow' => '%%order_class%% .dtp-alert-desc',
				'important'   => 'all',
			),
			'block_elements' => array(
				'tabbed_subtoggles' => true,
				'css'               => array(
					'main'      => '%%order_class%% .dtp-alert-desc',
					'important' => 'all',
				),
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug'     => 'icon',
			'css'             => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-alert-icon',
					'border_styles' => '%%order_class%% .dtp-alert-icon',
				),
				'important' => 'all',
			),
			'depends_on'      => array('use_icon_box'),
			'depends_show_if' => 'on',
			'defaults'        => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '',
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
					'width' => '1px',
					'color' => '#dddddd',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}

	public function render_icon()
	{
		if ('on' === $this->props['use_icon']) {
			$icon = esc_attr(et_pb_process_font_icon($this->props['icon']));

			// Inject Font Awesome Manually!.
			dtp_inject_fa_icons($this->props['icon']);

			if ($icon) {
				return sprintf(
					'<div class="dtp-alert-icon">
						<i class="dtp-et-icon dtp-alert-icon-inner">%1$s</i>
					</div>',
					$icon
				);
			}
		}
	}

	public function render_title()
	{
		$title_text            = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level($title_level, 'h5');
		$processed_title_level = esc_html($processed_title_level);
		if (!empty($title_text)) {
			return sprintf('<%2$s class="dtp-alert-title">%1$s</%2$s>', $title_text, $processed_title_level);
		}
	}

	public function render_description()
	{
		$description = $this->props['description'];
		$content     = force_balance_tags($description);
		$content     = preg_replace('~\s?<p></p>\s?~', '', $content);
		if (!empty($content)) {
			return sprintf('<div class="dtp-alert-desc">%1$s</div>', $content);
		}
	}

	public function render_figure()
	{
		$use_icon  = $this->props['use_icon'];
		$image     = $this->props['image'];
		$image_alt = $this->props['image_alt'];

		if ('on' === $use_icon) {
			return $this->render_icon();
		}

		if ($image) {
			return sprintf(
				'<div class="dtp-alert-icon">
					<img class="dtp-alert-icon-inner" src="%1$s" alt="%2$s">
				</div>',
				$image,
				$image_alt
			);
		}
	}

	public function render_dismiss()
	{
		if ('on' === $this->props['show_dismiss']) {
			return '<div class="dtp-alert-dismiss"><i data-icon="M" class="dtp-et-icon"></i></div>';
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_style('torq-alert');
		wp_enqueue_script('torq-alert');
		$this->apply_css($render_slug);
		$alert_type = $this->props['alert_type'];
		return sprintf(
			'<div class="dtp-module dtp-alert dtp-alert-%1$s">
				%2$s
				<div class="dtp-alert-content">
					%3$s %4$s
				</div>
				%5$s
            </div>',
			$alert_type,
			$this->render_figure(),
			$this->render_title(),
			$this->render_description(),
			$this->render_dismiss()
		);
	}

	protected function apply_css($render_slug)
	{
		$alerts_data = array(
			'success'  => array(
				'color'      => '#41861F',
				'background' => '#DFF8D3',
				'link'       => '#41861F',
				'border'       => '#41861F',
			),
			'danger'  => array(
				'color'      => '#721c24',
				'background' => '#f8d7da',
				'link'       => '#491217',
				'border'       => '#721c24',
			),
			'warning' => array(
				'color'      => '#856404',
				'background' => '#fff3cd',
				'link'       => '#533f03',
				'border'       => '#856404',
			),
			'info'    => array(
				'color'      => '#0c5460',
				'background' => '#d1ecf1',
				'link'       => '#062c33',
				'border'       => '#0c5460',
			),
			'ltdark'  => array(
				'color'      => '#1b1e21',
				'background' => '#d6d8d9',
				'link'       => '#040505',
				'border'       => '#1b1e21',
			),
			'dark'    => array(
				'color'      => '#ffffff',
				'background' => '#626686',
				'link'       => '#ffffff',
				'border'       => '#262626',
			),
			'light'   => array(
				'color'      => '#818182',
				'background' => '#fefefe',
				'link'       => '#686868',
				'border'     => '#818182',
			),
		);

		$background_color       = $this->props['background_color'];
		$custom_padding         = $this->props['custom_padding'];
		$align_items            = $this->props['align_items'];
		$use_icon               = $this->props['use_icon'];
		$icon_color             = $this->props['icon_color'];
		$icon_color_hover       = $this->get_hover_value('icon_color');
		$use_icon_box           = $this->props['use_icon_box'];
		$icon_bg_color          = $this->props['icon_bg_color'];
		$dismiss_color          = $this->props['dismiss_color'];
		$dismiss_color_hover    = $this->get_hover_value('dismiss_color');
		$title_spacing          = $this->props['title_spacing'];
		$alert_type             = $this->props['alert_type'];
		$border_radii_main      = $this->props['border_radii_main'];
		$border_color_left_main = $this->props['border_color_left_main'];
		$border_color_all_main  = $this->props['border_color_all_main'];
		$border_width_left_main = $this->props['border_width_left_main'];
		$border_width_all_main  = $this->props['border_width_all_main'];

		if (!$background_color) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf('background-color: %1$s;', $alerts_data[$alert_type]['background']),
				)
			);
		}

		if (empty($border_radii_main) || 'on|0px|0px|0px|0px' === $border_radii_main) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'border-radius: 4px;',
				)
			);
		}

		if (!$border_color_all_main && !$border_color_left_main) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf('border-color: %1$s;', $alerts_data[$alert_type]['border']),
				)
			);
		}

		if (!$border_width_all_main && !$border_width_left_main) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'border-left-width: 4px; border-style: solid;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%%, %%order_class%% .dtp-alert-title',
				'declaration' => sprintf('color: %1$s;', $alerts_data[$alert_type]['color']),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% a, %%order_class%% .dtp-alert-dismiss i, %%order_class%% strong, %%order_class%% b',
				'declaration' => sprintf('color: %1$s;', $alerts_data[$alert_type]['link']),
			)
		);

		if (!$custom_padding) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => 'padding: 10px 15px 15px;',
				)
			);
		}

		// Align Items.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-alert',
				'declaration' => sprintf('align-items: %1$s;', $align_items),
			)
		);

		// Icon Size.
		if ('on' === $use_icon) {
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtp-alert-icon',
				array('primary' => 'font-size'),
				array('default' => '40px'),
				$render_slug
			);
		} else {
			$this->get_responsive_styles(
				'icon_size',
				'%%order_class%% .dtp-alert-icon img',
				array('primary' => 'width'),
				array('default' => '40px'),
				$render_slug
			);
		}

		if ('on' === $use_icon) {
			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtp-alert-icon',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);

			if ($icon_color) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-alert-icon',
						'declaration' => sprintf('color: %1$s;', $icon_color),
					)
				);
			}

			if ($icon_color_hover) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%%:hover .dtp-alert-icon i',
						'declaration' => sprintf('color: %1$s;', $icon_color_hover),
					)
				);
			}
		}

		$this->get_responsive_styles(
			'icon_spacing',
			'%%order_class%% .dtp-alert-icon',
			array('primary' => 'margin-right'),
			array('default' => '20px'),
			$render_slug
		);

		// Icon Box.
		if ('on' === $use_icon_box) {
			if (!$icon_bg_color) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-alert-icon',
						'declaration' => 'background-color: rgba(0,0,0,.1);',
					)
				);
			} else {
				$this->get_custom_bg_style($render_slug, 'icon', '%%order_class%% .dtp-alert-icon', '%%order_class%%:hover .dtp-alert-icon');
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-alert-icon',
					'declaration' => 'display: flex; align-items: center; justify-content: center;',
				)
			);

			$this->get_responsive_styles(
				'icon_width',
				'%%order_class%% .dtp-alert-icon',
				array('primary' => 'width'),
				array('default' => '80px'),
				$render_slug
			);

			$this->get_responsive_styles(
				'icon_height',
				'%%order_class%% .dtp-alert-icon',
				array('primary' => 'height'),
				array('default' => '80px'),
				$render_slug
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-alert-icon',
					'declaration' => 'overflow: visible!important; border-radius: 0 0 0 0!important;',
				)
			);
		}

		// Dismiss.
		$this->get_responsive_styles(
			'dismiss_size',
			'%%order_class%% .dtp-alert-dismiss i',
			array('primary' => 'font-size'),
			array('default' => '22px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'dismiss_spacing',
			'%%order_class%% .dtp-alert-dismiss',
			array('primary' => 'margin-left'),
			array('default' => '20px'),
			$render_slug
		);

		if ($dismiss_color) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-alert-dismiss i',
					'declaration' => sprintf('color: %1$s;', $dismiss_color),
				)
			);
		}

		if ($dismiss_color_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-alert-dismiss:hover i',
					'declaration' => sprintf('color: %1$s;', $dismiss_color_hover),
				)
			);
		}

		if ($title_spacing) {
			$this->get_responsive_styles(
				'title_spacing',
				'%%order_class%% .dtp-alert .dtp-alert-title',
				array('primary' => 'padding-bottom'),
				array('default' => '0px'),
				$render_slug
			);
		}
	}
}

new DTP_Alert();
