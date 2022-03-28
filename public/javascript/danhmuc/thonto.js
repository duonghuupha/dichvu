var page = 1; var keyword = '';
$(function(){
    $('#noidung').load(baseUrl + '/thonto/content?page='+page+'&q='+keyword);
    $('#thanhpho_id').select2(); $('#quan_id').select2(); $('#phuong_id').select2();
});

function add(){
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho');
    $('#thonto').modal('show');
    $('#id').val(0); $('#title').val(''); $('#ma_thon_to').val('');
}

function edit(idh){
    var mathanhpho = $('#mathanhpho_'+idh).text(); var maquanuyen = $('#maquanhuyen_'+idh).text();
    var maxaphuong = $('#maxaphuong_'+idh).text(); var thanhphoid = $('#thanhphoid_'+idh).text();
    var quanhuyenid = $('#quanhuyenid_'+idh).text();
    var mathonto = $('#mathonto_'+idh).text();
    var title = $('#title_'+idh).text();
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho?code='+mathanhpho);
    $('#quan_id').load(baseUrl + '/other/combo_quanhuyen?idh='+thanhphoid+'&code='+maquanuyen);
    $('#phuong_id').load(baseUrl + '/other/combo_xaphuong?idh='+quanhuyenid+'&code='+maxaphuong);
    $('#thonto').modal('show');
    $('#id').val(idh); $('#title').val(title); $('#ma_thon_to').val(mathonto);
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/thonto/del', '#noidung', baseUrl + '/thonto/content?page='+page+'&q='+keyword);
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
            save_form_refresh_div('#fm', baseUrl + '/thonto/add', '#noidung', baseUrl + '/thonto/content?page='+page+'&q='+keyword, '#thonto');    
        }else{
            save_form_refresh_div('#fm', baseUrl + '/thonto/update', '#noidung', baseUrl + '/thonto/content?page='+page+'&q='+keyword, '#thonto');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_thonto(pages){
    page = pages;
    $('#noidung').load(baseUrl + '/thonto/content?page='+page+'&q='+keyword);
}

function set_quan_huyen(value){
    $('#quan_id').load(baseUrl + '/other/combo_quanhuyen?idh='+value);
}

function set_xa_phuong(value){
    $('#phuong_id').load(baseUrl + '/other/combo_xaphuong?idh='+value);
}

function sear(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#noidung').load(baseUrl + '/thonto/content?page='+page+'&q='+keyword);
    }else{
        tukhoa = '';
        $('#noidung').load(baseUrl + '/thonto/content?page='+page+'&q='+keyword);
    }
}