<?php

// Add style to style.css mytheme
function sala_add_customizer_styles()
{
    $custom_css = sala_get_customizer_css();
    wp_add_inline_style('sala-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'sala_add_customizer_styles', 99);

function sala_get_customizer_css()
{
    $css = '';

    $css .= sala_get_page_title_css();

    return $css;
}

function sala_get_page_title_css()
{
    $css = $page_title_tmp = $overlay_tmp = '';

    $type = Sala_Global::instance()->get_page_title_type();
    $bg_type = Sala_Helper::setting( "page_title_{$type}_background_type" );
    ob_start();

    if ( 'gradient' === $bg_type ) {
        $gradient_color = Sala_Helper::setting( "page_title_{$type}_background_gradient" );
        $color1         = $gradient_color['color_1'];
        $color2         = $gradient_color['color_2'];

        $css .= "
            .page-title-bg
            {
                background-color: $color1;
                background-image: linear-gradient(-180deg, {$color1} 0%, {$color2} 100%);
            }
        ";
    }

    $bg_color   = Sala_Helper::get_post_meta( 'page_page_title_background_color', '' );
    $bg_image   = Sala_Helper::get_post_meta( 'page_page_title_background', '' );
    $bg_overlay = Sala_Helper::get_post_meta( 'page_page_title_background_overlay', '' );

    if ( $bg_color !== '' ) {
        $page_title_tmp .= "background-color: {$bg_color}!important;";
    }

    if ( '' !== $bg_image ) {
        $page_title_tmp .= "background-image: url({$bg_image})!important;";
    }

    if ( '' !== $bg_overlay ) {
        $overlay_tmp .= "background-color: {$bg_overlay}!important;";
    }

    if ( '' !== $page_title_tmp ) {
        $css .= ".page-title-bg{ {$page_title_tmp} }";
    }

    if ( '' !== $overlay_tmp ) {
        $css .= ".page-title-bg:before{ {$overlay_tmp} }";
    }

    $bottom_spacing = Sala_Helper::get_post_meta( 'page_page_title_bottom_spacing', '' );
    if ( '' !== $bottom_spacing ) {
        $css .= "#page-title{ margin-bottom: {$bottom_spacing}; }";
    }

    $css = ob_get_clean();
    return $css;
}
