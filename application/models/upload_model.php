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

}
