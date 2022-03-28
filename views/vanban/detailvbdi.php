<?php $jsonObj = $this->jsonObj; ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/vanban/vanbanden.js' ?>"></script>
<script>
$(function(){
    $('#danhmuc_id').load('<?php echo URL.'/other/combo_vanban_dm?truonghocid='.$jsonObj[0]['truonghoc_id'].'&id='.$jsonObj[0]['cate_id'] ?>')
})
</script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thông tin chi tiết văn ban đi
        </h1>
    </section>
    <section class="content">
        <form id="fm" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cấu hình văn bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <div><?php echo $jsonObj[0]['danhmuc'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số văn bản: <?php echo $jsonObj[0]['so_vanban'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ngày văn bản</label>
                                <div class="input-group date">
                                <?php echo date("d-m-Y", strtotime($jsonObj[0]['ngay_vanban'])) ?>
                                </div>
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
                                <?php echo $jsonObj[0]['title'] ?>
                            </div>
                            <div class="form-group">
                                <iframe src="<?php echo URL.'/public/vanban/'.$jsonObj[0]['truonghoc_id'].'/'.$jsonObj[0]['file'] ?>#toolbar=0" 
                                style="width:100%; height:500px;" frameborder="1"></iframe>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='<?php echo URL.'/vanban/vanbandi' ?>'">
                                <i class="fa fa-arrow-circle-o-left"></i> Quay lại
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>