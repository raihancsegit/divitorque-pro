<?php
class DTP_Logo_List extends DTP_Builder_Module
{
	public $slug       = 'torq_logo_list';
	public $vb_support = 'on';
	public $child_slug = 'torq_logo_list_child';

	public function init()
	{
		$this->name      = esc_html__('Torq Logo List', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'logo-list.svg';

		$this->settings_modal_toggles = array(
			'general' => array(
				'toggles' => array(
					'grid' => esc_html__('Settings', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'logo' => array(
				'label'    => esc_html__('Logo', 'divitorque'),
				'selector' => '%%order_class%% .dtp-logo-list__item img',
			),
		);
	}

	public function get_fields()
	{
		$fields = array(
			'column_count'  => array(
				'label'          => esc_html__('Columns', 'divitorque'),
				'description'    => esc_html__('Here you can define grid columns number.', 'divitorque'),
				'type'           => 'select',
				'default'        => '4',
				'options'        => array(
					'1'  => esc_html__('1', 'divitorque'),
					'2'  => esc_html__('2', 'divitorque'),
					'3'  => esc_html__('3', 'divitorque'),
					'4'  => esc_html__('4', 'divitorque'),
					'5'  => esc_html__('5', 'divitorque'),
					'6'  => esc_html__('6', 'divitorque'),
					'7'  => esc_html__('7', 'divitorque'),
					'8'  => esc_html__('8', 'divitorque'),
					'9'  => esc_html__('9', 'divitorque'),
					'10' => esc_html__('10', 'divitorque'),
				),
				'toggle_slug'    => 'grid',
				'mobile_options' => true,
			),

			'grid_height'   => array(
				'label'          => esc_html__('Columns Height', 'divitorque'),
				'description'    => esc_html__('Here you can define grid column height.', 'divitorque'),
				'type'           => 'range',
				'toggle_slug'    => 'grid',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 800,
					'step' => 1,
				),
			),

			'grid_gap'      => array(
				'label'          => esc_html__('Columns Gap', 'divitorque'),
				'description'    => esc_html__('Here you can define the spacing between grid columns.', 'divitorque'),
				'type'           => 'range',
				'toggle_slug'    => 'grid',
				'default'        => '5px',
				'allowed_units'  => array('px', '%', 'em'),
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),

			'logo_size'     => array(
				'label'          => esc_html__('Logo Size', 'divitorque'),
				'description'    => esc_html__('Here you can define static logo width.', 'divitorque'),
				'type'           => 'range',
				'toggle_slug'    => 'grid',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'max'  => 1000,
					'step' => 1,
				),
			),

			'image_hover'   => array(
				'label'       => esc_html__('Hover Animation', 'divitorque'),
				'description' => esc_html__('Select logo hover animation.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'grid',
				'default'     => 'zoom_in',
				'options'     => array(
					'no_hover'      => esc_html__('None', 'divitorque'),
					'zoom_in'       => esc_html__('Zoom In', 'divitorque'),
					'zoom_out'      => esc_html__('Zoom Out', 'divitorque'),
					'fade'          => esc_html__('Fade Out', 'divitorque'),
					'black_n_white' => esc_html__('Black and White', 'divitorque'),
				),
			),

			'logo_overflow' => array(
				'label'       => esc_html__('Logo Overflow', 'divitorque'),
				'description' => esc_html__('Here you can control logo image overflow on the X and Y axis. If set to hidden, logo will be clipped.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'grid',
				'default'     => 'visible',
				'options'     => array(
					'hidden'  => esc_html__('Hidden', 'divitorque'),
					'visible' => esc_html__('Visible', 'divitorque'),
				),
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

	public function render($attrs, $content, $render_slug)
	{
		if (empty($this->props['content'])) {
			return '<div class="dtp-module dtp-parent dtp-logo-list"><h3>No logo was added!</h3></div>';
		} else {
			$this->render_css($render_slug);
			wp_enqueue_style('torq-logo-list');
			return sprintf(
				'<div class="dtp-module dtp-parent dtp-logo-list %2$s">
					%1$s
				</div>',
				$this->props['content'],
				$this->props['image_hover']
			);
		}
	}

	protected function render_css($render_slug)
	{
		$grid_height                   = $this->props['grid_height'];
		$grid_height_tablet            = $this->props['grid_height_tablet'];
		$grid_height_phone             = $this->props['grid_height_phone'];
		$grid_height_last_edited       = $this->props['grid_height_last_edited'];
		$grid_height_responsive_status = et_pb_get_responsive_status($grid_height_last_edited);
		$logo_size                     = $this->props['logo_size'];
		$logo_size_tablet              = $this->props['logo_size_tablet'];
		$logo_size_phone               = $this->props['logo_size_phone'];
		$logo_size_last_edited         = $this->props['logo_size_last_edited'];
		$logo_size_responsive_status   = et_pb_get_responsive_status($logo_size_last_edited);
		$grid_gap                      = $this->props['grid_gap'];
		$grid_gap_tablet               = $this->props['grid_gap_tablet'];
		$grid_gap_phone                = $this->props['grid_gap_phone'];
		$grid_gap_last_edited          = $this->props['grid_gap_last_edited'];
		$grid_gap_responsive_status    = et_pb_get_responsive_status($grid_gap_last_edited);
		$column_count                  = $this->props['column_count'];
		$column_count_tablet           = $this->props['column_count_tablet'];
		$column_count_phone            = $this->props['column_count_phone'];
		$logo_overflow                 = $this->props['logo_overflow'];

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-logo-list__item',
				'declaration' => sprintf('overflow: %1$s;', $logo_overflow),
			)
		);

		if (!empty($grid_height)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .torq_logo_list_child',
					'declaration' => sprintf('height: %1$s;', $grid_height),
				)
			);

			if (!empty($grid_height_tablet) && $grid_height_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_logo_list_child',
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
						'declaration' => sprintf('height: %1$s;', $grid_height_tablet),
					)
				);
			}

			if (!empty($grid_height_phone) && $grid_height_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '%%order_class%% .torq_logo_list_child',
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
						'declaration' => sprintf('height: %1$s;', $grid_height_phone),
					)
				);
			}
		}

