<?php

class DTP_Switch extends DTP_Builder_Module
{

	public function init()
	{
		$this->slug       = 'torq_content_toggle';
		$this->vb_support = 'on';
		$this->name       = esc_html__('Torq Content Toggle', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'content-toggle.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'primary'   => esc_html__('Primary', 'divitorque'),
					'secondary' => esc_html__('Secondary', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'switcher'          => esc_html__('Switcher', 'divitorque'),
					'switcher_title'    => array(
						'title'             => esc_html__('Switcher Title', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'primary'   => array(
								'name' => esc_html__('Primary Content', 'divitorque'),
							),
							'secondary' => array(
								'name' => esc_html__('Secondary Content', 'divitorque'),
							),
						),
					),
					'primary_content'   => esc_html__('Primary Content', 'divitorque'),
					'secondary_content' => esc_html__('Secondary Content', 'divitorque'),
					'header'            => array(
						'title'             => esc_html__('Heading Text', 'divitorque'),
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'h1' => array(
								'name' => 'H1',
								'icon' => 'text-h1',
							),
							'h2' => array(
								'name' => 'H2',
								'icon' => 'text-h2',
							),
							'h3' => array(
								'name' => 'H3',
								'icon' => 'text-h3',
							),
							'h4' => array(
								'name' => 'H4',
								'icon' => 'text-h4',
							),
							'h5' => array(
								'name' => 'H5',
								'icon' => 'text-h5',
							),
							'h6' => array(
								'name' => 'H6',
								'icon' => 'text-h6',
							),
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'primary_title'     => array(
				'label'    => esc_html__('Primary Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-toggle-head-1',
			),
			'secondary_title'   => array(
				'label'    => esc_html__('Secondary Title', 'divitorque'),
				'selector' => '%%order_class%% .dtp-toggle-head-2',
			),
			'primary_content'   => array(
				'label'    => esc_html__('Primary Content', 'divitorque'),
				'selector' => '%%order_class%% .dtp-content-toggle-front',
			),
			'secondary_content' => array(
				'label'    => esc_html__('Secondary Content', 'divitorque'),
				'selector' => '%%order_class%% .dtp-content-toggle-back',
			),
		);
	}

	protected function get_divi_library_options()
	{
		$layouts = array();

		$_layouts = get_posts(
			array(
				'post_type'      => 'et_pb_layout',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
			)
		);

		$layouts['-1'] = esc_html__('--Select a slide--', 'divitorque');

		if (!empty($_layouts)) {
			$layouts = wp_list_pluck($_layouts, 'post_title', 'ID');
		}

		return $layouts;
	}

	public static function get_primary_library_content($args)
	{
		$defaults = array();
		$args     = wp_parse_args($args, $defaults);

		$primary_id = $args['primary_library_id']; //phpcs:ignore

		ob_start();

		ET_Builder_Element::clean_internal_modules_styles();

		echo do_shortcode(sprintf('[et_pb_section global_module="%1$s"][/et_pb_section]', $primary_id));

		$internal_style = ET_Builder_Element::get_style();
		ET_Builder_Element::clean_internal_modules_styles(false);

		if ($internal_style) {
			printf(
				'<style type="text/css" class="bapro_content_toggle_styles-%2$s">
					%1$s
				</style>',
				et_core_esc_previously($internal_style),
				$primary_id
			);
		}

		$render_shortcode = ob_get_clean();

		return $render_shortcode;
	}

	public static function get_secondary_library_content($args = array())
	{
		$defaults = array();
		$args     = wp_parse_args($args, $defaults);

		ob_start();

		ET_Builder_Element::clean_internal_modules_styles();

		echo do_shortcode(sprintf('[et_pb_section global_module="%1$s"][/et_pb_section]', $args['secondary_library_id']));

		$internal_style = '';
		$internal_style = ET_Builder_Element::get_style();
		ET_Builder_Element::clean_internal_modules_styles(false);
		$modules_style = '';
		if ($internal_style) {
			$modules_style = sprintf(
				'<style type="text/css" class="bapro_content_toggle_styles-%2$s">
					%1$s
				</style>',
				et_core_esc_previously($internal_style),
				$args['secondary_library_id']
			);
		}

		echo $modules_style; //phpcs:ignore

		$render_shortcode = ob_get_clean();

		return $render_shortcode;
	}

	public function get_fields()
	{
		$fields = array(
			// Primary.
			'use_primary_title'        => array(
				'label'           => esc_html__('Use Title', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether primary title should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'primary',
			),
			'primary_title'            => array(
				'label'       => esc_html__('Heading', 'divitorque'),
				'description' => esc_html__('Define primary switcher title.', 'divitorque'),
				'type'        => 'text',
				'default'     => 'Primary',
				'toggle_slug' => 'primary',
				'show_if'     => array(
					'use_primary_title' => 'on',
				),
			),
			'primary_content_type'     => array(
				'label'            => esc_html__('Content Type', 'divitorque'),
				'description'      => esc_html__('Define primary content type.', 'divitorque'),
				'type'             => 'select',
				'default'          => 'content',
				'options'          => array(
					'content' => esc_html__('Custom Content', 'divitorque'),
					'library' => esc_html__('Library', 'divitorque'),
				),
				'toggle_slug'      => 'primary',
				'computed_affects' => array(
					'__library_primary',
				),
			),
			'primary_library_id'       => array(
				'label'            => __('Select Library', 'divitorque'),
				'description'      => esc_html__('Define divi library from the list.', 'divitorque'),
				'type'             => 'select',
				'default'          => '',
				'options'          => $this->get_divi_library_options(),
				'toggle_slug'      => 'primary',
				'computed_affects' => array(
					'__library_primary',
				),
				'show_if'          => array(
					'primary_content_type' => 'library',
				),
			),
			'custom_primary_content'   => array(
				'label'           => esc_html__('Content', 'divitorque'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__('Content entered here will appear inside the module as primary content.', 'divitorque'),
				'toggle_slug'     => 'primary',
				'default'         => __('Your Primary content goes here. Edit or remove this text inline or in the module Content settings.', 'divitorque'),
				'show_if'         => array(
					'primary_content_type' => 'content',
				),
			),
			// Secondary.
			'use_secondary_title'      => array(
				'label'           => esc_html__('Use Title', 'divitorque'),
				'description'     => esc_html__('Here you can choose whether secondary title should be used.', 'divitorque'),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__('Yes', 'divitorque'),
					'off' => esc_html__('No', 'divitorque'),
				),
				'default'         => 'on',
				'toggle_slug'     => 'secondary',
			),
			'secondary_title'          => array(
				'label'       => esc_html__('Heading', 'divitorque'),
				'description' => esc_html__('Define secondary switcher title.', 'divitorque'),
				'type'        => 'text',
				'default'     => 'Secondary',
				'toggle_slug' => 'secondary',
				'show_if'     => array(
					'use_secondary_title' => 'on',
				),
			),

			'secondary_content_type'   => array(
				'label'            => esc_html__('Content Type', 'divitorque'),
				'description'      => esc_html__('Define secondary content type.', 'divitorque'),
				'type'             => 'select',
				'default'          => 'content',
				'options'          => array(
					'content' => esc_html__('Custom Content', 'divitorque'),
					'library' => esc_html__('Library', 'divitorque'),
				),
				'computed_affects' => array(
					'__library_secondary',
				),
				'toggle_slug'      => 'secondary',
			),

			'secondary_library_id'     => array(
				'label'            => __('Select Library', 'divitorque'),
				'description'      => esc_html__('Define divi library from the list.', 'divitorque'),
				'type'             => 'select',
				'default'          => '',
				'options'          => $this->get_divi_library_options(),
				'computed_affects' => array(
					'__library_primary',
				),
				'toggle_slug'      => 'secondary',
				'show_if'          => array(
					'secondary_content_type' => 'library',
				),
			),

			'custom_secondary_content' => array(
				'label'           => esc_html__('Content', 'divitorque'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__('Content entered here will appear inside the module as secondary content.', 'divitorque'),
				'default'         => __('Your Secondary content goes here. Edit or remove this text inline or in the module Content settings.', 'divitorque'),
				'toggle_slug'     => 'secondary',
				'show_if'         => array(
					'secondary_content_type' => 'content',
				),
			),

			'__library_primary'        => array(
				'type'                => 'computed',
				'computed_callback'   => array('DTP_Switch', 'get_primary_library_content'),
				'computed_depends_on' => array(
					'primary_library_id',
					'primary_content_type',
				),
			),

			'__library_secondary'      => array(
				'type'                => 'computed',
				'computed_callback'   => array('DTP_Switch', 'get_secondary_library_content'),
				'computed_depends_on' => array(
					'secondary_library_id',
					'secondary_content_type',
				),
			),
		);

		$switcher = array(
			'default_display'       => array(
				'label'       => esc_html__('Default Display', 'divitorque'),
				'description' => esc_html__('Choose which content you want to display first.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'switcher',
				'default'     => 'primary',
				'options'     => array(
					'primary'   => esc_html__('Primary Content', 'divitorque'),
					'secondary' => esc_html__('Secondary Content', 'divitorque'),
				),
			),
			'switcher_style'        => array(
				'label'       => esc_html__('Switcher Style', 'divitorque'),
				'description' => esc_html__('Here you can define different switcher style.', 'divitorque'),
				'type'        => 'select',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'switcher',
				'default'     => 'style_1',
				'options'     => array(
					'style_1' => esc_html__('Style 1', 'divitorque'),
					'style_2' => esc_html__('Style 2', 'divitorque'),
				),
			),
			'switcher_alignment'    => array(
				'label'            => esc_html__('Alignment', 'divitorque'),
				'description'      => esc_html__('Align switcher to the left, right or center.', 'divitorque'),
				'type'             => 'text_align',
				'option_category'  => 'layout',
				'options'          => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'     => 'module_align',
				'default_on_front' => 'center',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'switcher',
			),
			'switcher_size'         => array(
				'label'          => esc_html__('Size', 'divitorque'),
				'description'    => esc_html__('Here you can set custom switcher size.', 'divitorque'),
				'type'           => 'range',
				'default'        => '15px',
				'mobile_options' => true,
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'switcher',
			),
			'heading_spacing'       => array(
				'label'          => esc_html__('Heading Spacing', 'divitorque'),
				'description'    => esc_html__('Define spacing between switcher button and text.', 'divitorque'),
				'type'           => 'range',
				'default'        => '25px',
				'default_unit'   => 'px',
				'mobile_options' => true,
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'switcher',
				'tab_slug'       => 'advanced',
			),
			'bottom_spacing'        => array(
				'label'          => esc_html__('Bottom Spacing', 'divitorque'),
				'description'    => esc_html__('Here you can define a custom spacing at the bottom of the switcher.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'default'        => '25px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 300,
				),
				'toggle_slug'    => 'switcher',
				'tab_slug'       => 'advanced',
			),
			'switcher_bg_primary'   => array(
				'label'       => esc_html__('Primary Background', 'divitorque'),
				'description' => esc_html__('Define switcher primary background color.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#d3d3d3',
				'toggle_slug' => 'switcher',
			),
			'switcher_bg_secondary' => array(
				'label'       => esc_html__('Secondary Background', 'divitorque'),
				'description' => esc_html__('Define switcher active background color.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#2ecc71',
				'toggle_slug' => 'switcher',
			),
			'switcher_radius'       => array(
				'label'       => esc_html__('Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the switcher. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'default'     => 'off|1.5em|1.5em|1.5em|1.5em',
				'toggle_slug' => 'switcher',
			),
			'trigger_bg'            => array(
				'label'       => esc_html__('Trigger Background', 'divitorque'),
				'description' => esc_html__('Define switcher trigger background color.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#efefef',
				'toggle_slug' => 'switcher',
			),
			'trigger_radius'        => array(
				'label'       => esc_html__('Trigger Border Radius', 'divitorque'),
				'description' => esc_html__('Here you can control the corner radius of the switcher trigger. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'        => 'border-radius',
				'tab_slug'    => 'advanced',
				'default'     => 'off|50%|50%|50%|50%',
				'toggle_slug' => 'switcher',
			),
		);

		$content = array(
			'primary_text_alignment'    => array(
				'label'           => esc_html__('Text Alignment', 'divitorque'),
				'description'     => esc_html__('Align text to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'text_align',
				'default'         => 'center',
				'mobile_options'  => true,
				'toggle_slug'     => 'primary_content',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'primary_content_type' => 'content',
				),
			),
			'primary_content_bg'        => array(
				'label'       => esc_html__('Background', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the primary content background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#ffffff',
				'toggle_slug' => 'primary_content',
			),
			'primary_content_radius'    => array(
				'label'          => esc_html__('Rounded Corner ', 'divitorque'),
				'description'    => esc_html__('Here you can control the corner radius of the primary content. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'           => 'range',
				'default'        => '4px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'primary_content',
				'tab_slug'       => 'advanced',
			),
			'primary_content_padding'   => array(
				'label'          => __('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the primary content. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'default'        => '20px|20px|20px|20px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'primary_content',
				'mobile_options' => true,
			),
			'secondary_text_alignment'  => array(
				'label'           => esc_html__('Text Alignment', 'divitorque'),
				'description'     => esc_html__('Align text to the left, right or center.', 'divitorque'),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options(array('justified')),
				'options_icon'    => 'text_align',
				'default'         => 'center',
				'mobile_options'  => true,
				'toggle_slug'     => 'secondary_content',
				'tab_slug'        => 'advanced',
				'show_if'         => array(
					'secondary_content_type' => 'content',
				),
			),
			'secondary_content_bg'      => array(
				'label'       => esc_html__('Background', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the secondary content background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'default'     => '#ffffff',
				'toggle_slug' => 'secondary_content',
			),
			'secondary_content_radius'  => array(
				'label'          => esc_html__('Rounded Corner ', 'divitorque'),
				'description'    => esc_html__('Here you can control the corner radius of the secondary content. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'divitorque'),
				'type'           => 'range',
				'default'        => '4px',
				'default_unit'   => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'toggle_slug'    => 'secondary_content',
				'tab_slug'       => 'advanced',
			),
			'secondary_content_padding' => array(
				'label'          => __('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the secondary content. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'default'        => '20px|20px|20px|20px',
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'secondary_content',
				'mobile_options' => true,
			),
		);
		return array_merge($fields, $switcher, $content);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields = array();

		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['fonts'] = array(
			'primary_title'   => array(
				'label'           => esc_html__('Primary', 'divitorque'),
				'css'             => array(
					'main'      => '%%order_class%% .dtp-toggle-head-1',
					'important' => 'all',
				),
				'hide_text_align' => true,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'switcher_title',
				'sub_toggle'      => 'primary',
				'line_height'     => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
				),
			),
			'secondary_title' => array(
				'label'           => esc_html__('Secondary', 'divitorque'),
				'css'             => array(
					'main'      => '%%order_class%% .dtp-toggle-head-2',
					'important' => 'all',
				),
				'hide_text_align' => true,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'switcher_title',
				'sub_toggle'      => 'secondary',
				'line_height'     => array(
					'range_settings' => array(
						'min'  => '1',
						'max'  => '3',
						'step' => '.1',
					),
				),
			),
			'body'            => array(
				'label'          => esc_html__('Body', 'divitorque'),
				'css'            => array(
					'line_height' => '%%order_class%% .dtp-entry-content p',
					'text_align'  => '%%order_class%% .dtp-entry-content',
					'text_shadow' => '%%order_class%% .dtp-entry-content',
					'important'   => 'all',
				),
				'block_elements' => array(
					'tabbed_subtoggles' => true,
					'css'               => array(
						'main'      => '%%order_class%% .dtp-entry-content',
						'important' => 'all',
					),
				),
			),
			'header'          => array(
				'label'       => esc_html__('Heading', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-entry-content h1',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => absint(et_get_option('body_header_size', '30')) . 'px',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h1',
			),
			'header_2'        => array(
				'label'       => esc_html__('Heading 2', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-entry-content h2',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '26px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h2',
			),
			'header_3'        => array(
				'label'       => esc_html__('Heading 3', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-entry-content h3',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '22px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h3',
			),
			'header_4'        => array(
				'label'       => esc_html__('Heading 4', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-entry-content h4',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '18px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h4',
			),
			'header_5'        => array(
				'label'       => esc_html__('Heading 5', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-entry-content h5',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '16px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h5',
			),
			'header_6'        => array(
				'label'       => esc_html__('Heading 6', 'divitorque'),
				'css'         => array(
					'main'      => '%%order_class%% .dtp-entry-content h6',
					'important' => 'all',
				),
				'font_size'   => array(
					'default' => '14px',
				),
				'line_height' => array(
					'default' => '1em',
				),
				'toggle_slug' => 'header',
				'sub_toggle'  => 'h6',
			),
		);

		$advanced_fields['box_shadow']['trigger'] = array(
			'label'       => esc_html__('Trigger Box Shadow', 'divitorque'),
			'toggle_slug' => 'switcher',
			'css'         => array(
				'main'      => '%%order_class%% .dtp-content-toggle-inner:before',
				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	protected function render_primary_content()
	{
		$primary_content_type   = $this->props['primary_content_type'];
		$primary_library_id     = $this->props['primary_library_id'];
		$custom_primary_content = $this->props['custom_primary_content'];
		$args                   = array('primary_library_id' => $primary_library_id);

		if ('content' === $primary_content_type) {
			return sprintf(
				'
                <div class="dtp-content-toggle-front dtp-entry-content">
                    %1$s
                </div>',
				$custom_primary_content
			);
		} else {
			return sprintf(
				'
                <div class="dtp-content-toggle-front">
                    %1$s
                </div>',
				$this->get_primary_library_content($args)
			);
		}
	}

	protected function render_secondary_content()
	{
		$secondary_content_type   = $this->props['secondary_content_type'];
		$secondary_library_id     = $this->props['secondary_library_id'];
		$custom_secondary_content = $this->props['custom_secondary_content'];
		$args                     = array('secondary_library_id' => $secondary_library_id);

		if ('content' === $secondary_content_type) {
			return sprintf(
				'<div class="dtp-content-toggle-back dtp-entry-content" style="display: none">
                    %1$s
                </div>',
				$custom_secondary_content
			);
		} else {
			return sprintf(
				'<div class="dtp-content-toggle-back" style="display: none">
                    %1$s
                </div>',
				$this->get_secondary_library_content($args)
			);
		}
	}

	public function render_primary_title($order_number)
	{
		$use_primary_title = $this->props['use_primary_title'];
		$primary_title     = $this->props['primary_title'];

		if ('on' === $use_primary_title) {
			return sprintf(
				'<h5 class="dtp-toggle-head-1">
					<label for="dtp-input-%1$s">%2$s</label>
				  </h5>',
				$order_number,
				$primary_title
			);
		}
	}

	public function render_secondary_title($order_number)
	{
		$use_secondary_title = $this->props['use_secondary_title'];
		$secondary_title     = $this->props['secondary_title'];

		if ('on' === $use_secondary_title) {
			return sprintf(
				'<h5 class="dtp-toggle-head-2">
					<label for="dtp-input-%1$s">%2$s</label>
				  </h5>',
				$order_number,
				$secondary_title
			);
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		wp_enqueue_style('torq-content-toggle');
		wp_enqueue_script('torq-content-toggle');
		$this->render_css($render_slug);
		$default_display = $this->props['default_display'];
		$order_class     = self::get_module_order_class($render_slug);
		$order_number    = str_replace('_', '', str_replace($this->slug, '', $order_class));

		return sprintf(
			'<div class="dtp-content-toggle">
                <div class="dtp-content-toggle-header">
                    <div class="dtp-toggle">
                        <div class="dtp-toggle-left">
                            %6$s
                        </div>
                        <div class="dtp-toggle-btn">
                            <label class="dtp-content-toggle-label" for="dtp-input-%5$s">
                                <input id="dtp-input-%5$s" %8$s class="dtp-content-toggle-input dtp-input dtp-toggle-switch" type="checkbox" />
                                <span class="dtp-content-toggle-inner"></span>
                            </label>
                        </div>
                        <div class="dtp-toggle-right">
							%7$s
                        </div>
                    </div>
                </div>

                <div class="dtp-content-toggle-body">
                    %3$s %4$s
                </div>
            </div>',
			$this->props['primary_title'],
			$this->props['secondary_title'],
			$this->render_primary_content(),
			$this->render_secondary_content(),
			$order_number,
			$this->render_primary_title($order_number),
			$this->render_secondary_title($order_number),
			'primary' !== $default_display ? 'checked' : ''
		);
	}

	public function render_css($render_slug)
	{
		$switcher_style           = $this->props['switcher_style'];
		$switcher_bg_primary      = $this->props['switcher_bg_primary'];
		$switcher_alignment       = $this->props['switcher_alignment'];
		$primary_content_bg       = $this->props['primary_content_bg'];
		$secondary_content_bg     = $this->props['secondary_content_bg'];
		$trigger_bg               = $this->props['trigger_bg'];
		$primary_content_radius   = $this->props['primary_content_radius'];
		$secondary_content_radius = $this->props['secondary_content_radius'];
		$trigger_radius           = explode('|', $this->props['trigger_radius']);
		$switcher_radius          = explode('|', $this->props['switcher_radius']);
		$switcher_bg_secondary    = $this->props['switcher_bg_secondary'];

		// Switcher.
		if ('style_1' === $switcher_style) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-content-toggle-label',
					'declaration' => 'height:2.3em;',
				)
			);
		} elseif ('style_2' === $switcher_style) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-content-toggle-label',
					'declaration' => 'height:1em;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-content-toggle-inner:before',
					'declaration' => 'bottom: -.35em!important;left:-.1em!important;',
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-toggle-switch:checked+.dtp-content-toggle-inner:before',
					'declaration' => 'transform: translateX(2.9em);',
				)
			);
		}

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-content-toggle-inner',
				'declaration' => sprintf(
					'background-color: %1$s;',
					$switcher_bg_primary
				),
			)
		);
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-toggle-switch:checked+.dtp-content-toggle-inner',
				'declaration' => sprintf(
					'background-color: %1$s;',
					$switcher_bg_secondary
				),
			)
		);

		// Size.
		$this->get_responsive_styles(
			'switcher_size',
			'%%order_class%% .dtp-toggle-btn',
			array(
				'primary'   => 'font-size',
				'important' => false,
			),
			array('default' => '15px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-content-toggle-inner:before',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-top-left-radius: %2$s;
					border-top-right-radius: %3$s;
					border-bottom-right-radius: %4$s;
					border-bottom-left-radius: %5$s;',
					$trigger_bg,
					$trigger_radius[1],
					$trigger_radius[2],
					$trigger_radius[3],
					$trigger_radius[4]
				),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-content-toggle-inner',
				'declaration' => sprintf(
					'border-top-left-radius: %1$s;
					border-top-right-radius: %2$s;
					border-bottom-right-radius: %3$s;
					border-bottom-left-radius: %4$s;',
					$switcher_radius[1],
					$switcher_radius[2],
					$switcher_radius[3],
					$switcher_radius[4]
				),
			)
		);

		// Switcher Alignment.
		if ('right' === $switcher_alignment) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-toggle',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ('center' === $switcher_alignment) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-toggle',
					'declaration' => 'justify-content: center;',
				)
			);
		} else {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-toggle',
					'declaration' => 'justify-content: flex-start;',
				)
			);
		}

		// Heading Spacing.
		$this->get_responsive_styles(
			'heading_spacing',
			'%%order_class%% .dtp-toggle .dtp-toggle-left',
			array(
				'primary'   => 'margin-right',
				'important' => false,
			),
			array('default' => '25px'),
			$render_slug
		);
		$this->get_responsive_styles(
			'heading_spacing',
			'%%order_class%% .dtp-toggle .dtp-toggle-right',
			array(
				'primary'   => 'margin-left',
				'important' => false,
			),
			array('default' => '25px'),
			$render_slug
		);

		// Bottom Spacing.
		$this->get_responsive_styles(
			'bottom_spacing',
			'%%order_class%% .dtp-content-toggle-header',
			array(
				'primary'   => 'margin-bottom',
				'important' => false,
			),
			array('default' => '25px'),
			$render_slug
		);

		/**
		 * Content
		 */
		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-content-toggle-front',
				'declaration' => sprintf(
					'background: %1$s;
					border-radius: %2$s;',
					$primary_content_bg,
					$primary_content_radius
				),
			)
		);
		$this->get_responsive_styles(
			'primary_content_padding',
			'%%order_class%% .dtp-content-toggle-front',
			array(
				'primary'   => 'padding',
				'important' => false,
			),
			array('default' => '20px|20px|20px|20px'),
			$render_slug
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-content-toggle-back',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-radius: %2$s;',
					$secondary_content_bg,
					$secondary_content_radius
				),
			)
		);

		$this->get_responsive_styles(
			'secondary_content_padding',
			'%%order_class%% .dtp-content-toggle-back',
			array(
				'primary'   => 'padding',
				'important' => false,
			),
			array('default' => '20px|20px|20px|20px'),
			$render_slug
		);

		// Text alignment.
		if ('content' === $this->props['primary_content_type']) {
			$this->get_responsive_styles(
				'primary_text_alignment',
				'%%order_class%% .dtp-content-toggle-front',
				array(
					'primary'   => 'text-align',
					'important' => false,
				),
				array('default' => 'center'),
				$render_slug
			);
		}

		if ('content' === $this->props['secondary_content_type']) {
			$this->get_responsive_styles(
				'secondary_text_alignment',
				'%%order_class%% .dtp-content-toggle-back',
				array(
					'primary'   => 'text-align',
					'important' => false,
				),
				array('default' => 'center'),
				$render_slug
			);
		}
	}
}

new DTP_Switch();
