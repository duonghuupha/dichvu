<?php
class Thanhpho_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($keyword, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thanhpho WHERE title LIKE '%$keyword%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, ma_thanh_pho, title FROM tbldm_thanhpho WHERE title LIKE '%$keyword%' 
                                    ORDER BY ma_thanh_pho LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thanhpho WHERE ma_thanh_pho = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_thanhpho WHERE ma_thanh_pho = '$code'
                                        AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function addObj($data){
        $query = $this->insert("tbldm_thanhpho", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbldm_thanhpho", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbldm_thanhpho", "id = $id");
        return $query;
    }
}
?>