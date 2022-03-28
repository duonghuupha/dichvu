<?php
class Hosothietbi extends Controller{
    private $_Info;
    private $_Namhoc;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('hosothietbi/index');
        require 'layouts/footer.php';
    }
    
    function combo_thietbi(){
        $phongbanid = $_REQUEST['id'];
        $jsonObj = $this->model->get_combo_thietbi($phongbanid);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("hosothietbi/combo_thietbi");
    }
    
    function content_global(){
        $id = $_REQUEST['id']; $value = explode(".", $id);
        $jsonObj = $this->model->get_info_thietbi($value[0]);
        $this->view->jsonObj = $jsonObj; $this->view->socon = $value[1];
        $this->view->render("hosothietbi/content_global");
    }
    
    function thong_so(){
        $id = $_REQUEST['id']; $value = explode(".", $id);
        $jsonObj = $this->model->get_info_thietbi($value[0]);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("hosothietbi/thong_so");
    }
    
    function luan_chuyen(){
        $id = $_REQUEST['id']; $value = explode(".", $id);
        $landau = $this->model->get_phanbo($value[0], $value[1]);
        $this->view->landau = $landau;
        $luanchuyen = $this->model->get_luanchuyen($value[0], $value[1]);
        $this->view->luanchuyen = $luanchuyen;
        $this->view->render("hosothietbi/luan_chuyen");
    }
    
    function qua_trinh(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_quatrinh_thietbi($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("hosothietbi/qua_trinh");
    }
}
?>