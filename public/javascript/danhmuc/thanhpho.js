var page = 1; var keyword = '';
$(function(){
    $('#noidung').load(baseUrl + '/thanhpho/content?page='+page+'&q='+keyword);
});

function add(){
    $('#thanhpho').modal('show');
    $('#id').val(0); $('#title').val(''); $('#ma_thanh_pho').val('');
}

function edit(idh){
    var mathanhpho = $('#mathanhpho_'+idh).text();
    var title = $('#title_'+idh).text();
    $('#thanhpho').modal('show');
    $('#id').val(idh); $('#title').val(title); $('#ma_thanh_pho').val(mathanhpho);
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/thanhpho/del', '#noidung', baseUrl + '/thanhpho/content?page='+page+'&q='+keyword);
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
            save_form_refresh_div('#fm', baseUrl + '/thanhpho/add', '#noidung', baseUrl + '/thanhpho/content?page='+page+'&q='+keyword, '#thanhpho');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/thanhpho/update', '#noidung', baseUrl + '/thanhpho/content?page='+page+'&q='+keyword, '#thanhpho');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_thanhpho(pages){
    page = pages;
    $('#noidung').load(baseUrl + '/thanhpho/content?page='+page+'&q='+keyword);
}

function sear(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#noidung').load(baseUrl + '/thanhpho/content?page='+page+'&q='+keyword);
    }else{
        tukhoa = '';
        $('#noidung').load(baseUrl + '/thanhpho/content?page='+page+'&q='+keyword);
    }
}