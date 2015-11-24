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
    
    private $_user_tb = '`gift_management`.`user`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取数据库中的用户信息
     * @param type $where
     * @return type
     */
    private function _get_db_user($where=array()){
        $this->db->select('`id`,`user_name`,`nick_name`,`email`,`phone`,`role`,`create_time`');
        $this->db->from($this->_user_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * 登录
     * @param type $user_name
     * @param type $password
     */
    public function login($user_name,$password){
        $password = md5($password);
        $user = $this->_get_db_user(array('user_name'=>$user_name,'password'=>$password));
        if( $user && count($user)>0 ){
            return $user[0];
        }else{
            return false;
        }
    }

}
