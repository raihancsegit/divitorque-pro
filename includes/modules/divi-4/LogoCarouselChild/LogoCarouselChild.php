<?php
class DTP_Logo_Carousel_Child extends DTP_Builder_Module
{
	public $slug                     = 'torq_logo_carousel_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'logo_alt';

	public function init()
	{
		$this->name = esc_html__('Torq Logo', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__('Content', 'divitorque'),
					'tab_content'  => esc_html__('Tab Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'overlay' => esc_html__('Overlay', 'divitorque'),
					'borders' => esc_html__('Borders', 'divitorque'),
				),
			),
		);
	}

	public function get_fields()
	{
		$fields = array(

			'logo'         => array(
				'label'              => esc_html__('Upload Logo', 'divitorque'),
				'description'        => esc_html__('Upload a logo or type in the URL of the logo you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload a Logo', 'divitorque'),
				'choose_text'        => esc_attr__('Choose a Logo', 'divitorque'),
				'update_text'        => esc_attr__('Set As Logo', 'divitorque'),
				'toggle_slug'        => 'main_content',
			),

			'logo_alt'   => array(
				'label'       => esc_html__('Logo Alt Text', 'divitorque'),
				'description' => esc_html__('Define the HTML ALT text for your logo image here.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'main_content',
			),

			'is_link'      => array(
				'label'           => esc_html__('Use Link', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether logo should be linked.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'toggle_slug'     => 'main_content',
			),

			'link_url'     => array(
				'label'           => esc_html__('Link Url', 'divitorque'),
				'description'     => esc_html__('Here you can define the logo link url.', 'divitorque'),
				'type'            => 'text',
				'default'         => '',
				'dynamic_content' => 'url',
				'show_if'         => array(
					'is_link' => 'on',
				),
				'toggle_slug'     => 'main_content',
			),

			'link_options' => array(
				'type'        => 'multiple_checkboxes',
				'default'     => 'off|off',
				'toggle_slug' => 'main_content',
				'options'     => array(
					'link_target' => 'Open in new window',
					'link_rel'    => 'Add nofollow',
				),
				'show_if'     => array(
					'is_link' => 'on',
				),
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

		$overlay = $this->get_overlay_option_fields('overlay', 'off', array());

		return array_merge($label, $fields, $overlay);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['fonts']       = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['max_width']   = array();

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtp-logo-carousel-item',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['item'] = array(
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
				'important' => 'all',
			),
			'label_prefix' => esc_html__('Item', 'divitorque'),
			'defaults'     => array(
				'border_radii'  => 'on|0px|0px|0px|0px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'borders',
		);

		return $advanced_fields;
	}

	public function render_ref_attr()
	{
		if ($this->props['is_link'] === 'on') {
			$link_options = explode('|', $this->props['link_options']);

			if ($link_options[1] === 'on') {
				return sprintf('ref="nofollow"');
			}
		}
	}

	public function render_logo()
	{
		$logo        = $this->props['logo'];
		$logo_alt  = $this->props['logo_alt'];

		if ($this->props['is_link'] === 'on') {
			$link_options = explode('|', $this->props['link_options']);
			$target       = $link_options[0] === 'on' ? '_blank' : '_self';
			$link_url     = $this->props['link_url'];

			return sprintf(
				'<a target="%1$s" href="%2$s" %3$s><img class="dtp-swapped-img" data-mfp-src="%4$s" src="%4$s" alt="%5$s" /></a>',
				$target,
				$link_url,
				$this->render_ref_attr(),
				$logo,
				$logo_alt
			);
		}

		return sprintf(
			'<img class="dtp-swapped-img" src="%1$s" alt="%2$s" />',
			$logo,
			$logo_alt
		);
	}

	public function render($attrs, $content, $render_slug)
	{
		// Module classes.
		$this->remove_classname('et_pb_module');

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

		// Overlay Styles.
		$this->get_overlay_style($render_slug, 'logo', '%%order_class%% .dtp-carousel-item');
		dtp_inject_fa_icons($this->props['overlay_icon']);
		$processed_overlay_icon = esc_attr(et_pb_process_font_icon($this->props['overlay_icon']));
		$overlay_icon           = !empty($processed_overlay_icon) ? $processed_overlay_icon : '';

		return sprintf(
			'<div class="dtp-carousel-item dtp-logo-carousel-item dtp-swapped-img-selector">
			    <div class="dtp-overlay"><i class="dtp-overlay-icon">%2$s</i></div>
				%1$s
			</div>',
			$this->render_logo(),
			$overlay_icon
		);
	}
}

new DTP_Logo_Carousel_Child();
