<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; 
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Mã HS</th>
            <th class="text-center">Họ và tên</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj as $row){
            $i++;
        ?>
        <tr id="<?php echo $row['id'] ?>"  style="font-size:13px;" ondblclick="cancel_dachon(<?php echo $row['id'] ?>)" >
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center"><?php echo $row['code'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td class="hide" id="id_<?php echo $row['id'] ?>"><?php echo $row['id'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>