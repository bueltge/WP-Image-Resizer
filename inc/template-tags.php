<?php
/**
 * WordPress Image Resizer
 * 
 * @version  02/12/2013
 * @author   fb
 */

if ( ! function_exists( 'wp_img_resizer_single' ) ) {
	
	/**
	 * Helper function to get an img-tag with the thumbnail image on single post
	 * 
	 * @param   $width  Integer Value for width of the croped image
	 * @param   $height Integer Optional, value for the height of the croped image
	 * @param   $size   String  Optional, Value for the original image size
	 * @return          String, img-Tag with values of the croped image
	 */
	function wp_img_resizer_single( $width = '', $height = NULL, $size = 'full', $retina = FALSE ) {
		
		// get full URL to image (use "large" or "medium" if the images too big)
		$img_url = wp_get_attachment_url( get_post_thumbnail_id(), $size );
		
		if ( empty( $img_url ) )
			return new WP_Error( 'no_image_url', __( 'No image URL has been entered.' ), $url );
		
		$args = array(
			'url'    => $img_url,
			'width'  => $width,
			'height' => $height,
			'retina' => $retina
		);
		
		return wp_img_resizer( $args );
	}
	
}

if ( ! function_exists( 'wp_img_resizer_gallery' ) ) {
	
	/**
	 * Gallery Shortcode with Resizer
	 * 
	 * This implements the functionality of the Gallery Shortcode for displaying
	 * WordPress images on a post.
	 * 
	 * @param  Array  $attr Attributes of the shortcode.
	 * @return string HTML content to display gallery.
	 */
	function wp_img_resizer_gallery( $attr ) {
		global $post;
	
		static $instance = 0;
		$instance ++;
	
		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters( 'post_gallery', '', $attr );
		if ( $output != '' )
			return $output;
	
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			
			if ( ! $attr['orderby'] )
				unset( $attr['orderby'] );
		}
	
		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
			// new for resizer
			'width'      => '',
			'height'     => NULL,
		), $attr ) );
		
		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';
	
		if ( ! empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( ! empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array(
				'post_parent'    => $id,
				'exclude'        => $exclude,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
		} else {
			$attachments = get_children( array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
		}
	
		if ( empty( $attachments ) )
			return NULL;
	
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link( $att_id, $size, TRUE ) . "\n";
			
			return $output;
		}
		
		$itemtag    = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$columns    = intval($columns);
		$itemwidth  = $columns > 0 ? floor(100/$columns) : 100;
		$float      = is_rtl() ? 'right' : 'left';
		
		$selector = "gallery-{$instance}";
		
		$gallery_style = $gallery_div = '';
		if ( apply_filters( 'use_default_gallery_style', TRUE ) )
			$gallery_style = "
			<style type='text/css'>
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				#{$selector} img {
					border: 2px solid #cfcfcf;
				}
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
			</style>
			<!-- see gallery_shortcode() in wp-includes/media.php -->";
		$size_class  = sanitize_html_class( $size );
		$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
		$output      = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
	
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			
			$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? 
				wp_img_resizer_attachment_link( $id, $size, FALSE, FALSE, '', $width ) : 
				wp_img_resizer_attachment_link( $id, $size, TRUE, FALSE, '', $width );
			
			$output .= "<{$itemtag} class='gallery-item'>";
			$output .= "
				<{$icontag} class='gallery-icon'>
					$link
				</{$icontag}>";
			if ( $captiontag && trim( $attachment->post_excerpt ) ) {
				$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption'>
					" . wptexturize( $attachment->post_excerpt ) . "
					</{$captiontag}>";
			}
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '<br style="clear: both" />';
		}
		
		$output .= "
				<br style='clear: both;' />
			</div>\n";
		
		return $output;
	}
	
	// add shortcode for use resizer in posts, pages
	add_shortcode( 'resizer_gallery', 'wp_img_resizer_gallery' );
	
} // end if function exists

if ( ! function_exists( 'wp_img_resizer_attachment_link' ) ) {
	/**
	 * Retrieve an attachment page link using an image or icon, if possible.
	 *
	 * @since  2.5.0
	 * @uses   apply_filters() Calls 'wp_get_attachment_link' filter on HTML content with same parameters as function.
	 * 
	 * @param  int    $id        Optional, Post ID.
	 * @param  string $size      Optional, default is 'thumbnail'. Size of image, either array or string.
	 * @param  bool   $permalink Optional, default is false. Whether to add permalink to image.
	 * @param  bool   $icon      Optional, default is false. Whether to include icon.
	 * @param  string $text      Optional, default is false. If string, then will be link text.
	 * @param  int    $width     Optional, the width of image | default is the settings of WP
	 * @param  bool   $retina    Optional, boolean for creating images that are double the width and height. | default is FALSE
	 * @return string HTML content.
	 */
	function wp_img_resizer_attachment_link( $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false, $width = FALSE, $retina = FALSE ) {
		
		$id = intval( $id );
		$_post = & get_post( $id );
		
		if ( empty( $_post ) || ( 'attachment' != $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) )
			return __( 'Missing Attachment' );
	
		if ( $permalink )
			$url = get_attachment_link( $_post->ID );
		
		$post_title = esc_attr( $_post->post_title );
		
		$args = array(
			'url'    => wp_get_attachment_url( $id , $size ),
			'width'  => $width,
			'retina' => $retina,
			'echo'   => FALSE
		);
		$link = wp_img_resizer( $args );
		
		if ( $text )
			$link_text = $text;
		elseif ( $size && 'none' != $size )
			$link_text = $link;
		else
			$link_text = '';
		
		if ( '' == trim( $link_text ) )
			$link_text = $_post->post_title;
		
		return apply_filters( 
			'wp_img_resizer_attachment_link', 
			"<a href='$url' title='$post_title'>$link_text</a>",
			$id,
			$size,
			$permalink,
			$icon,
			$text
		);
	}
	
} // end if function exists
