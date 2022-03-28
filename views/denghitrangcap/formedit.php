<?php
$item = $this->detail; $json = $this->json;
?>
<script>
var userapp = <?php echo $item[0]['user_app'] ?>
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/denghitrangcap/formadd.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Chỉnh sửa phiếu đề nghị trang cấp
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $item[0]['id'] ?>" type="hidden"/>
                        <input id="datadc" name="datadc" value="0" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số phiếu</label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="Mã học sinh" name="code" required=""
                                        value="<?php echo $item[0]['code'] ?>" readonly=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày đề nghị</label>
                                    <input type="text" class="form-control" id="ngay_de_nghi"
                                        placeholder="Ngày đề nghị" name="ngay_de_nghi" required=""
                                        value="<?php echo date("d-m-Y", strtotime($item[0]['ngay_de_nghi'])) ?>"/>
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
                                        placeholder="Nội dung" name="content" required=""
                                        value="<?php echo $item[0]['content'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú</label>
                                    <input type="text" class="form-control" id="ghi_chu"
                                        placeholder="Ghi chú" name="ghi_chu"
                                        value="<?php echo $item[0]['ghi_chu'] ?>"/>
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
                                                    <th class="text-center">Đơn vị tính</th>
                                                    <th class="text-center">Số lượng</th>
                                                    <th class="text-right">Đơn giá</th>
                                                    <th>Ghi chú</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach($this->json as $row){
                                                ?>
                                                <tr id="<?php echo $row['id'] ?>">
                                                    <td>
                                                        <input class="form-control" type="text" name="title" id="title_<?php echo $row['id'] ?>" size="20"
                                                        value="<?php echo $row['title'] ?>"/>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-control" type="text" name="donvitinh" id="donvitinh_<?php echo $row['id'] ?>" size="5"
                                                        value="<?php echo $row['donvitinh'] ?>"/>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-control" type="text" name="soluong" id="soluong_<?php echo $row['id'] ?>" size="5" 
                                                        onkeypress="return onlyNumberKey(event)" value="<?php echo $row['so_luong'] ?>"/>
                                                    </td>
                                                    <td class="text-right">
                                                        <input class="form-control" type="text" name="dongia" id="dongia_<?php echo $row['id'] ?>" size="10" 
                                                        onkeypress="return onlyNumberKey(event)" value="<?php echo $row['don_gia'] ?>"/>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="ghichu" id="ghichu_<?php echo $row['id'] ?>" size="10"
                                                        value="<?php echo $row['ghi_chu'] ?>"/>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="del_trangcap(<?php echo $row['id'] ?>)" style="color:red;font-size:17px;">
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
                            <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/denghitrangcap' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>