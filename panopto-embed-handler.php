<?php
/**
 * Plugin Name: Panopto Embed Handler
 * Description: Looks for URLs matching a Panopto session, and switches them out for the standard Panopto embed code
 * Version: 0.1
 * Author: Adam Massey
 * Author URI: http://twitter.com/admmssy
 */

wp_embed_register_handler( 'panopto', '#http:\/\/(.*)Panopto\/Pages\/Viewer\/Default.aspx\?id=(.*)#i', 'wp_embed_handler_panopto' ); 

function wp_embed_handler_panopto( $matches, $attr, $url, $rawattr ) {
	$embed  = '<iframe src="';
	$embed .= sprintf(
		'http://%1$sPanopto/Pages/Embed/Default.aspx?id=%2$s&v=1',
		esc_attr($matches[1]),
		esc_attr($matches[2])
	);
	$embed .= '" width="450" height="300" frameborder="0"></iframe>';
	
	return apply_filters( 'embed_panopto', $embed, $matches, $attr, $url, $rawattr );
}