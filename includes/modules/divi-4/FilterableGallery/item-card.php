<?php

/**
 * Template for rendering individual items in the gallery.
 *
 * @package YourPackageNameHere
 */

use DiviTorque\Helpers;

// Extracting properties from the image data.
$link_classes    = $image_data['link_classes'];
$item_classes    = $image_data['item_classes'];
$item_attributes = $image_data['item_attributes'];
$link_attributes = $image_data['link_attributes'];
$img_attributes  = $image_data['img_attributes'];
$img_classes     = $image_data['img_classes'];
?>

<div class="<?php echo esc_attr(implode(' ', $item_classes)); ?>" <?php echo wp_kses_post(Helpers::render_attributes($item_attributes)); ?>>

    <div class="torq-item-overlay"></div>
    <div class="torq-item-content">
        <?php if ('no-link' !== $image_data['click_action']) : ?>
            <a <?php echo wp_kses_post(Helpers::render_attributes($link_attributes)); ?> class="<?php echo esc_attr(implode(' ', $link_classes)); ?>"></a>
        <?php endif; ?>
        <img <?php echo wp_kses_post(Helpers::render_attributes($img_attributes)); ?> class="<?php echo esc_attr(implode(' ', $img_classes)); ?>" />

        <div class="torq-caption">
            <div class="torq-caption-inner">
                <?php if ('on' !== $this->props['hide_caption'] && 'on' !== $this->props['hide_title']) : ?>
                    <h2 class='torq-title'><?php echo wp_kses_post($image_data['title']); ?></h2>
                <?php endif; ?>
                <?php if ('on' !== $this->props['hide_caption'] && 'on' !== $this->props['hide_description']) : ?>
                    <p class="torq-description"><?php echo wp_kses_post($image_data['description']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>