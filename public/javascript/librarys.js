$(function(){
    $('#notify').hide(); $('#doi').hide();
    if(namhocid == 0 && truonghocid != 0){
        $('#namhocactive_id').select2();
        $('#namhocactive_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid);
        $('#namhocactive').modal('show');
    }
});

function login(){
    var username = $('#username').val(); var password = $('#password').val();
    if(username.length == 0 || password.length == 0){
        toastr.error("Bạn chưa nhập đủ thông tin");
        return false;
    }else{
        var data_str = "username="+username+"&password="+btoa(password);
        $.ajax({
            type: "POST",
            url: baseUrl + '/index/do_login',
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    window.location.href = baseUrl + '/index'
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function login_s(){
    var truonghoc = $('#truonghoc_id').val();
    var username = $('#username').val(); var password = $('#password').val();
    if(truonghoc.length == 0 || username.length == 0 || password.length == 0){
        toastr.error("Bạn chưa nhập đủ thông tin");
        return false;
    }else{
        var data_str = "truonghoc_id="+truonghoc+"&username="+username+"&password="+btoa(password);
        $.ajax({
            type: "POST",
            url: baseUrl + '/index/do_login_s',
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    window.location.href = baseUrl + '/index'
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function taikhoan(idh){
    $.ajax({
        type: "POST",
        url: baseUrl + '/nguoidung/info_tk',
        data: "id="+idh, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('#id_tk').val(idh);
                $('#ten_hien_thi').val(result.fullname);
                $('#nhiem_vu').val(result.nhiemvu);
                $('#avatarold').val(result.avatar);
                $('#taikhoan').modal('show');
            }else{
                toastr.error(result.msg);
                return false;
            }
        }
    });
}

function save_tk(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        save_form_reject('#fm_taikhoan', baseUrl + '/nguoidung/update_tk', baseUrl + '/index/logout');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function save_namhocactive(){
    var namhoc = $('#namhocactive_id').val();
    if(namhoc.length == 0){
        toastr.error("Bạn chưa chọn dữ liệu");
        return false;
    }else{
        save_form_reject('#fm_namhocactive', baseUrl + '/namhoc/active_namhoc', baseUrl + '/index/logout');
    }
}

function forgot_pass(){
    toastr.info("Bạn quên mật khẩu, hãy liên hệ với đơn vị cung cấp dịch vụ để được hỗ trợ");
}
////////////////////////////////////////////////////////////////////////////////////////////////

function save_form(id_form, url_post){
    $('#doi').show();
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('#doi').hide();
                toastr.success(result.msg);
                location.reload(true);
            }else{
                $('#doi').hide();
                toastr.error(result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_reject(id_form, url_post, url_reject){
    $('#doi').show();
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                window.location.href = url_reject;
            }else{
                $('#doi').hide();
                toastr.error(result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_refresh_div(id_form, url_post, id_div, url_refresh, id_modal){
    $('#doi').show();
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('#doi').hide();
                toastr.success(result.msg);
                $(id_modal).modal('hide');
                $(id_div).load(url_refresh);
            }else{
                $('#doi').hide();
                toastr.error(result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_refresh_div_no_modal(id_form, url_post, id_div, url_refresh){
    $('#doi').show();
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('#doi').hide();
                reset_form(id_form);
                $(id_div).load(url_refresh);
            }else{
                $('#doi').hide();
                toastr.error(result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function del_data(id_index, url_data){
    var r = confirm("Bạn có chắc chán muốn xóa dữ liệu!");
    if (r == true) {
        $('#doi').show();
        var data_str = "id="+id_index;
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('#doi').hide();
                    location.reload(true);
                }else{
                    $('#doi').hide();
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function del_data_refresh_div(id_index, url_data, id_div, url_refresh){
    var r = confirm("Bạn có chắc chán muốn xóa dữ liệu!");
    if (r == true) {
        $('#doi').show();
        var data_str = "id="+id_index;
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('#doi').hide();
                    toastr.success(result.msg);
                    $(id_div).load(url_refresh);
                }else{
                    $('#doi').hide();
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function update_status(data_str, url_data, id_div, url_refresh, notify){
    var r = confirm(notify);
    if (r == true) {
        $('#doi').show();
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('#doi').hide();
                    toastr.success(result.msg);
                    $(id_div).load(url_refresh);
                }else{
                    $('#doi').hide();
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function update_status_reload(data_str, url_data, notify){
    var r = confirm(notify);
    if (r == true) {
        $('#doi').show();
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    $('#doi').hide();
                    toastr.success(result.msg);
                    location.reload(true);
                }else{
                    $('#doi').hide();
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function reset_form(id_form){
    $(id_form)[0].reset();
}

function check_image_ext(text){
    if(text != ''){
        if(text.match(/jpg.*/) || text.match(/jpeg.*/) || text.match(/png.*/) || text.match(/gif.*/)){
            return true;
        }else{
            return false;
        }
    }else{
        return true;
    }
}

function check_file_ext(text){
    if(text != ''){
        if(text.match(/zip.*/)){
            return true;
        }else{
            return false;
        }
    }else{
        return true;
    }
}

function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumber(input_val);
        input_val = input_val;
        if (blur === "blur") {
            input_val += "";
        }
    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function CurrencyFormatted(amount){
	return amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}
