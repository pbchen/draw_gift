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
        foreach($_FILES as $file){
            if ($item["error"] == 0) {
                $content = file_get_contents($item["tmp_name"]);
                $content = $this->common_function->get_str_utf8($content);
                $data_arr = explode("\n", $content);
            } else {
                $uploadresult = '';
            }
        }
    }
    
    
}
