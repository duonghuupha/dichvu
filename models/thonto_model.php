<?php
class Thonto_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($keyword, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thonto WHERE title LIKE '%$keyword%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, ma_xa_phuong, ma_thon_to, title FROM tbldm_thonto  
                                    WHERE title LIKE '%$keyword%'ORDER BY ma_thon_to DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($id, $code, $xaphuong){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thonto WHERE ma_thon_to = '$code'
                                    AND ma_xa_phuong = '$xaphuong'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thonto WHERE ma_thon_to = '$code' 
                                        AND ma_xa_phuong = '$xaphuong' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function addObj($data){
        $query = $this->insert("tbldm_thonto", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbldm_thonto", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbldm_thonto", "id = $id");
        return $query;
    }
    
    function get_ma_xa_phuong($id){
        $query = $this->db->query("SELECT ma_xa_phuong FROM tbldm_xaphuong WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['ma_xa_phuong'];
    }
}
?>