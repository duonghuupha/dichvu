<option value="">Lựa chọn quận / huyện</option>
<?php
$jsonObj = $this->jsonObj;
foreach($jsonObj as $row){
    if(isset($_REQUEST['id']) && $_REQUEST['id'] == $row['id']){
        $selected = 'selected=""';
    }else{
        if(isset($_REQUEST['code']) && $_REQUEST['code'] == $row['ma_quan_huyen']){
            $selected = 'selected=""';
        }else{
            $selected = '';
        }
    }
?>
<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['title'] ?></option>
<?php
}
?>