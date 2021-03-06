<?php

/**
 * @filename login.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-23  22:30:53
 * @Description
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('uc_service', array('cfg'=>$this->config->item('alw_uc')));
    }

    public function index() {
        $d = array('title' => '用户登录', 'msg' => '测试');
        $this->layout->view('welcome_message', $d);
    }
    
    /**
     * 登录
     */
    public function login() {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        $user = $this->login_model->login($user_name,$password);
        if($user && $this->uc_service->save_user($user)){
            redirect('/member/user_info');
        }else{
            $d = array('title' => '用户登录', 'msg' => '用户名或密码错误！');
            $this->load->view('login/index',$d);
        }
    }
    
    /**
     * 登出
     */
    public function logout(){
        $this->uc_service->logout();
    }

}
