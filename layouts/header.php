<?php
$info = $_SESSION['data']; $namhoc = $_SESSION['namhoc']; $sql = new Model();
$noti = $sql->get_list_noti_not_read($info[0]['truonghoc_id'], $info[0]['id']);
$convert = new Convert();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Hệ thống quản lý dịch vụ :: PTSOFT</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/Ionicons/css/ionicons.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/roboto.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/AdminLTE.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/skins/_all-skins.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/morris.js/morris.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/jvectormap/jquery-jvectormap.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/select2/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/iCheck/all.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/fullcalendar.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        var baseUrl = '<?php echo URL ?>';
        var truonghocid = <?php echo $info[0]['truonghoc_id'] ?>;
        var namhocid = <?php echo (isset($_SESSION['namhoc']) && count($_SESSION['namhoc']) > 0) ? $namhoc[0]['id'] : 0 ?>;
    </script>
    <script src="<?php echo URL.'/public/' ?>javascript/librarys.js"></script>
    <link rel="shortcut icon" href="<?php echo URL.'/styles/' ?>dist/img/logo1.png" type="image/x-icon"/>
</head>

<body class="hold-transition skin-blue sidebar-mini wysihtml5-supported fixed layout-navbar-fixed">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo URL.'/index'; ?>" class="logo">
                <span class="logo-mini"><b>PTS</b></span>
                <span class="logo-lg"><i class="fa fa-leaf"></i> <b>PT</b>SOFT</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"><?php echo count($noti) ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Bạn có <?php echo count($noti) ?> thông báo mới</li>
                                <?php
                                if(count($noti) > 0){
                                ?>
                                <li>
                                    <ul class="menu">
                                        <?php
                                        foreach($noti as $row){
                                        ?>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> <?php echo $row['content'] ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Xem tất cả</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Bạn có 5 công việc cần xử lý</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3> Design some buttons</h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="<?php echo URL.'/erp' ?>">Xem tất cả</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo URL.'/styles/' ?>dist/img/logo2.png" class="user-image"
                                    alt="User Image"/>
                                <span class="hidden-xs"><?php echo $info[0]['fullname'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo URL.'/styles/' ?>dist/img/logo2.png" class="img-circle"
                                        alt="User Image"/>
                                    <p>
                                        <?php echo $info[0]['fullname'] ?> - <?php echo $info[0]['job'] ?>
                                        <small><?php echo $namhoc[0]['title'] ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="javascript:void(0)" class="btn btn-default btn-flat" onclick="taikhoan(<?php echo $info[0]['id'] ?>)">Tài khoản</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo URL.'/index/logout' ?>" class="btn btn-default btn-flat">Đăng xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo URL.'/styles/' ?>dist/img/logo2.png" class="img-circle"
                            alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $info[0]['fullname'] ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Trực tuyến</a>
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <?php
                    echo Controller::renderMenuDichVu($info[0]['truonghoc_id'], $info[0]['id'], $info[0]['is_boss'], $_REQUEST['url']);
                    $quyen = $sql->get_all_roles_via_userid($info[0]['id'], 0);
                    if(count($quyen) > 0){
                        foreach($quyen as $row_level_1){
                            if($row_level_1['is_menu'] == 1){
                                $quyen_level_2 = $sql->get_all_roles_via_userid($info[0]['id'], $row_level_1['id']);
                                $class = (count($quyen_level_2) > 0) ? 'treeview' : '';
                                $span = (count($quyen_level_2) > 0) ? '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>' : '';

                    ?>
                    <li class="<?php echo $class ?>">
                        <a href="<?php echo URL.'/'.$row_level_1['link'] ?>">
                            <i class="fa fa-<?php echo $row_level_1['icon'] ?>"></i>
                            <span><?php echo $row_level_1['title'] ?></span>
                            <?php echo $span ?>
                        </a>
                        <?php
                        if(count($quyen_level_2) > 0){
                            echo "<ul class='treeview-menu'>";
                            foreach($quyen_level_2 as $row_level_2){
                                if($row_level_2['is_menu'] == 1){
                        ?>
                        <li class="">
                            <a href="<?php echo URL.'/'.$row_level_2['link'] ?>">
                                <i class="fa fa-circle-o"></i>
                                <span><?php echo $row_level_2['title'] ?></span>
                            </a>
                        </li>
                        <?php
                                }
                            }
                            echo "</ul>";
                        }
                        ?>
                    </li>
                    <?php
                            }
                        }
                    }
                    ?>
                    <li>
                        <a href="<?php echo URL.'/huongdansudung' ?>">
                            <i class="fa fa-book"></i> <span>Hướng dẫn sử dụng</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
