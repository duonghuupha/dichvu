<?php
$jsonObj = $this->jsonObj; $info = $_SESSION['data']; $sql = new Model();
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/duyetbaiviet.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Chi tiết bài viết
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form id="fm_dang" method="post" enctype="multipart/form-data">
                <input id="content" name="content" type="hidden"/>
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cấu hình bài viết</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <p><?php echo $jsonObj[0]['danhmuc'] ?></p>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh đại diện</label>
                                <?php
                                if($jsonObj[0]['image'] != ''){
                                ?>
                                <img src="<?php echo URL.'/public/news/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['image'] ?>" height="200" alt="Image preview..." id="image_src"
                                style="border:1px solid #ccc; padding:2px; width:100%;"/>
                                <?php
                                }
                                ?>
                            </div>
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
                            <?php
                            if($sql->check_roles($info[0]['id'], 7) > 0 && $jsonObj[0]['status'] == 0){
                            ?>
                            <hr/>
                            <div class="pull-right">
                                <button type="button" class="btn btn-success" onclick="duyet_bai_viet(<?php echo $jsonObj[0]['id'] ?>)">
                                    <i class="fa fa-check"></i> Duyệt bài viết
                                </button>
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($jsonObj[0]['status'] == 1){
                            ?>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link bài đã đăng (*)</label>
                                <input class="form-control" placeholder="Link bài viết đã đăng (*)" name="link_dang" id="link_dang" required/>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-success" onclick="dang_bai_viet(<?php echo $jsonObj[0]['id'] ?>)">
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
                                Nội dung bài viết
                                <small>Cập nhật lần cuối: <?php echo date("H:i:s d-m-Y", strtotime($jsonObj[0]['create_at'])) ?></small>
                            </h3>
                        </div>
                        <div class="box-body detailbv">
                            <?php
                            if($jsonObj[0]['create_dang'] != ''){
                            ?>
                            <iframe src="<?php echo $jsonObj[0]['link_dang'] ?>" style="width:100%;height:500px;"></iframe>
                            <?php
                            }else{
                            ?>
                            <h3 style="font-size:18px;"><?php echo $jsonObj[0]['title'] ?></h3>
                            <p><?php echo $jsonObj[0]['intro'] ?></p>
                            <?php
                            if($jsonObj[0]['image'] != '' && $jsonObj[0]['hien_thi_detail'] == 1){
                                echo '<img src="'.URL.'/public/news/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['image'].'" alt="" title="" width="100%"/>';
                            }
                            ?>
                            <div class="noidungbaiviet">
                                <?php echo $jsonObj[0]['content'] ?>
                            </div>
                            <hr/>
                            <div class="dinhkem">
                                <b>Tệp đính kèm</b>
                                <a href="<?php echo URL.'/public/news/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['file'] ?>" target="_blank">
                                    <?php echo $jsonObj[0]['file'] ?>
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        if($info[0]['id'] == $jsonObj[0]['user_id'] && $jsonObj[0]['status'] == 0){
                        ?>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo URL.'/congthongtin/formeditbaiviet?id='.$jsonObj[0]['id'] ?>'">
                                    <i class="fa fa-pencil"></i> Chỉnh sửa
                                </button>
                            </div>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/congthongtin/baiviet' ?>'">
                                <i class="fa fa-arrow-circle-left"></i> Quay lại
                            </button>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
