<?php
/*
Plugin Name: Oembed for My Mitsu Estimation Form
Plugin URI:
Description: You can embed an estimation(calculation) form by inserting a url. An estimation form is provided by a webservice in Japan called My Mitsu.
Version: 1.0
Author: Fumito MIZUNO
Author URI: https://my-mitsu.com/
License: GPL ver.2 or later
*/

wp_embed_register_handler( 'my-mitsu', '#https://my-mitsu\.jp/estimation/([a-zA-Z0-9/]+)#', 'mymitsu_oembed_handler' );

function mymitsu_oembed_handler( $matches, $attr, $url, $rawattr ) {
    global $content_width;
    if ( isset( $content_width ) && $content_width > 0 ) {
        $width = $content_width;
        $height = $content_width * 3/4;
    } else {
        $width = 640;
        $height = 480;
    }
    $width = apply_filters( 'mymitsu_oembed_width', $width );
    $height = apply_filters( 'mymitsu_oembed_height', $height );

    $format = '<iframe src="%s" width="%s" height="%s"></iframe>';
    return sprintf( $format,
        esc_url($url),
        intval($width),
        intval($height)
    );
}