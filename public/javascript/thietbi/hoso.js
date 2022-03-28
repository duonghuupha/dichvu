$(function(){
    $('#phongban_id').select2(); 
    $('#thietbi_id').select2();
    $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+truonghocid+'&namhocid='+namhocid);
});

function set_combo_thietbi(){
    var value = $('#phongban_id').val();
    $('#thietbi_id').load(baseUrl + '/hosothietbi/combo_thietbi?id='+value);
}

function load_data(){
    var phongban = $('#phongban_id').val(); var thietbi = $('#thietbi_id').val();
    if(phongban.length  != 0 && thietbi.length != 0){
        $('#global').load(baseUrl + '/hosothietbi/content_global?id='+thietbi);
        $('#activity').load(baseUrl + '/hosothietbi/thong_so?id='+thietbi);
        $('#timeline').load(baseUrl + '/hosothietbi/luan_chuyen?id='+thietbi);
        $('#settings').load(baseUrl + '/hosothietbi/qua_trinh?id='+thietbi);
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
        return false
    }
}