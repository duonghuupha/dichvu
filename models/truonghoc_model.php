<?php
class Truonghoc_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_truonghoc");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, phone, address, active FROM tbl_truonghoc
                                    ORDER BY title ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_truonghoc WHERE code= '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_truonghoc WHERE code= '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_detail($id){
        $query = $this->db->query("SELECT * FROM tbl_truonghoc WHERE id = $id");
        return $query->fetchAll();
    }
    
    function addObj($data){
        $query = $this->insert("tbl_truonghoc", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_truonghoc", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbl_truonghoc", "id = $id");
        return $query;
    }
}
?>