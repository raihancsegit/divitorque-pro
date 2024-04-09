<?php
defined('ABSPATH') || die();

function dtp_get_svg_user_icon()
{
	return '<svg viewBox="84.8 395.9 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
        <path d="m109.4 420c3.3 0 6.1-1.2 8.4-3.5s3.5-5.1 3.5-8.4-1.2-6.1-3.5-8.4-5.1-3.5-8.4-3.5-6.1 1.2-8.4 3.5-3.5 5.1-3.5 8.4 1.2 6.1 3.5 8.4 5.2 3.5 8.4 3.5zm-6.3-18.3c1.8-1.8 3.9-2.6 6.4-2.6s4.6 0.9 6.4 2.6c1.8 1.8 2.6 3.9 2.6 6.4s-0.9 4.6-2.6 6.4c-1.8 1.8-3.9 2.6-6.4 2.6s-4.6-0.9-6.4-2.6c-1.8-1.8-2.6-3.9-2.6-6.4-0.1-2.5 0.8-4.6 2.6-6.4z"/><path d="m130.3 434.2c-0.1-1-0.2-2-0.4-3.1s-0.5-2.2-0.8-3.1c-0.3-1-0.8-2-1.3-2.9-0.6-1-1.2-1.8-1.9-2.5-0.8-0.7-1.7-1.3-2.8-1.8-1.1-0.4-2.3-0.6-3.6-0.6-0.5 0-1 0.2-1.9 0.8-0.6 0.4-1.3 0.8-2 1.3-0.6 0.4-1.5 0.8-2.6 1.1s-2.1 0.5-3.2 0.5-2.1-0.2-3.2-0.5-2-0.7-2.6-1.1c-0.7-0.5-1.4-0.9-2-1.3-0.9-0.6-1.4-0.8-1.9-0.8-1.3 0-2.5 0.2-3.6 0.6s-2 1-2.8 1.8c-0.7 0.7-1.4 1.6-1.9 2.5s-1 1.9-1.3 2.9-0.6 2-0.8 3.1-0.3 2.2-0.4 3.1-0.1 1.9-0.1 2.9c0 2.6 0.8 4.7 2.4 6.2s3.7 2.3 6.3 2.3h23.8c2.6 0 4.7-0.8 6.3-2.3s2.4-3.6 2.4-6.2c0-1-0.1-2-0.1-2.9zm-4.4 7c-1.1 1-2.5 1.5-4.3 1.5h-23.7c-1.8 0-3.2-0.5-4.3-1.5-1-1-1.5-2.3-1.5-4.1 0-0.9 0-1.8 0.1-2.7s0.2-1.8 0.4-2.8 0.4-1.9 0.7-2.8c0.3-0.8 0.6-1.6 1.1-2.4 0.4-0.7 0.9-1.4 1.4-1.9s1.1-0.9 1.9-1.2c0.7-0.3 1.4-0.4 2.3-0.4 0.1 0.1 0.3 0.2 0.6 0.3 0.6 0.4 1.3 0.8 2 1.3 0.9 0.5 2 1 3.3 1.5 1.3 0.4 2.7 0.7 4.1 0.7s2.7-0.2 4.1-0.7c1.3-0.4 2.4-0.9 3.3-1.5 0.8-0.5 1.4-0.9 2-1.3 0.3-0.2 0.5-0.3 0.6-0.3 0.8 0 1.6 0.2 2.3 0.4 0.7 0.3 1.4 0.7 1.9 1.2s1 1.1 1.4 1.9 0.8 1.6 1.1 2.4 0.5 1.8 0.7 2.8 0.3 2 0.4 2.8c0.1 0.9 0.1 1.8 0.1 2.7-0.4 1.8-0.9 3.1-2 4.1z"/>
    </svg>
    ';
}

function dtp_get_svg_clock_icon()
{
	return '<svg enable-background="new 0 0 443.294 443.294" viewBox="0 0 443.29 443.29" xmlns="http://www.w3.org/2000/svg"><path d="m221.65 0c-122.21 0-221.65 99.433-221.65 221.65s99.433 221.65 221.65 221.65 221.65-99.433 221.65-221.65-99.433-221.65-221.65-221.65zm0 415.59c-106.94 0-193.94-87-193.94-193.94s87-193.94 193.94-193.94 193.94 87 193.94 193.94-87 193.94-193.94 193.94z"/><path d="m235.5 83.118h-27.706v144.26l87.176 87.176 19.589-19.589-79.059-79.059z"/>
    </svg>';
}

function dtp_get_img_masking_shapes($shape)
{
	$shapes = array(
		'none'    => '',
		'shape_1' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 86.4"><path class="st0" opacity="0.2" d="M0,69.3c0,0,76.2-89.2,215-32.8s185,32.8,185,32.8v17H0V69.3z"></path><path class="st0" opacity="0.2" d="M0,69.3v17h400v-17c0,0-7.7-93.8-145.8-59.1S89.7,119,0,69.3z"></path><path class="st1" d="M0,69.3c0,0,50.3-63.1,197.3-14.2S400,69.3,400,69.3v17H0V69.3z"></path></svg>',
		'shape_2' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 273.3 34"><path d="M0,34h273.3l0-32C119.7-8.7,0,34,0,34z"/></svg>',
		'shape_3' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 35"><path 	class="st0" d="M0,33.6C63.8,11.8,130.8,0.2,200,0.2s136.2,11.6,200,33.4v1.2H0V33.6z"></path></svg>',
	);

	return $shapes[$shape];
}

function dtp_global_assets_list($global_list)
{
	$assets_list   = array();
	$assets_prefix = et_get_dynamic_assets_path();

	$assets_list['et_icons_fa'] = array(
		'css' => "{$assets_prefix}/css/icons_fa_all.css",
	);

	return array_merge($global_list, $assets_list);
}

function dtp_inject_fa_icons($icon_data)
{
	if (function_exists('et_pb_maybe_fa_font_icon') && et_pb_maybe_fa_font_icon($icon_data)) {
		add_filter('et_global_assets_list', 'dtp_global_assets_list');
		add_filter('et_late_global_assets_list', 'dtp_global_assets_list');
	}
}
