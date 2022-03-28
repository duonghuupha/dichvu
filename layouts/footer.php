<?php
$info = $_SESSION['data']; $namhoc = $_SESSION['namhoc']; $sql = new Model();
?>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Công ty cổ phần giải pháp công nghệ PT Software - <a href="#">PTSOFT</a> :: </strong> Điện thoại: 0934 447 501.
    </footer>
    <!-- modal waiting-->
    <div class="overlay" id="doi">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>
<!----------------------------------------------------------------------------------------->
<div class="modal fade" id="taikhoan" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật thông tin tài khoản</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_taikhoan" enctype="multipart/form-data">
                    <input id="id_tk" name="id_tk" type="hidden" value="0" />
                    <input id="avatarold" name="avatarold" type="hidden" />
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tên hiển thị</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ten_hien_thi" placeholder="Tên hiển thị"
                                    name="ten_hien_thi" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nhiệm vụ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nhiem_vu" placeholder="Nhiệm vụ"
                                    name="nhiem_vu" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Ảnh đại diện</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="avatar" name="avatar" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Mật khẩu mới</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="mat_khau" name="mat_khau" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Xác nhận mật khẩu</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="re_mat_khau" name="re_mat_khau" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_tk()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="namhocactive" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kích hoạt năm học</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_namhocactive" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Lựa chọn năm học</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="namhocactive_id" name="namhocactive_id" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="save_namhocactive()">Lưu</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URL.'/styles/' ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/moment/moment.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/locale-all.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/toastr/toastr.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>plugins/qrcode/qrcode.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo URL.'/styles/' ?>dist/js/pages/dashboard.js"></script>
<script src="<?php echo URL.'/styles/' ?>dist/js/Chart.js"></script>
</body>

</html>
