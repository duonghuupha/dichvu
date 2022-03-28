<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data'];
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
            <th>Năm sử dụng</th>
            <th>Nguyên giá</th>
            <th>Khấu hao (%)</th>
            <th>Xuất xứ</th>
            <th style="width: 100px">Thao tác</th>
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
            <td id="code_<?php echo $row['id'] ?>"><?php echo $row['code'] ?></td>
            <td>
                <?php
                if($row['image'] != ''){
                    echo '<img src="'.URL.'/public/assets/'.$row['truonghoc_id'].'/'.$row['image'].'" width="50"/>';
                }else{
                    echo "<i>Chưa có ảnh</i>";
                }
                ?>
            </td>
            <td id="title_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
            <td><?php echo $danhmuc ?></td>
            <td id="namsudung_<?php echo $row['id'] ?>"><?php echo $row['nam_su_dung'] ?></td>
            <td id="nguyengia_<?php echo $row['id'] ?>"><?php echo number_format($row['nguyen_gia']) ?></td>
            <td id="khauhao_<?php echo $row['id'] ?>"><?php echo $row['khau_hao'] ?></td>
            <td id="xuatsu_<?php echo $row['id'] ?>"><?php echo $row['xuat_su'] ?></td>
            <td>
                <?php
                if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
                ?>
                <button type="button" class="btn btn-primary" onclick="edit_thongtin(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <?php
                }
                if($convert->check_roles_user($info[0]['id'], $url[0], 3)){
                ?>
                <button type="button" class="btn btn-danger" onclick="del_thongtin(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php
                }
                ?>
            </td>
            <td class="hide" id="cateid_<?php echo $row['id'] ?>"><?php echo $row['cate_id'] ?></td>
            <td class="hide" id="mota_<?php echo $row['id'] ?>"><?php echo $row['mo_ta'] ?></td>
            <td class="hide" id="image_<?php echo $row['id'] ?>"><?php echo $row['image'] ?></td>
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
            <th>Năm sử dụng</th>
            <th>Nguyên giá</th>
            <th>Khấu hao (%)</th>
            <th>Xuất xứ</th>
            <th style="width: 100px">Thao tác</th>
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
