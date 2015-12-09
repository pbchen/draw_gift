<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of giftcard_model
 *
 * @author pbchen
 */
class giftcard_model extends CI_Model {
    
    private $_card_order_tb = '`gift_management`.`card_order`';
    
    private $_gift_card_tb = '`gift_management`.`gift_card`';
    
    private $_map_order_card_tb = '`gift_management`.`map_order_card`';
    
    private $_pay_status = array(
        '0' => '未付款',
        '1' => '已付款'
    );
            
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 后去下单参数
     */
    public function get_giftcard_order_params(){
        $data['sales_id'] = $this->input->post('sales');
        $data['trade_date'] = $this->input->post('trade_date');
        $data['custom_id'] = $this->input->post('customer');
        $data['wechat_id'] = $this->input->post('wechat');
        $data['expire_date'] = $this->input->post('expiration_date');
        $data['remark'] = trim($this->input->post('remark'));
        $data['gift_book_arr'] = $this->input->post('gift_book_arr');
        return $data;
    }
    
    /**
     * 添加订单
     * @param type $order_data
     */
    public function add_giftcard_order($order_data){
        $gift_books = $order_data['gift_book_arr'];
        unset($order_data['gift_book_arr']);
        $order_data['order_name'] = '';
        foreach($gift_books as $v){
            $order_data['order_name'] .= trim($v['gift_book_name']) . '*' . $v['num'];
        }
        $this->db->insert($this->_card_order_tb,$order_data);
        $order_id = $this->db->insert_id();
        return $order_id;
    }
    
    /**
     * 更新礼品卡订单信息
     * @param type $where
     * @param type $where_in
     */
    public function update_giftcard_order_info($updata,$where=array(),$where_in=array()){
        if($where){
            $this->db->where($where);
        }
        if($where_in){
            $this->db->where_in($where_in);
        }
        $this->db->update($this->_card_order_tb,$updata);
        return $this->db->affected_rows();
    }
    
    /**
     * 获取列表条件
     * @return type
     */
    public function get_giftcard_order_page_where(){
        $cwhere = array();
        if (isset($_REQUEST['id']) && $_REQUEST['id']!=0) {
            $cwhere['`gift_brand`.`id`'] = $_REQUEST['id'];
        }
        if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
            $cwhere['`gift_brand`.`name` LIKE '] = '%'.$_REQUEST['name'].'%';
        }
        if (isset($_REQUEST['status']) && $_REQUEST['status']!=0) {
            $cwhere['`gift_brand`.`status`'] = $_REQUEST['status'];
        }
        return $cwhere;
    }
    
   /**
    * 礼品卡开卡列表
    * @param type $dtparser
    * @return type
    */
    public function giftcard_order_list_page_data($dtparser){
        
        $cols = array('`card_order`.`id`','`card_order`.`trade_date`','`user`.`nick_name` as `sales`','`customer`.`name` as `customer`'
            ,'`card_order`.`contact_person`','`card_order`.`order_name`','`card_order`.`price`',
            '`card_order`.`pay_status`','`card_order`.`pay_remark`','`card_order`.`remark`');
        $sort_cols = array('6'=>'`price`');
        $filter_cols = array();
        //查询主表
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($this->_card_order_tb);
        $dtparser->join('`gift_management`.`user`', 'user.id=card_order.sales_id', 'left');
        $dtparser->join('`gift_management`.`customer`', 'customer.id=card_order.custom_id', 'left');
        
        //条件
        $cwhere = $this->get_giftcard_order_page_where();
        $d['code'] = 0;
        $d['iTotal'] = 0;
        $d['iFilteredTotal'] = 0;
        $d['aaData'] = array();
        if( $d['code'] == 0 ){
            $d['iTotal'] = $dtparser->count($cwhere);
            $d['iFilteredTotal'] = $d['iTotal'];
            $query = $dtparser->get($cwhere);
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
            $v['oper'] = "<a rel='{$v['id']}'class='showinfo oper'>查看</a>";
            $v['oper'] .= "<a rel='{$v['id']}'class='print oper'>&nbsp;&nbsp;&nbsp;打印</a>";
            $v['oper'] .= "<a rel='{$v['id']}'class='print oper'>&nbsp;&nbsp;&nbsp;编辑</a>";
            $v['oper'] .= "<a rel='{$v['id']}'class='print oper'>&nbsp;&nbsp;&nbsp;二维码</a>";
            $v['status'] = isset($this->_pay_status[$v['pay_status']])?$this->_pay_status[$v['pay_status']]:'';
        }
    }
    
}
