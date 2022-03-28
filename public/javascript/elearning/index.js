var page = 1; var tukhoa = '';
$(function(){
    $('#list_elearning').load(baseUrl + '/elearning/content?page='+page+'&q='+tukhoa);
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('#exam_id').select2(); $('#exam_id').load(baseUrl + '/other/combo_exam?truonghocid='+truonghocid);
    $('[data-toggle="tooltip"]').tooltip();
    $('#nhomdulieu').select2(); $('#tacgia').select2();
})

function add(){
    $('#ise').show(); $('#dinhkem').show();
    $('#elearning').modal('show');
    $('#exam_id').val(null).trigger('change'); $('#linh_vuc').val('');
    $('#de_tai').val(''); $("input[name=is_e]").iCheck('uncheck');
    $('#file').val('');
}

function edit(idh){
    $('#ise').hide(); $('#dinhkem').hide(); $('#id').val(idh);
    $('#linh_vuc').val($('#linhvuc_'+idh).text()); $('#de_tai').val($('#detai_'+idh).text());
    $('#exam_id').val($('#examid_'+idh).text()).trigger('change'); $('#elearning').modal('show');
}

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var checked = $("#is_e").parent('[class*="icheckbox"]').hasClass("checked");
    var allRequired = true; var fileRequire = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(checked == true){
        if(check_file_ext($('#file').val())){
            fileRequire = true;
        }else{
            fileRequire = false;
        }
    }else{
        fileRequire = true
    }
    if(allRequired && fileRequire){
        var id = $('#id').val();
        if(id == 0){
            save_form_refresh_div('#fm_elearning', baseUrl + '/elearning/add', '#list_elearning', baseUrl + '/elearning/content', '#elearning');
        }else{
            save_form_refresh_div('#fm_elearning', baseUrl + '/elearning/update', '#list_elearning', baseUrl + '/elearning/content?page='+page+'&q='+tukhoa, '#elearning');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin, hoặc file không đúng định dạng');
    }
}

function edit_file(idh){
    $('#id_e').val(idh); $('#file_e').val('');
    $("input[name=is_elearning]").iCheck('uncheck');
    $('#File_E').modal('show');
}

function save_file(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var checked = $("#is_elearning").parent('[class*="icheckbox"]').hasClass("checked");
    var allRequired = true; var fileRequire = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(checked == true){
        if(check_file_ext($('#file_e').val())){
            fileRequire = true;
        }else{
            fileRequire = false;
        }
    }else{
        fileRequire = true
    }
    if(allRequired && fileRequire){
        save_form_refresh_div('#fm_file', baseUrl + '/elearning/update_file', '#list_elearning', baseUrl + '/elearning/content?page='+page+'&q='+tukhoa, '#File_E');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin, hoặc file không đúng định dạng');
    }
}

function preview_img(file){
    var text = $(file).val();
    if(text.match(/jpg.*/) || text.match(/jpeg.*/) || text.match(/png.*/) || text.match(/gif.*/)){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#image_src').attr('src', e.target.result);
        }
        reader.readAsDataURL(file.files[0]); $('#btn-xoaanh').show(100);
    }else{
        $(file).val(null);
        toastr.error("Định dạng file hình ảnh không chính xác");
    }
}

function search(){
    var value = $('#table_search').val();
    if(value.length != 0){
        tukhoa = value.replaceAll(" ", "$", 'g');
        $('#list_elearning').load(baseUrl + '/elearning/content?page='+page+'&q='+tukhoa);
    }else{
        tukhoa = '';
        $('#list_elearning').load(baseUrl + '/elearning/content?page='+page+'&q='+tukhoa);
    }
}

function view_page_elearning(pages){
    page = pages;
    $('#list_elearning').load(baseUrl + '/elearning/content?page='+page+'&q='+tukhoa);
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/elearning/del', '#list_elearning', baseUrl + '/elearning/content?page='+page+'&q='+tukhoa);
}

function duyet(idh){
    var data_str = "id="+idh;
    update_status(data_str, baseUrl + '/elearning/change', '#list_elearning', baseUrl + '/elearning/content?page='+page+'&q='+tukhoa, "Bạn có chắc chắn muốn công khai tài nguyên này");
}

function lua_chon(){
    $('#tacgia').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid);
    $('#nhomdulieu').load(baseUrl + '/other/combo_exam?truonghocid='+truonghocid+'&s=1');
    $('#Export').modal('show');
}

function export_file(){
    var nhomdulieu = $('#nhomdulieu').val(); var tacgia = $('#tacgia').val();
    var linhvuc = $('#linhvuc_s').val();
    if(linhvuc.length != 0){
        var lvs = linhvuc.replaceAll(" ", "$", 'g');
    }else{
        var lvs = '';
    }
    if(tacgia.length != 0){
        var userid = btoa(tacgia.join(","));
    }else{
        var userid = '';
    }
    window.location.href = baseUrl + '/elearning/export_xls?examid='+nhomdulieu+'&userid='+userid+'&linhvuc='+lvs;
}
