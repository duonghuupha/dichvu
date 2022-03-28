<?php
class Tuyensinh_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $code, $name, $doituong, $tuoi, $offset, $rows){
        $result = array();
        $where = "truonghoc_id = $truonghocid";
        if($code != '')
            $where = $where." AND code LIKE '%$code%'";
        if($name != '')
            $where = $where." AND ho_ten LIKE '%$name%'";
        if($doituong != '')
            $where = $where." AND doi_tuong = $doituong";
        if($tuoi != '')
            $where = $where." AND (YEAR(NOW()) - YEAR(ngay_sinh)) = $tuoi";
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_tuyensinh WHERE $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, ho_ten, ngay_sinh, gioi_tinh, doi_tuong, create_at FROM tbl_tuyensinh
                                    WHERE $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
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
    
    function display($id){
        $query = $this->db->query("SELECT * FROM tbl_tuyensinh WHERE id = $id");
        return $query->fetchAll();
    }
    
    function addObj($data){
        $query = $this->insert("tbl_tuyensinh", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_tuyensinh", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbl_tuyensinh", "id = $id");
        return $query;
    }
    
    function get_detail_truonghoc($id){
        $query = $this->db->query("SELECT * FROM tbl_truonghoc WHERE id = $id");
        return $query->fetchAll();
    }
    
    function add_thong_tin_ho_so($data){
        $query = $this->insert("tbl_hosotuyensinh", $data);
        return $query;
    }
    
    function check_exit_ho_so($code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hosotuyensinh WHERE code = '$code'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function update_thong_tin_ho_so($code, $data){
        $query = $this->update("tbl_hosotuyensinh", $data, "code = '$code'" );
        return $query;
    }
    
    function get_detail_via_code($code){
        $query = $this->db->query("SELECT * FROM tbl_tuyensinh WHERE code = '$code'");
        return $query->fetchAll();
    }
    
    function get_detail_thong_tin_ho_so($code){
        $query = $this->db->query("SELECT id, user_id, don_xin_hoc, giay_khai_sinh, photo_ho_khau,
            giay_to_khac, cmnd, nguoigiao, tu_ngay, suc_khoe,
            (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoinhan,
            (SELECT cccd FROM tbl_users WHERE tbl_users.id = user_id) AS cmt
            FROM tbl_hosotuyensinh WHERE code = '$code'");
        return $query->fetchAll();
    }
}
?>