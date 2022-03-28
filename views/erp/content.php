<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data']; $roles = new Roles(); $sql = new Model();
$url = explode("/", $_SESSION['url']);
?>
<table id="example2" class="table table-bordered table-hover projects">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px;">#</th>
            <th>Công việc</th>
            <th style="text-align:center">Người tham gia</th>
            <th style="text-align:center">Thực hiện chính</th>
            <th style="text-align:center; width:120px;">Tiến độ</th>
            <th style="text-align:center">Trạng thái</th>
            <th style="text-align:center;width:100px"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($jsonObj['rows'] as $row){
            $i++;
            $status = $sql->get_status_task_change($row['id']);
            if(count($status) > 0){
                $tt = 3;
            }else{
                $tt = $row['status'];
            }
            if($tt == 0){
                $trangthai = '<span class="label label-info">Công việc mới</span>';
            }elseif($tt == 1){
                $trangthai = '<span class="label label-warning">Đang xử lý</span>';
            }elseif($tt == 2){
                $trangthai = '<span class="label label-success">Hoàn thành</span>';
            }else{
                $trangthai = '<span class="label label-primary">Chuyển tiếp</span>';
            }
            if($row['user_id_follow'] != ''){
                $userid = explode(",", $row['user_id_follow']); $arr = [1,2,3,4];
                foreach ($userid as $item) {
                    //$array[$i][] = $sql->get_fullname_users($item);
                    $avatar = $sql->get_avatar_user($item);
                    if($avatar[0]['avatar'] != ''){
                        $img = URL.'/public/truonghoc/avatar/'.$avatar[0]['avatar'];
                    }else{
                        $img = URL.'/styles/dist/img/avatar'.$arr[array_rand($arr)].'.png';
                    }
                    $array[$i][] = '
                    <li class="list-inline-item">
                        <a href="#" title="'.$sql->get_fullname_users($item).'" data-toggle="tooltip"
                        data-container="body" data-placement="bottom">
                            <img alt="'.$sql->get_fullname_users($item).'" class="table-avatar"
                            src="'.$img.'"/>
                        </a>
                    </li>
                    ';
                }
                $thamgia = '<ul class="list-inline">'.implode(", ", $array[$i]).'</ul>';
            }else{
                $thamgia = 'Không có người tham gia';
            }
            if($row['uu_tien'] == 3){
                $style = "background:url(styles//dist/img/bg-khan.png) no-repeat right";
            }elseif($row['uu_tien'] == 2){
                $style = "background:url(styles//dist/img/bg-cao.png) no-repeat right";
            }else{
                $style = "";
            }
        ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td style="<?php echo $style ?>">
                <a href="<?php echo URL.'/erp/detail?id='.$row['id'] ?>">
                    <?php echo $row['content'] ?><br/>
                    <small>
                        <i>Nhóm công việc: <?php echo $row['nhomcongviec'] ?></i>
                    </small>
                </a>
            </td>
            <td class="text-center">
                <?php echo $thamgia ?>
            </td>
            <td class="text-center">
                <?php echo $row['fullname'] ?><br/>
            </td>
            <td class="text-center project_progress">
                <div class="progress progress-sm">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['tien_do'] ?>%">
                    </div>
                </div>
                <small>Hoàn thành <?php echo $row['tien_do'] ?>%</small>
            </td>
            <td class="text-center"><?php echo $trangthai ?></td>
            <td class="text-center">
                <?php
                if($row['user_id'] == $info[0]['id'] && $row['tien_do'] != 100){
                    if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
                ?>
                <button type="button" class="btn btn-primary" onclick="edit(<?php echo $row['id'] ?>, <?php echo $row['tien_do'] ?>, <?php echo $tt ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <?php
                }
                if($convert->check_roles_user($info[0]['id'], $url[0], 3)){
                ?>
                <button type="button" class="btn btn-danger" onclick="del(<?php echo $row['id'] ?>, <?php echo $row['tien_do'] ?>, <?php echo $tt ?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php
                }
                }else{
                    echo "<i style='font-size:12px;'>Bạn không có quyền thao tác</i>";
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
            <th>Công việc</th>
            <th style="text-align:center">Người tham gia</th>
            <th style="text-align:center">Thực hiện chính</th>
            <th style="text-align:center">Tiến độ</th>
            <th style="text-align:center">Trạng thái</th>
            <th style="text-align:center;width:100px"></th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_task', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
