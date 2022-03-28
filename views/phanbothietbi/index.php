<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/phanbo.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Phân bổ thiết bị
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" id="fm">
                        <input id="id" name="id" type="hidden" value="0"/>
                        <input id="code" name="code" type="hidden" value=""/>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lựa chọn phòng ban</label>
                                    <select class="form-control" data-placeholder="Lựa chọn phòng ban"
                                    style="width: 100%;" id="phongban_id" name="phongban_id"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lựa chọn thiết bị</label>
                                    <select class="form-control" data-placeholder="Lựa chọn thiết bị"
                                    style="width: 100%;" id="thietbi_id" onchange="set_thietbi_con()"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lựa chọn thiết bị con</label>
                                    <select class="form-control" data-placeholder="Lựa chọn thiết bị con"
                                    style="width: 100%;" id="thietbicon_id" onchange="set_data_dachon()"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Các thiết bị được phân bổ</label>
                                    <div id="dachon"></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">
                                <i class="fa fa-save"></i>
                                Cập nhật
                            </button>
                            <button type="button" class="btn btn-danger" onclick="javascript:location.reload(true)">
                                <i class="fa fa-times"></i>
                                Hủy bỏ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách phòng ban đã được phân bổ thiết bị
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_phanbo">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>