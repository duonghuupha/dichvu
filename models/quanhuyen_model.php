<?php
class Quanhuyen_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($keyword, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_quanhuyen WHERE title LIKE '%$keyword%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, ma_thanh_pho, ma_quan_huyen, title, 
                                    (SELECT title FROM tbldm_thanhpho WHERE tbldm_thanhpho.ma_thanh_pho = tbldm_quanhuyen.ma_thanh_pho) AS thanhpho
                                    FROM tbldm_quanhuyen WHERE title LIKE '%$keyword%' ORDER BY ma_thanh_pho ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($id, $code, $thanhpho){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_quanhuyen WHERE ma_quan_huyen = '$code'
                                    AND ma_thanh_pho = '$thanhpho'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_quanhuyen WHERE ma_quan_huyen = '$code' 
                                        AND ma_thanh_pho = '$thanhpho' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function addObj($data){
        $query = $this->insert("tbldm_quanhuyen", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbldm_quanhuyen", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbldm_quanhuyen", "id = $id");
        return $query;
    }
    
    function get_ma_thanh_pho($id){
        $query = $this->db->query("SELECT ma_thanh_pho FROM tbldm_thanhpho WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['ma_thanh_pho'];
    }
}
?>