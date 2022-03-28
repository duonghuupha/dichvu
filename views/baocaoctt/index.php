<script type="text/javascript" src="<?php echo URL.'/public/javascript/baocaoctt/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thống kê bài viết/văn bản cổng thông tin điện tử
            <small class="pull-right">
                <button type="button" class="btn btn-danger" id="btn_quaylai" onclick="quay_lai()">
                    <i class="fa fa-refresh"></i> Quay lại
                </button>
                <button type="button" class="btn btn-success" id="xuatfile">
                    <i class="fa fa-file-excel-o"></i> Xuất Excel
                </button>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4" id="cot-trai">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kiểu dữ liệu</label>
                                    <select class="form-control" id="kieudulieu" placeholder="Lựa chọn lớp học"
                                    name="kieudulieu" onchange="set_kieu()">
                                        <option value="1">Bài viết</option>
                                        <option value="2">Văn bản</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="baiviet">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control" id="trangthai_baiviet" placeholder="Lựa chọn lớp học"
                                    name="trangthai_baiviet">
                                        <option value="0">Tất cả</option>
                                        <option value="1">Chưa duyệt</option>
                                        <option value="2">Đã duyệt</option>
                                        <option value="3">Đã đăng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="vanban">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control" id="trangthai_vanban" placeholder="Lựa chọn lớp học"
                                    name="trangthai_vanban">
                                        <option value="0">Tất cả</option>
                                        <option value="1">Chưa đăng</option>
                                        <option value="2">Đã đăng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ ngày</label>
                                    <input class="form-control" id="tungay" name="tungay" value="<?php echo date("01-m-Y"); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đến ngày</label>
                                    <input class="form-control" id="denngay" name="denngay" value="<?php echo date("d-m-Y") ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="search()">
                                <i class="fa fa-search"></i> Hiển thị
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8" id="cot-phai">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title" id="tieude">
                            Thống kê bài viết
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="baocaoctt">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
