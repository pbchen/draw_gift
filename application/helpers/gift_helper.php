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

//角色ID转化汉字
if( ! function_exists('role_translate') ){
    function role_translate($role_id,$role_config){
        return isset($role_config[$role_id])?$role_config[$role_id]:'';
    }
}

//guid
if( ! function_exists('create_guid') ){
    function create_guid(){
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
}

//json out put
if( ! function_exists('json_out_put') ){
    function json_out_put($d){
        die(json_encode($d));
    }
}
//return model 数据输出模型
if( ! function_exists('return_model') ){
    function return_model($errCode=0,$msg='',$val=array()){
        return array('errCode'=>$errCode,'msg'=>$msg,'val'=>$val);
    }
}
//数据下载
if( ! function_exists('download_model') ){
    function download_model($header=array(),$d=array(),$fsuffix='.csv'){
        $word_split = ',';
        $line_split = "\n";
        if($fsuffix=='.tsv') $word_split = "\t";
        $content = '';
        if(is_array($header)&& count($header)>0){
            $content .= implode($word_split, $header);
            $content .= $line_split;
        }
        if(is_array($d) && count($d)>0){
            foreach ($d as $v){
                $content .= implode($word_split, $v);
                $content .= $line_split;
            }
        }
        $content = iconv("UTF-8","gbk//TRANSLIT",$content);
        $fname = date('YmdHis') . $fsuffix;
        Header('Content-type:appliction/octet-stream');
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:" . strlen($content));
        Header("Content-Disposition:attachment;filename=".$fname);
        die($content);
    }
}

