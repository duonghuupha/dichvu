<?php
class Huongdansudung extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require 'layouts/header.php';
        $this->view->render('huongdansudung/index');
        require 'layouts/footer.php';
    }
}
?>
