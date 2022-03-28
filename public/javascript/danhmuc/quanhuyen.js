var page = 1; var keyword = '';
$(function(){
    $('#thanhpho_id').select2();
    $('#noidung').load(baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword);
});

function add(){
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho');
    $('#quanhuyen').modal('show');
    $('#id').val(0); $('#title').val(''); $('#ma_thanh_pho').val('');
}

function edit(idh){    
    var mathanhpho = $('#mathanhpho_'+idh).text();
    var maquanhuyen = $('#maquanhuyen_'+idh).text();
    var title = $('#title_'+idh).text();
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho?code='+mathanhpho);
    $('#quanhuyen').modal('show');
    $('#id').val(idh); $('#title').val(title); $('#ma_quan_huyen').val(maquanhuyen);
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/quanhuyen/del', '#noidung', baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword);
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
            save_form_refresh_div('#fm', baseUrl + '/quanhuyen/add', '#noidung', baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword, '#quanhuyen');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/quanhuyen/update', '#noidung', baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword, '#quanhuyen');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_quanhuyen(pages){
    page = pages;
    $('#noidung').load(baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword);
}

function sear(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#noidung').load(baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword);
    }else{
        tukhoa = '';
        $('#noidung').load(baseUrl + '/quanhuyen/content?page='+page+'&q='+keyword);
    }
}