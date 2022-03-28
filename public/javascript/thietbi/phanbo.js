var thietbidachon = [];
$(function(){
    $('#phongban_id').select2(); $('#thietbi_id').select2(); $('#thietbicon_id').select2();
    $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+truonghocid+'&namhocid='+namhocid);
    $('#thietbi_id').load(baseUrl + '/phanbothietbi/combo_thietbi?truonghocid='+truonghocid);
    $('#dachon').load(baseUrl + '/phanbothietbi/list_dachon?id=&dachon=');
    $('#list_phanbo').load(baseUrl + '/phanbothietbi/content');
});

function set_thietbi_con(){
    var id = $('#id').val();
    if(id == 0){
        var idh = $('#thietbi_id').val(); var thietbicon = $('#datadc').val(); console.log(thietbicon);
        $('#thietbicon_id').load(baseUrl + '/phanbothietbi/combo_thietbi_con?id='+idh+'&data='+btoa(thietbicon)+'&edit_id=');
    }else{
        var str = $('#tbdc_'+id).text();
        var idh = $('#thietbi_id').val(); var thietbicon = $('#datadc').val(); console.log(thietbicon);
        $('#thietbicon_id').load(baseUrl + '/phanbothietbi/combo_thietbi_con?id='+idh+'&data='+btoa(thietbicon)+'&edit_id='+btoa(str));
    }
    //toastr.error(idh);
}

function set_data_dachon(){
    var idh = $('#thietbicon_id').val(); var dachon = $('#datadc').val();
    var thietbiid = $('#thietbi_id').val();
    if(dachon.length > 0){
        var str = btoa(dachon);
    }else{
        var str = '';
    }
    /*let value = thietbiid; let arr = thietbidachon;
    arr = arr.filter(item => item !== value); thietbidachon = arr;*/
    thietbidachon.push(thietbiid); data_str_dc = thietbidachon.join(","); console.log(thietbidachon);
    $('#dachon').load(baseUrl + '/phanbothietbi/list_dachon?id='+idh+"&dachon="+str);
    $('#thietbi_id').load(baseUrl + '/phanbothietbi/combo_thietbi?truonghocid='+truonghocid);
    $('#thietbicon_id').load(baseUrl + '/phanbothietbi/combo_thietbi_con?id=0');
    //toastr.error(thietbidachon.join(","));
}

function del_dachon(idh){
    var dachon = $('#datadc').val(); let arr = dachon.split(",");
    var dc = idh.split(".");
    let value = idh; arr = arr.filter(item => item !== value);
    $('#tb_'+dc[0]+'_'+dc[1]).remove(); $('#datadc').val(arr.join(","));
    ///////////////////////////////////////////////////////////////////////////////
    let valuetb = dc[0]; let arrtb = thietbidachon;
    arrtb = arrtb.filter(item => item !== valuetb); thietbidachon = arrtb;
    data_str_dc = thietbidachon.join(","); console.log(thietbidachon);
    $('#thietbi_id').load(baseUrl + '/phanbothietbi/combo_thietbi?truonghocid='+truonghocid);
    //toastr.error(arr.join(","));
}

function view_page_phanbo(pages){
    $('#thongtinthietbi').load(baseUrl + '/phanbothietbi/content?page='+pages);
}

function edit_phanbo(idh){
    $('#id').val(idh);
    var code = $('#code_'+idh).text(); $('#code').val(code);
    var phongbanid = $('#phongbanid_'+idh).text();
    $('#phongban_id').load(baseUrl + '/other/combo_phongban?truonghocid='+truonghocid+'&namhocid='+namhocid+"&id="+phongbanid);
    var str = $('#tbdc_'+idh).text(); var data_str_dc = $('#tb_'+idh).text();
    thietbidachon = data_str_dc.split(","); //console.log(thietbidachon);
    $('#dachon').load(baseUrl + '/phanbothietbi/list_dachon?id=0&dachon='+btoa(str));
    $('#thietbi_id').load(baseUrl + '/phanbothietbi/combo_thietbi?truonghocid='+truonghocid);
}

function save(){
    var phongban = $('#phongban_id').val(); var datadc = $('#datadc').val();
    if(phongban.length == 0 || (typeof(datadc) == 'undefined' && datadc == null)){
        toastr.error("Bạn chưa điền đủ thông tin");
    }else{
        var id = $('#id').val();
        if(id == 0){
            save_form('#fm', baseUrl + '/phanbothietbi/add');
        }else{
            save_form('#fm', baseUrl + '/phanbothietbi/update');
        }
    }
}

function del_phanbo(idh){
    del_data_refresh_div(idh, baseUrl + '/phanbothietbi/del', '#list_phanbo', baseUrl + '/phanbothietbi/content');
}
