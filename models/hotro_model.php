<?php
class Hotro_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $userid, $roles, $offset, $rows){
        $result = array();
        if($truonghocid != 0){
            if($roles == 0){
                $where = "user_id = $userid";
            }else{
                $where = "user_id = $userid OR id IN (SELECT yeucau_id FROM tbl_yeucau_pro)";
            }
        }else{
            $where = "id IN (SELECT yeucau_id FROM tbl_yeucau_pro)";
        }
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_yeucau WHERE $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, sodienthoai, (SELECT title FROM tbldm_danhmuc WHERE tbldm_danhmuc.id = danhmuc_id) AS danhmuc, 
                                    (SELECT title FROM tbldm_dichvu WHERE tbldm_dichvu.id = (SELECT dichvu_id FROM tbldm_danhmuc WHERE tbldm_danhmuc.id = danhmuc_id)) AS dichvu,
                                    create_at, (SELECT status FROM tbl_yeucau_pro WHERE tbl_yeucau_pro.yeucau_id = tbl_yeucau.id ORDER BY id DESC LIMIT 0, 1) AS status,
                                    (SELECT tbl_yeucau_pro.create_at FROM tbl_yeucau_pro WHERE tbl_yeucau_pro.yeucau_id = tbl_yeucau.id ORDER BY id DESC LIMIT 0, 1) AS ngay 
                                    FROM tbl_yeucau WHERE $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function getFetObj_duyet($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_yeucau WHERE truonghoc_id = $truonghocid AND id NOT IN (SELECT yeucau_id FROM tbl_yeucau_pro)");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, sodienthoai, (SELECT title FROM tbldm_danhmuc WHERE tbldm_danhmuc.id = danhmuc_id) AS danhmuc, 
                                    (SELECT title FROM tbldm_dichvu WHERE tbldm_dichvu.id = (SELECT dichvu_id FROM tbldm_danhmuc WHERE tbldm_danhmuc.id = danhmuc_id)) AS dichvu,
                                    create_at FROM tbl_yeucau WHERE truonghoc_id = $truonghocid AND id NOT IN (SELECT yeucau_id FROM tbl_yeucau_pro)
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function get_detail($id){
        $query = $this->db->query("SELECT id, code, sodienthoai, noidung, (SELECT title FROM tbldm_danhmuc WHERE tbldm_danhmuc.id = danhmuc_id) AS danhmuc, 
                                    (SELECT title FROM tbldm_dichvu WHERE tbldm_dichvu.id = (SELECT dichvu_id FROM tbldm_danhmuc WHERE tbldm_danhmuc.id = danhmuc_id)) AS dichvu,
                                    create_at, image FROM tbl_yeucau WHERE id = $id");
        return $query->fetchAll();
    }
    
    function get_dich_vu_su_dung($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_dichvu WHERE FIND_IN_SET(tbldm_dichvu.id, (SELECT dichvu_id 
                                    FROM tbl_truonghoc WHERE tbl_truonghoc.id = $truonghocid)) ");
        return $query->fetchAll();
    }
    
    function get_dichvu_taptrung(){
        $query = $this->db->query("SELECT id, title FROM tbldm_dichvu");
        return $query->fetchAll();
    }
    
    function get_kieu_dich_vu($truonghocid){
        $query = $this->db->query("SELECT kieudichvu_id, (SELECT tbldm_kieudichvu.title FROM tbldm_kieudichvu 
                                    WHERE tbldm_kieudichvu.id = kieudichvu_id) AS title FROM tbldm_danhmuc 
                                    WHERE FIND_IN_SET(tbldm_danhmuc.dichvu_id, (SELECT tbl_truonghoc.dichvu_id 
                                    FROM tbl_truonghoc WHERE tbl_truonghoc.id = $truonghocid)) GROUP BY kieudichvu_id");
        return $query->fetchAll();
    }
    
    function get_kieudichvu_taptrung(){
        $query = $this->db->query("SELECT id AS kieudichvu_id, title FROM tbldm_kieudichvu");
        return $query->fetchAll();
    }
    
    function get_danhmuc_via_dichvu_kieudichvu($dichvu, $kieudichvu){
        $query = $this->db->query("SELECT id, title FROM tbldm_danhmuc WHERE dichvu_id = $dichvu 
                                    AND kieudichvu_id = $kieudichvu");
        return $query->fetchAll();
    }
    
    function addObj($data){
        $query = $this->insert("tbl_yeucau", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_yeucau", $data, "id = $id");
        return $query;
    }
    
    function add_yeucau_pro($data){
        $query = $this->insert("tbl_yeucau_pro", $data);
        return $query;
    }
    
    function get_process_yeucau($id){
        $query = $this->db->query("SELECT id, yeucau_id, noidung, create_at, status, chu_ky, (SELECT code FROM tbl_yeucau
                                    WHERE tbl_yeucau.id = yeucau_id) AS code, (SELECT title FROM tbldm_danhmuc 
                                    WHERE tbldm_danhmuc.id = (SELECT danhmuc_id FROM tbl_yeucau WHERE tbl_yeucau.id = yeucau_id)) AS danhmuc,
                                    (SELECT title FROM tbldm_dichvu WHERE tbldm_dichvu.id = (SELECT dichvu_id FROM tbldm_danhmuc
                                    WHERE tbldm_danhmuc.id = (SELECT danhmuc_id FROM tbl_yeucau WHERE tbl_yeucau.id = yeucau_id))) AS dichvu,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_pro) AS nhanvien, thoi_gian
                                    FROM tbl_yeucau_pro WHERE yeucau_id = $id ORDER BY id ASC");
        return $query->fetchAll();
    }
    
    function get_combo_thietbi($phongbanid){
        $query = $this->db->query("SELECT thietbi_id, so_con, (SELECT title FROM tbl_thongtin_tb WHERE tbl_thongtin_tb.id = thietbi_id) AS title
                                    FROM tbl_phanbo_ct WHERE status = 0 AND code = (SELECT tbl_phanbo.code FROM tbl_phanbo
                                    WHERE tbl_phanbo.phongban_id = $phongbanid)");
        return $query->fetchAll();
    }
    
    function get_process_yeucau_guimail($id){
        $query = $this->db->query("SELECT id, yeucau_id, noidung, create_at, status, (SELECT code FROM tbl_yeucau
                                    WHERE tbl_yeucau.id = yeucau_id) AS code, (SELECT title FROM tbldm_danhmuc 
                                    WHERE tbldm_danhmuc.id = (SELECT danhmuc_id FROM tbl_yeucau WHERE tbl_yeucau.id = yeucau_id)) AS danhmuc,
                                    (SELECT title FROM tbldm_dichvu WHERE tbldm_dichvu.id = (SELECT dichvu_id FROM tbldm_danhmuc
                                    WHERE tbldm_danhmuc.id = (SELECT danhmuc_id FROM tbl_yeucau WHERE tbl_yeucau.id = yeucau_id))) AS dichvu,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_pro) AS nhanvien, thoi_gian
                                    FROM tbl_yeucau_pro WHERE yeucau_id = $id AND status = 1");
        return $query->fetchAll();
    }
    
    function get_detail_yeucau_via_code($code){
        $query = $this->db->query("SELECT * FROM tbl_yeucau WHERE code = '$code'");
        return $query->fetchAll();
    }
    
    function add_yeucau_chiphi($data){
        $query = $this->insert("tbl_yeucau_chiphi", $data);
        return $query;
    }
}
?>