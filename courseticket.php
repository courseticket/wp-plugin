<?php
/**
 * @package Courseticket
 * @version 0.2
 */
/*
Plugin Name: Courseticket
Plugin URI: http://wordpress.org/plugins/courseticket/
Description: Display and manage courseticket events easily in wordpress.
Author: Courseticket
Version: 0.2
Author URI: https://www.courseticket.com/
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'CT__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( CT__PLUGIN_DIR . 'includes/bootstrap.php' );
