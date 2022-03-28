<?php
class Luanchuyenthietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_luanchuyen WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, phongbandi_id, phongbanden_id, thietbi_id, so_con, create_at,
                                    (SELECT title FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id) AS thietbi,
                                    (SELECT title_virtual FROM tbldm_phongban WHERE tbldm_phongban.id = phongbandi_id) AS noidi,
                                    (SELECT title_virtual FROM tbldm_phongban WHERE tbldm_phongban.id = phongbanden_id) AS noiden
                                    FROM tbl_luanchuyen WHERE truonghoc_id = $truonghocid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function get_combo_thietbi($phongbanid){
        $query = $this->db->query("SELECT thietbi_id, so_con, (SELECT title FROM tbl_thongtin_tb 
                                    WHERE tbl_thongtin_tb.id = thietbi_id) AS title FROM tbl_phanbo_ct
                                    WHERE code = (SELECT tbl_phanbo.code FROM tbl_phanbo 
                                    WHERE tbl_phanbo.phongban_id = $phongbanid) AND status = 0");
        return $query->fetchAll();
    }
    
    function addObj($data){
        $query = $this->insert("tbl_luanchuyen", $data);
        return $query;
    }
    
    function updateObj($phongbandi, $thietbiid, $socon, $data){
        $query = $this->update("tbl_phanbo_ct", $data, "thietbi_id = $thietbiid AND so_con = $socon AND code = (SELECT code FROM tbl_phanbo WHERE tbl_phanbo.phongban_id = $phongbandi)");
        return $query;
    }
    
    function check_phanbo_phongban($phongbanid, $truonghocid, $namhocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_phanbo WHERE phongban_id = $phongbanid
                                    AND truonghoc_id = $truonghocid AND namhoc_id = $namhocid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_info_phanbo($phongbanid, $truonghocid){
        $query = $this->db->query("SELECT * FROM tbl_phanbo WHERE phongban_id = $phongbanid AND truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }
    
    function addObj_phanbo($data){
        $query = $this->insert("tbl_phanbo", $data);
        return $query;
    }
    
    function addObj_phanbo_ct($data){
        $query = $this->insert("tbl_phanbo_ct", $data);
        return $query;
    }
}
?>