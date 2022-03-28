$(function(){
    $('#list_danhmuc').load(baseUrl + '/vanban/content_dm');
});
function add_danhmuc(){
    $('#id').val(0); $('#title').val('');
    $('#danhmuc').modal('show');
}

function edit_danhmuc(idh){
    $('#id').val(idh);
    var title = $('#danhmuc_'+idh).text();
    $('#title').val(title);
    $('#danhmuc').modal('show');
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
            save_form_refresh_div('#fm', baseUrl + '/vanban/add_dm', '#list_danhmuc', baseUrl + '/vanban/content_dm', '#danhmuc');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/vanban/update_dm', '#list_danhmuc', baseUrl + '/vanban/content_dm', '#danhmuc');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function del_danhmuc(idh){
    del_data_refresh_div(idh, baseUrl + '/vanban/del_dm', '#list_danhmuc', baseUrl + '/vanban/content_dm');
}

function view_page_danhmuc(pages){
    $('#noidung').load(baseUrl + '/vanban/content_dm?page='+pages);
}
