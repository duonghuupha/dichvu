function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        save_form('#fm', baseUrl + '/congthongtin/update_thongtin');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}