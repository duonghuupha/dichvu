<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; 
$array = (isset($_REQUEST['data']) && $_REQUEST['data'] != '') ? base64_decode($_REQUEST['data']) : '';
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
            if($array != ''){
                $array1 = explode(",", $array);
                $event = (in_array($row['id'], $array1)) ? '' : 'ondblclick="set_dachon('.$row['id'].')"';
                $style = (in_array($row['id'], $array1)) ? 'class="bg-red"' : '';
            }else{
                $event = 'ondblclick="set_dachon('.$row['id'].')"';
                $style = "";
            }
        ?>
        <tr style="font-size:13px;" <?php echo $event ?> <?php echo $style ?>>
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center"><?php echo $row['code'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>