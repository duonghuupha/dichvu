<?php
$jsonObj = $this->jsonObj;
?>
<script>
var str_url = '<?php echo $_SESSION['url'] ?>';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/vanban.js' ?>"></script>
<script>
    $(function(){
        $('#danhmuc_id').load(baseUrl + '/other/combo_content_dm?truonghocid='+truonghocid+'&id=<?php echo $jsonObj[0]['cate_id'] ?>');
    })
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cập nhật văn bản
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form id="fm" method="post" enctype="multipart/form-data">
                <input id="id" name="id" type="hidden" value="<?php echo $jsonObj[0]['id'] ?>"/>
                <input id="file_old" name="file_old" type="hidden" value="<?php echo $jsonObj[0]['file'] ?>"/>
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cấu hình văn bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục (*)</label>
                                <select class="form-control" data-placeholder="Lựa chọn danh mục" style="width: 100%;" id="danhmuc_id"
                                name="danhmuc_id" required="">
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
                                <label for="exampleInputEmail1">Số văn bản (*)</label>
                                <input class="form-control" placeholder="Số văn bản" id="so_vanban" name="so_vanban" required=""
                                value="<?php echo $jsonObj[0]['so_vanban'] ?>"/>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Ngày nhận văn bản (*)
                                    <button type="button" class="btn btn-box-tool" id="qa"
                                    title="Là ngày nhận văn bản từ cấp trên gửi qua mail. Nếu là văn bản của nhà trường thì điền ngày văn bản">
                                        <i class="fa fa-question-circle"></i>
                                    </button>
                                </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="ngay_vanban" required=""
                                    value="<?php echo date("d-m-Y", strtotime($jsonObj[0]['ngay_vanban'])) ?>"/>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="hien_thi_phong"
                                    <?php echo ($jsonObj[0]['hien_thi_phong'] == 1) ? 'checked' : '' ?>/>
                                    Hiển thị trên trang phòng
                                </label>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="hien_thi_home"
                                    <?php echo ($jsonObj[0]['hien_thi_home'] == 1) ? 'checked' : '' ?>/>
                                    Hiển thị trang chủ
                                </label>
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
                                <input class="form-control" placeholder="Tiêu đề văn bản (*)" id="title" name="title" required=""
                                value="<?php echo $jsonObj[0]['tieu_de'] ?>"/>
                            </div>
                            <div class="form-group">
                                <textarea id="trich_yeu" class="form-control" style="height: 200px;resize:none"
                                    placeholder="Trích yêu" name="trich_yeu"><?php echo $jsonObj[0]['trich_yeu'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Đính kèm (*)
                                    <input type="file" name="attachment" id="attachment" onchange="ValidateFileSize(this)"/>
                                    <i id="tenfile"></i>
                                </div>
                                <p class="help-block">Tối đa. 32MB</p>
                                <?php if($jsonObj[0]['file'] != ''){ ?>
                                <a href="<?php echo URL.'/public/news/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['file'] ?>" target="_blank"><?php echo $jsonObj[0]['file'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" onclick="save()">
                                    <i class="fa fa-save"></i> Cập nhật
                                </button>
                            </div>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/congthongtin/vanban' ?>'">
                                <i class="fa fa-times"></i> Hủy bỏ
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
