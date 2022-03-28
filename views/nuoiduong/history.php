<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px; text-align:center">#</th>
            <th style="width: 100px; text-align:center">Ngày tháng</th>
            <th class="text-center">Người thực hiện</th>
            <th class="text-center">File dữ liệu</th>
            <th class="text-center">Cập nhật lần cuối</th>
            <th style="width: 150px; text-align:center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr>
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['ngay'])) ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['file'] ?></td>
            <td class="text-center"><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-info" onclick="view_baoan(<?php echo $row['id'] ?>)">
                    <i class="fa fa-search"></i>
                </button>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px; text-align:center">#</th>
            <th style="width: 100px; text-align:center">Ngày tháng</th>
            <th class="text-center">Người thực hiện</th>
            <th class="text-center">File dữ liệu</th>
            <th class="text-center">Cập nhật lần cuối</th>
            <th style="width: 150px; text-align:center">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_baoan', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>