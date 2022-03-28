var tukhoa = ''; var page = 1;
$(function(){
    $('#list_thietbi').load(baseUrl + '/nhapkhothietbi/content?page='+page+'&q='+tukhoa);
});

function view_page_thietbi(pages){
    page = pages;
    $('#list_thietbi').load(baseUrl + '/nhapkhothietbi/content?page='+page+'&q='+tukhoa);
}

function update_qty(idh){
    var qty = $('#qty_'+idh).val();
    var data_str = "id="+idh+"&soluong="+qty;
    update_status(data_str, baseUrl + '/nhapkhothietbi/update', '#list_thietbi', baseUrl + '/nhapkhothietbi/content', "Bạn có chắc chắn muốn cập nhật số lượng tồn của thiết bị");
}

function search(){
    var value = $('#table_search').val();
    if(value.length != 0){
        tukhoa = value.replaceAll(" ", "$", 'g');
        $('#list_thietbi').load(baseUrl + '/nhapkhothietbi/content?page='+page+'&q='+tukhoa);
    }else{
        tukhoa = '';
        $('#list_thietbi').load(baseUrl + '/nhapkhothietbi/content?page='+page+'&q='+tukhoa);
    }
}