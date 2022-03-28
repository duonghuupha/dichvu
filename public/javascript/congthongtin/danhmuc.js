$(function(){
    $('#danhmucctt').load(baseUrl + '/congthongtin/content_dm');
});

function add_danhmuc(){
    $('#danhmuc').modal('show');
    $('#id').val(0); $('#title').val('');
}

function edit_danhmuc(idh){
    var title = $('#danhmuc_'+idh).text();
    $('#danhmuc').modal('show');
    $('#id').val(idh); $('#title').val(title);
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
            save_form_refresh_div('#fm', baseUrl + '/congthongtin/add_danhmuc', '#danhmucctt', baseUrl + '/congthongtin/content_dm', '#danhmuc');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/congthongtin/update_danhmuc', '#danhmucctt', baseUrl + '/congthongtin/content_dm', '#danhmuc');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function del_danhmuc(idh){
    del_data(idh, baseUrl + '/congthongtin/del_danhmuc');
}

function view_page_danhmuc(pages){
    $('#danhmucctt').load(baseUrl + '/congthongtin/content_dm?page='+pages);
}