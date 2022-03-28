var trangthai = ''; var tungay = ''; var denngay = '';
$(function(){
    $('#kieudulieu').select2(); $('#trangthai_baiviet').select2();
    $('#trangthai_vanban').select2();
    $('#btn_quaylai').hide(); $('#xuatfile').hide();
    $('#baiviet').show(); $('#vanban').hide();
    $('#tungay').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#denngay').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
});

function set_kieu(){
    var value= $('#kieudulieu').val();
    if(value == 1){
        $('#baiviet').show(); $('#vanban').hide();
    }else{
        $('#baiviet').hide(); $('#vanban').show();
    }
}

function search(){
    var value= $('#kieudulieu').val();
    tungay = $('#tungay').val(); denngay = $('#denngay').val();
    trangthai = $('#trangthai_baiviet').val();
    if(value == 1){
        $('#tieude').text('Thống kê bài viết');
        $('#baocaoctt').load(baseUrl + '/baocaoctt/content_baiviet?trangthai='+trangthai+'&tungay='+tungay+'&denngay='+denngay);
        $('#xuatfile').attr('onclick', 'export_baiviet()');
    }else{
        $('#tieude').text('Thống kê văn bản');
        $('#baocaoctt').load(baseUrl + '/baocaoctt/content_vanban?trangthai='+trangthai+'&tungay='+tungay+'&denngay='+denngay);
        $('#xuatfile').attr('onclick', 'export_vanban()');
    }
    //$('#baocaothietbi').load(baseUrl + '/baocaothietbi/sothietbitonghop');
    $('#cot-trai').hide(500); $('#cot-phai').removeClass('col-md-8').addClass('col-md-12');
    $('#btn_quaylai').show(500); $('#xuatfile').show(500);
}

function view_page_baiviet(pages){
    $('#baocaoctt').load(baseUrl + '/baocaoctt/content_baiviet?page='+pages+'&trangthai='+trangthai+'&tungay='+tungay+'&denngay='+denngay);
}

function view_page_vanban(pages){
    $('#baocaoctt').load(baseUrl + '/baocaoctt/content_vanban?page='+pages+'&trangthai='+trangthai+'&tungay='+tungay+'&denngay='+denngay);
}


function quay_lai(){
    $('#cot-trai').show(500); $('#cot-phai').removeClass('col-md-12').addClass('col-md-8');
    $('#btn_quaylai').hide(500); $('#xuatfile').hide(500); $('#baocaoctt').empty();
}

function export_baiviet(){
    window.location.href = baseUrl + '/baocaoctt/export_baiviet&trangthai='+trangthai+'&tungay='+tungay+'&denngay='+denngay;
}

function export_vanban(){
    window.location.href = baseUrl + '/baocaoctt/export_vanban&trangthai='+trangthai+'&tungay='+tungay+'&denngay='+denngay;
}
