<?php
class Tuyensinhonline extends Controller{
    private $_Convert;
    function __construct(){
        parent::__construct();
        $this->_Convert = new Convert();
    }
    
    function index(){
        $truonghoc = $this->model->get_detail_truonghoc($_REQUEST['truonghocid']);
        $this->view->truonghoc = $truonghoc;
        $phantuyen = $this->model->get_phantuyen($_REQUEST['truonghocid']);
        $this->view->phantuyen = $phantuyen;
        $this->view->render('tuyensinhonline/index');
    }
    
    function add(){
        $phantuyen = $this->model->get_phantuyen($_REQUEST['truonghocid']);
        $xaphuong = explode(",", $phantuyen[0]['xa_phuong']);
        $thonto = explode(",", $phantuyen[0]['thon_to']);
        $code = $_REQUEST['code'];
        $hoten = $_REQUEST['ho_ten']; $ngaysinh = $this->_Convert->convertDate($_REQUEST['ngay_sinh']);
        $noisinh = $_REQUEST['noi_sinh']; $gioitinh = $_REQUEST['gioi_tinh']; $dantoc = $_REQUEST['dan_toc'];
        $chinhsach = $_REQUEST['doi_tuong_chinh_sach']; $khuyettat = $_REQUEST['hoc_sinh_khuyet_tat'];
        $loaikhuyettat = $_REQUEST['loai_khuyet_tat']; $suckhoe = $_REQUEST['tinh_trang_suc_khoe'];
        $namhoc = $_REQUEST['nam_hoc_id']; $lopmuonvao = $_REQUEST['lop_muon_vao'];
        // ho khau thuong tru
        $tinhtt = $_REQUEST['tinh_thuong_tru']; $huyentt = $_REQUEST['huyen_thuong_tru']; 
        $xatt = $_REQUEST['xa_thuong_tru']; $thontt = $_REQUEST['thon_thuong_tru'];
        $tott = $_REQUEST['to_thuong_tru'];
        // ho khau hien tai
        $tinhht = $_REQUEST['tinh_hien_tai']; $huyenth = $_REQUEST['huyen_hien_tai'];
        $xaht = $_REQUEST['xa_hien_tai']; $thonht = $_REQUEST['thon_hien_tai'];
        $toht = $_REQUEST['to_hien_tai'];
        // thong tin me
        $tenme = $_REQUEST['ten_me']; $namsinhme = $_REQUEST['nam_sinh_me']; $cmndme = $_REQUEST['cmnd_me'];
        $dienthoaime = $_REQUEST['dien_thoai_me']; $nghenghiepme = $_REQUEST['nghe_nghiep_me'];
        // thong tin bo
        $tenbo = $_REQUEST['ten_bo']; $namsinhbo = $_REQUEST['nam_sinh_bo']; $cmndbo = $_REQUEST['cmnd_bo'];
        $dienthoaibo = $_REQUEST['dien_thoai_bo']; $nghenghiepbo = $_REQUEST['nghe_nghiep_bo'];
        // thong tin nguoi do dau
        $tendodau = $_REQUEST['ten_do_dau']; $namsinhdodau = $_REQUEST['nam_sinh_do_dau'];
        $cmnddodau = $_REQUEST['cmnd_do_dau']; $dienthoaidodau = $_REQUEST['dien_thoai_do_dau'];
        $nghenghiepdodau = $_REQUEST['nghe_nghiep_do_dau'];
        // thong tin lien he
        $dienthoai = $_REQUEST['dien_thoai']; $email = $_REQUEST['email'];
        
        // doi tuong tuyen sinh
        if(in_array($xatt, $xaphuong) && in_array($xaht, $xaphuong) 
            && in_array($thontt, $thonto) && in_array($thonht, $thonto)){ // doi tuong 1
            $doituong = 1;
        }elseif(in_array($xatt, $xaphuong) && !in_array($xaht, $xaphuong) 
            && in_array($thontt, $thonto) && !in_array($thonht, $thonto)){ // doi tuong 2
            $doituong = 2;
        }elseif(!in_array($xatt, $xaphuong) && in_array($xaht, $xaphuong) 
            && !in_array($thontt, $thonto) && in_array($thonht, $thonto)){ // doi tuong 3
            $doituong = 3;
        }elseif(in_array($xatt, $xaphuong) && in_array($xaht, $xaphuong) 
            && in_array($thontt, $thonto) && !in_array($thonht, $thonto)){  // doi tuong 2
			$doituong = 2;
		}elseif(in_array($xatt, $xaphuong) && in_array($xaht, $xaphuong) 
            && !in_array($thontt, $thonto) && in_array($thonht, $thonto)){  // doi tuong 3
			$doituong = 3;
		}else{
            $doituong = 4;
        }
        
        $dup = $this->model->dupliObj(0, $hoten, $ngaysinh);
        if($dup > 0){
            $jsonObj['msg'] = "H???c sinh n??y ???? t???n t???i";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            // kiem tra thong tin me
            if($tenme == '' && $tenbo == '' && $tendodau == ''){
                $jsonObj['msg'] = "B???n ch??a nh???p th??ng tin b???, m??? ho???c ng?????i ????? ?????u";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                if($this->model->dupliObj_code(0, $code) > 0){
                    $jsonObj['msg'] = "M?? tuy???n sinh ???? t???n t???i";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $data = array('code' => $code, 'ho_ten' => $hoten, 'ngay_sinh' => $ngaysinh ,'noi_sinh' => $noisinh,
                                    'gioi_tinh' => $gioitinh, 'dan_toc' => $dantoc, 'doi_tuong_chinh_sach' => $chinhsach,
                                    'hoc_sinh_khuyet_tat' => $khuyettat, 'loai_khuyet_tat' => $loaikhuyettat, 'tinh_trang_suc_khoe' => $suckhoe,
                                    'tinh_thuong_tru' => $tinhtt, 'huyen_thuong_tru' => $huyentt, 'xa_thuong_tru' => $xatt, 'thon_thuong_tru' => $thontt,
                                    'to_thuong_tru' => $tott, 'tinh_hien_tai' => $tinhht, 'huyen_hien_tai' => $huyenth, 'xa_hien_tai' => $xaht, 'thon_hien_tai' => $thonht,
                                    'to_hien_tai' => $toht, 'ten_me' => $tenme, 'nam_sinh_me' => $namsinhme, 'cmnd_me' => $cmndme, 'dien_thoai_me' => $dienthoaime, 'nghe_nghiep_me' => $nghenghiepme,
                                    'ten_bo' => $tenbo, 'nam_sinh_bo' => $namsinhbo, 'cmnd_bo' => $cmndbo, 'dien_thoai_bo' => $dienthoaibo, 'nghe_nghiep_bo' => $nghenghiepbo,
                                    'ten_do_dau' => $tendodau, 'nam_sinh_do_dau' => $namsinhdodau, 'cmnd_do_dau' => $cmnddodau, 'dien_thoai_do_dau' => $dienthoaidodau, 'nghe_nghiep_do_dau' => $nghenghiepdodau,
                                    'dien_thoai' => $dienthoai, 'email' => $email, 'nam_hoc_id' => $namhoc, 'user_id' => 0,
                                    'doi_tuong' => $doituong, 'create_at' => date('Y-m-d H:i:s'), 'lop_muon_vao' => $lopmuonvao,
                                    'truonghoc_id' => $_REQUEST['truonghocid'], 'nguon' => 1); 
                    $temp = $this->model->addObj($data);
                    if($temp){
                        /*$subject = "Ti???p nh???n th??ng tin ????ng k?? tuy???n sinh";
                        $msg = "K??nh th??a qu?? ph??? huynh.<br/>";
                        $msg .="<b>Tr?????ng m???m non C??? Kh???i</b> ???? ti???p nh???n th??ng tin ????ng k?? tuy???n sinh c???a:<br/>";
                        $msg .= "T??n h???c sinh: <b>".$hoten."</b><br/>";
                        $msg .= "Ng??y sinh: <b>".$_REQUEST['ngay_sinh']."</b><br/>";
                        $msg .= "M?? h??? s?? tuy???n sinh: <b>".$code."</b><br/>";
                        $msg .= "Th???i gian ????ng k?? tuy???n sinh: <b>".date("H:i:s d-m-Y")."</b><br/>";
                        $msg .= "Xin tr??n tr???ng c???m ??n.";
                        $gui = $this->_Convert->sendmail_ts($email, $subject, $msg);*/
                        $jsonObj['msg'] = "????ng k?? tuy???n sinh th??nh c??ng";
                        $jsonObj['success'] = true;
                        $_SESSION['tuyensinh'] = array('truonghocid' => $_REQUEST['truonghocid'], "code" => $code);
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "????ng k?? tuy???n sinh kh??ng th??nh c??ng";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }
        }
        $this->view->render('tuyensinhonline/add');
    }
    
    function invoice(){
        $info = $_SESSION['tuyensinh'];
        $jsonObj = $this->model->display($info['code']);
        $this->view->jsonObj = $jsonObj;
        $truonghoc = $this->model->get_detail_truonghoc($info['truonghocid']);
        $this->view->truonghoc = $truonghoc;
        /**/
        $this->view->render('tuyensinhonline/invoice');
    }
}
?>