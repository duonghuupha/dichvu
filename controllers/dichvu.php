<?php
class Dichvu extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }
    
    function index(){
        require 'layouts/header.php';
        $this->view->render('dichvu/index');
        require 'layouts/footer.php';
    }

    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('dichvu/content');
    }

    function add(){
        $title = $_REQUEST['title_dichvu'];
        $file = $_FILES['file']['name'];
        $data = array('title' => $title, 'file' => $file);
        $temp = $this->model->addObj($data);
        if($temp){
            if($file != ''){
                move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/huongdansudung/'.$file);
            }
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("dichvu/add");
    }

    function update(){
        $id = $_REQUEST['id_dichvu'];
        $title = $_REQUEST['title_dichvu'];
        $file = ($_FILES['file']['name'] != '') ? $_FILES['file']['name'] : $_REQUEST['file_old'];
        $data = array('title' => $title, 'file' => $file);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            if($_FILES['file']['name'] != ''){
                move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/huongdansudung/'.$file);
            }
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("dichvu/update");
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("dichvu/del");
    }
}
?>