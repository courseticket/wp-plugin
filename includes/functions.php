<?php

function ct_get_lang() {
    $langUrl = explode('-', get_bloginfo( 'language' ))[0];
    if (in_array($langUrl, array('de', 'es'))) {
        return $langUrl;
    }
    return 'en';
}


//function my_theme_add_editor_styles() {
//	    add_editor_style( '../../plugins/courseticket/css/ct-editor-style.css' );
//	}
//	add_action( 'admin_init', 'my_theme_add_editor_styles' );

//function plugin_mce_css( $mce_css ) {
//    if ( ! empty( $mce_css ) )
//        $mce_css .= ',';
//
//    $mce_css .= plugins_url( 'css/ct-editor-style.css', dirname(__FILE__) );
//    return $mce_css;
//}
//add_filter( 'mce_css', 'plugin_mce_css' );

//function wpb_mce_buttons_2($buttons) {
//    array_unshift($buttons, 'styleselect');
//	    return $buttons;
//	}
//add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

//function my_mce_before_init_insert_formats( $init_array ) {
//
//	    $style_formats = array(
//	        array(
//	            'title' => 'Courseticket Button',
//	            'block' => 'span',
//	            'classes' => 'courseticket-button',
//	            'wrapper' => true,
//
//	        ),
//	    );
//	    // Insert the array, JSON ENCODED, into 'style_formats'
//	    $init_array['style_formats'] = json_encode( $style_formats );
//
//	    return $init_array;
//
//	}
//	// Attach callback to 'tiny_mce_before_init'
//	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );