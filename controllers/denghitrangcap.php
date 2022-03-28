<?php
class Denghitrangcap extends Controller{
    private $_Info; private $_Namhoc; private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
        $this->_Convert = new Convert();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('denghitrangcap/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $this->_Info[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('denghitrangcap/content');
    }
    
    function formadd(){
    	require 'layouts/header.php';
        $this->view->render('denghitrangcap/formadd');
        require 'layouts/footer.php';
    }
    
    function formedit(){
    	require 'layouts/header.php';
        
        $id = $_REQUEST['id']; $detail = $this->model->display($id);
        $this->view->detail = $detail;
        $json = $this->model->get_detail($detail[0]['code']);
        $this->view->json = $json;
        
        $this->view->render('denghitrangcap/formedit');
        require 'layouts/footer.php';
    }
    
    function add(){
        $truonghocid = $this->_Info[0]['truonghoc_id']; $code = $_REQUEST['code'];
        $ngaydenghi = $this->_Convert->convertDate($_REQUEST['ngay_de_nghi']);
        $userid = $this->_Info[0]['id']; $userapp = $_REQUEST['user_app'];
        $content = $_REQUEST['content']; $ghichu = $_REQUEST['ghi_chu'];
        $createat = date("Y-m-d H:i:s"); $trangthai = 0; $file = '';
        $datadc = json_decode($_REQUEST['datadc'],true);
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã phiếu đề nghị đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("truonghoc_id" => $truonghocid, 'code' => $code, 'ngay_de_nghi' => $ngaydenghi,
                        'user_id' => $userid, 'user_app' => $userapp, 'content' => $content, 'ghi_chu' => $ghichu,
                        'create_at' => $createat, 'trang_thai' => $trangthai, 'file' => $file);
            $temp = $this->model->addObj($data);
            if($temp){
                foreach($datadc as $row){
                    $data_ct = array('code' => $code, 'title' => $row['title'], 'donvitinh' => $row['donvitinh'],
                                    'so_luong' => $row['soluong'], 'don_gia' => $row['dongia'], 'ghi_chu' => $row['ghichu']);
                    $this->model->addObj_ct($data_ct);
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
        $this->view->render("denghitrangcap/add");
    }
    
    function update(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code'];
        $ngaydenghi = $this->_Convert->convertDate($_REQUEST['ngay_de_nghi']);
        $userapp = $_REQUEST['user_app']; $content = $_REQUEST['content']; 
        $ghichu = $_REQUEST['ghi_chu'];
        $datadc = json_decode($_REQUEST['datadc'],true);
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã phiếu đề nghị đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('ngay_de_nghi' => $ngaydenghi, 'user_app' => $userapp, 'content' => $content, 'ghi_chu' => $ghichu);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $this->model->delObj_ct($code);
                foreach($datadc as $row){
                    $data_ct = array('code' => $code, 'title' => $row['title'], 'donvitinh' => $row['donvitinh'],
                                    'so_luong' => $row['soluong'], 'don_gia' => $row['dongia'], 'ghi_chu' => $row['ghichu']);
                    $this->model->addObj_ct($data_ct);
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
        $this->view->render("denghitrangcap/update");
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
        $this->view->render("denghitrangcap/del");
    }
    
    function info(){
        $id = $_REQUEST['id']; $detail = $this->model->get_detail_info($id);
        $this->view->detail = $detail;
        $json = $this->model->get_detail($detail[0]['code']);
        $this->view->json = $json;
        $this->view->render("denghitrangcap/info");
    }
    
    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array('trang_thai' => 1);
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
        $this->view->render("denghitrangcap/change");
    }
    
    function minhchung(){
        $id = $_REQUEST['id_trangcap'];
        $file = $_FILES['file']['name'];
        $data = array('file' => $file);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/denghitrangcap/'.$this->_Info[0]['truonghoc_id'].'/'.$file);
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("denghitrangcap/minhchung");
    }
}
?>