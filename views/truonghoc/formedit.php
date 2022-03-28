<?php $jsonObj = $this->jsonObj ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/danhmuc/truonghoc.js' ?>"></script>
<script>
$(function(){
    $('#dichvu_id').load(baseUrl + '/other/combo_dichvu?id=<?php echo $jsonObj[0]['dichvu_id'] ?>');
});
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cập nhật thông tin trường học
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $jsonObj[0]['id'] ?>" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã trường</label>
                                    <input type="text" class="form-control" id="code"
                                        placeholder="Mã trường học" name="code" required
                                        value="<?php echo $jsonObj[0]['code'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên trường</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Tên trường học" name="title" required
                                        value="<?php echo $jsonObj[0]['title'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Địa chỉ trường học" name="address" required
                                        value="<?php echo $jsonObj[0]['address'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại</label>
                                    <input type="text" class="form-control" id="phone"
                                        placeholder="Điện thoại trường học" name="phone" required
                                        value="<?php echo $jsonObj[0]['phone'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" id="email"
                                        placeholder="Email trường học" name="email" required
                                        value="<?php echo $jsonObj[0]['email'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã số thuế</label>
                                    <input type="text" class="form-control" id="masothue"
                                        placeholder="Mã số thuế trường học" name="masothue" required
                                        value="<?php echo $jsonObj[0]['masothue'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài khoản</label>
                                    <input type="text" class="form-control" id="taikhoan"
                                        placeholder="Tài khoản kho bạc / ngân hàng" name="taikhoan"
                                        value="<?php echo $jsonObj[0]['taikhoan'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mở tại</label>
                                    <input type="text" class="form-control" id="motai"
                                        placeholder="Mở tại kho bạc / ngân hàng" name="motai"
                                        value="<?php echo $jsonObj[0]['motai'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sử dụng dịch vụ</label>
                                    <select class="form-control" multiple="multiple" data-placeholder="Lựa chọn dịch vụ"
                                    style="width: 100%;" id="dichvu_id" name="dichvu_id[]">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    if($jsonObj[0]['logo'] != ''){
                                    ?>
                                    <img src="<?php echo URL.'/public/truonghoc/logo/'.$jsonObj[0]['logo'] ?>" width="50"/>
                                    <?php
                                    }
                                    ?>
                                    <label>Logo nhà trường</label>
                                    <input type="file" name="image_logo" id="image_logo"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="flat-red" name="status" id="status"
                                        <?php echo ($jsonObj[0]['active'] == 1) ? "checked" : '' ?>/>
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