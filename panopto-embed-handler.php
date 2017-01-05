<?php
/**
 * Plugin Name: Panopto Embed Handler
 * Description: Looks for URLs matching a Panopto session, and switches them out for the standard Panopto embed code
 * Author: Adam Massey
 * Author URI: http://twitter.com/admmssy
 */

wp_embed_register_handler( 'panopto', '#https?:\/\/(.*)Panopto\/Pages\/(Viewer|Viewer/Default).aspx\?id=(.*)#i', 'wp_embed_handler_panopto' );

function wp_embed_handler_panopto( $matches, $attr, $url, $rawattr ) {
	$embed  = '<iframe src="';
	$embed .= sprintf(
		'http://%1$sPanopto/Pages/Embed.aspx?id=%2$s&v=1',
		esc_attr($matches[1]),
		esc_attr($matches[3])
	);
	$embed .= '" width="720" height="405" frameborder="0" allowfullscreen></iframe>';

	return apply_filters( 'embed_panopto', $embed, $matches, $attr, $url, $rawattr );
}
