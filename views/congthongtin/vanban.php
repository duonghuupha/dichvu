<?php
$info = $_SESSION['data']; $convert = new Convert();
?>
<script>
var str_url = '<?php echo $_SESSION['url'] ?>';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/vanban.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách văn bản
            <small class="pull-right">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <button type="button" class="btn btn-block btn-success" onclick="add_vanban()">
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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Tìm kiếm">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="vanbanctt">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
