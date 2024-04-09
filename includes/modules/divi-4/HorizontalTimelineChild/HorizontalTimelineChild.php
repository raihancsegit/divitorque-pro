<?php
class DTP_Horizontal_Timeline_Child extends DTP_Builder_Module
{
	public function init()
	{
		$this->slug                     = 'torq_timeline_horizontal_child';
		$this->vb_support               = 'on';
		$this->type                     = 'child';
		$this->child_title_var          = 'admin_title';
		$this->child_title_fallback_var = 'title';
		$this->name                     = esc_html__('Timeline', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general' => esc_html__('General', 'divitorque'),
				),
			),
		);
	}

	public function get_fields()
	{
		$content = array(
			'use_icon'    => array(
				'label'           => esc_html__('Use Icon', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether icon should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'content',
			),
			'icon'        => array(
				'label'       => esc_html__('Select Icon', 'divitorque'),
				'description' => esc_html__('Choose an icon to display with your timeline item.', 'divitorque'),
				'type'        => 'select_icon',
				'toggle_slug' => 'content',
				'show_if'     => array(
					'use_icon' => 'on',
				),
			),
			'icon_image'  => array(
				'label'              => esc_html__('Upload Icon Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display for the icon.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Icon', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Icon', 'divitorque'),
				'update_text'        => esc_attr__('Set As Icon', 'divitorque'),
				'toggle_slug'        => 'content',
				'show_if'            => array(
					'use_icon' => 'off',
				),
			),
			'title'       => array(
				'label'           => esc_html__('Title', 'divitorque'),
				'description'     => esc_html__('Input the title text for for this timeline item.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),
			'description' => array(
				'label'           => esc_html__('Description', 'divitorque'),
				'description'     => esc_html__('Input the description text for for this timeline item.', 'divitorque'),
				'type'            => 'textarea',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),
			'date_text'   => array(
				'label'           => esc_html__('Date', 'divitorque'),
				'description'     => esc_html__('Here you can define the date text for this timeline item.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),
			'image'       => array(
				'label'              => esc_html__('Upload Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'content',
			),
			'image_alt'   => array(
				'label'       => esc_html__('Image Alt Text', 'brain-divi-addons'),
				'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),
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
		$advanced_fields['borders']        = array();
		$advanced_fields['fonts']          = array();
		$advanced_fields['box_shadow']     = array();
		$advanced_fields['text_shadow']    = array();
		$advanced_fields['max_width']      = array();
		$advanced_fields['margin_padding'] = array();
		$advanced_fields['background']     = array();

		return $advanced_fields;
	}

	protected function render_icon()
	{
		$icon_image = $this->props['icon_image'];
		$use_icon   = $this->props['use_icon'];
		$icon       = $this->props['icon'];

		$html = '';

		if ('on' === $use_icon) {
			$icon = esc_attr(et_pb_process_font_icon($icon));
			$html = '<i class="dtp-et-icon">' . $icon . '</i>';
		} elseif (!empty($icon_image) && 'off' === $use_icon) {
			$html = '<img src="' . $icon_image . '" alt=""/>';
		}

		return sprintf(
			'<div class="dtp-horizontal-timeline-icon">
				%1$s
			</div>',
			$html
		);
	}

	protected function render_title()
	{
		$title = $this->props['title'];
		if (!empty($title)) {
			return sprintf(
				'<div class="dtp-horizontal-timeline-title">
					<h4>%1$s</h4>
				</div>',
				$title
			);
		}
	}

	protected function render_description()
	{
		$description = $this->props['description'];
		if (!empty($description)) {
			return sprintf(
				'<div class="dtp-horizontal-timeline-desc">
					%1$s
				</div>',
				$description
			);
		}
	}

	protected function render_date()
	{
		$date_text = $this->props['date_text'];
		if (!empty($date_text)) {
			return sprintf(
				'<div class="dtp-horizontal-timeline-date">
					%1$s
				</div>',
				$date_text
			);
		} else {
			return '<div class="dtp-horizontal-timeline-date empty-date">Empty Date</div>';
		}
	}

	protected function render_module_image()
	{
		if (!empty($this->props['image'])) {
			return sprintf(
				'<div class="dtp-horizontal-timeline-figure">
					<img src="%1$s" alt="%2$s"/>
				</div>',
				$this->props['image'],
				$this->props['image_alt']
			);
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		if ('on' === $this->props['use_icon']) {
			if (function_exists('dtp_inject_fa_icons')) {
				// Inject Font Awesome Manually!.
				dtp_inject_fa_icons($this->props['icon']);
			}

			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtp-horizontal-timeline-icon i',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);
		}

		return sprintf(
			'<div class="dtp-horizontal-timeline-item">
				<div class="dtp-horizontal-timeline-top">
					%1$s
					<div class="dtp-horizontal-timeline-icon-wrap">
						%2$s
					</div>
				</div>
				<div class="content-inner">
					<div class="dtp-horizontal-timeline-content-wrap">
						<div class="dtp-horizontal-timeline-arrow"></div>
						<div class="dtp-horizontal-timeline-content">
							%3$s
							%4$s
							%5$s
						</div>
					</div>
				</div>
			</div>',
			$this->render_date(),
			$this->render_icon(),
			$this->render_module_image(),
			$this->render_title(),
			$this->render_description()
		);
	}
}

new DTP_Horizontal_Timeline_Child();
