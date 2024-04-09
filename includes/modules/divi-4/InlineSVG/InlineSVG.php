<?php

class DTP_Svg extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_svg';
		$this->name       = esc_html__('Torq SVG', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'svg.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('SVG', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'svg' => esc_html__('SVG', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'svg' => array(
				'label'    => esc_html__('SVG', 'divitorque'),
				'selector' => '%%order_class%% svg',
			),
		);
	}

	public function get_fields()
	{
		$fields = array();

		$fields['svg_url'] = array(
			'label'              => __('Upload SVG', 'divitorque'),
			'description'        => esc_html__('Upload only SVG file with \'.svg\' file type. Please make sure your site has the permission to upload SVG.', 'divitorque'),
			'type'               => 'upload',
			'computed_affects'   => array(
				'__svg',
			),
			'upload_button_text' => esc_attr__('Upload SVG', 'divitorque'),
			'choose_text'        => esc_attr__('Upload SVG', 'divitorque'),
			'update_text'        => esc_attr__('Set As SVG', 'divitorque'),
			'toggle_slug'        => 'content',
		);

		$fields['svg_custom_width'] = array(
			'label'       => esc_html__('Use Custom Width', 'divitorque'),
			'type'        => 'yes_no_button',
			'description' => esc_html__('Makes SVG responsive and allows to change its width.', 'divitorque'),
			'default'     => 'off',
			'options'     => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'toggle_slug' => 'svg',
			'tab_slug'    => 'advanced',
		);

		$fields['svg_aspect_ratio'] = array(
			'label'            => esc_html__('Use Aspect Ratio', 'divitorque'),
			'type'             => 'yes_no_button',
			'description'      => esc_html__('This option allows your SVG to be scaled up.', 'divitorque'),
			'default'          => 'on',
			'options'          => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'show_if'          => array(
				'svg_custom_width' => 'on',
			),
			'computed_affects' => array(
				'__svg',
			),
			'toggle_slug'      => 'svg',
			'tab_slug'         => 'advanced',
		);

		$fields['svg_width'] = array(
			'label'            => esc_html__('Width', 'divitorque'),
			'description'      => esc_html__('Define custom width for your svg.', 'divitorque'),
			'type'             => 'range',
			'mobile_options'   => true,
			'validate_unit'    => true,
			'allowed_units'    => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
			'default'          => '150px',
			'default_unit'     => 'px',
			'default_on_front' => '',
			'allow_empty'      => true,
			'range_settings'   => array(
				'min'  => '0',
				'max'  => '500',
				'step' => '1',
			),
			'show_if'          => array(
				'svg_custom_width' => 'on',
			),
			'responsive'       => true,
			'sticky'           => true,
			'toggle_slug'      => 'svg',
			'tab_slug'         => 'advanced',
		);

		$fields['svg_height'] = array(
			'label'            => esc_html__('Height', 'divitorque'),
			'description'      => esc_html__('Define custom height for your svg.', 'divitorque'),
			'type'             => 'range',
			'mobile_options'   => true,
			'validate_unit'    => true,
			'allowed_units'    => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
			'default'          => '150px',
			'default_unit'     => 'px',
			'default_on_front' => '',
			'allow_empty'      => true,
			'range_settings'   => array(
				'min'  => '0',
				'max'  => '500',
				'step' => '1',
			),
			'show_if'          => array(
				'svg_custom_width' => 'on',
				'svg_aspect_ratio' => 'off',
			),
			'responsive'       => true,
			'sticky'           => true,
			'toggle_slug'      => 'svg',
			'tab_slug'         => 'advanced',
		);

		$fields['svg_custom_color'] = array(
			'label'       => esc_html__('Use Custom Color', 'divitorque'),
			'description' => esc_html__('Specifies color of all SVG.', 'divitorque'),
			'type'        => 'yes_no_button',
			'options'     => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'     => 'off',
			'toggle_slug' => 'svg',
			'tab_slug'    => 'advanced',
		);

		$fields['svg_color'] = array(
			'label'        => esc_html__('Color', 'divitorque'),
			'description'  => esc_html__('Pick a color to use for the svg.', 'divitorque'),
			'type'         => 'color-alpha',
			'default'      => '#000',
			'show_if'      => array(
				'svg_custom_color' => 'on',
			),
			'custom_color' => true,
			'toggle_slug'  => 'svg',
			'tab_slug'     => 'advanced',
			'hover'        => 'tabs',
		);

		$fields['svg_remove_inline_css'] = array(
			'label'       => esc_html__('Remove Inline CSS', 'divitorque'),
			'description' => esc_html__('Remove the inline styles in the loaded SVG.', 'divitorque'),
			'type'        => 'yes_no_button',
			'options'     => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'default'     => 'off',
			'toggle_slug' => 'svg',
			'tab_slug'    => 'advanced',
		);

		$fields['svg_alignment'] = array(
			'label'          => esc_html__('Alignment', 'divitorque'),
			'description'    => esc_html__('Align svg to the left, right or center.', 'divitorque'),
			'type'           => 'text_align',
			'options'        => et_builder_get_text_orientation_options(array('justified')),
			'options_icon'   => 'module_align',
			'default'        => 'center',
			'mobile_options' => true,
			'toggle_slug'    => 'svg',
			'tab_slug'       => 'advanced',
		);

		$fields['__svg'] = array(
			'type'                => 'computed',
			'computed_callback'   => array('DTP_Svg', 'get_svg'),
			'computed_depends_on' => array(
				'svg_url',
				'svg_aspect_ratio',
				'svg_remove_inline_css',
				'svg_custom_color',
			),
		);

		return $fields;
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();
		return $advanced_fields;
	}

	public static function get_svg($args = array())
	{
		$svg = '';

		$url = esc_url($args['svg_url']);

		if (empty($url)) {
			return $svg;
		}

		$svg = self::get_svg_by_url($url);

		$ext = pathinfo($url, PATHINFO_EXTENSION);

		if ('svg' !== $ext) {
			$svg = printf('<h5 class="dtp-inline-svg-error">%s</h5>', esc_html__('Please choose a SVG file format.', 'divitorque'));
		}

		if ('on' !== $args['svg_aspect_ratio']) {
			$svg = preg_replace('[preserveAspectRatio\s*?=\s*?"\s*?.*?\s*?"]', '', $svg);
			$svg = preg_replace('[<svg]', '<svg preserveAspectRatio="none"', $svg);
		}

		if ('on' === $args['svg_remove_inline_css']) {
			$svg = preg_replace('[style\s*?=\s*?"\s*?.*?\s*?"]', '', $svg);
		}

		if ('on' === $args['svg_custom_color']) {
			$svg = preg_replace('[fill\s*?=\s*?("(?!(?:\s*?none\s*?)")[^"]*")]', 'fill="currentColor"', $svg);
			$svg = preg_replace('[stroke\s*?=\s*?("(?!(?:\s*?none\s*?)")[^"]*")]', 'stroke="currentColor"', $svg);
		}

		return $svg;
	}

	public static function get_svg_by_url($url = null)
	{
		$url = esc_url($url);

		if (empty($url)) {
			return;
		}

		$ext = pathinfo($url, PATHINFO_EXTENSION);

		$base_url = site_url('/');
		$svg_path = str_replace($base_url, ABSPATH, $url);
		$key      = md5($svg_path);
		$svg      = get_transient($key);

		if (!$svg) {
			$svg = file_get_contents($svg_path); //phpcs:ignore
		}

		set_transient($key, $svg, DAY_IN_SECONDS);

		return $svg;
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_style('torq-svg');
		$this->apply_css($render_slug);
		$svg = self::get_svg($this->props);
		$svg_wrap = 'dtp-inline-svg';

		if ('on' === $this->props['svg_custom_width']) {
			$svg_wrap .= ' dtp-inline-svg-custom-width';
		}

		if ('on' === $this->props['svg_custom_color']) {
			$svg_wrap .= ' dtp-inline-svg-custom-color';
		}

		return sprintf(
			'<div class="dtp-inline-svg-wrap">
				<div class="%2$s">
					<div class="dtp-inline-svg-inner">%1$s</div>
				</div>
			</div>',
			$svg,
			$svg_wrap
		);
	}

	protected function apply_css($render_slug)
	{
		$this->get_responsive_styles(
			'svg_alignment',
			'%%order_class%% .dtp-inline-svg-wrap',
			array('primary' => 'text-align'),
			array('default' => 'center'),
			$render_slug
		);

		if ('on' === $this->props['svg_custom_width']) {
			$this->get_responsive_styles(
				'svg_width',
				'%%order_class%% .dtp-inline-svg',
				array('primary' => 'max-width'),
				array('default' => '150px'),
				$render_slug
			);

			if ('on' !== $this->props['svg_aspect_ratio']) {
				$this->get_responsive_styles(
					'svg_height',
					'%%order_class%% .dtp-inline-svg svg',
					array('primary' => 'height'),
					array('default' => '150px'),
					$render_slug
				);
			}
		}

		if ('on' === $this->props['svg_custom_color']) {
			$this->get_responsive_styles(
				'svg_color',
				'%%order_class%% .dtp-inline-svg',
				array('primary' => 'color'),
				array('default' => '#000'),
				$render_slug
			);

			if (isset($this->props['svg_color__hover'])) {
				$this->get_responsive_styles(
					'svg_color__hover',
					'%%order_class%% .dtp-inline-svg:hover',
					array('primary' => 'color'),
					array('default' => '#ddd'),
					$render_slug
				);
			}
		}
	}
}

new DTP_Svg();
