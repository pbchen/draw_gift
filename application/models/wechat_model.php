<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wechat_model
 *
 * @author pbchen
 */
class wechat_model extends CI_Model {
    
    private $_wechat_tb = '`gift_management`.`wechat`';
    
    /**
     * 获取微信模板信息
     * @param type $where
     */
    public function get_wechat($where=array()){
        $this->db->select('*')->from($this->_wechat_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
