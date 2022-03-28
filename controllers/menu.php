<?php
class Menu extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require 'layouts/header.php';

        $dichvu = $this->model->get_all_dichvu();
        $this->view->dichvu = $dichvu;

        $this->view->render('menu/index');
        require 'layouts/footer.php';
    }

    function content(){
        $id = $_REQUEST['id'];
        $json = $this->model->display($id);
        if(count($json) > 0){
            $jsonObj['msg'] = 'Load dữ liệu thành công';
            $jsonObj['success'] = true;
            $jsonObj['dichvu_id'] = $json[0]['dichvu_id'];
            $jsonObj['title'] = $json[0]['title'];
            $jsonObj['link'] = $json[0]['link'];
            $jsonObj['parent_id'] = $json[0]['parent_id'];
            $jsonObj['is_menu'] = $json[0]['is_menu'];
            $jsonObj['thu_tu'] = $json[0]['thu_tu'];
            $jsonObj['chuc_nang'] = $json[0]['chuc_nang'];
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = 'Load dữ liệu không thành công';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('menu/content');
    }

    function add(){
        $dichvu = $_REQUEST['id_dichvu']; $parent = $_REQUEST['parent_id'];
        $title = $_REQUEST['title']; $thutu = $_REQUEST['thu_tu'];
        $menu = 1;
        $link = $_REQUEST['link']; $chucnang = (isset($_REQUEST['chuc_nang'])) ? implode(",", $_REQUEST['chuc_nang']) : '';
        $data = array('dichvu_id' => $dichvu, 'parent_id' => $parent, 'title' => $title,
                        'link' => $link, 'thu_tu' => $thutu, 'is_menu' => $menu, 'chuc_nang' => $chucnang);
        $temp = $this->model->addObj($data);
        if($temp){
            $jsonObj['msg'] = "Thêm mới dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thêm mới dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("menu/add");
    }

    function update(){
        $id = $_REQUEST['id_menu'];
        $dichvu = $_REQUEST['id_dichvu']; $parent = ($_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $title = $_REQUEST['title']; $link = $_REQUEST['link']; $thutu = $_REQUEST['thu_tu'];
        $menu = 1; $chucnang = (isset($_REQUEST['chuc_nang'])) ? implode(",", $_REQUEST['chuc_nang']) : '';
        $data = array('dichvu_id' => $dichvu, 'parent_id' => $parent, 'title' => $title,
                        'link' => $link, 'thu_tu' => $thutu, 'is_menu' => $menu, 'chuc_nang' => $chucnang);
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
        $this->view->render("menu/update");
    }

    function del(){
        $id = $_REQUEST['id'];
        if($this->model->check_exit_menu_in_roles($id) > 0){
            $jsonObj['msg'] = "Quyền - Menu đã được sử dụng cho người dùng, bạn không thể xóa";
            $jsonObj['success']  = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("menu/del");
    }

    function combo_roles(){
        $jsonObj = $this->model->get_combo($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("menu/combo_roles");
    }
}
?>
