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
                    $d = array('title' => '修改密码','old_msg'=>'旧密码不正确！','msg'=>'');
                }else{
                    $md5_pwd = md5($new_pwd);
                    $this->user_model->update_user_info($user['id'],array('password'=>$md5_pwd));
                    $this->uc_service->logout();
                    redirect('/login/login');
                }
            }else{
                $d = array('title' => '修改密码','msg'=>'密码不能为空！','old_msg'=>'');
            }
        }else{
            $d = array('title' => '修改密码','msg'=>'','old_msg'=>'');
        }
        $this->layout->view('member/change_password', $d);
    }
    
    /**
     * 修改用户信息
     */
    public function change_info() {
        $user = $this->uc_service->get_user();
        $d = array('title' => '修改资料', 'msg' => '','user'=>$user);
        if($_POST){
            $updata['nick_name'] = $user['nick_name'] = $this->input->post('nick_name');
            $updata['email'] = $user['email'] = $this->input->post('email');
            $updata['phone'] = $user['phone'] = $this->input->post('phone');
            $this->user_model->update_user_info($user['id'],$updata);
            $this->uc_service->save_user($user);
            redirect('/member/index');
        }
        $this->layout->view('member/change_info', $d);
    }

}
