<?php
class ButtonReplacer
{
    private static $instance;

    public static $regex = '@^\s*((?:<span class="courseticket-button" title="((?![><"])[ -ÿ]+)" contenteditable="false" data-options="([A-Za-z0-9 ;:]+){0,1}" data-href="){0,1}?https?://(?:www\.)?(?:courseticket.com)(?:/([a-z]{2})/|/)e/([0-9]+(?:/k:[a-zA-Z0-9]+){0,1})(">.*(?:</span>))?\s*)$@im';

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
        $dataOptions = null;
        if ($m[3]) {
            $dataOptions= '" data-options="'.$m[3];
        }
        $text = "Book now";
        if ($m[2]) {
            $text = $m[2];
        }
        $code = '<a class="courseticket-button" href="https://www.courseticket.com/'.$m[4].'/e/'.$m[5].$dataOptions.'">'.$text.'</a>';
        return $code;
    }
}