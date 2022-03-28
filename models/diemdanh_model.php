<?php
class Diemdanh_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_danh_sach_hoc_sinh($truonghocid, $phongbanid){
        $query = $this->db->query("SELECT id, code, fullname FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
                                    AND phongban_id = $phongbanid AND status = 1");
        return $query->fetchAll();
    }

    function get_info_phongban_via_userid($userid, $truonghocid, $namhocid){
        $query = $this->db->query("SELECT * FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id = $namhocid AND FIND_IN_SET($userid, giao_vien)");
        return $query->fetchAll();
    }

    function get_info_hocsinh($id){
        $query = $this->db->query("SELECT id, code, fullname, phongban_id FROM tbl_hocsinh WHERE id = $id");
        return $query->fetchAll();
    }

    function check_diemdanh($truonghocid, $id, $phongbanid, $ngay){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_diemdanh WHERE truonghoc_id = $truonghocid 
                                    AND hocsinh_id = $id AND phongban_id = $phongbanid AND ngay = '$ngay'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_diemdanh", $data);
        return $query;
    }

    function delObj($truonghocid, $id, $phongbanid, $ngay){
        $query = $this->delete("tbl_diemdanh", "truonghoc_id = $truonghocid AND hocsinh_id = $id AND phongban_id = $phongbanid 
                                AND ngay = '$ngay'");
        return $query;
    }

    function get_list_hoc_sinh_diemdanh($truonghocid, $phongbanid, $ngay){
        $query = $this->db->query("SELECT hocsinh_id AS id, (SELECT fullname FROM tbl_hocsinh WHERE tbl_hocsinh.id = hocsinh_id) 
                                    AS fullname, (SELECT code FROM tbl_hocsinh WHERE tbl_hocsinh.id  = hocsinh_id)  AS code
                                    FROM tbl_diemdanh WHERE truonghoc_id = $truonghocid AND phongban_id = $phongbanid
                                    AND ngay = '$ngay'");
        return $query->fetchAll();
    }
}
?>