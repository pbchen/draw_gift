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
        $this->load->model('goods_manage_model');
        $this->load->library('uc_service', array('cfg'=>$this->config->item('alw_uc')));
    }
    
    /**
     * 添加商品
     */
    public function add_goods(){
        $d = array('title' => '商品管理','msg'=>'');
        $this->layout->view('goods_manage/add_goods', $d);
    }
    
}
