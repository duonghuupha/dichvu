var page = 1; var keyword = '';
$(function(){
    $('#list_hocsinh').load(baseUrl + '/hocsinh/content?page='+page+'&q='+keyword);
    $('#tu_lop').select2(); $('#den_lop').select2();
});

function add_hocsinh() {
    window.location.href = baseUrl + '/hocsinh/formadd';
}

function edit_hocsinh(idh){
    window.location.href = baseUrl + '/hocsinh/formedit?id='+idh;
}

function del_hocsinh(idh){
    del_data_refresh_div(idh, baseUrl + '/hocsinh/del', '#list_hocsinh', baseUrl + '/hocsinh/content?page='+page+'&q='+keyword);
}

function view_page_hocsinh(pages){
    page = pages;
    $('#list_hocsinh').load(baseUrl + '/hocsinh/content?page='+page+'&q='+keyword);
}

function search(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#list_hocsinh').load(baseUrl + '/hocsinh/content?page='+page+'&q='+keyword);
    }else{
        keyword = '';
        $('#list_hocsinh').load(baseUrl + '/hocsinh/content?page='+page+'&q='+keyword);
    }
}

function import_hocsinh(){
    window.location.href = baseUrl + '/hocsinh/import';
}

function chuyenlop(idh, lophocid){
    $('#tu_lop').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhocid+'&id='+lophocid);
    $('#den_lop').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhocid);
    $('#chuyenlop').modal('show');
    $('#id_hocsinh').val(idh);
}

function save_chuyenlop(){
    var tulop = $('#tu_lop').val(), denlop = $('#den_lop').val(), allRequired = true;
    if(denlop.length == 0){
        allRequired = false;
    }else{
        if(denlop == tulop){
            allRequired = false;
        }
    }
    if(allRequired){
        save_form_refresh_div('#fm_chuyenlop', baseUrl + '/hocsinh/chuyenlop', '#list_hocsinh', baseUrl + '/hocsinh/content?page='+page+'&q='+keyword, '#chuyenlop');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin hoặc lớp chuyển đi không được giống lớp chuyển đến');
    }
}