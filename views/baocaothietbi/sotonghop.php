<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data']; $sql = new Model();
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
            <th class="text-center">Xuất xứ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr style="font-weight:700">
            <td class="text-center"><?php echo $i; ?></td>
            <td colspan="8">
                <?php echo $row['title_physic'].' :: '.$row['title_virtual'] ?>
            </td>
        </tr>
        <?php
            $detail[$i] = $sql->get_thietbi_phanbo_phongban($row['id'], 3);
            if(count($detail[$i]) > 0){
                $z[$i] = 0;
                foreach ($detail[$i] as $item) {
                    $z[$i]++;
                    if($item['cateid'] != 0){
                        $danhmuc = $item['danhmuc'];
                    }else{
                        if($item['nguyengia'] >= 10000000){
                            $danhmuc = "Tài sản cố định";
                        }else{
                            $danhmuc = "Công cụ dụng cụ";
                        }
                    }
                ?>
        <tr>
            <td class="text-center"><?php echo $z[$i]; ?></td>
            <td class="text-center"><?php echo $item['mathietbi'].'-'.$item['so_con'] ?></td>
            <td><?php echo $item['title'] ?></td>
            <td class="text-center"><?php echo $danhmuc ?></td>
            <td class="text-center"><?php echo $item['namsudung'] ?></td>
            <td class="text-right"><?php echo number_format($item['nguyengia']) ?></td>
            <td class="text-center"><?php echo $item['khauhao'] ?></td>
            <td class="text-right">
                <?php
                $thoigian = date("Y") - $item['namsudung'];
                $khauhao = $thoigian*$item['khauhao'];
                echo  number_format($item['nguyengia'] - ($item['nguyengia'] * ($khauhao/100)));
                ?>
            </td>
            <td class="text-center"><?php echo $item['xuatsu'] ?></td>
        </tr>
                <?php
                }
            }else{
                echo "<td colspan='9'>P<i>hòng ban / Lớp học chưa được phân bổ thiết bị</i></td>";
            }
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
            <th class="text-center">Xuất xứ</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_tonghop', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
