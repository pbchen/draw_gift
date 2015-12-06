<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bookgoods_model
 *
 * @author pbchen
 */
class bookgoods_model extends CI_Model {
    
    private $_bg_mapping_tb = '`gift_management`.`book_goods_mapping`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 修改或添加礼册的商品数量
     */
    public function replace_into_bg($data){
        $this->db->replace($this->_bg_mapping_tb, $data);
        return $this->db->affected_rows();
    }
    
}
