<?php
class Congthongtin extends Controller{
    private $_Info;
    private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
    }
    /**
     * cac ham lien quan den thong ti cong thong tin dien tu
     **/
    function thongtin(){
    	require 'layouts/header.php';
        // kiem tra xem co ton tai thong tin quan tri cong thong tin khong
        if(count($this->model->get_info($this->_Info[0]['truonghoc_id'])) == 0){ // tao moi
            $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], 'link_ctt' => '', 'link_quan_tri' => '',
                            'ma_truong' => '', 'ten_dang_nhap' => '', 'mat_khau' => '');
            $this->model->addObj_thongtin($data);
        }
        $this->view->jsonObj = $this->model->get_info($this->_Info[0]['truonghoc_id']);
        $this->view->render('congthongtin/thongtin');
        require 'layouts/footer.php';
    }

    function update_thongtin(){
        $id = $_REQUEST['id'];
        $linkctt = $_REQUEST['link_ctt']; $linkquantri = $_REQUEST['link_quan_tri'];
        $matruong = $_REQUEST['ma_truong']; $tendangnhap = $_REQUEST['ten_dang_nhap'];
        $matkhau = $_REQUEST['mat_khau'];
        $data = array("link_ctt" => $linkctt, 'link_quan_tri' => $linkquantri, 'ma_truong' => $matruong,
                        'ten_dang_nhap' => base64_encode($tendangnhap), 'mat_khau' => base64_encode($matkhau));
        $temp = $this->model->updateObj_thongtin($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/update_thongtin");
    }
    /**
     * cac ham lien quan den danh muc cong thong tin dien tu
     **/
    function danhmuc(){
    	require 'layouts/header.php';
        $this->view->render('congthongtin/danhmuc');
        require 'layouts/footer.php';
    }

    function content_dm(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_danhmuc($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('congthongtin/content_dm');
    }

    function add_danhmuc(){
        $truonghoccid = $this->_Info[0]['truonghoc_id'];
        $title = $_REQUEST['title'];
        $data = array("truonghoc_id" => $truonghoccid, 'title' => $title);
        $temp = $this->model->addObj_danhmuc($data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/add_danhmuc");
    }

    function update_danhmuc(){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $data = array('title' => $title);
        $temp = $this->model->updateObj_danhmuc($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/update_danhmuc");
    }

    function del_danhmuc(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj_danhmuc($id);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/del_danhmuc");
    }
    /**
     * cac ham lien quan den bai viet
     **/
    function baiviet(){
    	require 'layouts/header.php';
        $this->view->render('congthongtin/baiviet');
        require 'layouts/footer.php';
    }

    function content_bv(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_baiviet($this->_Info[0]['truonghoc_id'], $this->_Info[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('congthongtin/content_bv');
    }

    function formaddbaiviet(){
        require 'layouts/header.php';
        $this->view->render('congthongtin/formaddbaiviet');
        require 'layouts/footer.php';
    }

    function add_baiviet(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $title = $_REQUEST['title']; $intro = $_REQUEST['intro'];
        $content = addslashes($_REQUEST['content']); $userid = $this->_Info[0]['id'];
        $image = ($_FILES['image']['name'] != '') ? $this->_Convert->convert_img($_FILES['image']['name'], $this->_Convert->vn2latin($title, true)) : '';
        $file = ($_FILES['attachment']['name'] != '') ? $this->_Convert->convert_img($_FILES['attachment']['name'], time().'_'.$this->_Convert->vn2latin($title, true)) : '';
        $tieudiem = (isset($_REQUEST['tieu_diem'])) ? 1 : 0;
        $hienthitrangchu = (isset($_REQUEST['hien_thi_trang_chu'])) ? 1 : 0;
        $hienthidetail = (isset($_REQUEST['hien_thi_detail'])) ? 1 : 0;
        $data = array("truonghoc_id" => $truonghocid, 'cate_id' => $cateid, 'title' => $title, 'intro' => $intro,
                        'content' => $content, 'image' => $image, 'file' => $file, 'tieu_diem' => $tieudiem,
                        'hien_thi_trang_chu' => $hienthitrangchu, 'hien_thi_detail' => $hienthidetail,
                        'user_id' => $userid, 'create_at' => date("Y-m-d H:i:s"));
        $temp = $this->model->add_baiviet($data);
        if($temp){
            if($image != ''){
                move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/news/'.$this->_Info[0]['truonghoc_id'].'/'.$image);
            }
            if($file != ''){
                move_uploaded_file($_FILES['attachment']['tmp_name'], DIR_UPLOAD.'/news/'.$this->_Info[0]['truonghoc_id'].'/'.$file);
            }
            $jsonObj['msg'] = "Cập nhật bài viết thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật bài viết không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/add_baiviet");
    }

    function formeditbaiviet(){
        require 'layouts/header.php';
        $detail = $this->model->get_detail_update($_REQUEST['id']);
        $this->view->jsonObj = $detail;
        $this->view->render('congthongtin/formeditbaiviet');
        require 'layouts/footer.php';
    }

    function update_baiviet(){
        $id = $_REQUEST['id'];
        $cateid = $_REQUEST['danhmuc_id']; $title = $_REQUEST['title']; $intro = $_REQUEST['intro'];
        $content = addslashes($_REQUEST['content']);
        $image = ($_FILES['image']['name'] != '') ? $this->_Convert->convert_img($_FILES['image']['name'], $this->_Convert->vn2latin($title, true)) : $_REQUEST['image_old'];
        $file = ($_FILES['attachment']['name'] != '') ? $this->_Convert->convert_img($_FILES['attachment']['name'], time().'_'.$this->_Convert->vn2latin($title, true)) :$_REQUEST['file_old'];
        $tieudiem = (isset($_REQUEST['tieu_diem'])) ? 1 : 0;
        $hienthitrangchu = (isset($_REQUEST['hien_thi_trang_chu'])) ? 1 : 0;
        $hienthidetail = (isset($_REQUEST['hien_thi_detail'])) ? 1 : 0;
        $data = array('cate_id' => $cateid, 'title' => $title, 'intro' => $intro,
                        'content' => $content, 'image' => $image, 'file' => $file, 'tieu_diem' => $tieudiem,
                        'hien_thi_trang_chu' => $hienthitrangchu, 'hien_thi_detail' => $hienthidetail,
                        'create_at' => date("Y-m-d H:i:s"));
        $temp = $this->model->update_baiviet($id, $data);
        if($temp){
            if($image != ''){
                move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/news/'.$this->_Info[0]['truonghoc_id'].'/'.$image);
            }
            if($file != ''){
                move_uploaded_file($_FILES['attachment']['tmp_name'], DIR_UPLOAD.'/news/'.$this->_Info[0]['truonghoc_id'].'/'.$file);
            }
            $jsonObj['msg'] = "Cập nhật bài viết thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật bài viết không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/update_baiviet");
    }

    function detailbv(){
        require 'layouts/header.php';
        $detail = $this->model->get_detail($_REQUEST['id']);
        $this->view->jsonObj = $detail;
        $this->view->render("congthongtin/detailbv");
        require 'layouts/footer.php';
    }

    function del_baiviet(){
        $id = $_REQUEST['id'];
        $temp = $this->model->del_baiviet($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/del_baiviet");
    }

    function duyetbaiviet(){
    	require 'layouts/header.php';
        $this->view->render('congthongtin/duyetbaiviet');
        require 'layouts/footer.php';
    }

    function content_d(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_duyet($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('congthongtin/content_d');
    }

    function duyetbv(){
        $id = $_REQUEST['id'];
        $data = array('status' => 1);
        $temp = $this->model->update_baiviet($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/duyetbv");
    }

    function dangtin(){
        require 'layouts/header.php';
        $this->view->render('congthongtin/dangtin');
        require 'layouts/footer.php';
    }

    function content_dang(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_dang($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('congthongtin/content_dang');
    }

    function update_dangtin(){
        $id = $_REQUEST['id'];
        $link = $_REQUEST['link_dang'];
        $create = date("Y-m-d H:i:s");
        $data = array('link_dang' => $link, 'create_dang' => $create, 'status' => 2);
        $temp = $this->model->update_baiviet($id, $data);
        if($temp){
            $jsonObj['msg'] = "Đăng tin thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Đăng tin không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/update_dangtin");
    }
    /**
     * cac ham lien quan den van ban cong thong tin dien tu
     **/
    function vanban(){
    	require 'layouts/header.php';
        $this->view->render('congthongtin/vanban');
        require 'layouts/footer.php';
    }

    function content_vb(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_vanban($this->_Info[0]['truonghoc_id'], $this->_Info[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('congthongtin/content_vb');
    }

    function formaddvanban(){
        require 'layouts/header.php';
        $this->view->render('congthongtin/formaddvanban');
        require 'layouts/footer.php';
    }

    function add_vanban(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $sovanban = $_REQUEST['so_vanban'];
        $ngayvanban = $this->_Convert->convertDate($_REQUEST['ngay_vanban']);
        $title = $_REQUEST['title']; $trichyeu = $_REQUEST['trich_yeu'];
        $file = ($_FILES['attachment']['name'] != '') ? $this->_Convert->convert_img($_FILES['attachment']['name'], time().'_'.$this->_Convert->vn2latin($title, true)) : '';
        $userid = $this->_Info[0]['id'];
        $hienthiphong = (isset($_REQUEST['hien_thi_phong'])) ? 1 : 0;
        $hienthihome = (isset($_REQUEST['hien_thi_home'])) ? 1 : 0;
        $createat = date("Y-m-d H:i:s");
        if($this->model->dupliObj($truonghocid, 0, $sovanban) > 0){
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("truonghoc_id" => $truonghocid, 'cate_id' => $cateid, 'so_vanban' => $sovanban,
                            'ngay_vanban' => $ngayvanban, 'tieu_de' => $title, 'trich_yeu' => $trichyeu,
                            'file' => $file, 'user_id' => $userid, 'hien_thi_phong' => $hienthiphong,
                            'hien_thi_home' => $hienthihome, 'create_at' => $createat);
            $temp = $this->model->add_vanban($data);
            if($temp){
                move_uploaded_file($_FILES['attachment']['tmp_name'], DIR_UPLOAD.'/vanban/'.$this->_Info[0]['truonghoc_id'].'/'.$file);
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("congthongtin/add_vanban");
    }

    function formeditvanban(){
        require 'layouts/header.php';
        $detail = $this->model->get_updatE_vanban($_REQUEST['id']);
        $this->view->jsonObj = $detail;
        $this->view->render('congthongtin/formeditvanban');
        require 'layouts/footer.php';
    }

    function update_vanban(){
        $id = $_REQUEST['id']; $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $sovanban = $_REQUEST['so_vanban'];
        $ngayvanban = $this->_Convert->convertDate($_REQUEST['ngay_vanban']);
        $title = $_REQUEST['title']; $trichyeu = $_REQUEST['trich_yeu'];
        $file = ($_FILES['attachment']['name'] != '') ? $this->_Convert->convert_img($_FILES['attachment']['name'], time().'_'.$this->_Convert->vn2latin($title, true)) :$_REQUEST['file_old'];
        $hienthiphong = (isset($_REQUEST['hien_thi_phong'])) ? 1 : 0;
        $hienthihome = (isset($_REQUEST['hien_thi_home'])) ? 1 : 0;
        $createat = date("Y-m-d H:i:s");
        if($this->model->dupliObj($truonghocid, $id, $sovanban) > 0){
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('cate_id' => $cateid, 'so_vanban' => $sovanban, 'ngay_vanban' => $ngayvanban,
                            'tieu_de' => $title, 'trich_yeu' => $trichyeu, 'file' => $file,
                            'hien_thi_phong' => $hienthiphong, 'hien_thi_home' => $hienthihome,
                            'create_at' => $createat);
            $temp = $this->model->update_vanban($id, $data);
            if($temp){
                if($file != ''){
                    move_uploaded_file($_FILES['attachment']['tmp_name'], DIR_UPLOAD.'/vanban/'.$this->_Info[0]['truonghoc_id'].'/'.$file);
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
        $this->view->render("congthongtin/update_vanban");
    }

    function detailvb(){
        require 'layouts/header.php';
        $detail = $this->model->get_detail_vanban($_REQUEST['id']);
        $this->view->jsonObj = $detail;
        $this->view->render("congthongtin/detailvb");
        require 'layouts/footer.php';
    }

    function del_vanban(){
        $id = $_REQUEST['id'];
        $temp = $this->model->del_vanban($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/del_vanban");
    }

    function update_dangvb(){
        $id = $_REQUEST['id'];
        $link = $_REQUEST['link_dang'];
        $create = date("Y-m-d H:i:s");
        $data = array('link_dang' => $link, 'create_dang' => $create);
        $temp = $this->model->update_vanban($id, $data);
        if($temp){
            $jsonObj['msg'] = "Đăng tin thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Đăng tin không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("congthongtin/update_dangvb");
    }
}
?>
