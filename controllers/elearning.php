<?php
class Elearning extends Controller{
    private $_Info;
    private $_Convert;
    private $_Data;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
        $this->_Data = new Model();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('elearning/index');
        require 'layouts/footer.php';
    }

    function content(){
        $rows = 15;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows; $url = explode("/", $_SESSION['url']);
        $userid = ($this->_Convert->check_roles_user($this->_Info[0]['id'], $url[0], 8)) ? 0 : $this->_Info[0]['id'];
        $jsonObj = $this->model->getFetObj($keyword, $this->_Info[0]['truonghoc_id'], $userid, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('elearning/content');
    }

    function add(){
        $truonghocid = $this->_Info[0]['truonghoc_id']; $linhvuc = $_REQUEST['linh_vuc'];
        $detai = $_REQUEST['de_tai']; $ise = isset($_REQUEST['is_e']) ? 1 : 0;
        $file = $_FILES['file']['name']; $examid = $_REQUEST['exam_id'];
        // kiem tra ngay thang cua exam
        $exam = $this->model->get_info_exam($examid); $elearn = $this->model->get_total_e($examid, $this->_Info[0]['id']);
        if(date("Y-m-d") >= $exam[0]['date_start'] && date("Y-m-d") <= $exam[0]['date_end']){
            if($exam[0]['so_luong'] == $elearn){
                $jsonObj['msg'] = "Bạn đã cập nhật tài nguyên cho nhóm dữ liệu này";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array("truonghoc_id" => $truonghocid, 'exam_id' => $examid, 'user_id' => $this->_Info[0]['id'],
                                'linh_vuc' => $linhvuc, 'de_tai' => $detai, 'is_e' => $ise, 'file' => $file,
                                'create_at' => date("Y-m-d H:i:s"));
                $temp = $this->model->addObj($data);
                if($temp){
                    // tao folder luu file
                    $dirname_e = DIR_UPLOAD.'/elearning/'.$this->_Info[0]['truonghoc_id'].'/'.$examid.'/'.$this->_Info[0]['id'];
                    if(!file_exists($dirname_e)){
                        @mkdir($dirname_e, 0777);
                    }
                    if($ise == 1){
                        // giai nen file duwx lieu
                        if($this->_Convert->unzip_file($_FILES['file']['tmp_name'], $dirname_e.'/')){
                            $jsonObj['msg'] = "Tạo tài nguyên thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }else{
                            $jsonObj['msg'] = "Tải file không thành công";
                            $jsonObj['success'] = false;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }else{
                        if(move_uploaded_file($_FILES['file']['tmp_name'], $dirname_e.'/'.$file)){
                            $jsonObj['msg'] = "Tạo tài nguyên thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }else{
                            $jsonObj['msg'] = "Tải file không thành công";
                            $jsonObj['success'] = false;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }
                }else{
                    $jsonObj['msg'] = "Tạo tài nguyên không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{
            $jsonObj['msg'] = "Chưa đến thời gian cập nhật tài nguyên";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("elearning/add");
    }

    function update(){
        $id = $_REQUEST['id']; $examid = $_REQUEST['exam_id'];
        $linhvuc = $_REQUEST['linh_vuc']; $detai = $_REQUEST['de_tai'];
        // kiem tra ngay thang cua exam
        $exam = $this->model->get_info_exam($examid);
        if(date("Y-m-d") >= $exam[0]['date_start'] && date("Y-m-d") <= $exam[0]['date_end']){
            if($this->model->dupliObj($id, $examid, $this->_Info[0]['id']) > 0){
                $jsonObj['msg'] = "Bạn đã cập nhật tài nguyên cho nhóm dữ liệu này";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array('exam_id' => $examid, 'linh_vuc' => $linhvuc, 'de_tai' => $detai,
                                'create_at' => date("Y-m-d H:i:s"));
                $temp = $this->model->updateObj($id, $data);
                if($temp){
                    $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{
            $jsonObj['msg'] = "Chưa đến thời gian cập nhật tài nguyên";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("elearning/update");
    }

    function update_file(){
        $id = $_REQUEST['id_e'];
        $ise = isset($_REQUEST['is_elearning']) ? 1 : 0;
        $file = $_FILES['file_e']['name'];
        $detail = $this->model->get_detail($id);
        // kiem tra ngay thang cua exam
        $exam = $this->model->get_info_exam($detail[0]['exam_id']);
        if(date("Y-m-d") >= $exam[0]['date_start'] && date("Y-m-d") <= $exam[0]['date_end']){
            $data = array('is_e' => $ise, 'file' => $file, 'create_at' => date("Y-m-d H:i:s"));
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                // xoa folder chua du lieu
                $dir_e = DIR_UPLOAD.'/elearning/'.$this->_Info[0]['truonghoc_id'].'/'.$detail[0]['exam_id'].'/'.$detail[0]['user_id'];
                if(file_exists($dir_e)){
                    //array_map('unlink', glob("$dir_e/*.*")); rmdir($dir_e);
                    $this->_Convert->delete_files($dir_e);
                }
                // day du leu moi vao
                $dirname_e = DIR_UPLOAD.'/elearning/'.$this->_Info[0]['truonghoc_id'].'/'.$detail[0]['exam_id'].'/'.$detail[0]['user_id'];
                if(!file_exists($dirname_e)){
                    @mkdir($dirname_e, 0777);
                }
                if($ise == 1){
                    // giai nen file duwx lieu
                    if($this->_Convert->unzip_file($_FILES['file_e']['tmp_name'], $dirname_e.'/')){
                        $jsonObj['msg'] = "Tạo tài nguyên thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Tải file không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    if(move_uploaded_file($_FILES['file_e']['tmp_name'], $dirname_e.'/'.$file)){
                        $jsonObj['msg'] = "Tạo tài nguyên thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Tải file không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Chưa đến thời gian cập nhật tài nguyên";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("elearning/update_file");
    }

    function del(){
        $id = $_REQUEST['id'];
        $detail = $this->model->get_detail($id);
        $exam = $this->model->get_info_exam($detail[0]['exam_id']);
        if(date("Y-m-d") >= $exam[0]['date_start'] && date("Y-m-d") <= $exam[0]['date_end']){
            $temp = $this->model->delObj($id);
            if($temp){
                // xoa folder cua user trong exam
                $dir_e = DIR_UPLOAD.'/elearning/'.$this->_Info[0]['truonghoc_id'].'/'.$detail[0]['exam_id'].'/'.$detail[0]['user_id'];
                if(file_exists($dir_e)){
                    //array_map('unlink', glob("$dir_e/*.*")); rmdir($dir_e);
                    $this->_Convert->delete_files($dir_e);
                }
                $jsonObj['msg'] = "Xóa dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Xóa dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Chưa đến thời gian cập nhật tài nguyên";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("elearning/del");
    }

    function change(){
        $id = $_REQUEST['id'];
        $data = array("publish" => 1);
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
        $this->view->render("elearning/change");
    }

    function export_xls(){
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
		$sheet->setCellValue ( 'A3', 'THỐNG KÊ TÀI NGUYÊN');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 6, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        //$sheet->setCellValue ( 'A4', 'Từ ngày '.$_REQUEST['tungay'].' đến ngày '.$_REQUEST['denngay'] );
		//$sheet->mergeCellsByColumnAndRow ( 0, 4, 6, 4 );
		//$helpExport->setStyle_12_TNR_I_C ( $sheet, 'A4', 'A4' );

		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		// BEGIN set width for column
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 25 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 20 );
        $sheet->getColumnDimension ( 'D' )->setWidth ( 25 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 15 );
        $sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'G' )->setWidth ( 10 );
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Nhóm dữ liệu', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Lĩnh vực', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Đề tài', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Cập nhật lần cuối', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tác giả', $colIndex );
        $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Trạng thái', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $keyword = isset($_REQUEST['linhvuc']) ? str_replace("$", " ", $_REQUEST['linhvuc']) : '';
        $url = explode("/", $_SESSION['url']); $examid = $_REQUEST['examid'];
        $user = ($_REQUEST['userid'] != '') ? base64_decode($_REQUEST['userid']) : '';
        $userid = ($this->_Convert->check_roles_user($this->_Info[0]['id'], $url[0], 8)) ? 0 : $this->_Info[0]['id'];

        $jsonObj = $this->model->get_export($keyword, $this->_Info[0]['truonghoc_id'], $userid, $user, $examid);
        $i = 0;
        foreach($jsonObj as $row){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            $status = ($row['publish'] == 0) ? 'Không công khai' : 'Công khai';
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['exam'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['linh_vuc'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['de_tai'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, date("H:i:s \n d-m-Y", strtotime($row['create_at'])), $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['tacgia'], $colIndex );
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
		header ( 'Content-Disposition: attachment;filename="Thong_ke_tai_nguyen.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }
}
?>
