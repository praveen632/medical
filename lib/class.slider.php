<?php
class Slider{

    public $db ;
    private $table;
    public $dirPath;
    public $wwwPath;
    
    public  function __construct() {
        $this->db = new Mysql();
        $this->table = CMS_SLIDER;
        $this->dirPath = DIR_USERDATA_PATH.'slider/';
        $this->wwwPath = WWW_USERDATA_PATH.'slider/';
    }

    public function get($select = '*'){
        $results = $this->db->order_by('position', 'ASC')->where(['client_id' => $_SESSION['user_data']['client_id']])->get($this->table, $select);
        if($results)
            return $results;

        return false;
    }

    public function getRow($id){
        if(empty($id))
            return false;

        $result = $this->db->where(['id' => $id,'client_id'=>$_SESSION['user_data']['client_id']])->get($this->table);
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

    public function getMaxPosition(){
        $qry = 'SELECT max(position) as maxposition FROM '.$this->table." WHERE client_id=".$_SESSION['user_data']['client_id'];
        $result = $this->db->query($qry, true);
        if(isset($result[0]))
            return $result[0]['maxposition'];

        return 0;
        
    }

    public function getSliderImagePath($imageName){
        
        if(file_exists($this->dirPath.$imageName)){
            return $this->wwwPath.$imageName;
        }

        return fasle;
    }

}