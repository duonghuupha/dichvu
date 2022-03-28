$(function(){
    $('#list_vanbandi').load(baseUrl + '/vanban/content_vbdi?urlline='+str_url);
    $('#danhmuc_id').select2(); $('#danhmuc_id').load(baseUrl + '/other/combo_vanban_dm?truonghocid='+truonghocid);
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#hienthi').hide(); $('#cate_id').select2();
    $('#cate_id').load(baseUrl + '/other/combo_content_dm?truonghocid='+truonghocid);
    $('#online').on('ifChecked', function (event){
        $('#hienthi').show(500);
    });
    $('#online').on('ifUnchecked', function (event) {
        $('#hienthi').hide(500);
    });
});

function add_vanbandi(){
    window.location.href = baseUrl + '/vanban/formaddvanbandi'
}

function edit_vanbandi(idh){
    window.location.href = baseUrl + '/vanban/formeditvanbandi?id='+idh;
}

function save(){
    var id = $('#id').val();
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        if(id == 0){
            save_form_reject('#fm', baseUrl + '/vanban/add_vbdi', baseUrl + '/vanban/vanbandi');
        }else{
            save_form_reject('#fm', baseUrl + '/vanban/update_vbdi', baseUrl + '/vanban/vanbandi');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}


function del_vanbandi(idh){
    del_data_refresh_div(idh, baseUrl + '/vanban/del_vbdi', '#list_vanbandi', baseUrl + '/vanban/content_vbdi?urlline='+str_url);
}

function view_page_vanbandi(pages){
    $('#list_vanbandi').load(baseUrl + '/vanban/content_vbdi?urlline='+str_url+'&page='+pages);
}

function ValidateFileSize(file){
    var FileSize = file.files[0].size / 1024 / 1024; // in MiB
    if(FileSize > 32){
        toastr.error("File đính kèm của bạn đã quá dung lượng, vui lòng tải lại file khác");
        $(file).val(null); $('#tenfile').text('');
        return false;
    }else{
        $('#tenfile').text($(file).val());
        return true;
    }
}
