<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classify
 *
 * @author pbchen
 */
class classify extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('classify_model');
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品分类
     */
    public function add_classify(){
        $d['status'] = 1;
        $d['name'] = $this->input->post('name');
        $d['remark'] = $this->input->post('remark');
        if($id=$this->classify_model->add_classify($d)){
            json_out_put(return_model(0, '添加成功', $id));
        }else{
            json_out_put(return_model('2031', '添加失败', NULL));
        }
    }
    
    /**
     * 编辑分类
     */
    public function edit_classify(){
        $d['status'] = $this->input->post('status');
        $d['name'] = $this->input->post('name');
        $d['remark'] = $this->input->post('remark');
        $id = $this->input->post('id');
        if($check_info=$this->classify_model->check_classify_update(array($id),$d['status'])){
            json_out_put(return_model('2032', $check_info, NULL));
        }
        $affect_row = $this->classify_model->update_classify_info($d,array('id'=>$id));
        if (is_numeric($affect_row)) {
            json_out_put(return_model(0, '更新成功', $affect_row));
        } else {
            json_out_put(return_model('2032', '更新失败', NULL));
        }
    }
    
    /**
     * 更新商品启用&停用
     */
    public function update_classify(){
        $ids = $this->input->post('ids');
        $d['status'] = $this->input->post('status');
        if($check_info=$this->classify_model->check_classify_update($ids,$d['status'])){
            json_out_put(return_model('2032', $check_info, NULL));
        }
        $this->db->where_in('id',$ids);
        $aff_row = $this->classify_model->update_classify_info($d);
        json_out_put(return_model(0, '添加成功', $aff_row));
    }
    
    /**
     * 分类分页
     */
    public function classify_list_page(){
        $d = $this->classify_model->classify_page_data($this->data_table_parser);
        $this->load->view('json/datatable', $d);
    }
}
