<?php
/**
 * Plugin Name: WP Image Resizer
 * Plugin URI:  https://github.com/bueltge/WP-Image-Resizer/
 * Text Domain: wp-img-resizer
 * Domain Path: /languages
 * Description: Resize images on the fly - an TimThumb alternative with WordPress defaults
 * Version:     1.0.1
 * Author:      Frank Bültge, Syamil MJ
 * Author URI:  https://bueltge.de/
 * License:     GPLv2+
 * Last Change: 2014-11-08
 *
 * PHP Version: 5.2
 *
 * Based on the idea Aqua-Resizer
 * https://github.com/sy4mil/Aqua-Resizer
 * by Syamil MJ
 *
 * Requirements:
 * ==============================================================================
 * This plugin requires WordPress >= 3.5 and tested with PHP Interpreter >= 5.3
 */

! defined( 'ABSPATH' ) && exit;

require_once 'aq_resizer.php';
