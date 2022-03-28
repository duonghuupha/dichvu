<script type="text/javascript" src="<?php echo URL.'/public/javascript/hocsinh/chuyenlop.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Chuyển / lên lớp cho học sinh
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="data_chuyenlop" name="data_chuyenlop" value="0" type="hidden"/>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ lớp</label>
                                    <select class="form-control" id="tu_lop" name="tu_lop" required=""
                                    onchange="render_list_hocsinh(this.value)">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đến lớp</label>
                                    <select class="form-control" id="den_lop" name="den_lop" required="">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save_chuyenlop()">Chuyển lớp</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/hocsinh' ?>'">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>