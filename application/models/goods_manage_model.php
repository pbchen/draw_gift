<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of goods_manage_model
 *
 * @author pbchen
 */
class goods_manage_model extends CI_Model {
    
    private $_goods_tb = '`gift_management`.`gift`';
    const SINGLE_GOODS_TYPE = 1;
    const MULTIPLE_GOODS_TYPE = 2;
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取商品参数
     * @return type
     */
    public function get_goods_params(){
        $data['name'] = $this->input->post('name');
        $data['type'] = $this->input->post('type');
        $data['groupid'] = $this->input->post('groupid');
        if($data['type']==self::SINGLE_GOODS_TYPE){
            $data['classify_id'] = $this->input->post('classify_id');
            $data['brand_id'] = $this->input->post('brand_id');
            $data['supply_id'] = $this->input->post('supply_id');
        }
        $data['sale_price'] = $this->input->post('sale_price');
        $data['buy_price'] = $this->input->post('buy_price');
        $data['store_num'] = $this->input->post('store_num');
        $data['munit'] = $this->input->post('munit');
        $data['pic_ids'] = $this->input->post('pic_ids');
        $data['deliver_id'] = $this->input->post('deliver_id');
        $data['desciption'] = $this->input->post('desciption');
        $data['remark'] = $this->input->post('remark');
        return $data;
    }
    
    /**
     * 检查商品个数
     * @param type $group_goods
     * @return string
     */
    public function check_goods_num($group_goods,$inventory){
        $goods = array();
        $group_good_arr = explode(',', $group_goods);
        $ret = '商品ID:';
        foreach ($group_good_arr as $g){
            if( ! $g )  continue;
            $g_info = explode('*', $g);
            $goods[$g_info[0]] = isset($g_info[1])?$g_info[1]*$inventory:$inventory;
        }
        $goods_num = $this->get_goods_num(array_keys($goods));
        foreach($goods as $k=>$v){
            if(!isset($goods_num[$k]) OR ($v>$goods_num[$k])){
                $maind = isset($goods_num[$k])?$goods_num[$k]:0;
                $ret .= $k .' 超出：' . ($v - $maind) . '个, ';
            }
        }
        $ret = $ret=='商品ID:' ? '' : $ret;
        return $ret;
    }
    
    /**
     * 获取商品库存
     * @param type $good_ids
     * @return type
     */
    public function get_goods_num($good_ids){
        $this->db->select('store_num,id')->from($this->_goods_tb);
        $this->db->where_in('id',$good_ids);
        $query = $this->db->get();
        $goods_num = array();
        foreach($query->result() as $row){
            $goods_num[$row->id] = $row->store_num;
        }
        return $goods_num;
    }
    
    /**
     * 添加商品
     * @param type $goods_info
     * @return type
     */
    public function add_goods($goods_info){
        $this->db->insert($this->_goods_tb, $goods_info);
        return $this->db->insert_id();
    }
    
    
    
    
    
}
