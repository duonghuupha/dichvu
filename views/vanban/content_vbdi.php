<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $roles = new Roles(); $info = $_SESSION['data'];
?>
<table id="example2" class="table table-bordered table-hover">
<thead>
        <tr>
            <th style="width: 10px;text-align:center">#</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Người tạo</th>
            <th style="text-align:center">File</th>
            <th style="text-align:center">Cập nhật<br/>lần cuối</th>
            <th style="width: 100px;text-align:center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr>
            <td style="text-align:center"><?php echo $i ?>.</td>
            <td>
                <a href="<?php echo URL.'/vanban/detailvbdi?id='.$row['id'] ?>">
                    <?php echo $row['title'] ?>
                </a><br />
                <small>
                    Số văn bản: <?php echo $row['so_vanban'] ?> - Ngày văn bản: <?php echo date("d-m-Y", strtotime($row['ngay_vanban'])) ?>
                </small>
            </td>
            <td><?php echo $row['danhmuc'] ?></td>
            <td><?php echo $row['nguoitao'] ?></td>
            <td style="text-align:center">
                <a href="<?php echo URL.'/public/vanban/'.$row['truonghoc_id'].'/'.$row['file'] ?>" target="_blank">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </td>
            <td style="text-align:center">
                <?php echo date("H:i:s", strtotime($row['create_at'])) ?><br/>
                <?php echo date("d-m-Y", strtotime($row['create_at'])) ?>
            </td>
            <td style="text-align:center">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_REQUEST['urlline'], 2)){
                ?>
                <button type="submit" class="btn btn-primary" onclick="edit_vanbandi(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <?php
                }
                if($convert->check_roles_user($info[0]['id'], $_REQUEST['urlline'], 3)){
                ?>
                <button type="submit" class="btn btn-danger" onclick="del_vanbandi(<?php echo $row['id'] ?>)">
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
            <th style="width: 10px;text-align:center">#</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Người tạo</th>
            <th style="text-align:center">File</th>
            <th style="text-align:center">Cập nhật<br/>lần cuối</th>
            <th style="width: 100px;text-align:center">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_vanbandi', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
