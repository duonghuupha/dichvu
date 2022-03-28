<?php
class Denghitrangcap_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($truonghocid, $userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_trangcap WHERE truonghoc_id = $truonghocid
                                    AND (user_id = $userid OR user_app = $userid)");

        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, ngay_de_nghi, user_id, user_app, content, ghi_chu, create_at,
                                    trang_thai, file FROM tbl_trangcap WHERE truonghoc_id = $truonghocid AND
                                    (user_id = $userid OR user_app = $userid) ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_trangcap WHERE code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_trangcap WHERE code = '$code'
                                        AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function display($id){
        $query = $this->db->query("SELECT * FROM tbl_trangcap WHERE id = $id");
        return $query->fetchAll();
    }

    function get_detail($code){
        $query = $this->db->query("SELECT * FROM tbl_trangcap_ct WHERE code= '$code'");
        return $query->fetchAll();
    }

    function addObj($data){
        $query = $this->insert("tbl_trangcap", $data);
        return $query;
    }

    function addObj_ct($data){
        $query = $this->insert("tbl_trangcap_ct", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_trangcap", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_trangcap", "id = $id");
        return $query;
    }

    function delObj_ct($code){
        $query = $this->delete("tbl_trangcap_ct", "code = '$code'");
        return $query;
    }

    function get_detail_info($id){
        $query = $this->db->query("SELECT id, truonghoc_id, ngay_de_nghi, code, content, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS nguoidenghi, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_app) AS nguoiduyet, ghi_chu, trang_thai,
                                    (SELECT job FROM tbl_users WHERE tbl_users.id = user_id) AS job FROM tbl_trangcap WHERE id = $id");
        return $query->fetchAll();
    }
}
?>
