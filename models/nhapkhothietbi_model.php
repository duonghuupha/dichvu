<?php
class Nhapkhothietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($keyword, $truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND status != 99 AND title LIKE '%$keyword%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, image, title, so_luong, cate_id, nguyen_gia, (SELECT tbldm_thietbi.title FROM tbldm_thietbi
                                    WHERE tbldm_thietbi.id = cate_id) AS danhmuc FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND status != 99 AND title LIKE '%$keyword%' ORDER BY title ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_thongtin_tb", $data, "id = $id");
        return $query;
    }
}
?>