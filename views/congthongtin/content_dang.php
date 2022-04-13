<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th class="text-center">Hình ảnh</th>
            <th>Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th >Người viết</th>
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
                <?php
                if($row['image'] != ''){
                    echo '<img src="'.URL.'/public/news/'.$row['truonghoc_id'].'/'.$row['image'].'" width="70" height="50"/>';
                }else{
                    echo '<img src="'.URL.'/styles/no_image.jpg" width="70" height="50"/>';
                }
                ?>
            </td>
            <td>
                <a href="<?php echo URL.'/congthongtin/detailbv?id='.$row['id'] ?>">
                    <?php echo $row['title'] ?>
                </a>
            </td>
            <td class="text-center"><?php echo $row['danhmuc'] ?></td>
            <td class="text-center"><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td><?php echo $row['nguoiviet'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th class="text-center">Hình ảnh</th>
            <th>Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th >Người viết</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_baiviet_dang', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
