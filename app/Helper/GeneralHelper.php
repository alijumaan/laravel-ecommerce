<?php

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Spatie\Valuestore\Valuestore;

function getSettingsOf($key)
{
    $settings = Valuestore::make(config_path('settings.json'));
    return $settings->get($key);
}

function getParentShowOf($param)
{
    $f = str_replace('admin.', '', $param);
    $perm = Permission::where('as', $f)->first();
    return $perm ? $perm->parent_show : $f;
}

function getParentOf($param)
{
    $f = str_replace('admin.', '', $param);
    $perm = Permission::where('as', $f)->first();
    return $perm ? $perm->parent : $f;
}

function getParentIdOf($param)
{
    $f = str_replace('admin.', '', $param);
    $perm = Permission::where('as', $f)->first();
    return $perm ? $perm->parent->id : null;
}

function getIdMenuOf($param)
{
    $perm = Permission::where('id', $param)->first();
    return $perm ? $perm->parent_show : null;
}

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
    Cache::forget('recent_comments');
    Cache::forget('recent_products');
    Cache::forget('global_categories');
    Cache::forget('global_archives');
    Cache::forget('global_tags');
}
