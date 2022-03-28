<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $sql = new Model();
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th style="width: 100px">Mã TB</th>
            <th>Tiêu đề</th>
            <th>Năm sử dụng</th>
            <th>Nguyên giá</th>
            <th>Khấu hao (%)</th>
            <th>Xuất xứ</th>
            <th>Số lượng</th>
            <th style="width: 100px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            $dupli = $sql->check_dupli_code_thietbi($row['truonghoc_id'], $row['code']);
            $style = ($dupli > 1) ? "style='color:red'" : '';
        ?>
        <tr <?php echo $style ?>>
            <td><?php echo $i ?>.</td>
            <td id="code_<?php echo $row['id'] ?>"><?php echo $row['code'] ?></td>
            <td id="title_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
            <td id="namsudung_<?php echo $row['id'] ?>"><?php echo $row['nam_su_dung'] ?></td>
            <td id="nguyengia_<?php echo $row['id'] ?>"><?php echo number_format($row['nguyen_gia']) ?></td>
            <td id="khauhao_<?php echo $row['id'] ?>"><?php echo $row['khau_hao'] ?></td>
            <td id="xuatsu_<?php echo $row['id'] ?>"><?php echo $row['xuat_su'] ?></td>
            <td id="xuatsu_<?php echo $row['id'] ?>"><?php echo $row['so_luong'] ?></td>
            <td>
                <?php
                if($dupli > 1){
                ?>
                <button type="button" class="btn btn-primary" onclick="update_code(<?php echo $row['id'] ?>)">
                    <i class="fa fa-refresh"></i>
                </button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-danger" onclick="del_thongtin_tmp(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
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
            <th>Tiêu đề</th>
            <th>Năm sử dụng</th>
            <th>Nguyên giá</th>
            <th>Khấu hao (%)</th>
            <th>Xuất xứ</th>
            <th>Số lượng</th>
            <th style="width: 100px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_thietbi_tmp', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}