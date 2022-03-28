<?php
class Baocaoctt extends Controller{
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
        $this->view->render('baocaoctt/index');
        require 'layouts/footer.php';
    }

    function content_baiviet(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $trangthai = $_REQUEST['trangthai']; $tungay = $this->_Convert->convertDate($_REQUEST['tungay']);
        $denngay = $this->_Convert->convertDate($_REQUEST['denngay']);
        $jsonObj = $this->model->get_view_baiviet($this->_Info[0]['truonghoc_id'], $trangthai, $tungay, $denngay, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaoctt/content_baiviet');
    }

    function export_baiviet(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');
        $trangthai = $_REQUEST['trangthai']; $tungay = $this->_Convert->convertDate($_REQUEST['tungay']);
        $denngay = $this->_Convert->convertDate($_REQUEST['denngay']);

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'THỐNG KÊ BÀI VIẾT ĐĂNG CỔNG THÔNG TIN');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 6, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', 'Từ ngày '.$_REQUEST['tungay'].' đến ngày '.$_REQUEST['denngay'] );
		$sheet->mergeCellsByColumnAndRow ( 0, 4, 6, 4 );
		$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 6;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 35 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 20 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('6')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tiêu đề', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Cập nhật lần cuối', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày đăng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Người viết', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Trạng thái', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_export_baiviet($this->_Info[0]['truonghoc_id'], $trangthai, $tungay, $denngay);
        $i = 0;
        foreach($jsonObj as $row){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            if($row['status'] == 0){
                $status = 'Chưa duyệt';
            }elseif($row['status'] == 1){
                $status = 'Đã duyệt';
            }else{
                $status = 'Đã đăng';
            }
            $ngaydang = ($row['create_dang'] != '') ? date("H:i:s \n d-m-Y", strtotime($row['create_dang'])) : '';
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['title'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['danhmuc'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("H:i:s \n d-m-Y", strtotime($row['create_at'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $ngaydang, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['nguoiviet'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $status, $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'C' . $rowIndex, 'G' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'G' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'G' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Thong_ke_bai_viet_dang_ctt.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

    function content_vanban(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $trangthai = $_REQUEST['trangthai']; $tungay = $this->_Convert->convertDate($_REQUEST['tungay']);
        $denngay = $this->_Convert->convertDate($_REQUEST['denngay']);
        $jsonObj = $this->model->get_view_vanban($this->_Info[0]['truonghoc_id'], $trangthai, $tungay, $denngay, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaoctt/content_vanban');
    }

    function export_vanban(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');
        $trangthai = $_REQUEST['trangthai']; $tungay = $this->_Convert->convertDate($_REQUEST['tungay']);
        $denngay = $this->_Convert->convertDate($_REQUEST['denngay']);

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'THỐNG KÊ VĂN BẢN ĐĂNG CỔNG THÔNG TIN');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 7, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', 'Từ ngày '.$_REQUEST['tungay'].' đến ngày '.$_REQUEST['denngay'] );
		$sheet->mergeCellsByColumnAndRow ( 0, 4, 7, 4 );
		$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 6;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
        $sheet->getColumnDimension ( 'B' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'C' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'D' )->setWidth ( 35 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 20 );
        $sheet->getColumnDimension ( 'F' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('6')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Số văn bản', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày văn bản', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tiêu đề', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Cập nhật lần cuối', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày đăng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Người viết', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_export_vanban($this->_Info[0]['truonghoc_id'], $trangthai, $tungay, $denngay);
        $i = 0;
        foreach($jsonObj as $row){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $ngaydang = ($row['create_dang'] != '') ? date("H:i:s \n d-m-Y", strtotime($row['create_dang'])) : 'Chưa đăng';
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['so_vanban'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("d-m-Y", strtotime($row['ngay_vanban'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['tieu_de'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['danhmuc'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("H:i:s \n d-m-Y", strtotime($row['create_at'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $ngaydang, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['nguoiviet'], $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'C' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'E' . $rowIndex, 'H' . $rowIndex );
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
		header ( 'Content-Disposition: attachment;filename="Thong_ke_van_ban_dang_ctt.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

}
?>
