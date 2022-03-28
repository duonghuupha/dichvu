<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<script>
$(function(){
    $('input[type="checkbox"].ck_inma').iCheck({
        checkboxClass: 'icheckbox_flat-green'
    });
})
</script>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 10px"></th>
            <th style="width: 100px">Mã TB</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Số lượng</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            if($row['cate_id'] != 0){
                $danhmuc = $row['danhmuc'];
            }else{
                if($row['nguyen_gia'] >= 10000000){
                    $danhmuc = "Tài sản cố định";
                }else{
                    $danhmuc = "Công cụ dụng cụ";
                }
            }
        ?>
        <tr>
            <td><?php echo $i ?>.</td>
            <td>
                <input id="ck_<?php echo $row['id'] ?>" name="ck_<?php echo $row['id'] ?>"
                type="checkbox" value="<?php echo $row['id'] ?>" class="ck_inma"/>
            </td>
            <td><?php echo $row['code'] ?></td>
            <td>
                <?php
                if($row['image'] != ''){
                    echo '<img src="'.URL.'/public/assets/'.$row['truonghoc_id'].'/'.$row['image'].'" width="50"/>';
                }else{
                    echo "<i>Chưa có ảnh</i>";
                }
                ?>
            </td>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $danhmuc ?></td>
            <td>
                <input type="text" name="qty_<?php echo $row['id'] ?>" id="qty_<?php echo $row['id'] ?>" 
                    style="width:50px;text-align:center" class="form-control" value="<?php echo $row['so_luong'] ?>"/>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 10px"></th>
            <th style="width: 100px">Mã TB</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Số lượng</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_thietbi', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>