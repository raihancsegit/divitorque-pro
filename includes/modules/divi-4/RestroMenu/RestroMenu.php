<?php

class DTP_Restro_Menu extends DTP_Builder_Module
{
	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_restro_menu';
		$this->child_slug = 'torq_restro_menu_child';
		$this->name       = esc_html__('Torq Restro Menu', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'menu.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'common'    => esc_html__('General', 'divitorque'),
					'image'     => esc_html__('Image', 'divitorque'),
					'separator' => esc_html__('Price Separator', 'divitorque'),
					'texts'     => array(
						'title'             => esc_html__('Texts', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'title'       => array(
								'name' => esc_html__('Title', 'divitorque'),
							),
							'price'       => array(
								'name' => esc_html__('Price', 'divitorque'),
							),
							'description' => array(
								'name' => esc_html__('Description', 'divitorque'),
							),
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'price'     => array(
				'label'    => esc_html__('Price', 'divitorque'),
				'selector' => '%%order_class%% .dtp-price-menu-price',
			),
			'title'     => array(
				'label'    => esc_html__('Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-price-menu-title',
			),
			'separator' => array(
				'label'    => esc_html__('Separator Line', 'divitorque'),
				'selector' => '%%order_class%% .dtp-price-menu-separator',
			),
			'desc'      => array(
				'label'    => esc_html__('Description', 'divitorque'),
				'selector' => '%%order_class%% .dtp-price-menu-desc',
			),
			'image'     => array(
				'label'    => esc_html__('Image', 'divitorque'),
				'selector' => '%%order_class%% .dtp-price-menu-image img',
			),
		);
	}

	public function get_fields()
	{
		$fields = array(
			'image_pos'            => array(
				'label'       => esc_html__('Image Position', 'divitorque'),
				'description' => esc_html__('Here you can define image position.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'left',
				'options'     => array(
					'right' => esc_html__('Right', 'divitorque'),
					'left'  => esc_html__('Left', 'divitorque'),
					'top'   => esc_html__('Top', 'divitorque'),
				),
			),
			'price_title_pos'      => array(
				'label'       => esc_html__('Price & Title Placement', 'divitorque'),
				'description' => esc_html__('Define price and title placement.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'inline',
				'options'     => array(
					'inline'      => esc_html__('Inline', 'divitorque'),
					'price_first' => esc_html__('Price First', 'divitorque'),
					'title_first' => esc_html__('Title First', 'divitorque'),
				),
			),
			'content_align_items'  => array(
				'label'       => esc_html__('Content Horizontal Alignment', 'divitorque'),
				'description' => esc_html__('Here you can define horizontal alignment fro the content.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'settings',
				'default'     => 'flex-start',
				'options'     => array(
					'flex-start' => esc_html__('Top', 'divitorque'),
					'center'     => esc_html__('Center', 'divitorque'),
					'flex-end'   => esc_html__('Bottom', 'divitorque'),
				),
				'show_if_not' => array(
					'image_pos' => 'top',
				),
			),
			// common.
			'content_alignment'    => array(
				'label'           => esc_html__('Item Content Alignment', 'divitorque'),
				'description'     => esc_html__('Align content to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'module_align',
				'default'         => 'left',
				'toggle_slug'     => 'common',
				'tab_slug'        => 'advanced',
			),
			'header_spacing'       => array(
				'label'          => esc_html__('Header Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Define custom spacing at bottom of the header.', 'divitorque'),
				'type'           => 'range',
				'default'        => '0px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
				'show_if'        => array(
					'price_title_pos' => 'inline',
				),
			),
			'item_spacing'         => array(
				'label'          => esc_html__('Item Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Define spacing between items.', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'    => 'common',
				'tab_slug'       => 'advanced',
			),
			'item_padding'         => array(
				'label'          => esc_html__('Item Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for each item. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'default'        => '0|0|0|0',
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'common',
			),
			// image.
			'image_size'           => array(
				'label'       => esc_html__('Image Size', 'divitorque'),
				'description' => esc_html__('Control the size of the image by increasing or decreasing the range.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'image',
				'tab_slug'    => 'advanced',
				'default'     => 'actual',
				'options'     => array(
					'actual'  => esc_html__('Actual Size', 'divitorque'),
					'cover'   => esc_html__('Cover', 'divitorque'),
					'contain' => esc_html__('Contain', 'divitorque'),
				),
			),
			'image_width'          => array(
				'label'          => esc_html__('Image Width', 'divitorque'),
				'description'    => esc_html__('Define custom image width.', 'divitorque'),
				'type'           => 'range',
				'default'        => '80px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),
			'image_height'         => array(
				'label'          => esc_html__('Image Height', 'divitorque'),
				'description'    => esc_html__('Define custom image height.', 'divitorque'),
				'type'           => 'range',
				'default'        => 'auto',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 400,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),
			'image_spacing'        => array(
				'label'          => esc_html__('Image Spacing', 'divitorque'),
				'description'    => esc_html__('Define custom image spacing gap.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'toggle_slug'    => 'image',
				'tab_slug'       => 'advanced',
			),
			// texts.
			'title_top_spacing'    => array(
				'label'          => esc_html__('Title Spacing Top', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the top of the title.', 'divitorque'),
				'type'           => 'range',
				'default'        => '0px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'texts',
				'sub_toggle'     => 'title',
				'show_if_not'    => array(
					'price_title_pos' => 'inline',
				),
			),
			'title_bottom_spacing' => array(
				'label'          => esc_html__('Title Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of the title.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'texts',
				'sub_toggle'     => 'title',
				'show_if_not'    => array(
					'price_title_pos' => 'inline',
				),
			),
			// separator.
			'separator_type'       => array(
				'label'       => esc_html__('Separator Type', 'divitorque'),
				'description' => esc_html__('Separators support various different styles, each of which will change the shape of the border element.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => 'solid_border',
				'options'     => array(
					'none_all'       => esc_html__('None', 'divitorque'),
					'solid_border'   => esc_html__('Solid', 'divitorque'),
					'double_border'  => esc_html__('Double', 'divitorque'),
					'dotted_border'  => esc_html__('Dotted', 'divitorque'),
					'dashed_border'  => esc_html__('Dashed', 'divitorque'),
					'curved_pattern' => esc_html__('Curved', 'divitorque'),
					'zigzag_pattern' => esc_html__('Zigzag', 'divitorque'),
				),
				'show_if'     => array(
					'price_title_pos' => 'inline',
				),
			),
			'separator_gap'        => array(
				'label'          => esc_html__('Separator Spacing', 'divitorque'),
				'description'    => esc_html__('Define custom spacing gap for the separator.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if'        => array(
					'price_title_pos' => 'inline',
				),
				'show_if_not'    => array(
					'separator_type' => 'none_all',
				),
			),
			'separator_color'      => array(
				'label'       => esc_html__('Separator Color', 'divitorque'),
				'description' => esc_html__('Choose your desired color for the separator.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'separator',
				'default'     => '#dddddd',
				'show_if'     => array(
					'price_title_pos' => 'inline',
				),
				'show_if_not' => array(
					'separator_type' => 'none_all',
				),
			),
			'separator_weight'     => array(
				'label'          => esc_html__('Separator Weight', 'divitorque'),
				'description'    => esc_html__('Increase or decrease the separator weight.', 'divitorque'),
				'type'           => 'range',
				'default'        => '1px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => .1,
					'max'  => 15,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if_not'    => array(
					'separator_type' => 'none_all',
				),
				'show_if'        => array(
					'price_title_pos' => 'inline',
				),
			),
			'separator_height'     => array(
				'label'          => esc_html__('Separator Height', 'divitorque'),
				'description'    => esc_html__('Increase or decrease the separator height.', 'divitorque'),
				'type'           => 'range',
				'default'        => '10px',
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'separator',
				'show_if_not'    => array(
					'separator_type' => 'none_all',
				),
				'show_if'        => array(
					'price_title_pos' => 'inline',
					'separator_type'  => array('curved_pattern', 'zigzag_pattern'),
					'description'     => esc_html__('.', 'divitorque'),
				),
			),
		);

		$item_bg = $this->custom_background_fields('item', 'Item', 'advanced', 'common', array('color', 'gradient', 'image'), array(), '');

		return array_merge($fields, $item_bg);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['box_shadow']['item'] = array(
			'label'       => esc_html__('Item Box Shadow', 'divitorque'),
			'css'         => array(
				'main' => '%%order_class%% .bapro_price_menu_child',
			),
			'toggle_slug' => 'common',
		);

		$advanced_fields['borders']['item'] = array(
			'label_prefix' => esc_html__('Item', 'divitorque'),
			'toggle_slug'  => 'common',
			'css'          => array(
				'main' => array(
					'border_radii'  => '%%order_class%% .bapro_price_menu_child',
					'border_styles' => '%%order_class%% .bapro_price_menu_child',
				),
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

		$advanced_fields['borders']['image'] = array(
			'label_prefix' => esc_html__('Image', 'divitorque'),
			'toggle_slug'  => 'image',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '%%order_class%% .dtp-price-menu-image',
					'border_styles' => '%%order_class%% .dtp-price-menu-image',
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

		$advanced_fields['fonts']['title'] = array(
			'label'           => esc_html__('Title', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-price-menu-title',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'title',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);
		$advanced_fields['fonts']['price'] = array(
			'label'           => esc_html__('Price', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-price-menu-price',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'price',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);
		$advanced_fields['fonts']['desc']  = array(
			'label'           => esc_html__('Description', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-price-menu-desc',
				'important' => 'all',
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'texts',
			'sub_toggle'      => 'description',
			'hide_text_align' => true,
			'line_height'     => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
			),
		);

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->render_css($render_slug);
		wp_enqueue_style('dtp-restro-menu');
		return sprintf(
			'<div class="dtp-module dtp-price-menu">
                %1$s
            </div>',
			$this->props['content']
		);
	}

	public function hexToRgb($hex)
	{
		$hex      = str_replace('#', '', $hex);
		$length   = strlen($hex);
		$rgb['r'] = hexdec(6 === $length ? substr($hex, 0, 2) : (3 === $length ? str_repeat(substr($hex, 0, 1), 2) : 0));
		$rgb['g'] = hexdec(6 === $length ? substr($hex, 2, 2) : (3 === $length ? str_repeat(substr($hex, 1, 1), 2) : 0));
		$rgb['b'] = hexdec(6 === $length ? substr($hex, 4, 2) : (3 === $length ? str_repeat(substr($hex, 2, 1), 2) : 0));

		return sprintf('rgba(%1$s,%2$s,%3$s,1)', $rgb['r'], $rgb['g'], $rgb['b']);
	}

	public function render_css($render_slug)
	{
		$price_title_pos     = $this->props['price_title_pos'];
		$image_pos           = $this->props['image_pos'];
		$content_alignment   = $this->props['content_alignment'];
		$type                = $this->props['separator_type'];
		$separator_height    = $this->props['separator_height'];
		$separator_color     = $this->props['separator_color'];
		$separator_gap       = $this->props['separator_gap'];
		$separator_weight    = $this->props['separator_weight'];
		$image_size          = $this->props['image_size'];
		$content_align_items = $this->props['content_align_items'];

		if ('left' === $image_pos) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-child',
					'declaration' => 'align-items:' . $content_align_items . '; display: flex;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-content',
					'declaration' => 'flex: 1 1;',
				)
			);

			$this->get_responsive_styles(
				'image_spacing',
				'%%order_class%% .dtp-price-menu-image',
				array(
					'primary'   => 'margin-right',
					'important' => false,
				),
				array('default' => '15px'),
				$render_slug
			);
		} elseif ('right' === $image_pos) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-child',
					'declaration' => 'align-items: center; display: flex;flex-direction: row-reverse;',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-content',
					'declaration' => 'flex: 1 1;',
				)
			);

			$this->get_responsive_styles(
				'image_spacing',
				'%%order_class%% .dtp-price-menu-image',
				array(
					'primary'   => 'margin-left',
					'important' => false,
				),
				array('default' => '15px'),
				$render_slug
			);
		} else {
			$this->get_responsive_styles(
				'image_spacing',
				'%%order_class%% .dtp-price-menu-image',
				array(
					'primary'   => 'margin-bottom',
					'important' => false,
				),
				array('default' => '15px'),
				$render_slug
			);
		}

		if ('inline' === $price_title_pos) {
			$this->get_responsive_styles(
				'header_spacing',
				'%%order_class%% .dtp-price-menu-header',
				array(
					'primary'   => 'margin-bottom',
					'important' => true,
				),
				array('default' => '0px'),
				$render_slug
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-header',
					'declaration' => '
                    display: flex;
                    flex-direction: row-reverse;
                    justify-content: space-between;
                    align-items: center;
                ',
				)
			);

			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-separator',
					'declaration' => sprintf(
						'flex: 1 1;
						margin-right: %1$s;
						margin-left: %1$s;',
						$separator_gap
					),
				)
			);

			if ($type !== 'none_all') {
				if ($separator_color[0] === '#') {
					$separator_color = $this->hexToRgb($separator_color);
				}

				$curved_pattern = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='" . $separator_color . "' stroke-width='" . $this->props['separator_weight'] . "' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpath d='M0,6c6,0,6,13,12,13S18,6,24,6'/%3E%3C/svg%3E";
				$zigzag_pattern = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='" . $separator_color . "' stroke-width='" . $this->props['separator_weight'] . "' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpolyline points='0,18 12,6 24,18 '/%3E%3C/svg%3E";
				$_type          = explode('_', $type);

				if ($_type[1] === 'border') {
					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-price-menu-separator',
							'declaration' => sprintf(
								'border-top: %1$s %2$s %3$s;',
								$separator_weight,
								$_type[0],
								$separator_color
							),
						)
					);
				} else {
					if ($_type[0] === 'curved') {
						$pattern_bg = $curved_pattern;
					} elseif ($_type[0] === 'zigzag') {
						$pattern_bg = $zigzag_pattern;
					}

					ET_Builder_Element::set_style(
						$render_slug,
						array(
							'selector'    => '%%order_class%% .dtp-price-menu-separator',
							'declaration' => sprintf(
								'
                            background-image: url("%1$s");
                            height: %2$s;
                            background-size: %2$s 100%%;',
								$pattern_bg,
								$separator_height
							),
						)
					);
				}
			}
		} elseif ('title_first' === $price_title_pos) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-content',
					'declaration' => 'display: flex;flex-direction: column-reverse;',
				)
			);
		}

		// Image.
		if ('actual' !== $image_size) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-price-menu-image img',
					'declaration' => 'object-fit:' . $image_size . ';',
				)
			);

			$this->get_responsive_styles(
				'image_height',
				'%%order_class%% .dtp-price-menu-image img',
				array(
					'primary'   => 'height',
					'important' => true,
				),
				array('default' => 'auto'),
				$render_slug
			);
		}

		$this->get_responsive_styles(
			'image_height',
			'%%order_class%% .dtp-price-menu-image',
			array(
				'primary'   => 'height',
				'important' => true,
			),
			array('default' => 'auto'),
			$render_slug
		);

		$this->get_responsive_styles(
			'image_width',
			'%%order_class%% .dtp-price-menu-image',
			array(
				'primary'   => 'width',
				'important' => true,
			),
			array('default' => '80px'),
			$render_slug
		);

		// Texts.
		if ('inline' !== $price_title_pos) {
			$this->get_responsive_styles(
				'title_bottom_spacing',
				'%%order_class%% .dtp-price-menu-title',
				array(
					'primary'   => 'padding-bottom',
					'important' => true,
				),
				array('default' => '10px'),
				$render_slug
			);

			$this->get_responsive_styles(
				'title_top_spacing',
				'%%order_class%% .dtp-price-menu-title',
				array(
					'primary'   => 'padding-top',
					'important' => true,
				),
				array('default' => '10px'),
				$render_slug
			);
		}

		// Common.
		$this->get_responsive_styles(
			'item_spacing',
			'%%order_class%% .bapro_price_menu_child',
			array(
				'primary'   => 'margin-bottom',
				'important' => true,
			),
			array('default' => '20px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'item_padding',
			'%%order_class%% .dtp-price-menu-child',
			array(
				'primary'   => 'padding',
				'important' => true,
			),
			array('default' => '0|0|0|0'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-price-menu-child',
				'declaration' => 'text-align:' . $content_alignment . ';',
			)
		);

		$this->get_custom_bg_style($render_slug, 'item', '%%order_class%% .bapro_price_menu_child', '%%order_class%% .bapro_price_menu_child:hover');
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Menu Item', 'divitorque');
	}
}

new DTP_Restro_Menu();
