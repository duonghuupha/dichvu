<?php
class Exam_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_exam WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, truonghoc_id, title, date_start, date_end, so_luong FROM tbldm_exam
                                    WHERE truonghoc_id = $truonghocid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_exam", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_exam",$data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_exam", "id = $id");
        return $query;
    }

    function get_detail($id){
        $query = $this->db->query("SELECT id, date_start, date_end FROM tbldm_exam WHERE id = $id");
        return $query->fetchAll();
    }
}
?>
