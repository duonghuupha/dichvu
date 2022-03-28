$(function(){
    $('#thongtinthietbi').load(baseUrl + '/thongtinthietbi/content');
    $('#list_thietbi').load(baseUrl + '/thongtinthietbi/content_tmp');
    $('#danhmuc_id').select2();
});
function add_thongtin(){
    $('#thongtintb').modal('show');
    var number = Math.floor(Math.random() * 999999);
    $('#code').val(number); $('#code').prop('readonly', false);
    $('#id').val(0); $('#title').val(null); $('#nam_su_dung').val(null);
    $('#nguyen_gia').val(null); $('#khau_hao').val(null); $('#xuat_su').val(null); 
    $('#mo_ta').val(null); $('#imageold').val(null);
    $('#danhmuc_id').load(baseUrl + '/other/combo_thietbi_dm?truonghocid='+truonghocid);
}

function edit_thongtin(idh){
    var cateid = $('#cateid_'+idh).text();
    $('#id').val(idh); $('#code').val($('#code_'+idh).text()); $('#code').prop('readonly', true);
    $('#title').val($('#title_'+idh).text()); $('#nam_su_dung').val($('#namsudung_'+idh).text());
    var nguyengia = $('#nguyengia_'+idh).text();
    var find = ',';
    var re = new RegExp(find, 'g');
    nguyengia = nguyengia.replace(re, "");  
    $('#nguyen_gia').val(nguyengia); $('#khau_hao').val($('#khauhao_'+idh).text());
    $('#xuat_su').val($('#xuatsu_'+idh).text()); $('#mo_ta').val($('#mota_'+idh).text());
    $('#imageold').val($('#image_'+idh).text());
    $('#danhmuc_id').load(baseUrl + '/other/combo_thietbi_dm?truonghocid='+truonghocid+'&id='+cateid);
    $('#thongtintb').modal('show');
}

function save(){
    var id = $('#id').val();
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        if (!isNaN($('#nam_su_dung').val()) && $('#nam_su_dung').val().length == 4
        && !isNaN($('#nguyen_gia').val()) && !isNaN($('#khau_hao').val())
        && parseInt($('#khau_hao').val()) < 100) {
            if(id == 0){
                save_form_refresh_div('#fm', baseUrl + '/thongtinthietbi/add', '#thongtinthietbi', baseUrl + '/thongtinthietbi/content', '#thongtintb');    
            }else{
                save_form_refresh_div('#fm', baseUrl + '/thongtinthietbi/update', '#thongtinthietbi', baseUrl + '/thongtinthietbi/content', '#thongtintb');    
            }
        }else{
            toastr.error('Năm sử dụng, nguyên giá, Khấu hao phải là dạng số. Giá trị khấu hao phải nhỏ hơn 100. Năm sử dụng phải là 4 con số');
            return false;
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
        return false;
    }
}

function del_thongtin(idh){
    del_data(idh, baseUrl + '/thongtinthietbi/del');
}

function view_page_thietbi(pages){
    $('#thongtinthietbi').load(baseUrl + '/thongtinthietbi/content?page='+pages);
}

function import_xls(){
    window.location.href = baseUrl + '/thongtinthietbi/import';
}

function do_import(){
    $('#doi').show();
    var xhr = new XMLHttpRequest();
    var formData = new FormData($('#fm')[0]);
    $.ajax({
        url: baseUrl + '/thongtinthietbi/do_import',  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('#doi').hide();
                toastr.success(result.msg);
                reset_form('#fm');
                $('#list_thietbi').load(baseUrl + '/thongtinthietbi/content_tmp');
            }else{
                $('#doi').hide();
                toastr.error(result.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function update_code(idh){
    data_str = "id="+idh;
    update_status(data_str, baseUrl + '/thongtinthietbi/update_code', '#list_thietbi', baseUrl+'/thongtinthietbi/content_tmp', "Bạn có chắc chắn muốn cập nhật dữ liệu");
}

function del_thongtin_tmp(idh){
    del_data_refresh_div(idh, baseUrl + '/thongtinthietbi/del_tmp', '#list_thietbi', baseUrl+'/thongtinthietbi/content_tmp');
}

function view_page_thietbi_tmp(pages){
    $('#thongtinthietbi').load(baseUrl + '/thongtinthietbi/content_tmp?page='+pages);
}

function save_import(){
    var r = confirm("Bạn có chắc chán muốn cập nhật dữ liệu!");
    if (r == true) {
        $('#doi').show();
        var data_str = "id=0";
        $.ajax({
            type: "POST",
            url: baseUrl + '/thongtinthietbi/update_all',
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    window.location.href = baseUrl + '/thongtinthietbi';
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
    
}