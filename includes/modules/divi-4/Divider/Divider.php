<?php
class DTP_Divider extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_divider';
		$this->name       = esc_html__('Torq Divider', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'module-icon.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'divider'   => esc_html__('Divider', 'divitorque'),
					'text'      => array(
						'title'             => esc_html__('Divider Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general' => array(
								'name' => esc_html__('General', 'divitorque'),
							),
							'typo'    => array(
								'name' => esc_html__('Typography', 'divitorque'),
							),
						),
					),
					'icon'      => esc_html__('Icon/Image', 'divitorque'),
					'border'    => esc_html__('Border', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'title'  => array(
				'label'    => esc_html__('Divider Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-divider__text span',
			),
			'icon'   => array(
				'label'    => esc_html__('Divider Icon', 'divitorque'),
				'selector' => '%%order_class%% .dtp-divider__icon i',
			),
			'image'  => array(
				'label'    => esc_html__('Divider Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-divider__image img',
			),
			'border' => array(
				'label'    => esc_html__('Divider Border', 'divitorque'),
				'selector' => '%%order_class%% .dtp-divider__border',
			),
		);
	}

	public function get_fields()
	{
		$content = array(
			'active_element' => array(
				'label'       => esc_html__('Divider Element', 'divitorque'),
				'description' => esc_html__('You can insert an element like text, icon, or image on the divider', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'main_content',
				'default'     => 'icon',
				'options'     => array(
					'text'  => esc_html__('Text', 'divitorque'),
					'icon'  => esc_html__('Icon', 'divitorque'),
					'image' => esc_html__('Image', 'divitorque'),
				),
			),
			'img_url'        => array(
				'label'              => esc_html__('Image', 'divitorque'),
				'description'        => esc_html__('Upload an image for divider, or type in the URL to the image you would like to display', 'divitorque'),
				'type'               => 'upload',
				'data_type'          => 'image',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'main_content',
				'show_if'            => array(
					'active_element' => 'image',
				),
			),
			'title'          => array(
				'label'           => esc_html__('Divider Text', 'divitorque'),
				'description'     => esc_html__('Text will appear on the divider', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'show_if'         => array(
					'active_element' => 'text',
				),
			),
			'icon'           => array(
				'label'           => esc_html__('Select Icon', 'divitorque'),
				'description'     => esc_html__('Choose an icon to display with your divider', 'divitorque'),
				'type'            => 'select_icon',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'default'         => '&#xe0ed;||divi||400',
				'show_if'         => array(
					'active_element' => 'icon',
				),
			),
		);

		$divider = array(
			'content_alignment' => array(
				'label'           => esc_html__('Content Alignment', 'divitorque'),
				'description'     => esc_html__('This controls how your content is aligned within the divider', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'module_align',
				'default'         => 'center',
				'toggle_slug'     => 'divider',
				'tab_slug'        => 'advanced',
				'mobile_options'  => true,
			),
			'use_shape'         => array(
				'label'           => esc_html__('Use Bottom Shape', 'divitorque'),
				'description'     => esc_html__('Insert a shape on the divider bottom', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'off',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'divider',
			),
			'shape'             => array(
				'label'       => esc_html__('Select Shape', 'divitorque'),
				'description' => esc_html__('Choice your desire shape for the divider bottom', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => 'shape_1',
				'options'     => array(
					'shape_1'  => esc_html__('Shape 1', 'divitorque'),
					'shape_2'  => esc_html__('Shape 2', 'divitorque'),
					'shape_3'  => esc_html__('Shape 3', 'divitorque'),
					'shape_4'  => esc_html__('Shape 4', 'divitorque'),
					'shape_5'  => esc_html__('Shape 5', 'divitorque'),
					'shape_6'  => esc_html__('Shape 6', 'divitorque'),
					'shape_7'  => esc_html__('Shape 7', 'divitorque'),
					'shape_8'  => esc_html__('Shape 8', 'divitorque'),
					'shape_9'  => esc_html__('Shape 9', 'divitorque'),
					'shape_10' => esc_html__('Shape 10', 'divitorque'),
					'shape_11' => esc_html__('Shape 11', 'divitorque'),
					'shape_12' => esc_html__('Shape 12', 'divitorque'),
					'shape_13' => esc_html__('Shape 13', 'divitorque'),
					'shape_14' => esc_html__('Shape 14', 'divitorque'),
					'shape_15' => esc_html__('Shape 15', 'divitorque'),
					'shape_16' => esc_html__('Shape 16', 'divitorque'),
					'shape_17' => esc_html__('Shape 17', 'divitorque'),
					'shape_18' => esc_html__('Shape 18', 'divitorque'),
				),
				'show_if'     => array(
					'use_shape' => 'on',
				),
			),
			'shape_width'       => array(
				'label'          => esc_html__('Shape Width', 'divitorque'),
				'description'    => esc_html__('Increase or decrease default divider bottom shape width', 'divitorque'),
				'type'           => 'range',
				'default'        => '280px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 800,
				),
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'shape_weight'      => array(
				'label'          => esc_html__('Shape Weight', 'divitorque'),
				'description'    => esc_html__('Increase or decrease default divider bottom shape weight', 'divitorque'),
				'type'           => 'range',
				'default'        => '1',
				'unitless'       => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 8,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
			'shape_color'       => array(
				'label'       => esc_html__('Shape Color', 'divitorque'),
				'description' => esc_html__('Choose your desired color for the divider bottom shape', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'divider',
				'default'     => '#333333',
				'show_if'     => array(
					'use_shape' => 'on',
				),
			),
			'shape_margin'      => array(
				'label'          => esc_html__('Shape Margin', 'divitorque'),
				'description'    => esc_html__('Shape Margin adds extra space to the outside of the elements, increasing the distance between the element and other items on the page These controls help you to put divider bottom shape on your desire position', 'divitorque'),
				'type'           => 'custom_margin',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'divider',
				'default'        => '0px|0px|0px|0px',
				'mobile_options' => true,
				'show_if'        => array(
					'use_shape' => 'on',
				),
			),
		);

		$icon_img = array(
			'icon_color'   => array(
				'label'       => esc_html__('Icon Color', 'divitorque'),
				'description' => esc_html__('Choose your desired color for the divider icon', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'default'     => $this->default_color,
				'show_if'     => array(
					'active_element' => 'icon',
				),
			),
			'icon_bg'      => array(
				'label'       => esc_html__('Icon Background', 'divitorque'),
				'description' => esc_html__('Set the background color of divider icon', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'show_if'     => array(
					'active_element' => 'icon',
				),
			),
			'icon_size'    => array(
				'label'          => esc_html__('Icon Size', 'divitorque'),
				'description'    => esc_html__('Increase or decrease the size of divider icon', 'divitorque'),
				'type'           => 'range',
				'default'        => '40px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'icon_padding' => array(
				'label'          => esc_html__('Icon Padding', 'divitorque'),
				'description'    => esc_html__('Icon padding adds extra space to the inside of the icon, increasing the distance between the edge of the icon', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'icon',
				),
			),
			'img_width'    => array(
				'label'          => esc_html__('Image Width', 'divitorque'),
				'description'    => esc_html__('Increase or decrease divider image width. This control helps you to reduce or extend the image size', 'divitorque'),
				'type'           => 'range',
				'default'        => '100px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 500,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'show_if'        => array(
					'active_element' => 'image',
				),
			),
		);

		$border = array(
			'border_type'          => array(
				'label'       => esc_html__('Border Type', 'divitorque'),
				'description' => esc_html__('Select different types of border for the divider', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'classic',
				'options'     => array(
					'none'    => esc_html__('None', 'divitorque'),
					'classic' => esc_html__('Classic', 'divitorque'),
					'pattern' => esc_html__('Pattern', 'divitorque'),
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_style_classic' => array(
				'label'       => esc_html__('Border Style', 'divitorque'),
				'description' => esc_html__('Select different types of border style for the divider', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'double',
				'options'     => array(
					'solid'  => esc_html__('Solid', 'divitorque'),
					'double' => esc_html__('Double', 'divitorque'),
					'dotted' => esc_html__('Dotted', 'divitorque'),
					'dashed' => esc_html__('Dashed', 'divitorque'),
				),
				'show_if'     => array(
					'border_type' => 'classic',
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_style_pattern' => array(
				'label'       => esc_html__('Border Style', 'divitorque'),
				'description' => esc_html__('Select different types of border style for the divider', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => 'curved',
				'options'     => array(
					'curved' => esc_html__('Curved', 'divitorque'),
					'zigzag' => esc_html__('Zigzag', 'divitorque'),
					'square' => esc_html__('Square', 'divitorque'),
					'curly'  => esc_html__('Curly', 'divitorque'),
				),
				'show_if'     => array(
					'border_type' => 'pattern',
				),
				'show_if_not' => array(
					'use_shape' => 'on',
				),
			),
			'border_gap'           => array(
				'label'          => esc_html__('Border Spacing', 'divitorque'),
				'description'    => esc_html__('Increase or decrease default divider spacing relative to the divider content', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_color'         => array(
				'label'       => esc_html__('Border Color', 'divitorque'),
				'description' => esc_html__('Choose your desired color for the divider border', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'border',
				'default'     => $this->default_color,
				'show_if_not' => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_weight'        => array(
				'label'          => esc_html__('Border Weight', 'divitorque'),
				'description'    => esc_html__('Increase or decrease divider border weight', 'divitorque'),
				'type'           => 'range',
				'default'        => '6px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
			'border_height'        => array(
				'label'          => esc_html__('Border Height', 'divitorque'),
				'description'    => esc_html__('Increase or decrease divider border height', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
				'show_if'        => array(
					'border_type' => 'pattern',
				),
			),
			'border_offset'        => array(
				'label'          => esc_html__('Border offset Top', 'divitorque'),
				'description'    => esc_html__('Increase or decrease offset value relative to the divider content', 'divitorque'),
				'type'           => 'range',
				'default'        => '0px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => -50,
					'step' => 1,
					'max'  => 50,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'border',
				'show_if_not'    => array(
					'type'      => 'none',
					'use_shape' => 'on',
				),
			),
		);

		$text_style = array(
			'text_padding'    => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Text padding adds extra space to the inside of the text, increasing the distance between the edge of the text', 'divitorque'),
				'type'           => 'custom_padding',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'text',
				'sub_toggle'     => 'general',
			),
			'text_background' => array(
				'label'          => esc_html__('Background', 'divitorque'),
				'description'    => esc_html__('Set the background color of divider text', 'divitorque'),
				'type'           => 'color-alpha',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'sub_toggle'     => 'general',
				'toggle_slug'    => 'text',
			),
			'text_radius'     => array(
				'label'          => esc_html__('Border Radius', 'divitorque'),
				'description'    => esc_html__('Here you can control the corner radius of the text. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'           => 'border-radius',
				'tab_slug'       => 'advanced',
				'mobile_options' => true,
				'toggle_slug'    => 'text',
				'sub_toggle'     => 'general',
				'default'        => 'off|0|0|0|0',
			),
		);

		return array_merge($content, $border, $text_style, $icon_img, $divider);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['borders']     = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['fonts']['title'] = array(
			'css'             => array(
				'main'      => '%%order_class%% .dtp-divider__text',
				'important' => 'all',
			),
			'header_level'    => array(
				'default' => 'h1',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'sub_toggle'      => 'typo',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '30px',
			),
		);

		$advanced_fields['borders']['icon'] = array(
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-divider__element i,%%order_class%% .dtp-divider__element img',
					'border_styles' => '%%order_class%% .dtp-divider__element i,%%order_class%% .dtp-divider__element img',
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

		return $advanced_fields;
	}

	public function render_title()
	{
		$title                 = $this->props['title'];
		$title_level           = $this->props['title_level'];
		$processed_title_level = et_pb_process_header_level($title_level, 'h2');
		$processed_title_level = esc_html($processed_title_level);

		if (!empty($title)) {
			return sprintf(
				'<%1$s class="dtp-divider__element dtp-divider__text"><span>%2$s</span></%1$s>',
				$processed_title_level,
				$title
			);
		}
	}

	public function render_icon()
	{
		$icon = $this->props['icon'];
		$icon = esc_attr(et_pb_process_font_icon($icon));

		// Inject Font Awesome Manually!.
		if (function_exists('dtp_inject_fa_icons')) {
			dtp_inject_fa_icons($this->props['icon']);
		}

		if (!empty($icon)) {
			return sprintf(
				'<div class="dtp-divider__icon dtp-divider__element">
                    <i class="dtp-icon dtp-et-icon">%1$s</i>
                </div>',
				$icon
			);
		}
	}

	public function render_uploaded_image()
	{
		$img_url = $this->props['img_url'];

		if (!empty($img_url)) {
			return sprintf(
				'
                <div class="dtp-divider__image dtp-divider__element">
                    <img src="%1$s" alt="" />
                </div>',
				$img_url
			);
		}
	}

	public function render_element()
	{
		$active_element = $this->props['active_element'];
		if ('text' === $active_element) {
			return $this->render_title();
		} elseif ('icon' === $active_element) {
			return $this->render_icon();
		} elseif ('image' === $active_element) {
			return $this->render_uploaded_image();
		}
	}

	public function render_left_border()
	{
		$use_shape = $this->props['use_shape'];
		if ('off' === $use_shape) {
			return '<div class="dtp-divider__border dtp-divider__border-start"></div>';
		}
	}

	public function render_right_border()
	{
		$use_shape = $this->props['use_shape'];
		if ('off' === $use_shape) {
			return '<div class="dtp-divider__border dtp-divider__border-end"></div>';
		}
	}

	public function render_shape()
	{
		include 'shapes.php';

		$use_shape = $this->props['use_shape'];
		$shape     = $this->props['shape'];

		if ('on' === $use_shape) {
			return '<div class="dtp-divider__shape">' . $shapes[$shape] . '</div>';
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_css($render_slug);

		wp_enqueue_style('torq-divider');

		return sprintf(
			'<div class="dtp-module dtp-divider">
                %1$s
                %2$s
                %3$s
                %4$s
            </div>',
			$this->render_left_border(),
			$this->render_element(),
			$this->render_right_border(),
			$this->render_shape()
		);
	}

	protected function render_css($render_slug)
	{
		$active_element                      = $this->props['active_element'];
		$content_alignment                   = $this->props['content_alignment'];
		$content_alignment_tablet            = $this->props['content_alignment_tablet'];
		$content_alignment_phone             = $this->props['content_alignment_phone'];
		$content_alignment_last_edited       = $this->props['content_alignment_last_edited'];
		$content_alignment_responsive_status = et_pb_get_responsive_status($content_alignment_last_edited);
		$border_gap                          = $this->props['border_gap'];
		$icon_color                          = $this->props['icon_color'];
		$icon_size                           = $this->props['icon_size'];
		$icon_bg                             = $this->props['icon_bg'];
		$img_width                           = $this->props['img_width'];
		$border_type                         = $this->props['border_type'];
		$border_style_classic                = $this->props['border_style_classic'];
		$border_style_pattern                = $this->props['border_style_pattern'];
		$border_height                       = $this->props['border_height'];
		$border_color                        = $this->props['border_color'];
		$border_weight                       = $this->props['border_weight'];
		$use_shape                           = $this->props['use_shape'];
		$shape_weight                        = $this->props['shape_weight'];
		$shape_color                         = $this->props['shape_color'];

		if ('off' === $use_shape) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider',
					'declaration' => 'align-items: center;',
				)
			);

			if ('left' === $content_alignment) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-divider__element',
						'declaration' => sprintf('padding-right: %1$s;', $border_gap),
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-divider__border-start',
						'declaration' => 'display: none;',
					)
				);
			} elseif ('right' === $content_alignment) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-divider__element',
						'declaration' => sprintf('padding-left: %1$s;', $border_gap),
					)
				);
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-divider__border-end',
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
						'declaration' => 'display: none;',
					)
				);
			} elseif ('center' === $content_alignment) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-divider__element',
						'declaration' => sprintf('padding-left: %1$s; padding-right: %1$s;', $border_gap),
					)
				);
			}

			if ($content_alignment_tablet && $content_alignment_responsive_status) {
				if ('left' === $content_alignment_tablet) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__element',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => sprintf('padding-right: %1$s;', $border_gap),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => 'display: block;',
						)
					);
				} elseif ('right' === $content_alignment_tablet) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__element',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => sprintf('padding-left: %1$s;', $border_gap),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => 'display: block;',
						)
					);
				} elseif ('center' === $content_alignment_tablet) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__element',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => sprintf('padding-left: %1$s; padding-right: %1$s;', $border_gap),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-start, %%order_class%% .dtp-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
							'declaration' => 'display: block;',
						)
					);
				}
			}

			if ($content_alignment_phone && $content_alignment_responsive_status) {
				if ('left' === $content_alignment_phone) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__element',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => sprintf('padding-right: %1$s;', $border_gap),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => 'display: block;',
						)
					);
				} elseif ('right' === $content_alignment_phone) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__element',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => sprintf('padding-left: %1$s;', $border_gap),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => 'display: none;',
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-start',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => 'display: block;',
						)
					);
				} elseif ('center' === $content_alignment_phone) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__element',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => sprintf('padding-left: %1$s; padding-right: %1$s;', $border_gap),
						)
					);
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border-start, %%order_class%% .dtp-divider__border-end',
							'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
							'declaration' => 'display: block;',
						)
					);
				}
			}

			// Border Offset.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider__border',
					'declaration' => sprintf(
						'margin-top: %1$s;',
						$this->props['border_offset']
					),
				)
			);

			// Border type.
			if ('none' !== $border_type) {
				if ('#' === $border_color[0]) {
					$border_color = $this->hex_to_rgb($border_color);
				}

				if ('classic' === $border_type) {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border',
							'declaration' => sprintf(
								'border-top: %1$s %2$s %3$s;',
								$border_weight,
								$border_style_classic,
								$border_color
							),
						)
					);
				} elseif ('pattern' === $border_type) {
					$pattern_bg = $this->get_pattern($border_style_pattern, $border_color, $border_weight);

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-divider__border',
							'declaration' => sprintf(
								'background-image: url("%1$s");
                            	height: %2$s;
                            	background-size: %2$s 100%%;',
								$pattern_bg,
								$border_height
							),
						)
					);
				}
			}
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider',
					'declaration' => 'flex-direction: column;',
				)
			);

			$this->get_responsive_styles(
				'content_alignment',
				'%%order_class%% .dtp-divider',
				array('primary' => 'align-items'),
				array('default' => 'center'),
				$render_slug
			);

			// shape margin.
			$this->get_responsive_styles(
				'shape_margin',
				'%%order_class%% .dtp-divider__shape',
				array('primary' => 'margin'),
				array('default' => '0px|0px|0px|0px'),
				$render_slug
			);

			// shape width.
			$this->get_responsive_styles(
				'shape_width',
				'%%order_class%% .dtp-divider__shape svg',
				array(
					'primary'   => 'width',
					'important' => true,
				),
				array('default' => '280px'),
				$render_slug
			);

			// shape weight & color.
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider__shape svg *',
					'declaration' => "stroke-width: {$shape_weight}!important;stroke: {$shape_color}!important;",
				)
			);
		}

		// Icon.
		if ('icon' === $active_element) {
			$this->generate_styles(
				array(
					'utility_arg'    => 'icon_font_family',
					'render_slug'    => $render_slug,
					'base_attr_name' => 'icon',
					'important'      => true,
					'selector'       => '%%order_class%% .dtp-divider__icon i',
					'processor'      => array(
						'ET_Builder_Module_Helper_Style_Processor',
						'process_extended_icon',
					),
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider__icon i',
					'declaration' => sprintf(
						'
                    font-size: %1$s;',
						$icon_size
					),
				)
			);

			$this->get_responsive_styles(
				'icon_padding',
				'%%order_class%% .dtp-divider__icon i',
				array('primary' => 'padding'),
				array('default' => '0px|0px|0px|0px'),
				$render_slug
			);

			if (!empty($icon_bg)) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-divider__icon i',
						'declaration' => sprintf(
							'background: %1$s;',
							$icon_bg
						),
					)
				);
			}

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider__icon i',
					'declaration' => sprintf(
						'color: %1$s;',
						$icon_color
					),
				)
			);
		}

		// image.
		if ('image' === $active_element) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-divider__element img',
					'declaration' => sprintf(
						'width: %1$s;',
						$img_width
					),
				)
			);
		}

		// Text Style.
		$this->get_responsive_styles(
			'text_padding',
			'%%order_class%% .dtp-divider__text span',
			array('primary' => 'padding'),
			array('default' => '0px|0px|0px|0px'),
			$render_slug
		);

		if (!empty($this->props['text_background'])) {
			$this->get_responsive_styles(
				'text_background',
				'%%order_class%% .dtp-divider__text span',
				array('primary' => 'background'),
				array('default' => 'transparent'),
				$render_slug
			);
		}

		$text_radius = explode('|', $this->props['text_radius']);
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-divider__text span',
				'declaration' => sprintf(
					'border-radius: %1$s %2$s %3$s %4$s;',
					$text_radius[1],
					$text_radius[2],
					$text_radius[3],
					$text_radius[4]
				),
			)
		);
	}
}

new DTP_Divider();
