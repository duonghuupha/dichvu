<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data']; $sql = new Model();
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px;text-align:center">Avatar</th>
            <th>Username</th>
            <th>Trường học</th>
            <th>Tên đầy đủ</th>
            <th>Nhiệm vụ</th>
            <th>Trạng thái</th>
            <th style="width: 200px;text-align:center">Thao tác</th>
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
            <td style="text-align:center">
                <?php
                if($row['avatar'] != ''){
                    echo "<img src='".URL."/public/truonghoc/avatar/".$row['avatar']."' width='50'/>";
                }else{
                    echo "<img src='".URL."/styles/dist/img/none.png' width='50'/>";
                }
                ?>
            </td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['truonghoc'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['job'] ?></td>
            <td>
                <?php
                if($row['active'] == 1){
                ?>
                <span class="label label-success">Kích hoạt</span>
                <?php
                    }else{
                ?>
                <span class="label label-danger">Chưa kích hoạt</span>
                <?php
                }
                ?>
            </td>
            <td style="text-align:center">
                <?php
                if($info[0]['truonghoc_id'] != 0 && ($sql->check_roles($info[0]['id'], 8) > 0
                || $info[0]['is_boss'] == 1)){
                ?>
                <button type="button" class="btn btn-info" title="Phân quyền" onclick="phanquyen_nguoidung(<?php echo $row['id'] ?>)">
                    <i class="fa fa-cubes"></i>
                </button>
                <button type="button" class="btn btn-success" title="Reset mật khẩu" onclick="reset_pass(<?php echo $row['id'] ?>)">
                    <i class="fa fa-refresh"></i>
                </button>
                <button type="button" class="btn btn-primary" onclick="edit_nguoidung(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="del_nguoidung(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php
                }elseif($info[0]['truonghoc_id'] == 0){
                ?>
                <button type="button" class="btn btn-success" title="Reset mật khẩu" onclick="reset_pass(<?php echo $row['id'] ?>)">
                    <i class="fa fa-refresh"></i>
                </button>
                <button type="button" class="btn btn-primary" onclick="edit_nguoidung(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="del_nguoidung(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
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
            <th style="width: 10px">#</th>
            <th style="width: 100px;text-align:center">Avatar</th>
            <th>Username</th>
            <th>Trường học</th>
            <th>Tên đầy đủ</th>
            <th>Nhiệm vụ</th>
            <th>Trạng thái</th>
            <th style="width: 200px;text-align:center">Thao tác</th>
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