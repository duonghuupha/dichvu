var page = 1;
var date = new Date();
var month = date.getMonth() + 1;
var year = date.getFullYear();
$(function(){
    $('#thang').select2(); $('#nam').select2();
    $('#baocaothongke').load(baseUrl + '/lichbangtuongtac/contentbc?page='+page+'&thang='+month+'&nam='+year);
})

function tim_kiem(){
    var thang = $('#thang').val(); var nam = $('#nam').val();
    if(thang.length == 0 || nam.length == 0){
        toastr.error("Bạn chưa chọn đủ thông tin");
        return false;
    }else{
        month = thang; year = nam;
        //$('#lichbangtuongtac').load(baseUrl + '/lichbangtuongtac/content?date='+date);
        $('#baocaothongke').load(baseUrl + '/lichbangtuongtac/contentbc?page='+page+'&thang='+month+'&nam='+year);
    }
}


function view_page_tuongtac(pages){
    page = pages;
    $('#baocaothongke').load(baseUrl + '/lichbangtuongtac/contentbc?page='+page+'&thang='+month+'&nam='+year);
}

function export_xls(){
    window.location.href = baseUrl + '/lichbangtuongtac/export?thang='+month+'&nam='+year;
}
