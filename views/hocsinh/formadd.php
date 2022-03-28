<script type="text/javascript" src="<?php echo URL.'/public/javascript/hocsinh/formadd.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thêm mới thông tin học sinh
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="0" type="hidden"/>
                        <input id="data_quanhe" name="data_quanhe" value="0" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã học sinh</label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="Mã học sinh" name="code" required
                                        value="<?php echo 'HS-'.rand(11111111, 99999999) ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và tên</label>
                                    <input type="text" class="form-control" id="fullname"
                                        placeholder="Họ và tên học sinh" name="fullname" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="text" class="form-control" id="ngay_sinh"
                                        placeholder="dd-mm-yyyy" name="ngay_sinh" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <select class="form-control" data-placeholder="Lựa chọn giới tính" 
                                    id="gioi_tinh" name="gioi_tinh" required="">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lớp học</label>
                                    <select class="form-control" data-placeholder="Lựa chọn lớp học" 
                                    id="lop_hoc" name="lop_hoc">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="dia_chi"
                                        placeholder="Địa chỉ" name="dia_chi" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            Quan hệ với học sinh
                                        </h3>
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-block btn-info" onclick="add_quanhe()">
                                                <i class="fa fa-plus"></i>
                                                Thêm dòng
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive no-paddings">
                                        <table id="list_quanhe" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Họ và tên</th>
                                                    <th>Quan hệ</th>
                                                    <th>Điện thoại</th>
                                                    <th>Năm sinh</th>
                                                    <th>Nghề nghiệp</th>
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
                            <button type="button" class="btn btn-primary" onclick="save_thongtin()">Cập nhật</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/hocsinh' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>