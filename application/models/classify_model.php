<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classify_model
 * 商品分类模型
 * @author pbchen
 */
class classify_model extends CI_Model {
    
    private $_classify_tb = '`gift_management`.`gift_classify`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取分类列表
     * @param type $where
     */
    public function get_classify($where=array('status'=>1)){
        $this->db->select('*')->from($this->_classify_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
