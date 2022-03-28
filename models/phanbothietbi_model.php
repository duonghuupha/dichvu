<?php
class Phanbothietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_phanbo WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, namhoc_id, phongban_id, create_at, (SELECT title FROM tbldm_namhoc
                                    WHERE tbldm_namhoc.id = namhoc_id) AS namhoc, (SELECT title_virtual FROM tbldm_phongban
                                    WHERE tbldm_phongban.id = phongban_id) AS phongban FROM tbl_phanbo WHERE truonghoc_id = $truonghocid
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_combo_thietbi($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbl_thongtin_tb WHERE so_luong > 0 AND truonghoc_id = $truonghocid
                                    AND status != 99 ORDER BY title ASC");
        return $query->fetchAll();
    }

    function get_combo_thietbi_con($id){
        $query = $this->db->query("SELECT id, title, so_luong FROM tbl_thongtin_tb WHERE id = $id");
        return $query->fetchAll();
    }

    function addObj($data){
        $query = $this->insert("tbl_phanbo", $data);
        return $query;
    }

    function addObj_ct($data){
        $query = $this->insert("tbl_phanbo_ct", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_phanbo", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_phanbo", "id = $id");
        return $query;
    }

    function delObj_ct($code){
        $query = $this->delete("tbl_phanbo_ct", "code = '$code'");
        return $query;
    }

    function dupliObj($truonghocid, $id, $phongbanid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_phanbo WHERE truonghoc_id = $truonghocid
                                    AND phongban_id = $phongbanid");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_phanbo WHERE truonghoc_id = $truonghocid
                                    AND phongban_id = $phongbanid AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>
