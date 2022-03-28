var page = 1; var keyword = '';
$(function(){
    $('#list_hocsinh').load(baseUrl + '/hocsinh/content_tmp?page='+page+'&keyword='+keyword);
    $('#lop_hoc').select2(); $('#file_at').prop('disabled', true);
    $('#lop_hoc').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhocid);
});

function do_import(){
    var lophoc = $('#lop_hoc').val();
    if(lophoc.length != 0){
        $('#doi').show();
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#fm')[0]);
        $.ajax({
            url: baseUrl + '/hocsinh/do_import',  //server script to process data
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
                    $('#list_hocsinh').load(baseUrl + '/hocsinh/content_tmp?page='+page+'&keyword='+keyword);
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }else{
        toastr.error('Bạn chưa chọn lớp học');
    }
}

function search(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#list_hocsinh').load(baseUrl + '/hocsinh/content_tmp?page='+page+'&q='+keyword);
    }else{
        keyword = '';
        $('#list_hocsinh').load(baseUrl + '/hocsinh/content_tmp?page='+page+'&q='+keyword);
    }
}

function view_page_hocsinh(pages){
    page = pages;
    $('#list_hocsinh').load(baseUrl + '/hocsinh/content_tmp?page='+page+'&q='+keyword);
}

function update_code(idh){
    data_str = "id="+idh;
    update_status(data_str, baseUrl + '/hocsinh/update_code', '#list_hocsinh', baseUrl+'/hocsinh/content_tmp?page='+page+'&q='+keyword, "Bạn có chắc chắn muốn cập nhật dữ liệu");
}

function del_hocsinh_tmp(idh){
    del_data_refresh_div(idh, baseUrl + '/hocsinh/del_tmp', '#list_hocsinh', baseUrl+'/hocsinh/content_tmp?page='+page+'&q='+keyword);
}


function save_import(){
    var r = confirm("Bạn có chắc chán muốn cập nhật dữ liệu!");
    if (r == true) {
        var data_str = "id=0";
        $.ajax({
            type: "POST",
            url: baseUrl + '/hocsinh/update_all',
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    window.location.href = baseUrl + '/hocsinh';
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
    
}

function check_lophoc(){
    var lophoc = $('#lop_hoc').val();
    if(lophoc.length != 0){
        $('#file_at').prop('disabled', false);
    }else{
        $('#file_at').prop('disabled', true);
    }
}