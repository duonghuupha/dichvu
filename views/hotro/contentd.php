<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px">Mã yêu cầu</th>
            <th>Tiêu đề</th>
            <th>Quản lý</th>
            <th>Ngày khởi tạo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?>.</td>
            <td><?php echo $row['code'] ?></td>
            <td><?php echo $row['dichvu'].' :: '.$row['danhmuc'] ?></td>
            <td>
                <a href="<?php echo URL.'/hotro/timeline?id='.$row['id'] ?>">
                    Xem chi tiết
                </a>
            </td>
            <td><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px">Mã yêu cầu</th>
            <th>Tiêu đề</th>
            <th>Quản lý</th>
            <th>Ngày khởi tạo</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_nguoidung', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>