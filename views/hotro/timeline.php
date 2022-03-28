<?php $jsonObj = $this->jsonObj; $sql = new Model(); $info = $_SESSION['data'] ?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/hotro/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $jsonObj[0]['dichvu'] ?> :: <?php echo $jsonObj[0]['danhmuc'] ?>
            <small>Quá trình xử lý / khắc phục sự cố</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <ul class="timeline">
                    <!------------------ khoi tao yeu cau ---------------------------->
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("H:i:s d-m-Y", strtotime($jsonObj[0]['create_at'])) ?></span>
                            <h3 class="timeline-header">Khởi tạo yêu cầu : Mã yêu cầu #<?php echo $jsonObj[0]['code'] ?></h3>
                            <div class="timeline-body">
                                <?php echo $jsonObj[0]['noidung'] ?>
                                Số điện thoại liên lạc khách hàng: <b><?php echo $jsonObj[0]['sodienthoai'] ?></b>
                                <?php
                                if($jsonObj[0]['image'] != ''){
                                ?>
                                <hr/>
                                <a href="<?php echo URL.'/public/hotro/'.$jsonObj[0]['image'] ?>" target="_blank">
                                    <?php echo $jsonObj[0]['image'] ?>
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            if($sql->check_yeucau_duyet($jsonObj[0]['id'], 1) == 0 && $info[0]['truonghoc_id'] != 0){
                            ?>
                            <div class="timeline-footer">
                                <a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="duyet_yeucau(<?php echo $jsonObj[0]['id']?>)">
                                    <i class="fa fa-check"></i>
                                    Duyệt yêu cầu
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($sql->check_yeucau_duyet($jsonObj[0]['id'], 2) == 0 && $info[0]['truonghoc_id'] == 0){
                            ?>
                            <div class="timeline-footer">
                                <a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="tiepnhan_yeucau(<?php echo $jsonObj[0]['id']?>)">
                                    <i class="fa fa-check"></i>
                                    Tiếp nhận yêu cầu và xử lý
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                    <!------------------ Yeu cau da duco duyet ---------------------------->
                    <?php
                    if(count($this->detail) > 0){
                        foreach($this->detail as $row){
                            if($row['status'] == 1){
                                $title = "Phê duyệt yêu cầu : Mã yêu cầu #". $row['code'];
                                $noidung = "Yêu cầu có <b>mã #".$row['code'].' - '.$row['dichvu'].' :: '.$row['danhmuc']."</b> đã được cấp trên phê duyệt<br/>";
                                $noidung .= "Đề nghị đơn vị cung cấp dịch vụ thực hiện theo yêu cầu đã được duyệt trong thời gian sớm nhất";
                            }elseif($row['status'] == 2){
                                $title = "Tiếp nhận yêu cầu";
                                $noidung = "Kính thưa quý khách.<br/>";
                                $noidung .="Kỹ thuật <b>NGOCDAT CORP</b> đã tiếp nhận yêu cầu <b>#".$row['code']." - ".$row['dichvu']." :: ".$row['danhmuc']."</b> của Quý khách.<br/>";
                                $noidung .= "Hiện tại, yêu cầu đang được <b>".$row['nhanvien']."</b> thuộc trung tâm Hỗ trợ kỹ thuật tiến hành kiểm tra thông tin để xử lý.";
                                $noidung .= "Dự kiến, yêu cầu sẽ được xử lý hoàn tất trong vòng <b>".$row['thoi_gian']."</b> (hoặc có thể sớm hơn). Nếu có phát sinh thêm thời gian trong quá trình xử lý ";
                                $noidung .= "<b>NGOCDAT CORP</b> sẽ liên hệ trực tiếp qua điện thoại đến Quý khách để trao đổi thêm thông tin. Xin vui lòng giữ liên lạc qua điện thoại.<br/>";
                                $noidung .= "Xin trân trọng cảm ơn Quý khách.";
                            }elseif($row['status'] == 3){
                                $title = "Đang xử lý yêu cầu";
                                $noidung = $row['noidung'];
                            }else{
                                $title = "Yêu cầu đã được xử lý";
                                $noidung = "Yêu cầu của Quý khách đã được xử lý hoàn tất vào hồi ".$row['create_at'].". Xin trân trọng cảm ơn quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi<br/>";
                                $noidung .= "<b>Ký xác nhận:</b><br/>";
                                $noidung .= "<img src='".$row['chu_ky']."' width='100%'/>";
                            }
                    ?>
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></span>
                            <h3 class="timeline-header"><?php echo $title ?></h3>
                            <div class="timeline-body">
                                <?php echo $noidung ?>
                            </div>
                        </div>
                    </li>
                    <?php
                        }
                    }
                    ?>
                    <!------------------ qua trinh xu ly yeu cau---------------------------->
                    <?php
                    if(($sql->check_yeucau_duyet($jsonObj[0]['id'], 2) == 1 || $sql->check_yeucau_duyet($jsonObj[0]['id'], 3) > 0) && $sql->check_yeucau_duyet($jsonObj[0]['id'], 4) == 0){
                    ?>
                    <li>
                        <i class="fa fa-pencil bg-blue"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header">Phản hồi</h3>
                            <div class="timeline-body">
                                <form class="form-horizontal" id="fm_phanhoi" enctype="multipart/form-data">
                                    <input id="id" name="id" type="hidden" value="<?php echo $jsonObj[0]['id'] ?>"/>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" class="form-control" id="noidung_phanhoi" placeholder="Nội dung"
                                                name="noidung" style="height:150px;resize:none" required></textarea>
                                            </div>
                                        </div>
                                        <?php
                                        if($info[0]['truonghoc_id'] == 0){
                                        ?>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Chi phí</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="chi_phi" placeholder="Chi phí"
                                                name="chi_phi" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"
                                                value="0"/>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="box-footer pull-right">
                                            <button type="button" class="btn btn-primary" onclick="save_phanhoi()">Gửi phản hồi</button>
                                            <?php
                                            if($sql->check_yeucau_duyet($jsonObj[0]['id'], 2) > 0 && $info[0]['truonghoc_id'] == 0){
                                            ?>
                                            <button type="button" class="btn btn-success" onclick="hoan_thanh(<?php echo $jsonObj[0]['id'] ?>)">Hoàn thành</button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="tiepnhan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tiếp nhận yêu cầu</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm_tiepnhan">
                    <input id="id" name="id" type="hidden" value="0"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Thời gian xử lý</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="thoi_gian" placeholder="Thời gian xử lý lỗi. VD: 1 ngày hoặc 5h"
                                name="thoi_gian" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Người xử lý</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="user_pro" name="user_pro">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nội dung</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="noidung_tiepnhan" placeholder="Nội dung"
                                name="noidung" style="height:150px;resize:none"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save_tiepnhan()">Tiếp nhận</button>
            </div>
        </div>
    </div>
</div>