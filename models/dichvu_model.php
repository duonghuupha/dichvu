<?php
class Dichvu_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_dichvu");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, file FROM tbldm_dichvu ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_dichvu", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_dichvu", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_dichvu", "id = $id");
        return $query;
    }
}
?>