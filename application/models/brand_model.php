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
    const BRAND_START_STATUS = 1;
    const BRAND_STOP_STATUS = 2;
    private $_brand_status = array(
        '1' => '启用',
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
    public function get_brand_status(){
        return $this->_brand_status;
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
    
    /**
     * 获取列表条件
     * @return type
     */
    public function get_brand_page_where(){
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
     * 添加品牌
     * @param type $goods_info
     * @return type
     */
    public function add_brand($brand_info){
        $this->db->insert($this->_brand_tb, $brand_info);
        return $this->db->insert_id();
    }
    
    /**
     * 更新商品信息
     * @param array $updata
     * @param type $where
     * @param type $where_in
     * @return type
     */
    public function update_brand_info($updata,$where=array()){
        if($where){
            $this->db->where($where);
        }
        $this->db->update($this->_brand_tb,$updata);
        return $this->db->affected_rows();
    }
    
     /**
     * 获取品牌分页数据
     * @param type $dtparser datatable类库
     */
    public function brand_page_data($dtparser){
        $cols = array('`gift_brand`.`id`','`gift_brand`.`name`','`gift_brand`.`status`'
            ,'IF(`gift`.`id`IS NULL,0,COUNT(DISTINCT(`gift`.`id`))) AS `goods_num`','`gift_brand`.`remark`');
        $sort_cols = array('4'=>'`goods_num`');
        $filter_cols = array();
        //查询主表
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($this->_brand_tb);
        $dtparser->join('`gift_management`.`gift`', 'gift.brand_id=gift_brand.id', 'left');
        $group = array('`gift_brand`.`id`');
        //条件
        $cwhere = $this->get_brand_page_where();
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
            $v['status'] = isset($this->_brand_status[$v['status']])?$this->_brand_status[$v['status']]:'';
        }
    }
    
    /**
     * 检查更新品牌信息
     * @param type $group_goods
     * @return string
     */
    public function check_brand_update($brand_ids,$status){
        $ret = '品牌ID:';
        if($status==self::BRAND_STOP_STATUS){
            $goods = $this->goods_manage_model->get_goods_groupby_col('brand_id',$brand_ids);
            foreach($goods as $k=>$v){
                if($v && intval($v)>0) $ret .= $k . '下有' . $v . '个商品,';
            }
        }
        $ret = $ret=='品牌ID:' ? '' : $ret;
        return $ret;
    }
    
}
