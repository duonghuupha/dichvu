$(function(){
    $('#list_luanchuyen').load(baseUrl + '/luanchuyenthietbi/content');
    $('#phongban_id').select2(); $('#thietbi_id').select2(); $('#noiden_id').select2();
    $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+truonghocid+'&namhocid='+namhocid);
    $('#noiden_id').load(baseUrl + '/other/combo_phongban?truonghocid='+truonghocid+'&namhocid='+namhocid);
});

function save(){
    var phongbandi = $('#phongban_id').val(); var noidenid = $('#noiden_id').val();
    var id = $('#id').val();
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired && phongbandi != noidenid){
        if(id == 0){
            save_form('#fm', baseUrl + '/luanchuyenthietbi/add');    
        }else{
            save_form('#fm', baseUrl + '/luanchuyenthietbi/update');    
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin; Nơi đi và nơi đến không được trùng nhau');
        return false;
    }
}

function set_data_combo(){
    var value = $('#phongban_id').val();
    $('#thietbi_id').load(baseUrl + '/luanchuyenthietbi/combo_thietbi?phongbanid='+value);
}

function view_page_luanchuyen(pages){
    $('#thongtinthietbi').load(baseUrl + '/luanchuyenthietbi/content?page='+pages);
}