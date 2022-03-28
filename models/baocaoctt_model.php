<?php
class Baocaoctt_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_view_baiviet($truonghocid, $trangthai, $tungay, $denngay, $offset ,$rows){
        $result = array();
        if($trangthai == 1){// chua duyet
            $where = " AND status = 0";
        }elseif($trangthai == 2){ //  da duyet
            $where = " AND status = 1";
        }elseif($trangthai == 3){ // da dang
            $where = " AND status = 2";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_content WHERE truonghoc_id = $truonghocid
                                AND DATE_FORMAT(create_at, '%Y-%m-%d') >= '$tungay' AND DATE_FORMAT(create_at, '%Y-%m-%d') <= '$denngay' $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, truonghoc_id, title, image, cate_id, user_id, link_dang, create_at, create_dang, status,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoiviet FROM tbl_content
                                    WHERE truonghoc_id = $truonghocid AND DATE_FORMAT(create_at, '%Y-%m-%d') >= '$tungay'
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') <= '$denngay' $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_export_baiviet($truonghocid, $trangthai, $tungay, $denngay){
        if($trangthai == 1){// chua duyet
            $where = " AND status = 0";
        }elseif($trangthai == 2){ //  da duyet
            $where = " AND status = 1";
        }elseif($trangthai == 3){ // da dang
            $where = " AND status = 2";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT id, truonghoc_id, title, image, cate_id, user_id, link_dang, create_at, create_dang, status,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoiviet FROM tbl_content
                                    WHERE truonghoc_id = $truonghocid AND DATE_FORMAT(create_at, '%Y-%m-%d') >= '$tungay'
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') <= '$denngay' $where ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_view_vanban($truonghocid, $trangthai, $tungay, $denngay, $offset ,$rows){
        $result = array();
        if($trangthai == 1){// chua duyet
            $where = " AND status = 0";
        }elseif($trangthai == 2){ //  da duyet
            $where = " AND status = 1";
        }elseif($trangthai == 3){ // da dang
            $where = " AND status = 2";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban WHERE truonghoc_id = $truonghocid
                                AND DATE_FORMAT(create_at, '%Y-%m-%d') >= '$tungay' AND DATE_FORMAT(create_at, '%Y-%m-%d') <= '$denngay' $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, truonghoc_id, tieu_de, cate_id, user_id, link_dang, create_at, create_dang, so_vanban, ngay_vanban,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoiviet FROM tbl_vanban
                                    WHERE truonghoc_id = $truonghocid AND DATE_FORMAT(create_at, '%Y-%m-%d') >= '$tungay'
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') <= '$denngay' $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_export_vanban($truonghocid, $trangthai, $tungay, $denngay){
        $result = array();
        if($trangthai == 1){// chua duyet
            $where = " AND status = 0";
        }elseif($trangthai == 2){ //  da duyet
            $where = " AND status = 1";
        }elseif($trangthai == 3){ // da dang
            $where = " AND status = 2";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT id, truonghoc_id, tieu_de, cate_id, user_id, link_dang, create_at, create_dang, so_vanban, ngay_vanban,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoiviet FROM tbl_vanban
                                    WHERE truonghoc_id = $truonghocid AND DATE_FORMAT(create_at, '%Y-%m-%d') >= '$tungay'
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') <= '$denngay' $where ORDER BY id DESC");
        return $query->fetchAll();
    }
}
?>
