<?php

class DTP_Gradient_Heading extends DTP_Builder_Module
{
	public function init()
	{
		$this->slug       = 'torq_gradient_heading';
		$this->vb_support = 'on';
		$this->name       = esc_html__('Torq Gradient Heading', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'heading.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'gradient' => esc_html__('Gradient', 'divitorque'),
					'text'     => esc_html__('Text', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'title' => array(
				'label'    => esc_html__('Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-gradient-heading',
			),
		);
	}

	public function get_fields()
	{
		$content = array(
			'title'        => array(
				'label'       => esc_html__('Title Text', 'divitorque'),
				'Description' => esc_html__('Define the title text. Use <br> for line break.', 'divitorque'),
				'type'        => 'textarea',
				'default'     => 'Divi Torque <br> Gradient Heading',
				'toggle_slug' => 'content',
			),
			'use_link'     => array(
				'label'           => esc_html__('Use Link', 'divitorque'),
				'Description'     => esc_html__('If enable, title will be render with <a> tag.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'content',
			),
			'link_url'     => array(
				'label'       => esc_html__('Link Url', 'divitorque'),
				'Description' => esc_html__('Define the link url for your title.', 'divitorque'),
				'type'        => 'text',
				'default'     => 'https://divitorque.com',
				'toggle_slug' => 'content',
				'show_if'     => array(
					'use_link' => 'on',
				),
			),
			'link_options' => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off|off',
				'options'     => array(
					'link_target' => 'Open in new window',
					'link_rel'    => 'Add nofollow',
				),
				'toggle_slug' => 'content',
				'show_if'     => array(
					'use_link' => 'on',
				),
			),
			'html_tag'     => array(
				'label'       => esc_html__('html Tag', 'divitorque'),
				'Description' => esc_html__('Define html heading tag for your title.', 'divitorque'),
				'type'        => 'multiple_buttons',
				'toggle_slug' => 'content',
				'default'     => 'h1',
				'options'     => array(
					'h1' => array('title' => esc_html__('h1', 'divitorque')),
					'h2' => array('title' => esc_html__('h2', 'divitorque')),
					'h3' => array('title' => esc_html__('h3', 'divitorque')),
					'h4' => array('title' => esc_html__('h4', 'divitorque')),
					'h5' => array('title' => esc_html__('h5', 'divitorque')),
					'h6' => array('title' => esc_html__('h6', 'divitorque')),
				),
			),
		);

		$styles = array(
			'gradient_type'            => array(
				'label'       => esc_html__('Gradient Type', 'divitorque'),
				'Description' => esc_html__('Here you can define linear/radial gradient type.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'gradient',
				'default'     => 'linear',
				'options'     => array(
					'linear' => esc_html__('Linear', 'divitorque'),
					'radial' => esc_html__('Radial', 'divitorque'),
				),
			),
			'primary_color'            => array(
				'label'        => esc_html__('Primary Color', 'divitorque'),
				'Description'  => esc_html__('Define primary color for the gradient.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'gradient',
				'default'      => $this->default_color,
			),
			'primary_color_location'   => array(
				'label'          => esc_html__('Location', 'divitorque'),
				'Description'    => esc_html__('Here you can define primary color location for the gradient.', 'divitorque'),
				'type'           => 'range',
				'default'        => 10,
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'gradient',
				'tab_slug'       => 'advanced',
			),
			'secondary_color'          => array(
				'label'        => esc_html__('Secondary Color', 'divitorque'),
				'Description'  => esc_html__('Define secondary color for the gradient.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'gradient',
				'default'      => '#e02b20',
			),
			'secondary_color_location' => array(
				'label'          => esc_html__('Location', 'divitorque'),
				'Description'    => esc_html__('Here you can define secondary color location for the gradient.', 'divitorque'),
				'type'           => 'range',
				'default'        => 40,
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'toggle_slug'    => 'gradient',
				'tab_slug'       => 'advanced',
			),
			'angle'                    => array(
				'label'          => esc_html__('Gradient Angle', 'divitorque'),
				'Description'    => esc_html__('Define custom gradient angle to use for linear gradient type.', 'divitorque'),
				'type'           => 'range',
				'default'        => 130,
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 360,
					'step' => 1,
				),
				'toggle_slug'    => 'gradient',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'gradient_type' => 'linear',
				),
			),
			'radial_position'          => array(
				'label'       => esc_html__('Radial Position', 'divitorque'),
				'Description' => esc_html__('Choose radial position for the gradient text.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'gradient',
				'default'     => 'center center',
				'options'     => array(
					'center center' => esc_html__('Center Center', 'divitorque'),
					'bottom center' => esc_html__('Bottom Center', 'divitorque'),
					'bottom left'   => esc_html__('Bottom Left', 'divitorque'),
					'bottom right'  => esc_html__('Bottom Right', 'divitorque'),
					'center left'   => esc_html__('Center Left', 'divitorque'),
					'center right'  => esc_html__('Center Right', 'divitorque'),
					'top center'    => esc_html__('Top Center', 'divitorque'),
					'top left'      => esc_html__('Top Left', 'divitorque'),
					'top right'     => esc_html__('Top Right', 'divitorque'),
				),
				'show_if'     => array(
					'gradient_type' => 'radial',
				),
			),
		);

		return array_merge($content, $styles);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main' => '%%order_class%% .dtp-gradient-heading',
			),
			'important'       => 'all',
			'hide_text_color' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
			'line_height'     => array(
				'default' => '1.2em',
			),
			'font_size'       => array(
				'default' => '60px',
			),
			'font'            => array(
				'default' => '|700|||||||',
			),
		);

		return $advanced_fields;
	}

	public function render_title()
	{
		$title    = $this->props['title'];
		$use_link = $this->props['use_link'];

		if ('on' === $use_link) {
			$link_options = explode('|', $this->props['link_options']);
			$link_target  = 'on' === $link_options[0] ? '_blank' : '_self';
			$link_rel     = '';

			if ('on' === $link_options[1]) {
				$link_rel = sprintf('rel="nofollow"');
			}

			$title = sprintf(
				'<a target="%1$s" href="%2$s" %3$s>
          			%4$s
				</a>',
				$link_target,
				$this->props['link_url'],
				$link_rel,
				$this->props['title']
			);
		}

		return $title;
	}

	public function render($attrs, $content, $render_slug)
	{
		$title_font_weight = explode('|', $this->props['title_font'])[1];
		if ('700' === $title_font_weight) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-gradient-heading',
					'declaration' => 'font-weight: bold;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-gradient-heading',
				'declaration' => sprintf(
					'font-size: %1$s;
					line-height: %2$s;
					color: %2$s;',
					$this->props['title_font_size'],
					$this->props['title_line_height'],
					$this->props['primary_color']
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-gradient-heading',
				'declaration' => sprintf(
					'-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
					background-color: transparent;'
				),
			)
		);

		if ('linear' === $this->props['gradient_type']) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-gradient-heading',
					'declaration' => sprintf(
						'
						background-image: linear-gradient(%1$sdeg, %2$s %3$s%%, %4$s %5$s%%);',
						$this->props['angle'],
						$this->props['primary_color'],
						$this->props['primary_color_location'],
						$this->props['secondary_color'],
						$this->props['secondary_color_location']
					),
				)
			);
		} elseif ('radial' === $this->props['gradient_type']) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-gradient-heading',
					'declaration' => sprintf(
						'
						background-image: radial-gradient(at %1$s, %2$s %3$s%%, %4$s %5$s%%);',
						$this->props['radial_position'],
						$this->props['primary_color'],
						$this->props['primary_color_location'],
						$this->props['secondary_color'],
						$this->props['secondary_color_location']
					),
				)
			);
		}

		return sprintf(
			'<%1$s class="dtp-gradient-heading">%2$s</%1$s>',
			$this->props['html_tag'],
			$this->render_title()
		);
	}
}

new DTP_Gradient_Heading();
