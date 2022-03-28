<?php
class Index extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        Session::init();
        $logged = Session::get('loggedIn');
        if($logged == false){
            Session::destroy();
            header ('Location: '.URL.'/index/login_s');
            exit;
        }else{
            require('layouts/header.php');
            // tao folder quan ly hinh anh, file trong module cong thong tin
            if(!isset($_SESSION['url_news'])){
                $dirname = DIR_UPLOAD.'/news/'.$_SESSION['data'][0]['truonghoc_id'];
                if(!file_exists($dirname)){
                    mkdir($dirname, 0777);
                }
                $_SESSION['url_news'] = URL.'/public/news/'.$_SESSION['data'][0]['truonghoc_id']."/";
            }
            // tao folder quan ly van ban trong module cong thong tin
            $dirname = DIR_UPLOAD.'/vanban/'.$_SESSION['data'][0]['truonghoc_id'];
            if(!file_exists($dirname)){
                mkdir($dirname, 0777);
            }
            // tao folder quan ly anh thiet bi
            $dirname_asset = DIR_UPLOAD.'/assets/'.$_SESSION['data'][0]['truonghoc_id'];
            if(!file_exists($dirname_asset)){
                mkdir($dirname_asset, 0777);
            }
            // tao folder quan ly de nghi trang cap
            $dirname_trangcap = DIR_UPLOAD.'/denghitrangcap/'.$_SESSION['data'][0]['truonghoc_id'];
            if(!file_exists($dirname_trangcap)){
                mkdir($dirname_trangcap, 0777);
            }
            // tao folder quan ly file erp
            $dirname_erp = DIR_UPLOAD.'/erp/'.$_SESSION['data'][0]['truonghoc_id'];
            if(!file_exists($dirname_erp)){
                mkdir($dirname_erp, 0777);
            }
            // tao folder quan ly file elearning
            $dirname_e = DIR_UPLOAD.'/elearning/'.$_SESSION['data'][0]['truonghoc_id'];
            if(!file_exists($dirname_e)){
                mkdir($dirname_e, 0777);
            }
            // trang chu
            $this->view->totalbaiviet = $this->model->get_total_baiviet($_SESSION['data'][0]['truonghoc_id']);
            $this->view->totalthietbi = $this->model->get_total_thietbi($_SESSION['data'][0]['truonghoc_id']);
            ///////////////////////////////////////////////////////////////////////////////////////
            $this->view->render('index/index');
            require('layouts/footer.php');
        }
    }

    function login(){
        $this->view->render("index/login");
    }

    function do_login(){
        $username = $_REQUEST['username'];
        $password = sha1(base64_decode($_REQUEST['password']));
        if($this->model->check_login($username, $password) > 0){
            Session::init();
            Session::set('loggedIn', true);
            $_SESSION['data'] = $this->model->get_data($username, $password);
            $_SESSION['namhoc'] = $this->model->get_namhoc_active(0);
            $jsonObj['msg'] = "Đăng nhập thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thông tin đăng nhập không chính xác";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("index/do_login");
    }

    function login_s(){
        $this->view->render("index/login_s");
    }

    function do_login_s(){
        $truonghocid = $_REQUEST['truonghoc_id'];
        $username = $_REQUEST['username'];
        $password = sha1(base64_decode($_REQUEST['password']));
        if($this->model->check_login_s($username, $password, $truonghocid) > 0){
            Session::init();
            Session::set('loggedIn', true);
            $_SESSION['data'] = $this->model->get_data_s($username, $password, $truonghocid);
            $_SESSION['namhoc'] = $this->model->get_namhoc_active($truonghocid);
            $jsonObj['msg'] = "Đăng nhập thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thông tin đăng nhập không chính xác";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("index/do_login_s");
    }

    function logout(){
        session_start();
        //Session::destroy();
        if($_SESSION['data'][0]['truonghoc_id'] != 0){
            session_destroy();
            header('Location: '.URL.'/index/login_s');
            exit;
        }else{
            session_destroy();
            header('Location: '.URL.'/index/login');
            exit;
        }
    }

    function thongke(){
        $this->view->linkctt = $this->model->get_thongtin_ctt($_SESSION['data'][0]['truonghoc_id']);
        $this->view->render("index/thongke");
    }
}
?>
