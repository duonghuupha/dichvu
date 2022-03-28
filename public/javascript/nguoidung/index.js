$(function(){
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('#noidung').load(baseUrl + '/nguoidung/content');
    $('#truonghoc_id').select2();
    if(truonghocid != 0){
        $('#truonghoc_id').load(baseUrl + '/other/combo_truonghoc?id='+truonghocid);
        $('#truonghoc_id').attr('disabled', 'disabled');
    }else{
        $('#truonghoc_id').load(baseUrl + '/other/combo_truonghoc');
    }
    $('#resetpass').hide();
});

function add_users(){
    //window.location.href = baseUrl + '/nguoidung/formadd';
    $('#nguoidung').modal('show');
    $('#id').val(0); $('#fullname').val(''); $('#username').val(''); $('#password').val('');
    $('#repass').val(''); $('#job').val(''); $('#active').attr('checked', false);
    $('#avatar').val(''); $('#cccd').val('');
}

function edit_nguoidung(idh){
    window.location.href = baseUrl + '/nguoidung/formedit?id='+idh;
}

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var id = $('#id').val();
        if(id == 0){
            save_form_refresh_div('#fm', baseUrl + '/nguoidung/add', '#noidung', baseUrl + '/nguoidung/content', '#nguoidung');
        }else{
            save_form_reject('#fm', baseUrl + '/nguoidung/update', baseUrl + '/nguoidung');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function del_nguoidung(idh){
    del_data(idh, baseUrl + '/nguoidung/del');
}

function view_page_nguoidung(pages){
    $('#noidung').load(baseUrl + '/nguoidung/content?page='+pages);
}

function phanquyen_nguoidung(idh){
    window.location.href = baseUrl + '/nguoidung/phanquyen?id='+idh;
}

function save_roles(){
    var roles = $('#roles').val();
    if(roles.length > 0){
        save_form('#fm', baseUrl + '/nguoidung/update_roles');
    }else{
        toastr.error('Bạn chưa chọn quyền cho người dùng');
    }
}

function reset_pass(idh){
    var data_str = "id="+idh;
    $.ajax({
        type: "POST",
        url: baseUrl + '/nguoidung/repass',
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                toastr.success(result.msg);
                $('#resetpass').html(result.noti);
                $('#resetpass').show(200);
                setInterval(() => $('#resetpass').hide(200), 5000);
            }else{
                toastr.error(result.msg);
                return false;
            }
        }
    });
}

function copy_roles(){
    window.location.href = baseUrl + '/nguoidung/copyroles';
}

function export_file(){
    window.location.href = baseUrl + '/nguoidung/export';
}
