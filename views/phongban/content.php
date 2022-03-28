<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $sql = new Model();
?>
<table class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th>Năm học</th>
        <th>Tên vật lý</th>
        <th>Tên năm học</th>
        <th style="width: 200px;text-align:center">Thao tác</th>
    </tr>
    <?php
    $i = 0;
    foreach($jsonObj['rows'] as $row){
        $i++;
        $style = ($row['co_dinh'] == 1) ? 'style="color:red"' : 'style="color:green"';
        if($row['giao_vien'] != ''){
            $arr_gv = explode(",", $row['giao_vien']);
            foreach($arr_gv as $item){
                $array_fullname[$row['id']][] = $sql->get_fullname_users($item);
            }
        }else{
            $array_fullname[$row['id']] = [];
        }
    ?>
    <tr <?php echo $style ?>>
        <td><?php echo $i ?>.</td>
        <td><?php echo $row['namhoc'] ?></td>
        <td id="physic_<?php echo $row['id'] ?>"><?php echo $row['title_physic'] ?></td>
        <td>
            <?php 
                if($row['co_dinh'] == 0){
                echo $row['title_virtual']."<br/>";
                echo "<small style='color:gray'>Giáo viên: ".implode(",", $array_fullname[$row['id']])."</small>";
                }else{
                    echo $row['title_virtual'];
                }
            ?>
        </td>
        <td style="text-align:center">
            <?php
            if($row['co_dinh'] == 0 && $row['status'] == 0){
            ?>
            <button type="submit" class="btn btn-primary" onclick="copy_phongban(<?php echo $row['id'] ?>)"
            title="Copy phòng ban">
                <i class="fa fa-copy"></i>
            </button>
            <?php
            }
            if($row['co_dinh'] == 0){
            ?>
            <button type="submit" class="btn btn-info" onclick="phanbo_giaovien(<?php echo $row['id'] ?>)"
            title="Phân bổ giáo viên">
                <i class="fa fa-cube"></i>
            </button>
            <?php
            }
            ?>
            <button type="submit" class="btn btn-primary" onclick="edit_phongban(<?php echo $row['id'] ?>)">
                <i class="fa fa-pencil"></i>
            </button>
            <button type="submit" class="btn btn-danger" onclick="del_phongban(<?php echo $row['id'] ?>)">
                <i class="fa fa-trash"></i>
            </button>
        </td>
        <td class="hide" id="namhocid_<?php echo $row['id'] ?>"><?php echo $row['namhoc_id'] ?></td>
        <td class="hide" id="codinh_<?php echo $row['id'] ?>"><?php echo $row['co_dinh'] ?></td>
        <td id="virtual_<?php echo $row['id'] ?>" class="hide"><?php echo $row['title_virtual'] ?></td>
        <td id="giaovien_<?php echo $row['id'] ?>" class="hide"><?php echo $row['giao_vien'] ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_phongban', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>