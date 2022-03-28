<script type="text/javascript" src="<?php echo URL.'/public/javascript/danhmuc/truonghoc.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thêm mới thông tin trường học
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="0" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã trường</label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="Mã trường học" name="code" required
                                        value="<?php echo 'TH-'.rand(111111, 999999) ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên trường</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Tên trường học" name="title" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Địa chỉ trường học" name="address" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại</label>
                                    <input type="text" class="form-control" id="phone"
                                        placeholder="Điện thoại trường học" name="phone" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" id="email"
                                        placeholder="Email trường học" name="email" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã số thuế</label>
                                    <input type="text" class="form-control" id="masothue"
                                        placeholder="Mã số thuế trường học" name="masothue" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài khoản</label>
                                    <input type="text" class="form-control" id="taikhoan"
                                        placeholder="Tài khoản kho bạc / ngân hàng" name="taikhoan"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mở tại</label>
                                    <input type="text" class="form-control" id="motai"
                                        placeholder="Mở tại kho bạc / ngân hàng" name="motai"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sử dụng dịch vụ</label>
                                    <select class="form-control" multiple="multiple" data-placeholder="Lựa chọn dịch vụ"
                                    style="width: 100%;" id="dichvu_id" name="dichvu_id[]">
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
                                    <label>Logo nhà trường</label>
                                    <input type="file" name="image_logo" id="image_logo"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="flat-red" name="status" id="status"/>
                                        Đang sử dụng dịch vụ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/truonghoc' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>