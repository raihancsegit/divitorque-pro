<?php
class DTP_Logo_List_Child extends DTP_Builder_Module
{
	public $slug                     = 'torq_logo_list_child';
	public $vb_support               = 'on';
	public $type                     = 'child';
	public $child_title_var          = 'admin_title';
	public $child_title_fallback_var = 'logo_alt';

	public function init()
	{
		$this->name = esc_html__('Logo', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'border'  => esc_html__('Border', 'divitorque'),
				),
			),
		);
	}

	public function get_fields()
	{
		$fields = array(

			'logo_url'     => array(
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
				'description' => esc_html__('Define alt text for html img tag.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'main_content',
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

		return array_merge($label, $fields);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['fonts']       = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['max_width']   = array();

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtp-logo-list__item',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '%%order_class%% .dtp-logo-list__item',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['default'] = array(
			'label_prefix' => esc_html__('Logo', 'divitorque'),
			'toggle_slug'  => 'border',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-logo-list__item',
					'border_styles' => '%%order_class%% .dtp-logo-list__item',
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

		return $advanced_fields;
	}

	public function render_logo()
	{
		$logo_url   = $this->props['logo_url'];
		$logo_alt = $this->props['logo_alt'];

		if (!empty($logo_url)) {
			return sprintf(
				'<img src="%1$s" alt="%2$s"/>',
				$logo_url,
				$logo_alt
			);
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		// CSS Classes.
		$this->remove_classname('et_pb_module');
		$this->add_classname('ba_et_pb_module');

		return sprintf(
			'<div class="dtp-module dtp-child dtp-logo-list__item">
                    <div class="dtp-logo-list__item__inner">
					    %1$s
				    </div>
                </div>',
			$this->render_logo()
		);
	}
}

new DTP_Logo_List_Child();
