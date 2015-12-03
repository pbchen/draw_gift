<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of theme_model
 *
 * @author pbchen
 */
class theme_model extends CI_Model {
    
    private $_theme_tb = '`gift_management`.`theme`';

    const THEME_START_STATUS = 1;
    const THEME_STOP_STATUS = 2;
    
    private $_theme_status = array(
        '1' => '使用',
        '2' => '停用'
    );
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取品牌列表
     * @param type $where
     */
    public function get_theme($where=array('status'=>1)){
        $this->db->select('*')->from($this->_theme_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
