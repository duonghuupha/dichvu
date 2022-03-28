<?php
class Caidattruonghoc_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function get_phantuyen($truonghocid){
        $query = $this->db->query("SELECT * FROM tbl_phantuyents WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }
    
    function addObj_phantuyen($data){
        $query = $this->insert("tbl_phantuyents", $data);
        return $query;
    }
    
    function updateObj_phantuyen($truonghocid, $data){
        $query = $this->update("tbl_phantuyents", $data, "truonghoc_id = $truonghocid");
        return $query;
    }
}
?>