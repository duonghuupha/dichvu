<?php
foreach($this->jsonObj as $row){
?>
<strong>
    <input type="radio" name="hotro_id" id="hotro_id" value="<?php echo $row['id'] ?>"/> 
    <?php echo $row['title'] ?>
</strong>
<hr />
<?php
}
?>