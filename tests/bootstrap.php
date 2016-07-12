<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = dirname( __FILE__ );
}

require_once $_tests_dir . '/WP_UnitTestCase.php';

$_plugin_dir = dirname( dirname( __FILE__ ) );
define('CT__PLUGIN_DIR', $_plugin_dir . DIRECTORY_SEPARATOR);

$_wp_load_file = dirname(dirname(dirname($_plugin_dir))) . '/wp-load.php';
$_wp_load_file = null;// dont load wordpress on tests
if (file_exists($_wp_load_file)) {
	require_once $_wp_load_file;
} else {
	require_once $_tests_dir . '/fakeFunctions.php';
}
require_once ($_plugin_dir . '/includes/bootstrap.php');
