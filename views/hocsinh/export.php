<script type="text/javascript" src="<?php echo URL.'/public/javascript/hocsinh/baocao.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Quản lý học sinh
            <small>
                Xuát dữ liệu học sinh
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="0" type="hidden" />
                        <input id="code" name="code" value="0" type="hidden" />
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Năm học</label>
                                    <select class="form-control" id="namhoc" placeholder="Lựa chọn lớp học"
                                    name="namhoc" onchange="set_lophoc()"></select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lớp học <small>(Lựa chọn năm học để hiển thị)</small></label>
                                    <select class="form-control" id="phongban" placeholder="Lựa chọn lớp học"
                                    name="phongban"></select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <select class="form-control" id="gioi_tinh" placeholder="Lựa chọn lớp học"
                                    name="gioi_tinh">
                                        <option value="0">Tất cả </option>
                                        <option value="1">Nam </option>
                                        <option value="2">Nữ </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh (tháng/năm)</label>
                                    <input type="text" class="form-control" id="thoi_gian" placeholder="Thời gian"
                                        name="thoi_gian" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control" id="trangthai" placeholder="Lựa chọn lớp học"
                                    name="trangthai">
                                        <option value="0">Tất cả </option>
                                        <option value="1">Đang đi học </option>
                                        <option value="2">Nghỉ học </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="search()">
                                <i class="fa fa-search"></i> Tìm kiếm
                            </button>
                            <button type="button" class="btn btn-success" onclick="export_xls()">
                                <i class="fa fa-file-excel-o"></i> Xuất Excel
                            </button>
                            <div class="row" style="margin-top:5px;">
                                <button type="button" class="btn btn-success" onclick="export_full()"
                                data-toggle="tooltip" data-container="body" data-placement="bottom" title="Bao gồm cả thông tin bố mẹ">
                                    <i class="fa fa-file-excel-o"></i> Xuất Excel đầy đủ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách học sinh
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="danhsachhocsinh">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
