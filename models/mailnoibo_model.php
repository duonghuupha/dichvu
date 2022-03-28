<?php
class Mailnoibo_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function getFetObj($truonghocid, $userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_mail WHERE truonghoc_id = $truonghocid
                                    AND user_id = $userid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, user_id, subject, status, readed, create_at FROM tbl_mail
                                    WHERE truonghoc_id = $truonghocid AND user_id = $userid ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    
    function addObj($data){
        $query = $this->insert("tbl_mail", $data);
        return $query;
    }
}
?>