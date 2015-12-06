<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classify_model
 * 商品分类模型
 * @author pbchen
 */
class classify_model extends CI_Model {
    
    private $_classify_tb = '`gift_management`.`gift_classify`';
    const CLASSIFY_START_STATUS = 1;
    const CLASSIFY_STOP_STATUS = 2;
    private $_classify_status = array(
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
    public function get_classify_status(){
        return $this->_classify_status;
    }
    
    /**
     * 获取分类列表
     * @param type $where
     */
    public function get_classify($where=array('status'=>1)){
        $this->db->select('*')->from($this->_classify_tb);
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
    public function get_classify_page_where(){
        $cwhere = array();
        if (isset($_REQUEST['id']) && $_REQUEST['id']!=0) {
            $cwhere['`gift_classify`.`id`'] = $_REQUEST['id'];
        }
        if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
            $cwhere['`gift_classify`.`name` LIKE '] = '%'.$_REQUEST['name'].'%';
        }
        if (isset($_REQUEST['status']) && $_REQUEST['status']!=0) {
            $cwhere['`gift_classify`.`status`'] = $_REQUEST['status'];
        }
        return $cwhere;
    }
    
    /**
     * 添加分类
     * @param type $goods_info
     * @return type
     */
    public function add_classify($classify_info){
        $this->db->insert($this->_classify_tb, $classify_info);
        return $this->db->insert_id();
    }
    
    /**
     * 更新商品信息
     * @param array $updata
     * @param type $where
     * @param type $where_in
     * @return type
     */
    public function update_classify_info($updata,$where=array()){
        if($where){
            $this->db->where($where);
        }
        $this->db->update($this->_classify_tb,$updata);
        return $this->db->affected_rows();
    }
    
     /**
     * 获取分类分页数据
     * @param type $dtparser datatable类库
     */
    public function classify_page_data($dtparser){
        $cols = array('`gift_classify`.`id`','`gift_classify`.`name`','`gift_classify`.`status`'
            ,'IF(`gift`.`id`IS NULL,0,COUNT(DISTINCT(`gift`.`id`))) AS `goods_num`','`gift_classify`.`remark`');
        $sort_cols = array('4'=>'`goods_num`');
        $filter_cols = array();
        //查询主表
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($this->_classify_tb);
        $dtparser->join('`gift_management`.`gift`', 'gift.classify_id=gift_classify.id', 'left');
        $group = array('`gift_classify`.`id`');
        //条件
        $cwhere = $this->get_classify_page_where();
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
            $v['status'] = isset($this->_classify_status[$v['status']])?$this->_classify_status[$v['status']]:'';
        }
    }
    
    /**
     * 检查更新分类信息
     * @param type $group_goods
     * @return string
     */
    public function check_classify_update($classify_ids,$status){
        $ret = '分类ID:';
        if($status==self::CLASSIFY_STOP_STATUS){
            $goods = $this->goods_manage_model->get_goods_groupby_col('classify_id',$classify_ids);
            foreach($goods as $k=>$v){
                if($v && intval($v)>0) $ret .= $k . '下有' . $v . '个商品,';
            }
        }
        $ret = $ret=='分类ID:' ? '' : $ret;
        return $ret;
    }
}
