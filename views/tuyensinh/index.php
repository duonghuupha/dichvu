<?php
$info = $_SESSION['data']; $convert = new Convert();
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/tuyensinh/index.js' ?>"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý tuyển sinh
            <small class="pull-right">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <button type="button" class="btn btn-block btn-success" onclick="add()">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </button>
                <?php
                }
                ?>
            </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Tìm kiếm</h3>
                    </div>
                    <div class="box-body">
                        <label style="width: 100%;">
                            <input type="text" class="form-control" id="codes"
                            placeholder="Mã hồ sơ tuyển sinh" name="codes"/>
                        </label>
                        <label style="width: 100%;">
                            <input type="text" class="form-control" id="names"
                            placeholder="Họ và tên" name="names"/>
                        </label>
                        <label style="width: 100%;">
                            <select class="form-control" data-placeholder="Đối tượng"
                            style="width: 100%;" id="doituongs" name="doituongs">
                                <option value="">Tất cả</option>
                                <option value="1">DT 1</option>
                                <option value="2">DT 2</option>
                                <option value="3">DT 3</option>
                                <option value="4">TT</option>
                            </select>
                        </label>
                        <label style="width: 100%;">
                            <select class="form-control" data-placeholder="Lứa tuổi"
                            style="width: 100%;" id="tuois" name="tuois">
                                <option value="">Tất cả</option>
                                <option value="5">Trẻ 5 tuổi</option>
                                <option value="4">Trẻ 4 tuổi</option>
                                <option value="3">Trẻ 3 tuổi</option>
                                <option value="2">Trẻ 2 tuổi</option>
                            </select>
                        </label>
                        <div class="col-md-12" style="margin-top:20px;">
                            <button type="button" class="btn btn-block btn-success" onclick="search()">
                                <i class="fa fa-search"></i>
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách hồ sơ tuyển sinh</h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="noidung">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
