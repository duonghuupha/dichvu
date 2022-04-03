<?php
class Elearning_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($keyword, $truonghocid, $userid, $offset, $rows){
        $result = array();
        if($userid == 0){
            $where = "";
        }else{
            $where = " AND (user_id = $userid OR publish = 1)";
        }
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_elearning WHERE truonghoc_id = $truonghocid
                                    $where AND (linh_vuc LIKE '%$keyword%' OR de_tai LIKE '%$keyword%' OR user_id IN (SELECT tbl_users.id
                                    FROM tbl_users WHERE tbl_users.fullname LIKE '%$keyword%'))");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, truonghoc_id, exam_id, user_id, linh_vuc, de_tai, file, create_at, is_e, image, publish,
                                    (SELECT title FROM tbldm_exam WHERE tbldm_exam.id = exam_id) AS exam, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS tacgia FROM tbl_elearning
                                    WHERE truonghoc_id = $truonghocid $where AND (linh_vuc LIKE '%$keyword%' OR de_tai LIKE '%$keyword%'
                                    OR user_id IN (SELECT tbl_users.id FROM tbl_users WHERE tbl_users.fullname LIKE '%$keyword%'))
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $examid, $userid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_elearning WHERE exam_id = $examid AND user_id = $userid");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_elearning WHERE exam_id = $examid AND user_id = $userid
                                        AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_elearning", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_elearning", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_elearning", "id = $id");
        return $query;
    }

    function get_detail($id){
        $query = $this->db->query("SELECT * FROM tbl_elearning WHERE id = $id");
        return $query->fetchAll();
    }

    function get_info_exam($id){
        $query = $this->db->query("SELECT * FROM tbldm_exam WHERE id = $id");
        return $query->fetchAll();
    }

    function get_total_e($examid, $userid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_elearning WHERE user_id = $userid AND exam_id = $examid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_export($keyword, $truonghocid, $userid, $user, $examid){
        if($userid == 0){
            if($user == ''){
                $where = "";
            }else{
                $where = " AND FIND_IN_SET(user_id, '$user')";
            }
        }else{
            $where = " AND (user_id = $userid OR (publish = 1 AND FIND_IN_SET(user_id, '$user')))";
        }

        if($examid != ''){
            $exam = " AND exam_id = $examid";
        }else{
            $exam = "";
        }

        $query = $this->db->query("SELECT id, truonghoc_id, exam_id, user_id, linh_vuc, de_tai, file, create_at, is_e, image, publish,
                                    (SELECT title FROM tbldm_exam WHERE tbldm_exam.id = exam_id) AS exam, (SELECT fullname FROM tbl_users
                                    WHERE tbl_users.id = user_id) AS tacgia FROM tbl_elearning
                                    WHERE truonghoc_id = $truonghocid $where $exam AND (linh_vuc LIKE '%$keyword%' OR de_tai LIKE '%$keyword%')
                                    ORDER BY id DESC");
        return $query->fetchAll();
    }
}
?>
