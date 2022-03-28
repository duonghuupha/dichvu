<?php
class Luanchuyenthietbi extends Controller{
    private $_Info; private $_Namhoc;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('luanchuyenthietbi/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('luanchuyenthietbi/content');
    }
    
    function combo_thietbi(){
        $phongbanid = $_REQUEST['phongbanid'];
        $jsonObj = $this->model->get_combo_thietbi($phongbanid);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("luanchuyenthietbi/combo_thietbi");
    }
    
    function add(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $namhocid = $this->_Namhoc[0]['id'];
        $phongbandi = $_REQUEST['phongban_id'];
        $phongbanden = $_REQUEST['noiden_id'];
        $thietbi = $_REQUEST['thietbi_id'];
        $thietbi = explode(".", $thietbi); $thietbiid = $thietbi[0]; $socon = $thietbi[1];
        $create = date("Y-m-d H:i:s");
        $data = array("truonghoc_id" => $truonghocid, 'namhoc_id' => $namhocid, 'phongbandi_id' => $phongbandi,
                        'phongbanden_id' => $phongbanden, 'thietbi_id' => $thietbiid, 'so_con' => $socon,
                        'create_at' => $create);
        $temp = $this->model->addObj($data);
        if($temp){
            // kiem tra xem da co ban ghi phan bo cho phong ban chua
            if($this->model->check_phanbo_phongban($phongbanden, $truonghocid, $namhocid) > 0){
                // da ton tai phan no
                $detail = $this->model->get_info_phanbo($phongbanden, $truonghocid);
                $data = array("code" => $detail[0]['code'], 'thietbi_id' => $thietbiid, 'so_con' => $socon,
                                'status' => 0);
                $tmp = $this->model->addObj_phanbo_ct($data);
                if($tmp){
                    $datau = array("status" => 1);
                    $this->model->updateObj($phongbandi, $thietbiid, $socon, $datau);
                    $jsonObj['msg'] = "Luân chuyển thiết bị thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Luân chuyển thiết bị không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                // chua ton tai phan bo
                $code = time();
                $data = array("truonghoc_id" => $truonghocid, 'namhoc_id' => $namhocid, 'phongban_id' => $phongbanden,
                                'code' => $code, 'create_at' => $create);
                $tmp = $this->model->addObj_phanbo($data);
                if($tmp){
                    $data_ct = array("code" => $code, 'thietbi_id' => $thietbiid, 'so_con' => $socon,
                                'status' => 0);
                    $this->model->addObj_phanbo_ct($data_ct);
                    $datau = array("status" => 1);
                    $this->model->updateObj($phongbandi, $thietbiid, $socon, $datau);
                    $jsonObj['msg'] = "Luân chuyển thiết bị thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Luân chuyển thiết bị không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{
            $jsonObj['msg'] = "Luân chuyển thiết bị không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("luanchuyenthietbi/add");
    }
}
?>