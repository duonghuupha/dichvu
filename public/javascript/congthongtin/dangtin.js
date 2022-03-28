$(function(){
    $('#baivietdang').load(baseUrl + '/congthongtin/content_dang');
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
});

function view_page_baiviet_dang(pages){
    $('#baivietdang').load(baseUrl + '/congthongtin/content_d?page='+pages);
}

/*function duyet_bai_viet(idh){
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
*/
