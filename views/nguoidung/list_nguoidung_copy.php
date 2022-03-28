<?php
$jsonObj = $this->jsonObj;
?>
<script>
$(function(){
    $('#ck_all').on('click',function(){
        if(this.checked){
            $('.ck_copy').each(function(){
                this.checked = true;
            });
        }else{
             $('.ck_copy').each(function(){
                this.checked = false;
            });
        }
    });
    $('.ck_copy').on('click',function(){
        if($('.ck_copy:checked').length == $('.ck_copy').length){
            $('#ck_all').prop('checked',true);
        }else{
            $('#ck_all').prop('checked',false);
        }
    });
});
</script>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th style="width: 10px">
                <input id="ck_all" name="ck_all" type="checkbox" class="ck_all"/>
            </th>
            <th class="text-center">Họ và tên</th>
            <th class="text-center">Nhiệm vụ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj as $row){
            $i++;
        ?>
        <tr>
            <td class="text-center"><?php echo $i ?>.</td>
            <td>
                <input id="ck_<?php echo $row['id'] ?>" name="ck_<?php echo $row['id'] ?>"
                type="checkbox" value="<?php echo $row['id'] ?>" class="ck_copy"/>
            </td>
            <td><?php echo $row['fullname'] ?></td>
            <td class="text-center"><?php echo $row['job'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th style="width: 10px"></th>
            <th class="text-center">Họ và tên</th>
            <th class="text-center">Nhiệm vụ</th>
        </tr>
    </tfoot>
</table>
