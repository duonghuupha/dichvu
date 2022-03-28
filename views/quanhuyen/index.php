<script type="text/javascript" src="<?php echo URL.'/public/javascript/danhmuc/quanhuyen.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách các quận / huyện
            <small class="pull-right">
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
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Tìm kiếm" id="table_search" onkeyup="sear()">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="sear()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="noidung">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="quanhuyen" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Quận / Huyện</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm">
                    <input id="id" name="id" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tỉnh / Thành phố</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="thanhpho_id" name="thanhpho_id"
                                required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Mã quận / huyện</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ma_quan_huyen" placeholder="Mã quận / huyện"
                                name="ma_quan_huyen" required=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tên quận / huyện</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Tên quận / huyện"
                                name="title" required=""/>
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