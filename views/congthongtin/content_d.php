<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<script>
$(function(){
    $('#ck_all').on('click',function(){
        if(this.checked){
            $('.ck_chuyenlop').each(function(){
                this.checked = true;
            });
        }else{
             $('.ck_chuyenlop').each(function(){
                this.checked = false;
            });
        }
    });
    $('.ck_chuyenlop').on('click',function(){
        if($('.ck_chuyenlop:checked').length == $('.ck_chuyenlop').length){
            $('#ck_all').prop('checked',true);
        }else{
            $('#ck_all').prop('checked',false);
        }
    });
});
</script>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 10px">
                <input id="ck_all" name="ck_all" type="checkbox" class="ck_all"/>
            </th>
            <th class="text-center">Hình ảnh</th>
            <th class="text-center">Têu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
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
            <td class="text-center">
                <input id="ck_<?php echo $row['id'] ?>" name="ck_<?php echo $row['id'] ?>"
                type="checkbox" value="<?php echo $row['id'] ?>" class="ck_chuyenlop"/>
            </td>
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
                <a href="<?php echo URL.'/congthongtin/detailbv?id='.$row['id'] ?>">
                    <?php echo $row['title'] ?>
                </a>
            </td>
            <td class="text-center"><?php echo $row['danhmuc'] ?></td>
            <td class="text-center"><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td class="text-center"><?php echo $row['nguoiviet'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center">Hình ảnh</th>
            <th class="text-center">Têu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Người viết</th>
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