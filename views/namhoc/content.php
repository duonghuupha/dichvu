<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th>Tiêu đề</th>
        <th>Kích  hoạt</th>
        <th style="width: 100px">Thao tác</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?>.</td>
        <td id="namhoc_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
        <td>
            <?php
            if($row['active'] == 1){
            ?>
            <span class="label label-success" style="cursor: pointer;" onclick="change(<?php echo $row['id'] ?>, 0)">Kích hoạt</span>
            <?php
            }else{
            ?>
            <span class="label label-danger" style="cursor: pointer;"onclick="change(<?php echo $row['id'] ?>, 1)">Không</span>
            <?php
            }
            ?>
        </td>
        <td>
            <button type="submit" class="btn btn-primary" onclick="edit_namhoc(<?php echo $row['id'] ?>)">
                <i class="fa fa-pencil"></i>
            </button>
            <button type="submit" class="btn btn-danger" onclick="del_namhoc(<?php echo $row['id'] ?>, <?php echo $row['active'] ?>)">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_namhoc', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>