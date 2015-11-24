<?php

/**
 * @filename layout.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-22  23:34:07
 * @Description 加载 view 视图类
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    var $obj;
    var $layout;

    function Layout($layout = "layout_main") {
        $this->obj = & get_instance();
        $this->layout = $layout;
    }

    function setLayout($layout) {
        $this->layout = $layout;
    }

    function view($view, $data = null, $return = false) {
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);

        if ($return) {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        } else {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }

}

/* End of file layout.php */
/* Location: ./application/libraries/layout.php */

