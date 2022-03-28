<?php
$jsonObj = $this->jsonObj;
foreach($jsonObj as $row){
    if(isset($_REQUEST['userid'])){
        $array = base64_decode($_REQUEST['userid']);
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
