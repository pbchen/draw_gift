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
        $this->load->library('Data_table_parser');
        $this->data_table_parser->set_db($this->db);
        $this->load->library('uc_service', array('cfg' => $this->config->item('alw_uc')));
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
    
    
}
