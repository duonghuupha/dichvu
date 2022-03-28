<?php
foreach($this->jsonObj as $row){
    if(isset($_REQUEST['id'])){
        $array = explode(",", $_REQUEST['id']);
        $checked = (in_array($row['id'], $array)) ? 'checked=""' : '';
    }else{
        $checked = '';
    }
?>
<label>
    <input type="checkbox" class="flat-red" value="<?php echo $row['id'] ?>" <?php echo $checked ?>
    id="xaphuong_<?php echo $row['id'] ?>" onclick="set_thon_to(<?php echo $row['id'] ?>)"/>
    <?php echo $row['title'] ?>
</label><br />
<?php
}
?>