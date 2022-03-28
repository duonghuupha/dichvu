<script type="text/javascript" src="<?php echo URL.'/public/javascript/nguoidung/copy.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Copy quyền sử dụng / thao tác trên phần mềm
            <small>Copy quyền cho nhũng người dùng có chung chức năng và vai trò</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <form role="form" id="fm">
                <input id="datadc" name="datadc" type="hidden" value="0"/>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Copy từ</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lựa chọn người dùng</label>
                                <select class="form-control" id="user_id" name="user_id"
                                    placeholder="Lựa chọn phòng ban" onchange="set_data_combo()" required></select>
                            </div>
                            <div class="form-group roles_menu" id="quyen">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Đến</h3>
                        </div>
                        <form role="form">
                            <div class="box-body" id="list_nguoidung" style="height:500px;overflow:auto">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-footer" style="text-align:center">
                        <button type="button" class="btn btn-primary" onclick="save()">
                            <i class="fa fa-save"></i>
                            Cập nhật
                        </button>
                        <button type="button" class="btn btn-danger"onclick="window.location.href='<?php echo URL.'/nguoidung' ?>'">
                            <i class="fa fa-times"></i>
                            Hủy bỏ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
