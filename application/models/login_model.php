<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author pbchen
 */
class Login_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    /**
     * 登录
     * @param type $user_name
     * @param type $password
     */
    public function login($user_name,$password){
        $password = md5($password);
        $user = $this->user_model->get_user(array('user_name'=>$user_name,'password'=>$password));
        if( $user && count($user)>0 ){
            return $user[0];
        }else{
            return false;
        }
    }

}
