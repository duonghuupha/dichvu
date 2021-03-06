<?php
class Hotro extends Controller{
    private $_Info;
    private $_Convert;
    private $_Data;
    private $_Senmail;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
        $this->_Data = new Model();
        $this->_Senmail = new Sendmail();
    }

    function index(){
    	require 'layouts/header.php';
        $this->view->render('hotro/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $roles = ($this->_Data->check_roles($this->_Info[0]['id'], 6) > 0) ? 1 : 0;
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $this->_Info[0]['id'], $roles, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('hotro/content');
    }

    function guiyeucau(){
    	require 'layouts/header.php';
        if($this->_Info[0]['truonghoc_id'] != 0){
            $dichvu = $this->model->get_dich_vu_su_dung($this->_Info[0]['truonghoc_id']);
            $kieudichvu = $this->model->get_kieu_dich_vu($this->_Info[0]['truonghoc_id']);
        }else{
            $dichvu = $this->model->get_dichvu_taptrung();
            $kieudichvu = $this->model->get_kieudichvu_taptrung();
        }
        $this->view->dichvu = $dichvu;
        $this->view->kieudichvu = $kieudichvu;
        $this->view->render('hotro/guiyeucau');
        require 'layouts/footer.php';
    }
    
    function add(){
        $truonghocid = ($this->_Info[0]['truonghoc_id'] != 0) ? $this->_Info[0]['truonghoc_id'] : $_REQUEST['truonghoc_id'];
        $code = time(); $sodienthoai = $_REQUEST['sodienthoai']; $noidung = addslashes($_REQUEST['noidung']);
        $file = ($_FILES['image']['name'] != '') ? $this->_Convert->convert_img($_FILES['image']['name'], $code) : ''; 
        $danhmucid = $_REQUEST['danhmuc_id']; $phongbanid = $_REQUEST['phongban_id']; $thietbiid = $_REQUEST['thietbi_id'];
        $data = array("code" => $code, 'sodienthoai' => $sodienthoai, 'noidung' => $noidung, 'image' => $file,
                        'danhmuc_id' => $danhmucid, 'user_id' => $this->_Info[0]['id'], 'create_at' => date("Y-m-d H:i:s"),
                        'truonghoc_id' => $truonghocid, 'phongban_id' => $phongbanid, 'thietbi_id' => $thietbiid);
        $temp = $this->model->addObj($data);
        if($temp){
            if($file != ''){
                move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/hotro/'.$file);
            }
            // duyet yeu cau luon
            if($this->_Info[0]['truonghoc_id'] == 0){
                $detail = $this->model->get_detail_yeucau_via_code($code);
                $datact = array("yeucau_id" => $detail[0]['id'], 'noidung' => '', 'thoi_gian' => '', 'user_pro' => 0,
                        'create_at' => date("Y-m-d H:i:s"), 'status' => 1);
                $this->model->add_yeucau_pro($datact); 
            }
            $jsonObj['msg'] = "C???p nh???t d??? li???u th??nh c??ng";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "C???p nh???t d??? li???u kh??ng th??nh c??ng";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("hotro/add");
    }

    function yeucaudagui(){
    	require 'layouts/header.php';
        $this->view->render('hotro/yeucaudagui');
        require 'layouts/footer.php';
    }

    function timeline(){
    	require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_detail($id);
        $this->view->jsonObj = $jsonObj;
        $detail = $this->model->get_process_yeucau($id);
        $this->view->detail = $detail;
        $this->view->render('hotro/timeline');
        require 'layouts/footer.php';
    }
    
    function contentdm(){
        $dichvuid = $_REQUEST['dichvu_id']; $kieudichvuid = $_REQUEST['kieudichvu_id'];
        $jsonObj = $this->model->get_danhmuc_via_dichvu_kieudichvu($dichvuid, $kieudichvuid);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("hotro/contentdm");
    }
    
    function duyetyeucau(){
        require 'layouts/header.php';
        $this->view->render('hotro/duyetyeucau');
        require 'layouts/footer.php';
    }
    
    function contentd(){
        $rows = 15;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_duyet($this->_Info[0]['truonghoc_id'], $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('hotro/contentd');
    }
    
    function change(){
        $id = $_REQUEST['id'];
        $data = array("yeucau_id" => $id, 'noidung' => '', 'thoi_gian' => '', 'user_pro' => 0,
                        'create_at' => date("Y-m-d H:i:s"), 'status' => 1); 
        $temp = $this->model->add_yeucau_pro($data);
        if($temp){
            $jsonObj['msg'] = "Duy???t y??u c???u th??nh c??ng";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Duy???t y??u c???u kh??ng th??nh c??ng";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("hotro/change");
    }
    
    function tiepnhan(){
        $thoigian = $_REQUEST['thoi_gian']; $id = $_REQUEST['id'];
        $userpro = ($_REQUEST['user_pro'] == 0) ? $this->_Info[0]['id'] : $_REQUEST['user_pro'];
        $noidung = $_REQUEST['noidung'];
        $data = array("yeucau_id" => $id, 'noidung' => $noidung, 'thoi_gian' => $thoigian, 'user_pro' => $userpro,
                        'create_at' => date("Y-m-d H:i:s"), 'status' => 2);
        $temp = $this->model->add_yeucau_pro($data);
        if($temp){
            // gui mail
            $detail = $this->model->get_process_yeucau_guimail($id);
            $subject = "Ti???p nh???n y??u c???u";
            $msg = "K??nh th??a qu?? kh??ch.<br/>";
            $msg .="K??? thu???t <b>NGOCDAT CORP</b> ???? ti???p nh???n y??u c???u <b>#".$detail[0]['code']." - ".$detail[0]['dichvu']." :: ".$detail[0]['danhmuc']."</b> c???a Qu?? kh??ch.<br/>";
            $msg .= "Hi???n t???i, y??u c???u ??ang ???????c <b>".$detail[0]['nhanvien']."</b> thu???c trung t??m H??? tr??? k??? thu???t ti???n h??nh ki???m tra th??ng tin ????? x??? l??.";
            $msg .= "D??? ki???n, y??u c???u s??? ???????c x??? l?? ho??n t???t trong v??ng <b>".$thoigian."</b> (ho???c c?? th??? s???m h??n). N???u c?? ph??t sinh th??m th???i gian trong qu?? tr??nh x??? l?? ";
            $msg .= "<b>NGOCDAT CORP</b> s??? li??n h??? tr???c ti???p qua ??i???n tho???i ?????n Qu?? kh??ch ????? trao ?????i th??m th??ng tin. Xin vui l??ng gi??? li??n l???c qua ??i???n tho???i.<br/>";
            $msg .= "Xin tr??n tr???ng c???m ??n Qu?? kh??ch.";
            $gui = $this->_Convert->sendmail("webmasterzero19@gmail.com", $subject, $msg);
            if($gui == 1){
                $jsonObj['msg'] = "Ti???p nh???n y??u c???u th??nh c??ng, nh??ng ch??a g???i mail";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ti???p nh???n y??u c???u th??nh c??ng";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);   
            }
        }else{
            $jsonObj['msg'] = "Ti???p nh???n y??u c???u kh??ng th??nh c??ng";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("hotro/tiepnhan");
    }
    
    function phanhoi(){
        $id = $_REQUEST['id'];
        $noidung = $_REQUEST['noidung'];
        $chiphi = isset($_REQUEST['chi_phi']) ? $_REQUEST['chi_phi'] : 0;
        $data = array('yeucau_id' => $id, 'noidung' => $noidung, 'thoi_gian' => '', 'user_pro' => 0,
                        'create_at' => date("Y-m-d H:i:s"), 'status' => 3);
        $temp = $this->model->add_yeucau_pro($data);
        if($temp){
            // add chi phi
            if(isset($_REQUEST['chi_phi']) && $_REQUEST['chi_phi'] != 0){
                $datacp = array("yeucau_id" => $id, 'chi_phi' => str_replace(",", "", $chiphi));
                $this->model->add_yeucau_chiphi($datacp);
            }
            $jsonObj['msg'] = "Ph???n h???i th??nh c??ng";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ph???n h???i kh??ng th??nh c??ng";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("hotro/phanhoi");
    }
    
    function hoanthanh(){
        $id = $_REQUEST['id'];
        $data = array("yeucau_id" => $id, 'noidung' => '', 'thoi_gian' => '', 'user_pro' => 0,
                        'create_at' => date("Y-m-d H:i:s"), 'status' => 4, 'chu_ky' => $_REQUEST['chuky']); 
        $temp = $this->model->add_yeucau_pro($data);
        if($temp){
            // gui mail
            $detail = $this->model->get_process_yeucau_guimail($id);
            $subject = "Y??u c???u ???? ???????c x??? l??";
            $msg = "K??nh th??a qu?? kh??ch.<br/>";
            $msg .= "Y??u c???u c???a Qu?? kh??ch ???? ???????c x??? l?? ho??n t???t v??o h???i ".date("Y-m-d H:i:s")."<br/>";
            $msg .= "Xin tr??n tr???ng c???m ??n qu?? kh??ch ???? tin t?????ng s??? d???ng d???ch v??? c???a ch??ng t??i.";
            $gui = $this->_Convert->sendmail("webmasterzero19@gmail.com", $subject, $msg);
            if($gui == 1){
                $jsonObj['msg'] = "Ti???p nh???n y??u c???u th??nh c??ng, nh??ng ch??a g???i mail";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ti???p nh???n y??u c???u th??nh c??ng";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);   
            }
            $jsonObj['msg'] = "C???p nh???t th??nh c??ng";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "C???p nh???t kh??ng th??nh c??ng";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("hotro/hoanthanh");       
    }
    
    function combo_thietbi(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_combo_thietbi($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("hotro/combo_thietbi");
    }
    
    function kydientu(){        
        require 'layouts/header.php';
        $id = $_REQUEST['id'];
        $this->view->render('hotro/kydientu');
        require 'layouts/footer.php';
    }
}
?>