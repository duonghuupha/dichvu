var page = 1; var codes = ''; var names = ''; var doituongs = ''; var tuois = '';
$(function(){
    $('#noidung').load(baseUrl + '/tuyensinh/content?page='+page+'&code='+codes+'&name='+names+'&doituong='+doituongs+'&tuoi='+tuois);
    $('#doituongs').select2({allowClear: true}); $('#tuois').select2({allowClear: true});
    $('#bennhan_id').select2(); $('#bengiao_id').select2(); 
    $('#ngay_nhan_ho_so').datepicker({
        autoclose:true,
        format: 'dd-mm-yyyy'
    });
    $('#ngay_di_hoc').datepicker({
        autoclose:true,
        format: 'dd-mm-yyyy'
    })
});

function add(){
    window.location.href = baseUrl + '/tuyensinh/formadd';
}

function edit(idh){
    window.location.href = baseUrl + '/tuyensinh/formedit?id='+idh;
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/tuyensinh/del', '#noidung', baseUrl + '/tuyensinh/content?page='+page+'&code='+codes+'&name='+names+'&doituong='+doituongs+'&tuoi='+tuois);
}

function view_page_tuyensinh(pages){
    page = pages;
    $('#noidung').load(baseUrl + '/tuyensinh/content?page='+page+'&code='+codes+'&name='+names+'&doituong='+doituongs+'&tuoi='+tuois);
}

function search(){
    var code = $('#codes').val(); var name = $('#names').val();
    var doituong = $('#doituongs').val(); var tuoi = $('#tuois').val();
    if(code.length != 0 || name.length != 0 || doituong.length != 0 || tuoi.length != 0){
        codes = code; names = name; doituongs = doituong; tuois = tuoi; page = 1;
        $('#noidung').load(baseUrl + '/tuyensinh/content?page='+page+'&code='+codes+'&name='+names+'&doituong='+doituongs+'&tuoi='+tuois);
    }else{
        $('#noidung').load(baseUrl + '/tuyensinh/content?page='+page+'&code='+codes+'&name='+names+'&doituong='+doituongs+'&tuoi='+tuois);
    }
}

function form_bienban(idh){
	$('#bennhan_id').load(baseUrl + '/other/combo_bantuyensinh?truonghocid='+truonghocid+'&namhocid='+namhoctuyensinh+'&id='+nguoinhan);
    $('#bengiao_id').load(baseUrl + '/other/combo_giaohoso?id='+idtuyensinh+'&cmnd='+nguoigiao);
	$('#bienban').modal('show');
}

function set_ho_ten_giao(elm){
    var value = $('#bengiao_id').find('option:selected').text();
    $('#hotennguoigiao').val(value);
}

function save_bienban(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#fm_bienban')[0]);
        $.ajax({
            url: baseUrl + '/tuyensinh/update_bienban',  //server script to process data
            type: 'POST',
            xhr: function() {
                return xhr;
            },
            data: formData,
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    //toastr.success(result.msg);
                    $('#bienban').modal('hide');
                    //$(id_div).load(url_refresh);
                    window.open(baseUrl + '/tuyensinh/bienban?code='+result.code+'&ngaynhan='+result.ngaynhan);
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

function form_tiepnhan(idh){
	$('#giaytiepnhan').modal('show');
}

function save_tiepnhan(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#fm_tiepnhan')[0]);
        $.ajax({
            url: baseUrl + '/tuyensinh/update_tiepnhan',  //server script to process data
            type: 'POST',
            xhr: function() {
                return xhr;
            },
            data: formData,
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    //toastr.success(result.msg);
                    $('#giaytiepnhan').modal('hide');
                    //$(id_div).load(url_refresh);
                    window.open(baseUrl + '/tuyensinh/tiepnhan?code='+result.code);
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