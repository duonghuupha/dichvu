<?php $convert = new Convert(); $info = $_SESSION['data'] ?>
<link type="text/css" rel="stylesheet" href="<?php echo URL.'/styles/dist/css/calendar.css' ?>"/>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/lichbangtuongtac/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Lịch sử dụng bảng tương tác
            <small class="pull-right hidden-xs">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <button type="button" class="btn btn-success" data-toggle="modal"
                    onclick="add()">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </button>
                <?php
                }
                ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-3">
                <div class="box box-success">
                    <div class="box-body">
                        <label style="width: 100%;">Tháng
                            <select class="form-control" data-placeholder="Tháng"
                            style="width: 100%;" id="thang" name="thang">
                                <?php
                                for($i = 1; $i <= 12; $i++){
                                    $select_thang = ($i == date('m')) ? 'selected=""' : '';
                                ?>
                                <option value="<?php echo $i ?>" <?php echo $select_thang ?>>Tháng <?php echo $i ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </label>
                        <label style="width: 100%;">Năm
                            <select class="form-control" data-placeholder="Năm"
                            style="width: 100%;" id="nam" name="nam">
                                <?php
                                for($z = 2017; $z <= 2025; $z++){
                                ?>
                                <option value="<?php echo $z ?>">Năm <?php echo $z ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </label>
                        <div class="col-md-12" style="margin-top:20px;">
                            <button type="button" class="btn btn-block btn-success" onclick="search()">
                                <i class="fa fa-search"></i>
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-9">
                <div class="box box-success">
                    <div class="box-body no-padding" id="lichbangtuongtac">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="bangtuongtac" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đăng ký bảng tương tác</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm">
                    <input id="id_tuongtac" name="id_tuongtac" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Ngày dạy</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ngay_hoc" placeholder="Ngày đăng ký sử dụng"
                                name="ngay_hoc" required=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Thời gian</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="time_id" name="time_id"
                                required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề bài học</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Nội dung bài học"
                                name="title" required=""/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detail_calendar" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin chi tiết</h4>
            </div>
            <div class="modal-body" id="noi_dung">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="chinhsua">Chỉnh sửa</button>
                <button type="button" class="btn btn-danger" id="xoa">Xóa</button>
            </div>
        </div>
    </div>
</div>
