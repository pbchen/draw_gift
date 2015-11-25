<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author pbchen
 */
class User_model extends CI_Model {
    
    private $_user_tb = '`gift_management`.`user`';
    
    function __construct() {
        parent::__construct();
        $this->load->model('role_model');
    }
    
    /**
     * 获取数据库中的用户信息
     * @param type $where
     * @return type
     */
    public function get_user($where=array()){
        $this->db->select('`id`,`user_name`,`password`,`nick_name`,`email`,`phone`,`role`,`create_time`');
        $this->db->from($this->_user_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $role = $this->role_model->get_role();
        $user = array();
        foreach($query->result_array() as $row){
            $row['role_name'] = isset($role[$row['role']])?$role[$row['role']]:'';
            $user[] = $row;
        }
        return $user;
    }
    
    /**
     * 修改用户信息
     * @param type $user_id
     * @param type $update_info
     * @return type
     */
    public function update_user_info($user_id,$update_info){
        $this->db->where('id', $user_id);
        $this->db->update($this->_user_tb, $update_info);
        return $this->db->affected_rows();
    }
    
}
