<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data'];
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center">Hình ảnh</th>
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Ngày đăng</th>
            <th class="text-center">Người viết</th>
            <th class="text-center">Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            if($row['status'] == 0){
                $status = '<span class="label label-danger">Chưa duyệt</span>';
            }elseif($row['status'] == 1){
                $status = '<span class="label label-success">Đã duyệt</span>';
            }else{
                $status = '<span class="label label-primary">Đã đăng</span>';
            }
        ?>
        <tr>
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center">
                <?php
                if($row['image'] != ''){
                    echo '<img src="'.URL.'/public/news/'.$row['truonghoc_id'].'/'.$row['image'].'" width="50" height="50" style="border-radius:50%"/>';
                }else{
                    echo "<i>Chưa có ảnh</i>";
                }
                ?>
            </td>
            <td>
                <a href="#">
                    <?php echo $row['title'] ?>
                </a>
                <?php
                if($row['status'] == 2){
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
            <td class="text-center"><?php echo ($row['create_dang'] != '') ? date("H:i:s d-m-Y", strtotime($row['create_dang'])) : '' ?></td>
            <td class="text-center"><?php echo $row['nguoiviet'] ?></td>
            <td class="text-center"><?php echo $status ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center">Hình ảnh</th>
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Ngày đăng</th>
            <th class="text-center">Người viết</th>
            <th class="text-center">Trạng thái</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_baiviet', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
