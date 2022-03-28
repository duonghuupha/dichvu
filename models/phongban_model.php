<?php
class Phongban_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_phongban WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title_physic, title_virtual, co_dinh, namhoc_id, (SELECT title FROM tbldm_namhoc
                                    WHERE tbldm_namhoc.id = namhoc_id) AS namhoc, status, giao_vien FROM tbldm_phongban 
                                    WHERE truonghoc_id = $truonghocid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function addObj($data){
        $query = $this->insert("tbldm_phongban", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbldm_phongban", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbldm_phongban", "id = $id");
        return $query;
    }
    
    function get_info_via_code($code){
        $query = $this->db->query("SELECT * FROM tbldm_phongban WHERE code = '$code'");
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
    
    function get_all_thietbi_phanbo($phongbanid){
        $query = $this->db->query("SELECT id, code, thietbi_id, so_con, status FROM tbl_phanbo_ct WHERE
                                    code = (SELECT tbl_phanbo.code FROM tbl_phanbo WHERE phongban_id = $phongbanid)
                                    AND status = 0");
        return $query->fetchAll();
    }
}
?>