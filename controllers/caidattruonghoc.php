<?php
class Caidattruonghoc extends Controller{
    private $_Info;
    private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
    }

    function index(){
    	require 'layouts/header.php';
        $phantuyen = $this->model->get_phantuyen($this->_Info[0]['truonghoc_id']);
        $this->view->phantuyen = $phantuyen;
        $this->view->render('caidattruonghoc/index');
        require 'layouts/footer.php';
    }
    
    function update_phantuyen(){
        $thanhpho = $_REQUEST['thanhpho_id']; $quanid = $_REQUEST['quan_id'];
        $xaphuong = $_REQUEST['xa_phuong']; $thonto = $_REQUEST['thon_to'];
        if(count($this->model->get_phantuyen($this->_Info[0]['truonghoc_id'])) > 0){
            $data = array("thanhpho_id" => $thanhpho, "quan_id" => $quanid, "xa_phuong" => $xaphuong,
                            "thon_to" => $thonto);
            $temp = $this->model->updateObj_phantuyen($this->_Info[0]['truonghoc_id'], $data);
        }else{
            $data = array("thanhpho_id" => $thanhpho, "quan_id" => $quanid, "xa_phuong" => $xaphuong,
                            "thon_to" => $thonto, "truonghoc_id" => $this->_Info[0]['truonghoc_id']);
            $temp = $this->model->addObj_phantuyen($data);
        }
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("caidattruonghoc/update_phantuyen");
    }
}
?>