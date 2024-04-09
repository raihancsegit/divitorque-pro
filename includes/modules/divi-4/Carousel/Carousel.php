<?php
class DTP_Carousel extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_carousel';
		$this->child_slug = 'torq_carousel_child';
		$this->name       = esc_html__('Torq Carousel', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'carousel.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
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
		return $this->get_carousel_option_fields(array(), array(), array());
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields = array();

		$advanced_fields['text']         = array();
		$advanced_fields['borders']      = array();
		$advanced_fields['text_shadow']  = array();
		$advanced_fields['link_options'] = array();
		$advanced_fields['fonts']        = array();

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		$content = $this->props['content'];
		if (empty($content)) {
			return '<div class="dtp-carousel dtp-carousel-frontend"><h3>No carousel item was added!</h3></div>';
		} else {
			wp_enqueue_script('torq-slick');
			wp_enqueue_style('torq-slick');
			wp_enqueue_style('torq-carousel');
			wp_enqueue_script('torq-carousel');
			$this->render_css($render_slug);

			$is_center        = $this->props['is_center'];
			$center_mode_type = $this->props['center_mode_type'];
			$classes          = array();

			if ('on' === $is_center) {
				array_push($classes, 'dtp-centered');
				array_push($classes, "dtp-centered--{$center_mode_type}");
			}

			$output = sprintf(
				'<div class="dtp-carousel dtp-carousel-frontend %3$s" %2$s >
						%1$s
					</div>',
				$content,
				$this->get_carousel_options_data(),
				join(' ', $classes)
			);

			return $output;
		}
	}

	public function render_css($render_slug)
	{
		$this->render_carousel_css($render_slug);
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Carousel Item', 'divitorque');
	}
}

new DTP_Carousel();
