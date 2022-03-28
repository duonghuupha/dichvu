<?php
class Baocaothietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_total_taisan($truonghocid){
        $query = $this->db->query("SELECT SUM(so_luong) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND nguyen_gia >= 10000000");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_congcu($truonghocid){
        $query = $this->db->query("SELECT SUM(so_luong) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND nguyen_gia < 10000000");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_thietbi_tonghop($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND nguyen_gia >= 10000000");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, nam_su_dung, nguyen_gia, khau_hao, xuat_su, mo_ta, so_luong, cate_id,
                                    (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc
                                    FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid AND nguyen_gia >= 10000000
                                    ORDER BY title ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_thietbi_tonghop_export($truonghocid){
        $query = $this->db->query("SELECT id, code, title, nam_su_dung, nguyen_gia, khau_hao, xuat_su, mo_ta, so_luong, cate_id,
                                    (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc
                                    FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid AND nguyen_gia >= 10000000
                                    ORDER BY title ASC");
        return $query->fetchAll();
    }

    function get_congcu_tonghop($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND nguyen_gia < 10000000");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, nam_su_dung, nguyen_gia, khau_hao, xuat_su, mo_ta, so_luong, cate_id,
                                    (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc
                                    FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid AND nguyen_gia < 10000000
                                    ORDER BY title ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_congcu_tonghop_export($truonghocid){
        $query = $this->db->query("SELECT id, code, title, nam_su_dung, nguyen_gia, khau_hao, xuat_su, mo_ta, so_luong, cate_id,
                                    (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc
                                    FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid AND nguyen_gia < 10000000
                                    ORDER BY title ASC");
        return $query->fetchAll();
    }

    function get_all_phongban($truonghocid, $namhocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id= $namhocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title_physic, title_virtual FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id = $namhocid LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_all_phongban_export($truonghocid, $namhocid){
        $query = $this->db->query("SELECT id, title_physic, title_virtual FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id = $namhocid");
        return $query->fetchAll();
    }
}
?>
