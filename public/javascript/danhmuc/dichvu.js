$(function(){
    $('#list_dichvu').load(baseUrl + '/dichvu/content');
});
function add(){
    $('#dichvu').modal('show');
    $('#id_dichvu').val(0); $('#title_dichvu').val('');
    $('#file_old').val('');
}
function edit(idh){
    var title = $('#dichvu_'+idh).text(); var file = $('#file_'+idh).text();
    $('#dichvu').modal('show');
    $('#id_dichvu').val(idh); $('#title_dichvu').val(title);
    $('#file_old').val(file);
}
function save(){
    var id = $('#id_dichvu').val(); var title = $('#title_dichvu').val();
    if(title.length == 0){
        toastr.error('Bạn chưa điền đủ thông tin');
        return false;
    }else{
        if(id == 0){
            save_form_refresh_div('#fm_dichvu', baseUrl + '/dichvu/add', '#list_dichvu', baseUrl + '/dichvu/content', '#dichvu');
        }else{
            save_form_refresh_div('#fm_dichvu', baseUrl + '/dichvu/update', '#list_dichvu', baseUrl + '/dichvu/content', '#dichvu');
        }
    }
}
function del(idh){
    del_data(idh, baseUrl + '/dichvu/del');
}
function view_page_dichvu(pages){
    $('#list_dichvu').load(baseUrl + '/dichvu/content?page='+pages);
}