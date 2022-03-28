<?php
class Nhomcongviec extends Controller{
    private $_Info;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('nhomcongviec/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $this->_Info[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('nhomcongviec/content');
    }
    
    function add(){
        $code = time();
        $userid = $this->_Info[0]['id'];
        $title = $_REQUEST['title'];
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $createat = date("Y-m-d H:i:s");
        $userfollow = isset($_REQUEST['user_id_follow']) ? implode(",", $_REQUEST['user_id_follow']) : '';
        if($userfollow != ''){
            if(in_array($userid, $_REQUEST['user_id_follow'])){
                $jsonObj['msg'] = "Người tham gia không thể là chính mình";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array('truonghoc_id' => $truonghocid, 'code' => $code, 'title' => $title, 'user_id' => $userid,
                    'user_id_follow' => $userfollow, 'create_at' => $createat);
                $temp = $this->model->addObj($data);
                if($temp){
                    $jsonObj['msg'] = "Cập nhật dữ  liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                    $jsonObj['success']  = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{
            $data = array('truonghoc_id' => $truonghocid, 'code' => $code, 'title' => $title, 'user_id' => $userid,
                'user_id_follow' => $userfollow, 'create_at' => $createat);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Cập nhật dữ  liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success']  = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('nhomcongviec/add');
    }
    
    function update(){
        $id = $_REQUEST['id_nhomcongviec'];
        $title = $_REQUEST['title']; $userid  = $this->_Info[0]['id'];
        $userfollow = isset($_REQUEST['user_id_follow']) ? implode(",", $_REQUEST['user_id_follow']) : '';
        if($userfollow != ''){
            if(in_array($userid, $_REQUEST['user_id_follow'])){
                $jsonObj['msg'] = "Người tham gia không thể là chính mình";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array('title' => $title, 'user_id_follow' => $userfollow);
                $temp = $this->model->updateObj($id, $data);
                if($temp){
                    $jsonObj['msg'] = "Cập nhật dữ  liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                    $jsonObj['success']  = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{
            $data = array('title' => $title, 'user_id_follow' => $userfollow);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = "Cập nhật dữ  liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success']  = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('nhomcongviec/update');
    }
    
    function del(){
    	$id = $_REQUEST['id'];
    	$temp = $this->model->delObj($id);
    	if($temp){
    		$jsonObj['msg'] = "Xóa dữ liệu thành công";
    		$jsonObj['success'] = true;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}else{
    		$jsonObj['msg'] = 'Xóa dữ liệu không thành công';
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}
    	$this->view->render('nhomcongviec/del');
    }
}
?>