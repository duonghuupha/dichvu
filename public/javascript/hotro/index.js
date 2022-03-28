$(function() {
    $('#noidung').load(baseUrl + '/hotro/content');
    $('#dichvu_id').select2(); $('#kieudichvu_id').select2();
    $('#duyetyeucau').load(baseUrl + '/hotro/contentd');
    $('#yeucaunhan').load(baseUrl + '/hotro/contenty');
    $('#user_pro').select2(); $('#phongban_id').select2(); $('#thietbi_id').select2();
    $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+truonghocid+'&namhocid='+namhocid);
    $('#truonghoc_id').select2(); $('#truonghoc_id').load(baseUrl + '/other/combo_truonghoc');
    $("input[data-type='currency']").on({
        keyup: function() {
          formatCurrency($(this));
        },
        blur: function() { 
          formatCurrency($(this), "blur");
        }
    });
});

function load_danhmuc() {
    var dichvu = $('#dichvu_id').val();
    var kieudichvu = $('#kieudichvu_id').val();
    if (dichvu == 0 || kieudichvu == 0) {
        toastr.error('Bạn chưa điền đủ thông tin');
    } else {
        $('#danhmuc').load(baseUrl + '/hotro/contentdm?dichvu_id=' + dichvu + '&kieudichvu_id=' + kieudichvu);
    }
}

function save() {
    var required = $('input,textarea,select').filter('[required]:visible');
    var radioValue = $("input[name='hotro_id']:checked").val();
    var allRequired = true;
    required.each(function() {
        if ($(this).val() == '') {
            allRequired = false;
        }
    });
    if (allRequired && radioValue && radioValue.length != 0) {
        if (!isNaN($('#sodienthoai').val()) && $('#sodienthoai').val().length == 10) {
            if ($('#image').val().length > 0) {
                var nameImage = $("#image").val();
                if (nameImage.match(/jpg.*/) || nameImage.match(/jpeg.*/) || nameImage.match(/png.*/) ||
                    nameImage.match(/gif.*/)) {
                    $('#danhmuc_id').val(radioValue);
                    save_form_reject('#fm', baseUrl + '/hotro/add', baseUrl + '/hotro/yeucaudagui');
                } else {
                    toastr.error('ĐỊnh dạng file đính kèm chưa chính xác');
                }
            } else {
                $('#danhmuc_id').val(radioValue);
                save_form_reject('#fm', baseUrl + '/hotro/add', baseUrl + '/hotro/yeucaudagui');
            }
        } else {
            toastr.error('ĐỊnh dạng số điện thoại chưa chính xác');
        }
    } else {
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function duyet_yeucau(idh) {
    var r = confirm("Bạn có chắc chắn muốn duyệt yêu cầu!");
    if (r == true) {
        var data_str = "id=" + idh;
        $.ajax({
            type: "POST",
            url: baseUrl + '/hotro/change',
            data: data_str, // serializes the form's elements.
            success: function(data) {
                var result = JSON.parse(data);
                if (result.success == true) {
                    window.location.href = baseUrl + '/hotro/yeucaudagui';
                } else {
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function tiepnhan_yeucau(idh) {
    $('#user_pro').load(baseUrl + '/other/combo_nguoidung?id=0');
    $('#id').val(idh);
    $('#tiepnhan').modal('show');
}

function save_tiepnhan() {
    var thoigian = $('#thoi_gian').val();
    if (thoigian.length == 0) {
        toastr.error("Bạn chưa nhập đủ thông tin");
        return false;
    } else {
        $('#doi').show();
        save_form('#fm_tiepnhan', baseUrl + '/hotro/tiepnhan');
    }
}

function save_phanhoi(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function() {
        if ($(this).val() == '') {
            allRequired = false;
        }
    });
    if (allRequired){
        save_form('#fm_phanhoi', baseUrl + '/hotro/phanhoi');
    }else{
        toastr.error("Bạn chưa nhập đủ thông tin");
        return false;
    }
}

function hoan_thanh(idh){
    var r = confirm("Bạn có chắc chắn muốn kết thúc quá trình xử lý!");
    if (r == true) {
        /**/
        window.location.href = baseUrl + '/hotro/kydientu?id='+idh;
    }
}

function set_data_combo(){
    var id = $('#phongban_id').val();
    $('#thietbi_id').load(baseUrl + '/hotro/combo_thietbi?id='+id);
}

function set_data_phongban(){
    var id = $('#truonghoc_id').val();
    // lay ra id nam hoc dang active
    $.ajax({
        type: "POST",
        url: baseUrl + '/other/namhocact',
        data: "id="+id, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                //location.reload(true);
                $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+id+'&namhocid='+result.id);
            }else{
                toastr.error(result.msg);
                $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid=0&namhocid=0');
                $('#thietbi_id').load(baseUrl + '/hotro/combo_thietbi?id=0');
                return false;
            }
        }
    });
    $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+id);
}