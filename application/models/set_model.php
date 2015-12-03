<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of set_model
 *
 * @author pbchen
 */
class set_model extends CI_Model {

    private $_set_tb = '`gift_management`.`set`';

    const SET_START_STATUS = 1;
    const SET_STOP_STATUS = 2;
    
    private $_set_status = array(
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
    public function get_set($where=array('status'=>1)){
        $this->db->select('*')->from($this->_set_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}
