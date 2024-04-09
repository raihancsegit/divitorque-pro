<?php
class DTP_Logo_Carousel extends DTP_Builder_Module
{
	public function init()
	{
		$this->name       = esc_html__('Torq Logo Carousel', 'divitorque');
		$this->slug       = 'torq_logo_carousel';
		$this->vb_support = 'on';
		$this->child_slug = 'torq_logo_carousel_child';
		$this->icon_path  = plugin_dir_path(__FILE__) . 'logo-carousel.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'logo_settings'     => esc_html__('Logo Settings', 'divitorque'),
					'carousel_settings' => array(
						'title'             => esc_html__('Carousel', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'general'  => array(
								'name' => esc_html__('General', 'divitorque'),
							),
							'advanced' => array(
								'name' => esc_html__('Advanced', 'divitorque'),
							),
						),
					),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'nav'  => esc_html__('Arrows', 'divitorque'),
					'pagi' => array(
						'title'             => esc_html__('Pagination', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'pagi_common' => array(
								'name' => esc_html__('Common', 'divitorque'),
							),
							'pagi_active' => array(
								'name' => esc_html__('Active', 'divitorque'),
							),
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'logo'      => array(
				'label'    => esc_html__('Logo', 'divitorque'),
				'selector' => '%%order_class%% .ba_logo_carousel_child img',
			),
			'nav_prev'  => array(
				'label'    => esc_html__('Prev (Navigation)', 'divitorque'),
				'selector' => '%%order_class%% .slick-arrow.slick-prev',
			),
			'nav_next'  => array(
				'label'    => esc_html__('Next (Navigation)', 'divitorque'),
				'selector' => '%%order_class%% .slick-arrow.slick-next',
			),
			'pagi_dots' => array(
				'label'    => esc_html__('Pagination Wrapper', 'divitorque'),
				'selector' => '%%order_class%% .slick-dots',
			),
			'pagi_item' => array(
				'label'    => esc_html__('Pagination Item', 'divitorque'),
				'selector' => '%%order_class%% .slick-dots li',
			),
			'pagi_dot'  => array(
				'label'    => esc_html__('Pagination Dot', 'divitorque'),
				'selector' => '%%order_class%% .slick-dots button',
			),
		);
	}

	public function get_fields()
	{
		$carousel_options = $this->get_carousel_option_fields(array(), array(), array());

		$logo_options = array(

			'logo_height' => array(
				'label'           => esc_html__('Height', 'divitorque'),
				'description'     => esc_html__('Define custom logo height.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => 'auto',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'step' => 1,
					'min'  => 1,
					'max'  => 1000,
				),
				'toggle_slug'     => 'logo_settings',
				'mobile_options'  => true,
			),

			'logo_width'  => array(
				'label'           => esc_html__('Width', 'divitorque'),
				'description'     => esc_html__('Define custom logo width.', 'divitorque'),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => 'auto',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'step' => 1,
					'min'  => 1,
					'max'  => 1000,
				),
				'toggle_slug'     => 'logo_settings',
				'mobile_options'  => true,
			),

			'logo_hover'  => array(
				'label'       => esc_html__('Hover Animation', 'divitorque'),
				'description' => esc_html__('Select hover animation for the logo.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'logo_settings',
				'default'     => 'zoom_in',
				'options'     => array(
					'no_hover'      => esc_html__('None', 'divitorque'),
					'zoom_in'       => esc_html__('Zoom In', 'divitorque'),
					'zoom_out'      => esc_html__('Zoom Out', 'divitorque'),
					'fade'          => esc_html__('Fade', 'divitorque'),
					'black_n_white' => esc_html__('Black and White', 'divitorque'),
				),
			),
		);

		return array_merge($carousel_options, $logo_options);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['borders']     = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		if (empty($this->props['content'])) {
			return '<div class="dtp-carousel dtp-logo-carousel dtp-carousel-frontend"><h3>No carousel item was added!</h3></div>';
		} else {
			wp_enqueue_script('torq-slick');
			wp_enqueue_style('torq-slick');
			wp_enqueue_style('torq-logo-carousel');
			wp_enqueue_script('torq-logo-carousel');
			$this->render_css($render_slug);

			$content          = $this->props['content'];
			$logo_hover       = $this->props['logo_hover'];
			$is_center        = $this->props['is_center'];
			$center_mode_type = $this->props['center_mode_type'];
			$classes          = array();

			array_push($classes, $logo_hover);

			if ('on' === $is_center) {
				array_push($classes, 'dtp-centered');
				array_push($classes, "dtp-centered--{$center_mode_type}");
			}

			$output = sprintf(
				'<div class = "dtp-carousel dtp-logo-carousel dtp-carousel-frontend %3$s" %2$s >
                %1$s
            </div>',
				$content,
				$this->get_carousel_options_data(),
				join(' ', $classes)
			);

			return $output;
		}
	}

	public function render_logo_css($render_slug)
	{
		$logo_height                   = $this->props['logo_height'];
		$logo_height_tablet            = $this->props['logo_height_tablet'];
		$logo_height_phone             = $this->props['logo_height_phone'];
		$logo_height_last_edited       = $this->props['logo_height_last_edited'];
		$logo_height_responsive_status = et_pb_get_responsive_status($logo_height_last_edited);

		$logo_width                   = $this->props['logo_width'];
		$logo_width_tablet            = $this->props['logo_width_tablet'];
		$logo_width_phone             = $this->props['logo_width_phone'];
		$logo_width_last_edited       = $this->props['logo_width_last_edited'];
		$logo_width_responsive_status = et_pb_get_responsive_status($logo_width_last_edited);

		if ($logo_height !== 'auto') {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-logo-carousel-item',
					'declaration' => sprintf('height: %1$s;display: flex; justify-content: center; align-items: center;', $logo_height),
				)
			);

			if ($logo_height_tablet && $logo_height_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-logo-carousel-item',
						'declaration' => sprintf('height: %1$s;display: flex; justify-content: center; align-items: center; ', $logo_height_tablet),
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					)
				);
			}

			if ($logo_height_phone && $logo_height_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-logo-carousel-item',
						'declaration' => sprintf('height: %1$s; display: flex; justify-content: center; align-items: center;`', $logo_height_phone),
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					)
				);
			}
		}

		if ('auto' !== $logo_width) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-logo-carousel-item img',
					'declaration' => sprintf('width: %1$s;', $logo_width),
				)
			);

			if ($logo_width_tablet && $logo_width_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-logo-carousel-item img',
						'declaration' => sprintf('width: %1$s;', $logo_width_tablet),
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					)
				);
			}

			if ($logo_width_phone && $logo_width_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .dtp-logo-carousel-item img',
						'declaration' => sprintf('width: %1$s;`', $logo_width_phone),
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					)
				);
			}
		}
	}

	public function render_css($render_slug)
	{
		$this->render_carousel_css($render_slug);
		$this->render_logo_css($render_slug);
	}

	public function add_new_child_text()
	{
		return esc_html__('Add New Logo', 'divitorque');
	}
}

new DTP_Logo_Carousel();
