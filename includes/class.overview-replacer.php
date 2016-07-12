<?php

class OverviewReplacer
{
    private static $instance;

    protected $templates;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new OverviewReplacer();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_filter('the_content', 'OverviewReplacer::replace', 1);
    }

    public static function replace($content)
    {
        $regex = '@(.|\n)*(' . Setup::getOverviewText() . ')(.|\n)*@im';

        if (get_option('embed_html')) {
            $replace = "self::get_html";
        } else {
            $replace = "self::get_js_link";
        }
        $replace = "self::get_js_link";// TODO implement get_js_link

        $lastContent = null;
        while ($lastContent != $content) {
            $lastContent = $content;
            $content = preg_replace_callback($regex, $replace, $content);
        }
        return $content;
    }
    
    public static function get_js_link($m)
    {
        $code = '<div class="courseticket-events" data-uid="'
                . get_option('ct_id')
                . '" data-options="limit:9;hidesearch:0;lang:'.ct_get_lang().';order:event_price;showmenu:1"></div>';
        return $code;
    }

    public static function get_html($array)
    {
        $url = Requester::htmlRequest($array);
        $html = Requester::getHtml($url);
        
        return $html."\n";
    }
}