<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of supply_model
 * 商品供应商模型
 * @author pbchen
 */
class supply_model extends CI_Model {
    
    private $_supply_tb = '`gift_management`.`gift_supply`';
    const SUPPLY_START_STATUS = 1;
    const SUPPLY_STOP_STATUS = 2;
    private $_supply_status = array(
        '1' => '使用',
        '2' => '停用'
    );
    
    function __construct() {
        $this->load->model('goods_manage_model');
        parent::__construct();
    }
    
    /**
     * 状态
     * @return type
     */
    public function get_supply_status(){
        return $this->_supply_status;
    }
    
    /**
     * 获取供应商列表
     * @param type $where
     */
    public function get_supply($where=array('status'=>1)){
        $this->db->select('*')->from($this->_supply_tb);
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * 获取列表条件
     * @return type
     */
    public function get_supply_page_where(){
        $cwhere = array();
        if (isset($_REQUEST['id']) && $_REQUEST['id']!=0) {
            $cwhere['`gift_supply`.`id`'] = $_REQUEST['id'];
        }
        if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
            $cwhere['`gift_supply`.`name` LIKE '] = '%'.$_REQUEST['name'].'%';
        }
        if (isset($_REQUEST['status']) && $_REQUEST['status']!=0) {
            $cwhere['`gift_supply`.`status`'] = $_REQUEST['status'];
        }
        if (isset($_REQUEST['contact']) && $_REQUEST['contact']!=0) {
            $cwhere['`gift_supply`.`contact_person` LIKE '] = '%'.$_REQUEST['contact'].'%';
        }
        if (isset($_REQUEST['phone']) && $_REQUEST['phone']!=0) {
            $cwhere['`gift_supply`.`phone` LIKE '] = '%'.$_REQUEST['phone'].'%';
        }
        if (isset($_REQUEST['qq']) && $_REQUEST['qq']!=0) {
            $cwhere['`gift_supply`.`qq` LIKE '] = '%'.$_REQUEST['qq'].'%';
        }
        return $cwhere;
    }
    
    /**
     * 添加供应商
     * @param type $goods_info
     * @return type
     */
    public function add_supply($supply_info){
        $this->db->insert($this->_supply_tb, $supply_info);
        return $this->db->insert_id();
    }
    
    /**
     * 更新商品信息
     * @param array $updata
     * @param type $where
     * @param type $where_in
     * @return type
     */
    public function update_supply_info($updata,$where=array()){
        if($where){
            $this->db->where($where);
        }
        $this->db->update($this->_supply_tb,$updata);
        return $this->db->affected_rows();
    }
    
     /**
     * 获取供应商分页数据
     * @param type $dtparser datatable类库
     */
    public function supply_page_data($dtparser){
        $cols = array('`gift_supply`.`id`','`gift_supply`.`name`','`gift_supply`.`status`'
            ,'IF(`gift`.`id`IS NULL,0,COUNT(DISTINCT(`gift`.`id`))) AS `goods_num`'
            ,'`gift_supply`.`remark`','`contact_person`','`phone`','`qq`');
        $sort_cols = array('4'=>'`goods_num`');
        $filter_cols = array();
        //查询主表
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($this->_supply_tb);
        $dtparser->join('`gift_management`.`gift`', 'gift.supply_id=gift_supply.id', 'left');
        $group = array('`gift_supply`.`id`');
        //条件
        $cwhere = $this->get_supply_page_where();
        $d['code'] = 0;
        $d['iTotal'] = 0;
        $d['iFilteredTotal'] = 0;
        $d['aaData'] = array();
        if( $d['code'] == 0 ){
            $d['iTotal'] = $dtparser->count_group($group,$cwhere);
            $d['iFilteredTotal'] = $d['iTotal'];
            $query = $dtparser->get_group($group, $cwhere);
            $arr = $query->result_array();
            $this->ajax_list_table_data($arr);
            $d['aaData']=$arr;
        }
        return $d;
    }
    
    /**
     * 转化前端datatable要求的样式
     * @param type $pageData
     */
    public function ajax_list_table_data(&$pageData){
        foreach($pageData as &$v){
            $v['checkbox'] = "<input name='row_sel' type='checkbox' id='{$v['id']}'>";
            $v['oper'] = "<a rel='{$v['id']}'class='edit oper'>编辑</a>";
            $v['oper'] .= "<a rel='{$v['id']}'class='load oper'>&nbsp;&nbsp;&nbsp;导入</a>";
            $v['status'] = isset($this->_supply_status[$v['status']])?$this->_supply_status[$v['status']]:'';
        }
    }
    
    /**
     * 检查更新供应商信息
     * @param type $group_goods
     * @return string
     */
    public function check_supply_update($supply_ids,$status){
        $ret = '供应商ID:';
        if($status==self::SUPPLY_STOP_STATUS){
            $goods = $this->goods_manage_model->get_goods_groupby_col('supply_id',$supply_ids);
            foreach($goods as $k=>$v){
                if($v && intval($v)>0) $ret .= $k . '下有' . $v . '个商品,';
            }
        }
        $ret = $ret=='供应商ID:' ? '' : $ret;
        return $ret;
    }
    
}
