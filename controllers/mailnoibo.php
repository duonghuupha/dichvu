<?php
class Mailnoibo extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('mailnoibo/index');
        require 'layouts/footer.php';
    }

    function compose(){
    	require 'layouts/header.php';
        $this->view->render('mailnoibo/compose');
        require 'layouts/footer.php';
    }

    function readmail(){
    	require 'layouts/header.php';
        $this->view->render('mailnoibo/readmail');
        require 'layouts/footer.php';
    }
}
?>