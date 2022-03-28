var page = 1; var tukhoa = '';
$(function(){
    $('#list_trangcap').load(baseUrl + '/denghitrangcap/content?page='+page+'&q='+tukhoa);
    $('#minhchung').hide();
});

function add(){
    window.location.href = baseUrl + '/denghitrangcap/formadd';
}

function edit(idh){
    window.location.href = baseUrl + '/denghitrangcap/formedit?id='+idh;
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/denghitrangcap/del', '#list_trangcap', baseUrl + '/denghitrangcap/content?page='+page+'&q='+tukhoa);
}

function view_page_trangcap(pages){
    page = pages;
    $('#list_trangcap').load(baseUrl + '/denghitrangcap/content?page='+pages+'&q='+tukhoa);
}

function search(){
    
}

function detail(idh, status, userapp, user_id, file_minhchung){
    $('#noi_dung').load(baseUrl + '/denghitrangcap/info?id='+idh);
    $('#detail_trangcap').modal('show');
    if(status == 1){
        $('#ingiay').show();
        $('#ingiay').attr('onclick', "window.open('"+baseUrl+"/denghitrangcap/info?id="+idh+"')");
    }else{
        $('#ingiay').hide();
        $('#ingiay').attr('onclick', "");
    }
    if(userapp == userid && status == 0){
        $('#duyet').show();
        $('#duyet').attr('onclick', 'duyet('+idh+','+status+')');
    }else{
        $('#duyet').hide();
        $('#duyet').attr('onclick', '');
    }
    if(status == 1 && userid == user_id && file_minhchung == ''){
        $('#minhchung').show();
        $('#minhchung').attr('onclick', 'capnhatminhchung('+idh+')');
    }else{
        $('#minhchung').hide();
        $('#minhchung').attr('onclick', '');
    }
}

function duyet(idh, status){
    update_status_reload("id="+idh+'&status='+status, baseUrl + '/denghitrangcap/change', "Bạn có chắc duyệt đề nghị này");
}

function capnhatminhchung(idh){
    $('#detail_trangcap').modal('hide');
    $('#chitiettrangcap').load(baseUrl + '/denghitrangcap/info?id='+idh);
    $('#capnhatminhchung').modal('show');
    $('#id_trangcap').val(idh);
}

function save_minhchung(){
    var file = $('#file').val();
    if(file.length != 0){
        save_form_refresh_div('#fm_minhchung', baseUrl + '/denghitrangcap/minhchung', '#list_trangcap', baseUrl + '/denghitrangcap/content?page='+page+'&q='+tukhoa, '#capnhatminhchung')
    }else{
        toastr.error('Bạn chưa chọn file minh chứng');
        return  false;
    }
}