<?php
class Nguoidung extends Controller{
    private $_Convert;
    private $_Info;
    private $_Data;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Convert = new Convert();
        $this->_Info = $_SESSION['data'];
        $this->_Data = new Model();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('nguoidung/index');
        require 'layouts/footer.php';
    }

    function content(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('nguoidung/content');
    }

    function formadd(){
        require 'layouts/header.php';
        $this->view->render('nguoidung/formadd');
        require 'layouts/footer.php';
    }

    function add(){
        $truonghocid = isset($_REQUEST['truonghoc_id']) ? $_REQUEST['truonghoc_id'] : $this->_Info[0]['truonghoc_id'];
        $username = $_REQUEST['username']; $job = $_REQUEST['job'];
        $password = $_REQUEST['password']; $repass = $_REQUEST['repass'];
        $avatar = ($_FILES['image_avatar']['name'] != '') ? $this->_Convert->convert_img($_FILES['image_avatar']['name'], $this->_Convert->vn2latin($username, true)) : '';
        $fullname = $_REQUEST['fullname']; $active = (isset($_REQUEST['active'])) ? 1 : 0;
        $isboss = ($this->_Info[0]['truonghoc_id'] != 0) ? 0 : 1; $cccd = $_REQUEST['cccd'];
        if($password != $repass){
            $jsonObj['msg'] = "Xác nhận mật khẩu không chính xác";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            if($this->model->dupliObj($truonghocid, 0, $username) > 0){
                $jsonObj['msg'] = "Tên đăng nhập đã tồn tại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array('username' => $username, 'password' => sha1($password), 'truonghoc_id' => $truonghocid,
                            'fullname' => $fullname, 'avatar' => $avatar, 'roles' => '', 'active' => $active,
                            'is_boss' => $isboss, 'job' => $job, 'cccd' => $cccd);
                $temp = $this->model->addObj($data);
                if($temp){
                    if($avatar != ''){
                        move_uploaded_file($_FILES['image_avatar']['tmp_name'], DIR_UPLOAD.'/truonghoc/avatar/'.$avatar);
                    }
                    $jsonObj['msg'] = "Cập nhật dư liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dư liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }
        $this->view->render("nguoidung/add");
    }

    function formedit(){
    	require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_detail($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('nguoidung/formedit');
        require 'layouts/footer.php';
    }

    function update(){
        $id = $_REQUEST['id'];
        $avatar = ($_FILES['image_avatar']['name'] != '') ? $this->_Convert->convert_img($_FILES['image_avatar']['name'], $this->_Convert->vn2latin($username, true)) : '';
        $fullname = $_REQUEST['fullname']; $job = $_REQUEST['job']; $cccd = $_REQUEST['cccd'];
        $data = array('fullname' => $fullname, 'avatar' => $avatar, 'job' => $job, 'cccd' => $cccd);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            if($avatar != ''){
                move_uploaded_file($_FILES['image_avatar']['tmp_name'], DIR_UPLOAD.'/truonghoc/avatar/'.$avatar);
            }
            $jsonObj['msg'] = "Cập nhật dư liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dư liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("nguoidung/update");
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
        $this->view->render("nguoidung/del");
    }

    function phanquyen(){
        require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_detail($id);
        $this->view->jsonObj = $jsonObj;
        $dichvu = $this->model->get_dichvu_sudung($jsonObj[0]['truonghoc_id']);
        $this->view->dichvu = $dichvu;
        $this->view->render('nguoidung/phanquyen');
        require 'layouts/footer.php';
    }

    function update_roles(){
        $id = $_REQUEST['id'];
        $roles = implode(",", $_REQUEST['roles']);
        $data = array("roles" => $roles);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            if(isset($_REQUEST['chucnang'])){
                $this->model->delObj_chucnang($id);
                foreach ($_REQUEST['chucnang'] as $row) {
                    $array = explode(".", $row);
                    $data_cn = array("user_id" => $id, 'roles_id' => $array[0], 'chuc_nang' => $array[1]);
                    $this->model->addObj_chucnang($data_cn);
                }
            }
            $jsonObj['msg'] = "Cập nhật quyền thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật quyền không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("nguoidung/update_roles");
    }

    function repass(){
        $id = $_REQUEST['id'];
        $data = array("password" => sha1("abcd1234"));
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $detail = $this->model->get_detail($id);
            $jsonObj['msg'] = "Reset mật khẩu thành công";
            $jsonObj['success'] = true;
            $jsonObj['noti'] = "Tài khoản <b>".$detail[0]['username']."</b> đã được cập nhật về mật khẩu là: <b>abcd1234</b>";
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Reset mật khẩu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("nguoidung/repass");
    }

    function info_tk(){
        $id = $_REQUEST['id'];
        $detail = $this->model->get_detail($id);
        if(count($detail) > 0){
            $jsonObj['msg'] = "Thành công";
            $jsonObj['fullname'] = $detail[0]['fullname'];
            $jsonObj['nhiemvu'] = $detail[0]['job'];
            $jsonObj['avatar'] = $detail[0]['avatar'];
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Lỗi tải dữ liệu tài khoản";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("nguoidung/info_tk");
    }

    function update_tk(){
        $id = $_REQUEST['id_tk']; $fullname = $_REQUEST['ten_hien_thi'];
        $nhiemvu = $_REQUEST['nhiem_vu'];
        $avatar = ($_FILES['avatar']['name'] != '') ? $this->_Convert->convert_img($_FILES['avatar']['name'], $this->_Convert->vn2latin($username, true)) : $_REQUEST['avatarold'];
        $pass = $_REQUEST['mat_khau']; $repass = $_REQUEST['re_mat_khau'];
        if($pass != ''){
            if($pass != $repass){
                $jsonObj['msg'] = "Xác nhận mật khẩu không chính xác";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array("fullname" => $fullname, 'job' => $nhiemvu, 'avatar' => $avatar,
                                "password" => sha1($pass));
                $temp = $this->model->updateObj($id, $data);
                if($temp){
                    if($avatar != ''){
                        move_uploaded_file($_FILES['avatar']['tmp_name'], DIR_UPLOAD.'/truonghoc/avatar/'.$avatar);
                    }
                    $jsonObj['msg'] = "Cập nhật dư liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dư liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{
            $data = array("fullname" => $fullname, 'job' => $nhiemvu, 'avatar' => $avatar);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($avatar != ''){
                    move_uploaded_file($_FILES['avatar']['tmp_name'], DIR_UPLOAD.'/truonghoc/avatar/'.$avatar);
                }
                $jsonObj['msg'] = "Cập nhật dư liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dư liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("nguoidung/update");
    }

    function copyroles(){
        require 'layouts/header.php';
        $this->view->render('nguoidung/copyroles');
        require 'layouts/footer.php';
    }

    function list_nguoidung_copy(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_nguoidung_copy($this->_Info[0]['truonghoc_id'], $id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('nguoidung/list_nguoidung_copy');
    }

    function quyennguoidung(){
        $id = $_REQUEST['id'];
        $roles  = $this->model->get_roles($id);
        $this->view->roles  = $roles;
        $this->view->render('nguoidung/quyennguoidung');
    }

    function do_copy(){
        $datadc = base64_decode($_REQUEST['datadc']);
        $datadc = explode(",", $datadc);
        $userid = $_REQUEST['user_id'];
        // lay toan bo roles cuuar user muon copy
        $roles = $this->model->get_roles($userid);
        foreach ($roles as $key => $value) {
            $arr[] = $value['id'];
        }
        $chucnang = $this->model->get_all_chuc_nang_of_user($userid);
        $data = array("roles" => implode(",", $arr));
        foreach ($datadc as $row) {
            $temp = $this->model->updateObj($row, $data);
            if($temp){
                $this->model->delObj_chucnang($row);
                foreach ($chucnang as $item) {
                    $data_roles = array('user_id' => $row, "roles_id" => $item['roles_id'], 'chuc_nang' =>  $item['chuc_nang']);
                    $this->model->addObj_chucnang($data_roles);
                }
            }
        }
        $jsonObj['msg'] = "Copy dữ liệu thành công";
        $jsonObj['success'] = true;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("nguoidung/do_copy");
    }

    function export(){
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
		$sheet->setCellValue ( 'A3', 'DANH SÁCH TÀI KHOẢN');
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 3, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
        $sheet->setCellValue ( 'A4', 'Mật khẩu ban đầu là: abcd1234' );
		$sheet->mergeCellsByColumnAndRow ( 0, 4, 3, 4 );
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
        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('6')->setRowHeight(25);
		// END set width for column
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Họ và tên', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Phân công/nnhiệm vụ', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tên đăng nhập', $colIndex );
        $helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );

        $jsonObj = $this->model->get_export($this->_Info[0]['truonghoc_id']);
        $i = 0;
        foreach($jsonObj as $row){
            $i++;
            $rowIndex += 1;
            $colIndex = $colStart;
            //$objPHPExcel->getActiveSheet()->getStyle($colIndex.$rowIndex.':'.$colIndex.$rowIndex)->getAlignment()->setWrapText(true);
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $i, $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['fullname'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['job'], $colIndex );
            $colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row['username'], $colIndex );
            $helpExport->setStyle_12_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
            $helpExport->setStyle_Align_Center ( $sheet, 'C' . $rowIndex, 'D' . $rowIndex );
        }

		$sheet->getStyle ( 'A' . $rowStart . ':' . 'D' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'D' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );

        ////set dinh dang giay a5 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
        $pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( 0.05 );
		$pageMargin->setRight ( 0.05 );


        header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Danh_sach_tai_khoan.xlsx"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->save ( 'php://output' );
    }
}
?>
