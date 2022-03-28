var lop = ''; var page = 1; var namhoc = namhocid; var thoi_gian = '';
var date = new Date(); var thoigian = (date.getMonth() + 1)+'-'+date.getFullYear();
$(function(){
    $('#phongban').select2(); $('#namhoc').select2();
    $('#thoi_gian').datepicker({
        autoclose: true,
        format: 'mm-yyyy'
    }).attr('readonly', 'readonly');
    $('#namhoc').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid+'&id='+namhoc);
    $('#phongban').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhoc);
    $('#thoi_gian').datepicker('setDate', thoigian); $('#btn_quaylai').hide();
    $('#xuatfile').hide();
});

function set_lophoc(){
    var value = $('#namhoc').val(); namhoc = value;
    $('#phongban').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhoc);
}

function search(){
    var year = $('#namhoc').val(); var lophoc = $('#phongban').val();
    var thoigian = $('#thoi_gian').val();
    if(year.length == 0 || lophoc.length == 0 || thoigian.length == 0){
        toastr.error('Bạn chưa điền đủ thông tin');
        return false;
    }else{
        lop = lophoc; namhoc = year; thoi_gian = thoigian;
        $('#baocaonuoiduong').load(baseUrl + '/nuoiduong/content?namhocid='+namhoc+'&lophoc='+lop+'&thoigian='+thoigian);
        $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
        $('body').addClass('sidebar-collapse'); $('#btn_quaylai').show(500); $('#xuatfile').show(500);
    }
}

function quay_lai(){
    $('#cot-trai').show(500); $('#cot-phai').removeClass('col-md-12').addClass('col-md-8');
    $('body').removeClass('sidebar-collapse'); $('#btn_quaylai').hide(500); $('#xuatfile').hide(500);
    $('#baocaonuoiduong').empty();
}

function export_xls(){
    window.location.href = baseUrl + '/nuoiduong/export?namhocid='+namhoc+'&lophoc='+lop+'&thoigian='+thoi_gian;
}
