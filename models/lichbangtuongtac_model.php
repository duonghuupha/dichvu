<?php
class Lichbangtuongtac_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj(){

    }

    function addObj($data){
        $query = $this->insert("tbl_bangtuongtac", $data);
        return  $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_bangtuongtac", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_bangtuongtac", "id = $id");
        return  $query;
    }

    function get_detail_khunggio($id){
        $query = $this->db->query("SELECT id, bat_dau, ket_thuc FROM tbldm_khunggio WHERE id = $id");
        return $query->fetchAll();
    }

    function dupliObj($id, $ngayhoc, $khunggio){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_bangtuongtac WHERE ngay_hoc = '$ngayhoc'
                                    AND time_id = $khunggio");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_bangtuongtac WHERE ngay_hoc = '$ngayhoc'
                                    AND time_id = $khunggio AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_detail($id){
        $query = $this->db->query("SELECT id, title, ngay_hoc, bat_dau, ket_thuc, time_id, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id=  user_id) AS nguoidung FROM tbl_bangtuongtac WHERE id = $id");
        return $query->fetchAll();
    }

    function get_info_baocao($truonghocid, $date, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_bangtuongtac WHERE DATE_FORMAT(ngay_hoc, '%Y-%m') = '$date'
                                    AND truonghoc_id = $truonghocid");
        $row  = $query->fetchAll();
        $query = $this->db->query("SELECT ngay_hoc, bat_dau, ket_thuc, title, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS fullname FROM tbl_bangtuongtac WHERE DATE_FORMAT(ngay_hoc, '%Y-%m') = '$date'
                                    AND truonghoc_id = $truonghocid ORDER BY ngay_hoc ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_info_baocao_excel($truonghocid, $date){
        $query = $this->db->query("SELECT ngay_hoc, bat_dau, ket_thuc, title, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS fullname FROM tbl_bangtuongtac WHERE DATE_FORMAT(ngay_hoc, '%Y-%m') = '$date'
                                    AND truonghoc_id = $truonghocid ORDER BY ngay_hoc ASC");
        return $query->fetchAll();
    }
}
?>
