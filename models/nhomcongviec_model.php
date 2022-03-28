<?php
class Nhomcongviec_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($truonghocid, $userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_taskgroup WHERE truonghoc_id = $truonghocid
                                    AND (user_id = $userid OR FIND_IN_SET($userid, user_id_follow))");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, create_at, user_id, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS nguoitao, user_id_follow FROM tbl_taskgroup
                                    WHERE truonghoc_id = $truonghocid AND (user_id = $userid OR FIND_IN_SET($userid, user_id_follow))
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_taskgroup", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_taskgroup", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_taskgroup", "id = $id");
        return $query;
    }
}
?>
