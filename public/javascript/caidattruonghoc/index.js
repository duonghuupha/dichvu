var xaphuong = (xa_phuong != '') ? xa_phuong.split(",").map(Number) : [];
var thonto = (thon_to != '') ? thon_to.split(",").map(Number) : [];
var giaovien = [];
$(function(){
    $('#list_namhoc').load(baseUrl + '/namhoc/content');
    $('#list_phongban').load(baseUrl + '/phongban/content');
    $('#list_bantuyensinh').load(baseUrl + '/bantuyensinh/content');
    $('#list_classtemp').load(baseUrl + '/classtemp/content');
    $('#list_exam').load(baseUrl + '/exam/content');
    $('#namhoc_id').select2(); $('#namhocc_id').select2(); $('#tsnamhoc_id').select2();
    $('#user_id').select2();
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
    $('#thanhpho_id').select2(); $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho');
    $('#quan_id').select2(); $('#thanh_pho_id').select2(); $('#quan_huyen_id').select2();
    $('#xa_phuong_id').select2(); $('#thanh_pho_id').load(baseUrl + '/other/combo_thanhpho');
    $('#date_start').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#date_end').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#date_start_tuyensinh').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#date_end_tuyensinh').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('#lua_chon_nam_hoc').select2();
});
/////////////////////////////////////////////////////////////////////
function add_namhoc(){
    $('#namhoc').modal('show'); $('#title_namhoc').val('');
    $('#id_namhoc').val(0);
}

function edit_namhoc(idh){
    $('#id_namhoc').val(idh);
    var title = $('#namhoc_'+idh).text(); $('#title_namhoc').val(title);
    $('#namhoc').modal('show');
}

