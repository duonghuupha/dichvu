<?php
class Other_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_combo_dich_vu(){
        $query = $this->db->query("SELECT id, title FROM tbldm_dichvu");
        return $query->fetchAll();
    }

    function get_combo_kieu_dich_vu(){
        $query = $this->db->query("SELECT id, title FROM tbldm_kieudichvu");
        return $query->fetchAll();
    }

    function get_combo_truonghoc(){
        $query = $this->db->query("SELECT id, title FROM tbl_truonghoc ORDER BY title ASC");
        return $query->fetchAll();
    }

    function get_combo_nguoidung($truonghocid){
        if($truonghocid != 0){
            $query = $this->db->query("SELECT id, fullname, job FROM tbl_users WHERE truonghoc_id = $truonghocid
                                        AND active = 1 AND is_boss = 0");
        }else{
            $query = $this->db->query("SELECT id, fullname, job FROM tbl_users WHERE truonghoc_id = $truonghocid
                                        AND active = 1");
        }

        return $query->fetchAll();
    }

    function get_combo_content_dm($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_content WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function get_combo_thietbi_dm($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_thietbi WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function get_combo_namhoc($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_namhoc WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function get_combo_phongban($truonghocid, $namhocid){
        $query = $this->db->query("SELECT id, title_virtual FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id = $namhocid");
        return $query->fetchAll();
    }

    function get_combo_vanban_dm($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_vanban WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function get_namhoc_act($truonghocid){
        $query = $this->db->query("SELECT * FROM tbldm_namhoc WHERE truonghoc_id = $truonghocid AND active = 1");
        return $query->fetchAll();
    }

    function get_combo_thanhpho(){
        $query = $this->db->query("SELECT id, title, ma_thanh_pho FROM tbldm_thanhpho ORDER BY ma_thanh_pho ASC");
        return $query->fetchAll();
    }

    function get_combo_quanhuyen($id){
        $query = $this->db->query("SELECT id, title, ma_quan_huyen, ma_thanh_pho FROM tbldm_quanhuyen WHERE ma_thanh_pho = (SELECT tbldm_thanhpho.ma_thanh_pho
                                    FROM tbldm_thanhpho WHERE tbldm_thanhpho.id = $id)");
        return $query->fetchAll();
    }

    function get_combo_xaphuong($id){
        $query = $this->db->query("SELECT id, title, ma_xa_phuong, ma_quan_huyen FROM tbldm_xaphuong WHERE ma_quan_huyen = (SELECT tbldm_quanhuyen.ma_quan_huyen
                                    FROM tbldm_quanhuyen WHERE tbldm_quanhuyen.id = $id)");
        return $query->fetchAll();
    }

    function get_combo_thonto($id){
        $query = $this->db->query("SELECT id, title, ma_thon_to, ma_xa_phuong FROM tbldm_thonto WHERE ma_xa_phuong = (SELECT tbldm_xaphuong.ma_xa_phuong
                                    FROM tbldm_xaphuong WHERE tbldm_xaphuong.id = $id)");
        return $query->fetchAll();
    }

    function get_combo_dan_toc(){
        $query = $this->db->query("SELECT id, title FROM tbldm_dantoc ORDER BY title ASC");
        return $query->fetchAll();
    }

    function get_combo_class_temp($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_classtemp WHERE truonghoc_id = $truonghocid
                                    ORDER BY title ASC");
        return $query->fetchAll();
    }

    function get_combo_thon_to_phantuyen($string_data){
        $query = $this->db->query("SELECT id, title, (SELECT tbldm_xaphuong.title FROM tbldm_xaphuong WHERE
                                    tbldm_xaphuong.ma_xa_phuong = tbldm_thonto.ma_xa_phuong) AS xaphuong FROM tbldm_thonto WHERE ma_xa_phuong IN (SELECT tbldm_xaphuong.ma_xa_phuong
                                    FROM tbldm_xaphuong WHERE tbldm_xaphuong.id IN ($string_data))");
        return $query->fetchAll();
    }

    function get_combo_bantuyensinh($truonghocid, $namhocid){
        $query = $this->db->query("SELECT id, fullname FROM tbl_users WHERE FIND_IN_SET(tbl_users.id, (SELECT user_id FROM tbl_bantuyensinh
                                    WHERE tbl_bantuyensinh.truonghoc_id = $truonghocid AND nam_hoc_id = $namhocid))");
        return $query->fetchAll();
    }

    function get_nguoi_giao_ho_so($id){
        $query = $this->db->query("SELECT ten_me, cmnd_me, ten_bo, cmnd_bo, ten_do_dau, cmnd_do_dau FROM tbl_tuyensinh WHERE id = $id");
        return $query->fetchAll();
    }

    function get_info_phongban($id){
        $query = $this->db->query("SELECT * FROM tbldm_phongban WHERE id = $id");
        return $query->fetchAll();
    }

    function get_all_phongban_dapb($truonghocid){
        $query = $this->db->query("SELECT giao_vien FROM tbldm_phongban WHERE giao_vien != '' AND truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function get_combo_lop_hoc($truonghocid, $namhocid){
        $query = $this->db->query("SELECT id, title_virtual FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id = $namhocid AND co_dinh = 0");
        return $query->fetchAll();
    }

    function get_combo_khunggio(){
        $query = $this->db->query("SELECT id, bat_dau, ket_thuc FROM tbldm_khunggio ORDER BY id ASC");
        return $query->fetchAll();
    }

    function get_combo_nhom_cong_viec($truonghocid, $userid){
        $query = $this->db->query("SELECT id, title FROM tbl_taskgroup WHERE truonghoc_id = $truonghocid
                                    AND (user_id = $userid  OR FIND_IN_SET($userid, user_id_follow))");
        return  $query->fetchAll();
    }

    function get_user_group_task($id){
        $query = $this->db->query("SELECT id, fullname FROM tbl_users WHERE FIND_IN_SET(tbl_users.id, (SELECT user_id_follow FROM tbl_taskgroup
                                    WHERE tbl_taskgroup.id = $id))");
        return $query->fetchAll();
    }

    function get_combo_exam($truonghocid, $s){
        if($s == 1){ // xuat file
            $where = "";
        }else{ // khong xuat file
            $where = " AND date_start <= CURRENT_DATE AND date_end >= CURRENT_DATE";
        }
        $query = $this->db->query("SELECT id, title FROM tbldm_exam WHERE truonghoc_id = $truonghocid $where");
        return $query->fetchAll();
    }
}
?>
