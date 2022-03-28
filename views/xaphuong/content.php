<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th class="text-center">Mã tỉnh / thành phố</th>
        <th class="text-center">Tên tỉnh / thành phố</th>
        <th class="text-center">Mã quận / huyện</th>
        <th class="text-center">Tên quận/ huyện</th>
        <th class="text-center">Mã xã / phường</th>
        <th class="text-center">Tên xã / phường</th>
        <th style="width: 100px">Thao tác</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?>.</td>
        <td class="text-center" id="mathanhpho_<?php echo $row['id'] ?>"><?php echo $row['ma_thanh_pho'] ?></td>
        <td><?php echo $row['thanhpho'] ?></td>
        <td class="text-center" id="maquanhuyen_<?php echo $row['id'] ?>"><?php echo $row['ma_quan_huyen'] ?></td>
        <td><?php echo $row['quanhuyen'] ?></td>
        <td class="text-center" id="maxaphuong_<?php echo $row['id'] ?>"><?php echo $row['ma_xa_phuong'] ?></td>
        <td id="title_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
        <td class="text-center">
            <button type="submit" class="btn btn-primary" onclick="edit(<?php echo $row['id'] ?>)">
                <i class="fa fa-pencil"></i>
            </button>
            <button type="submit" class="btn btn-danger" onclick="del(<?php echo $row['id'] ?>)">
                <i class="fa fa-trash"></i>
            </button>
        </td>
        <td class="hide" id="thanhphoid_<?php echo $row['id'] ?>"><?php echo $row['thanhphoid'] ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_xaphuong', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>