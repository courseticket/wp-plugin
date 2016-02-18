<?php
class Settings
{
    private static $instance;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new Settings();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action( 'admin_init', 'ct_plugin_settings' );
        function ct_plugin_settings() {
            register_setting( 'ct-settings-group', 'ct_id' );
            register_setting( 'ct-settings-group', 'api_key' );
            register_setting( 'ct-settings-group', 'overview_page' );
        }

        require_once( CT__PLUGIN_DIR . 'templates/ct-settings-page.php' );
        add_action('admin_menu', 'ct_plugin_menu');
        function ct_plugin_menu() {
            add_menu_page(
                'Courseticket Settings', 'Courseticket', 'administrator', 'courseticket-settings',
                'ct_settings_page', plugins_url('../img/menu-icon.png', __FILE__)
            );
        }

    }
}