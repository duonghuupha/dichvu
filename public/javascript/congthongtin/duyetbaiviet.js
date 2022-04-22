var data_hocsinh = [];
$(function(){
    $('#baivietduyet').load(baseUrl + '/congthongtin/content_d');
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
});

function view_page_baivietd(pages){
    $('#baivietduyet').load(baseUrl + '/congthongtin/content_d?page='+pages);
}

function duyet_bai_viet(idh){
    var r = confirm("Bạn có chắc chắn muốn cập nhật trạng thái dữ liệu!");
    if (r == true) {
        var data_str = "id="+idh;
        $.ajax({
            type: "POST",
            url: baseUrl + '/congthongtin/duyetbv',
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    window.location.href = baseUrl + '/congthongtin/duyetbaiviet';
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
}

function dang_bai_viet(idh){
    if($('#link_dang').val().length == 0){
        toastr.error("Bạn chưa nhập link tin bài đã đăng");
        return false;
    }else{
        save_form('#fm_dang', baseUrl + '/congthongtin/update_dangtin?id='+idh);
    }
}

function save_duyetbai(){
    $(".ck_chuyenlop:checked").each(function() {
        var idh = $('#ck_'+this.value).val();
        data_hocsinh.push(idh);
    });
    var data = [];
    $.each(data_hocsinh, function(i, el){
        if($.inArray(el, data) === -1) data.push(el);
    });
    if(data.length > 0){
        $('#data_baiviet').val(btoa(data.join(',')));
        save_form_refresh_div_no_modal('#fm', baseUrl + '/congthongtin/duyet_all', '#baivietduyet', baseUrl + '/congthongtin/content_d');
    }else{
        toastr.error("Bạn chưa chọn bản ghi");
    }
}
