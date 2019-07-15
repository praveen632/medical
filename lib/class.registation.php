<?php
class Registation{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = CMS_USERS;
    }
	public function save($data, $condition = '') {
        if(!empty($condition)){
            $menuData = $this->db->get($this->table);
            return $this->db->where($condition)->update($this->table, $data);
        }else{
            return $this->db->insert($this->table, $data);
        }
    }
}