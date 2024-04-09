<?php
class DTP_Image_Zoom extends DTP_Builder_Module
{
	public $slug       = 'torq_image_zoom';
	public $vb_support = 'on';

	public function init()
	{
		$this->name      = esc_html__('Torq Image Zoom', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'zoom-image.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'image'    => esc_html__('Image', 'divitorque'),
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'magnifier'  => esc_html__('Magnifier Lens', 'divitorque'),
					'image'      => esc_html__('Image', 'divitorque'),
					'border'     => esc_html__('Border', 'divitorque'),
					'box_shadow' => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'image' => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '%%order_class%% img',
			),
			'lens'  => array(
				'label'    => esc_html__('Lens', 'divitorque'),
				'selector' => '%%order_class%% .magnify .magnify-lens',
			),
		);
	}

	public function get_fields()
	{
		return array(
			'image_small' => array(
				'label'              => esc_html__('Upload Small Image', 'divitorque'),
				'description'        => esc_html__('Upload preview image in small size.', 'divitorque'),
				'type'               => 'upload',
				'default'            => DTP_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'image',
			),
			'image_large' => array(
				'label'              => esc_html__('Upload Large Image', 'divitorque'),
				'description'        => esc_html__('This image will be used for zooming.', 'divitorque'),
				'type'               => 'upload',
				'default'            => DTP_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'image',
			),
			'image_alt'   => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Alternative text form HTML img tag', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'image',
			),
			'speed'       => array(
				'label'          => esc_html__('Speed', 'divitorque'),
				'description'    => esc_html__('Fade-in/out animation speed in ms when the lens moves on/off the image', 'divitorque'),
				'divitorque',
				'type'           => 'range',
				'mobile_options' => true,
				'fixed_unit'     => 'ms',
				'default'        => '200ms',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 1000,
				),
				'toggle_slug'    => 'settings',
			),
			'use_shadow'  => array(
				'label'           => esc_html__('Use Lens Shadow', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether lens shadow should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'settings',
			),
			'mg_height'   => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define lens height.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'fixed_unit'     => 'px',
				'default'        => '100px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'magnifier',
				'tab_slug'       => 'advanced',
			),
			'mg_width'    => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define lens width.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'fixed_unit'     => 'px',
				'default'        => '100px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'magnifier',
				'tab_slug'       => 'advanced',
			),
		);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['fonts']       = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();

		$advanced_fields['borders']['image'] = array(
			'toggle_slug' => 'image',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% img',
					'border_styles' => '%%order_class%% img',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|0|0|0|0',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333',
					'style' => 'solid',
				),
			),
		);

		$advanced_fields['borders']['mg'] = array(
			'toggle_slug' => 'magnifier',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .magnify .magnify-lens',
					'border_styles' => '%%order_class%% .magnify .magnify-lens',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|100%|100%|100%|100%',
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

		$advanced_fields['box_shadow']['mg'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'css'         => array(
				'main'      => '%%order_class%% .magnify .magnify-lens',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'magnifier',
			'show_if'     => array(
				'use_shadow' => 'on',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'css'         => array(
				'main'      => '%%order_class%%',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'box_shadow',
		);

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_css($render_slug);
		wp_enqueue_script('torq-image-magnify');
		wp_enqueue_script('torq-image-zoom');
		wp_enqueue_style('torq-image-zoom');

		return sprintf(
			'<div class="dtp-module dtp-image-magnifier dtp-image-magnifier-front">
				<img
					data-magnify-speed="%1$s"
					data-magnify-src="%2$s"
					src="%3$s"
					alt="%4$s"
				/>
			</div>',
			$this->props['speed'],
			$this->props['image_large'],
			$this->props['image_small'],
			$this->props['image_alt']
		);
	}

	protected function render_css($render_slug)
	{
		if ('on' === $this->props['use_shadow']) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .magnify-lens',
					'declaration' => 'box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85),0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);',
				)
			);
		}

		$this->get_responsive_styles(
			'mg_width',
			'%%order_class%% .magnify .magnify-lens',
			array('primary' => 'width'),
			array('default' => '100px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'mg_height',
			'%%order_class%% .magnify .magnify-lens',
			array('primary' => 'height'),
			array('default' => '100px'),
			$render_slug
		);
	}
}

new DTP_Image_Zoom();
