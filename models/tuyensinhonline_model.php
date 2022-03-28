<?php
class Tuyensinhonline_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function get_detail_truonghoc($id){
        $query = $this->db->query("SELECT * FROM tbl_truonghoc WHERE id = $id");
        return $query->fetchAll();
    }
    
    function get_phantuyen($truonghocid){
        $query = $this->db->query("SELECT * FROM tbl_phantuyents WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }
    
    function dupliObj($id, $hoten, $ngaysinh){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_tuyensinh WHERE ho_ten = '$hoten' AND ngay_sinh = '$ngaysinh'");
        if($id){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_tuyensinh WHERE ho_ten = '$hoten' AND ngay_sinh = '$ngaysinh'
                                        AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function dupliObj_code($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_tuyensinh WHERE code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_tuyensinh WHERE code = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function display($code){
        $query = $this->db->query("SELECT * FROM tbl_tuyensinh WHERE code = '$code'");
        return $query->fetchAll();
    }
    
    function addObj($data){
        $query = $this->insert("tbl_tuyensinh", $data);
        return $query;
    }
}
?>