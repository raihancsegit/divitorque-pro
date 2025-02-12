<?php
class DTP_Compare_Image extends DTP_Builder_Module
{

	public function init()
	{
		$this->name       = esc_html__('Torq Compare Image', 'divitorque');
		$this->slug       = 'torq_compare_img';
		$this->vb_support = 'on';
		$this->icon_path  = plugin_dir_path(__FILE__) . 'compare-image.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'before'      => esc_html__('Before', 'divitorque'),
					'after'       => esc_html__('After', 'divitorque'),
					'settings'    => esc_html__('Settings', 'divitorque'),
					'orientation' => esc_html__('Orientation', 'divitorque'),
					'handle'      => esc_html__('Comparison Handle', 'divitorque'),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'label'  => esc_html__('Label', 'divitorque'),
					'handle' => esc_html__('Handle', 'divitorque'),
					'border' => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'before_img'   => array(
				'label'    => esc_html__('Before Image', 'divitorque'),
				'selector' => '%%order_class%% .twentytwenty-before',
			),
			'after_img'    => array(
				'label'    => esc_html__('After Image', 'divitorque'),
				'selector' => '%%order_class%% .twentytwenty-after',
			),
			'before_label' => array(
				'label'    => esc_html__('Before Label', 'divitorque'),
				'selector' => '%%order_class%% .twentytwenty-before-label',
			),
			'after_label'  => array(
				'label'    => esc_html__('After Label', 'divitorque'),
				'selector' => '%%order_class%% .twentytwenty-after-label',
			),
		);
	}

	public function get_fields()
	{
		return array(

			'before_img'      => array(
				'label'              => esc_html__('Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display as before image.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'description'        => esc_html__('Upload an image to display as before image', 'divitorque'),
				'hide_metadata'      => true,
				'default'            => DTP_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'computed_affects'   => array('__compare'),
				'toggle_slug'        => 'before',
				'dynamic_content'    => 'image',
			),

			'before_label'    => array(
				'label'           => esc_html__('Before Label', 'divitorque'),
				'description'     => esc_html__('Define before label text.', 'divitorque'),
				'default'         => 'Before',
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__('Define the HTML ALT text for your image here.', ''),
				'toggle_slug'     => 'before',
			),

			'before_label_bg' => array(
				'label'        => esc_html__('Before Label Background', 'divitorque'),
				'description'  => esc_html__('Here you can define a custom background for before label.', 'divitorque'),
				'default'      => $this->default_color,
				'type'         => 'color-alpha',
				'custom_color' => true,
				'toggle_slug'  => 'before',
			),

			'after_img'       => array(
				'label'              => esc_html__('Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display as after image.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'default'            => DTP_PLUGIN_ASSETS . 'imgs/placeholder.svg',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'description'        => esc_html__('Upload an image to display at as after image', 'divitorque'),
				'hide_metadata'      => true,
				'computed_affects'   => array('__compare'),

				'toggle_slug'        => 'after',
				'dynamic_content'    => 'image',
			),

			'after_label'     => array(
				'default'         => 'After',
				'label'           => esc_html__('After Label', 'divitorque'),
				'description'     => esc_html__('Define after label text.', 'divitorque'),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__('Define the HTML ALT text for your image here.', 'divitorque'),
				'toggle_slug'     => 'after',
			),

			'after_label_bg'  => array(
				'default'      => $this->default_color,
				'label'        => esc_html__('After Label Background', 'divitorque'),
				'description'  => esc_html__('Here you can define a custom background for after label.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'toggle_slug'  => 'after',
			),

			'orientation'     => array(
				'label'            => esc_html__('Orientation', 'divitorque'),
				'description'      => esc_html__('Select orientation.', 'divitorque'),
				'type'             => 'select',
				'option_category'  => 'layout',
				'options'          => array(
					'vertical'   => __('Vertical', 'divitorque'),
					'horizontal' => __('Horizontal', 'divitorque'),
				),
				'computed_affects' => array('__compare'),
				'default'          => 'horizontal',
				'toggle_slug'      => 'settings',
			),

			'offset_pct'      => array(
				'label'            => esc_html__('Handle Initial Offset', 'divitorque'),
				'description'      => esc_html__('Define handle initial offset.', 'divitorque'),
				'type'             => 'select',
				'option_category'  => 'layout',
				'options'          => array(
					'0.0' => __('0.0', 'divitorque'),
					'0.1' => __('0.1', 'divitorque'),
					'0.2' => __('0.2', 'divitorque'),
					'0.3' => __('0.3', 'divitorque'),
					'0.4' => __('0.4', 'divitorque'),
					'0.5' => __('0.5', 'divitorque'),
					'0.6' => __('0.6', 'divitorque'),
					'0.7' => __('0.7', 'divitorque'),
					'0.8' => __('0.8', 'divitorque'),
					'0.9' => __('0.9', 'divitorque'),
				),
				'computed_affects' => array('__compare'),
				'default'          => '0.5',
				'toggle_slug'      => 'settings',
			),

			'move_on_hover'   => array(
				'label'            => esc_html__('Move on Hover', 'divitorque'),
				'description'      => esc_html__('Here you can choose whether handle should be moved on hover.', 'divitorque'),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'computed_affects' => array('__compare'),
				'default'          => 'off',
				'toggle_slug'      => 'settings',
			),

			'overlay'         => array(
				'label'            => esc_html__('Use Overlay on Hover', 'divitorque'),
				'description'      => esc_html__('Here you can choose whether overlay should be used on hover.', 'divitorque'),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'computed_affects' => array('__compare'),
				'default'          => 'on',
				'toggle_slug'      => 'settings',
			),

			'show_label'      => array(
				'label'       => esc_html__('Show Before/After Label', 'divitorque'),
				'description' => esc_html__('Here you can choose whether before/after label should be used.', 'divitorque'),
				'type'        => 'select',
				'options'     => array(
					'always'   => __('Always', 'divitorque'),
					'on_hover' => __('On Hover', 'divitorque'),
				),
				'default'     => 'always',
				'toggle_slug' => 'settings',
				'show_if'     => array(
					'overlay' => 'on',
				),
			),

			'label_padding'   => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom padding for the label.', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'label',
				'default'        => '5px|20px|5px|20px',
				'mobile_options' => true,
			),

			'label_height'    => array(
				'label'          => esc_html__('Height', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom label height.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => 'initial',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'label',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'label_width'     => array(
				'label'          => esc_html__('Width', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom label width.', 'divitorque'),
				'type'           => 'range',
				'default_unit'   => 'px',
				'default'        => 'initial',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'label',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
			),

			'handle_style'    => array(
				'label'       => esc_html__('Handle Style', 'divitorque'),
				'description' => esc_html__('Here you can select a different handle type.', 'divitorque'),
				'type'        => 'select',
				'default'     => 'handle-1',
				'options'     => array(
					'handle-1' => __('Style 1', 'divitorque'),
					'handle-2' => __('Style 2', 'divitorque'),
				),
				'toggle_slug' => 'handle',
				'tab_slug'    => 'advanced',
			),

			'handle_color'    => array(
				'default'      => '#ffffff',
				'label'        => esc_html__('Handle Color', 'divitorque'),
				'description'  => esc_html__('Here you can define a custom handle color.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'toggle_slug'  => 'handle',
				'tab_slug'     => 'advanced',
			),

			'arrow_color'     => array(
				'default'      => '#ffffff',
				'label'        => esc_html__('Arrow Color', 'divitorque'),
				'description'  => esc_html__('Here you can define a custom color for the arrows.', 'divitorque'),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'toggle_slug'  => 'handle',
				'tab_slug'     => 'advanced',
				'show_if'      => array(
					'handle_style' => 'handle-2',
				),
			),

			'__compare'       => array(
				'type'                => 'computed',
				'computed_callback'   => array('DTP_Compare_Image', 'get_image_compare'),
				'computed_depends_on' => array(
					'before_img',
					'after_img',
					'move_on_hover',
					'offset_pct',
					'orientation',
					'overlay',
					'show_label',
				),
			),
		);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields         = array();
		$advanced_fields['text'] = array();

		$advanced_fields['fonts']['label'] = array(
			'label'           => esc_html__('Label', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .twentytwenty-before-label:before, %%order_class%% .twentytwenty-after-label:before',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'toggle_slug'     => 'label',
		);

		$advanced_fields['borders']['label'] = array(
			'toggle_slug' => 'label',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .twentytwenty-overlay div:before',
					'border_styles' => '%%order_class%% .twentytwenty-overlay div:before',
				),
				'important' => 'all',
			),
			'defaults'    => array(
				'border_radii'  => 'on|4px|4px|4px|4px',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
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
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		);

		return $advanced_fields;
	}

	static function get_image_compare($args = array())
	{
		$defaults = array(
			'before_img'   => '',
			'after_img'    => '',
			'before_label' => 'Before',
			'after_label'  => 'After',
			'overlay'      => '',
		);

		$args = wp_parse_args($args, $defaults);

		$before_img   = $args['before_img'];
		$after_img    = $args['after_img'];
		$before_label = $args['before_label'];
		$after_label  = $args['after_label'];

		$html = sprintf(
			'<img class="dtp-before-img" style="position: absolute;" src=" %1$s " alt="%3$s"/>
			<img class="dtp-after-img" src=" %2$s " alt="%4$s"/>',
			esc_attr($before_img),
			esc_attr($after_img),
			esc_attr($before_label),
			esc_attr($after_label)
		);

		return $html;
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_script('torq-event-move');
		wp_enqueue_script('torq-twentytwenty');
		wp_enqueue_style('torq-compare-image');
		wp_enqueue_script('torq-compare-image');
		$before_img    = $this->props['before_img'];
		$after_img     = $this->props['after_img'];
		$orientation   = $this->props['orientation'];
		$before_label  = $this->props['before_label'];
		$after_label   = $this->props['after_label'];
		$move_on_hover = $this->props['move_on_hover'];
		$offset_pct    = $this->props['offset_pct'];
		$overlay       = $this->props['overlay'];
		$order_class   = self::get_module_order_class($render_slug);
		$order_number  = str_replace('_', '', str_replace($this->slug, '', $order_class));

		$this->apply_css($render_slug);

		$data_string = sprintf(
			'data-orientation = "%1$s"
			data-moveonhover = "%2$s"
			data-beforelabel = "%3$s"
			data-afterlabel = "%4$s"
			data-offsetpct = "%5$s"
			data-ordernumber = "%6$s"
			data-overlay = "%7$s"',
			$orientation,
			$move_on_hover,
			$before_label,
			$after_label,
			$offset_pct,
			$order_number,
			$overlay
		);

		ob_start();

		$images = self::get_image_compare(
			array(
				'before_img'   => $before_img,
				'after_img'    => $after_img,
				'before_label' => $before_label,
				'after_label'  => $after_label,
			)
		);

		$html = sprintf(
			'<div class="dtp-image-compare" %2$s>
				<div class="dtp-image-compare-container">
				 %1$s
				</div>
			</div>',
			$images,
			$data_string
		);

		ob_get_clean();

		if (!empty($before_img)) {
			return $html;
		}
	}

	public function apply_css($render_slug)
	{
		$before_label_bg = $this->props['before_label_bg'];
		$after_label_bg  = $this->props['after_label_bg'];
		$show_label      = $this->props['show_label'];
		$handle_color    = $this->props['handle_color'];
		$label_height    = $this->props['label_height'];
		$label_width     = $this->props['label_width'];

		// handle_color.
		if ('handle-1' === $this->props['handle_style']) {
			$arrow_color = $this->props['handle_color'];
		} elseif ('handle-2' === $this->props['handle_style']) {
			$arrow_color = $this->props['arrow_color'];
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-handle',
					'declaration' => 'background-color:' . $handle_color . ';',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-horizontal .twentytwenty-handle:before, %%order_class%% .dtp-image-compare .twentytwenty-horizontal .twentytwenty-handle:after, %%order_class%% .dtp-image-compare .twentytwenty-vertical .twentytwenty-handle:before, %%order_class%% .dtp-image-compare .twentytwenty-vertical .twentytwenty-handle:after',
				'declaration' => 'background:' . $handle_color . ';',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-handle',
				'declaration' => 'border: 3px solid ' . $handle_color . ';',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-right-arrow',
				'declaration' => 'border-left: 6px solid ' . $arrow_color . ';',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-left-arrow',
				'declaration' => 'border-right: 6px solid ' . $arrow_color . ';',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-up-arrow',
				'declaration' => 'border-bottom: 6px solid ' . $arrow_color . ';',
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-image-compare .twentytwenty-down-arrow',
				'declaration' => 'border-top: 6px solid ' . $arrow_color . ';',
			)
		);
		// handle_color end.

		// Label.
		if ('initial' !== $label_height) {
			$this->get_responsive_styles(
				'label_height',
				'%%order_class%% .twentytwenty-overlay div:before',
				array('primary' => 'height'),
				array('default' => 'initial'),
				$render_slug
			);
		}

		if ('initial' !== $label_width) {
			$this->get_responsive_styles(
				'label_width',
				'%%order_class%% .twentytwenty-overlay div:before',
				array('primary' => 'width'),
				array('default' => 'initial'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'label_padding',
			'%%order_class%% .twentytwenty-overlay div:before',
			array('primary' => 'padding'),
			array('default' => '5px|20px|5px|20px'),
			$render_slug
		);

		if ($show_label === 'on_hover') {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .twentytwenty-before-label, %%order_class%% .twentytwenty-after-label',
					'declaration' => 'opacity:0;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover .twentytwenty-before-label, %%order_class%%:hover .twentytwenty-after-label',
					'declaration' => 'opacity:1;',
				)
			);
		}

		if (!empty($before_label_bg)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .twentytwenty-before-label:before',
					'declaration' => sprintf('background-color: %1$s!important;', $before_label_bg),
				)
			);
		}

		if (!empty($after_label_bg)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .twentytwenty-after-label:before',
					'declaration' => sprintf('background-color: %1$s!important;', esc_html($after_label_bg)),
				)
			);
		}
	}
}

new DTP_Compare_Image();
