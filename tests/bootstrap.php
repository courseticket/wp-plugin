<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = dirname( __FILE__ );
}

require_once $_tests_dir . '/WP_UnitTestCase.php';

$_plutin_dir = dirname( dirname( __FILE__ ) );
require_once dirname(dirname(dirname($_plutin_dir))) . '/wp-load.php';
