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
    //单品
    const SINGLE_GOODS_TYPE = 1;
    //组合商品
    const MULTIPLE_GOODS_TYPE = 2;
    //商品状态
    private $_goods_status = array(
                '1' => '上架',
                '2' => '下架'
            );
    //商品组合形式
    private $_goods_type = array(
                '1' => '单品',
                '2' => '组合'
            );
    
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
     * 获取列表条件
     * @return type
     */
    public function get_goods_page_where(){
        $cwhere = array();
        if (isset($_REQUEST['id']) && $_REQUEST['id']!=0) {
            $cwhere['`gift`.`id`'] = $_REQUEST['id'];
        }
        if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
            $cwhere['`gift`.`name` LIKE '] = '%'.$_REQUEST['name'].'%';
        }
        if (isset($_REQUEST['status']) && $_REQUEST['status']!=0) {
            $cwhere['`gift`.`status`'] = $_REQUEST['status'];
        }
        if (isset($_REQUEST['type']) && $_REQUEST['type']!=0) {
            $cwhere['`gift`.`id`'] = $_REQUEST['type'];
        }
        if (isset($_REQUEST['supply']) && $_REQUEST['supply']!=0) {
            $cwhere['`gift`.`supply_id`'] = $_REQUEST['supply'];
        }
        if (isset($_REQUEST['classify']) && $_REQUEST['classify']!=0) {
            $cwhere['`gift`.`classify_id`'] = $_REQUEST['classify'];
        }
        if (isset($_REQUEST['brand']) && $_REQUEST['brand']!=0) {
            $cwhere['`gift`.`brand_id`'] = $_REQUEST['brand'];
        }
        return $cwhere;
    }
    
    /**
     * 商品分页列
     */
    private function _goods_page_cols(){
        
        return $cols = array('`gift`.`id` AS `id`', '`gift`.`name` AS `g_name`'
                , '`gift`.`type`','`gift`.`store_num`', '`gift`.`sold_num`'
                ,'`gift`.`status`','`gift_brand`.`name` AS `b_name`'
                ,'`gift_classify`.`name` AS `c_name`','`gift_supply`.`name` AS `s_name`'
            );
    }
    
    /**
     * 获取商品分页数据
     * @param type $dtparser datatable类库
     */
    public function goods_page_data($dtparser){
        $cols = $this->_goods_page_cols();
        $sort_cols = array('4'=>'`gift`.`store_num`');
        $filter_cols = array();
        //查询主表
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($this->_goods_tb);
        $dtparser->join('`gift_management`.`gift_brand`', 'gift_brand.id=gift.brand_id', 'left');
        $dtparser->join('`gift_management`.`gift_classify`', 'gift_classify.id=gift.classify_id', 'left');
        $dtparser->join('`gift_management`.`gift_supply`', 'gift_supply.id=gift.supply_id', 'left');
        //条件
        $cwhere = $this->get_goods_page_where();
        $d['code'] = 0;
        $d['iTotal'] = 0;
        $d['iFilteredTotal'] = 0;
        $d['aaData'] = array();
        if( $d['code'] == 0 ){
            $d['iTotal'] = $dtparser->count($cwhere);
            $d['iFilteredTotal'] = $d['iTotal'];
            $query = $dtparser->get($cwhere);
            $arr = $query->result_array();
            $this->ajax_goods_list_table_data($arr);
            $d['aaData']=$arr;
        }
        return $d;
    }
    
    /**
     * 导出商品
     * @return type
     */
    public function download_goods_data(){
        $cols = $this->_goods_page_cols();
        $cwhere = $this->get_goods_page_where();
        $this->db->select($cols);
        $this->db->from($this->_goods_tb);
        $this->db->join('`gift_management`.`gift_brand`', 'gift_brand.id=gift.brand_id', 'left');
        $this->db->join('`gift_management`.`gift_classify`', 'gift_classify.id=gift.classify_id', 'left');
        $this->db->join('`gift_management`.`gift_supply`', 'gift_supply.id=gift.supply_id', 'left');
        if($cwhere){
            $this->db->where($cwhere);
        }
        $query = $this->db->get();
        $arr = $query->result_array();
        $this->ajax_goods_list_table_data($arr);
        $fun = function(&$val,$k){
            if(isset($val['checkbox'])){
                unset($val['checkbox']);
            }
            if(isset($val['oper'])){
                unset($val['oper']);
            }
        };
        array_walk($arr, $fun);
        return $arr;
    }
    
    /**
     * 检查商品个数
     * @param type $group_goods
     * @return string
     */
    public function check_goods_num($group_goods,$inventory=1){
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
    
    /**
     * 获取商品信息
     * @param type $where
     */
    public function get_goods_info($where=array()){
        $this->db->select('*')->from($this->_goods_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * 更新商品信息
     * @param array $updata
     * @param type $where
     * @param type $where_in
     * @return type
     */
    public function update_goods_info($updata,$where=array()){
        $updata['utime'] = date('Y-m-d H:i:s');
        if($where){
            $this->db->where($where);
        }
        $this->db->update($this->_goods_tb,$updata);
        return $this->db->affected_rows();
    }
    
    /**
     * 转化前端datatable要求的样式
     * @param type $pageData
     */
    public function ajax_goods_list_table_data(&$pageData){
        foreach($pageData as &$v){
            $v['checkbox'] = "<input name='row_sel' type='checkbox' id='{$v['id']}'>";
            $v['oper'] = "<a rel='{$v['id']}'class='edit oper'href='/goods_manage/edit_goods?id={$v['id']}'>编辑</a>";
            //$v['oper'] .= "<a rel='{$v['id']}'class='minus oper'>&nbsp;&nbsp;&nbsp;出库</a>";
            //$v['oper'] .= "<a rel='{$v['id']}'class='add oper'>&nbsp;&nbsp;&nbsp;入库</a>";
            $v['status'] = isset($this->_goods_status[$v['status']])?$this->_goods_status[$v['status']]:'';
            $v['type'] = isset($this->_goods_type[$v['type']])?$this->_goods_type[$v['type']]:'';
        }
    }
    
    /**
     * 通过字段值条件获取商品
     * @param type $col_name
     * @param type $val_arr
     */
    public function get_goods_groupby_col($col_name,$val_arr){
        $cols = array('count(*) as `num`',$col_name);
        $this->db->select($cols)->from($this->_goods_tb);
        $this->db->where_in($col_name,$val_arr);
        $this->db->group_by($col_name);
        $query = $this->db->get();
        $result = array();
        foreach($query->result() as $row){
            $result[$row->$col_name] = $row->num;
        }
        return $result;
    }
    
}
