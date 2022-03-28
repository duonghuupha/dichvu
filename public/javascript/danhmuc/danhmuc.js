$(function(){
    $('#list_danhmuc').load(baseUrl + '/danhmucloi/content');
});
function add_danhmuc(){
    $('#dichvu_id').load(baseUrl + '/other/combo_dichvu');
    $('#kieudichvu_id').load(baseUrl + '/other/combo_kieudichvu');
    $('#danhmuc').modal('show');
    $('#id_danhmuc').val(0); $('#title_danhmuc').val('');
}
function edit_danhmuc(idh){
    var kieudichvu = $('#kieudichvuid_'+idh).text();
    var dichvu = $('#dichvuid_'+idh).text();
    var title = $('#danhmuc_'+idh).text();
    $('#dichvu_id').load(baseUrl + '/other/combo_dichvu?id='+dichvu);
    $('#kieudichvu_id').load(baseUrl + '/other/combo_kieudichvu?id='+kieudichvu);
    $('#danhmuc').modal('show');
    $('#id_danhmuc').val(idh); $('#title_danhmuc').val(title);
}
function save_danhmuc(){
    var id = $('#id_danhmuc').val(); var title = $('#title_danhmuc').val();
    var kieudichvu = $('#kieudichvu_id').val(); var dichvu = $('#dichvu_id').val();
    if(title.length == 0 || kieudichvu.length == 0 || dichvu.length == 0){
        toastr.error('Bạn chưa điền đủ thông tin');
        return false;
    }else{
        if(id == 0){
            save_form_refresh_div('#fm_danhmuc', baseUrl + '/danhmucloi/add', '#list_danhmuc', baseUrl + '/danhmucloi/content', '#danhmuc');
        }else{
            save_form_refresh_div('#fm_danhmuc', baseUrl + '/danhmucloi/update', '#list_danhmuc', baseUrl + '/danhmucloi/content', '#danhmuc');
        }
    }
}
function del_danhmuc(idh){
    del_data(idh, baseUrl + '/danhmucloi/del');
}
function view_page_danhmuc(pages){
    $('#list_danhmuc').load(baseUrl + '/danhmucloi/content?page='+pages);
}