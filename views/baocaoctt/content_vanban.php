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
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Ngày đăng</th>
            <th class="text-center">Người viết</th>
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
            <td>
                <a href="#">
                    <?php echo $row['tieu_de'] ?>
                </a>
                <?php
                if($row['create_dang'] != ""){
                ?>
                <br/>
                <small>
                    Link bài viết đã đăng<br />
                    <a href="<?php echo $row['link_dang'] ?>" target="_blank">
                        <?php echo $row['link_dang'] ?>
                    </a>
                </small>
                <?php
                }
                ?>
            </td>
            <td class="text-center"><?php echo $row['danhmuc'] ?></td>
            <td class="text-center"><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td class="text-center"><?php echo ($row['create_dang'] != '') ? date("H:i:s \n d-m-Y", strtotime($row['create_dang'])) : 'Chưa đăng' ?></td>
            <td class="text-center"><?php echo $row['nguoiviet'] ?></td>
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
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Ngày đăng</th>
            <th class="text-center">Người viết</th>
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
