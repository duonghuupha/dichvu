<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/danhmuc.js' ?>"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh mục trang thiết bị
            <small class="pull-right">
                <button type="button" class="btn btn-block btn-success" onclick="add_danhmuc()">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </button>
            </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding" id="danhmucthietbi">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="danhmuctb">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Danh mục thiết bị</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm">
                    <input id="id" name="id" value="0" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" placeholder="Tên danh mục"
                                name="title"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save()">Lưu</button>
            </div>
        </div>
    </div>
</div>