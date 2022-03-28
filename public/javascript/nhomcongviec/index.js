var page = 1; var keyword = '';
$(function(){
    $('#list_nhomcongviec').load(baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword);
    $('#user_id_follow').select2();
});

function add(){
    $('#user_id_follow').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid);
    $('#nhomcongviec').modal('show');
    $('#id_nhomcongviec').val(0); $('#title').val(''); $('#user_id_follow').val('');
}

function edit(idh){
    var userfollow = $('#userfollow_'+idh).text();
    var title = $('#title_'+idh).text();
    $('#user_id_follow').load(baseUrl + '/other/combo_users?truonghocid='+truonghocid+'&id='+btoa(userfollow));
    $('#nhomcongviec').modal('show');
    $('#id_nhomcongviec').val(idh); $('#title').val(title);
}

function del(idh){
    del_data_refresh_div(idh, baseUrl + '/nhomcongviec/del', '#list_nhomcongviec', baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword);
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
        var id = $('#id_nhomcongviec').val();
        if(id == 0){
            save_form_refresh_div('#fm_nhomcongviec', baseUrl + '/nhomcongviec/add', '#list_nhomcongviec', baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword, '#nhomcongviec');
        }else{
            save_form_refresh_div('#fm_nhomcongviec', baseUrl + '/nhomcongviec/update', '#list_nhomcongviec', baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword, '#nhomcongviec');
        }
    }else{
        toastr.error('Bạn chưa điền đủ thông tin');
    }
}

function view_page_nhomcongviec(pages){
    page = pages;
    $('#noidlist_nhomcongviecung').load(baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword);
}

function sear(){
    var value = $('#table_search').val();
    if(value.length != 0){
        keyword = value.replaceAll(" ", "$", 'g');
        $('#list_nhomcongviec').load(baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword);
    }else{
        tukhoa = '';
        $('#list_nhomcongviec').load(baseUrl + '/nhomcongviec/content?page='+page+'&q='+keyword);
    }
}