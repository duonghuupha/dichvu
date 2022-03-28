<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table class="table table-bordered">
    <tr>
        <th class="text-center" style="width: 10px">#</th>
        <th>Tiêu đề</th>
        <th class="text-center">Bắt đầu</th>
        <th class="text-center">Kết thúc</th>
        <th class="text-center">Số lượng<br/>cần cập nhật</th>
        <th class="text-center" style="width: 100px">Thao tác</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
    ?>
    <tr>
        <td class="text-center"><?php echo $i ?>.</td>
        <td id="titleexam_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
        <td class="text-center" id="datestart_<?php echo $row['id'] ?>"><?php echo date("d-m-Y",  strtotime($row['date_start'])) ?></td>
        <td class="text-center" id="dateend_<?php echo $row['id'] ?>"><?php echo date("d-m-Y",  strtotime($row['date_end'])) ?></td>
        <td class="text-center" id="soluong_<?php echo $row['id'] ?>"><?php echo $row['so_luong'] ?></td>
        <td class="text-center">
            <button type="submit" class="btn btn-primary" onclick="edit_exam(<?php echo $row['id'] ?>)">
                <i class="fa fa-pencil"></i>
            </button>
            <button type="submit" class="btn btn-danger" onclick="del_exam(<?php echo $row['id'] ?>)">
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
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_exam', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
