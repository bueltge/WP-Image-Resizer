<?php
/**
 * WordPress Image Resizer
 * 
 * @version  1.0.0
 * @author   fb
 */

require_once 'inc/resizer.php';
require_once 'inc/template-tags.php';

if ( ! function_exists( 'aq_resize' ) ) {
	
	/**
	 * Aqua Resizer
	 * 
	 * @param string $url    - (required) must be uploaded using wp media uploader
	 * @param int    $width  - (required) 
	 * @param int    $height - (optional) 
	 * @param bool   $crop   - (optional) default to soft crop
	 * @param bool   $single - (optional) returns an array if false
	 */
	function aq_resize( $url = '', $width = '', $height = NULL, $crop = NULL, $single = TRUE ) {
		
		if ( empty( $url ) )
			return NULL;
		
		if ( empty( $width ) )
			return NULL;
		
		$args = array(
			'url'    => $url,
			'width'  => $width,
			'height' => $height,
			'crop'   => $crop,
			'single' => $single
		);
		
		return wp_img_resizer_src( $args );
	}
}


