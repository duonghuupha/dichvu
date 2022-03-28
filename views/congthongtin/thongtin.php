<?php $jsonObj = $this->jsonObj; ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/thongtin.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thông tin quản lý cổng thông tin
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" id="fm">
                        <input id="id" name="id" value="<?php echo $jsonObj[0]['id'] ?>" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đường dẫn CTTĐT</label>
                                    <input type="text" class="form-control" id="link_ctt" name="link_ctt"
                                        placeholder="VD: https://mntanmai.longbien.edu.vn" required
                                        value="<?php echo $jsonObj[0]['link_ctt'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đường dẫn trang quản trị</label>
                                    <input type="text" class="form-control" id="link_quan_tri" name="link_quan_tri"
                                        placeholder="VD: http://quantri.longbien.edu.vn" required
                                        value="<?php echo $jsonObj[0]['link_quan_tri'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã trường</label>
                                    <input type="text" class="form-control" id="ma_truong" name="ma_truong"
                                        placeholder="Mã trường sử dụng để đăng nhập quản trị. VD: mntanmai"
                                        required value="<?php echo $jsonObj[0]['ma_truong'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap"
                                        placeholder="Tên đăng nhập quản trị " required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                                        placeholder="Mật khẩu quản trị" required/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">
                                <i class="fa fa-save"></i>
                                Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>