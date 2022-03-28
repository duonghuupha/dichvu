<?php
class Danhmucthietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thietbi WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title FROM tbldm_thietbi WHERE truonghoc_id = $truonghocid ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function addObj($data){
        $query = $this->insert("tbldm_thietbi", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbldm_thietbi", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbldm_thietbi", "id = $id");
        return $query;
    }
}
?>