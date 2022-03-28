<?php $convert = new Convert(); $info = $_SESSION['data'] ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/lichbangtuongtac/baocao.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Thống kê sử dụng bảng tương tác
            <small class="pull-right hidden-xs">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    onclick="export_xls()">
                    <i class="fa fa-file-excel-o"></i>
                    Xuất Excel
                </button>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-3">
                <div class="box box-success">
                    <div class="box-body">
                        <label style="width: 100%;">Tháng
                            <select class="form-control" data-placeholder="Tháng"
                            style="width: 100%;" id="thang" name="thang">
                                <?php
                                for($i = 1; $i <= 12; $i++){
                                    $select_thang = ($i == date('m')) ? 'selected=""' : '';
                                ?>
                                <option value="<?php echo $i ?>" <?php echo $select_thang ?>>Tháng <?php echo $i ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </label>
                        <label style="width: 100%;">Năm
                            <select class="form-control" data-placeholder="Năm"
                            style="width: 100%;" id="nam" name="nam">
                                <?php
                                for($z = 2017; $z <= 2025; $z++){
                                    $select_nam = ($z == date("Y")) ? "selected=''" : '';
                                ?>
                                <option value="<?php echo $z ?>" <?php echo $select_nam ?>>Năm <?php echo $z ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </label>
                        <div class="col-md-12" style="margin-top:20px;">
                            <button type="button" class="btn btn-block btn-success" onclick="tim_kiem()">
                                <i class="fa fa-search"></i>
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-9">
                <div class="box box-success">
                    <div class="box-body no-padding" id="baocaothongke">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
