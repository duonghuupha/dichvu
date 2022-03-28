<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th>Kiểu dịch vụ</th>
        <th>Dịch vụ</th>
        <th>Nội dung</th>
        <th style="width: 100px">Thao tác</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?>.</td>
        <td><?php echo $row['kieudichvu'] ?></td>
        <td><?php echo $row['dichvu'] ?></td>
        <td id="danhmuc_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
        <td>
            <button type="submit" class="btn btn-primary" onclick="edit_danhmuc(<?php echo $row['id'] ?>)">
                <i class="fa fa-pencil"></i>
            </button>
            <button type="submit" class="btn btn-danger" onclick="del_danhmuc(<?php echo $row['id'] ?>)">
                <i class="fa fa-trash"></i>
            </button>
        </td>
        <td class="hide" id="kieudichvuid_<?php echo $row['id'] ?>"><?php echo $row['kieudichvu_id'] ?></td>
        <td class="hide" id="dichvuid_<?php echo $row['id'] ?>"><?php echo $row['dichvu_id'] ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_danhmuc', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>