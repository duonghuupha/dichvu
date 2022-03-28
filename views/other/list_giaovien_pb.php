<?php
$jsonObj = $this->jsonObj; $phongban = $this->phongban; $disabled = $this->disabled; $disabled = explode(",", $disabled);
$arr_checked = ($phongban[0]['giao_vien'] != '') ? explode(",", $phongban[0]['giao_vien']) : array();
if($phongban[0]['giao_vien'] != ''){
?>
<script>
$(function(){
    var data_giaovien = '<?php echo $phongban[0]['giao_vien'] ?>';
    giaovien = data_giaovien.split(",").map(Number);
});
</script>
<?php
}
?>
<div class="row fontawesome-icon-list">
    <?php
    foreach($jsonObj as $row){
        if(in_array($row['id'], $arr_checked)){
            $checked = 'checked=""';
        }else{
            if(in_array($row['id'], $disabled)){
                $checked = 'checked="" disabled=""';
            }else{
                $checked = '';
            }
        }
    ?>
    <div class="col-md-3 col-sm-4">
        <div class="form-group">
            <label>
                <input type="checkbox" class="flat-red" name="active" id="active_<?php echo $row['id'] ?>"
                value="<?php echo $row['id'] ?>" onclick="pbgv(<?php echo $row['id'] ?>)"
                <?php echo $checked ?>/>
                <?php echo $row['fullname'] ?><br/>
                <small style="font-weight:normal;color:gray">
                    Nhiệm vụ: <?php echo $row['job'] ?>
                </small>
            </label>
        </div>
    </div>
    <?php
    }
    ?>
</div>