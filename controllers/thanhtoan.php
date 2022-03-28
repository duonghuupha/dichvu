<?php
class Thanhtoan extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('thanhtoan/index');
        require 'layouts/footer.php';
    }
}
?>