		if (!empty($logo_size)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-logo-list__item img',
					'declaration' => sprintf('width: %1$s;', $logo_size),
				)
			);

			if (!empty($logo_size_tablet) && $logo_size_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.dtp-logo-list__item img',
						'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
						'declaration' => sprintf('width: %1$s;', $logo_size_tablet),
					)
				);
			}

			if (!empty($logo_size_phone) && $logo_size_responsive_status) {
				ET_Builder_Element::set_style(
					$render_slug,
					array(
						'selector'    => '.dtp-logo-list__item img',
						'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
						'declaration' => sprintf('width: %1$s;', $logo_size_phone),
					)
				);
			}
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-logo-list__item img',
					'declaration' => 'width: 100%;',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-logo-list',
				'declaration' => sprintf('margin: -%1$s;', $grid_gap),
			)
		);

		if (!empty($grid_gap_tablet) && $grid_gap_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-logo-list',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => sprintf('margin: -%1$s;', $grid_gap_tablet),
				)
			);
		}

		if (!empty($grid_gap_phone) && $grid_gap_responsive_status) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-logo-list',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => sprintf('margin: -%1$s;', $grid_gap_phone),
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .torq_logo_list_child',
				'declaration' => sprintf('flex: 0 0 calc(100%%/%1$s);padding:%2$s;', $column_count, $grid_gap),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .torq_logo_list_child',
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
				'declaration' => sprintf('flex: 0 0 calc(100%%/%1$s);padding:%2$s;', $column_count_tablet, $grid_gap_tablet),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .torq_logo_list_child',
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
				'declaration' => sprintf('flex: 0 0 calc(100%%/%1$s);padding:%2$s;', $column_count_phone, $grid_gap_phone),
			)
		);
	}

	public function add_new_child_text()
	{
		return esc_html__('Add New Logo', 'divitorque');
	}
}

new DTP_Logo_List();
