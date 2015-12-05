<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customer_model
 * 商品客户模型
 * @author pbchen
 */
class customer_model extends CI_Model {
    
    private $_customer_tb = '`gift_management`.`gift_customer`';
    private $_customer_status = array(
        '1' => '启用',
        '2' => '停用'
    );
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 状态
     * @return type
     */
    public function get_customer_status(){
        return $this->_customer_status;
    }
    
    /**
     * 获取客户列表
     * @param type $where
     */
    public function get_customer($where=array('status'=>1)){
        $this->db->select('*')->from($this->_customer_tb);
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
    public function get_customer_page_where(){
        $cwhere = array();
        if (isset($_REQUEST['id']) && $_REQUEST['id']!=0) {
            $cwhere['`gift_customer`.`id`'] = $_REQUEST['id'];
        }
        if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
            $cwhere['`gift_customer`.`name` LIKE '] = '%'.$_REQUEST['name'].'%';
        }
        if (isset($_REQUEST['status']) && $_REQUEST['status']!=0) {
            $cwhere['`gift_customer`.`status`'] = $_REQUEST['status'];
        }
        return $cwhere;
    }
    
    /**
     * 添加客户
     * @param type $goods_info
     * @return type
     */
    public function add_customer($customer_info){
        $this->db->insert($this->_customer_tb, $customer_info);
        return $this->db->insert_id();
    }
    
    /**
     * 更新商品信息
     * @param array $updata
     * @param type $where
     * @param type $where_in
     * @return type
     */
    public function update_customer_info($updata,$where=array()){
        if($where){
            $this->db->where($where);
        }
        $this->db->update($this->_customer_tb,$updata);
        return $this->db->affected_rows();
    }
    
     /**
     * 获取客户分页数据
     * @param type $dtparser datatable类库
     */
    public function customer_page_data($dtparser){
        $cols = array('`gift_customer`.`id`','`gift_customer`.`name`','`gift_customer`.`status`'
            ,'IF(`gift`.`id`IS NULL,0,COUNT(DISTINCT(`gift`.`id`))) AS `goods_num`','`gift_customer`.`remark`');
        $sort_cols = array('4'=>'`goods_num`');
        $filter_cols = array();
        //查询主表
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($this->_customer_tb);
        $dtparser->join('`gift_management`.`gift`', 'gift.customer_id=gift_customer.id', 'left');
        $group = array('`gift_customer`.`id`');
        //条件
        $cwhere = $this->get_customer_page_where();
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
            $v['status'] = isset($this->_customer_status[$v['status']])?$this->_customer_status[$v['status']]:'';
        }
    }
    
    /**
     * 检查更新客户信息
     * @param type $group_goods
     * @return string
     */
    public function check_customer_update($customer_ids,$status){
        $ret = '客户ID:';
        if($status==self::BRAND_STOP_STATUS){
            $goods = $this->goods_manage_model->get_goods_groupby_col('customer_id',$customer_ids);
            foreach($goods as $k=>$v){
                if($v && intval($v)>0) $ret .= $k . '下有' . $v . '个商品,';
            }
        }
        $ret = $ret=='客户ID:' ? '' : $ret;
        return $ret;
    }
    
}
