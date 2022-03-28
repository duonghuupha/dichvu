<?php $jsonObj = $this->jsonObj; $info = $_SESSION['data']; ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/nguoidung/index.js' ?>"></script>
<script>
$(function(){
    $('#truonghoc_id').load(baseUrl + '/other/combo_truonghoc?id=<?php echo $jsonObj[0]['truonghoc_id'] ?>');
});
</script>
<?php
if($info[0]['truonghoc_id'] != 0){
?>
<script type="text/javascript">
$(function(){
    $('#truonghoc_id').attr('disabled', 'disabled');
});
</script>
<?php
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cập nhật thông tin tài khoản
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
                                    <label for="exampleInputEmail1">Lựa chọn trường học</label>
                                    <select class="form-control" data-placeholder="Lựa chọn trường học"
                                    style="width: 100%;" id="truonghoc_id" name="truonghoc_id" disabled="disabled">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hiển thị</label>
                                    <input type="text" class="form-control" id="fullname"
                                        placeholder="Tên hiển thị" name="fullname" required
                                        value="<?php echo $jsonObj[0]['fullname'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhiệm vụ</label>
                                    <input type="text" class="form-control" id="job"
                                        placeholder="Phân công nhiệm vụ" name="job" required
                                        value="<?php echo $jsonObj[0]['job'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số CMND/CCCD</label>
                                    <input type="text" class="form-control" id="cccd"
                                        placeholder="Số CMND/CCCD sử dụng cho công tác tuyển sinh" name="cccd"
                                        value="<?php echo $jsonObj[0]['cccd'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    if($jsonObj[0]['avatar'] != ''){
                                    ?>
                                    <img src="<?php echo URL.'/public/truonghoc/avatar/'.$jsonObj[0]['avatar'] ?>" width="50"/>
                                    <?php
                                    }
                                    ?>
                                    <label>Avatar</label>
                                    <input type="file" name="image_avatar" id="image_avatar" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">Cập nhật</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/nguoidung' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>