<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $sql = new Model(); $role = new Roles(); $info = $_SESSION['data'];
$url = explode("/", $_SESSION['url']);
?>
    <table class="table table-bordered">
        <tr>
            <th style="width: 10px">#</th>
            <th>Tên nhóm công việc</th>
            <th>Chủ trì</th>
            <th>Tham gia</th>
            <th style="width: 100px">Thao tác</th>
        </tr>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            if($row['user_id_follow'] != ''){
                $userid = explode(",", $row['user_id_follow']);
                foreach ($userid as $item){
                    $array[$i][] = $sql->get_fullname_users($item);
                }
                $nguoithamgia = implode(", ", $array[$i]);
            }else{
                $nguoithamgia = "<i>Không có người tham gia</i>";
            }
            ?>
            <tr>
                <td><?php echo $i ?>.</td>
                <td id="title_<?php echo $row['id'] ?>"><?php echo $row['title'] ?></td>
                <td><?php echo $row['nguoitao'] ?></td>
                <td><?php echo $nguoithamgia ?></td>
                <td>
                    <?php
                    if($convert->check_roles_user($info[0]['id'], $url[0], 2) && $row['user_id'] == $info[0]['id']){
                    ?>
                    <button type="button" class="btn btn-primary" onclick="edit(<?php echo $row['id'] ?>)">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <?php
                    }
                    if($convert->check_roles_user($info[0]['id'], $url[0], 3) && $row['user_id'] == $info[0]['id']){
                    ?>
                    <button type="button" class="btn btn-danger" onclick="del(<?php echo $row['id'] ?>)">
                        <i class="fa fa-trash"></i>
                    </button>
                    <?php
                    }
                    ?>
                </td>
                <td class="hide" id="userfollow_<?php echo $row['id'] ?>"><?php echo $row['user_id_follow'] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_nhomcongviec', 1);
    ?>
    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $createlink ?>
        </ul>
    </div>
    <?php
}
?>
