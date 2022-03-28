<script type="text/javascript" src="<?php echo URL.'/public/javascript/baocaothietbi/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Báo cáo thiết bị
            <small class="pull-right">
                <button type="button" class="btn btn-danger" id="btn_quaylai" onclick="quay_lai()">
                    <i class="fa fa-refresh"></i> Quay lại
                </button>
                <button type="button" class="btn btn-success" id="xuatfile">
                    <i class="fa fa-file-excel-o"></i> Xuất Excel
                </button>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4" id="cot-trai">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-6">
                                <a class="btn btn-app" style="width:100%" onclick="sothietbi(<?php echo $this->tongthietbi ?>)">
                                    <span class="badge bg-green"><?php echo $this->tongthietbi ?></span>
                                    <i class="fa fa-barcode"></i> Sổ thiết bị tổng hợp
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-app" style="width:100%" onclick="socongcu(<?php echo $this->tongcongcu ?>)">
                                    <span class="badge bg-red"><?php echo $this->tongcongcu ?></span>
                                    <i class="fa fa-cubes"></i> Sổ công cụ dụng cụ
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-app" style="width:100%" onclick="sothietbichitiet(<?php echo $this->tongthietbi ?>)"
                                data-toggle="tooltip" data-container="body" data-placement="bottom" title="In sổ thiết bị theo phòng ban">
                                    <span class="badge bg-green"><?php echo $this->tongthietbi ?></span>
                                    <i class="fa fa-barcode"></i> Sổ thiết bị chi tiết
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-app" style="width:100%" onclick="socongcuchitiet(<?php echo $this->tongcongcu ?>)"
                                data-toggle="tooltip" data-container="body" data-placement="bottom" title="In sổ công cụ theo phòng ban">
                                    <span class="badge bg-red"><?php echo $this->tongcongcu ?></span>
                                    <i class="fa fa-cubes"></i> Sổ công cụ chi tiết
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a class="btn btn-app" style="width:100%" onclick="sotonghop()">
                                    <i class="fa fa-cubes"></i> Sổ tổng hợp trang thiết bị phòng ban
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8" id="cot-phai">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title" id="tieude">
                            Sổ thiết bị
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="baocaothietbi">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
