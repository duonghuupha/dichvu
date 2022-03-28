$(function(){
    $('#vanbanctt').load(baseUrl + '/congthongtin/content_vb?urlline='+str_url);
    $('#danhmuc_id').select2(); $('#danhmuc_id').load(baseUrl + '/other/combo_content_dm?truonghocid='+truonghocid);
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $( "#qa" ).tooltip({
        show: {
            effect: "slideDown",
            delay: 250
        }
    });
});
function add_vanban(){
    window.location.href = baseUrl + '/congthongtin/formaddvanban';
}

function edit_vanban(idh){
    window.location.href = baseUrl + '/congthongtin/formeditvanban?id='+idh;
}

function view_page_vanban(pages){
    $('#vanbanctt').load(baseUrl + '/congthongtin/content_vb?urlline='+str_url+'&page='+pages);
}

function del_vanban(idh){
    del_data(idh, baseUrl + '/congthongtin/del_vanban');
}

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var id = $('#id').val();
        if(id == 0){
            save_form_reject('#fm', baseUrl + '/congthongtin/add_vanban', baseUrl + '/congthongtin/vanban');
        }else{
            save_form_reject('#fm', baseUrl + '/congthongtin/update_vanban', baseUrl + '/congthongtin/vanban');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function ValidateFileSize(file){
    var FileSize = file.files[0].size / 1024 / 1024; // in MiB
    if(FileSize > 32){
        toastr.error("File đính kèm của bạn đã quá dung lượng, vui lòng tải lại file khác");
        $(file).val(null); $('#tenfile').text('');
        return false;
    }else{
        $('#tenfile').text($(file).val());
        return true;
    }
}

function dang_van_ban(idh){
    if($('#link_dang').val().length == 0){
        toastr.error('Bạn chưa nhập link của văn bản');
        return false;
    }else{
        save_form('#fm', baseUrl + '/congthongtin/update_dangvb?id='+idh);
    }
}
