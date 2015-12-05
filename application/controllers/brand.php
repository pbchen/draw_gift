<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of brand
 *
 * @author pbchen
 */
class brand extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('brand_model');
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品品牌
     */
    public function add_brand(){
        $d['status'] = 1;
        $d['name'] = $this->input->post('name');
        $d['remark'] = $this->input->post('remark');
        if($id=$this->brand_model->add_brand($d)){
            json_out_put(return_model(0, '添加成功', $id));
        }else{
            json_out_put(return_model('2011', '添加失败', NULL));
        }
    }
    
    /**
     * 编辑品牌
     */
    public function edit_brand(){
        $d['status'] = $this->input->post('status');
        $d['name'] = $this->input->post('name');
        $d['remark'] = $this->input->post('remark');
        $id = $this->input->post('id');
        if($check_info=$this->brand_model->check_brand_update(array($id),$d['status'])){
            json_out_put(return_model('2022', $check_info, NULL));
        }
        $affect_row = $this->brand_model->update_brand_info($d,array('id'=>$id));
        if (is_numeric($affect_row)) {
            json_out_put(return_model(0, '更新成功', $affect_row));
        } else {
            json_out_put(return_model('2022', '更新失败', NULL));
        }
    }
    
    /**
     * 更新商品启用&停用
     */
    public function update_brand(){
        $ids = $this->input->post('ids');
        $d['status'] = $this->input->post('status');
        if($check_info=$this->brand_model->check_brand_update($ids,$d['status'])){
            json_out_put(return_model('2022', $check_info, NULL));
        }
        $this->db->where_in('id',$ids);
        $aff_row = $this->brand_model->update_brand_info($d);
        json_out_put(return_model(0, '添加成功', $aff_row));
    }
    
    /**
     * 品牌分页
     */
    public function brand_list_page(){
        $d = $this->brand_model->brand_page_data($this->data_table_parser);
        $this->load->view('json/datatable', $d);
    }
    
    
}
