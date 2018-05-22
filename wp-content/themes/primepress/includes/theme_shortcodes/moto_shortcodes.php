<?php
/**
 *
 * Moto Shortcodes
 *
 */

// Frame 2
function framestyled_shortcode($atts, $content = null) {

    $output = '<figure class="thumbnail thumbnail_styled clearfix">';
        $output .= do_shortcode($content);
    $output .= '</figure>';

    return $output;
}
add_shortcode('framestyled', 'framestyled_shortcode');

// Frame 3
function framestyled2_shortcode($atts, $content = null) {

    $output = '<figure class="thumbnail thumbnail_styled2 clearfix">';
        $output .= do_shortcode($content);
    $output .= '</figure>';

    return $output;
}
add_shortcode('framestyled2', 'framestyled2_shortcode');
?>