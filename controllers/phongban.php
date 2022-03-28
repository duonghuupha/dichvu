<?php
class Phongban extends Controller{
    private $_Info;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
    }

    function content(){
        $rows = 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('phongban/content');
    }

    function add(){
        $titlep = $_REQUEST['title_physic']; $titlev = $_REQUEST['title_virtual'];
        $codinh = (isset($_REQUEST['co_dinh']) && $_REQUEST['co_dinh'] != '') ? 1 : 0;
        $namhocid = $_REQUEST['namhoc_id']; $code = time();
        $data = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'namhoc_id' => $namhocid,
                        'title_physic' => $titlep, 'title_virtual' => $titlev, 'co_dinh' => $codinh,
                        'status' => 0, 'code' => $code);
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
        $this->view->render("phongban/add");
    }

    function update(){
        $id = $_REQUEST['id_phongban'];
        $titlep = $_REQUEST['title_physic']; $titlev = $_REQUEST['title_virtual'];
        $codinh = (isset($_REQUEST['co_dinh']) && $_REQUEST['co_dinh'] != '') ? 1 : 0;
        $namhocid = $_REQUEST['namhoc_id'];
        $data = array('namhoc_id' => $namhocid, 'title_physic' => $titlep, 'title_virtual' => $titlev,
                        'co_dinh' => $codinh);
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
        $this->view->render("phongban/update");
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
        $this->view->render("phongban/del");
    }

    function copy(){
        $idcu = $_REQUEST['id_cu']; // id phong ban copy
        $namhoccu = $_REQUEST['namhoccuid']; // nam hoc phong ban copy
        $namhocid = $_REQUEST['namhocc_id'];
        $titlep = $_REQUEST['title_physic'];
        $titlev = $_REQUEST['title_virtual'];
        //$copy = isset($_REQUEST['copytb']) ? 1 : 0;
        $copygv = isset($_REQUEST['copygv']) ? 1 : 0;
        $giaovien = ($copygv == 1) ? $_REQUEST['giao_vien'] : '';
        $code = time();
        $data= array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], 'namhoc_id' => $namhocid,
                        "title_physic" => $titlep, 'title_virtual' => $titlev, 'co_dinh' => 0,
                        "status" => 0, 'code' => $code, 'giao_vien' => $giaovien);
        $datau = array("status" => 1);
        $temp = $this->model->addObj($data);
        if($temp){
            // cap nhat trang thai phong ban cu
            $tmp = $this->model->updateObj($idcu, $datau);
            if($tmp){
                // copy thiet bi sang phong ban moi
                //if($copy == 1){
                    // lay thong tin phong ban vua tao thong qua code vua tao
                $info = $this->model->get_info_via_code($code);
                $datapb = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], 'namhoc_id' => $namhocid,
                                "phongban_id" => $info[0]['id'], "code" => $code, "create_at" => date("Y-m-d H:i:s"));
                $temple = $this->model->addObj_phanbo($datapb);
                if($temple){
                    // lay tat ca cac thiet bi da dc phan bo
                    $thietbi = $this->model->get_all_thietbi_phanbo($idcu);
                    foreach($thietbi as $row){
                        $datapbct = array("code" => $code, "thietbi_id" => $row['thietbi_id'],
                                    "so_con" => $row['so_con'], "status" => 0);
                        $this->model->addObj_phanbo_ct($datapbct);
                    }
                }
                //}
                $jsonObj['msg'] = "Copy phòng ban thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Copy phòng ban không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Copy phòng ban không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("phongban/copy");
    }

    function phanbogiaovien(){
        $id = $_REQUEST['phongbanid'];
        $giaovien = $_REQUEST['data_pbgv'];
        $data = array("giao_vien" => $giaovien);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Phân bổ giáo viên thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Phân bổ giáo viên không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("phongban/phanbogiaovien");
    }
}
?>
