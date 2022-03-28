<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $sql = new Model();
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th class="text-center">Mã phân bổ</th>
            <th class="text-center">Năm học</th>
            <th class="text-center">Phòng ban</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Thiết bị được phân bổ</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            $detail = $sql->get_list_thietbi_dc_phanbo($row['code']);
            if(count($detail) > 0){
                foreach($detail as $item){
                    $array[$row['id']][] = '* '.$item['thietbi'].'-'.$item['so_con'];
                    $arrtb[$row['id']][] = $item['thietbi_id'];
                    $arrtbdc[$row['id']][] = $item['thietbi_id'].'.'.$item['so_con'];
                }
            }else{
                $array[$row['id']] = [];
                $arrtb[$row['id']] = [];
                $arrtbdc[$row['id']] = [];
            }
        ?>
        <tr>
            <td><?php echo $i ?>.</td>
            <td id="code_<?php echo $row['id'] ?>"><?php echo $row['code'] ?></td>
            <td><?php echo $row['namhoc'] ?></td>
            <td><?php echo $row['phongban'] ?></td>
            <td><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
            <td>
                <?php echo implode("<br/>", $array[$row['id']]) ?>
            </td>
            <td>
                <button type="button" class="btn btn-primary" onclick="edit_phanbo(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="del_phanbo(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
            <td class="hide" id="phongbanid_<?php echo $row['id'] ?>"><?php echo $row['phongban_id'] ?></td>
            <td class="hide" id="tb_<?php echo $row['id'] ?>"><?php echo implode(",", $arrtb[$row['id']]) ?></td>
            <td class="hide" id="tbdc_<?php echo $row['id'] ?>"><?php echo implode(",", $arrtbdc[$row['id']]) ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th class="text-center">Mã phân bổ</th>
            <th class="text-center">Năm học</th>
            <th class="text-center">Phòng ban</th>
            <th class="text-center">Cập nhật <br/>lần cuối</th>
            <th class="text-center">Thiết bị được phân bổ</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_phanbo', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
