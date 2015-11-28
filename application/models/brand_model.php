<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of brand_model
 * 商品品牌模型
 * @author pbchen
 */
class brand_model extends CI_Model {
    
    private $_brand_tb = '`gift_management`.`gift_brand`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取品牌列表
     * @param type $where
     */
    public function get_brand($where=array('status'=>1)){
        $this->db->select('*')->from($this->_brand_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
