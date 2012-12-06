# WordPress Image Resizer
Based on the idea of [Aqua Resizer](https://github.com/sy4mil/Aqua-Resizer) from [Syamil MJ](http://aquagraphite.com/) -- Thanks

## Description
This small script will allow you to resize & crop WordPress images uploaded via the media uploader. It relies on WP's native functions to resize the images, and checks if there is an already resized version of the image so that it won't be wasting your server's resources to regenerate the images.

### Why use it?
There are a couple of image resizing scripts out there that already have this function. Some authors simply use the add_image_size() function to define custom image sizes that will be generated for each image uploaded via the media uploader. I mostly find these methods somewhat a little complicated to use, or having some limitations or too resource intensive.

With Aqua Resizer, the only required inputs are the URL and width. It's easy, fast & efficient. Additionally, you have the additional options such as the height, crop, and array return.

### How to use
You can use the solution as plugin or include the functions in your theme.

** As Plugin **
Install the plugin and activate in backend. After activation you can use all functions.
1. Upload the file to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

** In your theme **
Include the the file with follow syntax in your `functions.php` of your theme and now you can also use the functions. 
```
require_once( 'aq_resizer.php' );
```

Now you can use the different functions.

The follow is only an small example, you find more functions, possibilities and examples of source on the [wiki](https://github.com/bueltge/WP-Image-Resizer/wiki) to this repository
You can then use it in your theme as such:

**Echo img-tag**
```
	$args = array( 'url' => 'your img url', 'width' => 'your wish for width' );
	wp_img_resizer( $args );
```

**Return single value or array with url, width, height**
```
	$args = array( 'url' => 'your img url', 'width' => 'your wish for width' );
	wp_img_resizer_src( $args );
```

**Shortcode for an gallery
```
[resizer_gallery width='120']
```

**Also the first solution if Aqua Resizer**
```
	aq_resize( $img_url,$width );
```

More usage instructions and examples can be found in our [wiki](https://github.com/bueltge/WP-Image-Resizer/wiki)

## Installation

### Requirements
* WordPress (also Multisite) version 3.3 and later (tested at 3.5-RC4)
* PHP 5.2.4

### Installation
* Use as plugin or
* use in your plugin or theme as library

## Other Notes
### Disclaimer
I'm German and my English might be gruesome here and there. So please be patient with me and let me know of typos or grammatical farts. Thanks

### Contact & Feedback
The plugin is designed and developed by ([Frank Bültge](http://bueltge.de)) based on the idea from [Syamil MJ](http://aquagraphite.com/)

Please let me know if you like the plugin or you hate it or whatever ... Please fork it, add an issue for ideas and bugs.

### License
Good news, this plugin is free for everyone! Since it's released under the GPL, you can use it free of charge on your personal or commercial blog. But if you enjoy this plugin, you can thank me and leave a [small donation](http://bueltge.de/wunschliste/ "Wishliste and Donate") for the time I've spent writing and supporting this plugin. And I really don't want to know how many hours of my life this plugin has already eaten ;)

## Changelog
(Dez 06, 2012)
 * Update for use in WOrdPress 3.5; use the new class `WP_Image_Editor`
 * more hints about changes in WP 3.5 to images see the [link](http://make.wordpress.org/core/2012/12/06/wp_image_editor-is-incoming/)

(May 31, 2012)
 * Fix for themes, there are unsupported thumbnails
 * or see the [commits](https://github.com/bueltge/WP-Image-Resizer/commits/master)