<script type="text/javascript" src="<?php echo URL.'/public/javascript/vanban/vanbanden.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thêm mới văn bản đến
        </h1>
    </section>
    <section class="content">
        <form id="fm" method="post" enctype="multipart/form-data">
            <input id="id" name="id" type="hidden" value="0"/>
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cấu hình văn bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select class="form-control" data-placeholder="Lựa chọn danh mục"
                                    style="width: 100%;" id="danhmuc_id" name="danhmuc_id" required>
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số đến</label>
                                <input class="form-control" placeholder="Số đến" id="so_den" name="so_den" required/>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ngày nhận văn bản</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="ngay_den" required/>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số văn bản</label>
                                <input class="form-control" placeholder="Số văn bản" id="so_vanban" name="so_vanban" required/>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ngày văn bản</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker1" name="ngay_vanban" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nội dung văn bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input class="form-control" placeholder="Tiêu đề văn bản" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <textarea id="trich_yeu" class="form-control textarea" style="height: 200px;resize:none"
                                    placeholder="Trích yêu" name="trich_yeu"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Đính kèm
                                    <input type="file" name="file_at" id="file_at" onchange="ValidateFileSize(this)" required/>
                                    <i id="tenfile"></i>
                                </div>
                                <p class="help-block">Tối đa. 32MB</p>
                            </div>
                            <div class="form-group">
                                <label>
                                    Đăng lên CTTĐT
                                    <input type="checkbox" class="flat-red" name="online" id="online"
                                    onclick="show_option()"/>
                                </label>
                            </div>
                            <div id="hienthi">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lựa chọn danh mục</label>
                                    <select class="form-control" id="cate_id" name="cate_id" required
                                    style="width:100%"></select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Hiển thị trang chủ
                                        <input type="checkbox" class="flat-red" name="hien_thi_home" id="hien_thi_home"/>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Hiển thị trên trang phòng
                                        <input type="checkbox" class="flat-red" name="hien_thi_phong" id="hien_thi_phong"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" onclick="save()">
                                    <i class="fa fa-save"></i> Cập nhật
                                </button>
                            </div>
                            <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='<?php echo URL.'/vanban/vanbanden' ?>'">
                                <i class="fa fa-times"></i> Hủy bỏ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>