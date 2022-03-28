var page = 1; var keyword = '';
$(function(){
    $('#noidung').load(baseUrl + '/xaphuong/content?page='+page+'&q='+keyword);
    $('#thanhpho_id').select2(); $('#quan_id').select2();
});

function add(){
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho');
    $('#xaphuong').modal('show');
    $('#id').val(0); $('#title').val(''); $('#ma_thanh_pho').val('');
}

function edit(idh){
    var mathanhpho = $('#mathanhpho_'+idh).text();
    var maquanhuyen = $('#maquanhuyen_'+idh).text();
    var maxaphuong = $('#maxaphuong_'+idh).text();
    var title = $('#title_'+idh).text();
    var thanhphoid = $('#thanhphoid_'+idh).text();
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho?code='+mathanhpho);
    $('#quan_id').load(baseUrl + '/other/combo_quanhuyen?idh='+thanhphoid+'&code='+maquanhuyen);
    $('#xaphuong').modal('show');
    $('#id').val(idh); $('#title').val(title); $('#ma_xa_phuong').val(maxaphuong);
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/xaphuong/del', '#noidung', baseUrl + '/xaphuong/content?page='+page+'&q='+keyword);
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
            save_form_refresh_div('#fm', baseUrl + '/xaphuong/add', '#noidung', baseUrl + '/xaphuong/content?page='+page+'&q='+keyword, '#xaphuong');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/xaphuong/update', '#noidung', baseUrl + '/xaphuong/content?page='+page+'&q='+keyword, '#xaphuong');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_xaphuong(pages){
    page = pages;
    $('#noidung').load(baseUrl + '/xaphuong/content?page='+page+'&q='+keyword);
}

function set_quan_huyen(value){
    $('#quan_id').load(baseUrl + '/other/combo_quanhuyen?idh='+value);
}

function sear(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#noidung').load(baseUrl + '/xaphuong/content?page='+page+'&q='+keyword);
    }else{
        tukhoa = '';
        $('#noidung').load(baseUrl + '/xaphuong/content?page='+page+'&q='+keyword);
    }
}