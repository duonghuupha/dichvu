<script type="text/javascript" src="<?php echo URL.'/public/javascript/danhmuc/danhmuc.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh mục
            <small>
                Danh mục hỗ trợ kỹ thuật
                <button type="button" class="btn btn-success" data-toggle="modal"
                    onclick="add_danhmuc()">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </button>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding" id="list_danhmuc">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="danhmuc" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Danh mục sửa chữa</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_danhmuc">
                    <input id="id_danhmuc" name="id_danhmuc" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Kiểu dịch vụ</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="kieudichvu_id" name="kieudichvu_id">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Dịch vụ</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="dichvu_id" name="dichvu_id">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title_danhmuc" placeholder="Tiêu đề danh mục"
                                name="title_danhmuc"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_danhmuc()">Lưu</button>
            </div>
        </div>
    </div>
</div>