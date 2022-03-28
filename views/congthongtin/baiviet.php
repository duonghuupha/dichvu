<?php
$info = $_SESSION['data']; $convert = new Convert();
?>
<script>
var str_url = '<?php echo $_SESSION['url'] ?>';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/congthongtin/baiviet.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách bài viết
            <?php
            if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)
            || $convert->check_roles_user($info[0]['id'], $_SESSION['url'], 6)
            || $convert->check_roles_user($info[0]['id'], $_SESSION['url'], 11)){
            ?>
            <small class="pull-right baiviet">
                <div class="btn-group">
                    <button type="button" class="btn btn-success">Chức năng</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 1)){
                        ?>
                        <li><a href="javascript:void(0)" onclick="add_baiviet()">Thêm mới</a></li>
                        <?php
                        }
                        ?>
                        <?php
                        if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 6)){
                        ?>
                        <li><a href="javascript:void(0)" onclick="duyetbai()">Duyệt bài</a></li>
                        <?php
                        }
                        ?>
                        <?php
                        if($convert->check_roles_user($info[0]['id'], $_SESSION['url'], 11)){
                        ?>
                        <li><a href="javascript:void(0)" onclick="dangtin()">Đăng tin</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </small>
            <?php
            }
            ?>
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
                                    placeholder="Tìm kiếm">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="baivietctt">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
