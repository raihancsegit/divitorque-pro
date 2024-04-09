<?php

class DTP_Timeline extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_timeline';
		$this->child_slug = 'torq_timeline_child';
		$this->name       = esc_html__('Torq Timeline', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'timeline.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'layout'   => esc_html__('Layout', 'divitorque'),
					'timeline' => esc_html__('Timeline', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'timeline'       => esc_html__('Timeline', 'divitorque'),
					'line'           => esc_html__('Line', 'divitorque'),
					'connector'      => esc_html__('Connector', 'divitorque'),
					'connector_text' => array(
						'title'             => esc_html__('Connector Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'day'   => array(
								'name' => esc_html__('Day', 'divitorque'),
							),
							'month' => array(
								'name' => esc_html__('Month', 'divitorque'),
							),
							'year'  => array(
								'name' => esc_html__('Year', 'divitorque'),
							),
						),
					),
					'image'          => esc_html__('Image', 'divitorque'),
					'title_subtitle' => array(
						'title'             => esc_html__('Title & Subtitle', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'    => array(
								'name' => esc_html__('Title', 'divitorque'),
							),
							'subtitle' => array(
								'name' => esc_html__('Subtitle', 'divitorque'),
							),
						),
					),
					'description'    => esc_html__('Description', 'divitorque'),
					'date'           => esc_html__('Date Text', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'title'     => array(
				'label'    => esc_html__('Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-vt-title h4',
			),
			'subtitle'  => array(
				'label'    => esc_html__('Subtitle', 'divitorque'),
				'selector' => '%%order_class%% .dtp-vt-subtitle h5',
			),
			'image'     => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-vt-figure img',
			),
			'desc'      => array(
				'label'    => esc_html__('Description', 'divitorque'),
				'selector' => '%%order_class%% .dtp-vt-desc',
			),
			'date_time' => array(
				'label'    => esc_html__('Date & Time', 'divitorque'),
				'selector' => '%%order_class%% .dtp-vt-date-time',
			),
			'connector' => array(
				'label'    => esc_html__('Connector', 'divitorque'),
				'selector' => '%%order_class%% .dtp-vt-circle',
			),
		);
	}

	public function get_fields()
	{
		$layout['template'] = array(
			'label'       => esc_html__('Select Layout', 'divitorque'),
			'description' => esc_html__('Here you can define different layout template.', 'divitorque'),
			'type'        => 'select',
			'toggle_slug' => 'layout',
			'default'     => 'template-1',
			'options'     => array(
				'template-1' => esc_html__('Layout 1', 'divitorque'),
				'template-2' => esc_html__('Layout 2', 'divitorque'),
				'template-3' => esc_html__('Layout 3', 'divitorque'),
			),
		);

		$timeline['content_left_width'] = array(
			'label'          => esc_html__('Content Left Width', 'divitorque'),
			'description'    => esc_html__('Define left side content width.', 'divitorque'),
			'type'           => 'range',
			'default'        => '250px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 1000,
			),
			'toggle_slug'    => 'timeline',
			'tab_slug'       => 'advanced',
			'show_if'        => array(
				'template' => 'template-3',
			),
		);

		$timeline['content_alignment'] = array(
			'label'        => esc_html__('Content Alignment', 'divitorque'),
			'description'  => esc_html__('Align content to the left, right or center.', 'divitorque'),
			'type'         => 'text_align',
			'options'      => et_builder_get_text_orientation_options(array('justified')),
			'options_icon' => 'module_align',
			'default'      => 'left',
			'toggle_slug'  => 'timeline',
			'tab_slug'     => 'advanced',
		);

		$timeline['content_bg'] = array(
			'label'       => esc_html__('Content Background', 'divitorque'),
			'description' => esc_html__('Pick a color to use for the content background.', 'divitorque'),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'timeline',
		);

		$timeline['content_padding'] = array(
			'label'          => esc_html__('Content Padding', 'divitorque'),
			'description'    => esc_html__('Define custom padding for the content. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
			'type'           => 'custom_padding',
			'toggle_slug'    => 'timeline',
			'mobile_options' => true,
			'tab_slug'       => 'advanced',
		);

		$timeline['content_radius'] = array(
			'label'          => esc_html__('Content Border Radius', 'divitorque'),
			'description'    => esc_html__('Define custom radius value for the content area.', 'divitorque'),
			'type'           => 'range',
			'default'        => '4px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'timeline',
			'tab_slug'       => 'advanced',
		);

		$timeline['item_spacing'] = array(
			'label'          => esc_html__('Item Spacing', 'divitorque'),
			'description'    => esc_html__('Define spacing gap between timeline items.', 'divitorque'),
			'type'           => 'range',
			'default'        => '40px',
			'mobile_options' => true,
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'timeline',
		);

		$timeline['connector_spacing'] = array(
			'label'          => esc_html__('Connector Spacing', 'divitorque'),
			'description'    => esc_html__('Define connector left and right spacing.', 'divitorque'),
			'type'           => 'range',
			'default'        => '70px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'timeline',
		);

		$timeline['show_date'] = array(
			'label'           => esc_html__('Show Date', 'divitorque'),
			'description'     => esc_html__('Here you can choose whether date should be displayed.', 'divitorque'),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'         => 'on',
			'toggle_slug'     => 'timeline',
		);

		$timeline['show_time'] = array(
			'label'           => esc_html__('Show Time', 'divitorque'),
			'description'     => esc_html__('Here you can choose whether time should be displayed.', 'divitorque'),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'         => 'off',
			'toggle_slug'     => 'timeline',
			'show_if'         => array(
				'show_date' => 'on',
			),
		);

		$timeline['show_arrow'] = array(
			'label'           => esc_html__('Show Content Direction', 'divitorque'),
			'description'     => esc_html__('Here you can choose whether direction arrow should be displayed.', 'divitorque'),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'         => 'on',
			'toggle_slug'     => 'timeline',
		);

		$timeline['arrow_position'] = array(
			'label'          => esc_html__('Direction Arrow Position', 'divitorque'),
			'description'    => esc_html__('Define arrow position from the top.', 'divitorque'),
			'type'           => 'range',
			'default'        => '20px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 400,
			),
			'toggle_slug'    => 'timeline',
			'show_if'        => array(
				'show_arrow' => 'on',
			),
		);

		$timeline['use_scroll_line'] = array(
			'label'           => esc_html__('Use Scrolling Line', 'divitorque'),
			'description'     => esc_html__('Here you can choose whether scrolling vertical line should be used.', 'divitorque'),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'         => 'off',
			'toggle_slug'     => 'timeline',
		);

		$design['connector_position'] = array(
			'label'          => esc_html__('Offset Top', 'divitorque'),
			'description'    => esc_html__('Define offset top value for the connector.', 'divitorque'),
			'type'           => 'range',
			'default'        => '20px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'connector',
			'tab_slug'       => 'advanced',
		);

		$design['connector_icon_size'] = array(
			'label'          => esc_html__('Icon Size', 'divitorque'),
			'description'    => esc_html__('Here you can define custom size for the connector icon.', 'divitorque'),
			'type'           => 'range',
			'default'        => '20px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'connector',
			'tab_slug'       => 'advanced',
		);

		$design['connector_color'] = array(
			'label'       => esc_html__('Icon Color', 'divitorque'),
			'description' => esc_html__('Pick a color to use for the connector icon.', 'divitorque'),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'connector',
			'default'     => '#000000',
		);

		$design['connector_active_color'] = array(
			'label'       => esc_html__('Active Icon Color', 'divitorque'),
			'description' => esc_html__('Pick a color to use for the scrolled connector icon.', 'divitorque'),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'connector',
			'default'     => '#ffffff',
		);

		$design['connector_bg'] = array(
			'label'       => esc_html__('Background', 'divitorque'),
			'description' => esc_html__('Pick a color to use for the connector background.', 'divitorque'),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'connector',
			'default'     => '#efefef',
		);

		$design['connector_height'] = array(
			'label'          => esc_html__('Height', 'divitorque'),
			'description'    => esc_html__('Here you can define custom height for the connector.', 'divitorque'),
			'type'           => 'range',
			'default'        => '80px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'connector',
			'tab_slug'       => 'advanced',
		);

		$design['connector_width'] = array(
			'label'          => esc_html__('Width', 'divitorque'),
			'description'    => esc_html__('Here you can define custom width for the connector.', 'divitorque'),
			'type'           => 'range',
			'default'        => '80px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 500,
			),
			'toggle_slug'    => 'connector',
			'tab_slug'       => 'advanced',
		);

		$design['line_width'] = array(
			'label'          => esc_html__('Line Width', 'divitorque'),
			'description'    => esc_html__('Here you can define custom width for the vertical line.', 'divitorque'),
			'type'           => 'range',
			'default'        => '4px',
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'line',
			'tab_slug'       => 'advanced',
		);

		$design['line_color'] = array(
			'label'       => esc_html__('Line Color', 'divitorque'),
			'description' => esc_html__('Pick a color to use for the vertical line.', 'divitorque'),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'line',
			'default'     => '#efefef',
		);

		$design['active_line_color'] = array(
			'label'       => esc_html__('Active Line Color', 'divitorque'),
			'description' => esc_html__('Pick a color to use for the scrolled line.', 'divitorque'),
			'type'        => 'color-alpha',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'line',
			'default'     => '#1E3ADB',
		);

		$design['title_spacing_top'] = array(
			'label'          => esc_html__('Top Spacing', 'divitorque'),
			'description'    => esc_html__('Here you can define a custom spacing at the top of the title.', 'divitorque'),
			'type'           => 'range',
			'default'        => '0px',
			'mobile_options' => true,
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'title_subtitle',
			'sub_toggle'     => 'title',
			'tab_slug'       => 'advanced',
		);

		$design['title_spacing'] = array(
			'label'          => esc_html__('Bottom Spacing', 'divitorque'),
			'description'    => esc_html__('Here you can define a custom spacing at the bottom of the title.', 'divitorque'),
			'type'           => 'range',
			'default'        => '10px',
			'mobile_options' => true,
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'title_subtitle',
			'sub_toggle'     => 'title',
			'tab_slug'       => 'advanced',
		);

		$design['subtitle_spacing'] = array(
			'label'          => esc_html__('Bottom Spacing', 'divitorque'),
			'description'    => esc_html__('Here you can define a custom spacing at the bottom of the sub title.', 'divitorque'),
			'type'           => 'range',
			'default'        => '25px',
			'mobile_options' => true,
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'title_subtitle',
			'sub_toggle'     => 'subtitle',
			'tab_slug'       => 'advanced',
		);

		$design['date_spacing'] = array(
			'label'          => esc_html__('Date Spacing', 'divitorque'),
			'description'    => esc_html__('Here you can define a custom spacing at the top of the date text.', 'divitorque'),
			'type'           => 'range',
			'default'        => '25px',
			'mobile_options' => true,
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'date',
			'tab_slug'       => 'advanced',
		);

		$design['image_spacing'] = array(
			'label'          => esc_html__('Bottom Spacing', 'divitorque'),
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
		);

		$design['image_height'] = array(
			'label'          => esc_html__('Height', 'divitorque'),
			'description'    => esc_html__('Here you can define custom height for the image.', 'divitorque'),
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
		);

		$design['image_width'] = array(
			'label'          => esc_html__('Width', 'divitorque'),
			'description'    => esc_html__('Here you can define custom width for the image.', 'divitorque'),
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
		);

		$design['month_spacing'] = array(
			'label'          => esc_html__('Top-Bottom Spacing', 'divitorque'),
			'description'    => esc_html__('Define top and bottom spacing gap.', 'divitorque'),
			'type'           => 'range',
			'default'        => '2px',
			'mobile_options' => true,
			'default_unit'   => 'px',
			'range_settings' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 100,
			),
			'toggle_slug'    => 'connector_text',
			'sub_toggle'     => 'month',
			'tab_slug'       => 'advanced',
		);

		return array_merge($layout, $timeline, $design);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['fonts']       = array();
		$advanced_fields['text_shadow'] = array();

		$advanced_fields['box_shadow']['content'] = array(
			'css'         => array(
				'main'      => '%%order_class%% .dtp-vt-content',
				'important' => 'all',
			),
			'label'       => esc_html__('Content Box Shadow', 'divitorque'),
			'toggle_slug' => 'timeline',
		);

		$advanced_fields['borders']['connector'] = array(
			'toggle_slug' => 'connector',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-vt-circle',
					'border_styles' => '%%order_class%% .dtp-vt-circle',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii' => 'on|50%|50%|50%|50%',
			),
		);

		$advanced_fields['borders']['image'] = array(
			'toggle_slug' => 'image',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-vt-figure img',
					'border_styles' => '%%order_class%% .dtp-vt-figure img',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii' => 'on|0|0|0|0',
			),
		);

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__('Title', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-vt-title h4',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'title_subtitle',
			'sub_toggle'      => 'title',
			'font_size'       => array(
				'default' => '18px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['fonts']['subtitle'] = array(
			'label'           => esc_html__('Subtitle', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-vt-subtitle h5',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'title_subtitle',
			'sub_toggle'      => 'subtitle',
			'font_size'       => array(
				'default' => '16px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['fonts']['description'] = array(
			'label'           => esc_html__('Description', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-vt-desc',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'description',
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default' => '1.6em',
			),
		);

		$advanced_fields['fonts']['date'] = array(
			'label'           => esc_html__('Date', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-vt-date-time',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'date',
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['day'] = array(
			'label'           => esc_html__('Day', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .date-day',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'connector_text',
			'sub_toggle'      => 'day',
			'font_size'       => array(
				'default' => '13px',
			),
		);

		$advanced_fields['fonts']['month'] = array(
			'label'           => esc_html__('Month', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .date-month',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'connector_text',
			'sub_toggle'      => 'month',
			'font_size'       => array(
				'default' => '16px',
			),
		);

		$advanced_fields['fonts']['year'] = array(
			'label'           => esc_html__('Year', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .date-year',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'hide_text_align' => true,
			'toggle_slug'     => 'connector_text',
			'sub_toggle'      => 'year',
			'font_size'       => array(
				'default' => '11px',
			),
		);

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->custom_css($render_slug);
		wp_enqueue_style('torq-timeline');
		wp_enqueue_script('torq-timeline');
		return sprintf(
			'<div class="dtp-vertical-timeline %2$s" data-scroll="%3$s">
				%1$s
			</div>',
			$this->props['content'],
			$this->props['template'],
			$this->props['use_scroll_line']
		);
	}

	protected function custom_css($render_slug)
	{
		$show_arrow             = $this->props['show_arrow'];
		$show_date              = $this->props['show_date'];
		$show_time              = $this->props['show_time'];
		$content_left_width     = $this->props['content_left_width'];
		$template               = $this->props['template'];
		$use_scroll_line        = $this->props['use_scroll_line'];
		$show_arrow             = $this->props['show_arrow'];
		$connector_spacing      = $this->props['connector_spacing'];
		$content_bg             = $this->props['content_bg'];
		$connector_icon_size    = $this->props['connector_icon_size'];
		$connector_color        = $this->props['connector_color'];
		$connector_active_color = $this->props['connector_active_color'];
		$connector_bg           = $this->props['connector_bg'];
		$connector_height       = $this->props['connector_height'];
		$connector_width        = $this->props['connector_width'];
		$active_line_color      = $this->props['active_line_color'];
		$line_color             = $this->props['line_color'];
		$line_width             = $this->props['line_width'];
		$arrow_position         = $this->props['arrow_position'];
		$connector_position     = $this->props['connector_position'];
		$content_radius         = $this->props['content_radius'];
		$content_alignment      = $this->props['content_alignment'];
		$item_spacing           = $this->props['item_spacing'];
		$item_spacing_tablet    = $this->props['item_spacing_tablet'];
		$item_spacing_phone     = $this->props['item_spacing_phone'];
		$connector_pos          = 'left';

		if (empty($item_spacing_phone)) {
			$item_spacing_phone = !empty($item_spacing_tablet) ? $item_spacing_tablet : $item_spacing;
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .template-1 .torq_timeline_child:first-child .dtp-vt-item',
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				'declaration' => 'padding-top:' . $item_spacing_phone . ';',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .template-1 .torq_timeline_child .dtp-vt-circle',
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				'declaration' => 'top: -' . ((intval($item_spacing_phone) / 2) + 7) . 'px;',
			)
		);

		if ('template-3' === $template) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .template-3',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf(
						'padding-left: calc(%1$s/2)!important;',
						$connector_width
					),
				)
			);
		}

		if ('template-1' === $template) {
			$connector_pos = 'right';
		}

		if ('template-3' === $template || 'template-4' === $template) {
			$content_bg = !empty($content_bg) ? $content_bg : 'transparent';
		} else {
			$content_bg = !empty($content_bg) ? $content_bg : '#efefef';
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-vt-content-inner',
				'declaration' => sprintf('border-radius: %1$s;', $content_radius),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-vt-circle',
				'declaration' => sprintf('top: %1$s;', $connector_position),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-vt-content-inner:before',
				'declaration' => sprintf('top: %1$s;', $arrow_position),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .bapro_content_timeline_child',
				'declaration' => sprintf('min-height: %1$s!important;', $connector_height),
			)
		);

		if ('template-1' === $template) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-vt-content',
					'declaration' => sprintf(
						'margin-right: %1$s;',
						$connector_spacing
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_timeline_child:nth-child(2n) .dtp-vt-content',
					'declaration' => sprintf(
						'margin-left: %1$s; margin-right: 0!important;',
						$connector_spacing
					),
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-vt-content',
					'declaration' => sprintf(
						'margin-left: %1$s;',
						$connector_spacing
					),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .torq_timeline_child .dtp-vt-scroll',
				'declaration' => sprintf(
					'background: %1$s!important;
					width: %2$s!important;',
					$line_color,
					$line_width
				),
			)
		);

		if ('on' === $use_scroll_line) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_timeline_child .dtp-vt-scroll-inner, %%order_class%% .is-scroll .dtp-vt-circle',
					'declaration' => sprintf(
						'background: %1$s;',
						$active_line_color
					),
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-vt-scroll-inner',
					'declaration' => 'display: none!important;',
				)
			);
		}

		// Content Padding.
		$this->get_responsive_styles(
			'content_padding',
			'%%order_class%% .dtp-vt-content .dtp-vt-content-inner',
			array(
				'primary' => 'padding',
			),
			array(
				'default'     => '20px|20px|20px|20px',
				'conditional' => array(
					'name'   => 'template',
					'values' => array(
						array(
							'a' => 'template-3',
							'b' => '0px|0px|0px|0px',
						),
					),
				),
			),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-vt-content .dtp-vt-content-inner',
				'declaration' => sprintf(
					'text-align: %1$s;
					background: %2$s;',
					$content_alignment,
					$content_bg
				),
			)
		);

		$this->get_responsive_styles(
			'item_spacing',
			'%%order_class%% .torq_timeline_child .dtp-vt-content',
			array(
				'primary'   => 'padding-bottom',
				'important' => true,
			),
			array('default' => '40px'),
			$render_slug
		);

		// Connector.
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-vt-circle',
				'declaration' => sprintf(
					'%1$s: -%2$s;
					font-size: %3$s;
					color: %4$s;
					background: %5$s;
					height: %6$s;
					width: %7$s;',
					$connector_pos,
					$connector_spacing,
					$connector_icon_size,
					$connector_color,
					$connector_bg,
					$connector_height,
					$connector_width
				),
			)
		);

		if ('on' === $use_scroll_line) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .is-scroll .dtp-vt-circle',
					'declaration' => sprintf(
						'color: %1$s;',
						$connector_active_color
					),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-vt-circle img',
				'declaration' => sprintf(
					'width: %1$s;',
					$connector_icon_size
				),
			)
		);

		if ('template-1' === $template) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_timeline_child:nth-child(2n) .dtp-vt-circle',
					'declaration' => sprintf(
						'left: -%1$s;',
						$connector_spacing
					),
				)
			);
		}

		if ('off' === $show_date) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-vt-date-time',
					'declaration' => 'display: none!important;',
				)
			);
		}

		if ('off' === $show_time) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-vt-time, %%order_class%% .dtp-separator',
					'declaration' => 'display: none!important;',
				)
			);
		}

		// Content Width.
		if ('template-3' === $template) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .template-3',
					'declaration' => sprintf(
						'padding-left: %1$s!important;',
						$content_left_width
					),
				)
			);
		}

		if ('template-2' === $template) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .template-2',
					'declaration' => sprintf(
						'padding-left: calc(%1$s/1.8);',
						$connector_width
					),
				)
			);
		}

		if ('template-3' === $template) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .template-3 .dtp-vt-content-left',
					'declaration' => sprintf(
						'left: calc(-%1$s * 2);
						width: calc(%2$s - %1$s);',
						$connector_spacing,
						$content_left_width
					),
				)
			);
		}

		if ('off' === $show_arrow) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-vt-content-inner:before',
					'declaration' => 'display: none;',
				)
			);
		}

		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .dtp-vt-figure',
			array(
				'primary'   => 'height',
				'important' => false,
			),
			array('default' => 'auto'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_width',
			'%%order_class%% .dtp-vt-figure',
			array(
				'primary'   => 'width',
				'important' => false,
			),
			array('default' => '100%'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_spacing',
			'%%order_class%% .dtp-vt-figure',
			array(
				'primary'   => 'margin-bottom',
				'important' => false,
			),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .dtp-vt-figure img',
			array(
				'primary'   => 'height',
				'important' => false,
			),
			array('default' => 'auto'),
			$render_slug
		);

		$this->get_responsive_styles(
			'date_spacing',
			'%%order_class%% .dtp-vt-date-time',
			array(
				'primary'   => 'margin-top',
				'important' => false,
			),
			array('default' => '25px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'title_spacing_top',
			'%%order_class%% .dtp-vt-title',
			array(
				'primary'   => 'margin-top',
				'important' => false,
			),
			array('default' => '0px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'title_spacing',
			'%%order_class%% .dtp-vt-title',
			array(
				'primary'   => 'margin-bottom',
				'important' => false,
			),
			array('default' => '10px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'subtitle_spacing',
			'%%order_class%% .dtp-vt-subtitle',
			array(
				'primary'   => 'margin-bottom',
				'important' => false,
			),
			array('default' => '25px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'month_spacing',
			'%%order_class%% .dtp-vt-circle-date .date-month',
			array(
				'primary'   => 'margin-top',
				'important' => false,
			),
			array('default' => '2px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'month_spacing',
			'%%order_class%% .dtp-vt-circle-date .date-month',
			array(
				'primary'   => 'margin-bottom',
				'important' => false,
			),
			array('default' => '2px'),
			$render_slug
		);
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Timeline Item', 'divitorque');
	}
}

new DTP_Timeline();
