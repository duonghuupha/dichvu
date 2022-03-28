<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data'];
$url = explode("/", $_SESSION['url']);
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Số phiếu</th>
            <th class="text-center">Ngày đề nghị</th>
            <th>Nội dung</th>
            <th>Ghi chú</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Cập nhât<br />lần cuối</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
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
            <td class="text-center">
                <a href="javascript:void(0)" onclick="detail(<?php echo $row['id'] ?>, <?php echo $row['trang_thai'] ?>, <?php echo $row['user_app'] ?>, <?php echo $row['user_id'] ?>, '<?php echo $row['file'] ?>')">
                    <?php echo $row['code'] ?>
                </a>
                <?php
                if($row['trang_thai'] == 1 && $row['file'] != ''){
                ?>
                <small>Minh chứng</small>
                <?php
                }
                ?>
            </td>
            <td class="text-center"><?php echo $row['ngay_de_nghi'] ?></td>
            <td><?php echo$row['content'] ?></td>
            <td><?php echo $row['ghi_chu'] ?></td>
            <td class="text-center">
                <?php
                if($row['trang_thai'] == 1){
                ?>
                <span class="label label-success">Đã duyệt</span>
                <?php
                }else{
                ?>
                <span class="label label-danger">Chờ duyệt</span>
                <?php
                }
                ?>
            </td>
            <td class="text-center">
                <?php
                echo date("H:i:s", strtotime($row['create_at']))."<br/>";
                echo date("d-m-Y",  strtotime($row['create_at']));
                ?>
            </td>
            <td class="text-center">
                <?php
                if($row['trang_thai'] != 1 && $row['user_id'] == $info[0]['id']){
                    if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
                ?>
                <button type="button" class="btn btn-primary" onclick="edit(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <?php
                    }
                    if($convert->check_roles_user($info[0]['id'], $url[0], 3)){
                ?>
                <button type="button" class="btn btn-danger" onclick="del(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php
                    }
                }else{
                    echo "<i style='font-size:12px;'>Bạn không có quyền thao tác</i>";
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
            <th class="text-center" style="width: 100px">Số phiếu</th>
            <th class="text-center">Ngày đề nghị</th>
            <th>Nội dung</th>
            <th>Ghi chú</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Cập nhât<br />lần cuối</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_trangcap', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
