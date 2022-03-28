<?php
class Erp_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($keyword, $userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_task WHERE (user_id = $userid OR user_id_task = $userid
                                    OR FIND_IN_SET($userid, user_id_follow)) AND content LIKE '%$keyword%'");
        $row = $query->fetchAll();
        $querry = $this->db->query("SELECT id, code, date_start, date_end, date_finish, content, tien_do, user_id_follow, user_id, status,
                                    uu_tien, create_at, (SELECT title FROM tbl_taskgroup WHERE tbl_taskgroup.id= group_id)  AS nhomcongviec,
                                    (SELECT tbl_users.fullname FROM tbl_users WHERE tbl_users.id = user_id_task) AS fullname,
                                    IF((SELECT COUNT(*) FROM tbl_task_change WHERE tbl_task_change.task_id = tbl_task.id AND tbl_task_change.status = 1
                                    ORDER BY tbl_task_change.id DESC LIMIT 0, 1) > 0,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = (SELECT tbl_task_change.user_id FROM tbl_task_change
                                    WHERE tbl_task_change.task_id = tbl_task.id AND tbl_task_change.status = 1 ORDER BY tbl_task_change.id DESC LIMIT 0, 1)),
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id_task)) AS thuchienchinh
                                    FROM tbl_task WHERE (user_id = $userid OR user_id_task = $userid OR FIND_IN_SET($userid, user_id_follow))
                                    AND content LIKE '%$keyword%' ORDER BY id DESC");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $querry->fetchAll();
        return  $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_task", $data);
        return $query;
    }

    function addObj_File($data){
        $query = $this->insert("tbl_task_attach", $data);
        return $query;
    }

    function get_detail($id){
        $query = $this->db->query("SELECT id, code, group_id, user_id, user_id_follow, date_start, date_end, date_finish, content,
                                    status, tien_do, uu_tien, create_at, (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id_task) AS fullname,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoitao, (SELECT title FROM tbl_taskgroup
                                    WHERE tbl_taskgroup.id = group_id) AS nhomcongviec, truonghoc_id,
                                    IF((SELECT COUNT(*) FROM tbl_task_change WHERE tbl_task_change.task_id = tbl_task.id AND tbl_task_change.status = 1
                                    ORDER BY tbl_task_change.id DESC LIMIT 0, 1) > 0,
                                    (SELECT tbl_task_change.user_id FROM tbl_task_change WHERE tbl_task_change.task_id = tbl_task.id AND tbl_task_change.status = 1
                                    ORDER BY tbl_task_change.id DESC LIMIT 0, 1), user_id_task) AS user_id_task
                                    FROM tbl_task WHERE id = $id");
        return $query->fetchAll();
    }

    function get_task_attach($code){
        $query = $this->db->query("SELECT * FROM tbl_task_attach WHERE code = '$code'");
        return $query->fetchAll();
    }

    function get_all_comment_via_date($id){
        $query = $this->db->query("SELECT DATE_FORMAT(create_at, '%Y-%m-%d') AS ngay FROM tbl_task_comment WHERE task_id = $id
                                    GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d') ORDER BY create_at DESC");
        return  $query->fetchAll();
    }

    function addObj_comment($data){
        $query = $this->insert("tbl_task_comment", $data);
        return $query;
    }

    function addObj_comment_File($data){
        $query = $this->insert("tbl_task_comment_file", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_task", $data, "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT id, code, user_id, user_id_task, user_id_follow, content, uu_tien, group_id, truonghoc_id,
                                    DATE_FORMAT(date_start, '%d-%m-%Y') AS date_start, DATE_FORMAT(date_start, '%H:%i') AS time_start,
                                    DATE_FORMAT(date_end, '%d-%m-%Y') AS date_end, DATE_FORMAT(date_end, '%H:%i') AS time_end
                                    FROM tbl_task WHERE id = $id");
        return $query->fetchAll();
    }

    function delObj($id){
        $query = $this->delete("tbl_task", "id = $id");
        return $query;
    }

    function get_code_task($id){
        $query = $this->db->query("SELECT code FROM tbl_task WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['code'];
    }

    function get_all_comment_of_task($id){
        $query = $this->db->query("SELECT code FROM tbl_task_comment WHERE task_id = $id");
        return $query->fetchAll();
    }

    function addObj_chuyen($data){
        $query = $this->insert("tbl_task_change", $data);
        return $query;
    }

    function updateObj_chuyen($id, $data){
        $query = $this->update("tbl_task_change", $data, "id = $id");
        return $query;
    }

    function get_id_task_change($id){
        $query = $this->db->query("SELECT id FROM tbl_task_change WHERE task_id = $id AND status = 0");
        $row = $query->fetchAll();
        return $row[0]['id'];
    }

    function get_info_user($userid){
        $query = $this->db->query("SELECT id, fullname, job FROM tbl_users WHERE FIND_IN_SET(id, '$userid')");
        return $query->fetchAll();
    }

    function get_info_truonghoc($id){
        $query = $this->db->query("SELECT * FROM tbl_truonghoc WHERE id = $id");
        return $query->fetchAll();
    }
}
?>
