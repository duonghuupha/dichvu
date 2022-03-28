$(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('#btn_quaylai').hide(); $('#xuatfile').hide();
});

function sothietbi(total){
    if(total > 0){
        $('#tieude').text('Sổ thiết bị tổng hợp');
        $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sothietbitonghop');
        $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
        $('#btn_quaylai').show(500); $('#xuatfile').show(500);
        $('#xuatfile').attr('onclick', 'export_thietbi_tonghop()');
    }else{
        toastr.error('Không có thiết bị, bạn không thể in sổ');
        return false;
    }
}

function socongcu(total){
    if(total > 0){
        $('#tieude').text('Sổ công cụ dụng cụ');
        $('#baocaothietbi').load(baseUrl + '/baocaothietbi/socongcutonghop');
        $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
        $('#btn_quaylai').show(500); $('#xuatfile').show(500);
        $('#xuatfile').attr('onclick', 'export_congcu_tonghop()');
    }else{
        toastr.error('Không có công cụ dụng cụ, bạn không thể in sổ');
        return false;
    }
}

function sothietbichitiet(total){
    if(total > 0){
        $('#tieude').text('Sổ thiết bị chi tiết');
        $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sothietbichitiet');
        $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
        $('#btn_quaylai').show(500); $('#xuatfile').show(500);
        $('#xuatfile').attr('onclick', 'export_thietbi_chitiet()');
    }else{
        toastr.error('Không có thiết bị, bạn không thể in sổ');
        return false;
    }
}

function socongcuchitiet(total){
    if(total > 0){
        $('#tieude').text('Sổ công cụ dụng cụ chi tiết');
        $('#baocaothietbi').load(baseUrl + '/baocaothietbi/socongcuchitiet');
        $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
        $('#btn_quaylai').show(500); $('#xuatfile').show(500);
        $('#xuatfile').attr('onclick', 'export_congcu_chitiet()');
    }else{
        toastr.error('Không có công cụ dụng cụ, bạn không thể in sổ');
        return false;
    }
}

function sotonghop(){
    $('#tieude').text('Sổ chi tiết phân bổ trang thiết bị');
    $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sotonghop');
    $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
    $('#btn_quaylai').show(500); $('#xuatfile').show(500);
    $('#xuatfile').attr('onclick', 'export_tonghop()');
}

function view_page_thietbi(pages){
    $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sothietbitonghop?page='+pages);
}

function view_page_congcu(pages){
    $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sothietbitonghop?page='+pages);
}

function view_page_thietbi_ct(pages){
    $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sothietbichitiet?page='+pages);
}

function view_page_congcu_ct(pages){
    $('#baocaothietbi').load(baseUrl + '/baocaothietbi/socongcuchitiet?page='+pages);
}

function view_page_tonghop(pages){
    $('#baocaothietbi').load(baseUrl + '/baocaothietbi/sotonghop?page='+pages);
}


function quay_lai(){
    $('#cot-trai').show(500); $('#cot-phai').removeClass('col-md-12').addClass('col-md-8');
    $('#btn_quaylai').hide(500); $('#xuatfile').hide(500); $('#baocaothietbi').empty();
}

function export_thietbi_tonghop(){
    window.location.href = baseUrl + '/baocaothietbi/export_thietbi_tonghop';
}

function export_congcu_tonghop(){
    window.location.href = baseUrl + '/baocaothietbi/export_congcu_tonghop';
}

function export_thietbi_chitiet(){
    window.location.href = baseUrl + '/baocaothietbi/export_thietbi_chitiet';
}

function export_congcu_chitiet(){
    window.location.href = baseUrl + '/baocaothietbi/export_congcu_chitiet';
}

function export_tonghop(){
    window.location.href = baseUrl + '/baocaothietbi/export_tonghop';
}
