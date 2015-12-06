<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload_model
 *
 * @author pbchen
 */
class upload_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('media_model');
        $this->load->model('giftbook_model');
        $this->load->model('goods_manage_model');
    }

    public function deal_file_upload() {
        $where_in = array();
        foreach ($_FILES as $file) {
            if ($file["error"] == 0) {
                $content = file_get_contents($file["tmp_name"]);
                $content = to_tf8_format($content);
                $data_arr = explode("\n", $content);
                foreach ($data_arr as $d) {
                    $d_arr = explode(',', $d);
                    foreach ($d_arr as $v) {
                        if ($v) {
                            if (strpos($v, '-') !== false) {
                                $dd = explode('-', $v);
                                $diff = $dd[1] - $dd[0];
                                for ($i = 0; $i <= $diff; $i++) {
                                    $where_in[] = $dd[0] + $i;
                                }
                            } else {
                                $where_in[] = $v;
                            }
                        }
                    }
                }
            }
        }
        return $where_in;
    }
    
    /**
     * 处理图片
     * @return type
     */
    public function deal_img_upload($thumb_config){
        
        foreach ($_FILES as $file) {
            $media = array();
            $media['path'] = 'img/'. date('Ymd') . '/' . substr(create_uniqid(), 0,6) . '/';
            $path = $this->config->item('upload_path') . $media['path'];
            if ($file["error"] == 0) {
                $media['name'] = $file['name'];
                $path = make_dir($path);
                $to_file = $path . $file['name'];
                $thumb_config['source_image'] = $to_file;
                if(move_uploaded_file($file["tmp_name"],$to_file)!==false
                    && $this->image_lib->initialize($thumb_config) 
                    && $this->image_lib->resize()){
                    $media['id'] = $this->media_model->add_media($media);
                }else{
                    $media = array();
                }
            }
        }
        return $media;
    }

    /**
     * 更新商品表
     * @param type $id
     * @param type $type
     * @param type $where_in
     */
    public function to_update_gift($id, $type, $where_in) {
        switch ($type) {
            case 'classify':
                $updata = array('classify_id' => $id);
                break;
            case 'brand':
                $updata = array('brand_id' => $id);
                break;
            case 'supply':
                $updata = array('supply_id' => $id);
                break;
            default:
                $updata = array();
                break;
        }
        if(count($updata)>0){
            return $this->goods_manage_model->update_goods_info($updata,array(),$where_in);
        }else{
            return 0;
        }
    }
    
    /**
     * 更新商品表
     * @param type $id
     * @param type $type
     * @param type $where_in
     */
    public function to_update_giftbook($id, $type, $where_in) {
        switch ($type) {
            case 'theme':
                $updata = array('theme_id' => $id);
                break;
            case 'set':
                $updata = array('set_id' => $id);
                break;
            default:
                $updata = array();
                break;
        }
        if(count($updata)>0){
            return $this->giftbook_model->update_giftbook_info($updata,array(),$where_in);
        }else{
            return 0;
        }
    }

}
