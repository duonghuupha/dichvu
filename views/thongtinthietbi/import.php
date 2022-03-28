<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/thongtin.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Nhập danh sách từ file Excel
            <small>
                Hỗ trợ người dùng nhập danh sách trang thiết bị nhanh chóng
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lựa chọn file Excel</label>
                                    <input type="file" name="file_at" id="file_at" onchange="do_import()"/>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label>
                                    Định dạng file là .xlsx (Excel 2007 trở lên). Tải file mẫu 
                                    <a href="<?php echo URL.'/public/temp/assets.xlsx'; ?>" target="_blank">tại đây</a> để moulde chạy đạt hiệu quả cao
                                </label>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save_import()">
                                <i class="fa fa-save"></i>
                                Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách thiết bị
                            <small>
                                Dòng được in màu đỏ là thiết bị trùng mã 
                            </small>
                        </h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Tìm kiếm" id="table_search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_thietbi">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>