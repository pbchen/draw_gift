<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of goods_manage
 * 商品管理
 * @author pbchen
 */
class goods_manage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('brand_model');
        $this->load->model('classify_model');
        $this->load->model('supply_model');
        $this->load->model('deliver_model');
        $this->load->model('goods_manage_model');
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }

    /**
     * 添加商品
     */
    public function add_goods() {
        //no_load_bootstrap_plugins 
        //不加载 bootstrap.plugins.min.js 加载后影响图片上传插件 
        //默认是加载的
        if ($_POST) {
            $data = $this->goods_manage_model->get_goods_params();
            $data['ctime'] = $data['utime'] = date('Y-m-d H:i:s');
            $data['status'] = 1;
            $data['sold_num'] = 0;

            if ($data['type'] == goods_manage_model::MULTIPLE_GOODS_TYPE) {
                if ($check_info = $this->goods_manage_model->check_goods_num($data['groupid'], 1)) {
                    json_out_put(return_model('1002', $check_info, NULL));
                }
            }
            if ($insert_id = $this->goods_manage_model->add_goods($data)) {
                json_out_put(return_model(0, '添加成功', $insert_id));
            } else {
                json_out_put(return_model('1001', '添加失败', NULL));
            }
        } else {
            $d = array('title' => '商品管理', 'msg' => '', 'no_load_bootstrap_plugins' => true);
            $d['brand'] = $this->brand_model->get_brand();
            $d['classify'] = $this->classify_model->get_classify();
            $d['suppley'] = $this->supply_model->get_suppley();
            $d['deliver'] = $this->deliver_model->get_deliver();
            $this->layout->view('goods_manage/add_goods', $d);
        }
    }
    /**
     * 加载编辑视图
     */
    public function edit_goods(){
        $id = $this->input->get('id');
        $d = array('title' => '编辑商品', 'msg' => '', 'no_load_bootstrap_plugins' => true);
        $goods = $this->goods_manage_model->get_goods_info(array('id'=>$id));
        $d['goods'] = $goods[0];
        $d['brand'] = $this->brand_model->get_brand();
        $d['classify'] = $this->classify_model->get_classify();
        $d['suppley'] = $this->supply_model->get_suppley();
        $d['deliver'] = $this->deliver_model->get_deliver();
        $this->layout->view('goods_manage/edit_goods', $d);
    }

    /**
     * 商品列表
     */
    public function goods_list() {
        $d = array('title' => '商品列表', 'msg' => '');
        $d['brand'] = $this->brand_model->get_brand();
        $d['classify'] = $this->classify_model->get_classify();
        $d['suppley'] = $this->supply_model->get_suppley();
        $this->layout->view('goods_manage/goods_list', $d);
    }

    /**
     * 商品列表分页
     */
    public function goods_list_page() {
        $d = $this->goods_manage_model->goods_page_data($this->data_table_parser);
        $this->load->view('json/datatable', $d);
    }
    
    /**
     * 商品下载
     */
    public function download_goods(){
        $data = $this->goods_manage_model->download_goods_data();
        $header = array('商品名称','商品id','状态','库存','售出','供应商','分类'
            ,'品牌','组合形式');
        download_model($header, $data);
    }
    
    /**
     * 更新商品上架&下架
     */
    public function update_goods(){
        $ids = $this->input->post('ids');
        $d['status'] = $this->input->post('status');
        if($remark=$this->input->post('remark')){
            $d['remark'] = $remark;
        }
        $this->db->where_in('id',$ids);
        $aff_row = $this->goods_manage_model->update_goods_info($d);
        json_out_put(return_model(0, '添加成功', $aff_row));
    }
    /**
     * 编辑商品
     */
    public function update_goods_info(){
        $goods_id = $this->input->post('id');
        $data = $this->goods_manage_model->get_goods_params();
        if ($data['type'] == goods_manage_model::MULTIPLE_GOODS_TYPE) {
            if ($check_info = $this->goods_manage_model->check_goods_num($data['groupid'], 1)) {
                json_out_put(return_model('1002', $check_info, NULL));
            }
        }
        $affect_row = $this->goods_manage_model->update_goods_info($data,array('id'=>$goods_id));
        if (is_numeric($affect_row)) {
            json_out_put(return_model(0, '更新成功', $affect_row));
        } else {
            json_out_put(return_model('1001', '更新失败', NULL));
        }
    }
    
    /**
     * 品牌列表
     */
    public function brand_list(){
        $d = array('title' => '商品品牌列表', 'msg' => '');
        $this->layout->view('brand/brand_list', $d);
    }
    /**
     * 分类列表
     */
    public function classify_list(){
        $d = array('title' => '商品分类列表', 'msg' => '');
        $this->layout->view('classify/classify_list', $d);
    }
    /**
     * 供应商列表
     */
    public function supply_list(){
        $d = array('title' => '商品供应商列表', 'msg' => '');
        $this->layout->view('supply/supply_list', $d);
    }

}
