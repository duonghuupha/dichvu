var data_nguoidung = [];
$(function(){
    $('#user_id').select2();
    $('#user_id').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid);
});

function set_data_combo(){
    var userid = $('#user_id').val();
    $('#list_nguoidung').load(baseUrl  + '/nguoidung/list_nguoidung_copy?id='+userid);
    $('#quyen').load(baseUrl +'/nguoidung/quyennguoidung?id='+userid);
    data_nguoidung = [];
}

function save(){
    $(".ck_copy:checked").each(function() {
        var idh = $('#ck_'+this.value).val();
        data_nguoidung.push(idh);
    });
    var data = [];
    $.each(data_nguoidung, function(i, el){
        if($.inArray(el, data) === -1) data.push(el);
    });
    //console.log(data);
    if(data.length > 0){
        $('#datadc').val(btoa(data.join(',')));
        save_form_reject('#fm', baseUrl + '/nguoidung/do_copy', baseUrl + '/nguoidung');
    }else{
        toastr.error("Bạn chưa chọn copy quyền đến người dùng nào");
    }
}
