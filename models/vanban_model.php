<?php
class Vanban_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    /**
     * danh muc van ban
     **/
    function getFetObj_dm($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_vanban WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title FROM tbldm_vanban WHERE truonghoc_id = $truonghocid
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function addObj_dm($data){
        $query = $this->insert("tbldm_vanban", $data);
        return $query;
    }
    
    function updateObj_dm($id, $data){
        $query = $this->update("tbldm_vanban", $data, "id = $id");
        return $query;
    }
    
    function delObj_dm($id){
        $query = $this->delete("tbldm_vanban", "id = $id");
        return $query;
    }
    /**
     * van ban den
     **/
    function getFetObj_vbd($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban_den WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, cate_id, so_den, ngay_den, so_vanban, ngay_vanban, title, create_at, file,
                                (SELECT tbldm_vanban.title FROM tbldm_vanban WHERE tbldm_vanban.id = cate_id) AS danhmuc,
                                user_id, (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoitao, truonghoc_id
                                FROM tbl_vanban_den WHERE truonghoc_id = $truonghocid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj_vbd($truonghocid, $id, $soden, $sovanban){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban_den WHERE truonghoc_id = $truonghocid
                                    AND (so_den = '$soden' OR so_vanban = '$sovanban')");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban_den WHERE truonghoc_id = $truonghocid
                                        AND id != $id AND (so_den = '$soden' OR so_vanban = '$sovanban')");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_detail_edit($id){
        $query = $this->db->query("SELECT * FROM tbl_vanban_den WHERE id = $id");
        return $query->fetchAll();
    }
    
    function get_detail($id){
        $query = $this->db->query("SELECT id, truonghoc_id, title, file, so_den, ngay_den, so_vanban, ngay_vanban,
                                    (SELECT tbldm_vanban.title FROM tbldm_vanban WHERE tbldm_vanban.id = cate_id) AS danhmuc 
                                    FROM tbl_vanban_den WHERE id = $id");
        return $query->fetchAll();
    }
    
    function addObj_vbd($data){
        $query = $this->insert("tbl_vanban_den", $data);
        return $query;
    }
    
    function updateObj_vbd($id, $data){
        $query = $this->update("tbl_vanban_den", $data, "id = $id");
        return $query;
    }
    
    function delObj_vbd($id){
        $query = $this->delete("tbl_vanban_den", "id = $id");
        return $query;
    }
    
    /**
     * van ban di
     **/
    function getFetObj_vbdi($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban_di WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, so_vanban, ngay_vanban, file, create_at, user_id, cate_id, truonghoc_id,
                                    (SELECT tbldm_vanban.title FROM tbldm_vanban WHERE tbldm_vanban.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoitao 
                                    FROM tbl_vanban_di WHERE truonghoc_id = $truonghocid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function dupliObj_vbdi($truonghocid, $id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban_di WHERE truonghoc_id = $truonghocid
                                    AND so_vanban = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban_di WHERE truonghoc_id = $truonghocid
                                        AND so_vanban = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_detail_edit_vbdi($id){
        $query = $this->db->query("SELECT * FROM tbl_vanban_di WHERE id = $id");
        return $query->fetchAll();
    }
    
    function get_detail_vbdi($id){
        $query = $this->db->query("SELECT id, truonghoc_id, title, file, so_vanban, ngay_vanban,
                                    (SELECT tbldm_vanban.title FROM tbldm_vanban WHERE tbldm_vanban.id = cate_id) AS danhmuc 
                                    FROM tbl_vanban_di WHERE id = $id");
        return $query->fetchAll();
    }
    
    function addObj_vbdi($data){
        $query = $this->insert("tbl_vanban_di", $data);
        return $query;
    }
    
    function updateObj_vbdi($id, $data){
        $query = $this->update("tbl_vanban_di", $data, "id = $id");
        return $query;
    }
    
    function delObj_vbdi($id){
        $query = $this->delete("tbl_vanban_dis", "id = $id");
        return $query;
    }
    
    /**
     * functio other
     **/
    function addObj_online($data){
        $query = $this->insert("tbl_vanban", $data);
        return $query;
    }
    
}
?>