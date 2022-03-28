<?php
class Exam extends Controller{
    private $_Info;
    private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
    }

    function content(){
        $rows = 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('exam/content');
    }

    function add(){
        $truonghocid = $this->_Info[0]['truonghoc_id'];
        $title = $_REQUEST['title_exam'];
        $datestart = $this->_Convert->convertDate($_REQUEST['date_start']);
        $dateend = $this->_Convert->convertDate($_REQUEST['date_end']);
        $soluong = $_REQUEST['so_luong'];
        if($datestart > $dateend){
            $jsonObj['msg'] = "Ngày bắt đầu không thể lớn hơn ngày kết thúc";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('title' => $title, 'truonghoc_id' => $truonghocid, 'date_start' => $datestart, 'date_end' => $dateend,
                            'so_luong' => $soluong);
            $temp = $this->model->addObj($data);
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
        $this->view->render("exam/add");
    }

    function update(){
        $id = $_REQUEST['id_exam'];
        $title = $_REQUEST['title_exam'];
        $datestart = $this->_Convert->convertDate($_REQUEST['date_start']);
        $dateend = $this->_Convert->convertDate($_REQUEST['date_end']);
        $soluong = $_REQUEST['so_luong'];
        if($datestart > $dateend){
            $jsonObj['msg'] = "Ngày bắt đầu không thể lớn hơn ngày kết thúc";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('title' => $title, 'date_start' => $datestart, 'date_end' => $dateend, 'so_luong' => $soluong);
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
        }
        $this->view->render("exam/update");
    }

    function del(){
        $id = $_REQUEST['id']; $detail = $this->model->get_detail($id);
        if(date("Y-m-d") > $detail[0]['date_start'] && date("Y-m-d") < $detail[0]['date_end']){
            $jsonObj['msg'] = "Đang trong thời gian cập nhật dữ liệu, bạn không thể xóa";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("exam/del");
    }
}
?>
