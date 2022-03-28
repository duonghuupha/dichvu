<?php
class Xaphuong_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($keyword, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_xaphuong  WHERE title LIKE '%$keyword%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, ma_quan_huyen, ma_xa_phuong, title,
                                    (SELECT title FROM tbldm_quanhuyen WHERE tbldm_quanhuyen.ma_quan_huyen = tbldm_xaphuong.ma_quan_huyen) AS quanhuyen,
                                    (SELECT ma_thanh_pho FROM tbldm_quanhuyen WHERE tbldm_quanhuyen.ma_quan_huyen = tbldm_xaphuong.ma_quan_huyen) AS ma_thanh_pho,
                                    (SELECT tbldm_thanhpho.title FROM tbldm_thanhpho WHERE tbldm_thanhpho.ma_thanh_pho = (SELECT tbldm_quanhuyen.ma_thanh_pho FROM tbldm_quanhuyen
                                    WHERE tbldm_quanhuyen.ma_quan_huyen = tbldm_xaphuong.ma_quan_huyen)) AS thanhpho,
                                    (SELECT tbldm_thanhpho.id FROM tbldm_thanhpho WHERE tbldm_thanhpho.ma_thanh_pho = (SELECT tbldm_quanhuyen.ma_thanh_pho FROM tbldm_quanhuyen
                                    WHERE tbldm_quanhuyen.ma_quan_huyen = tbldm_xaphuong.ma_quan_huyen)) AS thanhphoid
                                    FROM tbldm_xaphuong  WHERE title LIKE '%$keyword%' ORDER BY ma_xa_phuong ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($id, $code, $quanhuyen){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_xaphuong WHERE ma_xa_phuong = '$code'
                                    AND ma_quan_huyen = '$quanhuyen'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_xaphuong WHERE ma_xa_phuong = '$code' 
                                        AND ma_quan_huyen = '$quanhuyen' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function addObj($data){
        $query = $this->insert("tbldm_xaphuong", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbldm_xaphuong", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbldm_xaphuong", "id = $id");
        return $query;
    }
    
    function get_ma_quan_huyen($id){
        $query = $this->db->query("SELECT ma_quan_huyen FROM tbldm_quanhuyen WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['ma_quan_huyen'];
    }
}
?>