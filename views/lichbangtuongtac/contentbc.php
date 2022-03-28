<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table class="table table-bordered">
    <tr>
        <th class="text-center" style="width: 10px" rowspan="2">#</th>
        <th class="text-center" rowspan="2">Giáo viên</th>
        <th class="text-center" rowspan="2">Ngày dạy</th>
        <th class="text-center" colspan="2">Thời gian</th>
        <th class="text-center" rowspan="2">Nội dung</th>
    </tr>
    <tr>
        <th class="text-center">Bắt đầu</th>
        <th class="text-center">Kết thúc</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?>.</td>
        <td><?php echo $row['fullname'] ?></td>
        <td class="text-center"><?php echo date("d-m-Y", strtotime($row['ngay_hoc'])) ?></td>
        <td class="text-center"><?php echo $row['bat_dau'] ?></td>
        <td class="text-center"><?php echo $row['ket_thuc'] ?></td>
        <td><?php echo $row['title'] ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_baocao', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
