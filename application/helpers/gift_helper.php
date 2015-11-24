<?php

/**
 * @filename gift_helper.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-23  14:10:07
 * @Description
 */

//导航权限
if( ! function_exists('nav_item_display') ){
    function nav_item_display($display_role,$user_role){
        if( ! is_array($user_role) ){
            $user_role = array($user_role);
        }
        if( array_intersect($display_role, $user_role) ){
            return true;
        }else{
            return false;
        }
    }
}

//guid
if( ! function_exists('create_guid') ){
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12);
            
    return $uuid;
}


