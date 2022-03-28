<?php
class Diemdanh extends Controller{
    private $_Convert;
    private $_Info;
    private $_Namhoc;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Convert = new Convert();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
    }

    function index(){
    	require 'layouts/header.php';
        $phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
		if(count($phongban) > 0){
			$deparment = $phongban[0]['id'];
		}else{
			$deparment = 0;
		}
        $jsonObj = $this->model->get_list_hoc_sinh_diemdanh($this->_Info[0]['truonghoc_id'], $deparment, date("Y-m-d"));
        $this->view->jsonObj = $jsonObj;
        $this->view->render('diemdanh/index');
        require 'layouts/footer.php';
    }

    function json_hocsinh(){
    	$phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
		if(count($phongban) > 0){
			$deparment = $phongban[0]['id'];
		}else{
			$deparment = 0;
		}
    	$jsonObj = $this->model->get_danh_sach_hoc_sinh($this->_Info[0]['truonghoc_id'], $deparment);
    	$this->view->jsonObj = $jsonObj;
    	$this->view->render('diemdanh/json_hocsinh');
    }

    function json_dihoc(){
        $phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
		if(count($phongban) > 0){
			$deparment = $phongban[0]['id'];
		}else{
			$deparment = 0;
		}
        $jsonObj = $this->model->get_list_hoc_sinh_diemdanh($this->_Info[0]['truonghoc_id'], $deparment, date("Y-m-d"));
        $this->view->jsonObj = $jsonObj;
        $this->view->render('diemdanh/json_dihoc');
    }

    function info_hocsinh(){
    	$id = $_REQUEST['id']; $ngay = date("Y-m-d");
    	$item = $this->model->get_info_hocsinh($id);
    	if(count($item) > 0){
    		if($this->model->check_diemdanh($this->_Info[0]['truonghoc_id'], $id, $item[0]['phongban_id'], $ngay) > 0){
    			$jsonObj['msg'] = "Học sinh đã được điểm danh";
    			$jsonObj['success'] = false;
    			$this->view->jsonObj = json_encode($jsonObj);
    		}else{
    			$data = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'hocsinh_id' => $id, 
    							'phongban_id' => $item[0]['phongban_id'], 'ngay' => $ngay);
    			$temp = $this->model->addObj($data);
    			if($temp){
    				$jsonObj['msg'] = "Điểm danh thành công";
		    		$jsonObj['success'] = true;
		    		$jsonObj['id'] = $item[0]['id'];
		    		$jsonObj['fullname'] = $item[0]['fullname'];
		    		$jsonObj['code'] = $item[0]['code'];
    				$this->view->jsonObj = json_encode($jsonObj);
    			}else{
    				$jsonObj['msg'] = "Điểm danh không thành công";
		    		$jsonObj['success'] = false;
		    		$this->view->jsonObj = json_encode($jsonObj);
    			}
    		}
    		
    	}else{
    		$jsonObj['msg'] = "Điểm danh không thành công";
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}
    	$this->view->render('diemdanh/info_hocsinh');
    }

    function del_diemdanh(){
    	$id = $_REQUEST['id']; $ngay = date("Y-m-d");
    	$item = $this->model->get_info_hocsinh($id);
    	if($this->model->check_diemdanh($this->_Info[0]['truonghoc_id'], $id, $item[0]['phongban_id'], $ngay) > 0){
    		$temp = $this->model->delObj($this->_Info[0]['truonghoc_id'],  $id, $item[0]['phongban_id'], $ngay);
    		if($temp){
    			$jsonObj['msg'] = "Cập nhật điểm danh thành công";
    			$jsonObj['success'] = true;
                $jsonObj['id'] = $id;
    			$this->view->jsonObj = json_encode($jsonObj);
    		}else{
    			$jsonObj['msg'] = "Cập nhật điểm danh không thành công";
    			$jsonObj['success'] = false;
    			$this->view->jsonObj = json_encode($jsonObj);
    		}
    	}else{
    		$jsonObj['msg'] = "Không tồn tại dữ liệu điểm danh";
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}
    	$this->view->render('diemdanh/del_diemdanh');
    }
}
?>