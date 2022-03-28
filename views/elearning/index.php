<?php $convert = new Convert(); $info = $_SESSION['data'] ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/elearning/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Tài nguyên
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
                <button type="button" class="btn btn-default" onclick="lua_chon()">
                    <i class="fa fa-file-excel-o"></i>
                    Xuất file
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
                                    placeholder="Tìm kiếm" id="table_search" onkeyup="search()">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_elearning">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="elearning" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin tài nguyên</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_elearning" enctype="multipart/form-data">
                    <input id="id" name="id" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nhóm dữ liệu</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="exam_id" name="exam_id"
                                required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Lĩnh vực</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="linh_vuc" placeholder="Lĩnh vực"
                                name="linh_vuc" required="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Đề tài</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="de_tai" placeholder="Đề tài"
                                name="de_tai" required="" />
                            </div>
                        </div>
                        <div class="form-group" id="ise">
							<label for="inputEmail3" class="col-sm-3 control-label">Bài giảng E</label>
							<div class="col-sm-9">
								<input type="checkbox" class="flat-red" name="is_e" id="is_e" />
							</div>
						</div>
                        <div class="form-group" id="dinhkem">
                            <label for="inputEmail3" class="col-sm-3 control-label">File</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="file" placeholder="File dữ liệu"
                                name="file" required="" />
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

<div class="modal fade" id="File_E" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật file tài nguyên</h4>
                <small>Khi cập nhật file tài nguyên mới, file cũ sẽ được xóa đi và thay thế bằng file mới</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_file" enctype="multipart/form-data">
                    <input id="id_e" name="id_e" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Bài giảng E</label>
							<div class="col-sm-9">
								<input type="checkbox" class="flat-red" name="is_elearning" id="is_elearning" />
							</div>
						</div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">File</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="file_e" placeholder="File dữ liệu"
                                name="file_e" required="" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_file()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Export" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lựa chọn điều kiện xuất báo cáo</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_export" enctype="multipart/form-data">
                    <input id="id_e" name="id_e" type="hidden"/>
                    <div class="box-body">
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Nhóm dữ liệu</label>
							<div class="col-sm-9">
								<select class="form-control" id="nhomdulieu" name="nhomdulieu" style="width:100%">
                                </select>
							</div>
						</div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tác giả</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="tacgia" name="tacgia[]" style="width:100%"
                                multiple="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Lĩnh vực</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="linhvuc_s" placeholder="Lĩnh vực"
                                name="linhvuc_s"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="export_file()">Xuất file</button>
            </div>
        </div>
    </div>
</div>
