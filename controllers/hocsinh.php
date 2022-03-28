<?php
class Hocsinh extends Controller{
    private $_Convert;
    private $_Info;
    private $_Namhoc;
    private $_Data;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Convert = new Convert();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
        $this->_Data = new Model();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('hocsinh/index');
        require 'layouts/footer.php';
    }

    function content(){
        $rows = 20;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $phongbanid = (count($phongban) > 0) ? $phongban[0]['id'] : 0;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $phongbanid,$keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('hocsinh/content');
    }

    function formadd(){
        require 'layouts/header.php';
        $this->view->render('hocsinh/formadd');
        require 'layouts/footer.php';
    }

    function add(){
        $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname'];
        $ngaysinh = $this->_Convert->convertDate($_REQUEST['ngay_sinh']);
        $gioitinh = $_REQUEST['gioi_tinh']; $diachi = $_REQUEST['dia_chi'];
        $dulieu = json_decode($_REQUEST['data_quanhe'], true);
        $lophoc = (isset($_REQUEST['lop_hoc']) && $_REQUEST['lop_hoc'] != '') ? $_REQUEST['lop_hoc'] : 0;
        if($this->model->dupliObj($this->_Info[0]['truonghoc_id'], $code, 0) > 0){
            $jsonObj['msg'] = "Mã học sinh này đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], 'code' => $code, "fullname" => $fullname,
                            "ngay_sinh" => $ngaysinh, 'gioi_tinh' => $gioitinh, 'dia_chi' => $diachi, "status" => 1,
                            'phongban_id' => $lophoc);
            $temp = $this->model->addObj($data);
            if($temp){
                foreach($dulieu as $row){
                    $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], "code" => $code,
                                    "fullname" => $row['fullname'], "loai_quan_he" => $row['quanhe'],
                                    "dien_thoai" => $row['dienthoai'], "nghe_nghiep" => $row['nghenghiep'],
                                    "nam_sinh" => $row['namsinh']);
                    $this->model->addObj_quanhe($data);
                }
                if(isset($_REQUEST['lop_hoc']) && $_REQUEST['lop_hoc'] != ''){
                    $data_lop = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'phongban_from' => 0,
                                        'hocsinh_id' => $this->model->get_id_hoc_sinh_via_code($code),
                                        'phongban_to' => $_REQUEST['lop_hoc'], 'date_change' => date('Y-m-d'),
                                        'create_at' => date("Y-m-d H:i:s"), 'namhoc_id' => $this->_Namhoc[0]['id']);
                    $this->model->add_chuyenlop($data_lop);
                }
                $jsonObj['msg'] = "Thêm mới dữ liệu thành công";
                $jsonObj['success'] = true;
                $jsonObj['code'] = $code;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm mới dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("hocsinh/add");
    }

    function formedit(){
        require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->display($id);
        $quanhe = $this->model->get_quanhe_hocsinh($jsonObj[0]['code']);
        $this->view->jsonObj = $jsonObj; $this->view->quanhe = $quanhe;
        $this->view->render('hocsinh/formedit');
        require 'layouts/footer.php';
    }

    function update(){
        $id = $_REQUEST['id']; $fullname = $_REQUEST['fullname']; $code = $_REQUEST['code'];
        $ngaysinh = $this->_Convert->convertDate($_REQUEST['ngay_sinh']);
        $gioitinh = $_REQUEST['gioi_tinh']; $diachi = $_REQUEST['dia_chi'];
        $dulieu = json_decode($_REQUEST['data_quanhe'], true);
        if($this->model->dupliObj($this->_Info[0]['truonghoc_id'], $code, $id) > 0){
            $jsonObj['msg'] = "Mã học sinh này đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("fullname" => $fullname, "ngay_sinh" => $ngaysinh, 'gioi_tinh' => $gioitinh,
                            'dia_chi' => $diachi);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $this->model->delObj_quanhe($code);
                foreach($dulieu as $row){
                    $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], "code" => $code,
                                    "fullname" => $row['fullname'], "loai_quan_he" => $row['quanhe'],
                                    "dien_thoai" => $row['dienthoai'], "nghe_nghiep" => $row['nghenghiep'],
                                    "nam_sinh" => $row['namsinh']);
                    $this->model->addObj_quanhe($data);
                }
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $jsonObj['code'] = $code;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("hocsinh/update");
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
        $this->view->render("hocsinh/del");
    }

    function import(){
        require 'layouts/header.php';
        $this->view->render("hocsinh/import");
        require 'layouts/footer.php';
    }

    function do_import(){
        // xoa het nhung ban ghi tam
        $tmp = $this->model->delObj_temp($this->_Info[0]['truonghoc_id']);
        if($tmp){
            $lophoc = $_REQUEST['lop_hoc'];
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
                        $hoten = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 3){
                        $ngaysinh = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 4){
                        $gioitinh = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 5){
                        $diachi = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }
                }
                $birthday = $this->_Convert->convertDate($ngaysinh); $gender = ($gioitinh == 'Nam') ? 1 : 2;
                $data = array("truonghoc_id" => $this->_Info[0]['truonghoc_id'], "code" => $code,
                                'fullname' => $hoten, 'ngay_sinh' => $birthday, 'gioi_tinh' => $gender,
                                'dia_chi' => $diachi, 'status' => 99, 'phongban_id' => $lophoc);
                $this->model->addObj($data);
                //xep lop cho hoc sinh
                /*$data_lop = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'phongban_from' => 0,
                                    'hocsinh_id' => $this->model->get_id_hoc_sinh_via_code($code),
                                    'phongban_to' => $lophoc, 'date_change' => date("Y-m-d"),
                                    'create_at' => date("Y-m-d H:i:s"), 'namhoc_id' => $this->_Namhoc[0]['id']);
                $this->model->add_chuyenlop($data_lop);*/
            }
            $jsonObj['msg'] = "Import dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('hocsinh/do_import');
    }

    function content_tmp(){
        $rows = 20;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_list_hoc_sinh_temp($this->_Info[0]['truonghoc_id'], $keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('hocsinh/content_tmp');
    }

    function update_code(){
        $id = $_REQUEST['id'];
        $data = array("code" => 'HS-'.rand(11111111, 99999999));
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
        $this->view->render('hocsinh/update_code');
    }

    function update_all(){
        if($this->model->check_dupli_code($this->_Info[0]['truonghoc_id']) > 0){
            $jsonObj['msg'] = "Có học sinh trùng mã, bạn kiểm tra lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            // lay tat ca cac ban ghi co status = 99 de them vao bang chuyen lop
            $hocsinh = $this->model->get_all_hocsinh_temp_before_update($this->_Info[0]['truonghoc_id']);
            foreach ($hocsinh as $row) {
                $data_lop = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'phongban_from' => 0,
                                    'hocsinh_id' => $row['id'], 'phongban_to' => $row['phongban_id'],
                                    'date_change' => date("Y-m-d"), 'create_at' => date("Y-m-d H:i:s"),
                                    'namhoc_id' => $this->_Namhoc[0]['id']);
                $this->model->add_chuyenlop($data_lop);
            }
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
        $this->view->render('hocsinh/update_all');
    }

    function hoso(){
        require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->display($id);
        $quanhe = $this->model->get_quanhe_hocsinh($jsonObj[0]['code']);
        $quatrinh = $this->model->qua_trinh_chuyen_lop($id);
        $this->view->jsonObj = $jsonObj; $this->view->quanhe = $quanhe;
        $this->view->quatrinh = $quatrinh;
        $this->view->render("hocsinh/hoso");
        require 'layouts/footer.php';
    }

    function chuyenlop(){
        $hocsinhid = $_REQUEST['id_hocsinh'];
        $tulop = (isset($_REQUEST['tu_lop']) && $_REQUEST['tu_lop'] != '') ? $_REQUEST['tu_lop'] : 0;
        $denlop = $_REQUEST['den_lop'];
        $data = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'hocsinh_id' => $hocsinhid,
                        'phongban_from' => $tulop, 'phongban_to' => $denlop, 'date_change' => date("Y-m-d"),
                        'create_at' => date("Y-m-d H:i:s"));
        $temp = $this->model->add_chuyenlop($data);
        if($temp){
            $data_lop = array('phongban_id' => $denlop);
            $this->model->updateObj($hocsinhid, $data_lop);
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("hocsinh/chuyenlop");
    }

    function changeclass(){
        require 'layouts/header.php';
        $this->view->render("hocsinh/changeclass");
        require 'layouts/footer.php';
    }

    function list_hocsinh(){
        $rows = 20;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $_REQUEST['phongbanid'], $keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('hocsinh/list_hocsinh');
    }

    function do_change_class(){
        $tulop = $_REQUEST['tu_lop']; $denlop = $_REQUEST['den_lop'];
        $data_chuyenlop = base64_decode($_REQUEST['data_chuyenlop']);
        $data_chuyenlop = explode(",", $data_chuyenlop);
        foreach($data_chuyenlop as $row){
            $data = array('truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'hocsinh_id' => $row, 'phongban_from' => $tulop,
                            'phongban_to' => $denlop, 'date_change' => date("Y-m-d"), 'create_at' => date("Y-m-d H:i:s"),
                            'namhoc_id' => $this->_Namhoc[0]['id']);
            $this->model->add_chuyenlop($data);
            // cap nhat lop vao bang hoc sinh
            $data_lop = array('phongban_id' => $denlop);
            $this->model->updateObj($row, $data_lop);
        }
        $jsonObj['msg'] = "Chuyển lớp thành công";
        $jsonObj['success'] = true;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("hocsinh/do_change_class");
    }

    function export(){
        require 'layouts/header.php';
        $this->view->render("hocsinh/export");
        require 'layouts/footer.php';
    }

    function search(){
        $rows = 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $namhocid  = $_REQUEST['namhocid']; $lophoc = $_REQUEST['lophoc'];
        $gioitinh = $_REQUEST['gioitinh']; $ngaysinh = $_REQUEST['ngaysinh'];
        $trangthai = $_REQUEST['trangthai'];
        $jsonObj = $this->model->get_data_display($this->_Info[0]['truonghoc_id'], $namhocid, $lophoc, $gioitinh, $ngaysinh, $trangthai, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('hocsinh/search');
    }

    function exportxls(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;
        $namhocid  = $_REQUEST['namhocid']; $lophoc = $_REQUEST['lophoc'];
        $gioitinh = $_REQUEST['gioitinh']; $ngaysinh = $_REQUEST['ngaysinh'];
        $trangthai = $_REQUEST['trangthai']; $year = $_REQUEST['year'];

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);
        $namhoc = $this->_Data->get_title_nam_hoc_by_id($year);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'DANH SÁCH HỌC SINH');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 7, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', $namhoc[0]['title']);
		$sheet->mergeCellsByColumnAndRow ( 0, 4, 7, 4);
		$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 6;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 20 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 10 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('6')->setRowHeight(20);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã HS', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Họ và tên', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày sinh', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giới tính', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Lớp', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Địa chỉ', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Trạng thái', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_data_expoort($this->_Info[0]['truonghoc_id'], $namhocid, $lophoc, $gioitinh, $ngaysinh, $trangthai);
        $i = 0;
        foreach($jsonObj as $rows){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $status = ($rows['status'] == 1) ? 'Đang đi học' : 'Nghỉ học';
            if($namhocid != ''){ // lay lop theo nam hoc
                $lop = $this->_Data->get_title_lophoc_via_namhoc($rows['id'], $namhocid);
            }else{ // lay lop theo du lieu truyen vao
                $lop = $this->_Data->get_title_lophoc($lophoc);
            }
            $gioitinh = ($rows['gioi_tinh'] == 1) ? 'Nam' : 'Nữ';
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['code'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['fullname'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("d-m-Y",  strtotime($rows['ngay_sinh'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $gioitinh, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $lop, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['dia_chi'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $status, $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'F' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'H' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'H' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Danh_sach_hoc_sinh.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

    function exportfull(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;
        $namhocid  = $_REQUEST['namhocid']; $lophoc = $_REQUEST['lophoc'];
        $gioitinh = $_REQUEST['gioitinh']; $ngaysinh = $_REQUEST['ngaysinh'];
        $trangthai = $_REQUEST['trangthai']; $year = $_REQUEST['year'];

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);
        $namhoc = $this->_Data->get_title_nam_hoc_by_id($year);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'DANH SÁCH HỌC SINH');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 15, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', $namhoc[0]['title']);
		$sheet->mergeCellsByColumnAndRow ( 0, 4, 15, 4);
		$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 6;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 20 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'J' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'K' )->setWidth ( 13 );
        $sheet->getColumnDimension ( 'L' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'M' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'N' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'O' )->setWidth ( 13 );
        $sheet->getColumnDimension ( 'P' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('6')->setRowHeight(20);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
        $sheet->mergeCellsByColumnAndRow(0, $rowIndex, 0, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã HS', $colIndex );
        $sheet->mergeCellsByColumnAndRow(1, $rowIndex, 1, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Họ và tên', $colIndex );
        $sheet->mergeCellsByColumnAndRow(2, $rowIndex, 2, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày sinh', $colIndex );
        $sheet->mergeCellsByColumnAndRow(3, $rowIndex, 3, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giới tính', $colIndex );
        $sheet->mergeCellsByColumnAndRow(4, $rowIndex, 4, ($rowIndex + 1));
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Lớp', $colIndex );
        $sheet->mergeCellsByColumnAndRow(5, $rowIndex, 5, ($rowIndex + 1));
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Địa chỉ', $colIndex );
        $sheet->mergeCellsByColumnAndRow(6, $rowIndex, 6, ($rowIndex + 1));
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Trạng thái', $colIndex );
        $sheet->mergeCellsByColumnAndRow(7, $rowIndex, 7, ($rowIndex + 1));
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Thông tin bố', 'L' );
        $sheet->mergeCellsByColumnAndRow(8, $rowIndex, 11, $rowIndex);
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Thông tin mẹ', 'P' );
        $sheet->mergeCellsByColumnAndRow(12, $rowIndex, 15, $rowIndex);
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $sheet->setCellValue ( 'I7', 'Họ và tên' );
		$sheet->setCellValue ( 'J7', 'Năm sinh' );
        $sheet->setCellValue ( 'K7', 'Điện thoại' );
        $sheet->setCellValue ( 'L7', 'Nghề nghiệp' );
        $sheet->setCellValue ( 'M7', 'Họ và tên' );
        $sheet->setCellValue ( 'N7', 'Năm sinh' );
        $sheet->setCellValue ( 'O7', 'Điện thoại' );
        $sheet->setCellValue ( 'P7', 'Nghề nghiệp' );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . ($rowIndex + 1) );

        $rowIndex += 2;
		$colIndex = $colStart;
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '1', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '2', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '3', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '4', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '5', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '6', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '7', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '8', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '9', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '10', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '11', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '12', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '13', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '14', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '15', $colIndex );
		$helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '16', $colIndex );
		$helpExport->setStyle_10_TNR_I_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_data_expoort($this->_Info[0]['truonghoc_id'], $namhocid, $lophoc, $gioitinh, $ngaysinh, $trangthai);
        $i = 0;
        foreach($jsonObj as $rows){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $status = ($rows['status'] == 1) ? 'Đang đi học' : 'Nghỉ học';
            if($namhocid != ''){ // lay lop theo nam hoc
                $lop = $this->_Data->get_title_lophoc_via_namhoc($rows['id'], $namhocid);
            }else{ // lay lop theo du lieu truyen vao
                $lop = $this->_Data->get_title_lophoc($lophoc);
            }
            $gioitinh = ($rows['gioi_tinh'] == 1) ? 'Nam' : 'Nữ';
            $quanhebo = $this->model->get_quanhe_hocsinh_export($rows['code'], 1);
            $quanheme = $this->model->get_quanhe_hocsinh_export($rows['code'], 2);
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['code'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['fullname'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("d-m-Y",  strtotime($rows['ngay_sinh'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $gioitinh, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $lop, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['dia_chi'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $status, $colIndex );
            // quan he bo
            if(count($this->model->get_quanhe_hocsinh_export($rows['code'],   1)) > 0){
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanhebo[0]['fullname'], $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanhebo[0]['nam_sinh'], $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanhebo[0]['dien_thoai'].' ', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanhebo[0]['nghe_nghiep'], $colIndex );
            }else{
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
            }
            // quan he me
            if(count($this->model->get_quanhe_hocsinh_export($rows['code'],   2)) > 0){
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanheme[0]['fullname'], $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanheme[0]['nam_sinh'], $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanheme[0]['dien_thoai'].' ', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $quanheme[0]['nghe_nghiep'], $colIndex );
            }else{
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
            }
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'F' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'J' . $rowIndex, 'J' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'N' . $rowIndex, 'N' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'P' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'P' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Danh_sach_hoc_sinh_day_du.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }
}
?>
