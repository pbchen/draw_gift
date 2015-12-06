<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of media_model
 *
 * @author pbchen
 */
class media_model extends CI_Model {
    
    private $_media_tb = '`gift_management`.`media`';
    const MEDIA_START_STATUS = 1;
    const MEDIA_STOP_STATUS = 2;
    private $_media_status = array(
        '1' => '启用',
        '2' => '停用'
    );
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 添加媒体资源
     * @param type $media_info
     * @return type
     */
    public function add_media($media_info){
        $media_info['ctime'] = $media_info['utime'] = date('Y-m-d H:i:s');
        $media_info['status'] = 1;
        $this->db->insert($this->_media_tb, $media_info);
        return $this->db->insert_id();
    }
    
    /**
     * 获取上传资源信息
     * @param type $where
     * @param type $where_in
     * @return type
     */
    public function get_media($where=array(),$where_in=array()){
        $this->db->select('*')->from($this->_media_tb);
        if($where){
            $this->db->where($where);
        }
        if($where_in){
            foreach($where_in as $k=>$v){
                $this->db->where_in($k,$v);
            }
        }
        return $this->db->get()->result_array();
    }
    
}
