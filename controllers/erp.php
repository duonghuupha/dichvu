<?php
class Erp extends Controller{
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
        $this->view->render('erp/index');
        require 'layouts/footer.php';
    }

    function content(){
        $rows = 15;
        $keyword = isset($_REQUEST['tukhoa']) ? str_replace("$", " ", $_REQUEST['tukhoa']) : '';
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $this->_Info[0]['id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('erp/content');
    }

    function add(){
        $code = time(); $truonghocid = $this->_Info[0]['truonghoc_id']; $userid = $this->_Info[0]['id'];
        $groupid = $_REQUEST['group_id']; $useridtask = $_REQUEST['user_id_task'];
        $userfollow = isset($_REQUEST['user_id_follow']) ? implode(",", $_REQUEST['user_id_follow']) : '';
        $datestart = $this->_Convert->convertDate($_REQUEST['date_start']).' '.$_REQUEST['time_start'];
        $dateend = $this->_Convert->convertDate($_REQUEST['date_end']).' '.$_REQUEST['time_end'];
        $content = $_REQUEST['content']; $uutien = $_REQUEST['uu_tien']; $createat = date("Y-m-d H:i:s");
        // kiem tra thoi gian bat sau va ket thuc
        if($dateend < $datestart){
            $jsonObj['msg'] = "Thời gian bắt đầu không thể nhỏ hơn thời gian kết thúc";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('truonghoc_id' => $truonghocid, 'code' => $code, 'group_id' => $groupid, 'user_id' => $userid,
                        'user_id_task' => $useridtask, 'user_id_follow' =>  $userfollow, 'date_start' => $datestart,
                        'date_end' => $dateend, 'content' => $content, 'uu_tien' => $uutien, 'create_at' => $createat);
            $temp = $this->model->addObj($data);
            if($temp){
                // kiem tra co file tai lieu khong
                if(count($_FILES['file']['name']) > 0){
                    // tao folder luu tai lieu
                    $dirname_erp = DIR_UPLOAD.'/erp/'.$this->_Info[0]['truonghoc_id'].'/'.$code;
                    if(!file_exists($dirname_erp)){
                        mkdir($dirname_erp, 0777);
                    }
                    // bat dau upload file
                    $num = count($_FILES['file']['name']);
                    for ($i = 0; $i < $num; $i++){
                        $tmp = move_uploaded_file($_FILES['file']['tmp_name'][$i], $dirname_erp.'/'.$_FILES['file']['name'][$i]);
                        if($tmp){
                            $data_file = array('code' => $code, 'truonghoc_id' => $truonghocid, 'file' => $_FILES['file']['name'][$i]);
                            $this->model->addObj_File($data_file);
                        }
                    }
                    $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("erp/add");
    }

    function detail(){
        require 'layouts/header.php';
        $id = $_REQUEST['id']; echo $id;
        $detail =  $this->model->get_detail($id);
        if($this->_Info[0]['id'] == $detail[0]['user_id_task'] && $detail[0]['status'] == 0){
            // cap nhat trang thai cong viec
            $data = array('status' => 1);
            $this->model->updateObj($id,  $data);
            // luu ys kien trao doi
            $code = time();
            $data_cm = array("code" =>  $code, 'truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'task_id' => $id,
                            "user_id" => $this->_Info[0]['id'], "content" => "Tiếp nhận công việc", "create_at" => date("Y-m-d H:i:s"));
            $tmp = $this->model->addObj_comment($data_cm);
        }
        $this->view->jsonObj = $detail;
        $this->view->comment = $this->model->get_all_comment_via_date($id);
        $this->view->file = $this->model->get_task_attach($detail[0]['code']);
        $this->view->render('erp/detail');
        require 'layouts/footer.php';
    }

    function add_comment(){
        $code = time(); $idtask = $_REQUEST['id_task']; $truonghocid = $this->_Info[0]['truonghoc_id'];
        $userid  = $this->_Info[0]['id']; $content = $_REQUEST['content']; $create = date("Y-m-d H:i:s");
        $data = array("code" => $code, "truonghoc_id" => $truonghocid, 'task_id' => $idtask, "user_id" => $userid,
                        "content" => $content, 'create_at' => $create);
        $temp = $this->model->addObj_comment($data);
        if($temp){
            // kiem tra co ton ai file dinh kem khong
            if($_FILES['file']['name'] != ''){
                // tao folder luu tai lieu
                $dirname_erp = DIR_UPLOAD.'/erp/'.$this->_Info[0]['truonghoc_id'].'/'.$code;
                if(!file_exists($dirname_erp)){
                    mkdir($dirname_erp, 0777);
                }
                $tmp = move_uploaded_file($_FILES['file']['tmp_name'], $dirname_erp.'/'.$_FILES['file']['name']);
                if($tmp){
                    $data_file = array('code' => $code, 'truonghoc_id' => $truonghocid, 'file' => $_FILES['file']['name']);
                    $this->model->addObj_comment_File($data_file);
                    $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công 1";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/add_comment");
    }

    function change(){
        $type = $_REQUEST['type'];
        if($type == 1){ //  cap nhat tien do
            $id = $_REQUEST['idtask'];  $tiendo = $_REQUEST['tien_do'];
            if($tiendo == 100){
                $data = array("tien_do" => $tiendo, 'status' => 2, 'date_finish' => date("Y-m-d H:i:s"));
            }else{
                $data = array("tien_do" => $tiendo);
            }
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $code = time();
                $data_cm = array("code" =>  $code, 'truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'task_id' => $id,
                                "user_id" => $this->_Info[0]['id'], "content" => "Cập nhật tiến độ công việc", "create_at" => date("Y-m-d H:i:s"));
                $tmp = $this->model->addObj_comment($data_cm);
                if($tmp){
                    // kiem tra xem co ton tai file dinh kem khong
                    if($_FILES['file_result']['name'] != ''){
                        // tao folder luu tai lieu
                        $dirname_erp = DIR_UPLOAD.'/erp/'.$this->_Info[0]['truonghoc_id'].'/'.$code;
                        if(!file_exists($dirname_erp)){
                            mkdir($dirname_erp, 0777);
                        }
                        if(move_uploaded_file($_FILES['file_result']['tmp_name'], $dirname_erp.'/'.$_FILES['file_result']['name'])){
                            $data_file = array('code' => $code, 'truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'file' => $_FILES['file_result']['name']);
                            $this->model->addObj_comment_File($data_file);
                            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }else{
                        $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }elseif($type == 2){ //  duyet chuyen cong viec
            $id = $_REQUEST['id']; // id task
            $status = $_REQUEST['status'];
            $id_change = $this->model->get_id_task_change($id);
            $data = array('status' => $status);
            $temp = $this->model->updateObj_chuyen($id_change, $data);
            if($temp){
                $code = time();
                $content = ($status == 1) ? 'Chấp nhận chuyển công việc' : 'Không chấp nhận chuyển công việc';
                $data_cm = array("code" =>  $code, 'truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'task_id' => $id,
                                "user_id" => $this->_Info[0]['id'], "content" => $content, "create_at" => date("Y-m-d H:i:s"));
                $tmp = $this->model->addObj_comment($data_cm);
                if($tmp){
                    $jsonObj['msg'] = "Cập nhật dữ  liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ  liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Cập nhật dữ  liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Cập nhật dữ  liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/change");
    }

    function info(){
        $id = $_REQUEST['id'];
        $json = $this->model->get_info($id);
        if(count($json) > 0){
            $jsonObj['data'] = $json[0];
            $jsonObj['msg'] = "Load dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Load dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/info");
    }

    function update(){
        $id = $_REQUEST['id_task'];
        $groupid = $_REQUEST['group_id']; $useridtask = $_REQUEST['user_id_task'];
        $userfollow = isset($_REQUEST['user_id_follow']) ? implode(",", $_REQUEST['user_id_follow']) : '';
        $datestart = $this->_Convert->convertDate($_REQUEST['date_start']).' '.$_REQUEST['time_start'];
        $dateend = $this->_Convert->convertDate($_REQUEST['date_end']).' '.$_REQUEST['time_end'];
        $content = $_REQUEST['content']; $uutien = $_REQUEST['uu_tien']; $createat = date("Y-m-d H:i:s");
        // kiem tra thoi gian bat sau va ket thuc
        if($dateend < $datestart){
            $jsonObj['msg'] = "Thời gian bắt đầu không thể nhỏ hơn thời gian kết thúc";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('group_id' => $groupid, 'user_id_task' => $useridtask, 'user_id_follow' =>  $userfollow,
                        'date_start' => $datestart, 'date_end' => $dateend, 'content' => $content, 'uu_tien' => $uutien);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $code = time();
                $data_cm = array("code" =>  $code, 'truonghoc_id' => $this->_Info[0]['truonghoc_id'], 'task_id' => $id,
                                "user_id" => $this->_Info[0]['id'], "content" => "Cập nhật nội dung công việc",
                                "create_at" => date("Y-m-d H:i:s"));
                $tmp = $this->model->addObj_comment($data_cm);
                if($tmp){
                    $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("erp/update");
    }

    function del(){
        $id = $_REQUEST['id'];
        // get code task
        $code = $this->model->get_code_task($id);
        // get all code comment task
        $code_cm = $this->model->get_all_comment_of_task($id);
        $temp = $this->model->delObj($id);
        if($temp){
            // xoa foder chua file task_id
            $dir_erp = DIR_UPLOAD.'/erp/'.$this->_Info[0]['truonghoc_id'].'/'.$code;
            if(file_exists($dir_erp)){
                array_map('unlink', glob("$dir_erp/*.*")); rmdir($dir_erp);
            }
            // xoa folder cua file fm_comment
            foreach ($code_cm as $key => $value) {
                $dir_cm = DIR_UPLOAD.'/erp/'.$this->_Info[0]['truonghoc_id'].'/'.$value['code'];
                if(file_exists($dir_erp)){
                    array_map('unlink', glob("$dir_cm/*.*"));
                    rmdir($dir_cm);
                }
            }
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/del");
    }

    function chuyen(){
        $id = $_REQUEST['idtaskc']; $userid = $_REQUEST['user_id'];
        $lydo = $_REQUEST['ly_do']; $create_at = date("Y-m-d H:i:s");
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $detail = $this->model->get_detail($id);
        if($this->_Info[0]['id'] == $detail[0]['user_id']){ // nguoi tao la nguoi chuyen cong viec
            $status = 1; $comment = "Đã chuyển công việc cho <i><b>".$this->_Data->get_fullname_users($userid).'</b></i> xử lý với lý do: <b>'.$lydo.'</b>';
        }else{
            $status = 0; $comment = "Đề nghị chuyển công việc với lý do: <b>".$lydo."</b>";
        }
        $data = array("truonghoc_id" => $truonghocid, "task_id" => $id, "user_id" => $userid, "ly_do" => $lydo, "status" => $status,
                        "create_at" => $create_at);
        $temp = $this->model->addObj_chuyen($data);
        if($temp){
            $code = time();
            $data_cm = array("code" =>  $code, 'truonghoc_id' => $truonghocid, 'task_id' => $id,
                            "user_id" => $this->_Info[0]['id'], "content" => $comment,
                            "create_at" => date("Y-m-d H:i:s"));
            $tmp = $this->model->addObj_comment($data_cm);
            if($tmp){
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/chuyen");
    }

    function lichcongtac(){
        require 'layouts/header.php';

        $userid = base64_decode($_REQUEST['id']);
        $jsonObj = $this->model->get_info_user($userid);
        $this->view->jsonObj = $jsonObj;

        $this->view->render('erp/lichcongtac');
        require 'layouts/footer.php';
    }

    function export_pdf(){
        $this->view->truonghoc = $this->model->get_info_truonghoc($this->_Info[0]['truonghoc_id']);
        $userid = base64_decode($_REQUEST['id']);
        $jsonObj = $this->model->get_info_user($userid);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("erp/export_pdf");
    }
}
?>
