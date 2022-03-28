<?php
$convert = new Convert(); $info = $_SESSION['data'];
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/erp/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            ERP - Lịch công tác
            <small>
                Hỗ trợ người dùng tạo lịch làm việc nhanh chóng
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?php
                            if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                            ?>
                            <button type="button" class="btn btn-success" onclick="add()">
                                <i class="fa fa-plus"></i>
                                Thêm mới
                            </button>
                            <?php
                            }
                            if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 5)){
                            ?>
                            <button type="button" class="btn btn-primary" onclick="lich_cong_tac()">
                                <i class="fa fa-calendar"></i>
                                Lịch công tác
                            </button>
                            <?php
                            }
                            ?>
                        </h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Tìm kiếm" id="table_search" onkeyup="search()"/>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="lichcongtac">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_erp" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin công việc</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_erp" enctype="multipart/form-data">
                    <input id="id_task" name="id_task" type="hidden"/>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nhóm công việc</label>
                                    <select class="form-control" data-placeholder="Lựa chọn nhóm công việc"
                                    id="group_id" name="group_id" style="width: 100%;" required="">
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Mức độ ưu tiên</label>
                                    <select class="form-control" data-placeholder="Lựa chọn"
                                    id="uu_tien" name="uu_tien" style="width: 100%;">
                                        <option value="1">Bình thường</option>
                                        <option value="2">Cao</option>
                                        <option value="3">Khẩn cấp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Bắt đầu</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="date_start" name="date_start" required=""
                                            value="<?php echo date("d-m-Y") ?>"/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="time_start" name="time_start" required=""
                                            style="width:100%"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Kết thúc</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="date_end" name="date_end" required=""
                                            value="<?php echo date("d-m-Y") ?>"/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="time_end" name="time_end" required=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Người xử lý chính</label>
                                    <select class="form-control" data-placeholder="Lựa chọn"
                                    id="user_id_task" name="user_id_task" style="width: 100%;" required="">
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Người tham gia</label>
                                    <select class="form-control" data-placeholder="Lựa chọn" multiple=""
                                    id="user_id_follow" name="user_id_follow[]" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Nội dung công việc</label>
                                    <textarea class="form-control" rows="3" placeholder="Nội dung công việc"
                                    id="content" name="content" style="resize:none" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group" id="dinhkem">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Tài liệu đính kèm</label>
                                    <input id="file" name="file[]" type="file" class="form-control" multiple=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_lich" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lựa chọn hiển thi lịch công tác</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_erp" enctype="multipart/form-data">
                    <input id="id_task" name="id_task" type="hidden"/>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Lựa chọn môt hoặc nhiều người muốn hiển thị</label>
                                    <select class="form-control" data-placeholder="Lựa chọn" multiple=""
                                    id="user_id_d" name="user_id_d[]" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Lựa chọn tuần</label>
                                    <select class="form-control" data-placeholder="Lựa chọn"
                                    id="tuan" name="tuan" style="width: 100%;">
                                        <?php
                                        $year = date("Y");
                                        $lastw = gmdate("W", strtotime("31 December $year"));
                                        for($i = 1; $i <= $lastw; $i++){
                                            $select = ($i == date("W")) ? 'selected=""' : '';
                                        ?>
                                        <option value="<?php echo $i ?>" <?php echo $select ?>><?php echo $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="view_lich()">Hiển thị</button>
            </div>
        </div>
    </div>
</div>
