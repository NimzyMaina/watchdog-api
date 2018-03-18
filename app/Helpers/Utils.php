<?php
/**
 * Created by PhpStorm.
 * User: Maina
 * Date: 8/22/2017
 * Time: 1:44 PM
 */

function standardizephone($phone)
{
    return preg_replace('/^07/', '2547', $phone);
}

function localphone($phone)
{
    return preg_replace('/^254/', '0', $phone);
}

function get_org()
{
    $user = request()->user();

}

function seg($id)
{
    $val = request()->segment($id);

    if(is_numeric($val))
    {
        return request()->segment( (int)$id + 1)?:false;
    }
    return request()->segment($id)?:false;
}

/**
 * Generate a querystring url for the application.
 *
 * Assumes that you want a URL with a querystring rather than route params
 * (which is what the default url() helper does)
 *
 * @param  string  $path
 * @param  mixed   $qs
 * @param  bool    $secure
 * @return string
 */
function qs_url($path = null, $qs = array(), $secure = null)
{
    $url = app('url')->to($path, $secure);
    if (count($qs)){

        foreach($qs as $key => $value){
            $qs[$key] = sprintf('%s=%s',$key, urlencode($value));
        }
        $url = sprintf('%s?%s', $url, implode('&', $qs));
    }
    return $url;
}

