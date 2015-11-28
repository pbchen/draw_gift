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
        $this->load->library('uc_service', array('cfg'=>$this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品
     */
    public function add_goods(){
        //no_load_bootstrap_plugins 
        //不加载 bootstrap.plugins.min.js 加载后影响图片上传插件 
        //默认是加载的
        if($_POST){
            $data = $this->goods_manage_model->get_goods_params();
            $data['ctime'] = $data['utime'] = date('Y-m-d H:i:s');
            $data['status'] = 1;
            $data['sold_num'] = 0;
            
            if($data['type']==goods_manage_model::MULTIPLE_GOODS_TYPE){
                if($check_info=$this->goods_manage_model->check_goods_num($data['groupid'],$data['store_num'])){
                    json_out_put(return_model('1002',$check_info,NULL));
                }
            }
            if( $insert_id=$this->goods_manage_model->add_goods($data) ){
                json_out_put(return_model(0,'添加成功',$insert_id));
            }else{
                json_out_put(return_model('1001','添加失败',NULL));
            }
        }else{
            $d = array('title' => '商品管理','msg'=>'','no_load_bootstrap_plugins'=>true);
            $d['brand'] = $this->brand_model->get_brand();
            $d['classify'] = $this->classify_model->get_classify();
            $d['suppley'] = $this->supply_model->get_suppley();
            $d['deliver'] = $this->deliver_model->get_deliver();
            $this->layout->view('goods_manage/add_goods', $d);
        }
    }
    
}
