<option value="">Lựa chọn thiết bị</option>
<?php
foreach($this->jsonObj as $row){
?>
<option value="<?php echo $row['thietbi_id'].'.'.$row['so_con'] ?>"><?php echo $row['title'].' - '.$row['so_con'] ?></option>
<?php
}
?>