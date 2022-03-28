<?php $convert = new Convert(); $info = $_SESSION['data'] ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/hocsinh/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Quản lý học sinh
            <small class="pull-right">
                <div class="btn-group">
                    <?php
                    if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                    ?>
                    <button type="button" class="btn btn-success" onclick="add_hocsinh()">
                        <i class="fa fa-plus"></i>
                        Thêm mới
                    </button>
                    <button type="button" class="btn btn-primary" onclick="import_hocsinh()">
                        <i class="fa fa-download"></i>
                        Nhập file Excel
                    </button>
                    <?php
                    }
                    if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 10)){
                    ?>
                    <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL.'/hocsinh/changeclass' ?>'">
                        <i class="fa fa-random"></i>
                        Chuyển lớp
                    </button>
                    <?php
                    }
                    ?>
                    <button type="button" class="btn btn-default" onclick="window.location.href='<?php echo URL.'/hocsinh/export' ?>'">
                        <i class="fa fa-file-excel-o"></i>
                        Xuất Excel
                    </button>
                </div>
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
                                    placeholder="Tìm kiếm" id="table_search" onkeyup="search()">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_hocsinh">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="chuyenlop" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chuyển / Xếp lớp cho học sinh</h4>
                <small>Nếu học sinh chưa được xếp lớp thì chỉ chọn 'Đến lớp'</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_chuyenlop">
                    <input id="id_hocsinh" name="id_hocsinh" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Từ lớp</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="tu_lop" name="tu_lop">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Đến lớp</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="den_lop" name="den_lop">
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_chuyenlop()">Lưu</button>
            </div>
        </div>
    </div>
</div>
