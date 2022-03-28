<option value="">Lựa chọn tỉnh / thành phố</option>
<?php
$jsonObj = $this->jsonObj;
foreach($jsonObj as $row){
    if(isset($_REQUEST['id']) && $_REQUEST['id'] == $row['id']){
        $selected = 'selected=""';
    }else{
        if(isset($_REQUEST['code']) && $_REQUEST['code'] == $row['ma_thanh_pho']){
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