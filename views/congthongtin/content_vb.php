<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data'];
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center">Số văn bản</th>
            <th class="text-center">Ngày văn bản</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Cập nhật<br />lần cuối</th>
            <th class="text-center">Ngày đăng</th>
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
            <td class="text-center"><?php echo $row['so_vanban'] ?></td>
            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['ngay_vanban'])) ?></td>
            <td class="text-center"><?php echo $row['danhmuc'] ?></td>
            <td>
                <a href="<?php echo URL.'/congthongtin/detailvb?id='.$row['id'] ?>">
                    <?php echo $row['tieu_de'] ?>
                </a>
                <?php
                if($row['create_dang'] != ""){
                ?>
                <br/>
                <small>
                    <a href="<?php echo $row['link_dang'] ?>" target="_blank">
                        <?php echo $row['link_dang'] ?>
                    </a>
                </small>
                <?php
                }
                ?>
            </td>
            <td class="text-center"><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td class="text-center"><?php echo ($row['create_dang'] != '') ? date("H:i:s d-m-Y", strtotime($row['create_dang'])) : '' ?></td>
            <td class="text-center">
                <?php
                if($row['create_dang'] == ""){
                    if($convert->check_roles_user($info[0]['id'], $_REQUEST['urlline'], 2)){
                ?>
                <button type="submit" class="btn btn-primary" onclick="edit_vanban(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <?php
                    }
                    if($convert->check_roles_user($info[0]['id'], $_REQUEST['urlline'], 3)){
                ?>
                <button type="submit" class="btn btn-danger" onclick="del_vanban(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php
                    }
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
            <th class="text-center">Số văn bản</th>
            <th class="text-center">Ngày văn bản</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Cập nhật<br />lần cuối</th>
            <th class="text-center">Ngày đăng</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_vanban', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
