<?php $item = $this->jsonObj; ?>
<script>
var xaphuongdc = '<?php echo $this->phantuyen[0]['xa_phuong'] ?>';
var xaphuong = xaphuongdc.split(",");
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/tuyensinh/formedit.js' ?>"></script>
<script>
$(function(){
    $('#nam_hoc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid+'&id=<?php echo $item[0]['nam_hoc_id'] ?>');
    $('#noi_sinh').load(baseUrl + '/other/combo_thanhpho?id=<?php echo $item[0]['noi_sinh'] ?>');
    $('#gioi_tinh').val(<?php echo $item[0]['gioi_tinh'] ?>).trigger('change');
    $('#dan_toc').load(baseUrl + '/other/combo_dantoc?id=<?php echo $item[0]['dan_toc'] ?>');
    $('#lop_muon_vao').load(baseUrl + '/other/combo_class_temp?truonghocid='+truonghocid+'&id=<?php echo $item[0]['lop_muon_vao'] ?>');
    //////////////////////////////////////////////////////////////////////////////////////////////
    $('#tinh_thuong_tru').load(baseUrl + '/other/combo_thanhpho?id=<?php echo $item[0]['tinh_thuong_tru'] ?>');
    $('#huyen_thuong_tru').load(baseUrl + '/other/combo_quanhuyen?idh=<?php echo $item[0]['tinh_thuong_tru'] ?>&id=<?php echo $item[0]['huyen_thuong_tru'] ?>');
    $('#xa_thuong_tru').load(baseUrl + '/other/combo_xaphuong?idh=<?php echo $item[0]['huyen_thuong_tru'] ?>&id=<?php echo $item[0]['xa_thuong_tru'] ?>');
    $('#thon_thuong_tru').load(baseUrl + '/other/combo_thonto?idh=<?php echo $item[0]['xa_thuong_tru'] ?>&id=<?php echo $item[0]['thon_thuong_tru'] ?>');
    ////////////////////////////////////////////////////////////////////////////////////////////////
    $('#tinh_hien_tai').load(baseUrl + '/other/combo_thanhpho?id=<?php echo $item[0]['tinh_hien_tai'] ?>');
    $('#huyen_hien_tai').load(baseUrl + '/other/combo_quanhuyen?idh=<?php echo $item[0]['tinh_hien_tai'] ?>&id=<?php echo $item[0]['huyen_hien_tai'] ?>');
    $('#xa_hien_tai').load(baseUrl + '/other/combo_xaphuong?idh=<?php echo $item[0]['huyen_hien_tai'] ?>&id=<?php echo $item[0]['xa_hien_tai'] ?>');
    $('#thon_hien_tai').load(baseUrl + '/other/combo_thonto?idh=<?php echo $item[0]['xa_hien_tai'] ?>&id=<?php echo $item[0]['thon_hien_tai'] ?>');
    ////////////////////////////////////////////////////////////////////////////////////////////////
    var a = xaphuong.indexOf('<?php echo $item[0]['xa_thuong_tru'] ?>');
    if(a !== -1){
        $('#thon_thuong_tru').attr("required", 'required');
        $('#tttt').html('Thôn / tổ thường trú <i style="color:red">(*)</i>');
    }else{
        $('#thon_thuong_tru').removeAttr("required");
        $('#tttt').html('Thôn / tổ thường trú</i>');
    }
    var b = xaphuong.indexOf('<?php echo $item[0]['xa_hien_tai'] ?>');
    if(b !== -1){
        $('#thon_hien_tai').attr("required", 'required');
        $('#ttct').html('Thôn / tổ cư trú <i style="color:red">(*)</i>');
    }else{
        $('#thon_hien_tai').removeAttr("required");
        $('#ttct').html('Thôn / tổ cư trú</i>');
    }
});
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cập nhật thông tin tuyển sinh
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $item[0]['id'] ?>" type="hidden"/>
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
                                        value="<?php echo $item[0]['code'] ?>" readonly=""/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và tên học sinh <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ho_ten"
                                        placeholder="Họ và tên học sinh" name="ho_ten" required
                                        value="<?php echo $item[0]['ho_ten'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ngay_sinh"
                                        placeholder="Ngày sinh" name="ngay_sinh" required
                                        value="<?php echo date("d-m-Y", strtotime($item[0]['ngay_sinh'])) ?>"/>
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
                                        placeholder="Đối tượng chính sách" name="doi_tuong_chinh_sach"
                                        value="<?php echo $item[0]['doi_tuong_chinh_sach'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Học sinh khuyết tật</label>
                                    <input type="text" class="form-control" id="hoc_sinh_khuyet_tat"
                                        placeholder="Học sinh khuyết tật" name="hoc_sinh_khuyet_tat"
                                        value="<?php echo $item[0]['hoc_sinh_khuyet_tat'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Loại khuyết tật</label>
                                    <input type="text" class="form-control" id="loai_khuyet_tat"
                                        placeholder="Loại khuyết tật" name="loai_khuyet_tat"
                                        value="<?php echo $item[0]['loai_khuyet_tat'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tình trạng sức khỏe</label>
                                    <input type="text" class="form-control" id="tinh_trang_suc_khoe"
                                        placeholder="TÌnh trạng sức khỏe" name="tinh_trang_suc_khoe"
                                        value="<?php echo $item[0]['tinh_trang_suc_khoe'] ?>"/>
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
                                        placeholder="Số nhà/tên đường" name="to_thuong_tru"
                                        value="<?php echo $item[0]['to_thuong_tru'] ?>"/>
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
                                        placeholder="Số nhà/tên đường" name="to_hien_tai"
                                        value="<?php echo $item[0]['to_hien_tai'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ tên mẹ <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ten_me"
                                        placeholder="Họ và tên mẹ học sinh" name="ten_me" required
                                        value="<?php echo $item[0]['ten_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Năm sinh mẹ <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nam_sinh_me"
                                        placeholder="Năm sinh của mẹ học sinh" name="nam_sinh_me" required
                                        value="<?php echo $item[0]['nam_sinh_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số CMND/CCCD mẹ <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="cmnd_me"
                                        placeholder="Số CMND hoặc số CCCD của mẹ học sinh" name="cmnd_me" required
                                        value="<?php echo $item[0]['cmnd_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại mẹ <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="dien_thoai_me"
                                        placeholder="Điện thoại của mẹ học sinh" name="dien_thoai_me" required
                                        value="<?php echo $item[0]['dien_thoai_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nghề nghiệp mẹ <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nghe_nghiep_me"
                                        placeholder="Nghề nghiệp của mẹ học sinh" name="nghe_nghiep_me" required
                                        value="<?php echo $item[0]['nghe_nghiep_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ tên cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ten_bo"
                                        placeholder="Họ và tên cha học sinh" name="ten_bo" required
                                        value="<?php echo $item[0]['ten_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Năm sinh cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nam_sinh_bo"
                                        placeholder="Năm sinh của cha học sinh" name="nam_sinh_bo" required
                                        value="<?php echo $item[0]['nam_sinh_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số CMND/CCCD cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="cmnd_bo"
                                        placeholder="Số CMND hoặc số CCCD của cha học sinh" name="cmnd_bo" required
                                        value="<?php echo $item[0]['cmnd_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="dien_thoai_bo"
                                        placeholder="Số điện thoại của cha học sinh" name="dien_thoai_bo" required
                                        value="<?php echo $item[0]['dien_thoai_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nghề nghiệp cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nghe_nhiep_bo"
                                        placeholder="Nghề nghiệp của cha học sinh" name="nghe_nghiep_bo" required
                                        value="<?php echo $item[0]['nghe_nghiep_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ tên người đỡ đầu</label>
                                    <input type="text" class="form-control" id="ten_do_dau"
                                        placeholder="Họ và tên người đỡ đầu học sinh" name="ten_do_dau"
                                        value="<?php echo $item[0]['ten_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Năm sinh  người đỡ đầu</label>
                                    <input type="text" class="form-control" id="nam_sinh_do_dau"
                                        placeholder="Năm sinh của người đỡ đầu học sinh" name="nam_sinh_do_dau"
                                        value="<?php echo $item[0]['nam_sinh_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số CMND/CCCD  người đỡ đầu</label>
                                    <input type="text" class="form-control" id="cmnd_do_dau"
                                        placeholder="Số CMND hoặc số CCCD của người đỡ đầu học sinh" name="cmnd_do_dau"
                                        value="<?php echo $item[0]['cmnd_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại  người đỡ đầu</label>
                                    <input type="text" class="form-control" id="dien_thoai_do_dau"
                                        placeholder="Số điện thoại của người đỡ đầu học sinh" name="dien_thoai_do_dau"
                                        value="<?php echo $item[0]['dien_thoai_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nghề nghiệp của người đỡ đầu</label>
                                    <input type="text" class="form-control" id="nghe_nghiep_do_dau"
                                        placeholder="Nghề nghiệp của người đỡ đầu học sinh" name="nghe_nghiep_do_dau"
                                        value="<?php echo $item[0]['nghe_nghiep_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại liên hệ <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="dien_thoai"
                                        placeholder="Số điện thoại liên hệ" name="dien_thoai" required
                                        value="<?php echo $item[0]['dien_thoai'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="email"
                                        placeholder="Email nhận kết quả tuyển sinh" name="email" required
                                        value="<?php echo $item[0]['email'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/tuyensinh' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>