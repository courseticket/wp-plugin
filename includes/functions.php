<?php

function ct_get_lang() {
    $exploded = explode('-', get_bloginfo( 'language' ));
    $langUrl = $exploded[0];
    if (in_array($langUrl, array('de', 'es'))) {
        return $langUrl;
    }
    return 'en';
}