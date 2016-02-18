<?php
class ButtonReplacer
{
    private static $instance;

    public static $regex = '@^\s*(?:<span class="courseticket-button">)?https?://(?:www\.)?(?:courseticket.com)(?:/([a-z]{2})/|/)e/([0-9]+)(?:</span>)?\s*$@im';

    protected $templates;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new ButtonReplacer();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_filter('the_content', 'ButtonReplacer::replace', 1);
    }

    public static function replace($content)
    {
        $content = preg_replace_callback(self::$regex, "ButtonReplacer::get_html", $content);
        return $content;
    }

    public static function get_html($m)
    {
        $code = '<a class="courseticket-button" href="https://www.courseticket.com/'.$m[1].'/e/'.$m[2].'">'.__('Book now').'</a>';
        return $code;
    }
}