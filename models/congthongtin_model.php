<?php
class Congthongtin_Model extends Model{
    function __construct(){
        parent::__construct();
    }
    /**
     * cac ham lien quan den thong tin cong thong tin dien tu
     **/
    function addObj_thongtin($data){
        $query = $this->insert("tbl_thongtin_ctt", $data);
        return $query;
    }

    function get_info($truonghocid){
        $query = $this->db->query("SELECT * FROM tbl_thongtin_ctt WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }

    function updateObj_thongtin($id, $data){
        $query = $this->update("tbl_thongtin_ctt", $data, "id = $id");
        return $query;
    }
    /**
     * cac ham lien quan den danh muc bai viet
     **/
    function getFetObj_danhmuc($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_content WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title FROM tbldm_content WHERE truonghoc_id = $truonghocid
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj_danhmuc($data){
        $query = $this->insert("tbldm_content", $data);
        return $query;
    }

    function updateObj_danhmuc($id, $data){
        $query = $this->update("tbldm_content", $data, "id = $id");
        return $query;
    }

    function delObj_danhmuc($id){
        $query = $this->delete("tbldm_content", "id = $id");
        return $query;
    }
    /**
     * cac ham liewn quan den bai viet
     **/
    function getFetObj_baiviet($truonghocid, $userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_content WHERE truonghoc_id = $truonghocid
                                    AND user_id = $userid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, image, tieu_diem, hien_thi_trang_chu, hien_thi_detail, create_at, status,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    create_dang, link_dang, truonghoc_id FROM tbl_content WHERE truonghoc_id = $truonghocid
                                    AND user_id = $userid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function getFetObj_duyet($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_content WHERE truonghoc_id = $truonghocid AND status = 0");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, image, truonghoc_id, create_at,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoiviet
                                    FROM tbl_content WHERE truonghoc_id = $truonghocid AND status = 0
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_detail($id){
        $query = $this->db->query("SELECT id, title, intro, content, image, tieu_diem, hien_thi_trang_chu, hien_thi_detail, truonghoc_id,
                                    create_at, (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    file, user_id, status, create_dang, link_dang FROM tbl_content WHERE id = $id");
        return $query->fetchAll();
    }

    function get_detail_update($id){
        $query = $this->db->query("SELECT * FROM tbl_content WHERE id = $id");
        return $query->fetchAll();
    }

    function add_baiviet($data){
        $query = $this->insert("tbl_content", $data);
        return $query;
    }

    function update_baiviet($id, $data){
        $query = $this->update("tbl_content", $data, "id = $id");
        return $query;
    }

    function del_baiviet($id){
        $query = $this->delete("tbl_content", "id = $id");
        return $query;
    }

    function getFetObj_dang($truonghocid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_content WHERE truonghoc_id = $truonghocid AND status = 1
                                    AND create_dang IS NULL");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, image, truonghoc_id, create_at,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS nguoiviet
                                    FROM tbl_content WHERE truonghoc_id = $truonghocid AND status = 1 AND create_dang IS NULL
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    /**
     * cac ham lien quan den van ban dang cong thong tin dien tu
     **/
    function getFetObj_vanban($truonghocid, $userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban WHERE truonghoc_id = $truonghocid
                                    AND user_id = $userid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, tieu_de, so_vanban, ngay_vanban, hien_thi_home, hien_thi_phong, create_at,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    create_dang, link_dang, truonghoc_id FROM tbl_vanban WHERE truonghoc_id = $truonghocid
                                    AND user_id = $userid ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($truonghocid, $id, $sovanban){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban WHERE so_vanban = '$sovanban' AND truonghoc_id = $truonghocid");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vanban WHERE so_vanban = '$sovanban'
                                        AND id != $id AND truonghoc_id = $truonghocids");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_detail_vanban($id){
        $query = $this->db->query("SELECT id, tieu_de, so_vanban, ngay_vanban, trich_yeu, create_at, hien_thi_phong, file, truonghoc_id,
                                    (SELECT tbldm_content.title FROM tbldm_content WHERE tbldm_content.id = cate_id) AS danhmuc,
                                    hien_thi_home, link_dang, create_dang FROM tbl_vanban WHERE id = $id");
        return $query->fetchAll();
    }

    function get_updatE_vanban($id){
        $query = $this->db->query("SELECT * FROM tbl_vanban WHERE id = $id");
        return $query->fetchAll();
    }

    function add_vanban($data){
        $query = $this->insert("tbl_vanban", $data);
        return $query;
    }

    function update_vanban($id, $data){
        $query = $this->update("tbl_vanban", $data, "id = $id");
        return $query;
    }

    function del_vanban($id){
        $query = $this->delete("tbl_vanban", "id = $id");
        return $query;
    }
}
?>
