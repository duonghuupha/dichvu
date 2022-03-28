<?php
class Convert{
     /**
     * Convert dinh danh ngay thang
     **/
    function convertDate($text) {
		if ($text != '') {
			list ( $date, $month, $year ) = explode ( "-", $text );
			$text = $year . '-' . $month . '-' . $date;
		}
		return $text;
	}

    function convert_img($txtname, $tiento){
        $extension = @end(explode(".", $txtname));
  		$prod = time();
  		$newfilename = $prod.'_'.$tiento.".".$extension;
        return $newfilename;
    }

    // hien thi danh sach destination
	function convert_number_to_words($number){
    	$hyphen = ' ';
    	$conjunction = '  ';
    	$separator = ' ';
    	$negative = 'âm ';
    	$decimal = ' phẩy ';
    	$dictionary = array(
    		0 => 'Không',
    		1 => 'Một',
    		2 => 'Hai',
    		3 => 'Ba',
    		4 => 'Bốn',
    		5 => 'Năm',
    		6 => 'Sáu',
    		7 => 'Bảy',
    		8 => 'Tám',
    		9 => 'Chín',
    		10 => 'Mười',
    		11 => 'Mười một',
    		12 => 'Mười hai',
    		13 => 'Mười ba',
    		14 => 'Mười bốn',
    		15 => 'Mười năm',
    		16 => 'Mười sáu',
    		17 => 'Mười bảy',
    		18 => 'Mười tám',
    		19 => 'Mười chín',
    		20 => 'Hai mươi',
    		30 => 'Ba mươi',
    		40 => 'Bốn mươi',
    		50 => 'Năm mươi',
    		60 => 'Sáu mươi',
    		70 => 'Bảy mươi',
    		80 => 'Tám mươi',
    		90 => 'Chín mươi',
    		100 => 'trăm',
    		1000 => 'nghìn',
    		1000000 => 'triệu',
    		1000000000 => 'tỷ',
    		1000000000000 => 'nghìn tỷ',
    		1000000000000000 => 'nghìn triệu triệu',
    		1000000000000000000 => 'tỷ tỷ'
    	);
    	if( !is_numeric( $number ) ){
    		return false;
    	}
    	if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX ){
    		// overflow
    		trigger_error( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
    		return false;
    	}
    	if( $number < 0 ){
    		return $negative . $this->convert_number_to_words( abs( $number ) );
    	}
    	$string = $fraction = null;
    	if( strpos( $number, '.' ) !== false ){
    		list( $number, $fraction ) = explode( '.', $number );
    	}
    	switch (true){
    		case $number < 21:
    			$string = $dictionary[$number];
    			break;
    		case $number < 100:
    			$tens = ((int)($number / 10)) * 10;
    			$units = $number % 10;
    			$string = $dictionary[$tens];
    			if( $units ){
    				$string .= $hyphen . $dictionary[$units];
    			}
    			break;
    		case $number < 1000:
    			$hundreds = $number / 100;
    			$remainder = $number % 100;
    			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
    			if( $remainder ){
    				$string .= $conjunction . $this->convert_number_to_words( $remainder );
    			}
    			break;
    		default:
    			$baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
    			$numBaseUnits = (int)($number / $baseUnit);
    			$remainder = $number % $baseUnit;
    			$string = $this->convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
    			if( $remainder ){
    				$string .= $remainder < 100 ? $conjunction : $separator;
    				$string .= $this->convert_number_to_words( $remainder );
    			}
    			break;
    	}
    	if( null !== $fraction && is_numeric( $fraction ) ){
    		$string .= $decimal;
    		$words = array( );
    		foreach( str_split((string) $fraction) as $number ){
    			$words[] = $dictionary[$number];
    		}
    		$string .= implode( ' ', $words );
    	}
    	return $string;
    }

	function getDatesFromRange($start, $end, $format = 'Y-m-d') {
		$array = array();
		$interval = new DateInterval('P1D');
		$realEnd = new DateTime($end);
		$realEnd->add($interval);
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
		foreach($period as $date) {
			$array[] = $date->format($format);
		}
		return $array;
	}

