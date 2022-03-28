<?php
$item = $this->jsonObj; $sql = new Model(); $convert = new Convert();
$status = $sql->get_status_task_change($item[0]['id']);
if(count($status) > 0){
    $tt = 3;
}else{
    $tt = $item[0]['status'];
}
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/erp/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            ERP - Lịch công tác
            <small>
                Chi tiết
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="text-primary">
                                    <i class="fa fa-tasks"></i> Công việc
                                </h3>
                                <p class="text-muted">
                                    <?php echo $item[0]['content'] ?>
                                </p>
                                <br>
                                <div class="text-muted">
                                    <p class="text-sm">Nhóm công việc
                                        <b class="d-block"><?php echo $item[0]['nhomcongviec'] ?></b>
                                    </p>
                                </div>
                                <div class="text-muted">
                                    <p class="text-sm">Mức độ ưu tiên
                                        <?php
                                        if($item[0]['uu_tien'] ==  1){
                                            echo '<span class="label label-success">Bình thường</span>';
                                        }elseif($item[0]['uu_tien'] ==  2){
                                            echo '<span class="label label-warning">Cao</span>';
                                        }else{
                                            echo '<span class="label label-danger">Khẩn cấp</span>';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="text-muted">
                                    <p class="text-sm">Thời gian thực thiện</p>
                                    <p class="text-sm">
                                        <b class="d-block"><?php echo 'Từ: '.date("H:i:s d-m-Y", strtotime($item[0]['date_start'])).' Đến '.date("H:i:s d-m-Y", strtotime($item[0]['date_end'])) ?></b>
                                    </p>
                                </div>
                                <?php
                                if($item[0]['date_finish'] != '0000-00-00 00:00:00'){
                                ?>
                                <div class="text-muted">
                                    <p class="text-sm">Thời gian hoàn thành</p>
                                    <p class="text-sm">
                                        <b class="d-block"><?php echo date("H:i:s d-m-Y", strtotime($item[0]['date_finish'])) ?></b>
                                    </p>
                                </div>
                                <?php
                                }
                                ?>
                                <h5 class="mt-5 text-muted">Tệp đính kèm</h5>
                                <ul class="list-unstyled">
                                    <?php
                                    if(count($this->file) > 0){
                                        foreach ($this->file as $key => $value) {
                                    ?>
                                    <li>
                                        <a href="<?php echo URL.'/public/erp/'.$item[0]['truonghoc_id'].'/'.$item[0]['code'].'/'.$value['file'] ?>"
                                        class="btn-link text-secondary" target="_blank">
                                            <i class="fa <?php echo $convert->return_icon_file($value['file']) ?>"></i> <?php echo $value['file'] ?>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                    }else{
                                        echo "<i>Không có tệp đính kèm</i>";
                                    }
                                    ?>
                                </ul>
                                <div class="text-center mt-5 mb-3">
                                    <?php
                                    if($item[0]['tien_do'] != 100){
                                        if($item[0]['user_id_task'] == $_SESSION['data'][0]['id']){
                                    ?>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="ketqua(<?php echo $item[0]['id'] ?>, <?php echo $item[0]['tien_do'] ?>)" title="Cập nhật tiến độ"><i class="fa fa-hourglass-half"></i></a>
                                    <?php
                                        }
                                    ?>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="comment(<?php echo $item[0]['id'] ?>)" title="Ý kiến/Trao đổi"><i class="fa fa-comments"></i></a>
                                    <?php
                                        if(($tt == 0 || $tt == 1) && ($item['0']['user_id'] == $_SESSION['data'][0]['id'] || $item['0']['user_id_task'] == $_SESSION['data'][0]['id'])){
                                    ?>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="chuyencongviec(<?php echo $item[0]['id'] ?>, <?php echo $item[0]['group_id'] ?>, <?php echo $item[0]['user_id_task'] ?>)" title="Chuyển công việc"><i class="fa fa-exchange"></i></a>
                                    <?php
                                        }
                                        if($item[0]['user_id'] == $_SESSION['data'][0]['id'] && $tt == 3){
                                    ?>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info" title="Duyệt công việc" onclick="duyet_cv(<?php echo $item[0]['id'] ?>)"><i class="fa fa-check"></i></a>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <a href="<?php echo URL.'/erp' ?>" class="btn btn-sm btn-danger" title="Quay lại"><i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="timeline">
                                    <?php
                                    foreach ($this->comment as $row) {
                                    ?>
                                    <li class="time-label">
                                        <span class="bg-green">
                                        <?php echo date("d-m-Y", strtotime($row['ngay'])) ?>
                                        </span>
                                    </li>
                                    <?php
                                        $comment = $sql->get_data_comment_task($row['ngay'], $item[0]['id']);
                                        foreach ($comment as $value) {
                                    ?>
                                    <li>
                                        <i class="fa fa-comments bg-yellow"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("H:i:s", strtotime($value['create_at'])) ?></span>
                                            <h3 class="timeline-header">
                                                <a href="javascript:void(0)"><?php echo $value['username'] ?></a> <i style="font-size:12px;">đã nêu ý kiến/trao đổi</i>
                                            </h3>
                                            <div class="timeline-body">
                                                <?php echo $value['content'] ?>
                                            </div>
                                            <?php
                                            if($value['file'] != ''){
                                            ?>
                                            <p>
                                                <a href="<?php echo URL.'/public/erp/'.$value['truonghoc_id'].'/'.$value['code'].'/'.$value['file'] ?>"
                                                class="link-black text-sm" target="_blank">
                                                    <i class="fa fa-link"></i> <?php echo $value['file'] ?>
                                                </a>
                                            </p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <li class="time-label">
                                        <span class="bg-red">
                                        <?php echo date("d-m-Y", strtotime($item[0]['create_at'])) ?>
                                        </span>
                                    </li>
                                    <li>
                                        <i class="fa fa-plus bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("H:i:s", strtotime($item[0]['create_at'])) ?></span>
                                            <h3 class="timeline-header"><a href="#"><?php echo $item[0]['nguoitao'] ?></a> đã tạo một công việc </h3>
                                            <div class="timeline-body">
                                                <?php echo $item[0]['content'] ?> - <b>Giao cho <?php echo $item[0]['fullname'] ?> thực hiện chính</b>
                                                <?php
                                                if($item[0]['user_id_follow'] != ''){
                                                    $userid = explode(",", $item[0]['user_id_follow']);
                                                    foreach ($userid as $items) {
                                                        $array[] = $sql->get_fullname_users($items);
                                                    }
                                                    $thamgia = implode(", ", $array);
                                                    echo "<i>và ".$thamgia." theo dõi / giám sát</i>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="fa fa-clock-o bg-gray"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="comment" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ý kiến / Trao đổi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_comment" enctype="multipart/form-data">
                    <input id="id_task" name="id_task" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content" placeholder="Nội dung ý kiến trao dổi"
                                name="content" style="width:100%;height:100px;resize:none"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Đính kèm</label>
                            <div class="col-sm-10">
                                <input id="file" name="file" type="file"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_comment()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="result" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật tiến  độ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_result" enctype="multipart/form-data">
                    <input id="idtask" name="idtask" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tiến  độ</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="tien_do" placeholder="Tiến độ công việc"
                                name="tien_do"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Đính kèm</label>
                            <div class="col-sm-10">
                                <input id="file_result" name="file_result" type="file"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_tiendo()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chuyencongviec" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chuyển công việc</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_chuyen" enctype="multipart/form-data">
                    <input id="idtaskc" name="idtaskc" type="hidden" value="0"/>
                    <input id="user_idcu" name="user_idcu" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Chuyển cho</label>
                            <div class="col-sm-9">
                                <select class="form-control" data-placeholder="Lựa chọn"
                                id="user_id" name="user_id" style="width: 100%;" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Lý do</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ly_do" placeholder="Lý do chuyển công việc"
                                name="ly_do"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_chuyen()">Lưu</button>
            </div>
        </div>
    </div>
</div>
