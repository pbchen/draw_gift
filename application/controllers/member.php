<?php

/**
 * @filename member.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-23  15:02:08
 * @Description
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('user_model');
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }

    public function index() {
        $d['title'] = '用户信息';
        $d['user'] = $this->uc_service->get_user();
        $this->layout->view('member/user_info', $d);
    }
    
    /**
     * 修改密码
     */
    public function change_password() {
        if($_POST){
            $old_pwd = $this->input->post('old_pwd');
            $new_pwd = $this->input->post('password');
            if($new_pwd){
                $user = $this->uc_service->get_user();
                if(md5($old_pwd)!=$user['password']){
                    $d = array('title' => '修改密码','old_msg'=>'旧密码不正确！');
                }else{
                    $md5_pwd = md5($new_pwd);
                    $this->user_model->update_user_info($user['id'],array('password'=>$md5_pwd));
                    redirect('/member/index');
                }
            }else{
                $d = array('title' => '修改密码','msg'=>'密码不能为空！');
            }
        }else{
            $d = array('title' => '修改密码','msg'=>'');
        }
        $this->layout->view('member/change_password', $d);
    }

    public function change_info() {
        $d = array('title' => '修改资料', 'msg' => '测试');
        $this->layout->view('welcome_message', $d);
    }

}
