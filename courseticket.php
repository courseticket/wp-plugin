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
function test(){
    $post = array(
        'comment_status' => 'closed',
        'ping_status' =>  'closed' ,
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_name' => 'Checklists',
        'post_status' => 'publish' ,
        'post_title' => 'Checklists',
        'post_type' => 'page',
    );
    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'hclpage', $newvalue );
}

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'CT__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once($ctPluginDir . 'includes/class.setup.php');

register_activation_hook(__FILE__,array('Setup', 'install'));
register_deactivation_hook( __FILE__, array('Setup', 'remove'));

require_once( CT__PLUGIN_DIR . 'includes/bootstrap.php' );

