<?php
class Quanhuyen extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }
    
    function index(){
        require 'layouts/header.php';
        $this->view->render('quanhuyen/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
       $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('quanhuyen/content');
    }
    
    function add(){
        $thanhphoid = $_REQUEST['thanhpho_id'];
        $mathanhpho = $this->model->get_ma_thanh_pho($thanhphoid);
        $maquanhuyen = $_REQUEST['ma_quan_huyen'];
        $title = $_REQUEST['title'];
        $data = array('title' => $title, 'ma_quan_huyen' => $maquanhuyen, 'ma_thanh_pho' => $mathanhpho);
        $dup = $this->model->dupliObj(0, $maquanhuyen, $mathanhpho);
        if($dup > 0){
            $jsonObj['msg'] = "Quận / huyện này đã tổn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Thêm mới dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm mới dữ liệu không thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('quanhuyen/add');
    }
    
    function update(){
        $id = $_REQUEST['id'];
        $thanhphoid = $_REQUEST['thanhpho_id'];
        $mathanhpho = $this->model->get_ma_thanh_pho($thanhphoid);
        $maquanhuyen = $_REQUEST['ma_quan_huyen'];
        $title = $_REQUEST['title'];
        $data = array('title' => $title, 'ma_quan_huyen' => $maquanhuyen, 'ma_thanh_pho' => $mathanhpho);
        $dup = $this->model->dupliObj($id, $maquanhuyen, $mathanhpho);
        if($dup > 0){
            $jsonObj['msg'] = "Quận / huyện này đã tổn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = "Thêm mới dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm mới dữ liệu không thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('quanhuyen/update');
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
        $this->view->render('quanhuyen/del');
    }
}
?>