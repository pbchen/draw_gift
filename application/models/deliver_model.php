<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of deliver
 *
 * @author pbchen
 */
class deliver_model extends CI_Model {
    
    private $_deliver_tb = '`gift_management`.`deliver`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取快递列表
     * @param type $where
     */
    public function get_deliver($where=array('status'=>1)){
        $this->db->select('*')->from($this->_deliver_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
