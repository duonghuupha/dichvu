<?php $sql = new Model(); $info = $_SESSION['data'] ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/nguoidung/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Quản lý người dùng
            <?php
            if($info[0]['truonghoc_id'] == 0 || $info[0]['is_boss'] == 1){
            ?>
            <small class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-success" onclick="add_users()">
                        <i class="fa fa-plus"></i>
                        Thêm mới
                    </button>
                    <button type="button" class="btn btn-primary" onclick="copy_roles()">
                        <i class="fa fa-clone"></i>
                        Copy quyền
                    </button>
                    <button type="button" class="btn btn-info" onclick="export_file()">
                        <i class="fa fa-file-excel-o"></i>
                        Xuất file
                    </button>
                </div>
            </small>
            <?php
            }
            ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding" id="noidung">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="nguoidung" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm mới / Cập nhật thông tin người dùng</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm" enctype="multipart/form-data">
                    <input id="id" name="id" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Lựa chọn trường học</label>
                                    <select class="form-control" data-placeholder="Lựa chọn trường học"
                                    style="width: 100%;" id="truonghoc_id" name="truonghoc_id" required>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Tên hiển thị</label>
                                    <input type="text" class="form-control" id="fullname"
                                        placeholder="Tên hiển thị" name="fullname" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="username"
                                        placeholder="Tên đăng nhập" name="username" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Mật khẩu" name="password" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Xác nhận lại mật khẩu</label>
                                    <input type="password" class="form-control" id="repass"
                                        placeholder="Xác nhận lại mật khẩu" name="repass" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Avatar</label>
                                    <input type="file" name="image_avatar" id="image_avatar" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nhiệm vụ</label>
                                    <input type="text" class="form-control" id="job"
                                        placeholder="Phân công nhiệm vụ" name="job" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Số CMND/CCCD</label>
                                    <input type="text" class="form-control" id="cccd"
                                        placeholder="Số CMND/CCCD sử dụng cho công tác tuyển sinh" name="cccd"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" class="flat-red" name="active" id="active"/>
                                        Cho phép sử dụng
                                    </label>
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
