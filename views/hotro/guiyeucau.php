<script type="text/javascript" src="<?php echo URL.'/public/javascript/hotro/index.js' ?>"></script>
<?php
if($_SESSION['data'][0]['truonghoc_id'] != 0){
?>
<script type="text/javascript">
$(function(){
    $('#truonghoc_id').load(baseUrl + '/other/combo_truonghoc?id=<?php echo $_SESSION['data'][0]['truonghoc_id'] ?>');
    //$('#truonghoc_id').select2("readonly", true);
    $('#truonghoc_id').prop("disabled", true);
});
</script>
<?php
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gửi yêu cầu hỗ trợ dịch vụ
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Các loại yêu cầu</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lựa chọn dịch vụ</label>
                            <select class="form-control" data-placeholder="Lựa chọn dịch vụ"
                            style="width: 100%;" id="dichvu_id" name="dichvu_id">
                                <option value="0">Lựa chọn dịch vụ</option>
                                <?php
                                foreach($this->dichvu as $row_dv){
                                    echo '<option value="'.$row_dv['id'].'">'.$row_dv['title'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lựa chọn kiểu dịch vụ</label>
                            <select class="form-control" data-placeholder="Lựa chọn Kiểu dịch vụ"
                            style="width: 100%;" id="kieudichvu_id" name="kieudichvu_id">
                                <option value="0">Lựa chọn kiểu dịch vụ</option>
                                <?php
                                foreach($this->kieudichvu as $row_kdv){
                                    echo '<option value="'.$row_kdv['kieudichvu_id'].'">'.$row_kdv['title'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" onclick="load_danhmuc()">
                                <i class="fa fa-refresh"></i>
                                Load danh mục
                            </button>
                        </div>
                        <hr/>
                        <div id="danhmuc" style="height:300px;overflow:auto"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Nội dung yêu cầu</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form role="form" id="fm" enctype="multipart/form-data">
                                <input id="danhmuc_id" name="danhmuc_id" type="hidden"/>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lựa chọn trường học</label>
                                            <select class="form-control" id="truonghoc_id" name="truonghoc_id"
                                                placeholder="Lựa chọn trường học" onchange="set_data_phongban()" required></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lựa chọn phòng ban</label>
                                            <select class="form-control" id="phongban_id" name="phongban_id"
                                                placeholder="Lựa chọn thiết bị" onchange="set_data_combo()" required></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lựa chọn thiết bị</label>
                                            <select class="form-control" id="thietbi_id" name="thietbi_id"
                                                placeholder="Lựa chọn thiết bị" required></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số điện thoại liên hệ</label>
                                        <input type="text" class="form-control" id="sodienthoai" name="sodienthoai"
                                            placeholder="Nhập số điện thoại" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung yêu cầu</label>
                                        <textarea class="textarea" placeholder="Nhập nội dung" name="noidung" id="noidung1"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Tệp đính kèm</label>
                                        <input type="file" id="image" name="image" accept="image/*" onchange=""/>
                                        <p class="help-block">
                                            Hỗ trợ tối đa 4MB với các định dạng: .jpg, .gif, .jpeg, .png
                                        </p>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary" onclick="save()">Gửi yêu cầu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>