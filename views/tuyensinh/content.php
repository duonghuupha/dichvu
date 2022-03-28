<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $roles  = new Roles(); $info = $_SESSION['data'];
$url = explode("/", $_SESSION['url']);
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Mã TS</th>
            <th class="text-center">Họ và tên HS</th>
            <th class="text-center">Ngày sinh</th>
            <th class="text-center">Giới tính</th>
            <th class="text-center">Đối tượng</th>
            <th class="text-center" style="width: 150px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center">
                <a href="<?php echo URL.'/tuyensinh/detail?id='.$row['id'] ?>">
                    <?php echo $row['code']; ?>
                </a>
            </td>
            <td>
                <?php echo $row['ho_ten']; ?><br />
                <small>
                    <?php echo 'Cập nhật lần cuối: '.date("H:i:s d-m-Y", strtotime($row['create_at'])); ?>
                </small>
            </td>
            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['ngay_sinh'])); ?></td>
            <td class="text-center"><?php echo ($row['gioi_tinh'] == 1) ? "Nam" : "Nữ"; ?></td>
            <td class="text-center">
                <?php
                if($row['doi_tuong'] == 1){
                    echo "DT ".$row['doi_tuong'];
                }elseif($row['doi_tuong'] == 2){
                    echo "DT ".$row['doi_tuong'];
                }elseif($row['doi_tuong'] == 3){
                    echo "DT ".$row['doi_tuong'];
                }else{
                    echo "TT";
                }
                ?>
            </td>
            <!--<td class="text-center">
                <?php echo date("H:i:s", strtotime($row['create_at'])); ?>
                <br/>
                <?php echo date("d-m-Y", strtotime($row['create_at'])); ?>
            </td>-->
            <td class="text-center">
                <?php
                if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
                ?>
                <button type="submit" class="btn btn-primary" onclick="edit(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <?php
                }
                if($convert->check_roles_user($info[0]['id'], $url[0], 3)){
                ?>
                <button type="submit" class="btn btn-danger" onclick="del(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
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
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Mã TS</th>
            <th class="text-center">Họ và tên HS</th>
            <th class="text-center">Ngày sinh</th>
            <th class="text-center">Giới tính</th>
            <th class="text-center">Đối tượng</th>
            <th class="text-center" style="width: 150px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_tuyensinh', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
