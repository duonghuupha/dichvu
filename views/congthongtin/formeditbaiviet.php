<?php
$jsonObj = $this->jsonObj;
?>
<script src="<?php echo URL ?>/styles/ckeditor/ckeditor.js"></script>
<script src="<?php echo URL ?>/styles/ckfinder/ckfinder.js"></script>
<script>
var str_url = '<?php echo $_SESSION['url'] ?>';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/baiviet.js' ?>"></script>
<script>
    $(function(){
        $('#danhmuc_id').load(baseUrl + '/other/combo_content_dm?truonghocid='+truonghocid+'&id=<?php echo $jsonObj[0]['cate_id'] ?>');
        <?php
        if($jsonObj[0]['image'] != ''){
        ?>
        $('#btn-xoaanh').show();
        <?php
        }
        ?>
    })
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cập nhật bài viết
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form id="fm" method="post" enctype="multipart/form-data">
                <input id="id" name="id" type="hidden" value="<?php echo $jsonObj[0]['id'] ?>"/>
                <input id="image_old" name="image_old" type="hidden" value="<?php echo $jsonObj[0]['image'] ?>"/>
                <input id="file_old" name="file_old" type="hidden" value="<?php echo $jsonObj[0]['file'] ?>"/>
                <input id="content" name="content" type="hidden"/>
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cấu hình bài viết</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục (*)</label>
                                <select class="form-control" data-placeholder="Lựa chọn danh mục"
                                style="width: 100%;" id="danhmuc_id" required name="danhmuc_id">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh đại diện</label>
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-image"></i> Lựa chọn ảnh
                                    <input type="file" name="image" id="image" accept="image/*" onchange="preview_img(this)"/>
                                </div>
                            </div>
                            <hr/>
                            <?php
                            if($jsonObj[0]['image'] == ''){
                            ?>
                            <div class="form-group">
                                <img src="" height="200" alt="Image preview..." id="image_src"
                                style="border:1px solid #ccc; padding:2px; width:100%;"/>
                                <button type="button" class="btn btn-danger" id="btn-xoaanh" onclick="xoa_anh()">
                                    <i class="fa fa-trash"></i> Xóa ảnh
                                </button>
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="form-group">
                                <img src="<?php echo URL.'/public/news/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['image'] ?>" height="200" alt="Image preview..." id="image_src"
                                style="border:1px solid #ccc; padding:2px; width:100%;"/>
                                <button type="button" class="btn btn-danger" id="btn-xoaanh" onclick="xoa_anh()">
                                    <i class="fa fa-trash"></i> Xóa ảnh
                                </button>
                            </div>
                            <?php
                            }
                            ?>
                            <hr/>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="tieu_diem" id="tieu_diem"
                                    <?php echo ($jsonObj[0]['tieu_diem'] == 1) ? 'checked' : '' ?>/>
                                    Tin tiêu điểm
                                </label>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="hien_thi_trang_chu" id="hien_thi_trang_chu"
                                    <?php echo ($jsonObj[0]['hien_thi_trang_chu'] == 1) ? 'checked' : '' ?>/>
                                    Hiển thị trang chủ
                                </label>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="flat-red" name="hien_thi_detail" id="hien_thi_detail"
                                    <?php echo ($jsonObj[0]['hien_thi_detail'] == 1) ? 'checked' : '' ?>/>
                                    Cho phép hiển thị ảnh đại diện tin tức trong chi tiết tin bài
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nội dung bài viết</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input class="form-control" placeholder="Tiêu đề bài viết (*)" name="title" id="title" required
                                value="<?php echo $jsonObj[0]['title'] ?>"/>
                            </div>
                            <div class="form-group">
                                <textarea id="décription" class="form-control" style="height: 100px" placeholder="Mô tả bài viết"
                                id="intro" name="intro"><?php echo $jsonObj[0]['intro'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" class="form-control" style="height: 300px"
                                placeholder="Tiêu đề bài viết"><?php echo $jsonObj[0]['content'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Đính kèm
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
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/congthongtin/baiviet' ?>'">
                                <i class="fa fa-times"></i> Hủy bỏ
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
