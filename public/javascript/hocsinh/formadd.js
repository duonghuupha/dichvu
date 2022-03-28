$(function(){
    $('#gioi_tinh').select2(); $('#lop_hoc').select2();
    $('#ngay_sinh').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#lop_hoc').load(baseUrl + '/other/combo_lophoc?truonghocid='+truonghocid+'&namhocid='+namhocid);
});

function add_quanhe() {
    var id = Math.floor(Math.random() * 100) + 1;
    var html = '';
    html += '<tr id="'+id+'">';
        html += '<td><input class="form-control" type="text" name="ho_va_ten" id="fullname_'+id+'" size="10"/></td>';
        html += '<td>';
            html += '<select class="form-control" name="quan_he" id="quan_he_'+id+'">';
                html += '<option value="1">Bố</option>';
                html += '<option value="2">Mẹ</option>';
                html += '<option value="3">Anh/Chị/Em</option>';
                html += '<option value="4">Ông/Bà</option>';
            html += '</select>';
        html += '</td>';
        html += '<td><input class="form-control" type="text" name="dien_thoai" id="dien_thoai_'+id+'" size="10"/></td>';
        html += '<td><input class="form-control" type="text" name="nam_sinh" id="nam_sinh_'+id+'" size="5" maxlength="4"/></td>';
        html += '<td><input class="form-control" type="text" name="nghe_nghiep" id="nghe_nghiep_'+id+'" size="10"/></td>';
        html += '<td class="text-center"><a href="javascript:void(0)" onclick="del_quanhe('+id+')" style="color:red;font-size:17px;"><i class="fa fa-trash"></i></a></td>';
    html += '</tr>';
    $('#list_quanhe').append(html);
}

function del_quanhe(idh){
    $('tr#'+idh).remove();
}

function save_thongtin() {
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    var array = [];
    $('#list_quanhe tbody tr').each(function() {
        var id = this.id;
        var giatri = {fullname: $('#fullname_'+id).val(), quanhe: $('#quan_he_'+id).val(), dienthoai: $('#dien_thoai_'+id).val(), namsinh: $('#nam_sinh_'+id).val(), nghenghiep: $('#nghe_nghiep_'+id).val()}
        array.push(giatri);
    });
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }else{
            if(array.length == 0){
                allRequired = false;
            }
        }
    });
    if(allRequired){
        $('#data_quanhe').val(JSON.stringify(array));
        save_form_reject('#fm', baseUrl + '/hocsinh/add', baseUrl + '/hocsinh');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}
