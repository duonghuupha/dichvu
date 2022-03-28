<script type="text/javascript" src="<?php echo URL.'/public/javascript/thietbi/nhapkho.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Nhập kho thiết bị
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
                    <div class="box-body table-responsive no-padding" id="list_thietbi">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

