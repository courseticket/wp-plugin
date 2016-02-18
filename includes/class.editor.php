<?php
class Editor
{
    private static $instance;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new Editor();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_filter('mce_css', 'Editor::addStyles');
        add_filter('mce_buttons_2', 'Editor::showStyleSelector');
        add_filter('tiny_mce_before_init', 'Editor::customizeStyleFormats');
    }

    public static function addStyles($mce_css) {
        if ( ! empty( $mce_css ) )
            $mce_css .= ',';

        $mce_css .= plugins_url( 'css/ct-editor-style.css', dirname(__FILE__) );
        return $mce_css;
    }

    public static function showStyleSelector($buttons)
    {
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }

    public static function customizeStyleFormats($init_array)
    {
        $style_formats = array(
            array(
                'title' => 'Courseticket Button',
                'block' => 'span',
                'classes' => 'courseticket-button',
                'wrapper' => true,

            ),
        );
        $init_array['style_formats'] = json_encode($style_formats);

        return $init_array;
    }
}