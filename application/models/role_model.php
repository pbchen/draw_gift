<?php

/**
 * @filename role_model.php 
 * @encoding UTF-8 
 * @author pbchen 
 * @datetime 2015-11-24  22:15:33
 * @Description 角色模型
 */
class Role_model extends CI_Model {
    
    private $_role_tb = '`gift_management`.`role`';
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取角色
     * @param type $cache_time
     * @return type
     */
    public function get_role($cache_time=86400){
        $role_ck = 'alw.role';
        $this->load->driver('cache', array('adapter' => 'file'));
        if( ! $role_map = $this->cache->get($role_ck) ){
            $this->db->select('`id`,`name` as `role_name`');
            $this->db->from($this->_role_tb);
            $query = $this->db->get();
            foreach ($query->result() as $row){
                $role_map[$row->id] = $row->role_name;
            }
            $this->cache->save($role_ck, $role_map, $cache_time);
        }
        return $role_map;
    }

    
}
