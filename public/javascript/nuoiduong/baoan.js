var page = 1;
$(function(){
    $('#food_history_date').load(baseUrl + '/nuoiduong/history_date');
    $('#list_history').load(baseUrl + '/nuoiduong/history?page='+page);
});

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        //save_form_refresh_div('#fm', baseUrl + '/danhmucthietbi/update', '#danhmucthietbi', baseUrl + '/danhmucthietbi/content', '#danhmuctb');    
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#fm')[0]);
        $.ajax({
            url: baseUrl + '/nuoiduong/do_baoan',  //server script to process data
            type: 'POST',
            xhr: function() {
                return xhr;
            },
            data: formData,
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    toastr.success(result.msg);
                    reset_form('#fm');
                    $('#food_history_date').load(baseUrl + '/nuoiduong/history_date');
                    $('#list_history').load(baseUrl + '/nuoiduong/history?page='+page);
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
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_baoan(pages){
    page = pages;
    $('#list_history').load(baseUrl + '/nuoiduong/history?page='+page);
}

function view_baoan(idh){
    $('#todo_history').load(baseUrl + '/nuoiduong/view_history?id='+idh);
    $('#view_history').modal('show');
}