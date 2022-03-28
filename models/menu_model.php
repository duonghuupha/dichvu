<?php
class Menu_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_dichvu(){
        $query = $this->db->query("SELECT id, title FROM tbldm_dichvu");
        return $query->fetchAll();
    }
    
    function addObj($data){
        $query = $this->insert("tbl_roles", $data);
        return $query;
    }
    
    function updateObj($id, $data){
        $query = $this->update("tbl_roles", $data, "id = $id");
        return $query;
    }
    
    function delObj($id){
        $query = $this->delete("tbl_roles", "id = $id");
        return $query;
    }
    
    function check_exit_menu_in_roles($id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE FIND_IN_SET($id, roles)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_combo($id){
        $query = $this->db->query("SELECT id, parent_id, title FROM tbl_roles WHERE dichvu_id = $id
                                    ORDER BY thu_tu");
        return $query->fetchAll();
    }
    
    function display($id){
        $query = $this->db->query("SELECT * FROM tbl_roles WHERE id = $id");
        return $query->fetchAll();
    }
}
?>