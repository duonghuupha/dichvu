<?php
class Inmathietbi extends Controller{
    private $_Info;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('inmathietbi/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render("inmathietbi/content");
    }
    
    function inma(){
        $this->view->coquan = $this->model->get_info_truonghoc($this->_Info[0]['truonghoc_id']);
        $this->view->render("inmathietbi/inma");
    }
    
    function qrcode(){
        $this->view->render("inmathietbi/qrcode");
    }
}
?>