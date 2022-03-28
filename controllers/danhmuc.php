<?php
class Danhmuc extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('danhmuc/index');
        require 'layouts/footer.php';
    }
}
?>