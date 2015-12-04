<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of giftbook_manage
 *
 * @author pbchen
 */
class giftbook_manage extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('theme_model');
        $this->load->model('set_model');
        $this->load->model('giftbook_model');
        $this->load->model('goods_manage_model');
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品
     */
    public function add_giftbook() {
        //no_load_bootstrap_plugins 
        //不加载 bootstrap.plugins.min.js 加载后影响图片上传插件 
        //默认是加载的
        if ($_POST) {
            $data = $this->giftbook_model->get_giftbook_params();
            $data['status'] = 1;
            if ($check_info = $this->goods_manage_model->check_goods_num($data['group_ids'], 1)) {
                json_out_put(return_model('3002', $check_info, NULL));
            }
            if ($insert_id = $this->giftbook_model->add_giftbook($data)) {
                json_out_put(return_model(0, '添加成功', $insert_id));
            } else {
                json_out_put(return_model('3001', '添加失败', NULL));
            }
        } else {
            $d = array('title' => '礼品册管理', 'msg' => '', 'no_load_bootstrap_plugins' => true);
            $d['theme'] = $this->theme_model->get_theme();
            $d['set'] = $this->set_model->get_set();
            $this->layout->view('giftbook_manage/add_giftbook', $d);
        }
    }
    
    /**
     * 礼册列表
     */
    public function giftbook_list() {
        $d = array('title' => '礼册列表', 'msg' => '');
        $d['theme'] = $this->theme_model->get_theme();
        $d['set'] = $this->set_model->get_set();
        $this->layout->view('giftbook_manage/giftbook_list', $d);
    }
    
    /**
     * 礼册列表分页
     */
    public function giftbook_list_page() {
        $d = $this->giftbook_model->giftbook_page_data($this->data_table_parser);
        $this->load->view('json/datatable', $d);
    }
    
    /**
     * 更新停用&使用
     */
    public function update_giftbook(){
        $ids = $this->input->post('ids');
        $d['status'] = $this->input->post('status');
        if($remark=$this->input->post('remark')){
            $d['remark'] = $remark;
        }
        $this->db->where_in('id',$ids);
        $aff_row = $this->giftbook_model->update_giftbook_info($d);
        json_out_put(return_model(0, '添加成功', $aff_row));
    }
    
    
}
