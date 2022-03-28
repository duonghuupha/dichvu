<?php
$jsonObj = $this->jsonObj; $socon = $this->socon;
if($jsonObj[0]['cate_id'] == 0){
    if($jsonObj[0]['nguyen_gia'] >= 10000000){
        $danhmuc = "Tài sản cố định";
    }else{
        $danhmuc = "Công cụ dụng cụ";
    }
}else{
    $danhmuc = $jsonObj[0]['danhmuc'];
}
?>
<img class="profile-user-img img-responsive" src="<?php echo URL.'/inmathietbi/qrcode?data='.base64_encode($jsonObj[0]['code']."-".$socon).'&size=128x128' ?>"/>
<h3 class="profile-username text-center"><?php echo $jsonObj[0]['title'] ?></h3>
<ul class="list-group list-group-unbordered">
    <li class="list-group-item">
        <b>Mã thiết bị</b> <a class="pull-right"><?php echo $jsonObj[0]['code'] ?></a>
    </li>
    <li class="list-group-item">
        <b>Mã phụ</b> <a class="pull-right"><?php echo $socon ?></a>
    </li>
    <li class="list-group-item">
        <b>Danh mục</b> <a class="pull-right" style="font-size:12px;"><?php echo $danhmuc ?></a>
    </li>
    <li class="list-group-item">
        <b>Năm sử dụng</b> <a class="pull-right"><?php echo $jsonObj[0]['nam_su_dung'] ?></a>
    </li>
    <li class="list-group-item">
        <b>Nguyên giá</b> <a class="pull-right"><?php echo $jsonObj[0]['nguyen_gia'] ?></a>
    </li>
    <li class="list-group-item">
        <b>Khấu hao (%/năm)</b> <a class="pull-right"><?php echo $jsonObj[0]['khau_hao'] ?></a>
    </li>
    <li class="list-group-item">
        <b>Xuất sứ</b> <a class="pull-right"><?php echo $jsonObj[0]['xuat_su'] ?></a>
    </li>
</ul>