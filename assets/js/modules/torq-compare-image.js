jQuery((function(t){t(".dtp-image-compare").each((function(){var e=t(this).data("offsetpct"),a=t(this).data("moveonhover"),o=t(this).data("orientation"),i=t(this).data("beforelabel"),n=t(this).data("afterlabel"),r=t(this).data("overlay");t(this).find(".dtp-image-compare-container").twentytwenty({default_offset_pct:e,move_slider_on_hover:"on"===a,orientation:o,before_label:i,after_label:n,no_overlay:"on"!==r,move_with_handle_only:!1,click_to_move:!0})}))}));