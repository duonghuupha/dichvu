<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PTSOFT | Đăng nhập</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/Ionicons/css/ionicons.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/AdminLTE.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/iCheck/square/blue.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/roboto.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>bower_components/select2/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="<?php echo URL.'/styles/' ?>plugins/toastr/toastr.min.css"/>
    <script src="<?php echo URL.'/styles/' ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo URL.'/styles/' ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var baseUrl = '<?php echo URL ?>'; var namhocid = 0; var truonghocid = 0;
       	$(function(){
			$('#truonghoc_id').select2();
       	});
    </script>
    <script src="<?php echo URL.'/public/' ?>javascript/librarys.js"></script>
    <link rel="shortcut icon" href="<?php echo URL.'/styles/' ?>dist/img/logo1.png" type="image/x-icon"/>
    <style>
    body{
        height: auto;
    }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0)"><b>PT</b>SOFT</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>
            <form method="post" id="fm" onsubmit="login_s()">
                <div class="form-group has-feedback">
                    <select class="form-control" placeholder="Lựa chọn trường học" id="truonghoc_id" name="truonghoc_id">

                    </select>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Tên đăng nhập" id="username" name="username"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Mật khẩu" id="password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="checkbox icheck">
                            <label>
                                <!--<input type="checkbox"/> Ghi nhớ tôi-->
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <button type="button" class="btn btn-primary btn-block btn-flat" onclick="login_s()">
                            Đăng nhập
                        </button>
                    </div>
                </div>
            </form>
            <div class="social-auth-links text-center">
                <p>- Liên kết với chúng tôi -</p>
                <a href="javascript:void(0)" class="btn btn-block btn-social btn-google btn-flat"
                onclick="window.location.href='<?php echo URL.'/index/login' ?>'">
                    <i class="fa fa-bank "></i> Đăng nhập với tài khoản quản trị
                </a>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"  onclick="forgot_pass()">
                    <i class="fa fa-commenting"></i> Quên mật khẩu
                </a>
            </div>
        </div>
    </div>
    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
        $('#truonghoc_id').load('<?php echo URL.'/other/combo_truonghoc' ?>');
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            login_s();
        }
    });
    </script>
</body>

</html>
