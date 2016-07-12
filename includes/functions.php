<?php

function ct_get_lang() {
    $langUrl = explode('-', get_bloginfo( 'language' ))[0];
    if (in_array($langUrl, array('de', 'es'))) {
        return $langUrl;
    }
    return 'en';
}