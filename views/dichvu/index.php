<script type="text/javascript" src="<?php echo URL.'/public/javascript/danhmuc/dichvu.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách dịch vụ hỗ trợ
            <small>
                Là cá dịch vụ mà hệ thống hỗ trợ quản lý
                <button type="button" class="btn btn-success" data-toggle="modal"
                    onclick="add()">
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
                    <div class="box-body table-responsive no-padding" id="list_dichvu">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="dichvu" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Danh mục dịch vụ hỗ trợ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_dichvu" enctype="multipart/form-data">
                    <input id="id_dichvu" name="id_dichvu" type="hidden" value="0"/>
                    <input id="file_old" name="file_old" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title_dichvu" placeholder="Tiêu đề dịch vụ"
                                name="title_dichvu"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Hướng dẫn sử dụng</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="file" name="file"/>
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