	//pagination
    function pagination($total, $get_pages, $per_page = 20){
        $perpage = $per_page;
        $posts  = $total;
        $pages  = ceil($posts / $perpage);
        //$get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $data = array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
                'max_range' => $pages
            )
        );

        $number = trim($get_pages);
        $number = filter_var($number, FILTER_VALIDATE_INT, $data);
        $range  = $perpage * ($number - 1);
        $prev = $number - 1;
        $next = $number + 1;
        $pagination = array('range' => $range, 'perpage' => $perpage, 'prev' => $prev, 'next' => $next, 'number' => $number, 'pages' => $pages);
        return $pagination;
    }

	function vn2latin($cs, $tolower = false){
        /*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
        $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
            "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
            "ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
            "ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
            "Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ"," ","$","%","?","&",'"',',',':',"/");

        /*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
        $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
            "a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o",
            "o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A",
            "A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","-","-","-","-","-","-","-",'',"");

        if ($tolower) {
            return strtolower(str_replace($marTViet,$marKoDau,$cs));
        }
        return str_replace($marTViet,$marKoDau,$cs);
    }

	function createLinks($total, $rows, $currentpage, $event, $links = 7) {
        $last = ceil( $total / $rows );
        $start = ( ( $currentpage - $links ) > 0 ) ? $currentpage - $links : 1;
        $end = ( ( $currentpage + $links ) < $last ) ? $currentpage + $links : $last;

        $html = '';
        $class = ( $currentpage == 1 ) ? "active" : "";

        if ( $start > 1 ) {
            $html .= '<li class="paginate_button"><a aria-controls="example2" data-dt-idx="1" tabindex="0" href="javascript:void(0)" onclick="'.$event.'(1)">1</a></li>';
            $html .= '<li class="paginate_button">';
            $html .= '<a aria-controls="example2" data-dt-idx="1000" tabindex="0">...</a></li>';
        }
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class = ( $currentpage == $i ) ? "active" : "";
            $html .= '<li class="paginate_button ' . $class . '">';
            $html .= '<a aria-controls="example2" data-dt-idx="'.$i.'" tabindex="0" href="javascript:void(0)" onclick="'.$event.'('.$i.')">' . $i . '</a>';
            $html .= '</li>';
        }
        if ( $end < $last ) {
            $html .= '<li class="paginate_button">';
            $html .= '<a aria-controls="example2" data-dt-idx="1000" tabindex="0">...</a></li>';
            $html .= '<li>';
            $html .= '<a aria-controls="example2" data-dt-idx="'.$last.'" tabindex="0" href="javascript:void(0)" onclick="'.$event.'('.$last.')">' . $last . '</a>';
            $html .= '</li>';
        }

        return $html;
    }

    function return_role_url($truonghoc_id, $url){
        $url = explode("/", $url);
        if(($truonghoc_id != 0) && ($url[0] == 'danhmucloi' || $url[0] == 'truonghoc' || $url[0] == 'thanhpho'
            || $url[0] == 'quanhuyen' || $url[0] == 'xaphuong' || $url[0] == 'thonto')){
            return false;
        }else{
            return true;
        }
    }

	function createLinks_event($total, $rows, $currentpage, $event, $links = 7) {
        $last = ceil( $total / $rows );
        $start = ( ( $currentpage - $links ) > 0 ) ? $currentpage - $links : 1;
        $end = ( ( $currentpage + $links ) < $last ) ? $currentpage + $links : $last;

        $html = '';
        $class = ( $currentpage == 1 ) ? "active" : "";
        $html .= '<li class="' . $class . '">';
        if($currentpage > 1){
            $html .= '<a href="javascript:void(0)" onclick="'.$event.'('.( $currentpage - 1 ).')">&laquo;</a>';
            }
        $html .= '</li>';
        if ( $start > 1 ) {
            $html .= '<li><a href="javascript:void(0)" onclick="'.$event.'(1)">1</ahref=></li>';
            $html .= '<li class="active">';
            $html .= '<a href="javascript:void(0)">...</a></li>';
        }
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class = ( $currentpage == $i ) ? "active" : "";
            $html .= '<li class="' . $class . '">';
            $html .= '<a href="javascript:void(0)" onclick="'.$event.'('.$i.')">' . $i . '</a>';
            $html .= '</li>';
        }
        if ( $end < $last ) {
            $html .= '<li class="active ao">';
            $html .= '<a href="javascript:void(0)">...</a></li>';
            $html .= '<li>';
            $html .= '<a href="javascript:void(0)" onclick="'.$event.'('.$last.')">' . $last . '</a>';
            $html .= '</li>';
        }
        if( $currentpage  < $last ){
            $html .= '<li class="' . $class . '"><a href="javascript:void(0)" onclick="'.$event.'('.( $currentpage + 1 ).')">&raquo;</a></li>';
        }

        return $html;
    }

    function daysInWeek($weekNum){
        $result = array();
        $datetime = new DateTime('00:00:00');
        $datetime->setISODate((int)$datetime->format('o'), $weekNum, 1);
        $interval = new DateInterval('P1D');
        $week = new DatePeriod($datetime, $interval, 5);
        foreach($week as $day){
            $result[] = $day->format('D d-m-Y');
        }
        return $result;
    }

    function return_day_text($text){
        if($text == 'Mon'){
            $string = 'Thứ hai';
        }elseif($text == 'Tue'){
            $string = 'Thứ ba';
        }elseif($text == 'Wed'){
            $string = 'Thứ tư';
        }elseif($text == 'Thu'){
            $string = 'Thứ năm';
        }elseif($text == 'Fri'){
            $string = 'Thứ sáu';
        }elseif($text == 'Sat'){
            $string = 'Thứ bảy';
        }elseif($text == 'Sun'){
            $string = 'Chủ nhật';
        }
        return $string;
    }

    function sendmail($to_email, $subject, $msg){
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "ngocdatcorp@gmail.com";
        $mail->Password = "service@123";
        $mail->SetFrom("ngocdatcorp@gmail.com", "Ho tro ky thuat :: NGOCDATCORP");
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->AddAddress($to_email);

        if(!$mail->Send()) {
            $error = 1;
        } else {
            $error = 0;
        }
        return $error;
    }

    /*function sendmail_ts($to_email, $subject, $msg){
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "mncukhoi@gmail.com";
        $mail->Password = "mn@cukhoi123";
        $mail->SetFrom("mncukhoi@gmail.com", "Ban tuyển sinh trường mầm non Cự Khối");
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->AddAddress($to_email);

        if(!$mail->Send()) {
            $error = 1;
        } else {
            $error = 0;
        }
        return $error;
    }*/

    function return_active_menu($control, $url){
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        //////////////////////////////////
        $array = explode(",", $control);
        if(in_array($url[0], $array)){
            $class = 'active menu-open';
        }else{
            $class = '';
        }
        return $class;
    }

    function return_title_quan_he($id){
        if($id == 1){
            $txt = 'Bố';
        }elseif($id == 2){
            $txt = 'Mẹ';
        }elseif($id == 3){
            $txt = 'Anh/Chị/Em';
        }elseif($id == 4){
            $txt = 'Ông/Bà';
        }
        return $txt;
    }

    function return_thongke_website($url){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
        //echo $response;;
        $str = '';
        $first_step = explode( '<table class="thongke W-100">' , $response );
        $second_step = explode("</table>" , $first_step[1] );
        $str = $second_step[0];
        return $str;
    }

    function return_icon_file($txt){
        if($txt != ''){
        $string = explode(".", $txt);
            if($string[1] == 'png' || $string[1] == 'jpg' || $string[1] == 'jpeg' || $string[1] == 'gif'){
                $icon = 'fa-image';
            }elseif($string[1] == 'doc' || $string[1]  == 'docx'){
                $icon = 'fa-file-word-o';
            }elseif($string[1] == 'xls' || $string[1]  == 'xlsx'){
                $icon = 'fa-file-excel-o';
            }elseif($string[1] == 'ppt' || $string[1]  == 'pptx'){
                $icon = 'fa-file-powerpoint-o';
            }elseif($string[1] == 'pdf'){
                $icon = 'fa-file-pdf-o';
            }
        }else{
            $icon = '';
        }
        return $icon;
    }

    function unzip_file($file, $destination){
        // create object
        $zip = new ZipArchive() ;
        // open archive
        if ($zip->open($file) !== TRUE) {
            return false;
        }
        // extract contents to destination directory
        $zip->extractTo($destination);
        // close archive
        $zip->close();
            return true;
    }

    function delete_files($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                $this->delete_files($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }

    function display_chuc_nang($txt){
        if($txt != ''){
            $arr = explode(",", $txt);
            $array = array(1 => 'Thêm mới', 2 => 'Cập nhật', 3 => 'Xóa', 4 => 'Giao việc', 5 => 'Lịch công tác tổ / nhóm',
                            6 => 'Duyệt bài', 7 => 'Duyệt đề nghị', 8 => 'Duyệt hiển thị', 9 => 'Giao lịch', 10 => 'Chuyển lớp',
                            11 => 'Đăng tin');
            foreach ($arr as $key => $value) {
                $mang[] = $array[$value];
            }
            return 'Chức năng: '.implode(", ", $mang);
        }else{
            return '';
        }
    }

    // kiem tra quyen cua nguoi dung
    function check_roles_user($userid, $url, $chucnang){
        $sql = new Model();
        $role = $sql->get_id_of_role($url);
        if(count($role) > 0){
            $id_role = $role[0]['id'];
            if($sql->check_chuc_nang_of_user($userid, $id_role, $chucnang) > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // button them moi dung nhieu lan
    function return_button_add_global($title, $event){
        $html = '
        <button type="button" class="btn btn-success" onclick="'.$event.'">
            <i class="fa fa-plus"></i>
            '.$title.'
        </button>
        ';
        return $html;
    }

    // button them moi dung it lan
    function return_button_add_cheat($title, $event){
        $html = '
        <li><a href="javascript:void(0)" onclick="'.$event.'">'.$title.'</a></li>
        ';
        return $html;
    }

    // button cap nhat dung nhieu lan
    function return_button_update_global($event){
        $html = '
        <button type="button" class="btn btn-primary" onclick="'.$vents.'">
            <i class="fa fa-pencil"></i>
        </button>
        ';
        return $html;
    }

    //button xoa dung nhieu lan
    function return_button_del_global($event){
        $html = '
        <button type="button" class="btn btn-danger" onclick="'.$vents.'">
            <i class="fa fa-trash"></i>
        </button>
        ';
        return $html;
    }
}
?>
