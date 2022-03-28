<?php
class Tuyensinh extends Controller{
    private $_Info;
    private $_Convert;
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
        $this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
    }
    
    function index(){
    	require 'layouts/header.php';
        $this->view->render('tuyensinh/index');
        require 'layouts/footer.php';
    }
    
    function content(){
        $rows = 15;
        $code = $_REQUEST['code']; $name = $_REQUEST['name']; $doituong = $_REQUEST['doituong'];
        $tuoi = $_REQUEST['tuoi'];
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['truonghoc_id'], $code, $name, $doituong, $tuoi, $offset, $rows);
        $this->view->jsonObj = $jsonObj; $this->view->perpage = $rows; $this->view->page = $get_pages;
        $this->view->render('tuyensinh/content');
    }
    
    function formadd(){
        require 'layouts/header.php';
        $phantuyen = $this->model->get_phantuyen($this->_Info[0]['truonghoc_id']);
        $this->view->phantuyen = $phantuyen;
        $this->view->render('tuyensinh/formadd');
        require 'layouts/footer.php';
    }
    
    function formedit(){
        require 'layouts/header.php';
        $phantuyen = $this->model->get_phantuyen($this->_Info[0]['truonghoc_id']);
        $this->view->phantuyen = $phantuyen;
        $jsonObj = $this->model->display($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('tuyensinh/formedit');
        require 'layouts/footer.php';
    }
    
    function add(){
        $phantuyen = $this->model->get_phantuyen($this->_Info[0]['truonghoc_id']);
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
            $jsonObj['msg'] = "Học sinh này đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            // kiem tra thong tin me
            if($tenme == '' && $tenbo == '' && $tendodau == ''){
                $jsonObj['msg'] = "Bạn chưa nhập thông tin bố, mẹ hoặc người đỡ đầu";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                if($this->model->dupliObj_code(0, $code) > 0){
                    $jsonObj['msg'] = "Mã tuyển sinh đã tồn tại";
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
                                    'dien_thoai' => $dienthoai, 'email' => $email, 'nam_hoc_id' => $namhoc, 'user_id' => $this->_Info[0]['id'],
                                    'doi_tuong' => $doituong, 'create_at' => date('Y-m-d H:i:s'), 'lop_muon_vao' => $lopmuonvao,
                                    'truonghoc_id' => $this->_Info[0]['truonghoc_id']); 
                    $temp = $this->model->addObj($data);
                    if($temp){
                        $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $jsonObj['code'] = $code;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }
        }
        $this->view->render('tuyensinh/add');
    }
    
    function update(){
        $phantuyen = $this->model->get_phantuyen($this->_Info[0]['truonghoc_id']);
        $xaphuong = explode(",", $phantuyen[0]['xa_phuong']);
        $thonto = explode(",", $phantuyen[0]['thon_to']);
        $id = $_REQUEST['id'];
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
    	
    	$dup = $this->model->dupliObj($id, $hoten, $ngaysinh);
    	if($dup > 0){
    		$jsonObj['msg'] = "Học sinh này đã tồn tại";
    		$jsonObj['success'] = false;
    		$this->view->jsonObj = json_encode($jsonObj);
    	}else{
    		// kiem tra thong tin me
    		if($tenme == '' && $tenbo == '' && $tendodau == ''){
    			$jsonObj['msg'] = "Bạn chưa nhập thông tin bố, mẹ hoặc người đỡ đầu";
    			$jsonObj['success'] = false;
    			$this->view->jsonObj = json_encode($jsonObj);
    		}else{
    			$data = array('ho_ten' => $hoten, 'ngay_sinh' => $ngaysinh ,'noi_sinh' => $noisinh,
    					'gioi_tinh' => $gioitinh, 'dan_toc' => $dantoc, 'doi_tuong_chinh_sach' => $chinhsach,
    					'hoc_sinh_khuyet_tat' => $khuyettat, 'loai_khuyet_tat' => $loaikhuyettat, 'tinh_trang_suc_khoe' => $suckhoe,
    					'tinh_thuong_tru' => $tinhtt, 'huyen_thuong_tru' => $huyentt, 'xa_thuong_tru' => $xatt, 'thon_thuong_tru' => $thontt,
    					'to_thuong_tru' => $tott, 'tinh_hien_tai' => $tinhht, 'huyen_hien_tai' => $huyenth, 'xa_hien_tai' => $xaht, 'thon_hien_tai' => $thonht,
    					'to_hien_tai' => $toht, 'ten_me' => $tenme, 'nam_sinh_me' => $namsinhme, 'cmnd_me' => $cmndme, 'dien_thoai_me' => $dienthoaime, 'nghe_nghiep_me' => $nghenghiepme,
    					'ten_bo' => $tenbo, 'nam_sinh_bo' => $namsinhbo, 'cmnd_bo' => $cmndbo, 'dien_thoai_bo' => $dienthoaibo, 'nghe_nghiep_bo' => $nghenghiepbo,
    					'ten_do_dau' => $tendodau, 'nam_sinh_do_dau' => $namsinhdodau, 'cmnd_do_dau' => $cmnddodau, 'dien_thoai_do_dau' => $dienthoaidodau, 'nghe_nghiep_do_dau' => $nghenghiepdodau,
    					'dien_thoai' => $dienthoai, 'email' => $email, 'nam_hoc_id' => $namhoc, 'user_id' => $this->_Info[0]['id'], 'doi_tuong' => $doituong,
                        'lop_muon_vao' => $lopmuonvao, "create_at" => date("Y-m-d H:i:s"));
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
    	}
    	$this->view->render('tuyensinh/update');
    }
    
    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("tuyensinh/del");
    }
    
    function detail(){
        require 'layouts/header.php';
        $jsonObj = $this->model->display($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $truonghoc = $this->model->get_detail_truonghoc($jsonObj[0]['truonghoc_id']);
        $this->view->truonghoc = $truonghoc;
        $detail_tt = $this->model->get_detail_thong_tin_ho_so($jsonObj[0]['code']);
        $this->view->bienban = $detail_tt;
        $this->view->render('tuyensinh/detail');
        require 'layouts/footer.php';
    }
    
    function invoice(){
        $jsonObj = $this->model->display($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $truonghoc = $this->model->get_detail_truonghoc($jsonObj[0]['truonghoc_id']);
        $this->view->truonghoc = $truonghoc;
        $this->view->render('tuyensinh/invoice');
        
    }
    
    function update_bienban(){
        $code = $_REQUEST['code'];
        $userid = $_REQUEST['bennhan_id'];
        $cmnd = $_REQUEST['bengiao_id'];
        $hoten = $_REQUEST['hotennguoigiao'];
        $ngaynhan = $this->_Convert->convertDate($_REQUEST['ngay_nhan_ho_so']);
        $donxinhoc = (isset($_REQUEST['don_xin_hoc'])) ? 1 : 0;
        $giaykhaisinh = (isset($_REQUEST['giay_khai_sinh'])) ? 1 : 0;
        $photohokhau = (isset($_REQUEST['photo_ho_khau'])) ? 1 : 0;
        $giaytokhac = $_REQUEST['giay_to_khac'];
        $data = array('code' => $code, 'user_id' => $userid, 'don_xin_hoc' => $donxinhoc, 'giay_khai_sinh' => $giaykhaisinh,
            'photo_ho_khau' => $photohokhau, 'giay_to_khac' => $giaytokhac, 'cmnd' => $cmnd, 'nguoigiao' => $hoten);
        if($this->model->check_exit_ho_so($code) != 0){
            $temp = $this->model->update_thong_tin_ho_so($code, $data);
        }else{
            $temp = $this->model->add_thong_tin_ho_so($data);
        }
        if($temp){
            $jsonObj['msg'] = "Cập nhật thông tin thành công";
            $jsonObj['code'] = $code;
            $jsonObj['ngaynhan'] = $ngaynhan;
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật thông tin không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('tuyensinh/update_bienban');
    }
    
    function bienban(){
        $code = $_REQUEST['code'];
        $detai = $this->model->get_detail_via_code($code);
        $detail_tt = $this->model->get_detail_thong_tin_ho_so($code);
        $truonghoc = $this->model->get_detail_truonghoc($detai[0]['truonghoc_id']);
        $this->view->truonghoc = $truonghoc;
        $this->view->detail = $detai;
        $this->view->detail_tt = $detail_tt;
        $this->view->render('tuyensinh/bienban');
    }
    
    function update_tiepnhan(){
        $code = $_REQUEST['code'];
        $tungay = $this->_Convert->convertDate($_REQUEST['ngay_di_hoc']);
        $suckhoe = $_REQUEST['tinh_trang_suc_khoe'];
        $data = array('code' => $code, 'tu_ngay' => $tungay, 'suc_khoe' => $suckhoe);
        if($this->model->check_exit_ho_so($code) != 0){
            $temp = $this->model->update_thong_tin_ho_so($code, $data);
        }else{
            $temp = $this->model->add_thong_tin_ho_so($data);
        }
        if($temp){
            $jsonObj['msg'] = "Cập nhật thông tin thành công";
            $jsonObj['code'] = $code;
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật thông tin không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('tuyensinh/update_tiepnhan');
    }
    
    function tiepnhan(){
        $code = $_REQUEST['code'];
        $detai = $this->model->get_detail_via_code($code);
        $detail_tt = $this->model->get_detail_thong_tin_ho_so($code);
        $truonghoc = $this->model->get_detail_truonghoc($detai[0]['truonghoc_id']);
        $this->view->truonghoc = $truonghoc;
        $this->view->detail = $detai;
        $this->view->detail_tt = $detail_tt;
        $this->view->render('tuyensinh/tiepnhan');
    }
}
?>