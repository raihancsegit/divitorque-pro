<?php

class DTP_Torq_Progress_Bar extends DTP_Builder_Module
{
	public $slug       = 'torq_progress_bar';
	public $vb_support = 'on';
	public $child_slug = 'torq_progress_bar_child';

	public function init()
	{
		$this->name      = esc_html__('Torq Progress Bar', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'progressbar.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'bar'   => esc_html__('Progess Bar', 'divitorque'),
					'name'  => esc_html__('Name Text', 'divitorque'),
					'level' => esc_html__('Level Text', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'name_text'  => array(
				'label'    => esc_html__('Name Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-progress-bar__name',
			),
			'level_text' => array(
				'label'    => esc_html__('Level Text', 'divitorque'),
				'selector' => '%%order_class%% .dtp-progress-bar__level',
			),
			'level'      => array(
				'label'    => esc_html__('Level', 'divitorque'),
				'selector' => '%%order_class%% .dtp-progress-bar__inner',
			),
			'bar'        => array(
				'label'    => esc_html__('Bar', 'divitorque'),
				'selector' => '%%order_class%% .dtp-progress-bar__wrapper',
			),
		);
	}

	public function get_fields()
	{
		$fields = array(
			'bar_spacing_bottom'   => array(
				'label'          => esc_html__('Bar Spacing Bottom', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of the bar item.', 'divitorque'),
				'type'           => 'range',
				'default'        => '20px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'margin_padding',
				'mobile_options' => true,
			),

			'name_spacing'         => array(
				'label'          => esc_html__('Name Spacing', 'divitorque'),
				'description'    => esc_html__('Define name spacing from the edge.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'name',
			),

			'level_spacing'        => array(
				'label'          => esc_html__('Level Spacing', 'divitorque'),
				'description'    => esc_html__('Define level spacing from the edge.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'level',
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

		$advanced_fields['fonts']['name'] = array(
			'label'           => esc_html__('Name', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-progress-bar__name',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'name',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		$advanced_fields['fonts']['level'] = array(
			'label'           => esc_html__('Level', 'divitorque'),
			'css'             => array(
				'main'      => '%%order_class%% .dtp-progress-bar__level',
				'important' => 'all',
			),
			'hide_text_align' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'level',
			'line_height'     => array(
				'default' => '1em',
			),
			'font_size'       => array(
				'default' => '14px',
			),
		);

		return $advanced_fields;
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_style('torq-progress-bar');

		$this->get_responsive_styles(
			'name_spacing',
			'%%order_class%% .dtp-progress-bar__name',
			array('primary' => 'margin-left'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'level_spacing',
			'%%order_class%% .dtp-progress-bar__level',
			array('primary' => 'margin-right'),
			array('default' => '15px'),
			$render_slug
		);

		$this->get_responsive_styles(
			'bar_spacing_bottom',
			'%%order_class%% .torq_progress_bar_child',
			array(
				'primary'   => 'margin-bottom',
				'important' => true,
			),
			array('default' => '20px'),
			$render_slug
		);

		return sprintf('<div class="dtp-module dtp-parent dtp-progress">%1$s</div>', $this->props['content']);
	}

	public function add_new_child_text()
	{
		return esc_html__('Add Progress Item', 'divitorque');
	}
}

new DTP_Torq_Progress_Bar();
