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
    
    public function index() {
        $d = array('title'=>'爱礼物','msg'=>'测试');
        $this->layout->view('welcome_message',$d);
    }
    
    public function change_password(){
        $d = array('title'=>'修改密码','msg'=>'测试');
        $this->layout->view('welcome_message',$d);
    }
    
    public function change_info(){
        $d = array('title'=>'修改资料','msg'=>'测试');
        $this->layout->view('welcome_message',$d);
    }
}

