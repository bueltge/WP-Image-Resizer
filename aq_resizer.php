<?php
/**
 * WordPress Image Resizer
 * 
 * @version  02/12/2013
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
	 * @param bool   $retina - (optional) default to no double of width and height
	 * @param bool   $single - (optional) returns an array if false
	 */
	function aq_resize( $url, $width = NULL, $height = NULL, $crop = NULL, $retina = FALSE, $single = TRUE ) {
		
		// get error message
		if ( empty( $url ) )
			return new WP_Error( 'no_image_url', __( 'No image URL has been entered.' ), $url );
		
		// use settings of WordPress
		if ( empty( $width ) )
			$width = get_option( 'thumbnail_size_w' );
		
		$args = array(
			'url'    => $url,
			'width'  => $width,
			'height' => $height,
			'crop'   => $crop,
			'retina' => $retina,
			'single' => $single
		);
		
		return wp_img_resizer_src( $args );
	}
	
} // end if function_exists
