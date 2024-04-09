<?php
class DTP_Timeline_Child extends DTP_Builder_Module
{
	public function init()
	{
		$this->vb_support               = 'on';
		$this->type                     = 'child';
		$this->child_title_var          = 'admin_title';
		$this->child_title_fallback_var = 'title';
		$this->slug                     = 'torq_timeline_child';
		$this->name                     = esc_html__('Timeline', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'box_shadow' => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);
	}

	public function get_fields()
	{
		$content = array();

		$content['use_date_connector'] = array(
			'label'           => esc_html__('Use Date Connector', 'divitorque'),
			'description'     => esc_html__('Here you can choose whether date connector should be displayed.', 'divitorque'),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'         => 'off',
			'toggle_slug'     => 'content',
		);

		$content['use_icon'] = array(
			'label'           => esc_html__('Use Connector Icon', 'divitorque'),
			'description'     => esc_html__('Here you can choose whether connector icon should be used.', 'divitorque'),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'         => 'on',
			'toggle_slug'     => 'content',
			'show_if'         => array(
				'use_date_connector' => 'off',
			),
		);

		$content['icon'] = array(
			'label'       => esc_html__('Select Connector Icon', 'divitorque'),
			'description' => esc_html__('The connector icon for your timeline item.', 'divitorque'),
			'type'        => 'select_icon',
			'toggle_slug' => 'content',
			'show_if'     => array(
				'use_icon'           => 'on',
				'use_date_connector' => 'off',
			),
		);

		$content['icon_image'] = array(
			'label'              => esc_html__('Upload Connector Icon', 'divitorque'),
			'description'        => esc_html__('Upload image or svg icon for connector.', 'divitorque'),
			'type'               => 'upload',
			'option_category'    => 'basic_option',
			'upload_button_text' => esc_attr__('Upload an Icon', 'divitorque'),
			'choose_text'        => esc_attr__('Choose an Icon', 'divitorque'),
			'update_text'        => esc_attr__('Set As Icon', 'divitorque'),
			'toggle_slug'        => 'content',
			'show_if'            => array(
				'use_icon'           => 'off',
				'use_date_connector' => 'off',
			),
		);

		$content['title'] = array(
			'label'           => esc_html__('Title', 'divitorque'),
			'description'     => esc_html__('Define the title text for your timeline item.', 'divitorque'),
			'type'            => 'text',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$content['subtitle'] = array(
			'label'           => esc_html__('Subtitle', 'divitorque'),
			'description'     => esc_html__('Define the sub title text for your timeline item.', 'divitorque'),
			'type'            => 'text',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$content['image'] = array(
			'label'              => esc_html__('Upload Image', 'divitorque'),
			'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
			'type'               => 'upload',
			'option_category'    => 'basic_option',
			'upload_button_text' => esc_attr__('Upload an Image', 'divitorque'),
			'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
			'update_text'        => esc_attr__('Set As Image', 'divitorque'),
			'toggle_slug'        => 'content',
		);

		$content['image_alt'] = array(
			'label'       => esc_html__('Image Alt Text', 'divitorque'),
			'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
			'type'        => 'text',
			'toggle_slug' => 'content',
		);

		$content['description'] = array(
			'label'           => esc_html__('Description', 'divitorque'),
			'description'     => esc_html__('Define the description text for your timeline item.', 'divitorque'),
			'type'            => 'textarea',
			'toggle_slug'     => 'content',
			'dynamic_content' => 'text',
		);

		$content['date_format'] = array(
			'label'       => esc_html__('Date Format', 'divitorque'),
			'description' => esc_html__('Select date format from the list.', 'divitorque'),
			'type'        => 'select',
			'toggle_slug' => 'content',
			'default'     => 'date_format_1',
			'options'     => array(
				'date_format_1' => esc_html__('January 01, 2021', 'divitorque'),
				'date_format_2' => esc_html__('Jan 01, 2021', 'divitorque'),
				'date_format_3' => esc_html__('01 January 2021', 'divitorque'),
				'date_format_4' => esc_html__('01 Jan 2021', 'divitorque'),
			),
		);

		$content['date_time'] = array(
			'label'           => esc_html__('Date Time', 'divitorque'),
			'description'     => esc_html__('Define date and time for the timeline item', 'divitorque'),
			'type'            => 'date_picker',
			'toggle_slug'     => 'content',
			'option_category' => 'basic_option',
			'default'         => '2021-01-01 00:00',
		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__('Admin Label', 'divitorque'),
				'type'        => 'text',
				'description' => esc_html__('This will change the label of the item', 'divitorque'),
				'toggle_slug' => 'admin_label',
			),
		);

		return array_merge($label, $content);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                   = array();
		$advanced_fields['text']           = array();
		$advanced_fields['fonts']          = array();
		$advanced_fields['text_shadow']    = array();
		$advanced_fields['max_width']      = array();
		$advanced_fields['margin_padding'] = array();

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '.dtp-vertical-timeline %%order_class%% .dtp-vt-content-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['border'] = array(
			'css' => array(
				'main'      => '.dtp-vertical-timeline %%order_class%% .dtp-vt-content-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '.dtp-vertical-timeline %%order_class%% .dtp-vt-content-inner',
				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	protected function render_title()
	{
		if (!empty($this->props['title'])) {
			return sprintf(
				'<div class="dtp-vt-title">
					<h4>%1$s</h4>
				</div>',
				$this->props['title']
			);
		}
	}

	protected function render_subtitle()
	{
		if (!empty($this->props['subtitle'])) {
			return sprintf(
				'<div class="dtp-vt-subtitle">
					<h5>%1$s</h5>
				</div>',
				$this->props['subtitle']
			);
		}
	}

	protected function render_description()
	{
		if (!empty($this->props['description'])) {
			return sprintf(
				'<div class="dtp-vt-desc">
					%1$s
				</div>',
				$this->props['description']
			);
		}
	}

	protected function get_timeline_date()
	{
		$date_time          = explode(' ', $this->props['date_time']);
		$date_format        = $this->props['date_format'];
		$use_date_connector = $this->props['use_date_connector'];

		$date_formats = array(
			'date_format_1' => 'F d, Y',
			'date_format_2' => 'M d, Y',
			'date_format_3' => 'd F Y',
			'date_format_4' => 'd M Y',
		);

		if ('on' === $use_date_connector) {
			return sprintf(
				'<div class="dtp-vt-circle">
						<div class="dtp-vt-circle-date">
							<div class="date-day">
								%1$s
							</div>
							<div class="date-month">
								%2$s
							</div>
							<div class="date-year">
								%3$s
							</div>
						</div>
					</div>',
				date_format(date_create($date_time[0]), 'd'),
				date_format(date_create($date_time[0]), 'M'),
				date_format(date_create($date_time[0]), 'Y')
			);
		} else {
			return sprintf(
				'<div class="dtp-vt-date-time dtp-flex">
						<div class="dtp-vt-date">
							%1$s
						</div>
						<div class="dtp-vt-time">
							%2$s
						</div>
					</div>',
				date_format(date_create($date_time[0]), $date_formats[$date_format]),
				date_format(date_create($date_time[1]), 'h A')
			);
		}
	}

	protected function get_timeline_icon()
	{
		$icon_image = $this->props['icon_image'];
		$use_icon   = $this->props['use_icon'];
		$icon       = $this->props['icon'];
		$icon       = esc_attr(et_pb_process_font_icon($icon));
		$_icon      = '';

		if ('on' === $use_icon) {
			if (function_exists('dtp_inject_fa_icons')) {
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['icon']);
			}

			$_icon = sprintf(
				'<i class="dtp-et-icon">%1$s</i>',
				$icon
			);
		} else {
			if (!empty($icon_image)) {
				$_icon = '<img src="' . $icon_image . '" alt=""/>';
			}
		}

		return sprintf(
			'<div class="dtp-vt-circle">
				%1$s
			</div>',
			$_icon
		);
	}

	protected function get_timeline_connector()
	{
		$use_dc = $this->props['use_date_connector'];
		if ('off' === $use_dc) {
			return $this->get_timeline_icon();
		}

		return $this->get_timeline_date();
	}

	protected function get_timeline_image()
	{
		$image     = $this->props['image'];
		$image_alt = $this->props['image_alt'];
		if (!empty($image)) {
			return sprintf(
				'<figure class="dtp-vt-figure">
					<img src="%1$s" alt="%2$s" />
				</figure>',
				$image,
				$image_alt
			);
		}
	}

	protected function render_template()
	{
		$use_dc = $this->props['use_date_connector'];
		return sprintf(
			'<div class="dtp-vt-content-inner">
				<div class="dtp-vt-content-left">
					%1$s %2$s
				</div>
				<div class="dtp-vt-content-right">
					%3$s %4$s %5$s
				</div>
			</div>',
			$this->render_title(),
			$this->render_subtitle(),
			$this->get_timeline_image(),
			$this->render_description(),
			'off' === $use_dc ? $this->get_timeline_date() : ''
		);
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family',
				'render_slug'    => $render_slug,
				'base_attr_name' => 'icon',
				'important'      => true,
				'selector'       => '%%order_class%% .dtp-vt-circle i',
				'processor'      => array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		return sprintf(
			'<div class="dtp-vt-item">
				<div class="dtp-vt-scroll">
					<div class="dtp-vt-scroll-inner"></div>
				</div>
				<div class="dtp-vt-content">
					%1$s %2$s
				</div>
			</div>',
			$this->get_timeline_connector(),
			$this->render_template()
		);
	}
}

new DTP_Timeline_Child();
