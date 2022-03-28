<?php
class Thongtinthietbi extends Controller{
    private $_Info;
    private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('thongtinthietbi/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('thongtinthietbi/content');
    }

    function add(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $code = $_REQUEST['code'];
        $title = $_REQUEST['title']; $namsudung = $_REQUEST['nam_su_dung'];
        $nguyengia = $_REQUEST['nguyen_gia']; $khauhao = $_REQUEST['khau_hao'];
        $xuatsu = $_REQUEST['xuat_su']; $mota = $_REQUEST['mo_ta'];
        $image = ($_FILES['image']['name'] != '') ? $this->_Convert->convert_img($_FILES['image']['name'], $code) : '';
        if($this->model->dupliObj($truonghocid, 0, $code) > 0){
            $jsonObj['msg'] = "Mã thiết bị đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('truonghoc_id' => $truonghocid, 'cate_id' => $cateid, 'image' => $image, 'code' => $code,
                            'title' => $title, 'nam_su_dung' => $namsudung, 'nguyen_gia' => $nguyengia,
                            'khau_hao' => $khauhao, 'xuat_su' => $xuatsu, 'mo_ta' => $mota, 'so_luong' => 0,
                            'status' => 0,  'create_at' => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/assets/'.$truonghocid.'/'.$image);
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
        $this->view->render('thongtinthietbi/add');
    }
    
    function update(){
        $id = $_REQUEST['id']; $imageold = $_REQUEST['imageold'];
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $cateid = $_REQUEST['danhmuc_id']; $code = $_REQUEST['code'];
        $title = $_REQUEST['title']; $namsudung = $_REQUEST['nam_su_dung'];
        $nguyengia = $_REQUEST['nguyen_gia']; $khauhao = $_REQUEST['khau_hao'];
        $xuatsu = $_REQUEST['xuat_su']; $mota = $_REQUEST['mo_ta'];
        $image = ($_FILES['image']['name'] != '') ? $this->_Convert->convert_img($_FILES['image']['name'], $code) : $imageold;
        if($this->model->dupliObj($truonghocid, $id, $code) > 0){
            $jsonObj['msg'] = "Mã thiết bị đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('cate_id' => $cateid, 'image' => $image, 'title' => $title, 'nam_su_dung' => $namsudung, 
                            'nguyen_gia' => $nguyengia, 'khau_hao' => $khauhao, 'xuat_su' => $xuatsu, 
                            'mo_ta' => $mota);
            $temp = $this->model->updateobj($id, $data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/assets/'.$truonghocid.'/'.$image);
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
        $this->view->render('thongtinthietbi/update');
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
        $this->view->render('thongtinthietbi/del');
    }
    
    function import(){
        require 'layouts/header.php';
        $this->view->render('thongtinthietbi/import');
        require 'layouts/footer.php';
    }
    
    function do_import(){
        // xoa het nhung ban ghi tam
        $tmp = $this->model->delObj_temp($this->_Info[0]['truonghoc_id']);
        if($tmp){
            $file = $_FILES['file_at']['tmp_name'];
            $objFile = PHPExcel_IOFactory::identify($file);
            $objData = PHPExcel_IOFactory::createReader($objFile);
            $objData->setReadDataOnly(true);
            $objPHPExcel = $objData->load($file);
            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            $Totalrow = $sheet->getHighestRow();
            $LastColumn = $sheet->getHighestColumn();
            $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
            $data = [];
            for ($i = 4; $i <= $Totalrow; $i++) {
                for ($j = 1; $j < $TotalCol; $j++) {
                    //$data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
                    if($j == 1){
                        $code = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 2){
                        $title = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 3){
                        $xuatsu = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 4){
                        $namsudung = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 5){
                        $nguyengia = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 6){
                        $khauhao = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 7){
                        $mota = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 8){
                        $soluong = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }
                }
                $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], "code" => $code, 
                                'title' => $title, 'xuat_su' => $xuatsu, 'nam_su_dung' => $namsudung,
                                'nguyen_gia' => $nguyengia, 'khau_hao' => $khauhao, 'mo_ta' => $mota, 
                                'so_luong' => $soluong, 'status' => 99);
                $this->model->addObj($data);
            }
            $jsonObj['msg'] = "Import dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('thongtinthietbi/do_import');
    }
    
    function content_tmp(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_tmp($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('thongtinthietbi/content_tmp');
    }
    
    function del_tmp(){
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
        $this->view->render('thongtinthietbi/del_tmp');
    }
    
    function update_code(){
        $id = $_REQUEST['id'];
        $data = array("code" => rand(111111, 999999));
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
        $this->view->render('thongtinthietbi/update_code');
    }
    
    function update_all(){
        if($this->model->check_dupli_code($this->_Info[0]['truonghoc_id']) > 0){
            $jsonObj['msg'] = "Có thiết bị trùng mã, bạn kiểm tra lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $temp = $this->model->update_all_tmp($this->_Info[0]['truonghoc_id']);
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
        $this->view->render('thongtinthietbi/update_all');
    }
}
?>