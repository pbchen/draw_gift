<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploade_file
 *
 * @author pbchen
 */
class upload_file extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('upload_model');
        $this->load->library('image_lib');
    }
    
    /**
     * 文件上传
     */
    public function file_upload(){
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $rt = return_model();
        $where_in = $this->upload_model->deal_file_upload();
        $rt['val'] = 0;
        if(count($where_in)>0){
            if(in_array($type, array('classify','brand','supply'))){
                $rt['val'] = $this->upload_model->to_update_gift($id,$type,$where_in);
            }
        }
        json_out_put($rt);
    }
    
    /**
     * 图片上传
     */
    public function img_upload(){
        $thumb_config = $this->config->item('thumb_img');
        $rt = return_model();
        $img_info = $this->upload_model->deal_img_upload($thumb_config);
        if(count($img_info)>0){
            $rt['val'] = $img_info;
        }else{
            $rt = return_model(9001,'上传失败',NULL);
        }
        json_out_put($rt);
    }
    
    
}
