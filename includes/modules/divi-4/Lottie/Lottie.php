<?php
class DTP_Lottie extends DTP_Builder_Module
{

	public function init()
	{
		$this->vb_support = 'on';
		$this->slug       = 'torq_lottie';
		$this->name       = esc_html__('Torq Lottie', 'divitorque');
		$this->icon_path  = plugin_dir_path(__FILE__) . 'lottie.svg';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'  => esc_html__('Lottie', 'divitorque'),
					'settings' => esc_html__('Settings', 'divitorque'),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'lottie'  => esc_html__('Lottie', 'divitorque'),
					'caption' => esc_html__('Caption', 'divitorque'),
				),
			),
		);
	}

	public function get_fields()
	{
		$fields = array();

		$fields['source'] = array(
			'label'       => __('Source', 'divitorque'),
			'description' => __('Define JSON Source.', 'divitorque'),
			'type'        => 'select',
			'options'     => array(
				'media_file'   => __('Media File', 'divitorque'),
				'external_url' => __('External URL', 'divitorque'),
			),
			'default'     => 'media_file',
			'toggle_slug' => 'content',
		);

		$fields['source_external_url'] = array(
			'label'       => __('External URL', 'divitorque'),
			'description' => __('Type external URL of the JSON file for the animation.', 'divitorque'),
			'type'        => 'text',
			'show_if'     => array(
				'source' => 'external_url',
			),
			'toggle_slug' => 'content',
		);

		$fields['source_json'] = array(
			'label'              => __('Upload JSON File', 'divitorque'),
			'description'        => __('Upload lottie supported JSON file for the animation', 'divitorque'),
			'type'               => 'upload',
			'data_type'          => 'json',
			'upload_button_text' => esc_attr__('Upload JSON File', 'divitorque'),
			'choose_text'        => esc_attr__('Upload JSON File', 'divitorque'),
			'update_text'        => esc_attr__('Set As JSON', 'divitorque'),
			'toggle_slug'        => 'content',
			'show_if'            => array(
				'source' => 'media_file',
			),
		);

		$fields['caption_source'] = array(
			'label'       => __('Caption', 'divitorque'),
			'description' => esc_html__('Here you can define caption type.', 'divitorque'),
			'type'        => 'select',
			'default'     => 'none',
			'options'     => array(
				'none'   => __('None', 'divitorque'),
				'custom' => __('Custom', 'divitorque'),
			),
			'show_if'     => array(
				'source' => 'media_file',
			),
			'toggle_slug' => 'content',
		);

		$fields['custom_caption'] = array(
			'label'       => __('Custom Caption', 'divitorque'),
			'description' => esc_html__('Here you can define custom caption text.', 'divitorque'),
			'type'        => 'text',
			'default'     => 'Caption',
			'show_if'     => array(
				'source'         => 'media_file',
				'caption_source' => 'custom',
			),
			'toggle_slug' => 'content',
		);

		// Settings.
		$fields['trigger'] = array(
			'label'       => __('Trigger', 'divitorque'),
			'description' => esc_html__('Define animation trigger event.', 'divitorque'),
			'type'        => 'select',
			'default'     => 'none',
			'options'     => array(
				'none'     => __('None', 'divitorque'),
				'viewport' => __('Viewport', 'divitorque'),
				'on_click' => __('On Click', 'divitorque'),
				'on_hover' => __('On Hover', 'divitorque'),
			),
			'toggle_slug' => 'settings',
		);

		$fields['loop'] = array(
			'label'       => __('Loop', 'divitorque'),
			'description' => esc_html__('Choose whether the endless of times an animation should be played or not.', 'divitorque'),
			'type'        => 'yes_no_button',
			'default'     => 'on',
			'options'     => array(
				'on'  => esc_html__('Yes', 'divitorque'),
				'off' => esc_html__('No', 'divitorque'),
			),
			'toggle_slug' => 'settings',
		);

		$fields['play_speed'] = array(
			'label'          => esc_html__('Play Speed', 'divitorque') . ' (x)',
			'description'    => esc_html__('Define animation play speed.', 'divitorque'),
			'type'           => 'range',
			'default_unit'   => 'px',
			'default'        => 1,
			'unitless'       => true,
			'range_settings' => array(
				'min'  => 0.1,
				'max'  => 5,
				'step' => 0.1,
			),
			'toggle_slug'    => 'settings',
		);

		$fields['renderer'] = array(
			'label'       => __('Renderer', 'divitorque'),
			'description' => esc_html__('Define renderer element from the list.', 'divitorque'),
			'type'        => 'select',
			'default'     => 'svg',
			'options'     => array(
				'svg'    => __('SVG', 'divitorque'),
				'canvas' => __('Canvas', 'divitorque'),
			),
			'toggle_slug' => 'settings',
		);

		$fields['alignment'] = array(
			'label'          => esc_html__('Alignment', 'divitorque'),
			'description'    => esc_html__('Align lottie element to the left, right or center.', 'divitorque'),
			'type'           => 'text_align',
			'options'        => et_builder_get_text_orientation_options(array('justified')),
			'options_icon'   => 'module_align',
			'default'        => 'center',
			'mobile_options' => true,
			'toggle_slug'    => 'lottie',
			'tab_slug'       => 'advanced',
		);

		$fields['lottie_width'] = array(
			'label'            => esc_html__('Width', 'divitorque'),
			'description'      => esc_html__('If you would like to set a custom static width, you can do so using this option.', 'divitorque'),
			'type'             => 'range',
			'mobile_options'   => true,
			'validate_unit'    => true,
			'allowed_units'    => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
			'default'          => '100%',
			'default_unit'     => '%',
			'default_on_front' => '',
			'allow_empty'      => true,
			'range_settings'   => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'responsive'       => true,
			'sticky'           => true,
			'toggle_slug'      => 'lottie',
			'tab_slug'         => 'advanced',
		);

		$fields['lottie_width_max'] = array(
			'label'            => esc_html__('Max Width', 'divitorque'),
			'description'      => esc_html__('Setting a maximum width will prevent your element from ever surpassing the defined width value. Maximum width can be used in combination with the standard width setting. Maximum width supersedes the normal width value.', 'divitorque'),
			'type'             => 'range',
			'mobile_options'   => true,
			'validate_unit'    => true,
			'allowed_units'    => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
			'default'          => '100%',
			'default_unit'     => '%',
			'default_on_front' => '',
			'allow_empty'      => true,
			'range_settings'   => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'responsive'       => true,
			'sticky'           => true,
			'toggle_slug'      => 'lottie',
			'tab_slug'         => 'advanced',
		);

		$fields['lottie_opacity'] = array(
			'label'          => esc_html__('Opacity', 'divitorque'),
			'description'    => esc_html__('Define the opacity for the element. Set the value from 0 - 1. The lower value, the more transparent.', 'divitorque'),
			'type'           => 'range',
			'default_unit'   => 'px',
			'default'        => '1',
			'range_settings' => array(
				'max'  => 1,
				'min'  => 0.10,
				'step' => 0.01,
			),
			'toggle_slug'    => 'lottie',
			'tab_slug'       => 'advanced',
			'hover'          => 'tabs',
		);

		return $fields;
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['fonts']['caption'] = array(
			'label'       => esc_html__('Caption', 'divitorque'),
			'css'         => array(
				'main' => '%%order_class%% .dtp-lottie-caption',
			),
			'important'   => 'all',
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'caption',
		);

		return $advanced_fields;
	}

	private function get_caption($settings)
	{
		$is_media_file_caption   = $this->is_media_file_caption($settings);
		$is_external_url_caption = $this->is_external_url_caption($settings);

		if (($is_media_file_caption && 'custom' === $settings['caption_source']) || $is_external_url_caption) {
			return $settings['custom_caption'];
		}

		return '';
	}

	private function is_media_file_caption($settings)
	{
		return 'media_file' === $settings['source'] && 'none' !== $settings['caption_source'];
	}

	private function is_external_url_caption($settings)
	{
		return 'external_url' === $settings['source'] && '' !== $settings['custom_caption'];
	}

	private function get_lottie_path($settings)
	{
		$lottie_path = '';

		if ('external_url' === $settings['source']) {
			$lottie_path = $settings['source_external_url'];
		} elseif ('media_file' === $settings['source']) {
			$lottie_path = $settings['source_json'];
		}

		return $lottie_path;
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->apply_css($render_slug);
		wp_enqueue_script('torq-lottie-web');
		wp_enqueue_script('torq-lottie');
		wp_enqueue_style('torq-lottie');

		$order_class = self::get_module_order_class($render_slug);
		$module_id   = str_replace('_', '', str_replace($this->slug, '', $order_class));

		// Options.
		$options               = array();
		$source                = $this->props['source'];
		$options['path']       = esc_attr($this->get_lottie_path($this->props));
		$options['loop']       = esc_attr($this->props['loop']);
		$options['renderer']   = esc_attr($this->props['renderer']);
		$options['trigger']    = esc_attr($this->props['trigger']);
		$options['play_speed'] = esc_attr($this->props['play_speed']);
		$options['id']         = esc_attr((int) $module_id);

		$lottie_js = sprintf(
			'data-settings=%1$s',
			htmlspecialchars(wp_json_encode($options), ENT_QUOTES, 'UTF-8')
		);

		// Caption.
		$caption        = $this->get_caption($this->props);
		$module_caption = $caption ? '<p class="dtp-lottie-caption"> ' . $caption . '</p>' : '';

		return sprintf(
			'<div class="dtp-lottie-wrap">
				<div class="dtp-lottie-container">
					<div id="dtp-lottie-js-%3$s" class="dtp-lottie-animation dtp-lottie-js" %1$s></div>
					%2$s
				</div>
			</div>',
			$lottie_js,
			'media_file' === $source ? $module_caption : '',
			$module_id
		);
	}

	protected function apply_css($render_slug)
	{
		$this->get_responsive_styles(
			'lottie_width',
			'%%order_class%% .dtp-lottie-container',
			array('primary' => 'width'),
			array('default' => '100%'),
			$render_slug
		);

		$this->get_responsive_styles(
			'lottie_width_max',
			'%%order_class%% .dtp-lottie-container',
			array('primary' => 'max-width'),
			array('default' => '100%'),
			$render_slug
		);

		$alignment        = $this->props['alignment'];
		$alignment_tablet = $this->props['alignment_tablet'];
		$alignment_phone  = $this->props['alignment_phone'];

		if ('right' === $alignment) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ('center' === $alignment) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'declaration' => 'justify-content: center;',
				)
			);
		} elseif ('left' === $alignment) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'declaration' => 'justify-content: flex-start;',
				)
			);
		}

		if ('right' === $alignment_tablet) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ('center' === $alignment_tablet) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => 'justify-content: center;',
				)
			);
		} elseif ('left' === $alignment_tablet) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
					'declaration' => 'justify-content: flex-start;',
				)
			);
		}

		if ('right' === $alignment_phone) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => 'justify-content: flex-end;',
				)
			);
		} elseif ('center' === $alignment_phone) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => 'justify-content: center;',
				)
			);
		} elseif ('left' === $alignment_phone) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap',
					'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
					'declaration' => 'justify-content: flex-start;',
				)
			);
		}

		// Opacity.
		$opacity       = $this->props['lottie_opacity'];
		$opacity_hover = isset($this->props['lottie_opacity__hover']) ? $this->props['lottie_opacity__hover'] : $opacity;

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .dtp-lottie-wrap',
				'declaration' => "opacity: $opacity",
			)
		);

		if ($opacity_hover) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-lottie-wrap:hover',
					'declaration' => "opacity: $opacity_hover",
				)
			);
		}
	}
}

new DTP_Lottie();
