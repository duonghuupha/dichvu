$(function(){
    $('#list_inma').load(baseUrl + '/inmathietbi/content');
});

function view_page_thietbi(pages){
    $('#list_inma').load(baseUrl + '/inmathietbi/content?page='+pages);
}

function print_ma(){
    let myArray = (function() {
        let a = [];
        $(".ck_inma:checked").each(function() {
            var qty = $('#qty_'+this.value).val();
            a.push(this.value+'.'+qty);
        });
        return a;
    })()
    if(myArray.length > 0){
        location.reload(true);
        window.open(baseUrl + '/inmathietbi/inma?data='+btoa(myArray.join(",")));
    }else{
        toastr.error('Không có bản ghi nào được chọn');
        return false;
    }
}