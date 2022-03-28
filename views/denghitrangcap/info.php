<?php
$sql = new Model();
$item = $this->detail; $json = $this->json;
$truonghoc = $sql->get_info_truonghoc($item[0]['truonghoc_id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">

<html>
<head>
    <title>Giấy đề nghị trang cấp</title>
</head>

<body onload="window.print();">
<div class="main">
    <div class="top">
        <div class="top_left">
            <span><?php echo $truonghoc[0]['title'] ?></span>
        </div>
        <div class="top_right">
            <span>Cộng hòa xa hội chủ nghĩa Việt Nam</span>
            <span>Độc lập - Tự do - Hạnh phúc</span>
        </div>
    </div>
    <div class="middle">
        <span>GIẤY ĐỀ NGHỊ TRANG CẤP</span>
        <span>Số: <?php echo $item[0]['code'] ?></span>
        <span>Kính gửi: Ban giám hiệu <?php echo $truonghoc[0]['title'] ?></span>
    </div>
    <div class="content">
        <div class="content_top">
            <span>Người đề xuất: <b><?php echo $item[0]['nguoidenghi'] ?></b></span>
            <span>Phân công nhiệm vụ: <b><?php echo $item[0]['job'] ?></b></span>
            <span>Nội dung đề xuất: <b><?php echo $item[0]['content'] ?></span>
        </div>
        <div class="content_middle">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Nội dung</th>
                        <th>Đơn vị tính</th>
                        <th>Số lượng</th>
                        <th class="text-right">Đơn giá</th>
                        <th class="text-right">Thành tiền</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0; $soluong = 0; $thanhtien= 0;
                    foreach($json as $row){
                        $i++;
                        $soluong = $soluong + $row['so_luong'];
                        $thanhtien = $thanhtien +  ($row['so_luong'] * $row['don_gia']);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td class="text-center"><?php echo $row['donvitinh'] ?></td>
                        <td class="text-center"><?php echo number_format($row['so_luong']) ?></td>
                        <td class="text-right"><?php echo number_format($row['don_gia']) ?></td>
                        <td class="text-right"><?php echo number_format($row['don_gia']*$row['so_luong']) ?></td>
                        <td><?php echo $row['ghi_chu'] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">Tổng cộng</td>
                        <td class="text-center"><?php echo number_format($soluong) ?></td>
                        <td></td>
                        <td class="text-right"><?php echo number_format($thanhtien) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="ghichu">
            <span>Ghi chú: <?php echo $item[0]['ghi_chu'] ?></span>
        </div>
    </div>
    <div class="footer">
        <div class="nguoiduyet">
            <span>Thủ trưởng đơn vị</span>
            <span>(Ký, ghi rõ họ tên)</span>
            <span><?php echo $item[0]['nguoiduyet'] ?></span>
        </div>
        <div class="nguoidexuat">
            <span>Người đề xuất</span>
            <span>(Ký, ghi rõ họ tên)</span>
            <span><?php echo $item[0]['nguoidenghi'] ?></span>
        </div>
    </div>
</div>
</body>
<style>
.main{
    width:100%;
    overflow:hidden;
    font-size:17px;
}

.main .top, .main .middle, .main .content, .main .footer{
    float:left;
    width: 100%;
    overflow:hidden;
}

.main .top{
    margin-bottom:20px;
}

.main .top .top_left{
    float:left;
    width:40%;
    text-align:center;
    font-weight:700;
    text-transform: uppercase;
    line-height:1.5em;
}

.main .top .top_right{
    float:left;
    width:60%;
    text-align:center;
    font-weight: 700;
}

.main .top .top_right span{
    float:left;
    width:100%;
    line-height:1.5em;
}

.main .top .top_right span:nth-child(1){
    text-transform: uppercase;
}

.main .middle{
    margin-bottom:30px;
    text-align: center;
}

.main .middle span{
    float:left;
    width:100%;
    line-height: 1.5em;
}

.main .middle span:nth-child(1){
    font-weight:700;
    font-size:20px;
}

.main .middle span:nth-child(2){
    font-style:italic;
    font-size:14px;
}

.main .content{
    margin-bottom:30px;
    line-height:1.5em;
}

.main  .content .content_top span{
    float:left;
    width:100%;
    line-height:2em;
}

.main .content .content_middle table{
    border-collapse: collapse;
    width:100%;
}

.main .content .content_middle td, .main .content .content_middle th{
    border:1px solid #000;
    padding:6px;
}
.main .content .content_middle th{
    text-align:center
}

.main .content .content_middle .text-center{
    text-align:center
}

.main .content .content_middle .text-right{
    text-align:right
}

.main .content .content_middle tfoot{
    font-weight:700;
}

.main .footer div{
    float:left;
    width:50%;
    text-align: center;
}

.main .footer span{
    float:left;
    width:100%;
    line-height:1.5em;
}

.main .footer span:nth-child(1){
    font-weight:700;
    text-transform: uppercase;
}

.main .footer span:nth-child(2){
    font-style: italic;
}

.main .footer span:nth-child(3){
    margin-top:60px;
    text-transform: uppercase;
    font-weight:700;
}

.main .content .ghichu{
    float:left;
    width:100%;
    margin-top:10px;
    font-style:italic;
    font-size:13px;
}
</style>
</html>
