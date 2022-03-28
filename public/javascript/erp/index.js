var page = 1; var tukhoa = '';
$(function(){
    $('#lichcongtac').load(baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa);
    $('#uu_tien').select2(); $('#group_id').select2(); $('#user_id_task').select2();
    $('#user_id_follow').select2(); $('#user_id_d').select2(); $('#tuan').select2();
    $('#date_start').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#time_start').timepicker({
        showInputs: false,
        showMeridian: !1
    });
    $('#date_end').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#time_end').timepicker({
        showInputs: false,
        showMeridian: !1
    });

    $('#group_id').on('select2:select', function(e){
        var data = e.params.data;
        //console.log(data.id);
        $('#user_id_task').load(baseUrl + '/other/combo_usergrouptask?id='+data.id);
        $('#user_id_follow').load(baseUrl + '/other/combo_usergrouptask?id='+data.id);
    });
    $('[data-toggle="tooltip"]').tooltip();
});

function add(){
    $('#group_id').load(baseUrl + '/other/combo_nhomcongviec?truonghocid='+truonghocid);
    $('#modal_erp').modal('show'); $('#id_task').val(0); $('#content').val('');
    $('#group_id').val(null).trigger('change'); $('#file').val(''); $('#uu_tien').val(null).trigger('change');
    $('#user_id_task').val(null).trigger('change'); $('#user_id_follow').val(null).trigger('change');
    $('#user_id_task').load(baseUrl + '/other/combo_usergrouptask?id=0');
    $('#user_id_follow').load(baseUrl + '/other/combo_usergrouptask?id=0');
    $('#date_start').val(null); $('#time_start').val(null); $('#date_end').val(null); $('#time_end').val(null);
    $('#dinhkem').show();
}

function edit(idh, tiendo, status){
    if(tiendo != 0 || status == 3  || status == 1){
        toastr.error("Công việc đang được xử lý bạn không thể chỉnh sửa nội dung. Hãy sử dụng module ý kiến/trao đổi để cập nhật nội dung công việc");
    }else{
        var data_str = "id="+idh;
        $.ajax({
            type: "POST",
            url: baseUrl + '/erp/info',
            data: data_str, // serializes the form's elements.
            success: function(data){
                var result = JSON.parse(data);
                if(result.success == true){
                    //window.location.href = baseUrl + '/index'
                    $('#modal_erp').modal('show'); $('#id_task').val(idh);
                    $('#group_id').load(baseUrl + '/other/combo_nhomcongviec?truonghocid='+truonghocid+'&id='+result.data.group_id);
                    $('#uu_tien').val(result.data.uu_tien).trigger('change');
                    $('#user_id_task').load(baseUrl + '/other/combo_usergrouptask?id='+result.data.group_id+'&userid='+btoa(result.data.user_id_task));
                    $('#user_id_follow').load(baseUrl + '/other/combo_usergrouptask?id='+result.data.group_id+'&userid='+btoa(result.data.user_id_follow));
                    $('#content').val(result.data.content); $('#date_start').val(result.data.date_start); $('#time_start').val(result.data.time_start);
                    $('#date_end').val(result.data.date_end); $('#time_end').val(result.data.time_end); $('#dinhkem').hide();
                    //toastr.success(result.msg);
                    //console.log(result.data.code);
                }else{
                    toastr.error(result.msg);
                    return false;
                }
            }
        });
    }
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
        var id = $('#id_task').val();
        if(id == 0){
            save_form_refresh_div('#fm_erp', baseUrl + '/erp/add', '#lichcongtac', baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa, '#modal_erp');
        }else{
            save_form_refresh_div('#fm_erp', baseUrl + '/erp/update', '#lichcongtac', baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa, '#modal_erp');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function comment(idh){
    $('#comment').modal('show');
    $('#id_task').val(idh); $('#content').val(''); $('#file').val('');
}

function save_comment(){
    save_form('#fm_comment', baseUrl + '/erp/add_comment');
}

function ketqua(idh, tiendo){
    $('#result').modal('show');
    $('#idtask').val(idh); $('#tien_do').val(tiendo); $('#file_result').val('');
}

function save_tiendo(){
    save_form('#fm_result', baseUrl + '/erp/change?type=1');
}

function del(idh, tiendo,status){
    if(tiendo != 0 || status == 3 || status == 1){
        toastr.error("Công việc đang được xử lý, bạn không thể xóa");
    }else{
        del_data_refresh_div(idh, baseUrl + '/erp/del', '#lichcongtac', baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa);
    }
}

function search(){
    var value = $('#table_search').val();
    if(value.length != 0){
        tukhoa = value.replaceAll(" ", "$", 'g');
        $('#lichcongtac').load(baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa);
    }else{
        tukhoa = '';
        $('#lichcongtac').load(baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa);
    }
}

function view_page_task(pages){
    page = pages;
    $('#lichcongtac').load(baseUrl + '/erp/content?page='+page+'&tukhoa='+tukhoa);
}

function chuyencongviec(idh, groupid, useridtask){
    $('#user_id').select2(); $('#user_id').load(baseUrl + '/other/combo_usergrouptask?id='+groupid+'&userid='+btoa(useridtask));
    $('#chuyencongviec').modal('show'); $('#idtaskc').val(idh); $('#user_idcu').val(useridtask);
}

function save_chuyen(){
    var useridcu = $('#user_idcu').val(); var useridmoi = $('#user_id').val();
    if(useridcu == useridmoi){
        toastr.error('Không thể chuyển công việc cho người trước');
        return valse;
    }else{
        if($('#ly_do').val().length == 0){
            toastr.error("Bạn chưa nhập lý do chuyển công việc");
            return false;
        }else{
            save_form_reject('#fm_chuyen', baseUrl +  '/erp/chuyen', baseUrl + '/erp');
        }
    }
}

function duyet_cv(idh){
    let text = 'Bạn có chắc chắn duyệt chuyển công việc này ?';
    if(confirm(text) == true){
        action_chuyen(idh, 2, 1);
    }else{
        action_chuyen(idh, 2, 2);
    }
}


function action_chuyen(id_index, kieu, trangthai){
    $('#doi').show();
    var data_str = "id="+id_index+'&type='+kieu+'&status='+trangthai;
    $.ajax({
        type: "POST",
        url: baseUrl + '/erp/change',
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                $('#doi').hide();
                location.reload(true);
            }else{
                $('#doi').hide();
                toastr.error(result.msg);
                return false;
            }
        }
    });
}

function lich_cong_tac(){
    $('#user_id_d').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid);
    $('#modal_lich').modal('show');
}

function view_lich(){
    var value = $('#user_id_d').val(); var tuan = $('#tuan').val();
    //console.log(value.join(","));
    window.location.href = baseUrl + '/erp/lichcongtac?id='+btoa(value.join(","))+'&tuan='+tuan;
}

function xuat_file(){
    var id = getParameterByName('id');
    var tuan = getParameterByName('tuan');
    window.open(baseUrl + '/erp/export_pdf?id='+id+'&tuan='+tuan);
}

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
