<?php
if (!function_exists('get_option')) {
    function get_option($key) {
        return $_ENV['CT_OPTION'][$key];
    }
    function update_option($key, $value) {
        $_ENV['CT_OPTION'][$key] = $value;
    }
}