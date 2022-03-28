<?php
class Classtemp extends Controller{
    private $_Info;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
    }
    
    function content(){
        $rows = 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
    	$this->view->render('classtemp/content');
    }
    
    function add(){
    	$title = $_REQUEST['title_temp'];
    	$data = array('title' => $title, 'truonghoc_id' => $this->_Info[0]['truonghoc_id']);
    	$temp = $this->model->addObj($data);
    	if($temp){
    		$jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    		$jsonObj['success'] = true;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}else{
    		$jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}
    	$this->view->render('classtemp/add');
    }
    
    function update(){
    	$id = $_REQUEST['id_temp'];
    	$title = $_REQUEST['title_temp'];
    	$data = array('title' => $title);
    	$temp = $this->model->updateObj($id, $data);
    	if($temp){
    		$jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    		$jsonObj['success'] = true;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}else{
    		$jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}
    	$this->view->render('classtemp/update');
    }
    
    function del(){
    	$id = $_REQUEST['id'];
    	$temp = $this->model->delObj($id);
    	if($temp){
    		$jsonObj['msg'] = "Xóa dữ liệu thành công";
    		$jsonObj['success'] = true;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}else{
    		$jsonObj['msg'] = 'Xóa dữ liệu không thành công';
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}
    	$this->view->render('classtemp/del');
    }
}
?>