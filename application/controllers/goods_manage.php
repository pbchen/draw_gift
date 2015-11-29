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
                if ($check_info = $this->goods_manage_model->check_goods_num($data['groupid'], $data['store_num'])) {
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
        $cols = array('`gift`.`id` AS `id`', '`gift`.`name` AS `g_name`', '`gift`.`type`','`gift`.`store_num`', '`gift`.`sold_num`',
            '`gift`.`status`','`gift_brand`.`name` AS `b_name`','`gift_classify`.`name` AS `c_name`','`gift_supply`.`name` AS `s_name`');
        $sort_cols = array('4'=>'`gift`.`store_num`');
        $filter_cols = array();
        //查询主表
        $table = '`gift_management`.`gift`';
        $dtparser = $this->data_table_parser;
        $dtparser->select($cols, $sort_cols, $filter_cols, FALSE);
        $dtparser->from($table);
        $dtparser->join('`gift_management`.`gift_brand`', 'gift_brand.id=gift.brand_id', 'left');
        $dtparser->join('`gift_management`.`gift_classify`', 'gift_classify.id=gift.classify_id', 'left');
        $dtparser->join('`gift_management`.`gift_supply`', 'gift_supply.id=gift.supply_id', 'left');
        //条件
        $cwhere = $this->goods_manage_model->get_goods_page_where();
        $d['code'] = 0;
        $d['iTotal'] = 0;
        $d['iFilteredTotal'] = 0;
        $d['aaData'] = array();
        if( $d['code'] == 0 ){
            $d['iTotal'] = $dtparser->count($cwhere);
            $d['iFilteredTotal'] = $d['iTotal'];
            $query = $dtparser->get($cwhere);
            $arr = $query->result_array();
            $this->goods_manage_model->ajax_goods_list_table_data($arr);
            $d['aaData']=$arr;
        }
        $this->load->view('json/datatable', $d);
    }

}
