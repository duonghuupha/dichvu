<?php
class Hocsinh_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($truonghocid, $phongbanid, $keyword, $offset, $rows){
        $result = array();
        $where = " fullname LIKE '%$keyword%'";
        if($phongbanid != 0)
            $where = $where." AND phongban_id = $phongbanid";
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
                                    AND status != 99 AND $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, ngay_sinh, gioi_tinh, dia_chi, status,
                                    (SELECT title_virtual FROM tbldm_phongban WHERE tbldm_phongban.id = phongban_id) AS lophoc,
                                    phongban_id AS lophoc_id FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
                                    AND status != 99 AND $where ORDER BY fullname ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($truonghocid, $code, $id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE code = '$code'
                                    AND truonghoc_id = $truonghocid");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE code = '$code' AND id != $id
                                        AND truonghoc_id = $truonghocid");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_hocsinh", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_hocsinh", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_hocsinh", "id = $id");
        return $query;
    }

    function addObj_quanhe($data){
        $query = $this->insert("tbl_quanhe", $data);
        return $query;
    }

    function delObj_quanhe($code){
        $query = $this->delete("tbl_quanhe", "code = '$code'");
        return $query;
    }

    function get_info_phongban_via_userid($userid, $truonghocid, $namhocid){
        $query = $this->db->query("SELECT * FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
                                    AND namhoc_id = $namhocid AND FIND_IN_SET($userid, giao_vien)");
        return $query->fetchAll();
    }

    function display($id){
        $query = $this->db->query("SELECT * FROM tbl_hocsinh WHERE id = $id");
        return $query->fetchAll();
    }

    function get_quanhe_hocsinh($code){
        $query = $this->db->query("SELECT * FROM tbl_quanhe WHERE code = '$code'");
        return $query->fetchAll();
    }

    function delObj_temp($truonghocid){
        $query = $this->delete("tbl_hocsinh", "truonghoc_id = $truonghocid AND status = 99");
        return $query;
    }

    function get_list_hoc_sinh_temp($truonghocid, $keyword, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
                                    AND fullname LIKE '%keyword%' AND status = 99");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, truonghoc_id, code, fullname, ngay_sinh, gioi_tinh, dia_chi FROM tbl_hocsinh
                                    WHERE truonghoc_id = $truonghocid AND status = 99 AND fullname LIKE '%$keyword%'
                                    ORDER BY fullname ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function update_all_tmp($truonghocid){
        $query = $this->db->query("UPDATE tbl_hocsinh SET status = 1 WHERE status = 99
                                    AND truonghoc_id = $truonghocid");
        return $query;
    }

    function get_all_hocsinh_temp_before_update($truonghocid){
        $query = $this->db->query("SELECT id, phongban_id FROM tbl_hocsinh WHERE status = 99 AND truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function check_dupli_code($truonghocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
                                    GROUP BY code HAVING Total > 1 ");
        $row = $query->fetchAll();
        return count($row);
    }

    function qua_trinh_chuyen_lop($hocsinhid){
        $query = $this->db->query("SELECT id, hocsinh_id, phongban_from, phongban_to, (SELECT tbldm_phongban.title_virtual
                                    FROM tbldm_phongban WHERE tbldm_phongban.id = phongban_from) AS tu,
                                    (SELECT tbldm_phongban.title_virtual FROM tbldm_phongban WHERE
                                    tbldm_phongban.id = phongban_to) AS den, date_change
                                    FROM tbl_chuyenlop WHERE hocsinh_id = $hocsinhid ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_id_hoc_sinh_via_code($code){
        $query = $this->db->query("SELECT id FROM tbl_hocsinh WHERE code = '$code'");
        $row = $query->fetchAll();
        return $row[0]['id'];
    }

    function add_chuyenlop($data){
        $query = $this->insert("tbl_chuyenlop", $data);
        return $query;
    }

    function get_data_display($truonghocid, $namhocid, $lophoc, $gioitinh, $ngaysinh, $trangthai, $offset, $rows){
        $result = array();
        $where = "status != 99";
        if($namhocid != '')
            $where = $where." AND tbl_hocsinh.id IN (SELECT hocsinh_id FROM tbl_chuyenlop
                                WHERE tbl_chuyenlop.phongban_to IN (SELECT tbldm_phongban.id
                                FROM tbldm_phongban WHERE tbldm_phongban.namhoc_id = $namhocid AND truonghoc_id = $truonghocid))";
        if($lophoc != '')
            $where = $where." AND tbl_hocsinh.id IN (SELECT hocsinh_id FROM tbl_chuyenlop WHERE tbl_chuyenlop.phongban_to = $lophoc)";
        if($gioitinh != 0)
            $where = $where." AND gioi_tinh = $gioitinh";
        if($ngaysinh != '')
            $where = $where." AND DATE_FORMAT(ngay_sinh, '%m-%Y') = '$ngaysinh'";
        if($trangthai != 0)
            $status = "status = $trangthai";
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, ngay_sinh, gioi_tinh, dia_chi, status FROM tbl_hocsinh
                                    WHERE $where ORDER BY fullname ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_data_expoort($truonghocid, $namhocid, $lophoc, $gioitinh, $ngaysinh, $trangthai){
        $result = array();
        $where = "status != 99";
        if($namhocid != '')
            $where = $where." AND tbl_hocsinh.id IN (SELECT hocsinh_id FROM tbl_chuyenlop
                                WHERE tbl_chuyenlop.phongban_to IN (SELECT tbldm_phongban.id
                                FROM tbldm_phongban WHERE tbldm_phongban.namhoc_id = $namhocid AND truonghoc_id = $truonghocid))";
        if($lophoc != '')
            $where = $where." AND tbl_hocsinh.id IN (SELECT hocsinh_id FROM tbl_chuyenlop WHERE tbl_chuyenlop.phongban_to = $lophoc)";
        if($gioitinh != 0)
            $where = $where." AND gioi_tinh = $gioitinh";
        if($ngaysinh != '')
            $where = $where." AND DATE_FORMAT(ngay_sinh, '%m-%Y') = '$ngaysinh'";
        if($trangthai != 0)
            $status = "status = $trangthai";
        $query = $this->db->query("SELECT id, code, fullname, ngay_sinh, gioi_tinh, dia_chi, status FROM tbl_hocsinh
                                    WHERE $where ORDER BY fullname ASC");
        return $query->fetchAll();
    }

    function get_quanhe_hocsinh_export($code, $loaiquanhe){
        $query = $this->db->query("SELECT * FROM tbl_quanhe WHERE code = '$code' AND loai_quan_he = $loaiquanhe");
        return $query->fetchAll();
    }
}
?>
