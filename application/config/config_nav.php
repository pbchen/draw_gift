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
            'classify_list'=>array(
                    'id' => '2_3',
                    'title'=>'商品分类列表',
                    'self_url'=>'classify_list',
                    'is_home'=> false,
                    'sort' => 3,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'brand_list'=>array(
                    'id' => '2_4',
                    'title'=>'商品品牌列表',
                    'self_url'=>'brand_list',
                    'is_home'=> false,
                    'sort' => 4,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'supply_list'=>array(
                    'id' => '2_2',
                    'title'=>'供应商列表',
                    'self_url'=>'supply_list',
                    'is_home'=> false,
                    'sort' => 2,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
        ),
    ),
    'giftbook_manage'=>array(
        'id' => 3,
        'title'=>'礼品册管理',
        'self_url'=>'giftbook_manage',
        'is_home'=> false,
        'sort' => 3,
        'display_role'=>array(1),
        'collapse'=>'collapseGiftbook',
        'sub_nav' => array(
            'add_giftbook'=>array(
                    'id' => '3_1',
                    'title'=>'新建礼册',
                    'self_url'=>'add_giftbook',
                    'is_home'=> false,
                    'sort' => 1,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'giftbook_list'=>array(
                    'id' => '3_2',
                    'title'=>'礼册列表',
                    'self_url'=>'giftbook_list',
                    'is_home'=> false,
                    'sort' => 2,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'theme_list'=>array(
                    'id' => '3_3',
                    'title'=>'主题列表',
                    'self_url'=>'theme_list',
                    'is_home'=> false,
                    'sort' => 3,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'set_list'=>array(
                    'id' => '3_4',
                    'title'=>'系列列表',
                    'self_url'=>'set_list',
                    'is_home'=> false,
                    'sort' => 4,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
        ),
    ),
    'gift_card'=>array(
        'id' => 4,
        'title'=>'礼品卡管理',
        'self_url'=>'gift_card',
        'is_home'=> false,
        'sort' => 3,
        'display_role'=>array(1),
        'collapse'=>'collapseGiftcard',
        'sub_nav' => array(
            'add_giftcard'=>array(
                    'id' => '4_1',
                    'title'=>'礼品卡下单',
                    'self_url'=>'add_giftcard',
                    'is_home'=> false,
                    'sort' => 1,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'giftcard_list'=>array(
                    'id' => '3_2',
                    'title'=>'礼品卡开卡管理',
                    'self_url'=>'giftcard_list',
                    'is_home'=> false,
                    'sort' => 2,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'giftcard_inventory'=>array(
                    'id' => '3_3',
                    'title'=>'礼品开库',
                    'self_url'=>'giftcard_inventory',
                    'is_home'=> false,
                    'sort' => 3,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
            'cancel_giftcard'=>array(
                    'id' => '3_4',
                    'title'=>'退卡管理',
                    'self_url'=>'cancel_giftcard',
                    'is_home'=> false,
                    'sort' => 4,
                    'display_role'=>array(1),
                    'sub_nav' => array(),
                ),
        ),
    ),
);
