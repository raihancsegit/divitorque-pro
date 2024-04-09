<?php

namespace DiviTorque;

use DiviTorque\BackendHelpers;

/**
 * AssetsManager
 * 
 * This class is used to add helper functions to the backend builder
 * 
 * @package DiviTorque
 */
class AssetsManager
{
    private static $instance;

    /**
     * Add the static asset helpers to the page
     * 
     * @param array $exists
     * 
     * @return array
     */
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_builder_scripts'));
        add_action('wp_loaded', array($this, 'load_backend_data'));
    }

    public function enqueue_frontend_scripts()
    {
        $mj = file_get_contents(DTP_PLUGIN_PATH . 'assets/mix-manifest.json');
        $mj = json_decode($mj, true);

        wp_enqueue_style('torq-frontend', DTP_PLUGIN_URL . 'assets/css/frontend.css', [], DTP_VERSION);

        // vandor css.
        wp_register_style('torq-magnific-popup', DTP_PLUGIN_URL . 'assets/libs/magnific-popup/magnific-popup.min.css', [], DTP_VERSION);
        wp_register_style('torq-slick', DTP_PLUGIN_URL . 'assets/libs/slick/slick.min.css', [], DTP_VERSION);
        wp_register_style('torq-tippy', DTP_PLUGIN_URL . 'assets/libs/tippy/tippy.min.js', [], DTP_VERSION);
        wp_register_style('torq-magnific-popup', DTP_PLUGIN_URL . 'assets/libs/magnific-popup/magnific-popup.min.css', [], DTP_VERSION);
        wp_register_style('torq-fancybox',  DTP_PLUGIN_URL . 'assets/libs/fancybox/fancybox.min.css', [], DTP_VERSION);

        // vandor js.
        wp_register_script('torq-typed',  DTP_PLUGIN_URL . 'assets/libs/typed.js/typed.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-magnific-popup', DTP_PLUGIN_URL . 'assets/libs/magnific-popup/magnific-popup.js', ['jquery'], DTP_VERSION, true);
        wp_register_script('torq-slick',  DTP_PLUGIN_URL . 'assets/libs/slick/slick.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-tippy',  DTP_PLUGIN_URL . 'assets/libs/tippy/tippy.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-tilt',  DTP_PLUGIN_URL . 'assets/libs/tilt/tilt.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-twentytwenty',  DTP_PLUGIN_URL . 'assets/libs/twentytwenty/twentytwenty.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-event-move',  DTP_PLUGIN_URL . 'assets/libs/event-move/event_move.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-image-magnify',  DTP_PLUGIN_URL . 'assets/libs/image-magnify/jquery.magnify.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-imagesloaded',  DTP_PLUGIN_URL . 'assets/libs/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), DTP_VERSION, true);

        // Vendor Js.
        wp_register_script('torq-popper',  DTP_PLUGIN_URL . 'assets/libs/popper/popper.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-lottie-web',  DTP_PLUGIN_URL . 'assets/libs/lottie.js/lottie.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-isotope',  DTP_PLUGIN_URL . 'assets/libs/isotope/isotope.pkgd.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-infinite-scroll',  DTP_PLUGIN_URL . 'assets/libs/infinite-scroll/infinite-scroll.pkgd.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-counter-up',  DTP_PLUGIN_URL . 'assets/libs/counter-up/counter-up.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-isotope-packery',  DTP_PLUGIN_URL . 'assets/libs/isotope/packery-mode.pkgd.min.js', array('jquery'), DTP_VERSION, true);
        wp_register_script('torq-fancybox',  DTP_PLUGIN_URL . 'assets/libs/fancybox/fancybox.min.js', array('jquery'), DTP_VERSION, true);

        // Modules Js.
        wp_register_script('torq-alert', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-alert.js'], ['jquery'], DTP_VERSION, true);

        wp_register_script('torq-carousel', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-carousel.js'], ['jquery', 'torq-slick'], DTP_VERSION, true);
        wp_register_script('torq-compare-image', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-compare-image.js'], ['jquery', 'torq-twentytwenty'], DTP_VERSION, true);
        wp_register_script('torq-logo-carousel', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-logo-carousel.js'], ['jquery', 'torq-slick'], DTP_VERSION, true);
        wp_register_script('torq-image-scroll', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-image-scroll.js'], ['jquery'], DTP_VERSION, true);

        wp_register_script('torq-video-modal', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-video-modal.js'], ['jquery'], DTP_VERSION, true);
        wp_register_script('torq-timeline', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-timeline.js'], ['jquery'], DTP_VERSION, true);
        wp_register_script('torq-content-toggle', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-content-toggle.js'], ['jquery'], DTP_VERSION, true);
        wp_register_script('torq-horizontal-timeline', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-horizontal-timeline.js'], ['jquery', 'torq-slick'], DTP_VERSION, true);

        wp_register_script('torq-social-share', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-social-share.js'], [], DTP_VERSION, false);
        wp_register_script('torq-lottie', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-lottie.js'], ['jquery'], DTP_VERSION, true);

        wp_register_script('torq-image-zoom', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-image-zoom.js'], ['jquery', 'torq-image-magnify'], DTP_VERSION, true);

        wp_register_script('torq-hotspot', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/torq-hotspot.js'], ['jquery', 'torq-tippy'], DTP_VERSION, true);

        // New Modules Js.
        wp_register_script('torq-countdown', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/countdown.js'], [], DTP_VERSION, true);

        wp_register_script('torq-filterable-gallery', DTP_PLUGIN_URL . 'assets' . $mj['/js/modules/filterable-gallery.js'], ['jquery', 'torq-isotope', 'torq-isotope-packery', 'torq-fancybox'], DTP_VERSION, true);

        wp_register_style('torq-divider', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-divider.css'], [], DTP_VERSION);
        wp_register_style('torq-heading', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-heading.css'], [], DTP_VERSION);
        wp_register_style('torq-team', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-team.css'], [], DTP_VERSION);
        wp_register_style('torq-alert', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-alert.css'], [], DTP_VERSION);
        wp_register_style('torq-business-hour', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-business-hour.css'], [], DTP_VERSION);
        wp_register_style('torq-info-card', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-info-card.css'], [], DTP_VERSION);
        wp_register_style('torq-contact-form7', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-contact-form7.css'], [], DTP_VERSION);
        wp_register_style('torq-flip-box', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-flip-box.css'], [], DTP_VERSION);
        wp_register_style('torq-icon-box', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-icon-box.css'], [], DTP_VERSION);
        wp_register_style('torq-carousel', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-carousel.css'], [], DTP_VERSION);
        wp_register_style('torq-compare-image', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-compare-image.css'], [], DTP_VERSION);
        wp_register_style('torq-blurb', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-blurb.css'], [], DTP_VERSION);
        wp_register_style('torq-logo-carousel', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-logo-carousel.css'], [], DTP_VERSION);
        wp_register_style('torq-logo-list', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-logo-list.css'], [], DTP_VERSION);
        wp_register_style('torq-review-card', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-review-card.css'], [], DTP_VERSION);
        wp_register_style('torq-image-scroll', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-image-scroll.css'], [], DTP_VERSION);
        wp_register_style('torq-progress-bar', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-progress-bar.css'], [], DTP_VERSION);
        wp_register_style('torq-testimonial', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-testimonial.css'], [], DTP_VERSION);
        wp_register_style('torq-video-modal', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-video-modal.css'], [], DTP_VERSION);
        wp_register_style('torq-timeline', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-timeline.css'], [], DTP_VERSION);
        wp_register_style('torq-horizontal-timeline', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-horizontal-timeline.css'], [], DTP_VERSION);
        wp_register_style('torq-social-share', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-social-share.css'], [], DTP_VERSION);
        wp_register_style('torq-lottie', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-lottie.css'], [], DTP_VERSION);
        wp_register_style('torq-image-zoom', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-image-zoom.css'], [], DTP_VERSION);
        wp_register_style('torq-hotspot', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-hotspot.css'], [], DTP_VERSION);
        wp_register_style('torq-content-toggle', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-content-toggle.css'], [], DTP_VERSION);

        wp_register_style('torq-countdown', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-countdown.css'], [], DTP_VERSION);
        wp_register_style('torq-pricing-table', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-pricing-table.css'], [], DTP_VERSION);
        wp_register_style('torq-basic-list', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-basic-list.css'], [], DTP_VERSION);
        wp_register_style('torq-checkmark-list', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-checkmark-list.css'], [], DTP_VERSION);
        wp_register_style('torq-icon-list', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-icon-list.css'], [], DTP_VERSION);
        wp_register_style('torq-star-rating', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-star-rating.css'], [], DTP_VERSION);
        wp_register_style('torq-stats-grid', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-stats-grid.css'], [], DTP_VERSION);
        wp_register_style('torq-filterable-gallery', DTP_PLUGIN_URL . 'assets' . $mj['/css/modules/torq-filterable-gallery.css'], ['torq-fancybox'], DTP_VERSION);
    }

    public function enqueue_builder_scripts()
    {
        if (!et_core_is_fb_enabled()) {
            return;
        }

        $mj = file_get_contents(DTP_PLUGIN_PATH . 'assets/mix-manifest.json');
        $mj = json_decode($mj, true);

        wp_enqueue_script('torq-builder-js', DTP_PLUGIN_URL . 'assets' . $mj['/js/builder.js'], ['react-dom', 'react', 'torq-filterable-gallery'], DTP_VERSION, true);
        wp_enqueue_style('torq-builder-css', DTP_PLUGIN_URL . 'assets' . $mj['/css/builder.css'], [], DTP_VERSION);
        wp_enqueue_script('torq-builder-props', DTP_PLUGIN_URL . 'assets/utils/builder-props.js', [], DTP_VERSION, true);
        wp_enqueue_style('torq-slick-css', DTP_PLUGIN_URL . 'assets' . '/libs/slick/slick.min.css', [], DTP_VERSION);
    }

    public function load_backend_data()
    {
        if (!function_exists('et_fb_process_shortcode') || !class_exists(BackendHelpers::class)) {
            return;
        }

        $helpers = new BackendHelpers();
        $this->registerFiltersAndActions($helpers);
    }

    private function registerFiltersAndActions(BackendHelpers $helpers): void
    {
        add_filter('et_fb_backend_helpers', [$helpers, 'static_asset_helpers'], 11);
        add_filter('et_fb_get_asset_helpers', [$helpers, 'asset_helpers'], 11);

        $enqueueScriptsCallback = function () use ($helpers) {
            wp_localize_script('et-frontend-builder', 'TORQBuilderBackend', $helpers->static_asset_helpers());
        };

        add_action('wp_enqueue_scripts', $enqueueScriptsCallback);
        add_action('admin_enqueue_scripts', $enqueueScriptsCallback);
    }
}
