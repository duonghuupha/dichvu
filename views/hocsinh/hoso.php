<?php
$item = $this->jsonObj; $quanhe = $this->quanhe; $convert = new Convert();
$img = ($item[0]['gioi_tinh'] == 1) ? 'boy' : 'girl'; $quatrinh = $this->quatrinh;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Hồ sơ học sinh</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                            src="<?php echo URL.'/styles/dist/img/'.$img.'.png' ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $item[0]['fullname'] ?></h3>
                        <p class="text-muted text-center">Lớp lớn A1</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Mã học sinh</b> <a class="pull-right"><?php echo $item[0]['code'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Ngày sinh</b> <a
                                    class="pull-right"><?php echo date("d-m-Y", strtotime($item[0]['ngay_sinh'])) ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Giới tính</b> <a
                                    class="pull-right"><?php echo ($item[0]['gioi_tinh'] == 1) ? 'Nam' : 'Nữ' ?></a>
                            </li>
                            <li class="list-group-item" style="border-bottom:none">
                                <b>Địa chỉ</b> <a class="pull-right"><?php echo $item[0]['dia_chi'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vài điều về học sinh</h3>
                    </div>
                    <div class="box-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Thông tin</a></li>
                        <li><a href="#quatrinh" data-toggle="tab">Quá trình học</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    foreach($quanhe as $row){
                                    ?>
                                    <div class="col-md-4">
                                        <dl>
                                            <dt>Quan hệ với học sinh: <?php echo $convert->return_title_quan_he($row['loai_quan_he']) ?></dt>
                                            <dd><?php echo $row['fullname'] ?></dd>
                                            <dt>Điện thoại</dt>
                                            <dd><?php echo $row['dien_thoai'] ?></dd>
                                            <dt>Năm sinh</dt>
                                            <dd><?php echo $row['nam_sinh'] ?></dd>
                                            <dt>Nghề nghiệp</dt>
                                            <dd><?php echo $row['nghe_nghiep'] ?></dd>
                                        </dl>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="quatrinh">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="timeline">
                                        <?php
                                        foreach($quatrinh as $rows){
                                        ?>
                                        <li class="time-label">
                                            <span class="bg-green">
                                                <?php echo date("d-m-Y", strtotime($rows['date_change'])) ?>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="fa fa-random bg-blue"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    <?php echo ($rows['phongban_from'] == 0) ? 'Xếp lớp' : 'Chuyển lớp' ?>
                                                </h3>
                                                <div class="timeline-body">
                                                <?php
                                                if($rows['phongban_from'] == 0){
                                                    echo 'Xếp vào '.$rows['den'].' cho học sinh';
                                                }else{
                                                    echo 'Từ '.$rows['tu'].' đến '.$rows['den'];
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
