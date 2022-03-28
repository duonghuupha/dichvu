$(function(){
    $('#dichvu_id').select2();
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('#dichvu_id').load(baseUrl + '/other/combo_dichvu');
    $('#noidung').load(baseUrl + '/truonghoc/content');
});

function add_truonghoc(){
    window.location.href = baseUrl + '/truonghoc/formadd';
}

function edit_truonghoc(idh){
    window.location.href = baseUrl + '/truonghoc/formedit?id='+idh;
}

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }else{
            if(!validateEmail($('#email').val())){
                allRequired = false;
            }
        }
    });
    if(allRequired){
        var id = $('#id').val();
        if(id == 0){
            save_form_reject('#fm', baseUrl + '/truonghoc/add', baseUrl + '/truonghoc');
        }else{
            save_form_reject('#fm', baseUrl + '/truonghoc/update', baseUrl + '/truonghoc');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin hoặc định dạng email không chính xác');
    }
}

function del_truonghoc(idh){
    del_data(idh, baseUrl + '/truonghoc/del');
}

function view_page_truonghoc(pages){
    $('#noidung').load(baseUrl + '/truonghoc/content?page='+pages);
}

