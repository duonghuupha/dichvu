<script type="text/javascript" src="<?php echo URL.'/public/javascript/denghitrangcap/formadd.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thêm mới phiếu đề nghị trang cấp
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="0" type="hidden"/>
                        <input id="datadc" name="datadc" value="0" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số phiếu</label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="Mã học sinh" name="code" required=""
                                        value="<?php echo 'TC-'.rand(11111111, 99999999) ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày đề nghị</label>
                                    <input type="text" class="form-control" id="ngay_de_nghi"
                                        placeholder="Ngày đề nghị" name="ngay_de_nghi" required=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Người duyệt</label>
                                    <select class="form-control" id="user_app" name="user_app" required="">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <input type="text" class="form-control" id="content"
                                        placeholder="Nội dung" name="content" required=""/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú</label>
                                    <input type="text" class="form-control" id="ghi_chu"
                                        placeholder="Ghi chú" name="ghi_chu"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            Danh sách đồ dùng đề nghị
                                        </h3>
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-block btn-info" onclick="add_trangcap()">
                                                <i class="fa fa-plus"></i>
                                                Thêm dòng
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive no-paddings">
                                        <table id="list_trangcap" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nội dung</th>
                                                    <th>Đơn vị tính</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Ghi chú</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/denghitrangcap' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>