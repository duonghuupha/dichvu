var date = new Date();
var d    = date.getDate(),
    m    = (date.getMonth()) + 1,
    y    = date.getFullYear();
$(function(){
    $('#lichbangtuongtac').load(baseUrl + '/lichbangtuongtac/content');
    $('#ngay_hoc').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#time_id').select2(); $('#thang').select2(); $('#nam').select2();
    $('#thang').val(m).trigger('change'); $('#nam').val(y).trigger('change');
});

function add(){
    $('#bangtuongtac').modal('show');
    $('#time_id').load(baseUrl + '/other/combo_khunggio');
    $('#ngay_hoc').val(''); $('#title').val(''); $('#id_tuongtac').val(0);
    //$('#lichbangtuongtac').fullCalendar('refetchEvents');
}

function edit(idh){
    var data_str = "id="+idh;
    $.ajax({
        type: "POST",
        url: baseUrl + '/lichbangtuongtac/info',
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                toastr.success(result.msg);
                $('#detail_calendar').modal('hide');
                $('#bangtuongtac').modal('show');
                $('#time_id').load(baseUrl + '/other/combo_khunggio?id='+result.timeid);
                $('#ngay_hoc').val(result.ngayhoc); $('#title').val(result.title); $('#id_tuongtac').val(idh);
            }else{
                toastr.error(result.msg);
                return false;
            }
        }
    });
}

function del(idh){
    del_data(idh, baseUrl + '/lichbangtuongtac/del');
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
        var id = $('#id_tuongtac').val();
        if(id == 0){
            save_form_refresh_div('#fm', baseUrl + '/lichbangtuongtac/add', '#lichbangtuongtac', baseUrl + '/lichbangtuongtac/content', '#bangtuongtac');
        }else{
            save_form_refresh_div('#fm', baseUrl + '/lichbangtuongtac/update', '#lichbangtuongtac', baseUrl + '/lichbangtuongtac/content', '#bangtuongtac');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function detail(idh, type){
    $('#noi_dung').load(baseUrl + '/lichbangtuongtac/detail?id='+idh);
    $('#detail_calendar').modal('show');
    if(type == 1){ // cap nhat
        $('#xoa').hide(); ('#chinhsua').show();
        $('#chinhsua').attr('onclick', 'edit('+idh+')');
        //$('#xoa').attr('onclick', 'del('+idh+')');
    }else if(type == 2){ // xoa
        $//('#chinhsua').attr('onclick', 'edit('+idh+')');
        $('#xoa').attr('onclick', 'del('+idh+')');
        $('#chinhsua').hide(); $('#xoa').show();
    }else if(type == 3){
        $('#chinhsua').show(); $('#xoa').show();
        $('#chinhsua').attr('onclick', 'edit('+idh+')');
        $('#xoa').attr('onclick', 'del('+idh+')');
    }else{
        $('#chinhsua').hide(); $('#xoa').hide();
    }

}

function search(){
    var thang = $('#thang').val(); var nam = $('#nam').val();
    if(thang.length == 0 || nam.length == 0){
        toastr.error("Bạn chưa chọn đủ thông tin");
        return false;
    }else{
        var date = nam+'-'+thang+'-'+d;
        $('#lichbangtuongtac').load(baseUrl + '/lichbangtuongtac/content?date='+date);
    }
}

function baocao(){
    window.location.href = baseUrl + '/lichbangtuongtac/baocao';
}
