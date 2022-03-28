<?php
class Truonghoc extends Controller{
    private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Convert = new Convert();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('truonghoc/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('truonghoc/content');
    }

    function formadd(){
    	require 'layouts/header.php';
        $this->view->render('truonghoc/formadd');
        require 'layouts/footer.php';
    }
    
    function add(){
        $code = $_REQUEST['code']; $title = $_REQUEST['title']; $address = $_REQUEST['address'];
        $phone = $_REQUEST['phone']; $email = $_REQUEST['email']; $masothue = $_REQUEST['masothue'];
        $taikhoan = $_REQUEST['taikhoan']; $motai = $_REQUEST['motai'];
        $dichvu = (isset($_REQUEST['dichvu_id']) && count($_REQUEST['dichvu_id']) > 0) ? implode(",", $_REQUEST['dichvu_id']) : '';
        $logo  = ($_FILES['image_logo']['name'] != '') ? $this->_Convert->convert_img($_FILES['image_logo']['name'], $this->_Convert->vn2latin($title, true)) : ''; 
        $status = (isset($_REQUEST['status'])) ? 1 : 0;
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã trường học đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('code' => $code, 'title' => $title, 'address' => $address, 'phone' => $phone,
                            'email' => $email, 'masothue' => $masothue, 'taikhoan' => $taikhoan,
                            'motai' => $motai, 'dichvu_id' => $dichvu, 'logo' => $logo, 'active' => $status);
            $temp = $this->model->addObj($data);
            if($temp){
                if($logo != ''){
                    move_uploaded_file($_FILES['image_logo']['tmp_name'], DIR_UPLOAD.'/truonghoc/logo/'.$logo);
                }
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("truonghoc/add");
    }
    
    function formedit(){
    	require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_detail($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('truonghoc/formedit');
        require 'layouts/footer.php';
    }
    
    function update(){
        $id = $_REQUEST['id'];
        $code = $_REQUEST['code']; $title = $_REQUEST['title']; $address = $_REQUEST['address'];
        $phone = $_REQUEST['phone']; $email = $_REQUEST['email']; $masothue = $_REQUEST['masothue'];
        $taikhoan = $_REQUEST['taikhoan']; $motai = $_REQUEST['motai'];
        $dichvu = (isset($_REQUEST['dichvu_id']) && count($_REQUEST['dichvu_id']) > 0) ? implode(",", $_REQUEST['dichvu_id']) : '';
        $logo  = ($_FILES['image_logo']['name'] != '') ? $this->_Convert->convert_img($_FILES['image_logo']['name'], $this->_Convert->vn2latin($title, true)) : ''; 
        $status = (isset($_REQUEST['status'])) ? 1 : 0;
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "MMã trường học đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('code' => $code, 'title' => $title, 'address' => $address, 'phone' => $phone,
                            'email' => $email, 'masothue' => $masothue, 'taikhoan' => $taikhoan,
                            'motai' => $motai, 'dichvu_id' => $dichvu, 'logo' => $logo, 'active' => $status);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($logo != ''){
                    move_uploaded_file($_FILES['image_logo']['tmp_name'], DIR_UPLOAD.'/truonghoc/logo/'.$logo);
                }
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("truonghoc/update");
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
        $this->view->render("truonghoc/del");
    }
}
?>