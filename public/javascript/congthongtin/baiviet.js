$(function(){
    $('#baivietctt').load(baseUrl + '/congthongtin/content_bv?urlline='+str_url);
    $('#danhmuc_id').select2(); $('#danhmuc_id').load(baseUrl + '/other/combo_content_dm?truonghocid='+truonghocid);
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    CKEDITOR.replace('compose-textarea'); $('#btn-xoaanh').hide();
});

function add_baiviet(){
    window.location.href = baseUrl + '/congthongtin/formaddbaiviet';
}

function edit_baiviet(idh){
    window.location.href = baseUrl + '/congthongtin/formeditbaiviet?id='+idh;
}

function save(){
    var noidung =  CKEDITOR.instances['compose-textarea'].getData(); var image = $('#image').val();
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired && noidung.length > 0 && check_image_ext(image)){
        $('#content').val(noidung);
        var id = $('#id').val();
        if(id == 0){
            save_form_reject('#fm', baseUrl + '/congthongtin/add_baiviet', baseUrl + '/congthongtin/baiviet');
        }else{
            save_form_reject('#fm', baseUrl + '/congthongtin/update_baiviet', baseUrl + '/congthongtin/baiviet');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin hoặc hình ảnh chưa đúng định dạng');
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

function preview_img(file){
    var text = $(file).val();
    if(text.match(/jpg.*/) || text.match(/jpeg.*/) || text.match(/png.*/) || text.match(/gif.*/)){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#image_src').attr('src', e.target.result);
        }
        reader.readAsDataURL(file.files[0]); $('#btn-xoaanh').show(100);
    }else{
        $(file).val(null);
        toastr.error("Định dạng file hình ảnh không chính xác");
    }
}

function xoa_anh(){
    $('#image').val(null); $('#btn-xoaanh').hide(100);
    $('#image_src').attr('src', "");
}

function view_page_baiviet(pages){
    $('#baivietctt').load(baseUrl + '/congthongtin/content_bv?urlline='+str_url+'&page='+pages);
}

function del_baiviet(idh){
    del_data(idh, baseUrl + '/congthongtin/del_baiviet');
}

////////////////////////////////////////////////////////////////////////////////////////////
function duyetbai(){
    window.location.href = baseUrl + '/congthongtin/duyetbaiviet'
}

function dangtin(){
    window.location.href = baseUrl + '/congthongtin/dangtin'
}
