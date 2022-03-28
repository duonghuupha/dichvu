var data_hocsinh = [], page = 1, keyword = '', phongbanid = 0;
$(function(){
    $('#tu_lop').select2(); $('#den_lop').select2();
    $('#tu_lop').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhocid);
    $('#den_lop').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhocid);
});

function render_list_hocsinh(value){
    data_hocsinh = [];
    phongbanid = value;
    $('#list_hocsinh').load(baseUrl + '/hocsinh/list_hocsinh?page='+page+'&q='+keyword+'&phongbanid='+phongbanid);
}

function save_chuyenlop(){
    var denlop = $('#den_lop').val(), tulop = $('#tu_lop').val();
    $(".ck_chuyenlop:checked").each(function() {
        var idh = $('#ck_'+this.value).val();
        data_hocsinh.push(idh);
    });
    var data = [];
    $.each(data_hocsinh, function(i, el){
        if($.inArray(el, data) === -1) data.push(el);
    });
    if(denlop.length != 0 && data.length > 0 && denlop != tulop){
        $('#data_chuyenlop').val(btoa(data.join(',')));
        save_form_reject('#fm', baseUrl + '/hocsinh/do_change_class', baseUrl + '/hocsinh');
    }else{
        toastr.error("Bạn chưa chọn 'Đến lớp' hoặc không có bản ghi nào được chọn hoặc Lớp chuyển đi giồng lớp chuyển đến");
    }
}