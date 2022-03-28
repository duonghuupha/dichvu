<?php
foreach($this->jsonObj as $row){
    if(isset($_REQUEST['id'])){
        $array = base64_decode($_REQUEST['id']);
        $array = explode(",", $array);
        $checked = (in_array($row['id'], $array)) ? 'checked=""' : '';
    }else{
        $checked = '';
    }
?>
<label>
    <input type="checkbox" class="flat-red" value="<?php echo $row['id'] ?>" <?php echo $checked ?>
    id="thonto_<?php echo $row['id'] ?>" onclick="set_array(<?php echo $row['id'] ?>)"/>
    <?php echo $row['title'].' - '.$row['xaphuong'] ?>
</label><br />
<?php
}
?>