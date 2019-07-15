<?php
class Page{

    public $db ;
    private $table;
    public $dirPath;
    public $wwwPath;
    
    public  function __construct() {
        $this->db = new Mysql();
        $this->table = CMS_PAGE;
        $this->dirPath = DIR_USERDATA_PATH.'page/';
        $this->wwwPath = WWW_USERDATA_PATH.'page/';
    }

    public function get($select = '*'){
        $results = $this->db->where(['client_id' => $_SESSION['user_data']['client_id']])->get($this->table, $select);
        if($results)
            return $results;

        return false;
    }

    public function getRow($id){
        if(empty($id))
            return false;

        $result = $this->db->where(['page_id' => $id,'client_id'=>$_SESSION['user_data']['client_id']])->get($this->table);
        if($result)
            return $result[0];

        return false;
    }
    
    public function save($data, $condition = '') {
        if(!empty($condition)){
            $menuData = $this->db->get($this->table);
            return $this->db->where($condition)->update($this->table, $data);
        }else{
            return $this->db->insert($this->table, $data);
        }
    }

    public function delete($condition){
        if(empty($condition) || !is_array($condition))
            return false;

        return $this->db->where($condition)->delete($this->table);
    }

    public function getImagePath($imageName){
        
        if(file_exists($this->dirPath.$imageName)){
            return $this->wwwPath.$imageName;
        }

        return false;
    }


}