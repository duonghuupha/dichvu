<?php
$info = $_SESSION['data']; $convert = new Convert();
?>
<script>
var str_url = '<?php echo $_SESSION['url'] ?>';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/vanban/vanbanden.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách văn bản đến
            <small class="pull-right">
                <?php
                if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                ?>
                <button type="button" class="btn btn-block btn-success" onclick="add_vanbanden()">
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
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding" id="list_vanbanden">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