function save_namhoc(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var id = $('#id_namhoc').val();
        if(id == 0){
            save_form_refresh_div('#fm_namhoc', baseUrl + '/namhoc/add', '#list_namhoc', baseUrl + '/namhoc/content', '#namhoc');
        }else{
            save_form_refresh_div('#fm_namhoc', baseUrl + '/namhoc/update', '#list_namhoc', baseUrl + '/namhoc/content', '#namhoc');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function change(idh, status){
    if(status === 0){
        toastr.error('Phải có ít nhất một năm học được kích hoạt');
        return false;
    }else{
        var data_tr = "id="+idh+"&status="+status;
        update_status(data_tr, baseUrl+'/namhoc/change', '#list_namhoc', baseUrl+'/namhoc/content', 'Bạn có chắc chắn muốn kích hoạt năm học này');
    }
}

function del_namhoc(idh, status){
    if(status == 1){
        toastr.error('Năm học đang kích hoạt bạn không thể xóa');
        return false;
    }else{
        del_data_refresh_div(idh, baseUrl + '/namhoc/del', '#list_namhoc', baseUrl + '/namhoc/content');
    }
}
function view_page_namhoc(pages){
    $('#list_namhoc').load(baseUrl + '/namhoc/content?page='+pages);
}
////////////////////////////////////////////////////////////////////////////////////////////////
function add_phongban(){
    $('#namhoc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid);
    $('#title_physic').val(''); $('#title_virtual').val('');
    $("input[name=co_dinh]").iCheck('uncheck');
    $('#phongban').modal('show');
}

function edit_phongban(idh){
    $('#id_phongban').val(idh);
    var namhocid = $('#namhocid_'+idh).text(); var titlep = $('#physic_'+idh).text();
    var titlev = $('#virtual_'+idh).text(); var codinh = $('#codinh_'+idh).text();
    $('#namhoc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid+"&id="+namhocid);
    $('#title_physic').val(titlep); $('#title_virtual').val(titlev);
    if(parseInt(codinh) == 1){
        $("input[name=co_dinh]").iCheck('check');
    }else{
        $("input[name=co_dinh]").iCheck('uncheck');
    }
    $('#phongban').modal('show');
}

function save_phongban(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var id = $('#id_phongban').val();
        if(id == 0){
            save_form_refresh_div('#fm_phongban', baseUrl + '/phongban/add', '#list_phongban', baseUrl + '/phongban/content', '#phongban');
        }else{
            save_form_refresh_div('#fm_phongban', baseUrl + '/phongban/update', '#list_phongban', baseUrl + '/phongban/content', '#phongban');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function del_phongban(idh){
    del_data_refresh_div(idh, baseUrl + '/phongban/del', '#list_phongban', baseUrl + '/phongban/content');
}

function view_page_phongban(pages){
    $('#list_phongban').load(baseUrl + '/phongban/content?page='+pages);
}

function copy_phongban(idh){
    $('#namhocc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid);
    var titlep = $('#physic_'+idh).text(); $('#id_cu').val(idh);
    var titlev = $('#virtual_'+idh).text(); var namhocid = $('#namhocid_'+idh).text();
    var giaoviencu = $('#giaovien_'+idh).text();
    $('#title_p').val(titlep); $('#title_v').val(titlev); $('#namhoccuid').val(namhocid);
    $('#giao_vien').val(giaoviencu);
    $('#copyphongban').modal('show');
}

function save_copy(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        save_form_refresh_div('#fm_copy', baseUrl + '/phongban/copy', '#list_phongban', baseUrl + '/phongban/content', '#copyphongban');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function check_namhoc(){
    var value = $('#namhocc_id').val(); var value_old = $('#namhoccuid').val();
    if(value == value_old){
        toastr.error("Không được copy vào cùng một năm học");
        $('#namhocc_id').select2().val(null).trigger("change");
    }
}
////////////////////////////////////////////////////////////////////////////////////////////
function set_quan_huyen(){
    var value = $('#thanhpho_id').val();
    $('#quan_id').load(baseUrl + '/other/combo_quanhuyen?idh='+value);
}

function set_xa_phuong(){
    var value = $('#quan_id').val();
    $('#xaphuong').load(baseUrl + '/other/list_xaphuong?idh='+value);
}

function set_thon_to(elm){
    var checkbox = document.getElementById("xaphuong_"+elm);
    if(checkbox.checked == true){
        xaphuong.push(elm);
    }else{
        xaphuong = xaphuong.filter(item => item !== elm);
    }
    //console.log(xaphuong);
    $('#thonto').load(baseUrl + '/other/list_thonto?idh='+btoa(xaphuong.join(",")));
}

function set_array(elm){
    var checkbox = document.getElementById("thonto_"+elm);
    if(checkbox.checked == true){
        thonto.push(elm);
    }else{
        thonto = thonto.filter(item => item !== elm);
    }
}

function save_phantuyen(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        $('#xa_phuong').val(xaphuong.join(",")); $("#thon_to").val(thonto.join(","));
        save_form('#fm_phantuyen', baseUrl + '/caidattruonghoc/update_phantuyen');
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}
////////////////////////////////////////////////////////////////////////////////////////
function add_tuyensinh(){
    $('#tsnamhoc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid);
    $('#user_id').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid);
    $('#bantuyensinh').modal('show');
}

function edit_tuyensinh(idh){
    $('#id_bantuyensinh').val(idh);
    var namhocid = $('#namhocid_'+idh).text(); var userid = $('#userid_'+idh).text();
    $('#tsnamhoc_id').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid+'&id='+namhocid);
    $('#user_id').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid+'&id='+btoa(userid));
    $('#bantuyensinh').modal('show');
}

function del_tuyensinh(idh){
    del_data_refresh_div(idh, baseUrl + '/bantuyensinh/del', '#list_bantuyensinh', baseUrl + '/bantuyensinh/content');
}

function save_tuyensinh(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var id = $('#id_bantuyensinh').val();
        if(id == 0){
            save_form_refresh_div('#fm_bantuyensinh', baseUrl + '/bantuyensinh/add', '#list_bantuyensinh', baseUrl + '/bantuyensinh/content', '#bantuyensinh');
        }else{
            save_form_refresh_div('#fm_bantuyensinh', baseUrl + '/bantuyensinh/update', '#list_bantuyensinh', baseUrl + '/bantuyensinh/content', '#bantuyensinh');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_bantuyensinh(pages){
    $('#list_bantuyensinh').load(baseUrl + '/bantuyensinh/content?page='+pages);
}
////////////////////////////////////////////////////////////////////////////////////////////////
function add_classtemp(){
    $('#classtemp').modal('show'); $('#title_temp').val('');
    $('#id_temp').val(0);
}

function edit_classtemp(idh){
    $('#id_temp').val(idh);
    var title = $('#classtemp_'+idh).text(); $('#title_temp').val(title);
    $('#classtemp').modal('show');
}

function save_classtemp(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        var id = $('#id_temp').val();
        if(id == 0){
            save_form_refresh_div('#fm_classtemp', baseUrl + '/classtemp/add', '#list_classtemp', baseUrl + '/classtemp/content', '#classtemp');
        }else{
            save_form_refresh_div('#fm_classtemp', baseUrl + '/classtemp/update', '#list_classtemp', baseUrl + '/classtemp/content', '#classtemp');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function del_classtemp(idh){
    del_data_refresh_div(idh, baseUrl + '/classtemp/del', '#list_classtemp', baseUrl + '/classtemp/content');
}
function view_page_classtemp(pages){
    $('#list_classtemp').load(baseUrl + '/classtemp/content?page='+pages);
}

function phanbo_giaovien(idh){
    var titlev = $('#virtual_'+idh).text();
    $('#pbgv_title').text('Phân bổ giáo viên cho '+titlev);
    $('#list_giaovien_pb').load(baseUrl + '/other/list_giaovien_pb?idh='+idh+'&truonghocid='+truonghocid);
    $('#phanbogiaovien').modal('show');
    $('#phongbanid').val(idh);
}

function pbgv(idh){
    var value = $('#active_'+idh).prop('checked');
    if(value == true){
        giaovien.push(idh);
    }else{
        giaovien = giaovien.filter(item => item !== idh);
    }
}

function save_pbgv(){
    if(giaovien.length == 0){
        toastr.error("Bạn chưa chọn giáo viên để phân bổ");
        $('#data_pbgv').val('');
    }else{
        $('#data_pbgv').val(giaovien.join(","));
        save_form_refresh_div('#fm_phanbogiaovien', baseUrl + '/phongban/phanbogiaovien', '#list_phongban', baseUrl + '/phongban/content', '#phanbogiaovien');
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_exam(){
    $('#exam').modal('show'); $('#title_exam').val('');
    $('#id_exam').val(0); $('#date_start').val('');
    $('#date_end').val(''); $('#so_luong').val(0);
}

function save_exam(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired && $('#so_luong').val() > 0){
        var id = $('#id_exam').val();
        if(id == 0){
            save_form_refresh_div('#fm_exam', baseUrl + '/exam/add', '#list_exam', baseUrl + '/exam/content', '#exam');
        }else{
            save_form_refresh_div('#fm_exam', baseUrl + '/exam/update', '#list_exam', baseUrl + '/exam/content', '#exam');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function edit_exam(idh){
    $('#id_exam').val(idh);
    var title = $('#titleexam_'+idh).text(); $('#title_exam').val(title);
    var batdau = $('#datestart_'+idh).text(); $('#date_start').datepicker('setDate', batdau);
    var ketthuc = $('#dateend_'+idh).text(); $('#date_end').datepicker('setDate', ketthuc);
    var soluong = $('#soluong_'+idh).text(); $('#so_luong').val(soluong);
    $('#exam').modal('show');
}

function del_exam(idh){
    del_data_refresh_div(idh, baseUrl + '/exam/del', '#list_exam', baseUrl + '/exam/content');
}

function view_page_exam(pages){
    $('#list_exam').load(baseUrl + '/exam/content?page='+pages);
}

function create_qrcodde(){
    $('#tuyensinh').modal('show');
    $('#date_start_tuyensinh').val('');$('#date_end_tuyensinh').val('');
    $('#lua_chon_nam_hoc').load(baseUrl + '/other/combo_namhoc?truonghocid='+truonghocid+"&id="+namhocid);
    $('#duongdantuyensinh').hide(); $('#anh_qrcode').hide();

}

function tao_duong_dan(){
    var namhoc = $('#lua_chon_nam_hoc').val();
    var ngaybatdau = $('#date_start_tuyensinh').val();
    var ngayketthuc = $('#date_end_tuyensinh').val();
    if(namhoc.length == 0 || ngaybatdau.length == 0 || ngayketthuc.length == 0){
        toastr.error('Bạn chưa điền đủ thông tin');
    }else{
        $('#lua_chon_nam_hoc').prop('disabled', true);
        $('#date_start_tuyensinh').prop('disabled', true);
        $('#date_end_tuyensinh').prop('disabled', true);
        $('#duongdan').hide();
        var string = truonghocid+'$'+namhoc+'$'+ngaybatdau+'$'+ngayketthuc;
        var link = 'http://localhost/tuyensinh/index?data='+btoa(string);
        $('#link').attr('href', link).attr('target','_blank'); $('#duongdantuyensinh').show();
        $('#anh_qrcode').show();
        var QR_CODE = new QRCode("qrcode", {
            width: 220,
            height: 220,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H,
        });
        QR_CODE.makeCode(link);
    }
}
