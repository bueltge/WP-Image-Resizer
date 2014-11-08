# WordPress Image Resizer
Based on the idea of [Aqua Resizer](https://github.com/sy4mil/Aqua-Resizer) from [Syamil MJ](http://aquagraphite.com/) -- Thanks

You can also read [on the public page](http://bueltge.github.com/WP-Image-Resizer/) for this solution.

## Description
This small script will allow you to resize & crop WordPress images uploaded via the media uploader. It relies on WP's native functions to resize the images, and checks if there is an already resized version of the image so that it won't be wasting your server's resources to regenerate the images.

## Why use it?
There are a couple of image resizing scripts out there that already have this function. Some authors simply use the add_image_size() function to define custom image sizes that will be generated for each image uploaded via the media uploader. I mostly find these methods somewhat a little complicated to use, or having some limitations or too resource intensive.

With Aqua Resizer, the only required inputs are the URL and width. It's easy, fast & efficient. Additionally, you have the additional options such as the height, crop, and array return.

## How to use
You can use the solution as plugin or include the functions in your theme.

### As Plugin

Install the plugin and activate in backend. After activation you can use all functions.

 1. Upload the file to the `/wp-content/plugins/` directory
 1. Activate the plugin through the 'Plugins' menu in WordPress

### In your theme

Include the the file with follow syntax in your `functions.php` of your theme and now you can also use the functions. 
```php
require_once( 'aq_resizer.php' );
```

Now you can use the different functions.

The follow is only an small example, you find more functions, possibilities and examples of source on the [wiki](https://github.com/bueltge/WP-Image-Resizer/wiki) to this repository
You can then use it in your theme as such:

**Echo img-tag**
```php
$args = array( 'url' => 'your img url', 'width' => 'your wish for width' );
wp_img_resizer( $args );
```

**Return single value or array with url, width, height**
```php
$args = array( 'url' => 'your img url', 'width' => 'your wish for width' );
wp_img_resizer_src( $args );
```

**Shortcode for an gallery**
```php
[resizer_gallery width='120']
```

**Also the first solution if Aqua Resizer**
```php
aq_resize( $img_url, $width );
```

More usage instructions and examples can be found in our [wiki](https://github.com/bueltge/WP-Image-Resizer/wiki)

 * [Home](https://github.com/bueltge/WP-Image-Resizer/wiki)
 * [Examples](https://github.com/bueltge/WP-Image-Resizer/wiki/Examples)
 * [Parameters](https://github.com/bueltge/WP-Image-Resizer/wiki/Parameters)

## Installation

### Requirements
* WordPress (also Multisite) version 3.3 and later (tested at 3.5-RC4)
* PHP 5.2.4

### Installation
* Use as plugin or
* use in your plugin or theme as library
```php
require_once( 'aq_resizer.php' );
```

## Other Notes
### Disclaimer
I'm German and my English might be gruesome here and there. So please be patient with me and let me know of typos or grammatical farts. Thanks

### Contact & Feedback
The plugin is designed and developed by ([Frank Bültge](http://bueltge.de)) based on the idea from [Syamil MJ](http://aquagraphite.com/)

Please let me know if you like the plugin or you hate it or whatever ... Please fork it, add an issue for ideas and bugs.

### License
Good news, this plugin is free for everyone! Since it's released under the GPL, you can use it free of charge on your personal or commercial blog.

## Changelog
Nov 08, 2014
* `wp_get_attachment_url` doesn't support a size parameter, Fix via [Pull Request](https://github.com/bueltge/WP-Image-Resizer/pull/2), props [@eliorivero](https://github.com/eliorivero)

Feb 12, 2013
 * Update Readme
 * Create [Github Page](http://bueltge.github.com/WP-Image-Resizer)
 * Add Support for Retina, Double values
 * Small minor changes
 * Enhance Error Handling with WP defaults

Dez 06, 2012
 * Update for use in WordPress 3.5; use the new class `WP_Image_Editor`
 * Hint: more about changes in WP 3.5 to images see this [post](http://make.wordpress.org/core/2012/12/06/wp_image_editor-is-incoming/)

May 31, 2012
 * Fix for themes, there are unsupported thumbnails

Global
 * See the [commits](https://github.com/bueltge/WP-Image-Resizer/commits/master)
