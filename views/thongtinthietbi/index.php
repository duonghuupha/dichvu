<?php $convert = new Convert(); $info = $_SESSION['data'] ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/thongtin.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thông tin thiết bị
            <small class="pull-right">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" onclick="add_thongtin()">
                        <i class="fa fa-plus"></i>
                        Thêm mới
                    </button>
                    <button type="button" class="btn btn-success" onclick="import_xls()">
                        <i class="fa fa-file-excel-o"></i>
                        Nhập từ file Excel
                    </button>
                </div>
                <?php
                }
                ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Tìm kiếm">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="thongtinthietbi">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="thongtintb" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin thiết bị</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="fm" enctype="multipart/form-data">
                    <input id="id" name="id" value="0" type="hidden"/>
                    <input id="imageold" name="imageold" type="hidden"/>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã thiết bị</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Mã thiết bị" required=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thiết bị</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Tên thiết bị" required=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select class="form-control" data-placeholder="Lựa chọn danh mục"
                                style="width: 100%;" id="danhmuc_id" required="" name="danhmuc_id">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Năm sử dụng</label>
                                <input type="text" class="form-control" id="nam_su_dung"
                                    placeholder="Năm sử dụng" name="nam_su_dung" required=""
                                    maxlength="4"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nguyên giá</label>
                                <input type="text" class="form-control" id="nguyen_gia"
                                    placeholder="Nguyên giá" name="nguyen_gia" required=""
                                    pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Khấu hao (%)/năm</label>
                                <input type="text" class="form-control" id="khau_hao"
                                    placeholder="Gía trị khấu hao" name="khau_hao" required=""
                                    maxlength="2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Xuất xứ</label>
                                <input type="text" class="form-control" id="xuat_su"
                                    placeholder="Xuất sứ" name="xuat_su" required=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" id="image" name="image" accept="image/*"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea id="mo_ta" name="mo_ta" style="width:100%;
                                height:100px;resize:none;padding:3px;"></textarea>
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
