<?php

use Illuminate\Support\Facades\Cache;

function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() )
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function clear_cache()
{
    Cache::forget('recent_reviews');
    Cache::forget('recent_products');
    Cache::forget('global_categories');
    Cache::forget('global_archives');
    Cache::forget('global_tags');
}

//function getParentShowOf($param)
//{
//    $f = str_replace('admin.', '', $param);
//    $perm = Permission::where('as', $f)->first();
//    return $perm ? $perm->parent_show : $f;
//}
