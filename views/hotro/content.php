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
            <th>Cập nhật lần cuối</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            if($row['status'] == ''){
                $status = '<span class="label label-danger">Mới khởi tạo</span>';
            }elseif($row['status'] == 1){
                $status = '<span class="label label-primary">Đã duyệt</span>';
            }elseif($row['status'] == 2){
                $status = '<span class="label label-info">Đẫ tiếp nhận</span>';
            }elseif($row['status'] == 3){
                $status = '<span class="label label-primary">Đang xử lý</span>';
            }elseif($row['status'] == 4){
                $status = '<span class="label label-success">Đã hoàn thành</span>';
            }
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
            <td><?php echo date("H:i:s d-m-Y", strtotime($row['ngay'])) ?></td>
            <td>
                <?php echo $status ?>
            </td>
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
            <th>Cập nhật lần cuối</th>
            <th>Trạng thái</th>
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