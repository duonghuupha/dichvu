$(function(){
    $('#danhmucthietbi').load(baseUrl + '/danhmucthietbi/content');
});

function add_danhmuc(){
    $('#danhmuctb').modal('show');
    $('#id').val(0); $('#title').val('');
}

function edit_danhmuc(idh){
    var title = $('#danhmuc_'+idh).text();
    $('#danhmuctb').modal('show');
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
            save_form_refresh_div('#fm', baseUrl + '/danhmucthietbi/add', '#danhmucthietbi', baseUrl + '/danhmucthietbi/content', '#danhmuctb');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/danhmucthietbi/update', '#danhmucthietbi', baseUrl + '/danhmucthietbi/content', '#danhmuctb');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function del_danhmuc(idh){
    del_data(idh, baseUrl + '/danhmucthietbi/del');
}

function view_page_danhmuc(pages){
    $('#danhmucthietbi').load(baseUrl + '/danhmucthietbi/content?page='+pages);
}
