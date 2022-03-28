<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page; $info = $_SESSION['data'];
$url = explode("/", $_SESSION['url']);
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Hình ảnh</th>
            <th class="text-center" style="width:250px">Nhóm dữ liệu</th>
            <th class="text-center">Lĩnh vực</th>
            <th class="text-center">Đề tài</th>
            <th class="text-center">Cập nhật<br/>lần cuối</th>
            <th class="text-center">Tác giả</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center" style="width: 150px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
            if($row['is_e'] == 1){
                $img = '<img src="'.URL.'/styles/dist/img/ele.png" width="50px"/>';
            }else{
                $img = '<img src="'.URL.'/styles/dist/img/tn.png" width="50px"/>';
            }
        ?>
        <tr>
            <td class="text-center"><?php echo $i ?>.</td>
            <td class="text-center">
                <?php echo $img ?>
            </td>
            <td><?php echo $row['exam'] ?></td>
            <td id="linhvuc_<?php echo $row['id'] ?>"><?php echo $row['linh_vuc'] ?></td>
            <td id="detai_<?php echo $row['id'] ?>">
                <?php
                if($row['is_e'] == 1){
                    echo '<a href="'.URL.'/public/elearning/'.$row['truonghoc_id'].'/'.$row['exam_id'].'/'.$row['user_id'].'" target="_blank">'.$row['de_tai'].'</a>';
                }else{
                    echo '<a href="'.URL.'/public/elearning/'.$row['truonghoc_id'].'/'.$row['exam_id'].'/'.$row['user_id'].'/'.$row['file'].'" target="_blank">'.$row['de_tai'].'</a>';
                }
                ?>
            </td>
            <td class="text-center"><?php echo date("H:i:s", strtotime($row['create_at']))."<br/>".date("d-m-Y", strtotime($row['create_at'])) ?></td>
            <td class="text-center"><?php echo $row['tacgia'] ?></td>
            <td class="text-center">
                <?php
                echo ($row['publish'] == 1) ? 'Công khai' : 'Không công khai';
                ?>
            </td>
            <td class="text-center">
                <?php
                if($convert->check_roles_user($info[0]['id'], $url[0], 2)){
                ?>
                <button type="button" class="btn btn-primary" onclick="edit(<?php echo $row['id'] ?>)">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-info" onclick="edit_file(<?php echo $row['id'] ?>)">
                    <i class="fa fa-folder"></i>
                </button>
                <?php
                }
                if($convert->check_roles_user($info[0]['id'], $url[0], 3)){
                ?>
                <button type="button" class="btn btn-danger" onclick="del(<?php echo $row['id'] ?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php
                }
                if($convert->check_roles_user($info[0]['id'], $url[0], 8) && $row['publish'] == 0){
                ?>
                <button type="button" class="btn btn-warning" onclick="duyet(<?php echo $row['id'] ?>)"
                data-toggle="tooltip" data-container="body" data-placement="bottom" title="Duyệt hiển thị">
                    <i class="fa fa-check"></i>
                </button>
                <?php
                }
                ?>
            </td>
            <td class="hide" id="examid_<?php echo $row['id'] ?>"><?php echo $row['exam_id'] ?></td>
            <td class="hide" id="file_<?php echo $row['id'] ?>"><?php echo $row['file'] ?></td>
            <td class="hide" id="ise_<?php echo $row['id'] ?>"><?php echo $row['is_e'] ?></td>
            <td class="hide" id="detai_<?php echo $row['id'] ?>"><?php echo $row['de_tai'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="text-center" style="width: 10px">#</th>
            <th class="text-center" style="width: 100px">Hình ảnh</th>
            <th class="text-center" style="width:250px">Nhóm dữ liệu</th>
            <th class="text-center">Lĩnh vực</th>
            <th class="text-center">Đề tài</th>
            <th class="text-center">Cập nhật<br/>lần cuối</th>
            <th class="text-center">Tác giả</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center" style="width: 150px">Thao tác</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks($jsonObj['total'], $perpage, $pagination['number'], 'view_page_elearning', 1);
?>
<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}
?>
