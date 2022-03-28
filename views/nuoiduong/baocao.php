<script type="text/javascript" src="<?php echo URL.'/public/javascript/nuoiduong/baocao.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Báo cáo nuôi dưỡng
            <small class="pull-right">
                <button type="button" class="btn btn-danger" id="btn_quaylai" onclick="quay_lai()">
                    <i class="fa fa-refresh"></i> Quay lại
                </button>
                <button type="button" class="btn btn-success" id="xuatfile" onclick="export_xls()">
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
                                    <label for="exampleInputEmail1">Thời gian (tháng/năm)</label>
                                    <input type="text" class="form-control" id="thoi_gian" placeholder="Thời gian"
                                        name="thoi_gian"/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="search()">
                                <i class="fa fa-search"></i> Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8" id="cot-phai">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Dữ liệu báo ăn
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="baocaonuoiduong">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
.table-responsive>.fixed-column {
    position: absolute;
    display: inline-block;
    width: auto;
    border-right: 1px solid #ddd;
}
@media(min-width:768px) {
    .table-responsive>.fixed-column {
        display: none;
    }
}
</style>
