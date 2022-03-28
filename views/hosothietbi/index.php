<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/hoso.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Hồ sơ thiết bị
            <small>
                Theo dõi quá trình sử dụng của thiết bị
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lựa chọn phòng ban</label>
                                    <select class="form-control" id="phongban_id"
                                        placeholder="Lựa chọn phòng ban" onchange="set_combo_thietbi()"></select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lựa chọn thiết bị</label>
                                    <select class="form-control" id="thietbi_id"
                                        placeholder="Lựa chọn thiết bị"></select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-primary" onclick="load_data()">
                                    <i class="fa fa-search"></i>
                                    Hiển thị
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-body box-profile" id="global">
                        <i>Chưa có dữ liệu</i>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Thông số kỹ thuật</a></li>
                        <li><a href="#timeline" data-toggle="tab">Quá trình luân chuyển</a></li>
                        <li><a href="#settings" data-toggle="tab">Quá trình bào trì, sửa chữa</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <i>Chưa có dữ liệu</i>
                        </div>
                        <div class="tab-pane" id="timeline">
                            <i>Chưa có dữ liệu</i>
                        </div>
                        <div class="tab-pane" id="settings">
                            <i>Chưa có dữ liệu</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>