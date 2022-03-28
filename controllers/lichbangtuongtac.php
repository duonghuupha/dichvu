<?php
class Lichbangtuongtac extends Controller{
    private $_Info; private $_Namhoc; private $_Convert; private $_Data;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Namhoc = $_SESSION['namhoc'];
        $this->_Convert = new Convert();
        $this->_Data = new Model();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('lichbangtuongtac/index');
        require 'layouts/footer.php';
    }

    function content(){
        $this->view->render('lichbangtuongtac/content');
    }

    function detail(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_detail($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('lichbangtuongtac/detail');
    }

    function info(){
        $id = $_REQUEST['id'];
        $detail = $this->model->get_detail($id);
        if(count($detail) > 0){
            $jsonObj['msg'] = "Load dữ liệu thành công";
            $jsonObj['success'] = true;
            $jsonObj['ngayhoc'] = date("d-m-Y", strtotime($detail[0]['ngay_hoc']));
            $jsonObj['timeid'] = $detail[0]['time_id'];
            $jsonObj['title'] = $detail[0]['title'];
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Không tồn tại dữ liệu";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('lichbangtuongtac/info');
    }

    function add(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $userid = $this->_Info[0]['id'];
        $ngayhoc = $this->_Convert->convertDate($_REQUEST['ngay_hoc']);
        $timeid = $_REQUEST['time_id'];
        $title = $_REQUEST['title'];
        $createat = date("Y-m-d H:i:s");
        $createid = $this->_Info[0]['id'];
        $khunggio = $this->model->get_detail_khunggio($timeid);
        $batdau = $khunggio[0]['bat_dau']; $ketthuc = $khunggio[0]['ket_thuc'];
        if($this->model->dupliObj(0, $ngayhoc, $timeid) > 0){
            $jsonObj['msg'] = 'Tại khung giờ : '.$batdau.' - '.$ketthuc.'  ngày '.$_REQUEST['ngay_hoc'].' đã được đăng ký. Bạn không thể đăng ký cho khung giờ này';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('truonghoc_id' => $truonghocid, 'user_id' => $userid, 'ngay_hoc' => $ngayhoc,
                        'bat_dau' => $batdau, 'ket_thuc' => $ketthuc, 'time_id' => $timeid, 'title' => $title,
                        'create_at' => $createat, 'create_id' => $createid);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = 'Thêm mới dữ liệu thành công';
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = 'Thêm mới dữ liệu không thành công';
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("lichbangtuongtac/add");
    }

    function update(){
        $id = $_REQUEST['id_tuongtac'];
        $ngayhoc = $this->_Convert->convertDate($_REQUEST['ngay_hoc']);
        $timeid = $_REQUEST['time_id'];
        $title = $_REQUEST['title'];
        $khunggio = $this->model->get_detail_khunggio($timeid);
        $batdau = $khunggio[0]['bat_dau']; $ketthuc = $khunggio[0]['ket_thuc'];
        if($this->model->dupliObj($id, $ngayhoc, $timeid) > 0){
            $jsonObj['msg'] = 'Tại khung giờ : '.$batdau.' - '.$ketthuc.'  ngày '.$_REQUEST['ngay_hoc'].' đã được đăng ký. Bạn không thể đăng ký cho khung giờ này';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('ngay_hoc' => $ngayhoc,'bat_dau' => $batdau, 'ket_thuc' => $ketthuc, 'time_id' => $timeid,
                        'title' => $title);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("lichbangtuongtac/update");
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['Xóa dữ liệu không thành công'];
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('lichbangtuongtac/del');
    }

    function baocao(){
        require 'layouts/header.php';
        $this->view->render('lichbangtuongtac/baocao');
        require 'layouts/footer.php';
    }

    function contentbc(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows; $date = $_REQUEST['nam'].'-'.$_REQUEST['thang'];
        $jsonObj = $this->model->get_info_baocao($this->_Info[0]['truonghoc_id'], $date, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render("lichbangtuongtac/contentbc");
    }

    function export(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;
        $date = $_REQUEST['nam'].'-'.$_REQUEST['thang'];

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'THỐNG KÊ BẢNG TƯƠNG TÁC');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 5, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', 'Tháng '.$_REQUEST['thang'].' năm '.$_REQUEST['nam']);
		$sheet->mergeCellsByColumnAndRow ( 0, 4, 5, 4);
		$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 6;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 20 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 30 );
        $sheet->getRowDimension('3')->setRowHeight(30);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
        $sheet->mergeCellsByColumnAndRow(0, $rowIndex, 0, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giáo viên', $colIndex );
        $sheet->mergeCellsByColumnAndRow(1, $rowIndex, 1, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày dạy', $colIndex );
        $sheet->mergeCellsByColumnAndRow(2, $rowIndex, 2, ($rowIndex + 1));
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Thời gian', 'E' );
        $sheet->mergeCellsByColumnAndRow(3, $rowIndex, 4, $rowIndex);
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nội dung', $colIndex );
        $sheet->mergeCellsByColumnAndRow(5, $rowIndex, 5, ($rowIndex + 1));
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $sheet->setCellValue ( 'D6', 'Bắt đầu' );
		$sheet->setCellValue ( 'E6', 'Kết thúc' );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . ($rowIndex + 1) );

        $rowIndex += 2;
		$colIndex = $colStart;
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '1', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '2', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '3', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '4', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '5', $colIndex );
		$helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '6', $colIndex );
		$helpExport->setStyle_10_TNR_I_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_info_baocao_excel($this->_Info[0]['truonghoc_id'], $date);
        $i = 0;
        foreach($jsonObj as $rows){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['fullname'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("d-m-Y", strtotime($rows['ngay_hoc'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['bat_dau'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['ket_thuc'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['title'], $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'C' . $rowIndex, 'E' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'F' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'F' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Thong_ke_bang_tuong_tac.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }
}
?>
