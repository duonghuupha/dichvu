<?php
$jsonObj = $this->jsonObj; $info = $_SESSION['data']; $sql = new Model();
?>
<script>
var str_url = '';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/vanban.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Chi tiết văn bản
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form id="fm" method="post" enctype="multipart/form-data">
                <input id="content" name="content" type="hidden"/>
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cấu hình văn bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <p><?php echo $jsonObj[0]['danhmuc'] ?></p>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số văn bản</label>
                                <p><?php echo $jsonObj[0]['so_vanban'] ?></p>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Ngày nhận văn bản
                                    <button type="button" class="btn btn-box-tool" id="qa"
                                    title="Là ngày nhận văn bản từ cấp trên gửi qua mail. Nếu là văn bản của nhà trường thì điền ngày văn bản">
                                        <i class="fa fa-question-circle"></i>
                                    </button>
                                </label>
                                <p><?php echo date("d-m-Y", strtotime($jsonObj[0]['ngay_vanban'])) ?></p>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="hien_thi_phong" id="hien_thi_phong"
                                    <?php echo ($jsonObj[0]['hien_thi_phong'] == 1) ? 'checked' : '' ?>/>
                                    Hiển thị trên trang phòng
                                </label>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="hien_thi_home" id="hien_thi_home"
                                    <?php echo ($jsonObj[0]['hien_thi_home'] == 1) ? 'checked' : '' ?>/>
                                    Hiển thị trang chủ
                                </label>
                            </div>
                            <?php
                            if($jsonObj[0]['create_dang'] == ''){
                            ?>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link bài đã đăng (*)</label>
                                <input class="form-control" placeholder="Link bài viết đã đăng (*)" name="link_dang" id="link_dang" required/>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-success" onclick="dang_van_ban(<?php echo $jsonObj[0]['id'] ?>)">
                                    <i class="fa fa-save"></i> Cập nhật
                                </button>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Nội dung văn bản
                                <small>Cập nhật lần cuối: <?php echo date("H:i:s d-m-Y", strtotime($jsonObj[0]['create_at'])) ?></small>
                            </h3>
                        </div>
                        <div class="box-body detailbv">
                            <h3 style="font-size:18px;"><?php echo $jsonObj[0]['tieu_de'] ?></h3>
                            <p><?php echo $jsonObj[0]['trich_yeu'] ?></p>
                            <div class="noidungbaiviet">
                                <iframe src="<?php echo URL.'/public/vanban/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['file'] ?>#toolbar=0"
                                style="width:100%; height:500px;" frameborder="1"></iframe>
                            </div>
                            <hr/>
                            <div class="dinhkem">
                                <b>Tệp đính kèm</b>
                                <a href="<?php echo URL.'/public/vanban/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['file'] ?>" target="_blank">
                                    <?php echo $jsonObj[0]['file'] ?>
                                </a>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/congthongtin/vanban' ?>'">
                                <i class="fa fa-arrow-circle-left"></i> Quay lại
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
