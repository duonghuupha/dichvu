var lop = ''; var gender = 0; var birthday = ''; var page = 1; var status = 0;
var namhoc = namhocid;
$(function(){
    $('#phongban').select2();
    $('#thoi_gian').datepicker({
        autoclose: true,
        format: 'mm-yyyy'
    }).attr('readonly', 'readonly');
    $('#gioi_tinh').select2(); $('#trangthai').select2(); $('#namhoc').select2();
    $('#namhoc').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid+'&id='+namhoc);
    $('#phongban').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhoc);
    $('[data-toggle="tooltip"]').tooltip();
});

function search(){
    var lophoc = $('#phongban').val(); var gioitinh = $('#gioi_tinh').val();
    var ngaysinh   = $('#thoi_gian').val(); var trangthai = $('#trangthai').val();
    lop = lophoc; gender = gioitinh; birthday = ngaysinh; status = trangthai;
    if(lophoc.length > 0){
        $('#danhsachhocsinh').load(baseUrl + '/hocsinh/search?page='+page+'&lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+'&namhocid=');
    }else{
        $('#danhsachhocsinh').load(baseUrl + '/hocsinh/search?page='+page+'&lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+"&namhocid="+namhoc);
    }
    //$('#danhsachhocsinh').load(baseUrl + '/hocsinh/search?page='+page+'&lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+"&namhocid="+namhoc);
}

function view_page_baocao(pages){
    page = pages;
    $('#danhsachhocsinh').load(baseUrl + '/hocsinh/search?page='+page+'&lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+'&namhocid='+namhoc);
}

function export_xls(){
    var lophoc = $('#phongban').val(); var gioitinh = $('#gioi_tinh').val();
    var ngaysinh   = $('#thoi_gian').val(); var trangthai = $('#trangthai').val();
    lop = lophoc; gender = gioitinh; birthday = ngaysinh; status = trangthai;
    if(lophoc.length > 0){
        window.location.href = baseUrl + '/hocsinh/exportxls?lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+'&namhocid=&year='+namhoc;
    }else{
        window.location.href = baseUrl + '/hocsinh/exportxls?lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+'&namhocid='+namhoc+'&year='+namhoc;
    }
}

function export_full(){
    var lophoc = $('#phongban').val(); var gioitinh = $('#gioi_tinh').val();
    var ngaysinh   = $('#thoi_gian').val(); var trangthai = $('#trangthai').val();
    lop = lophoc; gender = gioitinh; birthday = ngaysinh; status = trangthai;
    if(lophoc.length > 0){
        window.location.href = baseUrl + '/hocsinh/exportfull?lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+'&namhocid=&year='+namhoc;
    }else{
        window.location.href = baseUrl + '/hocsinh/exportfull?lophoc='+lop+'&gioitinh='+gender+'&ngaysinh='+birthday+'&trangthai='+status+'&namhocid='+namhoc+'&year='+namhoc;
    }
}

function set_lophoc(){
    var value = $('#namhoc').val(); namhoc = value;
    $('#phongban').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhoc);
}
