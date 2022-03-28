<?php
class Nguoidung_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($truonghocid, $offset, $rows){
        $result = array();
        if($truonghocid == 0){
            $where = "WHERE truonghoc_id = 0 OR is_boss = 1";
        }else{
            $where = "WHERE truonghoc_id = $truonghocid AND is_boss = 0";
        }
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, username, IF(truonghoc_id = 0, 'Trường học Tập trung', (SELECT title FROM tbl_truonghoc
                                    WHERE tbl_truonghoc.id = truonghoc_id)) AS truonghoc, truonghoc_id, fullname, avatar, active,
                                    is_boss, job FROM tbl_users $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($truonghocid, $id, $username){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username' AND truonghoc_id = $truonghocid");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username' AND id != $id
                                    AND truonghoc_id = $truonghocid");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_detail($id){
        $query = $this->db->query("SELECT * FROM tbl_users WHERE id = $id");
        return $query->fetchAll();
    }

    function addObj($data){
        $query = $this->insert("tbl_users", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_users", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_users", "id = $id");
        return $query;
    }

    function get_dichvu_sudung($truonghocid){
        $query = $this->db->query("SELECT id, title FROM tbldm_dichvu WHERE FIND_IN_SET(id, (SELECT dichvu_id FROM tbl_truonghoc
                                    WHERE tbl_truonghoc.id = $truonghocid))");
        return $query->fetchAll();
    }

    function addObj_chucnang($data){
        $query = $this->insert("tbl_users_chucnang", $data);
        return $query;
    }

    function delObj_chucnang($id){
        $query = $this->delete("tbl_users_chucnang", "user_id = $id");
        return $query;
    }

    function get_nguoidung_copy($truonghocid, $id){
        $query = $this->db->query("SELECT id, fullname, job FROM tbl_users WHERE truonghoc_id = $truonghocid
                                    AND id != $id AND active = 1 AND is_boss = 0");
        return $query->fetchAll();
    }

    function get_roles($userid){
        $query = $this->db->query("SELECT id, title, parent_id, chuc_nang, is_menu FROM tbl_roles WHERE FIND_IN_SET(id, (SELECT roles FROM tbl_users WHERE tbl_users.id = $userid))");
        return $query->fetchAll();
    }

    function get_all_chuc_nang_of_user($userid){
        $query = $this->db->query("SELECT roles_id, chuc_nang FROM tbl_users_chucnang WHERE user_id = $userid");
        return $query->fetchAll();
    }

    function get_export($truonghocid){
        $result = array();
        if($truonghocid == 0){
            $where = "WHERE truonghoc_id = 0 OR is_boss = 1";
        }else{
            $where = "WHERE truonghoc_id = $truonghocid AND is_boss = 0";
        }
        $query = $this->db->query("SELECT id, username, IF(truonghoc_id = 0, 'Trường học Tập trung', (SELECT title FROM tbl_truonghoc
                                    WHERE tbl_truonghoc.id = truonghoc_id)) AS truonghoc, truonghoc_id, fullname, avatar, active,
                                    is_boss, job FROM tbl_users $where ORDER BY id DESC");
        return $query->fetchAll();
    }
}
?>
