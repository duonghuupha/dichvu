<?php
class Other extends Controller{
    function __construct(){
        parent::__construct();
    }

    function combo_dichvu(){
        $jsonObj = $this->model->get_combo_dich_vu();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('other/combo_dichvu');
    }

    function combo_kieudichvu(){
        $jsonObj = $this->model->get_combo_kieu_dich_vu();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('other/combo_kieudichvu');
    }

    function combo_truonghoc(){
        $jsonObj = $this->model->get_combo_truonghoc();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('other/combo_truonghoc');
    }

    function combo_nguoidung(){
        $jsonObj = $this->model->get_combo_nguoidung($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('other/combo_nguoidung');
    }

    function combo_users(){
        $jsonObj = $this->model->get_combo_nguoidung($_REQUEST['truonghocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('other/combo_users');
    }

    function combo_content_dm(){
        $jsonObj = $this->model->get_combo_content_dm($_REQUEST['truonghocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_content_dm");
    }

    function combo_thietbi_dm(){
        $jsonObj = $this->model->get_combo_thietbi_dm($_REQUEST['truonghocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_thietbi_dm");
    }

    function combo_namhoc(){
        $jsonObj = $this->model->get_combo_namhoc($_REQUEST['truonghocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_namhoc");
    }

    function combo_phongban(){
        $jsonObj = $this->model->get_combo_phongban($_REQUEST['truonghocid'], $_REQUEST['namhocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_phongban");
    }

    function combo_vanban_dm(){
        $jsonObj = $this->model->get_combo_vanban_dm($_REQUEST['truonghocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_vanban_dm");
    }

    function namhocact(){
        $id = $_REQUEST['id'];
        $detail = $this->model->get_namhoc_act($id);
        if(count($detail) > 0){
            $jsonObj['msg'] = "Thành công";
            $jsonObj['success'] = true;
            $jsonObj['id'] = $detail[0]['id'];
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Không tồn tại năm học được kích hoạt của trường";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("other/namhocact");
    }

    function combo_thanhpho(){
        $jsonObj = $this->model->get_combo_thanhpho();
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_thanhpho");
    }

    function combo_quanhuyen(){
        $jsonObj = $this->model->get_combo_quanhuyen($_REQUEST['idh']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_quanhuyen");
    }

    function combo_xaphuong(){
        $jsonObj = $this->model->get_combo_xaphuong($_REQUEST['idh']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_xaphuong");
    }

    function combo_thonto(){
        $jsonObj = $this->model->get_combo_thonto($_REQUEST['idh']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_thonto");
    }

    function combo_dantoc(){
        $jsonObj = $this->model->get_combo_dan_toc();
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_dantoc");
    }

    function combo_class_temp(){
        $jsonObj = $this->model->get_combo_class_temp($_REQUEST['truonghocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_class_temp");
    }

    function combo_thonto_phantuyen(){
        $jsonObj = $this->model->get_combo_thon_to_phantuyen($_REQUEST['idh']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_thonto_phantuyen");
    }

    function list_xaphuong(){
        $jsonObj = $this->model->get_combo_xaphuong($_REQUEST['idh']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/list_xaphuong");
    }

    function list_thonto(){
        $id = base64_decode($_REQUEST['idh']);
        $jsonObj = $this->model->get_combo_thon_to_phantuyen($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/list_thonto");
    }

    function combo_bantuyensinh(){
        $jsonObj = $this->model->get_combo_bantuyensinh($_REQUEST['truonghocid'], $_REQUEST['namhocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_bantuyensinh");
    }

    function combo_giaohoso(){
        $jsonObj = $this->model->get_nguoi_giao_ho_so($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_giaohoso");
    }

    function list_giaovien_pb(){
        $id = $_REQUEST['idh']; $truonghocid = $_REQUEST['truonghocid'];
        $jsonObj = $this->model->get_combo_nguoidung($truonghocid);
        $this->view->jsonObj = $jsonObj;
        $phongban = $this->model->get_info_phongban($id);
        $this->view->phongban = $phongban;
        $query = $this->model->get_all_phongban_dapb($truonghocid);
        foreach($query as $row){
            $array[] = $row['giao_vien'];
        }
        $this->view->disabled = implode(",", $array);
        $this->view->render("other/list_giaovien_pb");
    }

    function combo_lophoc(){
        $jsonObj = $this->model->get_combo_lop_hoc($_REQUEST['truonghocid'], $_REQUEST['namhocid']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_lophoc");
    }

    function combo_khunggio(){
        $jsonObj = $this->model->get_combo_khunggio();
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_khunggio");
    }

    function combo_nhomcongviec(){
        $jsonObj = $this->model->get_combo_nhom_cong_viec($_REQUEST['truonghocid'], $_SESSION['data'][0]['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_nhomcongviec");
    }

    function combo_usergrouptask(){
        $jsonObj = $this->model->get_user_group_task($_REQUEST['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_usergrouptask");
    }

    function combo_exam(){
        $s = isset($_REQUEST['s']) ? 1 : 0;
        $jsonObj = $this->model->get_combo_exam($_REQUEST['truonghocid'], $s);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_exam");
    }
}
?>
