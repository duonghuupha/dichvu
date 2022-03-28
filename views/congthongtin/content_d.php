<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Cập nhật <br/>lần cuối</th>
            <th>Người viết</th>
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
            <td>
                <?php
                if($row['image'] != ''){
                    echo '<img src="'.URL.'/public/news/'.$row['truonghoc_id'].'/'.$row['image'].'" width="70"/>';
                }else{
                    echo "<i>Chưa có ảnh</i>";
                }
                ?>
            </td>
            <td>
                <a href="<?php echo URL.'/congthongtin/detailbv?id='.$row['id'] ?>">
                    <?php echo $row['title'] ?>
                </a>
            </td>
            <td><?php echo $row['danhmuc'] ?></td>
            <td><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td><?php echo $row['nguoiviet'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Cập nhật <br/>lần cuối</th>
            <th>Người viết</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_baivietd', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}