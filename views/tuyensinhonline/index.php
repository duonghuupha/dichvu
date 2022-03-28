<?php
$truonghoc = $this->truonghoc;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title><?php echo $truonghoc[0]['title'] ?> :: Hệ thống tuyển sinh trực tuyến</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/Ionicons/css/ionicons.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/roboto.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/AdminLTE.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/skins/_all-skins.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/morris.js/morris.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/jvectormap/jquery-jvectormap.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/select2/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/iCheck/all.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/fullcalendar.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        var baseUrl = '<?php echo URL ?>';
        var truonghocid = <?php echo $_REQUEST['truonghocid'] ?>;
        var xaphuongdc = '<?php echo $this->phantuyen[0]['xa_phuong'] ?>';
        var xaphuong = xaphuongdc.split(",");
    </script>
    <script src="<?php echo URL.'/public/' ?>javascript/librarys.js"></script>
    <script type="text/javascript" src="<?php echo URL.'/public/javascript/tuyensinh/online.js' ?>"></script>
</head>
<body class="hold-transition skin-blue">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Đăng ký tuyển sinh trự tuyến
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <form role="form" method="post" id="fm" enctype="multipart/form-data">
                                <input id="truonghocid" name="truonghocid" value="<?php echo $_REQUEST['truonghocid'] ?>" type="hidden"/>
                                <div class="box-body">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Năm học <i style="color:red">(*)</i></label>
                                            <select class="form-control" id="nam_hoc_id" style="width:100%"
                                                placeholder="Năm học tuyển sinh" name="nam_hoc_id" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mã TS <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="code"
                                                placeholder="Mã hồ sơ tuyển sinh" name="code" required
                                                value="<?php echo 'TS-'.rand(111111, 999999) ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Họ và tên học sinh <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="ho_ten"
                                                placeholder="Họ và tên học sinh" name="ho_ten" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ngày sinh <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="ngay_sinh"
                                                placeholder="Ngày sinh" name="ngay_sinh" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nới sinh <i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn tỉnh/ TP"
                                            style="width: 100%;" id="noi_sinh" name="noi_sinh" required>
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Giới tính <i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn giới tính"
                                            style="width: 100%;" id="gioi_tinh" name="gioi_tinh" required>
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dân tộc <i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn dân tộc"
                                            style="width: 100%;" id="dan_toc" name="dan_toc" required>
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Đối tượng chính sách</label>
                                            <input type="text" class="form-control" id="doi_tuong_chinh_sach"
                                                placeholder="Đối tượng chính sách" name="doi_tuong_chinh_sach"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Học sinh khuyết tật</label>
                                            <input type="text" class="form-control" id="hoc_sinh_khuyet_tat"
                                                placeholder="Học sinh khuyết tật" name="hoc_sinh_khuyet_tat"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Loại khuyết tật</label>
                                            <input type="text" class="form-control" id="loai_khuyet_tat"
                                                placeholder="Loại khuyết tật" name="loai_khuyet_tat"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tình trạng sức khỏe</label>
                                            <input type="text" class="form-control" id="tinh_trang_suc_khoe"
                                                placeholder="TÌnh trạng sức khỏe" name="tinh_trang_suc_khoe"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lớp muốn vào <i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn lớp học"
                                            style="width: 100%;" id="lop_muon_vao" name="lop_muon_vao" required>
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tỉnh / Thành phố thường trú<i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn tỉnh/TP"
                                            style="width: 100%;" id="tinh_thuong_tru" name="tinh_thuong_tru" required
                                            onchange="set_quan_huyen(1)">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quận / Huyện thường trú<i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn quận/huyện"
                                            style="width: 100%;" id="huyen_thuong_tru" name="huyen_thuong_tru" required
                                            onchange="set_xa_phuong(1)">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Xã / Phường thường trú<i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn xã / phường"
                                            style="width: 100%;" id="xa_thuong_tru" name="xa_thuong_tru" required
                                            onchange="set_thon_to(1)">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" id="tttt">Thôn / tổ thường trú</label>
                                            <select class="form-control" data-placeholder="Lựa chọn thôn/tổ"
                                            style="width: 100%;" id="thon_thuong_tru" name="thon_thuong_tru">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số nhà / tên đường</label>
                                            <input type="text" class="form-control" id="to_thuong_tru"
                                                placeholder="Số nhà/tên đường" name="to_thuong_tru"/>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tỉnh / Thành phố cư trú<i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn tỉnh/TP"
                                            style="width: 100%;" id="tinh_hien_tai" name="tinh_hien_tai" required
                                            onchange="set_quan_huyen(2)">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Quận / Huyện cư trú<i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn quận/huyện"
                                            style="width: 100%;" id="huyen_hien_tai" name="huyen_hien_tai" required
                                            onchange="set_xa_phuong(2)">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Xã / Phường cư trú<i style="color:red">(*)</i></label>
                                            <select class="form-control" data-placeholder="Lựa chọn xã / phường"
                                            style="width: 100%;" id="xa_hien_tai" name="xa_hien_tai" required
                                            onchange="set_thon_to(2)">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" id="ttct">Thôn / tổ cư trú</label>
                                            <select class="form-control" data-placeholder="Lựa chọn thôn/tổ"
                                            style="width: 100%;" id="thon_hien_tai" name="thon_hien_tai">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số nhà / tên đường</label>
                                            <input type="text" class="form-control" id="to_hien_tai"
                                                placeholder="Số nhà/tên đường" name="to_hien_tai"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Họ tên mẹ <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="ten_me"
                                                placeholder="Họ và tên mẹ học sinh" name="ten_me" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Năm sinh mẹ <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="nam_sinh_me" maxlength="4"
                                                placeholder="Năm sinh, VD: 1991" name="nam_sinh_me" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số CMND/CCCD mẹ <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="cmnd_me"
                                                placeholder="Số CMND hoặc số CCCD của mẹ học sinh" name="cmnd_me" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Điện thoại mẹ <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="dien_thoai_me"
                                                placeholder="Điện thoại của mẹ học sinh" name="dien_thoai_me" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nghề nghiệp mẹ <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="nghe_nghiep_me"
                                                placeholder="Nghề nghiệp của mẹ học sinh" name="nghe_nghiep_me" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Họ tên cha <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="ten_bo"
                                                placeholder="Họ và tên cha học sinh" name="ten_bo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Năm sinh cha <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="nam_sinh_bo" maxlength="4"
                                                placeholder="Năm sin, vd: 1991" name="nam_sinh_bo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số CMND/CCCD cha <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="cmnd_bo"
                                                placeholder="Số CMND hoặc số CCCD của cha học sinh" name="cmnd_bo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Điện thoại cha <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="dien_thoai_bo"
                                                placeholder="Số điện thoại của cha học sinh" name="dien_thoai_bo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nghề nghiệp cha <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="nghe_nhiep_bo"
                                                placeholder="Nghề nghiệp của cha học sinh" name="nghe_nghiep_bo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Họ tên người đỡ đầu</label>
                                            <input type="text" class="form-control" id="ten_do_dau"
                                                placeholder="Họ và tên người đỡ đầu học sinh" name="ten_do_dau"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Năm sinh  người đỡ đầu</label>
                                            <input type="text" class="form-control" id="nam_sinh_do_dau" maxlength="4"
                                                placeholder="Năm sinh, vd:1991" name="nam_sinh_do_dau"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số CMND/CCCD  người đỡ đầu</label>
                                            <input type="text" class="form-control" id="cmnd_do_dau"
                                                placeholder="Số CMND hoặc số CCCD của người đỡ đầu học sinh" name="cmnd_do_dau"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Điện thoại  người đỡ đầu</label>
                                            <input type="text" class="form-control" id="dien_thoai_do_dau"
                                                placeholder="Số điện thoại của người đỡ đầu học sinh" name="dien_thoai_do_dau"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nghề nghiệp của người đỡ đầu</label>
                                            <input type="text" class="form-control" id="nghe_nghiep_do_dau"
                                                placeholder="Nghề nghiệp của người đỡ đầu học sinh" name="nghe_nghiep_do_dau"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số điện thoại liên hệ <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="dien_thoai"
                                                placeholder="Số điện thoại liên hệ" name="dien_thoai" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email <i style="color:red">(*)</i></label>
                                            <input type="text" class="form-control" id="email"
                                                placeholder="Email nhận kết quả tuyển sinh" name="email" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align:center">
                                    <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="overlay" id="doi">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
    <!-- ./wrapper -->
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/morris.js/morris.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/moment/moment.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/locale-all.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>dist/js/adminlte.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>dist/js/pages/dashboard.js"></script>
</body>

</html>