<?php
$item = $this->jsonObj; $quanhe = $this->quanhe;
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/hocsinh/formedit.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cập nhật thông tin học sinh
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $item[0]['id'] ?>" type="hidden"/>
                        <input id="data_quanhe" name="data_quanhe" value="0" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã học sinh</label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="Mã học sinh" name="code" required
                                        value="<?php echo $item[0]['code'] ?>" readonly=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và tên</label>
                                    <input type="text" class="form-control" id="fullname"
                                        placeholder="Họ và tên học sinh" name="fullname" required
                                        value="<?php echo $item[0]['fullname'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="text" class="form-control" id="ngay_sinh"
                                        placeholder="dd-mm-yyyy" name="ngay_sinh" required
                                        value="<?php echo date("d-m-Y", strtotime($item[0]['ngay_sinh'])) ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <select class="form-control" data-placeholder="Lựa chọn giới tính" 
                                    id="gioi_tinh" name="gioi_tinh">
                                        <option value="1" <?php echo ($item[0]['gioi_tinh'] == 1) ? 'selected=""' : '' ?>>Nam</option>
                                        <option value="2" <?php echo ($item[0]['gioi_tinh'] == 2) ? 'selected=""' : '' ?>>Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="dia_chi"
                                        placeholder="Địa chỉ" name="dia_chi" required
                                        value="<?php echo $item[0]['dia_chi'] ?>"/>
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
                                                <?php
                                                foreach($quanhe as $row){
                                                ?>
                                                <tr id="<?php echo $row['id'] ?>">
                                                    <td>
                                                        <input class="form-control" type="text" name="ho_va_ten" id="fullname_<?php echo $row['id'] ?>" 
                                                        size="10" value="<?php echo $row['fullname'] ?>"/>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="quan_he" id="quan_he_<?php echo $row['id'] ?>">
                                                            <option value="1" <?php echo ($row['loai_quan_he'] == 1) ? 'selected=""' : '' ?>>Bố</option>
                                                            <option value="2" <?php echo ($row['loai_quan_he'] == 2) ? 'selected=""' : '' ?>>Mẹ</option>
                                                            <option value="3" <?php echo ($row['loai_quan_he'] == 3) ? 'selected=""' : '' ?>>Anh/Chị</option>
                                                            <option value="4" <?php echo ($row['loai_quan_he'] == 4) ? 'selected=""' : '' ?>>Ông/Bà</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="dien_thoai" id="dien_thoai_<?php echo $row['id'] ?>" 
                                                        size="10" value="<?php echo $row['dien_thoai'] ?>"/>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="nam_sinh" id="nam_sinh_<?php echo $row['id'] ?>" 
                                                        size="5" value="<?php echo $row['nam_sinh'] ?>"/>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="nghe_nghiep" id="nghe_nghiep_<?php echo $row['id'] ?>" 
                                                        size="10" value="<?php echo $row['nghe_nghiep'] ?>"/>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="del_quanhe(<?php echo $row['id'] ?>)" style="color:red;font-size:17px;">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
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