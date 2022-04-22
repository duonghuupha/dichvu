<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/duyetbaiviet.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách bài viết cần duyệt
            <small class="pull-right">
                <button type="button" class="btn btn-primary" onclick="save_duyetbai()">
                    <i class="fa fa-check"></i>
                    Duyệt hàng loạt
                </button>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form id="fm" method="post">
                <input id="data_baiviet" name="data_baiviet" type="hidden"/>
            </form>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding" id="baivietduyet">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

