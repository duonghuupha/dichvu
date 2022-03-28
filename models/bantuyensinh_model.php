<?php
class Bantuyensinh_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_bantuyensinh WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, nam_hoc_id, (SELECT title FROM tbldm_namhoc WHERE tbldm_namhoc.id = nam_hoc_id) AS namhoc,
                                    user_id FROM tbl_bantuyensinh WHERE truonghoc_id = $truonghocid 
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($id, $namhoc){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_bantuyensinh WHERE nam_hoc_id = $namhoc");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_bantuyensinh WHERE nam_hoc_id = $namhoc AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function addObj($data){
        $query = $this->insert("tbl_bantuyensinh", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_bantuyensinh", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbl_bantuyensinh", "id = $id");
        return $query;
    }
}
?>