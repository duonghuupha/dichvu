<?php
$sql = new Model(); $item = $this->detail; $itemtt = $this->detail_tt;
$namhoc = $sql->get_title_nam_hoc_by_id($item[0]['nam_hoc_id']);
$truonghoc = $this->truonghoc;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">

<html>
<head>
    <title><?php echo $truonghoc[0]['title'] ?> :: Biên bản giao nhận hồ sơ</title>
    <style>
    @page { 
        size: A5 
    }
    *{
        margin:0;
        padding:0;
    }
    body{
        font-size: 15px;
        font-family:Time new Roman;
    }
    ul, ol{
        list-style:none;
    }
    .main{
        width:90%;
        margin:0 auto;
        overflow: hidden;
    }
    .main .top{
        float:left;
        width:100%;
        overflow:hidden;
    }
    .main .top .code{
        float:left;
        width:100%;
        margin-bottom:20px;
        font-weight:700;
    }
    .main .top .phong{
        float:left;
        width:100%;
        text-align: center;
        margin-bottom:30px;
    }
    .main .top .phong span{
        text-transform: uppercase;
        font-weight:normal;
        font-size:18px;
        border-bottom:1px solid black;
    }
    .main .top .left{
        float:left;
        width:90%;
    }
    .main .top .left .tieude{
        float:left;
        width:100%;
        text-align: center;
        font-weight:700;
        margin-left:20px;
        margin-bottom:20px;
    }
    .main .top .left .tieude span{
        float:left;
        width:100%;
        font-size:18px;
    }
    .main .top .left .tieude span:nth-child(1){
        text-transform: uppercase;
    }
    .main .top .left .tentruong{
        float:left;
        width:100%;
        text-align:center;
        margin-left:20px;
        margin-bottom:20px;
        font-size:18px;
        font-weight:700;
    }
    .main .top .left .tentruong span{
        text-transform: uppercase;
    }
    .main .top .right{
        float:left;
        width:10%;
        text-align: center;
    }
    .main .top .right span{
        border:2px solid black;
        padding:5px;
        font-weight:700;
    }
    .main .middel{
        float: left;
        width:100%;
        overflow: hidden;
    }
    .main .middel span{
        float:left;
        width:100%;
        line-height:1.5em;
    }
    .main .middel span:nth-child(1){
        font-style:italic;
    }
    .main .middel span p:nth-child(1){
        float:left;
        width:60%;
    }
    .main .middel span p:nth-child(2){
        float:left;
        width:40%;
    }
    .main .noidung{
        float:left;
        width:100%;
        overflow:hidden;
    }
    .main .noidung .title{
        float:left;
        width:100%;
        text-align: center;
        margin-top:15px;
        margin-bottom:15px;
    }
    .main .noidung .title span{
        text-transform: uppercase;
        font-weight:700;
        font-size:18px;
    }
    .main .noidung .hoso{
        float:left;
        width:100%;
    }
    .main .noidung .hoso ul li{
        float:left;
        width:100%;
        margin-bottom:5px;
    }
    .main .noidung .hoso li span:nth-child(1){
        float:left;
        border: 1px solid black;
        text-align: center;
        padding:0px 5px 0px 5px;
        margin-right:10px;
    }
    .noidung .chuky{
        float:left;
        width:100%;
        margin-top:20px;
    }
    .noidung .chuky .col{
        float:left;
        width:50%;
        text-align: center;
        overflow:hidden;
    }
    .noidung .chuky .col span{
        float:left;
        width:100%;
    }
    .noidung .chuky .col span:nth-child(2){
        font-style: italic;
    }
    .noidung .chuky .col span:nth-child(3){
        font-weight:700;
        margin-top:70px;
        font-size:16px;
    }
    </style>
</head>

<body onload="window.print()">
<div class="main">
    <div class="top">
        <div class="code">
            <span>Mã số: <?php echo $_REQUEST['code'] ?></span>
        </div>
        <div class="phong">
            <span>Phòng GD&ĐT quận long biên</span>
        </div>
        <div class="left">
            <div class="tieude">
                <span>Biên bản giao - nhận hồ sơ</span>
                <span>Năm học <?php echo $namhoc[0]['title'] ?></span>
            </div>
            <div class="tentruong">
                <span><?php echo $truonghoc[0]['title'] ?></span>
            </div>
        </div>
        <div class="right">
            <span><?php echo $sql->get_title_lop_muon_vao($item[0]['lop_muon_vao']) ?></span>
        </div>
    </div>
    <div class="middel">
        <span>Thời gian, <?php echo date("H") ?> giờ <?php echo date("i") ?> ngày <?php echo date("d", strtotime($_REQUEST['ngaynhan'])) ?> tháng <?php echo date("m", strtotime($_REQUEST['ngaynhan'])) ?> năm <?php echo date("Y", strtotime($_REQUEST['ngaynhan'])) ?></span>
        <span>
            <p>Người giao:<b><?php echo $itemtt[0]['nguoigiao'] ?></b>;</p>
            <p>Số CMND:<b><?php echo $itemtt[0]['cmnd'] ?></b></p>
        </span>
        <span>
            <p>Người nhận:<b><?php echo $itemtt[0]['nguoinhan'] ?></b>;</p>
            <p>Số CMND:<b><?php echo $itemtt[0]['cmt'] ?></b></p>
        </span>
    </div>
    <div class="noidung">
        <div class="title">
            <span>Nội dung giao nhận</span>
        </div>
        <div class="hoso">
            <ul>
                <li>
                    <span><?php echo ($itemtt[0]['don_xin_hoc'] == 1) ? '&#10004;' : '&nbsp;'?></span>
                    <span>1. Đơn xin học (Đơn đăng ký tuyển sinh)</span>
                </li>
                <li>
                    <span><?php echo ($itemtt[0]['giay_khai_sinh'] == 1) ? '&#10004;' : '&nbsp;'?></span>
                    <span>2. Giấy khai sinh (bản sao hợp lên)</span>
                </li>
                <li>
                    <span><?php echo ($itemtt[0]['photo_ho_khau'] == 1) ? '&#10004;' : '&nbsp;'?></span>
                    <span>3. Bản photo Hộ khẩu (có bản chính để đối chiếu) hoặc giấy tờ khác thay thế
                    <b>(giấy hẹn đã hoàn thành thủ tục nhập khẩu của công an quận huyện, thị xã hoặc giấy xác nhận
                    cư trú tại địa bàn của công an cấp phường, xã, thị trấn)</b></span>
                </li>
                <li>
                    <span><?php echo ($itemtt[0]['giay_to_khac'] != '') ? '&#10004;' : '&nbsp;'?></span>
                    <span>4. Giấy tờ khác</span>
                </li> 
                <li>
                    <p><?php echo ($itemtt[0]['giay_to_khac'] != '') ? $itemtt[0]['giay_to_khac'] : ''?></p>
                </li>
            </ul>
        </div>
        <div class="chuky">
            <div class="col">
                <span>Người giao</span>
                <span>(họ tên, chữ ký)</span>
                <span><?php echo $itemtt[0]['nguoigiao'] ?></span>
            </div>
            <div class="col">
                <span>Người nhận</span>
                <span>(họ tên, chữ ký)</span>
                <span><?php echo $itemtt[0]['nguoinhan'] ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
