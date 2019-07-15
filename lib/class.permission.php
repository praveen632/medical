<?php
class Permission{

    public $db ;
    private $table;
	private $tableMapping;
    
    public  function __construct() {
        $this->db = new Mysql();
        $this->table = CMS_PERMISSION;
		$this->tableMapping = CMS_CLIENT_PERMISSION_MAPPING;
    }

    public function get($select = '*'){
        $results = $this->db->get($this->table, $select);
        if($results)
            return $results;

        return false;
    }

    public function getRow($id){
        if(empty($id))
            return false;

        $result = $this->db->where(['perm_id' => $id])->get($this->table);
        if($result)
            return $result[0];

        return false;
    }
    
    public function save($data, $condition = '') {
        if(!empty($condition)){
            return $this->db->where($condition)->update($this->table, $data);
        }else{
            return $this->db->insert($this->table, $data);
        }
    }
	public function saveMapping($data, $condition = '') {
        if(!empty($condition)){
            return $this->db->where($condition)->update($this->tableMapping, $data);
        }else{
            return $this->db->insert($this->tableMapping, $data);
        }
    }
	public function getClientPermissions($id){
        if(empty($id))
            return false;

        $result = $this->db->where(['client_id' => $id])->get($this->tableMapping);
        if($result)
            return $result;

        return false;
    }
	public function getClientPermissionsData($id){
        if(empty($id))
            return false;
		
		$qry = 'SELECT p.perm_id,p.perm_slug FROM '.$this->table.' p';
        $qry .= ' JOIN '.$this->tableMapping.' m ON p.perm_id = m.perm_id ';
        $qry .= ' WHERE m.client_id ='.$id;

        $result = $this->db->query($qry, true);
        if($result) {
			$returnPerm = array();
			foreach($result as $permData) {
				$returnPerm[$permData['perm_id']] = strtolower($permData['perm_slug']);
			}
            return $returnPerm;
		}
        return false;
    }
	
	public function deleteClientPermissions($condition){
        if(empty($condition) || !is_array($condition))
            return false;

        return $this->db->where($condition)->delete($this->tableMapping);
    }

    public function delete($condition){
        if(empty($condition) || !is_array($condition))
            return false;

        return $this->db->where($condition)->delete($this->table);
    }



}