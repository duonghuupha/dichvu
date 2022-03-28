<?php
class Thongtinthietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND status != 99");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, image, title, cate_id, nam_su_dung, nguyen_gia, khau_hao, xuat_su, mo_ta, truonghoc_id,
                                    status, (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc
                                    FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid AND status != 99 
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj($truonghocid, $id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND code = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function addObj($data){
        $query = $this->insert("tbl_thongtin_tb", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_thongtin_tb", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbl_thongtin_tb", "id = $id");
        return $query;
    }
    
    function delObj_temp($truonghocid){
        $query = $this->delete("tbl_thongtin_tb", "truonghoc_id = $truonghocid AND status = 99");
        return $query;
    }
    
    function getFetObj_tmp($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND status = 99");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, image, title, cate_id, nam_su_dung, nguyen_gia, khau_hao, xuat_su, mo_ta, truonghoc_id,
                                    status, (SELECT tbldm_thietbi.title FROM tbldm_thietbi WHERE tbldm_thietbi.id = cate_id) AS danhmuc,
                                    so_luong FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid AND status = 99 
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function update_all_tmp($truonghocid){
        $query = $this->db->query("UPDATE tbl_thongtin_tb SET status = 0 WHERE status = 99 
                                    AND truonghoc_id = $truonghocid");
        return $query;
    }
    
    function check_dupli_code($truonghocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid 
                                    GROUP BY code HAVING Total > 1 ");
        $row = $query->fetchAll();
        return count($row);
    }
}
?>