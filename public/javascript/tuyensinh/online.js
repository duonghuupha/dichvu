$(function(){
    $('#nam_hoc_id').select2(); $('#noi_sinh').select2(); $('#gioi_tinh').select2();
    $('#dan_toc').select2(); $('#lop_muon_vao').select2();
    $('#noi_sinh').load(baseUrl + '/other/combo_thanhpho');
    $('#ngay_sinh').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#tinh_thuong_tru').select2(); $('#huyen_thuong_tru').select2(); $('#xa_thuong_tru').select2();
    $('#thon_thuong_tru').select2();
    $('#tinh_hien_tai').select2(); $('#huyen_hien_tai').select2(); $('#xa_hien_tai').select2();
    $('#thon_hien_tai').select2();
    $('#nam_hoc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid);
    $('#tinh_thuong_tru').load(baseUrl + '/other/combo_thanhpho');
    $('#tinh_hien_tai').load(baseUrl + '/other/combo_thanhpho');
    $('#dan_toc').load(baseUrl + '/other/combo_dantoc');
    $('#lop_muon_vao').load(baseUrl + '/other/combo_class_temp?truonghocid='+truonghocid);
});

function set_quan_huyen(type){
    if(type == 1){
        var value = $('#tinh_thuong_tru').val();
        $('#huyen_thuong_tru').load(baseUrl + '/other/combo_quanhuyen?idh='+value);
    }else{
        var value = $('#tinh_hien_tai').val();
        $('#huyen_hien_tai').load(baseUrl + '/other/combo_quanhuyen?idh='+value);
    }
}

function set_xa_phuong(type){
    if(type == 1){
        var value = $('#huyen_thuong_tru').val();
        $('#xa_thuong_tru').load(baseUrl + '/other/combo_xaphuong?idh='+value);
    }else{
        var value = $('#huyen_hien_tai').val();
        $('#xa_hien_tai').load(baseUrl + '/other/combo_xaphuong?idh='+value);
    }
}

function set_thon_to(type){
    if(type == 1){
        var value = $('#xa_thuong_tru').val();
        var a = xaphuong.indexOf(value);
        if(a !== -1){
            $('#thon_thuong_tru').attr("required", 'required');
            $('#tttt').html('Thôn / tổ thường trú <i style="color:red">(*)</i>');
        }else{
            $('#thon_thuong_tru').removeAttr("required");
            $('#tttt').html('Thôn / tổ thường trú</i>');
        }
        $('#thon_thuong_tru').load(baseUrl + '/other/combo_thonto?idh='+value);
    }else{
        var value = $('#xa_hien_tai').val();
        var a = xaphuong.indexOf(value);
        if(a !== -1){
            $('#thon_hien_tai').attr("required", 'required');
            $('#ttct').html('Thôn / tổ cư trú <i style="color:red">(*)</i>');
        }else{
            $('#thon_hien_tai').removeAttr("required");
            $('#ttct').html('Thôn / tổ cư trú</i>');
        }
        $('#thon_hien_tai').load(baseUrl + '/other/combo_thonto?idh='+value);
    }
}

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }else{
            if(!validateEmail($('#email').val())){
                allRequired = false;
            }
        }
    });
    if(allRequired){
        var r = confirm("QUý phụ huynh hãy kiểm tra lại thông tin, nếu đã chính xác click OK để xác nhận thông tin và in giấy nhập học!");
        if (r == true) {
            save_form_reject('#fm', baseUrl + '/tuyensinhonline/add', baseUrl + '/tuyensinhonline/invoice');    
        }else{
            return false;
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin hoặc định dạng email không chính xác');
    }
}