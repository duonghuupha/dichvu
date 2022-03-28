<?php
class Index_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function check_login($username, $password){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username'
                                    AND password = '$password' AND active = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_data($username, $password){
        $query = $this->db->query("SELECT * FROM tbl_users WHERE username = '$username'
                                    AND password = '$password' AND active = 1");
        return $query->fetchAll();
    }
    
    function check_login_s($username, $password, $truonghocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username'
                                    AND password = '$password' AND truonghoc_id = $truonghocid AND active = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_data_s($username, $password, $truonghocid){
        $query = $this->db->query("SELECT * FROM tbl_users WHERE username = '$username'
                                    AND password = '$password' AND truonghoc_id = $truonghocid AND active = 1");
        return $query->fetchAll();
    }
    
    function get_namhoc_active($truonghocid){
        if($truonghocid == 0){
            $query = $this->db->query("SELECT 0 AS id, 'Năm học tập trung'  AS title, 1, active = 1, 0 AS truonghoc_id
                                        FROM tbldm_namhoc");
        }else{
            $query = $this->db->query("SELECT * FROM tbldm_namhoc WHERE truonghoc_id = $truonghocid AND active = 1");
        }
        return $query->fetchAll();
    }
    
    function get_total_baiviet($truonghocid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_content WHERE truonghoc_id = $truonghocid
                                    AND status != 0");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_total_thietbi($truonghocid){
        $query = $this->db->query("SELECT SUM(so_luong) AS Total FROM tbl_thongtin_tb WHERE truonghoc_id = $truonghocid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    function get_thongtin_ctt($truonghocid){
        $query = $this->db->query("SELECT link_ctt FROM  tbl_thongtin_ctt WHERE truonghoc_id = $truonghocid");
        return $query->fetchAll();
    }
}
?>