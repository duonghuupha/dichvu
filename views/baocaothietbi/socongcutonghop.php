<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data'];
$url = explode("/", $_SESSION['url']);
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center">Mã TB</th>
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Năm sử dụng</th>
            <th class="text-center">Nguyên giá</th>
            <th class="text-center">Khấu hao (%/năm)</th>
            <th class="text-center">Giá trị còn lại</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Xuất xứ</th>
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
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center"><?php echo $row['code'] ?></td>
            <td><?php echo $row['title'] ?></td>
            <td class="text-center"><?php echo $danhmuc ?></td>
            <td class="text-center"><?php echo $row['nam_su_dung'] ?></td>
            <td class="text-right"><?php echo number_format($row['nguyen_gia']) ?></td>
            <td class="text-center"><?php echo $row['khau_hao'] ?></td>
            <td class="text-right">
            <?php
            $thoigian = date("Y") - $row['nam_su_dung'];
            $khauhao = $thoigian*$row['khau_hao'];
            echo  number_format($row['nguyen_gia'] - ($row['nguyen_gia'] * ($khauhao/100)));
            ?>
            </td>
            <td class="text-center"><?php echo $row['so_luong'] ?></td>
            <td class="text-center"><?php echo $row['xuat_su'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center">Mã TB</th>
            <th class="text-center">Tiêu đề</th>
            <th class="text-center">Danh mục</th>
            <th class="text-center">Năm sử dụng</th>
            <th class="text-center">Nguyên giá</th>
            <th class="text-center">Khấu hao (%/năm)</th>
            <th class="text-center">Giá trị còn lại</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Xuất xứ</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_congcu', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
