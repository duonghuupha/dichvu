<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/luanchuyen.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Luân chuyển thiết bị
            <small>Thiết bị có thể luân chuyển giữa các phòng ban hoặc lưu kho</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form role="form" id="fm">
                <input id="id" name="id" type="hidden" value="0"/>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Chuyển từ</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lựa chọn nơi đi</label>
                                <select class="form-control" id="phongban_id" name="phongban_id"
                                    placeholder="Lựa chọn phòng ban" onchange="set_data_combo()" required></select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Lựa chọn thiết bị</label>
                                <select class="form-control" id="thietbi_id" name="thietbi_id"
                                    placeholder="Lựa chọn thiết bị" required></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Chuyển đến</h3>
                        </div>
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lựa chọn nơi đến</label>
                                    <select class="form-control" id="noiden_id" name="noiden_id"
                                        placeholder="Lựa chọn phòng ban" required></select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-footer" style="text-align:center">
                        <button type="button" class="btn btn-primary" onclick="save()">
                            <i class="fa fa-save"></i>
                            Cập nhật
                        </button>
                        <button type="button" class="btn btn-danger"onclick="javascript:location.reload(true)">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách thiết bị đã luân chuyển
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_luanchuyen">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>