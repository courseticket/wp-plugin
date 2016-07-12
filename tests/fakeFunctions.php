<?php
if (!function_exists('get_option')) {
    function get_option($key) {
        return $_ENV['CT_OPTION'][$key];
    }
    function update_option($key, $value) {
        $_ENV['CT_OPTION'][$key] = $value;
    }
}
if (!function_exists('__')) {
    function __($string) {
        return $string;
    }
}
if (!function_exists('get_bloginfo')) {
    function get_bloginfo($key) {
        return 'en-en';
    }
}
if (!function_exists('add_action')) {
    function add_action() {
        return null;
    }
}