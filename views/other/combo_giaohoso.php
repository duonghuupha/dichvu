<option value="">Lựa chọn</option>
<?php
$item = $this->jsonObj;
$html = '[';
$array[] = array('cmnd' => $item[0]['cmnd_me'], 'fullname' => $item[0]['ten_me']);
$array[] = array('cmnd' => $item[0]['cmnd_bo'], 'fullname' => $item[0]['ten_bo']);
$array[] = array('cmnd' => $item[0]['cmnd_do_dau'], 'fullname' => $item[0]['ten_do_dau']);

foreach($array as $row){
    if($row['cmnd'] != ''){
        $selected = (isset($_REQUEST['cmnd']) && $_REQUEST['cmnd'] == $row['cmnd']) ? 'selected=""' : '';
        //$code[] = '{"cmnd":"'.$row['cmnd'].'","fullname":"'.$row['fullname'].'"}';
        echo '<option value="'.$row['cmnd'].'" '.$selected.'>'.$row['fullname'].'</option>';
    }
}
?>