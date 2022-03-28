<?php
require_once './libs/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$html = file_get_contents(DIR_UPLOAD."/temp/lichtuan.html");

$sql = new Model(); $convert = new Convert(); $info = $_SESSION['data'];
$coquan = $this->truonghoc;
$array_day = $convert->daysInWeek($_REQUEST['tuan']);
$msg = '';
$msg .= '
    <colgroup style="width:3%"></colgroup>
    <colgroup style="width:6%"></colgroup>
    <colgroup style="width:5%"></colgroup>
    <colgroup style="width:15%"></colgroup>
    <colgroup style="width:15%"></colgroup>
    <colgroup style="width:15%"></colgroup>
    <colgroup style="width:15%"></colgroup>
    <colgroup style="width:15%"></colgroup>
    <colgroup style="width:15%"></colgroup>
    <tr>
        <th>TT</th>
        <th>Họ và tên</th>
        <th>Buổi</th>
';

foreach($array_day as $row){
    $msg .= '
        <th>'.$convert->return_day_text(date("D", strtotime($row))).'<br/>'.date("d-m", strtotime($row)).'</th>
    ';
}
$msg .='</tr>';

$i = 0;
foreach($this->jsonObj as $row){
    $i++;
    $msg .= '
    <tr>
        <td style="text-align:center;font-weight:700" rowspan="2"> '.$i.'</td>
        <td style="text-align:center;font-weight:700" rowspan="2">'.$row['fullname'].'<br/><i style="font-weight:12px;font-size:12px;">('.$row['job'].')</i></td>
        <td style="text-align:center;font-weight:700">Sáng</td>
    ';
    foreach($array_day as $item){
        $msg .= '
            <td style="vertical-align:top;font-size:13px;">
        ';
        $task[$row['id']] = $sql->get_list_task_via_day(date("Y-m-d", strtotime($item)), $row['id'], 1);
        if(count($task[$row['id']]) > 0){
            foreach ($task[$row['id']] as $value) {
                $arr = $value['user_id_follow']; $arr = explode(",", $arr);
                $giamsat = (in_array($row['id'], $arr)) ? '<i style="font-size:12px">(Giám sát)</i>' : '';
                $msg .= "<p>- ".$value['content']." ".$giamsat."</p>";
            }
        }else{
            $msg .= "<i>Chưa có công việc</i>";
        }
        $msg .= "</td>";
    }
    $msg .= '
    <tr>
        <td style="text-align:center;font-weight:700">Chiều</td>
    ';
    foreach($array_day as $item){
        $msg .= '
            <td style="vertical-align:top;font-size:13px;">
        ';
        $task[$row['id']] = $sql->get_list_task_via_day(date("Y-m-d", strtotime($item)), $row['id'], 2);
        if(count($task[$row['id']]) > 0){
            foreach ($task[$row['id']] as $value) {
                $arr = $value['user_id_follow']; $arr = explode(",", $arr);
                $giamsat = (in_array($row['id'], $arr)) ? '<i style="font-size:12px">(Giám sát)</i>' : '';
                $msg .= "<p>- ".$value['content']." ".$giamsat."</p>";
            }
        }else{
            $msg .= "<i>Chưa có công việc</i>";
        }
        $msg .= "</td>";
    }
    $msg .= '
    </tr>
    ';
}

$html = str_replace("####coquan####", $coquan[0]['title'], $html);
$html = str_replace("####noidung####", $msg, $html);
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Lich_cong_tac_tuan", array("Attachment" => 1));
?>
