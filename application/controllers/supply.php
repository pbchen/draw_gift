<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of supply
 *
 * @author pbchen
 */
class supply extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('supply_model');
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品供应商
     */
    public function add_supply(){
        $d['status'] = 1;
        $d['name'] = $this->input->post('name');
        $d['remark'] = $this->input->post('remark');
        if($id=$this->supply_model->add_supply($d)){
            json_out_put(return_model(0, '添加成功', $id));
        }else{
            json_out_put(return_model('2001', '添加失败', NULL));
        }
    }
    
    /**
     * 编辑供应商
     */
    public function edit_supply(){
        $d['status'] = $this->input->post('status');
        $d['name'] = $this->input->post('name');
        $d['remark'] = $this->input->post('remark');
        $id = $this->input->post('id');
        if($check_info=$this->supply_model->check_supply_update(array($id),$d['status'])){
            json_out_put(return_model('2002', $check_info, NULL));
        }
        $affect_row = $this->supply_model->update_supply_info($d,array('id'=>$id));
        if (is_numeric($affect_row)) {
            json_out_put(return_model(0, '更新成功', $affect_row));
        } else {
            json_out_put(return_model('2002', '更新失败', NULL));
        }
    }
    
    /**
     * 更新使用&停用
     */
    public function update_supply(){
        $ids = $this->input->post('ids');
        $d['status'] = $this->input->post('status');
        if($check_info=$this->supply_model->check_supply_update($ids,$d['status'])){
            json_out_put(return_model('2002', $check_info, NULL));
        }
        $this->db->where_in('id',$ids);
        $aff_row = $this->supply_model->update_supply_info($d);
        json_out_put(return_model(0, '添加成功', $aff_row));
    }
    
    /**
     * 供应商分页
     */
    public function supply_list_page(){
        $d = $this->supply_model->supply_page_data($this->data_table_parser);
        $this->load->view('json/datatable', $d);
    }
    
    
}
