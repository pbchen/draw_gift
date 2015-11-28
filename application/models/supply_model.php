<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of supply_model
 * 供应商模型
 * @author pbchen
 */
class supply_model extends CI_Model {
    
    private $_supply_tb = '`gift_management`.`gift_supply`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取供应商列表
     * @param type $where
     */
    public function get_suppley($where=array('status'=>1)){
        $this->db->select('*')->from($this->_supply_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
