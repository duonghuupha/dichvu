<?php
$sql = new Model(); $convert = new Convert(); $info = $_SESSION['data'];
$date = isset($_REQUEST['date']) ? $_REQUEST['date'] : date("Y-m-d");
$calendar = new Calendar($date);$month = date("m-Y", strtotime($date));
$query = $sql->get_all_event_of_month($_SESSION['data'][0]['truonghoc_id'], $month);
$url = explode("/", $_SESSION['url']);
foreach($query as $row){
    if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
        $event = 1; // cap nhat
    }elseif($convert->check_roles_user($info[0]['id'], $url[0], 3)){
        $event = 2; // xoa
    }elseif($convert->check_roles_user($info[0]['id'], $url[0], 2) && $convert->check_roles_user($info[0]['id'], $url[0], 3)){
        $event = 3;
    }else{
        $event = 0;
    }
    $calendar->add_event($row['title'], $row['ngay_hoc'], 1, 'green', $row['id'], $event);
}

echo $calendar;
?>
