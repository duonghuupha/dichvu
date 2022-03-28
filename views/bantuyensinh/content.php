<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $sql = new Model();
?>
<table class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th>Năm học</th>
        <th>Thành viên</th>
        <th style="width: 100px">Thao tác</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
        $array = explode(",", $row['user_id']);
        foreach($array as $item){
            $fullname[$row['id']][] = $sql->get_fullname_users($item);
        }
    ?>
    <tr>
        <td><?php echo $i ?>.</td>
        <td><?php echo $row['namhoc'] ?></td>
        <td><?php echo implode(", ", $fullname[$row['id']]) ?></td>
        <td>
            <button type="submit" class="btn btn-primary" onclick="edit_tuyensinh(<?php echo $row['id'] ?>)">
                <i class="fa fa-pencil"></i>
            </button>
            <button type="submit" class="btn btn-danger" onclick="del_tuyensinh(<?php echo $row['id'] ?>)">
                <i class="fa fa-trash"></i>
            </button>
        </td>
        <td class="hide" id="namhocid_<?php echo $row['id'] ?>"><?php echo $row['nam_hoc_id'] ?></td>
        <td class="hide" id="userid_<?php echo $row['id'] ?>"><?php echo $row['user_id'] ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_bantuyensinh', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>