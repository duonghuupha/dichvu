<?php
class Nuoiduong_Model extends Model{
	function __construct(){
		parent::__construct();
	}

	function get_info_phongban_via_userid($userid, $truonghocid, $namhocid){
		$query = $this->db->query("SELECT * FROM tbldm_phongban WHERE truonghoc_id = $truonghocid
									AND namhoc_id = $namhocid AND FIND_IN_SET($userid, giao_vien)");
		return $query->fetchAll();
	}

	function check_result_baoan($date, $phongbanid, $truonghocid){
		$query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_timefood WHERE truonghoc_id = $truonghocid AND phongban_id = $phongbanid AND ngay = '$date'");
		$row = $query->fetchAll();
		return $row[0]['Total'];
	}

	function addObj($data){
		$query = $this->insert("tbl_timefood", $data);
		return $query;
	}

	function get_data_baoan_trongngay($phongbanid, $truonghocid, $ngay){
		$query = $this->db->query("SELECT * FROM tbl_timefood WHERE truonghoc_id = $truonghocid
									AND phongban_id = $phongbanid AND ngay = '$ngay'");
		return $query->fetchAll();
	}

	function updateObj($truonghocid, $phongbanid, $ngay, $data){
		$query = $this->update("tbl_timefood", $data, "truonghoc_id = $truonghocid AND phongban_id = $phongbanid AND ngay = '$ngay'");
		return $query;
	}

	function getFetObj($truonghocid, $phongbanid, $offset, $rows){
		$result = array();
		$query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_timefood WHERE truonghoc_id = $truonghocid AND phongban_id = $phongbanid");
		$row = $query->fetchAll();
		$query = $this->db->query("SELECT id, ngay, user_id, file, create_at, (SELECT fullname FROM tbl_users WHERE tbl_users.id = user_id) AS fullname FROM tbl_timefood WHERE truonghoc_id = $truonghocid AND phongban_id = $phongbanid ORDER BY id DESC LIMIT $offset, $rows");
		$result['total'] = $row[0]['Total'];
		$result['rows'] = $query->fetchAll();
		return $result;
	}

	function get_detail($id){
		$query = $this->db->query("SELECT truonghoc_id, ngay, file FROM tbl_timefood WHERE id = $id");
		return $query->fetchAll();
	}

	function get_total_hocsinh_via_phongbanid($truonghocid, $id){
		$query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_hocsinh WHERE truonghoc_id = $truonghocid
									AND phongban_id = $id AND status = 1");
		$row = $query->fetchAll();
		return $row[0]['Total'];
	}

	function get_all_hocsinh($truonghocid, $namhocid, $lophoc){
		$query = $this->db->query("SELECT id, code, fullname FROM tbl_hocsinh WHERE id IN (SELECT hocsinh_id FROM tbl_chuyenlop
								WHERE tbl_chuyenlop.truonghoc_id = $truonghocid AND namhoc_id = $namhocid AND phongban_to = $lophoc)
								ORDER BY fullname ASC");
		return $query->fetchAll();
	}
}
?>
