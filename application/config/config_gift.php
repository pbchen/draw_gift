<?php  
/**
 * @filename config_gift.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-22  20:07:02
 * @Description 礼品卡项目配置
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//时区设置
date_default_timezone_set('Asia/Shanghai');

//静态资源目录配置
if( ! defined('RES') ){
    define('RES', '/res/');
}

//文件上传存放路径
if( ! defined('UPLOAD') ){
    define('UPLOAD', '/upfile/');
}

//默认每页条数
if( ! defined('PER_PAGE') ){
    define('PER_PAGE', 10);
}
if(! defined('IMAGE_SERVER')){
    define('IMAGE_SERVER', 'http://localhost/server/php/');
}
//上传文件路径
$config['upload_path'] = "D:/work/git/dc/upfile/";

$config['alw_uc'] = array(
    'auto_check'=>true,
    'login'=>'/login/login',
);

/**
 * 缩略图配置
 */
$config['thumb_img'] = array(
    'image_library'=>'gd2',
    'source_image'=>UPLOAD . 'img/',
    'create_thumb'=>true,
    'maintain_ratio'=>true,
    'width'=>50,
    'height'=>60
);








