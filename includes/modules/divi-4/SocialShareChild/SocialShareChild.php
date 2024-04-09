<?php

class DTP_Social_Share_Child extends DTP_Builder_Module
{
	public function init()
	{
		$this->vb_support               = 'on';
		$this->slug                     = 'torq_social_share_child';
		$this->type                     = 'child';
		$this->child_title_var          = 'admin_title';
		$this->child_title_fallback_var = 'network_type';
		$this->name                     = esc_html__('Sharing Item', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Share Content', 'divitorque'),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'icon'       => esc_html__('Icon', 'divitorque'),
					'text'       => esc_html__('Text', 'divitorque'),
					'border'     => esc_html__('Border', 'divitorque'),
					'box_shadow' => esc_html__('Box Shadow', 'divitorque'),
				),
			),
		);

		$this->custom_css_fields = array(
			'icon_wrap' => array(
				'label'    => esc_html__('Icon Wrapper', 'divitorque'),
				'selector' => '.dtp-social-share %%order_class%% .dtp-social-share-icon',
			),
			'icon'      => array(
				'label'    => esc_html__('Icon', 'divitorque'),
				'selector' => '.dtp-social-share %%order_class%% .dtp-social-share-icon-el svg',
			),
			'text'      => array(
				'label'    => esc_html__('Share Text', 'divitorque'),
				'selector' => '.dtp-social-share %%order_class%% .dtp-social-share-text',
			),
		);
	}

	public function get_fields()
	{
		$fields = array(
			'network_type' => array(
				'label'       => esc_html__('Network Type', 'divitorque'),
				'description' => esc_html__('Select social network type from the list.', 'divitorque'),
				'type'        => 'select',
				'toggle_slug' => 'content',
				'default'     => 'twitter',
				'options'     => array(
					'twitter'   => esc_html__('Twitter', 'divitorque'),
					'facebook'  => esc_html__('Facebook', 'divitorque'),
					'messenger' => esc_html__('Messenger', 'divitorque'),
					'pinterest' => esc_html__('Pinterest', 'divitorque'),
					'linkedin'  => esc_html__('LinkedIn', 'divitorque'),
					'whatsapp'  => esc_html__('WhatsApp', 'divitorque'),
					'viber'     => esc_html__('Viber', 'divitorque'),
					'tumblr'    => esc_html__('Tumblr', 'divitorque'),
					'reddit'    => esc_html__('Reddit', 'divitorque'),
					'email'     => esc_html__('Email', 'divitorque'),
					'vk'        => esc_html__('VK', 'divitorque'),
					'telegram'  => esc_html__('Telegram', 'divitorque'),
				),
			),
			'fb_app_id'    => array(
				'label'           => esc_html__('Facebook App ID', 'divitorque'),
				'description'     => esc_html__('Before you can implement any product of facebook APIs, you must first <a target="_blank" href="https://developers.facebook.com/docs/development/register">register</a> as a Facebook developer and use App Dashboard to provide information about your app. <a target="_blank" href="https://developers.facebook.com/docs/development/create-an-app">Create facebook app</a>', 'divitorque'),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
				'show_if'         => array(
					'network_type' => 'messenger',
				),
			),
			'share_text'   => array(
				'label'           => esc_html__('Share Text', 'divitorque'),
				'description'     => esc_html__('Define custom share text.', 'divitorque'),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'content',
			),
		);

		$icon = array(
			'arrow_color'  => array(
				'label'       => esc_html__('Arrow Color', 'divitorque'),
				'description' => esc_html__('Here you can define a custom color for your icon arrow.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
			),

			'icon_color'   => array(
				'label'       => esc_html__('Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the icon.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
			),

			'icon_size'    => array(
				'label'          => esc_html__('Size', 'divitorque'),
				'description'    => esc_html__('Here you can define custom size for the icon.', 'divitorque'),
				'type'           => 'range',
				'mobile_options' => true,
				'fixed_unit'     => 'px',
				'range_settings' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 200,
				),
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
				'hover'          => 'tabs',
			),

			'icon_bg'      => array(
				'label'       => esc_html__('Background Color', 'divitorque'),
				'description' => esc_html__('Pick a color to use for the icon background.', 'divitorque'),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'icon',
				'hover'       => 'tabs',
			),

			'icon_padding' => array(
				'label'          => esc_html__('Padding', 'divitorque'),
				'description'    => esc_html__('Define custom padding for the icon. Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'divitorque'),
				'type'           => 'custom_padding',
				'mobile_options' => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'icon',
			),
		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__('Admin Label', 'divitorque'),
				'type'        => 'text',
				'description' => esc_html__('This will change the label of the child module in the builder for easy identification.', 'divitorque'),
				'toggle_slug' => 'admin_label',
			),
		);

		return array_merge($fields, $label, $icon);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                 = array();
		$advanced_fields['text']         = array();
		$advanced_fields['text_shadow']  = array();
		$advanced_fields['fonts']        = array();
		$advanced_fields['link_options'] = array();
		$advanced_fields['max_width']    = array();
		$advanced_fields['width']        = array();
		$advanced_fields['height']       = array();
		$advanced_fields['margin']       = array();

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'margin'    => '%%order_class%% .dtp-social-share-btn-inner a',
				'padding'   => '%%order_class%% .dtp-social-share-btn-inner a',
				'important' => 'all',
			),
		);

		$advanced_fields['borders']['item'] = array(
			'toggle_slug' => 'border',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '.dtp-social-share %%order_class%% .dtp-social-share-btn-inner',
					'border_styles' => '.dtp-social-share %%order_class%% .dtp-social-share-btn-inner',
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

		$advanced_fields['borders']['icon'] = array(
			'label_prefix' => esc_html__('Icon', 'divitorque'),
			'toggle_slug'  => 'icon',
			'css'          => array(
				'main'      => array(
					'border_radii'  => '.dtp-social-share %%order_class%% .dtp-social-share-icon',
					'border_styles' => '.dtp-social-share %%order_class%% .dtp-social-share-icon',
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

		$advanced_fields['fonts']['share'] = array(
			'css'         => array(
				'main'      => '.dtp-social-share %%order_class%% .dtp-social-share-text',
				'important' => 'all',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'text',
			'line_height' => array(
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '.1',
				),
			),
		);

		$advanced_fields['box_shadow']['icon'] = array(
			'label'       => esc_html__('Icon Box Shadow', 'divitorque'),
			'toggle_slug' => 'icon',
			'css'         => array(
				'main'      => '.dtp-social-share %%order_class%% .dtp-social-share-icon',
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '.dtp-social-share %%order_class%% .dtp-social-share-btn-inner',
				'important' => 'all',
			),
		);

		$advanced_fields['background'] = array(
			'css' => array(
				'important' => 'all',
				'main'      => '.dtp-social-share %%order_class%% .dtp-social-share-btn .dtp-social-share-btn-inner',
			),
		);

		return $advanced_fields;
	}

	protected function get_share_template()
	{
		include 'network_icons.php';

		$post_id      = get_the_ID();
		$url          = get_permalink($post_id);
		$title        = get_the_title();
		$network_type = $this->props['network_type'];
		$share_text   = $this->props['share_text'];
		$href         = '';
		$icon         = '';
		$is_click     = true;

		if (empty($share_text)) {
			$share_text = ucwords($network_type, '') . ' Share';
		}

		$icon = isset($ba_social_network_icons[$network_type]) ? $ba_social_network_icons[$network_type] : '';

		if ('facebook' === $network_type) {
			$href = 'https://www.facebook.com/sharer.php?u=' . $url;
		} elseif ('twitter' === $network_type) {
			$href = sprintf(
				'https://twitter.com/share?text=%1$s&amp;url=%2$s',
				wp_strip_all_tags(rawurlencode($title)),
				rawurlencode(esc_url($url))
			);
		} elseif ('pinterest' === $network_type) {
			$href = sprintf(
				'https://www.pinterest.com/pin/create/button/?url=%1$s&amp;media=%2$s&amp;description=%3$s',
				rawurlencode(esc_url($url)),
				wp_get_attachment_url(get_post_thumbnail_id($post_id)),
				rawurlencode(wp_trim_words(strip_shortcodes(get_the_content($post_id)), 40))
			);
		} elseif ('linkedin' === $network_type) {
			$href = sprintf(
				'https://www.linkedin.com/shareArticle?mini=true&amp;url=%1$s&amp;title=%2$s&amp;summary=%3$s&amp;source=%4$s',
				rawurlencode(esc_url($url)),
				wp_strip_all_tags(rawurlencode($title)),
				rawurlencode(wp_trim_words(strip_shortcodes(get_the_content($post_id)), 40)),
				esc_url(home_url('/'))
			);
		} elseif ('whatsapp' === $network_type) {
			$href = sprintf(
				'https://api.whatsapp.com/send?text=%1$s %2$s',
				wp_strip_all_tags(rawurlencode($title)),
				rawurlencode(esc_url($url))
			);
		} elseif ('tumblr' === $network_type) {
			$href = sprintf(
				'https://www.tumblr.com/widgets/share/tool?canonicalUrl=%1$s',
				rawurlencode(esc_url($url))
			);
		} elseif ('reddit' === $network_type) {
			$href = sprintf(
				'https://www.reddit.com/submit?url==%1$s&amp;title=',
				rawurlencode(esc_url($url)),
				wp_strip_all_tags(rawurlencode($title))
			);
		} elseif ('email' === $network_type) {
			$is_click = false;
			$href     = sprintf(
				'mailto:?subject=%1$s&body=%2$s',
				wp_strip_all_tags(rawurlencode($title)),
				rawurlencode(esc_url($url))
			);
		} elseif ('viber' === $network_type) {
			$href = sprintf(
				'viber://forward?text=%1$s',
				rawurlencode(esc_url($url))
			);
		} elseif ('vk' === $network_type) {
			$href = sprintf(
				'https://vk.com/share.php?url=%1$s',
				rawurlencode(esc_url($url))
			);
		} elseif ('telegram' === $network_type) {
			$href = sprintf(
				'https://telegram.me/share/url?url=%1$s&text=%2$s',
				rawurlencode(esc_url($url)),
				wp_strip_all_tags(rawurlencode($title))
			);
		} elseif ('messenger' === $network_type) {
			$href = sprintf(
				'https://www.facebook.com/dialog/send?app_id=%1$s&display=popup&link=%2$s&redirect_uri=%2$s"',
				$this->props['fb_app_id'],
				get_the_permalink()
			);
		}

		return sprintf(
			'<a class="dtp-social-share-content type-%1$s" %5$s href="%3$s" >
					<div class="dtp-social-share-icon dtp-sharing-%1$s">
						<span class="dtp-social-share-shape">
							<svg
							x="0px"
							y="0px"
							viewBox="-750.9 248.7 208.9 404.3"
						>
							<g>
							<path d="M-750.9,653V248.7l202.1,202.2L-750.9,653z" />
							</g>
						</svg>
						</span>
						<span class="dtp-social-share-icon-el">%4$s</span>
					</div>
					<div class="dtp-social-share-text">
						<span class="dtp-social-share-text-inner">%2$s</span>
					</div>
			</a>',
			$network_type,
			$share_text,
			$href,
			$icon,
			$is_click ? 'onclick="onClickShare( this.href );return false;"' : ''
		);
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->apply_css($render_slug);
		return sprintf(
			'<div class="dtp-social-share-btn">
				<div class="dtp-social-share-btn-inner">
               		%1$s
            	</div>
            </div>',
			$this->get_share_template()
		);
	}

	public function apply_css($render_slug)
	{
		$network_type      = $this->props['network_type'];
		$icon_size         = $this->props['icon_size'];
		$icon_color        = $this->props['icon_color'];
		$arrow_color       = $this->props['arrow_color'];
		$arrow_color_hover = $this->get_hover_value('arrow_color');
		$icon_bg           = $this->props['icon_bg'];
		$icon_padding      = $this->props['icon_padding'];
		$background_color  = $this->props['background_color'];
		$icon_color_hover  = $this->get_hover_value('icon_color');
		$icon_size_hover   = $this->get_hover_value('icon_size');
		$icon_bg_hover     = $this->get_hover_value('icon_bg');

		$bgs = array(
			'twitter'   => '#00aced',
			'facebook'  => '#3b5998',
			'whatsapp'  => '#4AC959',
			'telegram'  => '#0088cc',
			'pinterest' => '#cb2027',
			'linkedin'  => '#007bb6',
			'reddit'    => '#FF5700',
			'viber'     => '#59267c',
			'email'     => '#333333',
			'tumblr'    => '#34526f',
			'vk'        => '#2787F5',
			'messenger' => '#0084ff',
		);

		// Clear Module Margin.
		if (empty($this->props['custom_margin'])) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%.et_pb_module',
					'declaration' => 'margin-bottom: 0!important;',
				)
			);
		}

		// Arrow Color.
		if (!empty($arrow_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-shape svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$arrow_color
					),
				)
			);
		}

		// Arrow Color Hover.
		if (!empty($arrow_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-btn:hover .dtp-social-share-shape svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$arrow_color_hover
					),
				)
			);
		}

		// Icon Color.
		if (!empty($icon_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$icon_color
					),
				)
			);
		}

		// Icon Color Hover.
		if (!empty($icon_color_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'fill: %1$s;',
						$icon_color_hover
					),
				)
			);
		}

		// Icon Size.
		if (!empty($icon_size)) {
			$this->get_responsive_styles(
				'icon_size',
				'.dtp-social-share %%order_class%% .dtp-social-share-icon-el svg',
				array('primary' => 'flex'),
				array('default' => '20px'),
				$render_slug
			);
			$this->get_responsive_styles(
				'icon_size',
				'.dtp-social-share %%order_class%% .dtp-social-share-icon-el svg',
				array('primary' => 'width'),
				array('default' => '20px'),
				$render_slug
			);
		}

		// Icon Size Hover.
		if (!empty($icon_size_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'width: %1$s;',
						$icon_size_hover
					),
				)
			);
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon-el svg',
					'declaration' => sprintf(
						'flex: 0 0 %1$s;',
						$icon_size_hover
					),
				)
			);
		}

		// Icon Background.
		if (!empty($icon_bg)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-icon',
					'declaration' => sprintf(
						'background: %1$s;',
						$icon_bg
					),
				)
			);
		}

		// Icon Background Hover.
		if (!empty($icon_bg_hover)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.dtp-social-share %%order_class%% .dtp-social-share-btn:hover .dtp-social-share-icon',
					'declaration' => sprintf(
						'background: %1$s;',
						$icon_bg_hover
					),
				)
			);
		}

		// Icon Padding.
		if (!empty($icon_padding)) {
			$this->get_responsive_styles(
				'icon_padding',
				'.dtp-social-share %%order_class%% .dtp-social-share-icon',
				array('primary' => 'padding'),
				array('default' => '0|0|0|0'),
				$render_slug
			);
		}

		// Button Dynamic Background Color.
		if (empty($background_color)) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dtp-social-share-btn-inner',
					'declaration' => sprintf(
						'background: %1$s',
						$bgs[$network_type]
					),
				)
			);
		}
	}
}

new DTP_Social_Share_Child();
