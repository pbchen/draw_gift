<?php

/**
 * @filename config_nav.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-23  12:55:21
 * @Description 导航配置
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//右侧导航配置
$config['gift_navigation'] = array(
    'member'=>array(  //首页
        'id' => 1,
        'title'=>'首页',
        'self_url'=>'member',
        'is_home'=> true,
        'sort' => 1,
        'display_role'=>array(1),
        'collapse'=>'collapseHome',
        'sub_nav' => array(
            'change_password'=>array(
                    'id' => '1_1',
                    'title'=>'修改密码',
                    'self_url'=>'change_password',
                    'is_home'=> false,
                    'sort' => 1,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'change_info'=>array(
                    'id' => '1_2',
                    'title'=>'修改资料',
                    'self_url'=>'change_info',
                    'is_home'=> false,
                    'sort' => 2,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
        ),
    ),
    'goods_manage'=>array(
        'id' => 2,
        'title'=>'商品管理',
        'self_url'=>'goods_manage',
        'is_home'=> false,
        'sort' => 2,
        'display_role'=>array(1),
        'collapse'=>'collapseGoods',
        'sub_nav' => array(
            'add_goods'=>array(
                    'id' => '2_1',
                    'title'=>'新建商品',
                    'self_url'=>'add_goods',
                    'is_home'=> false,
                    'sort' => 1,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'goods_list'=>array(
                    'id' => '2_2',
                    'title'=>'商品列表',
                    'self_url'=>'goods_list',
                    'is_home'=> false,
                    'sort' => 2,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'goods_classify_list'=>array(
                    'id' => '2_3',
                    'title'=>'商品分类列表',
                    'self_url'=>'goods_classify_list',
                    'is_home'=> false,
                    'sort' => 3,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'goods_brand_list'=>array(
                    'id' => '2_4',
                    'title'=>'商品品牌列表',
                    'self_url'=>'goods_brand_list',
                    'is_home'=> false,
                    'sort' => 4,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'goods_supplier_list'=>array(
                    'id' => '2_2',
                    'title'=>'供应商列表',
                    'self_url'=>'goods_supplier_list',
                    'is_home'=> false,
                    'sort' => 2,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
        ),
    ),
);
