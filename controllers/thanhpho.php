<?php
class Thanhpho extends Controller{
    private $_Info;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require 'layouts/header.php';
        $this->view->render('thanhpho/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('thanhpho/content');
    }
    
    function add(){
        $mathanhpho = $_REQUEST['ma_thanh_pho'];
        $title = $_REQUEST['title'];
        if($this->model->dupliObj(0, $mathanhpho) > 0){
            $jsonObj['msg'] = "Mã thành phố đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("ma_thanh_pho" => $mathanhpho, "title" => $title);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("thanhpho/add");
    }
    
    function update(){
        $id = $_REQUEST['id'];
        $mathanhpho = $_REQUEST['ma_thanh_pho'];
        $title = $_REQUEST['title'];
        if($this->model->dupliObj($id, $mathanhpho) > 0){
            $jsonObj['msg'] = "Mã thành phố đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("ma_thanh_pho" => $mathanhpho, "title" => $title);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("thanhpho/update");
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
        $this->view->render("thanhpho/del");
    }
}
?>