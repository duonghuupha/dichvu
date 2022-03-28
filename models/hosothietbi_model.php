<?php
class Hosothietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function get_combo_thietbi($phongbanid){
        $query = $this->db->query("SELECT thietbi_id, so_con, (SELECT title FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id) AS title
                                    FROM tbl_phanbo_ct WHERE status = 0 AND code = (SELECT tbl_phanbo.code FROM tbl_phanbo
                                    WHERE tbl_phanbo.phongban_id = $phongbanid)");
        return $query->fetchAll();
    }
    
    function get_info_thietbi($id){
        $query = $this->db->query("SELECT id, code, title, nguyen_gia, khau_hao, xuat_su, mo_ta, image, nam_su_dung, cate_id,
                                    (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc 
                                    FROM tbl_thongtin_tb WHERE id = $id");
        return $query->fetchAll();
    }
    
    function get_quatrinh_thietbi($id){
        $query = $this->db->query("SELECT id, code, noidung, danhmuc_id, (SELECT title FROM tbldm_danhmuc
                                    WHERE tbldm_danhmuc.id = danhmuc_id) AS danhmuc, (SELECT tbl_yeucau_pro.create_at
                                    FROM tbl_yeucau_pro WHERE tbl_yeucau_pro.yeucau_id = tbl_yeucau.id
                                    AND tbl_yeucau_pro.status = 4) AS ngaycuoi FROM tbl_yeucau
                                    WHERE id IN (SELECT tbl_yeucau_pro.yeucau_id FROM tbl_yeucau_pro 
                                    WHERE tbl_yeucau_pro.status = 4) AND thietbi_id = '$id' ORDER BY id DESC");
        return $query->fetchAll();
    }
    
    function get_phanbo($thietbiid, $socon){
        $query = $this->db->query("SELECT id, code, thietbi_id, so_con, (SELECT create_at FROM tbl_phanbo 
                                    WHERE tbl_phanbo.code = tbl_phanbo_ct.code) AS ngaytao, (SELECT title_physic FROM tbldm_phongban
                                    WHERE tbldm_phongban.id = (SELECT phongban_id FROM tbl_phanbo 
                                    WHERE tbl_phanbo.code = tbl_phanbo_ct.code)) AS phongbanp, (SELECT title_virtual FROM tbldm_phongban
                                    WHERE tbldm_phongban.id = (SELECT phongban_id FROM tbl_phanbo 
                                    WHERE tbl_phanbo.code = tbl_phanbo_ct.code)) AS phongbanv FROM tbl_phanbo_ct WHERE 
                                    thietbi_id = $thietbiid AND so_con = $socon ORDER BY id ASC LIMIT 0, 1");
        return $query->fetchAll();
    }
    
    function get_luanchuyen($thietbiid, $socon){
        $query = $this->db->query("SELECT id, truonghoc_id, namhoc_id, phongbandi_id, phongbanden_id, thietbi_id, so_con,
                                    create_at, (SELECT title_physic FROM tbldm_phongban WHERE tbldm_phongban.id = phongbandi_id) AS titlep,
                                    (SELECT title_virtual FROM tbldm_phongban WHERE tbldm_phongban.id = phongbandi_id) AS titlev,
                                    (SELECT title_physic FROM tbldm_phongban WHERE tbldm_phongban.id = phongbanden_id) AS titlepd,
                                    (SELECT title_virtual FROM tbldm_phongban WHERE tbldm_phongban.id = phongbanden_id) AS titlevd
                                    FROM tbl_luanchuyen WHERE thietbi_id = $thietbiid ANd so_con = $socon ORDER BY id ASC");
        return $query->fetchAll();
    }
}
?>