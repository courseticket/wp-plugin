<?php

class Requester 
{
    public static function htmlRequest($m)
    {
        $data = array(
            'btn-href' => 'https://www.courseticket.com/'.$m[4].'/e/'.$m[5],
            'btn-referer' => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
            'btn-text' => $m[2],
            'btn-options' => $m[3]
        );

        return 'https://www.courseticket.com/'.$m[4].'/widgets/button/?'.http_build_query($data);
    }
    
    public static function getHtml($url)
    {
        $response = wp_remote_get($url);
        $html = $response['body'];
        
        return self::getBody($html);
    }
    
    public static function getBody($html)
    {
        $regex = '@[. ]*(<div id="main" class="ct-wdt">[\t\n\r\\p{L} -ÿ]*</div>)@im';;
        preg_match($regex, $html, $body);

        if (!isset($body[0])) {
            update_option('embed_html', '');
            return __('Plugin outdated');
        }
        return str_replace("\n", '', $body[0]);
    }
}
