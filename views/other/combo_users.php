<option value="">Lựa chọn người dùng</option>
<?php
$jsonObj = $this->jsonObj;
foreach($jsonObj as $row){
    if(isset($_REQUEST['id'])){
        $array = base64_decode($_REQUEST['id']);
        $array = explode(",", $array);
        $selected = (in_array($row['id'], $array)) ? 'selected=""' : '';
    }else{
        $selected = '';
    }
?>
<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['fullname'] ?></option>
<?php
}
?>