<?php
class Vanban extends Controller{
    private $_Info;
    private $_Convert;
    private $_Roles;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
        $this->_Roles = new Roles();
    }

    /**
     * danh muc van ban
     **/
    function danhmuc(){
    	require 'layouts/header.php';
        $this->view->render('vanban/danhmuc');
        require 'layouts/footer.php';
    }

    function content_dm(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_dm($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('vanban/content_dm');
    }

    function add_dm(){
        $title = $_REQUEST['title'];
        $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], "title" => $title);
        $temp = $this->model->addObj_dm($data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vanban/add_dm");
    }

    function update_dm(){
        $title = $_REQUEST['title']; $id = $_REQUEST['id'];
        $data = array("title" => $title);
        $temp = $this->model->updateObj_dm($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vanban/update_dm");
    }

    function del_dm(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj_dm($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vanban/del_dm");
    }

    /**
     * van ban den
     **/
    function vanbanden(){
    	require 'layouts/header.php';
        $this->view->render('vanban/vanbanden');
        require 'layouts/footer.php';
    }

    function content_vbd(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_vbd($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('vanban/content_vbd');
    }

    function formaddvanbanden(){
    	require 'layouts/header.php';
        $this->view->render('vanban/formaddvanbanden');
        require 'layouts/footer.php';
    }

    function add_vbd(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $soden = $_REQUEST['so_den'];
        $ngayden = $this->_Convert->convertDate($_REQUEST['ngay_den']);
        $sovanban = $_REQUEST['so_vanban']; $ngayvanban = $this->_Convert->convertDate($_REQUEST['ngay_vanban']);
        $title = $_REQUEST['title']; $trichyeu = $_REQUEST['trich_yeu'];
        $file = $this->_Convert->convert_img($_FILES['file_at']['name'], $this->_Convert->vn2latin($title, true));
        $online = isset($_REQUEST['online']) ? 1 : 0;
        if($this->model->dupliObj_vbd($truonghocid, 0, $soden, $sovanban) > 0){
            $jsonObj['msg'] = "Số đến hoặc số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("truonghoc_id" => $truonghocid, 'cate_id' => $cateid, 'so_den' => $soden, 'ngay_den' => $ngayden,
                            "so_vanban" => $sovanban, "ngay_vanban" => $ngayvanban, 'title' => $title, 'trich_yeu' => $trichyeu,
                            "user_id" => $this->_Info[0]['id'], "file" => $file, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj_vbd($data);
            if($temp){
                move_uploaded_file($_FILES['file_at']['tmp_name'], DIR_UPLOAD.'/vanban/'.$truonghocid.'/'.$file);
                if($online == 1){ // dang len cong thong tin dien tu
                    $hienthiphong = isset($_REQUEST['hien_thi_phong']) ? 1 : 0;
                    $hienthihome = isset($_REQUEST['hien_thi_home']) ? 1 : 0;
                    $data_ctt = array('truonghoc_id' => $truonghocid, 'cate_id' => $_REQUEST['cate_id'], 'so_vanban' => $sovanban,
                                        'ngay_vanban' => $ngayvanban, 'tieu_de' => $title, 'trich_yeu' => $trichyeu, 'file' => $file,
                                        'user_id' => $this->_Info[0]['id'], 'hien_thi_phong' => $hienthiphong, 'hien_thi_home' => $hienthihome,
                                        'create_at' => date("Y-m-d H:i:s"));
                    $this->model->addObj_online($data_ctt);
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
        $this->view->render("vanban/add_vbd");
    }

    function formeditvanbanden(){
    	require 'layouts/header.php';
        $jsonObj = $this->model->get_detail_edit($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('vanban/formeditvanbanden');
        require 'layouts/footer.php';
    }

    function update_vbd(){
        $truonghocid = $this->_Info[0]['truonghoc_id']; $id = $_REQUEST['id']; $fileold = $_REQUEST['fileold'];
        $cateid = $_REQUEST['danhmuc_id']; $soden = $_REQUEST['so_den'];
        $ngayden = $this->_Convert->convertDate($_REQUEST['ngay_den']);
        $sovanban = $_REQUEST['so_vanban']; $ngayvanban = $this->_Convert->convertDate($_REQUEST['ngay_vanban']);
        $title = $_REQUEST['title']; $trichyeu = $_REQUEST['trich_yeu'];
        $file = ($_FILES['file_at']['name'] != '') ? $this->_Convert->convert_img($_FILES['file_at']['name'], $this->_Convert->vn2latin($title, true)) : $fileold;
        if($this->model->dupliObj_vbd($truonghocid, $id, $soden, $sovanban) > 0){
            $jsonObj['msg'] = "Số đến hoặc số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('cate_id' => $cateid, 'so_den' => $soden, 'ngay_den' => $ngayden,
                            "so_vanban" => $sovanban, "ngay_vanban" => $ngayvanban, 'title' => $title,
                            'trich_yeu' => $trichyeu, "file" => $file, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->updateObj_vbd($id, $data);
            if($temp){
                if($_FILES['file_at']['name'] != ''){
                    move_uploaded_file($_FILES['file_at']['tmp_name'], DIR_UPLOAD.'/vanban/'.$truonghocid.'/'.$file);
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
        $this->view->render("vanban/update_vbd");
    }

    function del_vbd(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj_vbd($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vanban/del_vbd");
    }

    function detailvbd(){
        require 'layouts/header.php';
        $jsonObj = $this->model->get_detail($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('vanban/detailvbd');
        require 'layouts/footer.php';
    }

    /**
     * van ban di
     **/
    function vanbandi(){
    	require 'layouts/header.php';
        $this->view->render('vanban/vanbandi');
        require 'layouts/footer.php';
    }

    function content_vbdi(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_vbdi($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('vanban/content_vbdi');
    }

    function formaddvanbandi(){
    	require 'layouts/header.php';
        $this->view->render('vanban/formaddvanbandi');
        require 'layouts/footer.php';
    }

    function add_vbdi(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $sovanban = $_REQUEST['so_vanban'];
        $ngayvanban = $this->_Convert->convertDate($_REQUEST['ngay_vanban']);
        $title = $_REQUEST['title']; $trichyeu = $_REQUEST['trich_yeu'];
        $file = $this->_Convert->convert_img($_FILES['file_at']['name'], $this->_Convert->vn2latin($title, true));
        $online = isset($_REQUEST['online']) ? 1 : 0; $userid = $this->_Info[0]['id'];
        if($this->model->dupliObj_vbdi($truonghocid, 0, $sovanban) > 0){
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("truonghoc_id" => $truonghocid, 'cate_id' => $cateid, 'so_vanban' => $sovanban,
                            "ngay_vanban" => $ngayvanban, 'title' => $title, 'trich_yeu' => $trichyeu,
                            'file' => $file, 'user_id' => $userid, 'create_at' => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj_vbdi($data);
            if($temp){
                move_uploaded_file($_FILES['file_at']['tmp_name'], DIR_UPLOAD.'/vanban/'.$truonghocid.'/'.$file);
                if($online == 1){ // dang len cong thong tin dien tu
                    $hienthiphong = isset($_REQUEST['hien_thi_phong']) ? 1 : 0;
                    $hienthihome = isset($_REQUEST['hien_thi_home']) ? 1 : 0;
                    $data_ctt = array('truonghoc_id' => $truonghocid, 'cate_id' => $_REQUEST['cate_id'], 'so_vanban' => $sovanban,
                                        'ngay_vanban' => $ngayvanban, 'tieu_de' => $title, 'trich_yeu' => $trichyeu, 'file' => $file,
                                        'user_id' => $this->_Info[0]['id'], 'hien_thi_phong' => $hienthiphong, 'hien_thi_home' => $hienthihome,
                                        'create_at' => date("Y-m-d H:i:s"));
                    $this->model->addObj_online($data_ctt);
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
        $this->view->render("vanban/add_vbdi");
    }

    function formeditvanbandi(){
    	require 'layouts/header.php';
        $jsonObj = $this->model->get_detail_edit_vbdi($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('vanban/formeditvanbandi');
        require 'layouts/footer.php';
    }

    function update_vbdi(){
        $truonghocid = $this->_Info[0]['truonghoc_id']; $id = $_REQUEST['id']; $fileold = $_REQUEST['fileold'];
        $cateid = $_REQUEST['danhmuc_id']; $sovanban = $_REQUEST['so_vanban'];
        $ngayvanban = $this->_Convert->convertDate($_REQUEST['ngay_vanban']);
        $title = $_REQUEST['title']; $trichyeu = $_REQUEST['trich_yeu'];
        $file = ($_FILES['file_at']['name'] != '') ? $this->_Convert->convert_img($_FILES['file_at']['name'], $this->_Convert->vn2latin($title, true)) : $fileold;
        if($this->model->dupliObj_vbdi($truonghocid, $id, $sovanban) > 0){
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('cate_id' => $cateid, 'so_vanban' => $sovanban,
                            "ngay_vanban" => $ngayvanban, 'title' => $title, 'trich_yeu' => $trichyeu,
                            'file' => $file, 'create_at' => date("Y-m-d H:i:s"));
            $temp = $this->model->updateObj_vbdi($id, $data);
            if($temp){
                if($_FILES['file_at']['name'] != ''){
                    move_uploaded_file($_FILES['file_at']['tmp_name'], DIR_UPLOAD.'/vanban/'.$truonghocid.'/'.$file);
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
        $this->view->render("vanban/update_vbdi");
    }

    function del_vbdi(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj_vbdi($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vanban/del_vbdi");
    }

    function detailvbdi(){
        require 'layouts/header.php';
        $jsonObj = $this->model->get_detail_vbdi($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('vanban/detailvbdi');
        require 'layouts/footer.php';
    }
}
?>
