<?php
class ButtonReplacer
{
    private static $instance;

    public static $regex = '@^\s*((?:<span class="courseticket-button" title="([A-Za-z0-9 ]+)" data-options="([A-Za-z0-9 ;]+)" data-href="){0,1}?https?://(?:www\.)?(?:courseticket.com)(?:/([a-z]{2})/|/)e/([0-9]+)(">.*(?:</span>))?\s*)$@im';

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
//        var_dump($content);
//        $res = "";
//        for($i=0;$i<strlen($content);$i++){
//            $res .= "<p>.$content[$i].</p>";
//        }
//        return $res;

//        $content = '<span class="courseticket-button" title="Book now" data-options="showOrganizer;smallLayout" data-href="https://www.courseticket.com/de/e/316"> </span>';
        $content = preg_replace_callback(self::$regex, "ButtonReplacer::get_html", $content);
//        var_dump($content);
        return $content;
    }

    public static function get_html($m)
    {

        $dataOptions = null;
        if ($m[3]) {
            $dataOptions= '" data-options="'.$m[3];
        }
        $code = '<a class="courseticket-button" href="https://www.courseticket.com/'.$m[4].'/e/'.$m[5].$dataOptions.'">'.__('Book now').'</a>';
        return $code;
    }
}