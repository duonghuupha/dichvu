<?php
class Baocaothietbi extends Controller{
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

        $tongthietbi = $this->model->get_total_taisan($this->_Info[0]['truonghoc_id']);
        $this->view->tongthietbi = $tongthietbi;

        $tongcongcu = $this->model->get_total_congcu($this->_Info[0]['truonghoc_id']);
        $this->view->tongcongcu = $tongcongcu;

        $this->view->render('baocaothietbi/index');
        require 'layouts/footer.php';
    }

    function sothietbitonghop(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_thietbi_tonghop($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaothietbi/sothietbitonghop');
    }

    function export_thietbi_tonghop(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'SỔ TỔNG HỢP THIẾT BỊ');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 9, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );

		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'J' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã TB', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tên thiết bị', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Năm sử dụng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nguyên giá', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Khấu hao (%)', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giá trị còn lại', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Số  lượng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Xuất sứ', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_thietbi_tonghop_export($this->_Info[0]['truonghoc_id']);
        $i = 0;
        foreach($jsonObj as $rows){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            if($rows['cate_id'] != 0){
                $danhmuc = $rows['danhmuc'];
            }else{
                if($rows['nguyen_gia'] >= 10000000){
                    $danhmuc = "Tài sản cố định";
                }else{
                    $danhmuc = "Công cụ dụng cụ";
                }
            }
            $thoigian = date("Y") - $rows['nam_su_dung'];
            $khauhao = $thoigian*$rows['khau_hao'];
            $conlai =  number_format($rows['nguyen_gia'] - ($rows['nguyen_gia'] * ($khauhao/100)));
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['code'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['title'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $danhmuc, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['nam_su_dung'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, number_format($rows['nguyen_gia']), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['khau_hao'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $conlai, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['so_luong'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['xuat_su'], $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'G' . $rowIndex, 'G' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'I' . $rowIndex, 'I' . $rowIndex );
            $helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
            $helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'J' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'J' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="So_thiet_bi_tong_hop.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

    function socongcutonghop(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_congcu_tonghop($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaothietbi/socongcutonghop');
    }

    function export_congcu_tonghop(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'SỔ TỔNG HỢP CÔNG CỤ DỤNG CỤ');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 9, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );

		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'J' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã TB', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tên thiết bị', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Năm sử dụng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nguyên giá', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Khấu hao (%)', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giá trị còn lại', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Số  lượng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Xuất sứ', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_congcu_tonghop_export($this->_Info[0]['truonghoc_id']);
        $i = 0;
        foreach($jsonObj as $rows){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            if($rows['cate_id'] != 0){
                $danhmuc = $rows['danhmuc'];
            }else{
                if($rows['nguyen_gia'] >= 10000000){
                    $danhmuc = "Tài sản cố định";
                }else{
                    $danhmuc = "Công cụ dụng cụ";
                }
            }
            $thoigian = date("Y") - $rows['nam_su_dung'];
            $khauhao = $thoigian*$rows['khau_hao'];
            $conlai =  number_format($rows['nguyen_gia'] - ($rows['nguyen_gia'] * ($khauhao/100)));
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['code'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['title'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $danhmuc, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['nam_su_dung'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, number_format($rows['nguyen_gia']), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['khau_hao'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $conlai, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['so_luong'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $rows['xuat_su'], $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'G' . $rowIndex, 'G' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'I' . $rowIndex, 'I' . $rowIndex );
            $helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
            $helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'J' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'J' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="So_cong_cu_tong_hop.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

    function sothietbichitiet(){
        $rows = 7;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_all_phongban($this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaothietbi/sothietbichitiet');
    }

    function export_thietbi_chitiet(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'SỔ CHI TIẾT PHÂN BỔ THIẾT BỊ');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 8, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );

		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã TB', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tên thiết bị', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Năm sử dụng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nguyên giá', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Khấu hao (%)', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giá trị còn lại', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Xuất sứ', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_all_phongban_export($this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $i = 0;
        foreach ($jsonObj as $row) {
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['title_physic'].' :: '.$row['title_virtual'], $colIndex );
            $sheet->mergeCellsByColumnAndRow(1, $rowIndex, 8, $rowIndex);
            $helpExport->setStyle_12_TNR_B_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
            $detail[$i] = $this->_Data->get_thietbi_phanbo_phongban($row['id'], 1);
            if(count($detail[$i]) > 0){
                $z[$i] = 0;
                foreach ($detail[$i] as $item) {
                    $z[$i]++;
                    if($item['cateid'] != 0){
                        $danhmuc = $item['danhmuc'];
                    }else{
                        if($item['nguyengia'] >= 10000000){
                            $danhmuc = "Tài sản cố định";
                        }else{
                            $danhmuc = "Công cụ dụng cụ";
                        }
                    }
                    $thoigian = date("Y") - $item['namsudung'];
                    $khauhao = $thoigian*$item['khauhao'];
                    $conlai =  number_format($item['nguyengia'] - ($item['nguyengia'] * ($khauhao/100)));
                    $rowIndex += 1;
                    $colIndex = $colStart;
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $z[$i], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['mathietbi'].'-'.$item['so_con'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['title'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $danhmuc, $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['namsudung'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, number_format($item['nguyengia']), $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['khauhao'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $conlai, $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['xuatsu'], $colIndex );
                    $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'G' . $rowIndex, 'G' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'I' . $rowIndex, 'I' . $rowIndex );
                    $helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
                    $helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
                }
            }else{
                $rowIndex += 1;
                $colIndex = $colStart;
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Phòng ban / Lớp học chưa được phân bổ thiết bị', $colIndex );
                $sheet->mergeCellsByColumnAndRow(0, $rowIndex, 8, $rowIndex);
                $helpExport->setStyle_12_TNR_I_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            }
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="So_thiet_bi_chi_tiet.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

    function socongcuchitiet(){
        $rows = 7;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_all_phongban($this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaothietbi/socongcuchitiet');
    }

    function export_congcu_chitiet(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'SỔ CHI TIẾT PHÂN BỔ CÔNG CỤ');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 8, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );

		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã TB', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tên thiết bị', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Năm sử dụng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nguyên giá', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Khấu hao (%)', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giá trị còn lại', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Xuất sứ', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_all_phongban_export($this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $i = 0;
        foreach ($jsonObj as $row) {
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['title_physic'].' :: '.$row['title_virtual'], $colIndex );
            $sheet->mergeCellsByColumnAndRow(1, $rowIndex, 8, $rowIndex);
            $helpExport->setStyle_12_TNR_B_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
            $detail[$i] = $this->_Data->get_thietbi_phanbo_phongban($row['id'], 2);
            if(count($detail[$i]) > 0){
                $z[$i] = 0;
                foreach ($detail[$i] as $item) {
                    $z[$i]++;
                    if($item['cateid'] != 0){
                        $danhmuc = $item['danhmuc'];
                    }else{
                        if($item['nguyengia'] >= 10000000){
                            $danhmuc = "Tài sản cố định";
                        }else{
                            $danhmuc = "Công cụ dụng cụ";
                        }
                    }
                    $thoigian = date("Y") - $item['namsudung'];
                    $khauhao = $thoigian*$item['khauhao'];
                    $conlai =  number_format($item['nguyengia'] - ($item['nguyengia'] * ($khauhao/100)));
                    $rowIndex += 1;
                    $colIndex = $colStart;
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $z[$i], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['mathietbi'].'-'.$item['so_con'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['title'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $danhmuc, $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['namsudung'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, number_format($item['nguyengia']), $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['khauhao'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $conlai, $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['xuatsu'], $colIndex );
                    $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'G' . $rowIndex, 'G' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'I' . $rowIndex, 'I' . $rowIndex );
                    $helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
                    $helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
                }
            }else{
                $rowIndex += 1;
                $colIndex = $colStart;
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Phòng ban / Lớp học chưa được phân bổ thiết bị', $colIndex );
                $sheet->mergeCellsByColumnAndRow(0, $rowIndex, 8, $rowIndex);
                $helpExport->setStyle_12_TNR_I_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            }
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="So_cong_cu_chi_tiet.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }

    function sotonghop(){
        $rows = 7;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_all_phongban($this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('baocaothietbi/sotonghop');
    }

    function export_tonghop(){
        $helpExport = new User_Excel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel2007" );
		$colIndex = '';
		$rowIndex = 0;

        $objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
        //$objPHPExcel->getActiveSheet()->freezePane('D8');

        $truonghoc = $this->_Data->get_info_truonghoc($this->_Info[0]['truonghoc_id']);

		$sheet->setCellValue ( 'A1', mb_strtoupper($truonghoc[0]['title'], 'UTF-8') );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'A1', 'A1' );
		$sheet->setCellValue ( 'A3', 'SỔ CHI TIẾT PHÂN BỔ TRANG THIẾT BỊ');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 8, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );

		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 13 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 30 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'I' )->setWidth ( 15 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã TB', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tên thiết bị', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Danh mục', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Năm sử dụng', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nguyên giá', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Khấu hao (%)', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Giá trị còn lại', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Xuất sứ', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_all_phongban_export($this->_Info[0]['truonghoc_id'], $this->_Namhoc[0]['id']);
        $i = 0;
        foreach ($jsonObj as $row) {
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['title_physic'].' :: '.$row['title_virtual'], $colIndex );
            $sheet->mergeCellsByColumnAndRow(1, $rowIndex, 8, $rowIndex);
            $helpExport->setStyle_12_TNR_B_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
            $detail[$i] = $this->_Data->get_thietbi_phanbo_phongban($row['id'], 3);
            if(count($detail[$i]) > 0){
                $z[$i] = 0;
                foreach ($detail[$i] as $item) {
                    $z[$i]++;
                    if($item['cateid'] != 0){
                        $danhmuc = $item['danhmuc'];
                    }else{
                        if($item['nguyengia'] >= 10000000){
                            $danhmuc = "Tài sản cố định";
                        }else{
                            $danhmuc = "Công cụ dụng cụ";
                        }
                    }
                    $thoigian = date("Y") - $item['namsudung'];
                    $khauhao = $thoigian*$item['khauhao'];
                    $conlai =  number_format($item['nguyengia'] - ($item['nguyengia'] * ($khauhao/100)));
                    $rowIndex += 1;
                    $colIndex = $colStart;
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $z[$i], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['mathietbi'].'-'.$item['so_con'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['title'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $danhmuc, $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['namsudung'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, number_format($item['nguyengia']), $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['khauhao'], $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $conlai, $colIndex );
                    $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $item['xuatsu'], $colIndex );
                    $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'B' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'G' . $rowIndex, 'G' . $rowIndex );
                    $helpExport->setStyle_Align_Center ( $sheet, 'I' . $rowIndex, 'I' . $rowIndex );
                    $helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
                    $helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
                }
            }else{
                $rowIndex += 1;
                $colIndex = $colStart;
                $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Phòng ban / Lớp học chưa được phân bổ thiết bị', $colIndex );
                $sheet->mergeCellsByColumnAndRow(0, $rowIndex, 8, $rowIndex);
                $helpExport->setStyle_12_TNR_I_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            }
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="So_tong_hop.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }
}
?>
