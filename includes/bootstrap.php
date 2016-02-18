<?php
$ctPluginDir = CT__PLUGIN_DIR;
require_once($ctPluginDir . 'includes/functions.php');

require_once($ctPluginDir . 'includes/class.setup.php');
register_activation_hook(__FILE__,array('Setup', 'install'));
register_deactivation_hook( __FILE__, array('Setup', 'remove'));
add_action( 'wp_enqueue_scripts', array('Setup', 'enqueue_assets' ));

require_once($ctPluginDir . 'includes/class.settings.php');
add_action('plugins_loaded', array('Settings', 'get_instance'));

require_once($ctPluginDir . 'includes/class.page-templater.php');
add_action('plugins_loaded', array('PageTemplater', 'get_instance'));

require_once($ctPluginDir . 'includes/class.button-replacer.php');
add_action('plugins_loaded', array('ButtonReplacer', 'get_instance'));

require_once($ctPluginDir . 'includes/class.editor.php');
add_action('plugins_loaded', array('Editor', 'get_instance'));