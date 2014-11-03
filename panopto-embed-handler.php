<?php
/**
 * Plugin Name: Panopto Embed Handler
 * Description: Looks for URLs matching a Panopto session, and switches them out for the standard Panopto embed code
 * Author: Adam Massey
 * Author URI: http://twitter.com/admmssy
 */

wp_embed_register_handler( 'panopto_session', '#https?:\/\/(.*)Panopto\/Pages\/Viewer.*.aspx\?id=(.*)#i', 'wp_embed_handler_panopto_session' );

function wp_embed_handler_panopto_session( $matches, $attr, $url, $rawattr ) {
	$embed  = sprintf(
  		'<iframe src="http://%1$sPanopto/Pages/Embed/Default.aspx?id=%2$s&v=1',
		esc_attr($matches[1]),
		esc_attr($matches[2])
	);
	$embed .= '" width="450" height="300" frameborder="0"></iframe>';
	
	return apply_filters( 'embed_panopto_session', $embed, $matches, $attr, $url, $rawattr );
}


wp_embed_register_handler( 'panopto_folder', '#https?:\/\/(.*)Panopto\/Pages\/Sessions\/List.aspx\?folderID=(.*)#', 'wp_embed_handler_panopto_folder' );

function wp_embed_handler_panopto_folder( $matches, $attr, $url, $rawattr ) {
	$embed  = sprintf(
		'<iframe src="http://%1$sPanopto/Pages/EmbeddedList.aspx?folderID=%2$s',
		esc_attr($matches[1]),
		esc_attr($matches[2])
	);
	$embed .= '" width="100%" height="900" frameborder="1"></iframe>'; 
	
	return $embed;
	// return apply_filters( 'embed_panopto', $embed, $matches, $attr, $url, $rawattr );
}