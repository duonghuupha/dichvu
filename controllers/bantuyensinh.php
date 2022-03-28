<?php
class Bantuyensinh extends Controller{
    private $_Convert;
    private $_Info;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
    }
    
    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('bantuyensinh/content');
    }
    
    function add(){
        $namhoc = $_REQUEST['tsnamhoc_id'];
        $member = $_REQUEST['user_id'];
        if($this->model->dupliObj(0, $namhoc) > 0){
            $jsonObj['msg'] = "Ban tuyển sinh của năm học này đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('user_id' => implode(",", $member), 'nam_hoc_id' => $namhoc, 
                            'truonghoc_id' => $this->_Info[0]['truonghoc_id']);
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
        }
        $this->view->render('bantuyensinh/add');
    }
    
    function update(){
        $id = $_REQUEST['id_bantuyensinh'];
        $namhoc = $_REQUEST['tsnamhoc_id'];
        $member = $_REQUEST['user_id'];
        if($this->model->dupliObj($id, $namhoc) > 0){
            $jsonObj['msg'] = "Ban tuyển sinh của năm học này đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('user_id' => implode(",", $member), 'nam_hoc_id' => $namhoc);
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
        }
        $this->view->render('bantuyensinh/update');
    }
    
    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['Xóa dữ liệu không thành công'];
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('bantuyensinh/del');
    }
}
?>