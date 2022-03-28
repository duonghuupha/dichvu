<?php
class Phanbothietbi extends Controller{
    private $_Info;
    private $_Namhoc;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('phanbothietbi/index');
        require 'layouts/footer.php';
    }

    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('phanbothietbi/content');
    }

    function combo_thietbi(){
        $jsonObj = $this->model->get_combo_thietbi($this->_Info[0]['truonghoc_id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("phanbothietbi/combo_thietbi");
    }

    function combo_thietbi_con(){
        $jsonObj = $this->model->get_combo_thietbi_con($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("phanbothietbi/combo_thietbi_con");
    }

    function list_dachon(){
        $id = $_REQUEST['id']; $dachon = ($_REQUEST['dachon'] != '') ? base64_decode($_REQUEST['dachon']) : '';
        $array = array(); $idh = explode(".", $id);
        if($id != ''){
            if($dachon != ''){
                foreach(explode(",", $dachon) as $row){
                    //$value = explode(".", $row);
                    //if($value[0] != $idh[0]){
                        $array[] = $row;
                    //}
                }
                array_push($array, $id);
            }else{
                array_push($array, $id);
            }
        }else{
            $array = [];
        }
        $this->view->dachon = implode(",", array_diff($array, [0])); $this->view->array = $array;
        $this->view->render("phanbothietbi/list_dachon");
    }

    function add(){
        $phongban = $_REQUEST['phongban_id']; $truonghocid = $this->_Info[0]['truonghoc_id'];
        $namhocid = $this->_Namhoc[0]['id']; $code = time(); $create_at = date("Y-m-d H:i:s");
        $datadc = $_REQUEST['datadc'];
        if($this->model->dupliObj($truonghocid, 0, $phongban) > 0){
            $jsonObj['msg'] = "Phòng ban này đã được phân bổ thiết bị";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("truonghoc_id" => $truonghocid, 'namhoc_id' => $namhocid, 'phongban_id' => $phongban,
                            "code" => $code, 'create_at' => $create_at);
            $temp = $this->model->addObj($data);
            if($temp){
                $array = explode(",", $datadc);
                foreach($array as $row){
                    $value = explode(".", $row);
                    $data_ct = array("code" => $code, 'thietbi_id' => $value[0], "so_con" => $value[1]);
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
        $this->view->render("phanbothietbi/add");
    }

    function update(){
        $id = $_REQUEST['id'];
        $phongban = $_REQUEST['phongban_id']; $truonghocid = $this->_Info[0]['truonghoc_id'];
        $namhocid = $this->_Namhoc[0]['id']; $code = $_REQUEST['code']; $create_at = date("Y-m-d H:i:s");
        $datadc = $_REQUEST['datadc'];
        if($this->model->dupliObj($truonghocid, $id, $phongban) > 0){
            $jsonObj['msg'] = "Phòng ban này đã được phân bổ thiết bị";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('phongban_id' => $phongban, 'create_at' => $create_at);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $this->model->delObj_ct($code);
                $array = explode(",", $datadc);
                foreach($array as $row){
                    $value = explode(".", $row);
                    $data_ct = array("code" => $code, 'thietbi_id' => $value[0], "so_con" => $value[1], 'status' => 0);
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
        $this->view->render("phanbothietbi/update");
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
        $this->view->render("phanbothietbi/del");
    }
}
?>
