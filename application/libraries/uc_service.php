<?php

/**
 * @filename uc_service.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-23  22:04:39
 * @Description
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('ALW_SESSION', 'Alw.Session');
define('ALW_REDIRECT', 'Alw.Redirect');

class Uc_service {

    var $obj;
    var $cfg;

    /**
     * 构造方法
     * @param params UC配置
     * 
     */
    function __construct($param) {
        $this->obj = &get_instance();
        $this->cfg = $param['cfg'];
        if ($this->cfg['auto_check']) {
            $this->check_login(TRUE);
        }
    }

    /**
     * 设置UC的配置信息
     * @access public
     * @param cfg UC配置
     */
    public function setConfig($cfg) {
        $this->cfg = $cfg;
    }

    /**
     * 退出方法
     * @access public
     * @param auto_redirect 是否自动重定向
     */
    public function logout($auto_redirect = TRUE) {
        $this->obj->session->sess_destroy();
        if ($auto_redirect) {
            redirect($this->cfg['login']);
        }
    }

    /**
     * 判断用户是否登录
     * @access public
     * @return bool TRUE 登录 FALSE 未登录
     */
    public function is_login() {
        if ($this->obj->session->userdata(ALW_SESSION)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 检查是否需要登录
     * @access public
     * @param auto_redirect 未登录用户是否自动跳转，默认跳转 
     * @return 空或者用户信息
     */
    public function check_login($auto_redirect = TRUE) {
        $user = $this->get_user();
        $uri = uri_string();
        //没有登录以及当前Url不是登录Url
        if (!$user && !$this->is_login_url($uri)) {
            $this->obj->session->set_userdata(ALW_REDIRECT, $uri);
            if ($auto_redirect) {
                redirect($this->cfg['login']);
            }
        } else {
            return $user;
        }
    }
    
    /**
     * 获取用户信息
     * @access public
     * @return 空或者用户信息
     * 
     */
    public function get_user() {
        return $this->obj->session->userdata(ALW_SESSION);
    }

    /**
     * 获取用户id信息
     * @access public
     * @return -1或者用户id
     */
    public function get_user_id() {
        $user = $this->get_user();
        if ( $user ) {
            return $user['user_id'];
        } else {
            return -1;
        }
    }
    
    /**
     * 获取用户名称
     * @param type $default
     * @return type
     */
    public function get_user_name($default='游客'){
        $user = $this->obj->session->userdata(ALW_SESSION);
        if($user){
            return $user['nick_name']?$user['nick_name']:$user['user_name'];
        }else{
            return $default;
        }
    }
    
    /**
     * 获取用户角色
     * @return type
     */
    public function get_user_role(){
        $user = $this->obj->session->userdata(ALW_SESSION);
        if($user){
            return $user['role'];
        }else{
            return null;
        }
    }
    
    /**
     * 缓存用户信息
     * @param type $user_data
     */
    public function save_user($user_data){
        $this->obj->session->set_userdata(ALW_SESSION, $user_data);
        return true;
    }

    /**
     * 判断当前Url是否是登录页面
     * @access private
     * @param uri 要判断的Url
     * @return boolean
     */
    function is_login_url($uri = NULL) {
        if ( ! $uri ) {
            $uri = uri_string();
        }
        if ( stristr($uri, trim($this->cfg['login'], "/")) ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
