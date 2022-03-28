<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;$info = $_SESSION['data'];
$url = explode("/", $_SESSION['url']);
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px">Mã TB</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Thao tác</th>
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
            <td class="text-center">
                <form>
                    <input type="text" name="qty_<?php echo $row['id'] ?>" id="qty_<?php echo $row['id'] ?>"
                    style="width:50px;text-align:center" class="form-control" value="<?php echo $row['so_luong'] ?>"/>
                </form>
            </td>
            <td class="text-center">
                <?php
                if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
                ?>
                <button type="button" class="btn btn-primary" onclick="update_qty(<?php echo $row['id'] ?>)">
                    <i class="fa fa-save"></i> Cập nhật
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
            <th style="width: 100px">Mã TB</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Thao tác</th>
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
