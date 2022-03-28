<?php
$sql = new Model(); $item = $this->detail; $itemtt = $this->detail_tt;
$truonghoc = $this->truonghoc;
$hiennay[] = $sql->get_title_thon_to_via_id($item[0]['thon_hien_tai']);
$hiennay[] = $sql->get_title_xa_via_id($item[0]['xa_hien_tai']);
$hiennay[] = $sql->get_title_huyen_via_id($item[0]['huyen_hien_tai']);
$hiennay[] = $sql->get_title_tinh_via_id($item[0]['tinh_hien_tai']);

$thuongtru[] = $sql->get_title_thon_to_via_id($item[0]['thon_thuong_tru']);
$thuongtru[] = $sql->get_title_xa_via_id($item[0]['xa_thuong_tru']);
$thuongtru[] = $sql->get_title_huyen_via_id($item[0]['huyen_thuong_tru']);
$thuongtru[] = $sql->get_title_tinh_via_id($item[0]['tinh_thuong_tru']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">

<html>
<head>
    <title><?php echo $truonghoc[0]['title'] ?> :: Giấy tiếp nhận</title>
    <style>
    @page { 
        size: A5 landscape;
    }
    *{
        margin:0;
        padding:0;
    }
    body{
        font-family:Time new roman;
        font-size:16px;
    }
    .main {
        width:90%;
        margin:0 auto;
    }
    .main .top{
        float:left;
        width:100%;
        text-align: center;
        margin-bottom:30px;
    }
    .main .top span{
        float:left;
        width:100%;
        font-size:22px;
        text-transform: uppercase;
        font-weight: 700;
        line-height:1.5em;
    }
    .main .noidung{
        float:left;
        width:100%;
    }
    .main .noidung span{
        float:left;
        width:100%;
        line-height:1.5em;
    }
    .main .footer{
        float:left;
        width:100%;
    }
    .main .footer .col1{
        float:left;
        width:50%;
    }
    .main .footer .col2{
        float:left;
        width:50%;
    }
    .main .footer .col2 span{
        float:left;
        width:100%;
        font-weight:700;
        text-align: center;
    }
    .main .footer span:nth-child(1){
        font-size:20px;
        text-transform: uppercase;
        margin-bottom:80px;
    }
    .main .code{
        float:left;
        width:100%;
        margin-bottom:20px;
        font-weight:700;
    }
    </style>
</head>

<body onload="window.print()">
<div class="main">
    <div class="code">
        <span>Mã số: <?php echo $_REQUEST['code']; ?></span>
    </div>
    <div class="top">
        <span><?php echo $truonghoc[0]['title'] ?></span>
        <span>Phiếu tiếp nhận</span>
    </div>
    <div class="noidung">
        <span>Họ tên trẻ: <b><?php echo $item[0]['ho_ten'] ?></b></span>
        <span>Ngày, tháng, năm sinh: <b><?php echo date("d/m/Y", strtotime($item[0]['ngay_sinh'])) ?></b></span>
        <span>Nơi ở hiện nay: <b><?php echo implode(", ", array_filter($hiennay)) ?></b></span>
        <span>Hộ khẩu thường trú: <b><?php echo implode(", ", array_filter($thuongtru)) ?></b></span>
        <span>Được tiếp nhận vào lớp: <b><?php echo $sql->get_title_lop_muon_vao($item[0]['lop_muon_vao']) ?></b></span>
        <span>Từ ngày: <b><?php echo date("d/m/Y", strtotime($itemtt[0]['tu_ngay'])) ?></b></span>
        <span>Tình trạng sức khỏe của trẻ: <b><?php echo $itemtt[0]['suc_khoe'] ?></b></span>
    </div>
    <div class="footer">
        <div class="col1">&nbsp;</div>
        <div class="col2">
            <span>T.M Hội đồng tuyển sinh</span>
            <span><?php echo $itemtt[0]['nguoinhan'] ?></span>
        </div>
    </div>
</div>
</body>
</html>

