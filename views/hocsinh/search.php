<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $namhoc = $_REQUEST['namhocid']; $lophoc = $_REQUEST['lophoc'];
$sql = new Model();
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Mã HS</th>
            <th class="text-center">Họ và tên</th>
            <th class="text-center">Ngày sinh</th>
            <th class="text-center">Giới tính</th>
            <th class="text-center">Lớp</th>
            <th class="text-center">Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            //$lophocid = ($row['lophoc_id'] != '') ? $row['lophoc_id'] : 0;
        ?>
        <tr>
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center">
                <?php echo $row['code'] ?></a>
            </td>
            <td><?php echo $row['fullname'] ?></td>
            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['ngay_sinh'])) ?></td>
            <td class="text-center"><?php echo ($row['gioi_tinh'] == 1) ? 'Nam' : 'Nữ' ?></td>
            <td class="text-center">
                <?php
                if($namhoc != ''){ // lay lop theo nam hoc
                    echo $sql->get_title_lophoc_via_namhoc($row['id'], $namhoc);
                }else{ // lay lop theo du lieu truyen vao
                    echo $sql->get_title_lophoc($lophoc);
                }
                ?>
            </td>
            <td class="text-center">
                <?php
                if($row['status'] == 1){
                ?>
                <span class="label label-success">Đang đi học</span>
                <?php
            }elseif($row['status'] == 2){
                ?>
                <span class="label label-danger">Nghỉ học</span>
                <?php
                }
                ?>
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
            <th class="text-center">Lớp</th>
            <th class="text-center">Trạng thái</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_baocao', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
