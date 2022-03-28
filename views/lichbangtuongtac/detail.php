<style>
.noidungdk{float:left;margin-bottom:20px;}
.noidungdk span{float:left; width:100%; line-height:2em;}
</style>
<?php
$item = $this->jsonObj;
?>
<div class="noidungdk">
    <span>Ngày đăng ký: <b><?php echo date("d-m-Y",  strtotime($item[0]['ngay_hoc'])) ?></b></span>
    <span>Thời gian đăng ký: <b><?php echo $item[0]['bat_dau'].' - '.$item[0]['ket_thuc'] ?></b></span>
    <span>Giáo viên: <b><?php echo $item[0]['nguoidung'] ?></b></span>
    <span>Tiêu đề bài giảng: <b><?php echo $item[0]['title'] ?></b></span>
</div>