<link rel="stylesheet" href="<?php echo URL.'/styles/plugins/mobile' ?>/jquery.mobile-1.3.2.min.css" />
<script src="<?php echo URL.'/styles/plugins/mobile' ?>/jquery.mobile-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/hotro/kydientu.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Xác nhận hoàn thành xử lý yêu cầu
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $_REQUEST['id'] ?>" type="hidden"/>
                        <input id="chuky" name="chuky" type="hidden"/>
                        <div class="box-body" style="text-align:center">
                            <canvas id="canvas">Canvas is not supported</canvas>
                            <div id="page"></div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="fun_submit(<?php echo $_REQUEST['id'] ?>)">
                                <i class="fa fa-save"></i>
                                Cập nhật
                            </button>
                            <button type="button" class="btn btn-info" onclick="init_Sign_Canvas()">
                                <i class="fa fa-pencil"></i>
                                Ký lại
                            </button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/hotro/timeline?id='.$_REQUEST['id'] ?>'">
                                <i class="fa fa-times"></i>
                                Hủy bỏ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>