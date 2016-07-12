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
        add_action('admin_head', 'Editor::addCourseTicketButton');
        add_action('admin_enqueue_scripts', 'Editor::load_custom_ct_styles');
        add_action('admin_footer', 'Editor::ct_data');
    }

    public static function load_custom_ct_styles() {
        wp_register_style('custom_ct_css', plugins_url('css/ct-style.css', dirname(__FILE__)));
        wp_enqueue_style( 'custom_ct_css' );
    }


    public static function addStyles($mce_css)
    {
        if (!empty($mce_css))
            $mce_css .= ',';

        $mce_css .= plugins_url('css/ct-style.css', dirname(__FILE__));
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
                'block' => 'a',
                'classes' => 'courseticket-button',
                'wrapper' => true,
            ),
        );
        $init_array = ['style_formats' => json_encode($style_formats)];

        return $init_array;
    }

    public static function addCourseTicketButton()
    {
        global $typenow;
        if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
            return;
        }

        if( ! in_array( $typenow, array( 'post', 'page' ) ) )
            return;
        if ( get_user_option('rich_editing') == 'true') {
            add_filter("mce_external_plugins", "Editor::add_tinymce_plugin");
            add_filter('mce_buttons', 'Editor::register_ct_button');

        }
    }

    public static function add_tinymce_plugin($plugin_array)
    {
        $plugin_array['ct_button'] = plugins_url( 'js/text-button.js', dirname(__FILE__) );
        $plugin_array['ct_shearchbox'] = plugins_url( 'bower_components/typeahead/dist/typeahead.bundle.js', dirname(__FILE__) );
        $plugin_array['ct_translation'] = plugins_url( 'js/translations.js', dirname(__FILE__) );
        $plugin_array['ct_lang'] = plugins_url( 'js/languages-es.js', dirname(__FILE__) );

        return $plugin_array;
    }

    public static function register_ct_button($buttons)
    {
        array_push($buttons, "ct_button");
        return $buttons;
    }

    public static function ct_data()
    {
        echo '<span id="data" data-ct-lang="'. ct_get_lang() .'" data-ct-id="'. get_option('ct_id')
            .'" data-ct-key="'. get_option('api_key') .'"></span> ';
    }
}



