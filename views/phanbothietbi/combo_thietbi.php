<option value="">Lựa chọn thiết bị</option>
<?php
$jsonObj = $this->jsonObj; //$id = base64_decode($_REQUEST['id']); $arr = explode(",", $id);
foreach($jsonObj as $row){
    //$disable = (in_array($row['id'], $arr)) ? 'disabled' : '';
?>
<option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
<?php
}
?>
