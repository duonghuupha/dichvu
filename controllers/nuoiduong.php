<?php
class Nuoiduong extends Controller{
    private $_Info;
    private $_Namhoc;
    private $_Convert;
    private $_Data;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
        $this->_Convert = new Convert();
        $this->_Data = new Model();
    }

    /*function index(){
        require 'layouts/header.php';
        $this->view->render('nuoiduong/index');
        require 'layouts/footer.php';
    }*/

    function baoan(){
        require 'layouts/header.php';
        $phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $this->view->phongban = $phongban;
        $this->view->render('nuoiduong/baoan');
        require 'layouts/footer.php';
    }

    function do_baoan(){
        $userid = $this->_Info[0]['id']; $truonghocid = $this->_Info[0]['truonghoc_id'];
        $phongbanid = $_REQUEST['phongbanid'];
        $anchinh = $_REQUEST['an_chinh']; $coduong = $_REQUEST['co_duong'];
        $khongduong = $_REQUEST['khong_duong'];
        $ngay = date("Y-m-d"); $create_at = date("Y-m-d H:i:s");
        $phongban = $this->model->get_info_phongban_via_userid($userid, $truonghocid, $this->_Namhoc[0]['id']);
        $phongban_title = $this->_Convert->vn2latin($phongban[0]['title_virtual'], true);

        $dirname = date('m_Y');
        $filename = DIR_UPLOAD.'/nuoiduong/'.$truonghocid.'/'.$dirname;
        if (!file_exists($filename)){
            mkdir(DIR_UPLOAD.'/nuoiduong/'.$truonghocid.'/'.$dirname, 0777, true);
        }
        $filexml = $filename.'/'.$phongban_title.'_'.date('d_m_Y').'.xml';
        $Datetime_acdate  = strtotime($create_at);
        $DayofWeek = date('D', $Datetime_acdate );
        if($DayofWeek == 'Sat' or $DayofWeek == 'Sun'){
            $jsonObj['msg'] = "Bạn không thể báo ăn vào ngày thứ 7 và chủ nhất";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            // kiem tra so luong bao an va so luong hoc sinh thuc te
            $tonghocsinh = $this->model->get_total_hocsinh_via_phongbanid($truonghocid, $phongbanid);
            if($anchinh > $tonghocsinh || $coduong > $tonghocsinh || $khongduong > $tonghocsinh){
                $jsonObj['msg'] = "Bạn không thể báo ăn vượt quá tổng số học sinh có trong lớp";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                if(!file_exists($filexml)){
                    $dom = new DOMDocument('1.0','UTF-8');
                    $dom->formatOutput = true;
                    $root = $dom->createElement('nuoiduong_baoan');
                    $dom->appendChild($root);
                    $result = $dom->createElement('result');
                    $root->appendChild($result);
                    $result->setAttribute('id', 1);
                    $result->appendChild( $dom->createElement('name', $this->_Info[0]['fullname']) );
                    $result->appendChild( $dom->createElement('time', date('H:i:s d-m-Y')) );
                    $result->appendChild( $dom->createElement('anchinh', $anchinh) );
                    $result->appendChild( $dom->createElement('coduong', $coduong) );
                    $result->appendChild( $dom->createElement('khongduong', $khongduong) );
                    $dom->save($filexml) or die('XML Create Error');
                }else{
                    $dom = new DOMDocument();
                    $dom->formatOutput = true;
                    $dom->load($filexml, LIBXML_NOBLANKS);
                    $root = $dom->documentElement;
                    $newresult = $root->appendChild( $dom->createElement('result') );
                    $newresult->setAttribute('id', 2);
                    $newresult->appendChild( $dom->createElement('name',$this->_Info[0]['fullname']) );
                    $newresult->appendChild( $dom->createElement('time', date('H:i:s d-m-Y')) );
                    $newresult->appendChild( $dom->createElement('anchinh', $anchinh) );
                    $newresult->appendChild( $dom->createElement('coduong', $coduong) );
                    $newresult->appendChild( $dom->createElement('khongduong', $khongduong) );
                    $dom->save($filexml) or die('XML Create Error');
                }
                // cap nhat du lieu
                if($this->model->check_result_baoan(date('Y-m-d'), $phongbanid, $truonghocid) == 0){
                    $data = array('ngay' => $ngay, 'user_id' => $userid, 'phongban_id' => $phongbanid,
                                    'file' => $phongban_title.'_'.date('d_m_Y').'.xml',
                                    'create_at' => $create_at, 'truonghoc_id' => $truonghocid);
                    $temp = $this->model->addObj($data);
                    if($temp){
                        $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $jsonObj['phongbanid'] = $phongbanid;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    $data = array('create_at' => $create_at);
                    $temp = $this->model->updateObj($truonghocid, $phongbanid, $ngay, $data);
                    if($temp){
                        $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $jsonObj['phongbanid'] = $phongbanid;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }
        }

        $this->view->render('nuoiduong/do_baoan');
    }

    function history_date(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $phongbanid = $phongban[0]['id'];
        $data = $this->model->get_data_baoan_trongngay($phongbanid, $truonghocid, date("Y-m-d"));
        if(count($data) > 0){
            $filexml = $data[0]['file']; $filepath = DIR_UPLOAD.'/nuoiduong/'.$truonghocid.'/'.date("m_Y").'/'.$filexml;
            $doc = new DOMDocument();
            $doc->load($filepath);
            $result = $doc->getElementsByTagName("result"); $array = array();
            foreach($result as $row){
                $taghoten = $row->getElementsByTagName("name");
                $hoten = $taghoten->item(0)->nodeValue;
                $tagthoigian = $row->getElementsByTagName("time");
                $thoigian = $tagthoigian->item(0)->nodeValue;
                $taganchinh = $row->getElementsByTagName("anchinh");
                $anchinh = $taganchinh->item(0)->nodeValue;
                $tagcoduong = $row->getElementsByTagName("coduong");
                $coduong = $tagcoduong->item(0)->nodeValue;
                $tagkhongduong = $row->getElementsByTagName("khongduong");
                $khongduong = $tagkhongduong->item(0)->nodeValue;
                $array[] = array('name' => $hoten, 'time' => $thoigian, 'anchinh' => $anchinh,
                                    'coduong' => $coduong, 'khongduong' => $khongduong);
            }
            $jsonObj = $array;
        }else{
            $jsonObj = array();
        }
        $this->view->jsonObj = $jsonObj;
        $this->view->render('nuoiduong/history_date');
    }

    function history(){
        $rows = 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $phongban = $this->model->get_info_phongban_via_userid($this->_Info[0]['id'], $this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $phongban[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('nuoiduong/history');
    }

    function view_history(){
        $id = $_REQUEST['id'];
        $item = $this->model->get_detail($id);
        $file = DIR_UPLOAD.'/nuoiduong/'.$item[0]['truonghoc_id'].'/'.date("m_Y", strtotime($item[0]['ngay'])).'/'.$item[0]['file'];
        $doc = new DOMDocument();
        $doc->load($file);
        $result = $doc->getElementsByTagName("result"); $array = array();
        foreach($result as $row){
            $taghoten = $row->getElementsByTagName("name");
            $hoten = $taghoten->item(0)->nodeValue;
            $tagthoigian = $row->getElementsByTagName("time");
            $thoigian = $tagthoigian->item(0)->nodeValue;
            $taganchinh = $row->getElementsByTagName("anchinh");
            $anchinh = $taganchinh->item(0)->nodeValue;
            $tagcoduong = $row->getElementsByTagName("coduong");
            $coduong = $tagcoduong->item(0)->nodeValue;
            $tagkhongduong = $row->getElementsByTagName("khongduong");
            $khongduong = $tagkhongduong->item(0)->nodeValue;
            $array[] = array('name' => $hoten, 'time' => $thoigian, 'anchinh' => $anchinh,
                                'coduong' => $coduong, 'khongduong' => $khongduong);
        }
        $jsonObj = $array;
        $this->view->jsonObj = $jsonObj;
        $this->view->render('nuoiduong/view_history');
    }

    function baocao(){
        require 'layouts/header.php';
        $this->view->render('nuoiduong/baocao');
        require 'layouts/footer.php';
    }

    function content(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $namhoc = $_REQUEST['namhocid']; $lophoc = $_REQUEST['lophoc'];
        $thoigian = $_REQUEST['thoigian'];
        $hocsinh = $this->model->get_all_hocsinh($truonghocid, $namhoc, $lophoc);
        $this->view->hocsinh = $hocsinh;
        $this->view->render("nuoiduong/content");
    }

    function export(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $namhoc = $_REQUEST['namhocid']; $lophoc = $_REQUEST['lophoc'];
        $thoigian = $_REQUEST['thoigian'];
        $list = array(); $thoigian = explode("-", $thoigian);
        $month = $thoigian[0]; $year = $thoigian[1];
        $startdate = "01-".$month."-".$year;
        $starttime = strtotime($startdate);
        $endtime = strtotime("+1 month", $starttime);
        for($i = $starttime; $i < $endtime; $i += 86400){
            $list[] = date("d", $i);
        }
        if(count($list) == 28){
            $gopcot = 30;
        }elseif(count($list) == 29){
            $gopcot = 31;
        }elseif(count($list) == 30){
            $gopcot = 32;
        }elseif(count($list) == 31){
            $gopcot = 33;
        }

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);
        //$namhoc = $this->_Data->get_title_nam_hoc_by_id($year);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'TỔNG HỢP ĐIỂM DANH HỌC SINH THÁNG '.$month.' NĂM '.$year);
		$sheet->mergeCellsByColumnAndRow ( 0, 3, $gopcot, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', $this->_Data->get_title_lophoc($lophoc));
		$sheet->mergeCellsByColumnAndRow ( 0, 4, $gopcot, 4);
		$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 6;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 20 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'J' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'K' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'L' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'M' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'N' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'O' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'P' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'Q' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'R' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'S' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'T' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'U' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'V' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'W' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'X' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'Y' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'Z' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AA' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AB' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AC' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AD' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AE' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AF' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AG' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'AH' )->setWidth ( 5 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('6')->setRowHeight(20);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Họ và tên', $colIndex );
        foreach ($list as $key => $value) {
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $value, $colIndex );
        }
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tổng', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_all_hocsinh($truonghocid, $namhoc, $lophoc);
        $i = 0;
        foreach($jsonObj as $rows){
            $i++; $tonghocsinh[$rows['id']] = 0;
            $rowIndex += 1;
            $colIndex = $colStart;
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['fullname'], $colIndex );
            foreach ($list as $key => $value) {
                $diemdanh = $this->_Data->get_diem_danh_hocsinh($truonghocid, $rows['id'], $year.'-'.$month.'-'.$value, $lophoc);
                $stick = ($diemdanh == 0) ? '' : 'x'; $tonghocsinh[$rows['id']] = $tonghocsinh[$rows['id']] + $diemdanh;
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $stick, $colIndex );
            }
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $tonghocsinh[$rows['id']], $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'C' . $rowIndex, 'AH' . $rowIndex );
        }
        // tong cuoi
        $rowIndex += 1; $colIndex = $colStart;
        $sheet->getRowDimension($rowIndex)->setRowHeight(20);
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tổng', $colIndex );
        // tong cua ca lop trong ngay
        $helpExport->setStyle_12_TNR_N_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        if(count($list) == 28){
            $border = 'AE';
        }elseif(count($list) == 29){
            $border = 'AF';
        }elseif(count($list) == 30){
            $border = 'AG';
        }elseif(count($list) == 31){
            $border = 'AH';
        }
		$sheet->getStyle ( 'A' . $rowStart . ':' . $border . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . $border . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Tong_hop_bao_an_'.$month.'_'.$year.'_'.$this->_Convert->vn2latin($this->_Data->get_title_lophoc($lophoc), true).'.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }
}
?>
