$(function(){
    $('#user_app').select2();
    $('#ngay_de_nghi').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        setDate: new Date()
    });
    $('#user_app').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid+'&id='+btoa(userapp));
    $("input[data-type='currency']").on({
        keyup: function() {
          formatCurrency($(this));
        },
        blur: function() { 
          formatCurrency($(this), "blur");
        }
    });
});

function add_trangcap() {
    var id = Math.floor(Math.random() * 100) + 1;
    var html = '';
    html += '<tr id="'+id+'">';
        html += '<td><input class="form-control" type="text" name="title" id="title_'+id+'" size="20"/></td>';
        html += '<td><input class="form-control" type="text" name="donvitinh" id="donvitinh_'+id+'" size="5"/></td>';
        html += '<td><input class="form-control" type="text" name="soluong" id="soluong_'+id+'" size="5" onkeypress="return onlyNumberKey(event)"/></td>';
        html += '<td><input class="form-control" type="text" name="dongia" id="dongia_'+id+'" size="10" onkeypress="return onlyNumberKey(event)"/></td>';
        html += '<td><input class="form-control" type="text" name="ghichu" id="ghichu_'+id+'" size="10"/></td>';
        html += '<td class="text-center"><a href="javascript:void(0)" onclick="del_trangcap('+id+')" style="color:red;font-size:17px;"><i class="fa fa-trash"></i></a></td>';
    html += '</tr>';
    $('#list_trangcap').append(html);
}

function del_trangcap(idh){
    $('tr#'+idh).remove();
}

function save() {
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    var array = [];
    $('#list_trangcap tbody tr').each(function() {
        var id = this.id;
        var giatri = {title: $('#title_'+id).val(), donvitinh: $('#donvitinh_'+id).val(), soluong: $('#soluong_'+id).val(), dongia: $('#dongia_'+id).val(), ghichu: $('#ghichu_'+id).val()}
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
        $('#datadc').val(JSON.stringify(array));
        save_form_reject('#fm', baseUrl + '/denghitrangcap/update', baseUrl + '/denghitrangcap');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}
