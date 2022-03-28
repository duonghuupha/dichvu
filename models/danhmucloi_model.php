<?php
class Danhmucloi_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_danhmuc");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, (SELECT tbldm_kieudichvu.title FROM tbldm_kieudichvu
                                    WHERE tbldm_kieudichvu.id = kieudichvu_id) AS kieudichvu, kieudichvu_id,
                                    (SELECT tbldm_dichvu.title FROM tbldm_dichvu WHERE tbldm_dichvu.id = dichvu_id) AS dichvu,
                                    dichvu_id FROM tbldm_danhmuc ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_danhmuc", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_danhmuc", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_danhmuc", "id = $id");
        return $query;
    }
}
?>