<?php $info = $_SESSION['data']; $convert = new Convert(); ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/nhomcongviec/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Nhóm công việc
            <small class="pull-right">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <button type="button" class="btn btn-success" onclick="add()">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </button>
                <?php
                }
                ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                       placeholder="Tìm kiếm" id="table_search"/>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_nhomcongviec">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="nhomcongviec" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nhóm công việc</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_nhomcongviec">
                    <input id="id_nhomcongviec" name="id_nhomcongviec" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Tên nhóm công việc" name="title"
                                required=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Người tham gia</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="user_id_follow" name="user_id_follow[]"
                                multiple="">
                                </select>
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
