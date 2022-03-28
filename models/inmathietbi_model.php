<?php
class Inmathietbi_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid
                                    AND status != 99 AND so_luong > 0");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, image, title, (SELECT tbldm_thietbi.title FROM tbldm_thietbi 
                                    WHERE tbldm_thietbi.id = cate_id) AS danhmuc, so_luong, cate_id, nguyen_gia,
                                    truonghoc_id FROM tbl_thongtin_tb
                                    WHERE truonghoc_id = $truonghocid AND status != 99 AND so_luong > 0
                                    ORDER BY title ASC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function get_info_truonghoc($truonghocid){
        $query = $this->db->query("SELECT * FROM tbl_truonghoc WHERE id= $truonghocid");
        return $query->fetchAll();
    }
}
?>