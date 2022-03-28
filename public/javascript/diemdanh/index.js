var dataObj = (dataStr != '') ? dataStr.split(",").map(Number) : [];
$(function(){
	$('#list_hocsinh').load(baseUrl + '/diemdanh/json_hocsinh?data='+btoa(dataObj.join(",")));
    $('#list_diemdanh').load(baseUrl + '/diemdanh/json_dihoc');
});

function set_dachon(idh){
	var data_str = "id="+idh;
	$.ajax({
        type: "POST",
        url: baseUrl + '/diemdanh/info_hocsinh',
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
                toastr.success(result.msg);
                $('#list_diemdanh').load(baseUrl + '/diemdanh/json_dihoc');
                dataObj.push(parseInt(result.id))
                //console.log(dataObj);
                $('#list_hocsinh').load(baseUrl + '/diemdanh/json_hocsinh?data='+btoa(dataObj.join(",")));
            }else{
                toastr.error(result.msg);
                return false;
            }
        }
    });
}

function cancel_dachon(idh){
	var data_str = "id="+idh;
	$.ajax({
        type: "POST",
        url: baseUrl + '/diemdanh/del_diemdanh',
        data: data_str, // serializes the form's elements.
        success: function(data){
            var result = JSON.parse(data);
            if(result.success == true){
            	toastr.success(result.msg);
                $('#list_diemdanh').load(baseUrl + '/diemdanh/json_dihoc');
                var dataObject = dataObj.filter(item => item !== result.id);
                console.log(dataObject);
			    $('#list_hocsinh').load(baseUrl + '/diemdanh/json_hocsinh?data='+btoa(dataObject.join(",")));
            }else{
                toastr.error(result.msg);
                return false;
            }
        }
    });
}