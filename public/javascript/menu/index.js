var tukhoa = '';
var page = 1;
$(function(){
    $('#list_menu').load(baseUrl + '/menu/content?page='+page+'&q='+tukhoa);
    $('#chuc_nang').select2();
    $('[data-toggle="tooltip"]').tooltip();
});

function add(idh){
    $('#dichvu_id').load(baseUrl + '/other/combo_dichvu?id='+idh);
    $('#dichvu_id').prop('disabled', true)
    $('#parent_id').load(baseUrl + '/menu/combo_roles?id='+idh+'&idh=0');
    $('#menu').modal('show'); $('#chuc_nang').val(null).trigger('change');
    $('#id_dichvu').val(idh); $('#danger_menu').hide();
    $('#id_menu').val(0); $('#title').val(''); $('#link').val('');
    $('#thu_tu').val('');
}

function edit(idh){
    var data_str = "id="+idh;
    $.ajax({
        type: "POST",
        url: baseUrl + '/menu/content',
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                toastr.success(result.msg);
                $('#dichvu_id').load(baseUrl + '/other/combo_dichvu?id='+result.dichvu_id);
                $('#dichvu_id').attr('disabled', true); $('#id_dichvu').val(result.dichvu_id);
                $('#parent_id').load(baseUrl + '/menu/combo_roles?id='+result.dichvu_id+'&idh='+result.parent_id);
                $('#menu').modal('show');
                if(result.chuc_nang != ''){
                    var chucnang = result.chuc_nang.split(",").map(Number);
                }else{
                    var chucnang = '';
                }
                $('#danger_menu').show(); $('#chuc_nang').val(chucnang).trigger('change');
                $('#danger_menu').attr('onClick', 'del('+idh+')');
                $('#id_menu').val(idh); $('#title').val(result.title); $('#link').val(result.link);
                $('#thu_tu').val(result.thu_tu);
            }else{
                toastr.error(result.msg);
                return false;
            }
        }
    });
}

function del(idh){
    del_data(idh, baseUrl + '/menu/del');
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
        var id = $('#id_menu').val();
        if(id == 0){
            save_form('#fm', baseUrl + '/menu/add');
        }else{
            save_form('#fm', baseUrl + '/menu/update');
        }
    }else{
        toastr.error("Bạn chưa nhập đủ thông tin");
        return false;
    }
}

function view_page_menu(pages){
    page = pages;
    $('#list_menu').load(baseUrl + '/menu/content?page='+page+'&q='+tukhoa);
}

function display_content(){

}
