<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px">Mã trường</th>
            <th>Tên trường</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th style="width: 150px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?>.</td>
            <td><?php echo $row['code'] ?></td>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td>
                <?php
                if($row['active'] == 1){
                ?>
                <span class="label label-success">Đang sử dụng dịch vụ</span>
                <?php
                }else{
                ?>
                <span class="label label-danger">Chưa sử dụng dịch vụ</span>
                <?php
                }
                ?>
            </td>
            <td>
                <button type="button" class="btn btn-primary" onclick="edit_truonghoc(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="del_truonghoc(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px">Mã trường</th>
            <th>Tên trường</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th style="width: 150px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_truonghoc', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>