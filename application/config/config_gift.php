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
//默认每页条数
if( ! defined('PER_PAGE') ){
    define('PER_PAGE', 10);
}
if(! defined('IMAGE_SERVER')){
    define('IMAGE_SERVER', 'http://localhost/server/php/');
}
//上传文件路径
$config['upload_path'] = "/tmp";

$config['alw_uc'] = array(
    'auto_check'=>true,
    'login'=>'/login/login',
);








