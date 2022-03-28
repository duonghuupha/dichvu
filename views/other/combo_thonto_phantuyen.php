<option value="">Lựa chọn thôn / tổ</option>
<?php
$jsonObj = $this->jsonObj;
foreach($jsonObj as $row){
    if(isset($_REQUEST['id'])){
        $array = explode(",", $_REQUEST['id']);
        $selected = (in_array($row['id'], $array)) ? 'selected=""' : '';
    }else{
        $selected = '';
    }
?>
<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['title'].' - '.$row['xaphuong'] ?></option>
<?php
}
?>