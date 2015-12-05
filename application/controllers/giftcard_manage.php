<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of giftcard_manage
 *
 * @author pbchen
 */
class giftcard_manage extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('giftcard_model');
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品
     */
    public function add_giftcard() {
        //no_load_bootstrap_plugins 
        //不加载 bootstrap.plugins.min.js 加载后影响图片上传插件 
        //默认是加载的
        if ($_POST) {
            $data = $this->giftcard_model->get_giftcard_params();
            $data['status'] = 1;
            if ($check_info = $this->goods_manage_model->check_goods_num($data['group_ids'], 1)) {
                json_out_put(return_model('3002', $check_info, NULL));
            }
            if ($insert_id = $this->giftcard_model->add_giftcard($data)) {
                json_out_put(return_model(0, '添加成功', $insert_id));
            } else {
                json_out_put(return_model('3001', '添加失败', NULL));
            }
        } else {
            $d = array('title' => '礼品册管理', 'msg' => '', 'no_load_bootstrap_plugins' => true);
            $d['theme'] = $this->theme_model->get_theme();
            $d['set'] = $this->set_model->get_set();
            $this->layout->view('giftcard_manage/add_giftcard', $d);
        }
    }
    
    /**
     * 加载编辑视图
     */
    public function edit_giftcard(){
        $id = $this->input->get('id');
        $d = array('title' => '编辑礼册', 'msg' => '', 'no_load_bootstrap_plugins' => true);
        $giftcard = $this->giftcard_model->get_giftcard_info(array('id'=>$id));
        $d['giftcard'] = $giftcard[0];
        $d['theme'] = $this->theme_model->get_theme();
        $d['set'] = $this->set_model->get_set();
        $this->layout->view('giftcard_manage/edit_giftcard', $d);
    }
    
    /**
     * 礼册列表
     */
    public function giftcard_list() {
        $d = array('title' => '礼册列表', 'msg' => '');
        $d['theme'] = $this->theme_model->get_theme();
        $d['set'] = $this->set_model->get_set();
        $this->layout->view('giftcard_manage/giftcard_list', $d);
    }
    
    /**
     * 礼册列表分页
     */
    public function giftcard_list_page() {
        $d = $this->giftcard_model->giftcard_page_data($this->data_table_parser);
        $this->load->view('json/datatable', $d);
    }
    
    /**
     * 更新停用&启用
     */
    public function update_giftcard(){
        $ids = $this->input->post('ids');
        $d['status'] = $this->input->post('status');
        if($remark=$this->input->post('remark')){
            $d['remark'] = $remark;
        }
        $this->db->where_in('id',$ids);
        $aff_row = $this->giftcard_model->update_giftcard_info($d);
        json_out_put(return_model(0, '添加成功', $aff_row));
    }
    
    /**
     * 编辑商品
     */
    public function update_giftcard_info(){
        $giftcard_id = $this->input->post('id');
        $data = $this->giftcard_model->get_giftcard_params();
        if ($check_info = $this->goods_manage_model->check_goods_num($data['group_ids'])) {
            json_out_put(return_model('3002', $check_info, NULL));
        }
        $affect_row = $this->giftcard_model->update_giftcard_info($data,array('id'=>$giftcard_id));
        if (is_numeric($affect_row)) {
            json_out_put(return_model(0, '更新成功', $affect_row));
        } else {
            json_out_put(return_model('3001', '更新失败', NULL));
        }
    }
    
    /**
     * 礼品卡库列表
     */
    public function giftcard_inventory(){
        $d = array('title' => '礼品卡库', 'msg' => '');
        $this->layout->view('giftcard_manage/giftcard_inventory', $d);
    }
    
    /**
     * 退卡列表
     */
    public function cancel_giftcard(){
        $d = array('title' => '退卡列表', 'msg' => '');
        $this->layout->view('giftcard_manage/cancel_giftcard', $d);
    }
    
    
}
