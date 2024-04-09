<?php
class DTP_Restro_Menu_Child extends DTP_Builder_Module
{
	public function init()
	{
		$this->slug                     = 'torq_restro_menu_child';
		$this->vb_support               = 'on';
		$this->type                     = 'child';
		$this->child_title_var          = 'admin_title';
		$this->child_title_fallback_var = 'title';
		$this->name                     = esc_html__('Item', 'divitorque');

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content' => esc_html__('Content', 'divitorque'),
				),
			),

			'advanced' => array(
				'toggles' => array(
					'advanced' => array(
						'toggles' => array(
							'borders'    => esc_html__('Border', 'divitorque'),
							'box_shadow' => esc_html__('Box Shadow', 'divitorque'),
						),
					),
				),
			),
		);
	}

	public function get_fields()
	{
		$fields = array(

			'price'       => array(
				'label'           => esc_html__('Price', 'divitorque'),
				'description'     => esc_html__('Here you can define the price text with currency symbol.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'title'       => array(
				'label'           => esc_html__('Title', 'divitorque'),
				'description'     => esc_html__('Here you can define the title text.', 'divitorque'),
				'type'            => 'text',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'description' => array(
				'label'           => esc_html__('Description', 'divitorque'),
				'description'     => esc_html__('Here you can define the description text.', 'divitorque'),
				'type'            => 'textarea',
				'toggle_slug'     => 'content',
				'dynamic_content' => 'text',
			),

			'image'       => array(
				'label'              => esc_html__('Upload an Image', 'divitorque'),
				'description'        => esc_html__('Upload an image or type in the URL of the image you would like to display.', 'divitorque'),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__('Upload an Image', 'divitorque'),
				'choose_text'        => esc_attr__('Choose an Image', 'divitorque'),
				'update_text'        => esc_attr__('Set As Image', 'divitorque'),
				'toggle_slug'        => 'content',
			),

			'image_alt'   => array(
				'label'       => esc_html__('Image Alt Text', 'divitorque'),
				'description' => esc_html__('Here you can define the HTML ALT text for your image.', 'divitorque'),
				'type'        => 'text',
				'toggle_slug' => 'content',
			),
		);

		$label = array(
			'admin_title' => array(
				'label'       => esc_html__('Admin Label', 'divitorque'),
				'type'        => 'text',
				'description' => esc_html__('This will change the label of the item', 'divitorque'),
				'toggle_slug' => 'admin_label',
			),
		);

		return array_merge($label, $fields);
	}

	public function get_advanced_fields_config()
	{
		$advanced_fields                = array();
		$advanced_fields['text']        = array();
		$advanced_fields['borders']     = array();
		$advanced_fields['text_shadow'] = array();
		$advanced_fields['fonts']       = array();

		$advanced_fields['borders']['main'] = array(
			'toggle_slug' => 'borders',
			'css'         => array(
				'main'      => array(
					'border_radii'  => '.bapro_price_menu .dtp-price-menu.dtp-module %%order_class%%',
					'border_styles' => '.bapro_price_menu .dtp-price-menu.dtp-module %%order_class%%',
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

		$advanced_fields['background'] = array(
			'css' => array(
				'main'      => '.bapro_price_menu .dtp-price-menu.dtp-module %%order_class%%',
				'important' => 'all',
			),
		);

		$advanced_fields['margin_padding'] = array(
			'css' => array(
				'main'      => '.bapro_price_menu .dtp-price-menu.dtp-module %%order_class%%',
				'important' => 'all',
			),
		);

		$advanced_fields['box_shadow']['main'] = array(
			'label'       => esc_html__('Box Shadow', 'divitorque'),
			'toggle_slug' => 'box_shadow',
			'css'         => array(
				'main'      => '.bapro_price_menu .dtp-price-menu.dtp-module %%order_class%%',
				'important' => 'all',
			),
		);

		return $advanced_fields;
	}

	protected function _render_price()
	{
		$price = $this->props['price'];
		if (!empty($price)) {
			return sprintf(
				'<div class="dtp-price-menu-price">
                    %1$s
                </div>',
				$price
			);
		}
	}

	public function _render_title()
	{
		$title_text = $this->props['title'];
		if (!empty($title_text)) {
			return sprintf(
				'<h4 class="dtp-price-menu-title">%1$s<h4>',
				$title_text
			);
		}
	}

	public function _render_description()
	{
		$description = $this->props['description'];
		if (!empty($description)) {
			return sprintf(
				'<div class="dtp-price-menu-desc">%1$s</div>',
				$description
			);
		}
	}

	protected function _render_image()
	{
		$image     = $this->props['image'];
		$image_alt = $this->props['image_alt'];
		if (!empty($image)) {
			return sprintf(
				'<div class="dtp-price-menu-image">
                    <img src="%1$s" alt="%2$s" />
                </div>',
				$image,
				$image_alt
			);
		}
	}

	public function render($attrs, $content, $render_slug)
	{
		$this->remove_classname('et_pb_module');
		$this->add_classname('ba_et_pb_module');

		return sprintf(
			'<div class="dtp-module dtp-module-pro dtp-price-menu-child">
                %1$s
                <div class="dtp-price-menu-content">
                    <div class="dtp-price-menu-header">
                        %2$s
                        <div class="dtp-price-menu-separator"></div>
                        %3$s
                    </div>
                    %4$s
                </div>
            </div>',
			$this->_render_image(),
			$this->_render_price(),
			$this->_render_title(),
			$this->_render_description()
		);
	}
}

new DTP_Restro_Menu_Child();
