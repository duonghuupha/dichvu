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
        $('#tttt').html('Th??n / t??? th?????ng tr?? <i style="color:red">(*)</i>');
    }else{
        $('#thon_thuong_tru').removeAttr("required");
        $('#tttt').html('Th??n / t??? th?????ng tr??</i>');
    }
    var b = xaphuong.indexOf('<?php echo $item[0]['xa_hien_tai'] ?>');
    if(b !== -1){
        $('#thon_hien_tai').attr("required", 'required');
        $('#ttct').html('Th??n / t??? c?? tr?? <i style="color:red">(*)</i>');
    }else{
        $('#thon_hien_tai').removeAttr("required");
        $('#ttct').html('Th??n / t??? c?? tr??</i>');
    }
});
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            C???p nh???t th??ng tin tuy???n sinh
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
                                    <label for="exampleInputEmail1">N??m h???c <i style="color:red">(*)</i></label>
                                    <select class="form-control" id="nam_hoc_id" style="width:100%"
                                        placeholder="N??m h???c tuy???n sinh" name="nam_hoc_id" required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">M?? TS <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="M?? h??? s?? tuy???n sinh" name="code" required
                                        value="<?php echo $item[0]['code'] ?>" readonly=""/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">H??? v?? t??n h???c sinh <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ho_ten"
                                        placeholder="H??? v?? t??n h???c sinh" name="ho_ten" required
                                        value="<?php echo $item[0]['ho_ten'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ng??y sinh <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ngay_sinh"
                                        placeholder="Ng??y sinh" name="ngay_sinh" required
                                        value="<?php echo date("d-m-Y", strtotime($item[0]['ngay_sinh'])) ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">N???i sinh <i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n t???nh/ TP"
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
                                    <label for="exampleInputEmail1">Gi???i t??nh <i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n gi???i t??nh"
                                    style="width: 100%;" id="gioi_tinh" name="gioi_tinh" required>
                                        <option value="1">Nam</option>
                                        <option value="2">N???</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">D??n t???c <i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n d??n t???c"
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
                                    <label for="exampleInputEmail1">?????i t?????ng ch??nh s??ch</label>
                                    <input type="text" class="form-control" id="doi_tuong_chinh_sach"
                                        placeholder="?????i t?????ng ch??nh s??ch" name="doi_tuong_chinh_sach"
                                        value="<?php echo $item[0]['doi_tuong_chinh_sach'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">H???c sinh khuy???t t???t</label>
                                    <input type="text" class="form-control" id="hoc_sinh_khuyet_tat"
                                        placeholder="H???c sinh khuy???t t???t" name="hoc_sinh_khuyet_tat"
                                        value="<?php echo $item[0]['hoc_sinh_khuyet_tat'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lo???i khuy???t t???t</label>
                                    <input type="text" class="form-control" id="loai_khuyet_tat"
                                        placeholder="Lo???i khuy???t t???t" name="loai_khuyet_tat"
                                        value="<?php echo $item[0]['loai_khuyet_tat'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">T??nh tr???ng s???c kh???e</label>
                                    <input type="text" class="form-control" id="tinh_trang_suc_khoe"
                                        placeholder="T??nh tr???ng s???c kh???e" name="tinh_trang_suc_khoe"
                                        value="<?php echo $item[0]['tinh_trang_suc_khoe'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">L???p mu???n v??o <i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n l???p h???c"
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
                                    <label for="exampleInputEmail1">T???nh / Th??nh ph??? th?????ng tr??<i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n t???nh/TP"
                                    style="width: 100%;" id="tinh_thuong_tru" name="tinh_thuong_tru" required
                                    onchange="set_quan_huyen(1)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Qu???n / Huy???n th?????ng tr??<i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n qu???n/huy???n"
                                    style="width: 100%;" id="huyen_thuong_tru" name="huyen_thuong_tru" required
                                    onchange="set_xa_phuong(1)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">X?? / Ph?????ng th?????ng tr??<i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n x?? / ph?????ng"
                                    style="width: 100%;" id="xa_thuong_tru" name="xa_thuong_tru" required
                                    onchange="set_thon_to(1)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="tttt">Th??n / t??? th?????ng tr??</label>
                                    <select class="form-control" data-placeholder="L???a ch???n th??n/t???"
                                    style="width: 100%;" id="thon_thuong_tru" name="thon_thuong_tru">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? nh?? / t??n ???????ng</label>
                                    <input type="text" class="form-control" id="to_thuong_tru"
                                        placeholder="S??? nh??/t??n ???????ng" name="to_thuong_tru"
                                        value="<?php echo $item[0]['to_thuong_tru'] ?>"/>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">T???nh / Th??nh ph??? c?? tr??<i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n t???nh/TP"
                                    style="width: 100%;" id="tinh_hien_tai" name="tinh_hien_tai" required
                                    onchange="set_quan_huyen(2)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Qu???n / Huy???n c?? tr??<i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n qu???n/huy???n"
                                    style="width: 100%;" id="huyen_hien_tai" name="huyen_hien_tai" required
                                    onchange="set_xa_phuong(2)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">X?? / Ph?????ng c?? tr??<i style="color:red">(*)</i></label>
                                    <select class="form-control" data-placeholder="L???a ch???n x?? / ph?????ng"
                                    style="width: 100%;" id="xa_hien_tai" name="xa_hien_tai" required
                                    onchange="set_thon_to(2)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="ttct">Th??n / t??? c?? tr??</label>
                                    <select class="form-control" data-placeholder="L???a ch???n th??n/t???"
                                    style="width: 100%;" id="thon_hien_tai" name="thon_hien_tai">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? nh?? / t??n ???????ng</label>
                                    <input type="text" class="form-control" id="to_hien_tai"
                                        placeholder="S??? nh??/t??n ???????ng" name="to_hien_tai"
                                        value="<?php echo $item[0]['to_hien_tai'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">H??? t??n m??? <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ten_me"
                                        placeholder="H??? v?? t??n m??? h???c sinh" name="ten_me" required
                                        value="<?php echo $item[0]['ten_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">N??m sinh m??? <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nam_sinh_me"
                                        placeholder="N??m sinh c???a m??? h???c sinh" name="nam_sinh_me" required
                                        value="<?php echo $item[0]['nam_sinh_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? CMND/CCCD m??? <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="cmnd_me"
                                        placeholder="S??? CMND ho???c s??? CCCD c???a m??? h???c sinh" name="cmnd_me" required
                                        value="<?php echo $item[0]['cmnd_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">??i???n tho???i m??? <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="dien_thoai_me"
                                        placeholder="??i???n tho???i c???a m??? h???c sinh" name="dien_thoai_me" required
                                        value="<?php echo $item[0]['dien_thoai_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngh??? nghi???p m??? <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nghe_nghiep_me"
                                        placeholder="Ngh??? nghi???p c???a m??? h???c sinh" name="nghe_nghiep_me" required
                                        value="<?php echo $item[0]['nghe_nghiep_me'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">H??? t??n cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="ten_bo"
                                        placeholder="H??? v?? t??n cha h???c sinh" name="ten_bo" required
                                        value="<?php echo $item[0]['ten_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">N??m sinh cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nam_sinh_bo"
                                        placeholder="N??m sinh c???a cha h???c sinh" name="nam_sinh_bo" required
                                        value="<?php echo $item[0]['nam_sinh_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? CMND/CCCD cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="cmnd_bo"
                                        placeholder="S??? CMND ho???c s??? CCCD c???a cha h???c sinh" name="cmnd_bo" required
                                        value="<?php echo $item[0]['cmnd_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">??i???n tho???i cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="dien_thoai_bo"
                                        placeholder="S??? ??i???n tho???i c???a cha h???c sinh" name="dien_thoai_bo" required
                                        value="<?php echo $item[0]['dien_thoai_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngh??? nghi???p cha <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="nghe_nhiep_bo"
                                        placeholder="Ngh??? nghi???p c???a cha h???c sinh" name="nghe_nghiep_bo" required
                                        value="<?php echo $item[0]['nghe_nghiep_bo'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">H??? t??n ng?????i ????? ?????u</label>
                                    <input type="text" class="form-control" id="ten_do_dau"
                                        placeholder="H??? v?? t??n ng?????i ????? ?????u h???c sinh" name="ten_do_dau"
                                        value="<?php echo $item[0]['ten_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">N??m sinh  ng?????i ????? ?????u</label>
                                    <input type="text" class="form-control" id="nam_sinh_do_dau"
                                        placeholder="N??m sinh c???a ng?????i ????? ?????u h???c sinh" name="nam_sinh_do_dau"
                                        value="<?php echo $item[0]['nam_sinh_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? CMND/CCCD  ng?????i ????? ?????u</label>
                                    <input type="text" class="form-control" id="cmnd_do_dau"
                                        placeholder="S??? CMND ho???c s??? CCCD c???a ng?????i ????? ?????u h???c sinh" name="cmnd_do_dau"
                                        value="<?php echo $item[0]['cmnd_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">??i???n tho???i  ng?????i ????? ?????u</label>
                                    <input type="text" class="form-control" id="dien_thoai_do_dau"
                                        placeholder="S??? ??i???n tho???i c???a ng?????i ????? ?????u h???c sinh" name="dien_thoai_do_dau"
                                        value="<?php echo $item[0]['dien_thoai_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngh??? nghi???p c???a ng?????i ????? ?????u</label>
                                    <input type="text" class="form-control" id="nghe_nghiep_do_dau"
                                        placeholder="Ngh??? nghi???p c???a ng?????i ????? ?????u h???c sinh" name="nghe_nghiep_do_dau"
                                        value="<?php echo $item[0]['nghe_nghiep_do_dau'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? ??i???n tho???i li??n h??? <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="dien_thoai"
                                        placeholder="S??? ??i???n tho???i li??n h???" name="dien_thoai" required
                                        value="<?php echo $item[0]['dien_thoai'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email <i style="color:red">(*)</i></label>
                                    <input type="text" class="form-control" id="email"
                                        placeholder="Email nh???n k???t qu??? tuy???n sinh" name="email" required
                                        value="<?php echo $item[0]['email'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">C???p nh???t</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/tuyensinh' ?>'">H???y b???</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>