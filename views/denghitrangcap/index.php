<?php $convert = new Convert(); $info = $_SESSION['data'] ?>
<script>
var userid = <?php echo $info[0]['id'] ?>;
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/denghitrangcap/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Đề nghị trang cấp
            <small class="pull-right">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" onclick="add()">
                        <i class="fa fa-plus"></i>
                        Thêm mới
                    </button>
                </div>
                <?php
                }
                ?>
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
                                    placeholder="Tìm kiếm" id="table_search" onkeyup="search()"/>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_trangcap">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="detail_trangcap" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-body" id="noi_dung" style="height:600px;overflow:auto">

            </div>
            <div class="modal-footer" style="border-top: 2px solid #367FA9;">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 7)){
                ?>
                <button type="button" class="btn btn-success" id="duyet">Duyệt</button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-info" id="minhchung">Cập nhật minh chứng</button>
                <button type="button" class="btn btn-primary" id="ingiay">In giấy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="capnhatminhchung" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật minh chứng</h4>
                <small>Tài liệu liên quan đến giấy đề nghị trang cấp</small>
            </div>
            <div class="modal-body">
                <div id="chitiettrangcap" style="height:500px;overflow:auto"></div>
                <form class="form-horizontal" id="fm_minhchung" style="border-top: 2px solid #367FA9;">
                    <input id="id_trangcap" name="id_trangcap" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">File đính kèm</label>
                            <div class="col-sm-9">
                                <input type="file" id="file" name="file" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_minhchung()">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
