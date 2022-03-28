<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $sql = new Model();
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Mã HS</th>
            <th class="text-center">Họ và tên</th>
            <th class="text-center">Ngày sinh</th>
            <th class="text-center">Giới tính</th>
            <th class="text-center">Địa chỉ</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            $dupli = $sql->check_dupli_code_hocsinh($row['truonghoc_id'], $row['code']);
            $style = ($dupli > 1) ? "style='color:red'" : '';
        ?>
        <tr <?php echo $style ?>>
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center"><?php echo $row['code'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['ngay_sinh'])) ?></td>
            <td class="text-center"><?php echo ($row['gioi_tinh'] == 1) ? 'Nam' : 'Nữ' ?></td>
            <td><?php echo $row['dia_chi'] ?></td>
            <td class="text-center">
                <?php
                if($dupli > 1){
                ?>
                <button type="button" class="btn btn-primary" onclick="update_code(<?php echo $row['id'] ?>)">
                    <i class="fa fa-refresh"></i>
                </button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-danger" onclick="del_hocsinh_tmp(<?php echo $row['id'] ?>)">
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
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Mã HS</th>
            <th class="text-center">Họ và tên</th>
            <th class="text-center">Ngày sinh</th>
            <th class="text-center">Giới tính</th>
            <th class="text-center">Địa chỉ</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_hocsinh_tmp', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>