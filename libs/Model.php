<?php
class Model {
    function __construct() {
		$this->db = new Database();
	}

    // them moi du lieu
    function insert($table, $array){
        $cols = array();
        $bind = array();
        foreach($array as $key => $value){
            $cols[] = $key;
            $bind[] = "'".$value."'";
        }
        $query = $this->db->query("INSERT INTO ".$table." (".implode(",", $cols).") VALUES (".implode(",", $bind).")");
        return $query;
    }

    // cap nhat du lieu
    function update($table, $array, $where){
        $set = array();
        foreach($array as $key => $value){
            $set[] = $key." = '".$value."'";
        }
        $query = $this->db->query("UPDATE ".$table." SET ".implode(",", $set)." WHERE ".$where);
        return $query;
    }

    // xoa du lieu
    function delete($table, $where = ''){
        if($where == ''){
            $query = $this->db->query("DELETE FROM ".$table);
        }else{
        $query = $this->db->query("DELETE FROM ".$table." WHERE ".$where);
        }
        return $query;
    }

    // luu thong bao he thtong
    function add_notify($data){
        $query = $this->insert("tbl_notify", $data);
        return $query;
    }
///////////////////////////// cac ham khac //////////////////////////////////////////////////////////////////////////////////
    function check_exit_dichvu($truonghocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_truonghoc WHERE id = $truonghocid
                                    AND active = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function check_su_dung_dich_vu($truonghocid, $dichvu_id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_truonghoc WHERE id = $truonghocid
                                    AND FIND_IN_SET($dichvu_id, dichvu_id)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function check_roles($userid, $roles){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE id = $userid AND FIND_IN_SET($roles, roles)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_total_truonghoc(){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_truonghoc");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_list_task_via_day($date, $useridtask, $buoi){
        if($buoi == 1){ // sang
            $where = " AND DATE_FORMAT(date_start, '%H:%i:%s') <=  '12:00:00'";
        }else{ // chieu
            $where = " AND DATE_FORMAT(date_start, '%H:%i:%s') >=  '12:00:00'";
        }
        $query = $this->db->query("SELECT id, code, content, user_id_follow FROM tbl_task WHERE DATE_FORMAT(date_start, '%Y-%m-%d') <= '$date'
                                    AND DATE_FORMAT(date_end, '%Y-%m-%d') >= '$date' $where AND (user_id_task = $useridtask
                                    OR FIND_IN_SET($useridtask, user_id_follow))");
        return $query->fetchAll();
    }
    function check_yeucau_duyet($id, $status){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_yeucau_pro WHERE yeucau_id = $id AND status = $status");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_total_bai_viet_can_duyet($truonghocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_content WHERE truonghoc_id = $truonghocid
                                    AND status = 0");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function check_dupli_code_thietbi($truonghocid, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND code = '$code'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_info_thietbi($id){
        $query = $this->db->query("SELECT * FROM tbl_thongtin_tb WHERE id = $id");
        return $query->fetchAll();
    }
    function check_daphanbo_thietbi($id, $idcon){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_phanbo_ct WHERE thietbi_id = $id AND so_con = $idcon");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_list_thietbi_dc_phanbo($code){
        $query = $this->db->query("SELECT id, code, thietbi_id, (SELECT title FROM tbl_thongtin_tb
                                    WHERE tbl_thongtin_tb.id = thietbi_id) AS thietbi, so_con
                                    FROM tbl_phanbo_ct WHERE code = '$code' AND status = 0");
        return $query->fetchAll();
    }
    function get_list_noti_not_read($truonghocid, $userid){
        $query = $this->db->query("SELECT id, content, link, create_at FROM tbl_notify WHERE truonghoc_id = $truonghocid
                                    AND FIND_IN_SET($userid, user_id) AND !FIND_IN_SET($userid, readed)");
        return $query->fetchAll();
    }
    function get_title_nam_hoc_by_id($id){
        $query = $this->db->query("SELECT * FROM tbldm_namhoc WHERE id = $id");
        return $query->fetchAll();
    }
    function get_title_dan_toc_via_id($id){
        $query = $this->db->query("SELECT title FROM tbldm_dantoc WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
    function get_title_tinh_via_id($id){
        $query = $this->db->query("SELECT title FROM tbldm_thanhpho WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
    function get_title_huyen_via_id($id){
        $query = $this->db->query("SELECT title FROM tbldm_quanhuyen WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
    function get_title_xa_via_id($id){
        $query = $this->db->query("SELECT title FROM tbldm_xaphuong WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
    function get_title_thon_to_via_id($id){
        $query = $this->db->query("SELECT title FROM tbldm_thonto WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
    function get_title_lop_muon_vao($id){
        $query = $this->db->query("SELECT title FROM tbldm_classtemp WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
    function get_fullname_users($id){
        $query = $this->db->query("SELECT fullname FROM tbl_users WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }
    function get_info_thanhpho($mathanhpho){
        $query = $this->db->query("SELECT * FROM tbldm_thanhpho WHERE ma_thanh_pho = '$mathanhpho'");
        return $query->fetchAll();
    }
    function get_info_quanhuyen($maquanhuyen){
        $query = $this->db->query("SELECT * FROM tbldm_quanhuyen WHERE ma_quan_huyen = '$maquanhuyen'");
        return $query->fetchAll();
    }
    function get_info_xaphuong($maxaphuong){
        $query = $this->db->query("SELECT * FROM tbldm_xaphuong WHERE ma_xa_phuong = '$maxaphuong'");
        return $query->fetchAll();
    }
    function get_all_service_school_usage($truonghocid){
        $query = $this->db->query("SELECT dichvu_id FROM tbl_truonghoc WHERE id = $truonghocid");
        $row = $query->fetchAll();
        return $row[0]['dichvu_id'];
    }
    function check_dupli_code_hocsinh($truonghocid, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
                                    AND code = '$code'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_all_menu_roles($dichvuid){
        $query = $this->db->query("SELECT id, title, link, parent_id, is_menu, thu_tu, chuc_nang FROM tbl_roles
                                    WHERE dichvu_id = $dichvuid ORDER BY thu_tu ASC");
        return $query->fetchAll();
    }
    function get_all_roles_via_userid($userid, $parentid){
        $query = $this->db->query("SELECT id, title, is_menu, link, parent_id, (SELECT icon FROM tbldm_dichvu WHERE tbldm_dichvu.id = dichvu_id) AS icon
                                    FROM tbl_roles WHERE FIND_IN_SET(id, (SELECT roles FROM tbl_users WHERE tbl_users.id = $userid))
                                    AND parent_id = $parentid AND is_menu = 1 ORDER BY thu_tu ASC");
        return $query->fetchAll();
    }
    function get_all_event_of_month($truonghocid, $month){
        $query = $this->db->query("SELECT id, title, bat_dau, ket_thuc, ngay_hoc, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS nguoidung FROM tbl_bangtuongtac WHERE truonghoc_id = $truonghocid
                                    AND DATE_FORMAT(ngay_hoc, '%m-%Y') = '$month'");
        return $query->fetchAll();
    }
    function get_info_truonghoc($id){
        $query = $this->db->query("SELECT id, title, address, phone, email, masothue, taikhoan, motai FROM tbl_truonghoc
                                    WHERE id = $id");
        return $query->fetchAll();
    }
    function get_data_comment_task($ngay, $id){
        $query = $this->db->query("SELECT code, user_id, truonghoc_id, content, create_at, (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS username,
                                    (SELECT file FROM tbl_task_comment_file WHERE tbl_task_comment_file.code = tbl_task_comment.code) AS file
                                    FROM tbl_task_comment WHERE task_id = $id AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$ngay' ORDER BY id DESC");
        return $query->fetchAll();
    }
    function get_avatar_user($id){
        $query = $this->db->query("SELECT avatar FROM tbl_users WHERE id = $id");
        return $query->fetchAll();
    }
    function get_status_task_change($id){
        $query = $this->db->query("SELECT status FROM tbl_task_change WHERE task_id = $id AND status = 0 ORDER BY id DESC LIMIT 0, 1");
        return $query->fetchAll();
    }
    function get_id_of_role($link){
        $query = $this->db->query("SELECT id FROM tbl_roles WHERE link = '$link'");
        return $query->fetchAll();
    }
    function check_chuc_nang_of_user($userid, $idrole, $chucnang){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users_chucnang WHERE user_id = $userid AND roles_id = $idrole
                                    AND chuc_nang = $chucnang");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function check_chucnang($role, $chucnang, $id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users_chucnang WHERE user_id = $id AND roles_id = $role
                                    AND chuc_nang = $chucnang");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_title_lophoc($id){
        $query = $this->db->query("SELECT title_virtual FROM tbldm_phongban WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title_virtual'];
    }
    function get_title_lophoc_via_namhoc($hocsinhid, $namhocid){
        $query = $this->db->query("SELECT title_virtual FROM tbldm_phongban WHERE id = (SELECT phongban_to FROM tbl_chuyenlop
                                    WHERE namhoc_id = $namhocid AND hocsinh_id = $hocsinhid ORDER BY id DESC LIMIT 0, 1)");
        $row = $query->fetchAll();
        return $row[0]['title_virtual'];
    }
    function get_diem_danh_hocsinh($truonghocid, $hocsinhid, $ngay, $phongban){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_diemdanh WHERE truonghoc_id = $truonghocid AND hocsinh_id = $hocsinhid
                                    AND ngay = '$ngay' AND phongban_id = $phongban");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function get_thietbi_phanbo_phongban($phongbanid, $kieu){
        $where = ($kieu == 1) ? "AND tbl_thongtin_tb.nguyen_gia >= 10000000" : "AND tbl_thongtin_tb.nguyen_gia < 10000000";
        if($kieu  == 1){
            $where = "AND tbl_thongtin_tb.nguyen_gia >= 10000000";
        }elseif($kieu == 2){
            $where = "AND tbl_thongtin_tb.nguyen_gia < 10000000";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT so_con, thietbi_id, (SELECT title FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id $where) AS title,
                                    (SELECT tbl_thongtin_tb.code FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id $where) AS mathietbi,
                                    (SELECT nam_su_dung FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id $where) AS namsudung,
                                    (SELECT nguyen_gia FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id $where) AS nguyengia,
                                    (SELECT khau_hao FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id $where) AS khauhao,
                                    (SELECT xuat_su FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id) AS xuatsu,
                                    (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = (SELECT tbl_thongtin_tb.cate_id FROM tbl_thongtin_tb
                                    WHERE tbl_thongtin_tb.id = thietbi_id $where)) AS danhmuc, (SELECT cate_id FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id) AS cateid
                                    FROM tbl_phanbo_ct WHERE code = (SELECT tbl_phanbo.code FROM tbl_phanbo WHERE tbl_phanbo.phongban_id = $phongbanid
                                    AND status = 0)");
        return $query->fetchAll();
    }
    function get_chuc_nang_of_user($userid, $roles){
        $query = $this->db->query("SELECT roles_id, chuc_nang FROM tbl_users_chucnang WHERE user_id = $userid AND roles_id =  $roles");
        return $query->fetchAll();
    }
/////////////////////////////////////end cac ham khac ///////////////////////////////////////////////////////////////////////

}

?>
