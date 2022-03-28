<?php
$sql = new Model(); $item = $this->jsonObj; $truonghoc = $this->truonghoc;
$namhoc = $sql->get_title_nam_hoc_by_id($item[0]['nam_hoc_id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $truonghoc[0]['title'] ?> :: Đơn xin học :: Mã hồ sơ <?php echo $item[0]['code'] ?></title>
    <style>
    *{
        margin:0;
        padding:0;
    }
    body{
        font-size:14px;
        font-family: Time new roman;
    }
    .donxinhoc{
        width:90%;
        margin:0 auto;
        overflow:hidden;
    }
    .donxinhoc .maso{
        float:left;
        width:100%;
        text-align: right;
        margin-bottom:10px;
    }
    .donxinhoc .tieungu{
        float:left;
        width:100%;
        text-align: center;
    }
    .donxinhoc .tieungu span{
        float:left;
        width:100%;
        line-height: 1.5em;
        text-align: center;
    }
    .donxinhoc .tieungu .tennuoc{
        text-transform: uppercase;
        font-weight: 700;
    }
    .donxinhoc .tieungu .slogan{
        font-weight: 700;
        margin-bottom:20px;
    }
    .donxinhoc .tieungu hr{
        border-top:1px solid black;
        width:15%;
        margin-bottom:20px;
    }
    .donxinhoc .tieude{
        float:left;
        width:100%;
        margin-bottom:20px;
    }
    .donxinhoc .tieude span{
        float:left;
        width:100%;
        line-height:2em;
        text-align: center;
        font-weight:700;
    }
    .donxinhoc .tieude .giaynhaphoc{
        font-size:16px;
        font-weight:700;
        text-transform: uppercase;
    }
    .donxinhoc .noidung{
        float:left;
        width:100%;
    }
    .donxinhoc .noidung .so1{
        float:left;
        width:100%;
    }
    .donxinhoc .noidung .so1 .title, .donxinhoc .noidung .so2 .title, .donxinhoc .noidung .so3 .title,
    .donxinhoc .noidung .so4 .title, .donxinhoc .noidung .so5 .title, .donxinhoc .noidung .so6 .title,
    .donxinhoc .noidung .so7 .title{
        float:left;
        width:100%;
        line-height:2em;
    }
    .donxinhoc .noidung .so1 .tenhocsinh b{
        text-transform: uppercase;
    }
    .donxinhoc .noidung .so1 .so11 span{
        float:left;
        width:33.3%;
    }
    .donxinhoc .noidung .so1 .so12 span{
        float:left;
        width:50%;
    }
    .donxinhoc .noidung .so1 .so13 span:nth-child(1){
        float:left;
        width:40%;
    }
    .donxinhoc .noidung .so1 .so13 span:nth-child(2), .donxinhoc .noidung .so1 .so13 span:nth-child(3){
        float:left;
        width:30%;
    }
    .donxinhoc .noidung .so1 .so14 span:nth-child(1){
        float:left;
        width:60%;
    }
    .donxinhoc .noidung .so1 .so14 span:nth-child(2){
        float:left;
        width:40%;
    }
    .donxinhoc .noidung .so2 .so21 span, .so31 span, .so41 span, .so51 span{
        float:left;
        width:50%;
    }
    .donxinhoc .noidung .so2 .so22 span, .so32 span, .so42 span{
        float:left;
        width:33.3%;
    }
    .donxinhoc .noidung .so6 .title .so61{
        float:left;
        width:30%;
    }
    .donxinhoc .noidung .so6 .title .so62{
        float:left;
        width:18%;
    }
    .donxinhoc .noidung .so8{
        float:left;
        width:100%;
        margin-top:20px;
    }
    .donxinhoc .noidung .so8 .nguoinhanhoso{
        float:left;
        width:50%;
        text-align:center;
    }
    .donxinhoc .noidung .so8 .nguoinhanhoso span{
        float:left;
        width:100%;
    }
    .button{
        float:left;
        width:100%;
        margin-top:50px;
        margin-bottom:20px;
        text-align:center;
    }
    .button .btn{
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
    </style>
</head>

<body onload="window.print();">
    <div class="donxinhoc">
        <div class="maso">
            <span>Mã số: <b><?php echo $item[0]['code'] ?></b></span>
        </div>
        <div class="tieungu">
            <span class="tennuoc">cộng hòa xã hội chủ nghĩa việt nam</span>
            <span class="slogan">Độc lập - Tự Do - Hạnh phúc</span>
        </div>
        <div class="tieude">
            <span class="giaynhaphoc">Giấy nhập học</span>
            <span>Năm học <?php echo $namhoc[0]['title'] ?></span>
            <span>Đối tượng: <?php echo ($item[0]['doi_tuong'] != 4) ? 'DT'.$item[0]['doi_tuong'] : 'Trái tuyến' ?></span>
            <span>Kính gửi: Ban tuyển sinh <?php echo $truonghoc[0]['title'] ?></span>
        </div>
        <div class="noidung">
            <div class="so1">
                <span class="title tenhocsinh">1. Họ và tên học sinh: <b><?php echo $item[0]['ho_ten'] ?></b></span>
                <span class="title so11">
                    <span>- Giới tính: <b><?php echo ($item[0]['gioi_tinh'] == 1) ? 'Nam' : 'Nữ' ?></b></span>
                    <span>Dân tộc: <b><?php echo $sql->get_title_dan_toc_via_id($item[0]['dan_toc']) ?></b></span>
                    <span>Đối tượng chính sách: <b><?php echo $item[0]['doi_tuong_chinh_sach'] ?></b></span>
                </span>
                <span class="title so12">
                    <span>- Ngày sinh: <b><?php echo date("d-m-Y", strtotime($item[0]['ngay_sinh'])) ?></b></span>
                    <span>Nới sinh (Tỉnh, thành phố): <b><?php echo $sql->get_title_tinh_via_id($item[0]['noi_sinh']) ?></b></span>
                </span>
                <span class="title so13">
                    <span>- Học sinh khuyết tật: <b><?php echo $item[0]['hoc_sinh_khuyet_tat'] ?></b></span>
                    <span>Loại khuyết tật: <b><?php echo $item[0]['loai_khuyet_tat'] ?></b></span>
                    <span>Tình trạng sức khỏe: <b><?php echo $item[0]['tinh_trang_suc_khoe'] ?></b></span>
                </span>
                <span class="title so14">
                    <span>- Hộ khẩu thường trú: Tỉnh(Thành phố): <b><?php echo $sql->get_title_tinh_via_id($item[0]['tinh_thuong_tru']) ?></b></span>
                    <span>Huyện(Quận): <b><?php echo $sql->get_title_huyen_via_id($item[0]['huyen_thuong_tru']) ?></b></span>
                </span>
                <span class="title so13">
                    <span>- Xã(Phường/Thị trấn): <b><?php echo $sql->get_title_xa_via_id($item[0]['xa_thuong_tru']) ?></b></span>
                    <span>Thôn(Phố): <b><?php echo $sql->get_title_thon_to_via_id($item[0]['thon_thuong_tru']) ?></b></span>
                    <span>Xóm(Tổ): <b><?php echo $item[0]['to_thuong_tru'] ?></b></span>
                </span>
                <span class="title so14">
                    <span>- Hiện đang cư trú: Tỉnh(Thành phố): <b><?php echo $sql->get_title_tinh_via_id($item[0]['tinh_hien_tai']) ?></b></span>
                    <span>Huyện(Quận): <b><?php echo $sql->get_title_huyen_via_id($item[0]['huyen_hien_tai']) ?></b></span>
                </span>
                <span class="title so13">
                    <span>- Xã(Phường/Thị trấn): <b><?php echo $sql->get_title_xa_via_id($item[0]['xa_hien_tai']) ?></b></span>
                    <span>Thôn(Phố): <b><?php echo $sql->get_title_thon_to_via_id($item[0]['thon_hien_tai']) ?></b></span>
                    <span>Xóm(Tổ): <b><?php echo $item[0]['to_hien_tai'] ?></b></span>
                </span>
                <span class="title">Được phân tuyến tuyển sinh vào: <b><?php echo $truonghoc[0]['title'] ?></b></span>
                <span class="title">Nguyện vọng vào học: <b><?php echo $truonghoc[0]['title'] ?></b></span>
            </div>
            <div class="so2">
                <span class="title so21">
                    <span>2. Họ tên mẹ: <b><?php echo $item[0]['ten_me'] ?></b></span>
                    <span>Năm sinh: <b><?php echo ($item[0]['nam_sinh_me'] != 0) ? $item[0]['nam_sinh_me'] : '' ?></b></span>
                </span>
                <span class="title so22">
                    <span>- Số CMND: <b><?php echo $item[0]['cmnd_me'] ?></b></span>
                    <span>Số ĐT: <b><?php echo $item[0]['dien_thoai_me'] ?></b></span>
                    <span>Nghề nghiệp: <b><?php echo $item[0]['nghe_nghiep_me'] ?></b></span>
                </span>
            </div>
            <div class="so3">
                <span class="title so31">
                    <span>3. Họ tên cha: <b><?php echo $item[0]['ten_bo'] ?></b></span>
                    <span>Năm sinh: <b><?php echo ($item[0]['nam_sinh_bo'] != 0) ? $item[0]['nam_sinh_bo'] : '' ?></b></span>
                </span>
                <span class="title so32">
                    <span>- Số CMND: <b><?php echo $item[0]['cmnd_bo'] ?></b></span>
                    <span>Số ĐT: <b><?php echo $item[0]['dien_thoai_bo'] ?></b></span>
                    <span>Nghề nghiệp: <b><?php echo $item[0]['nghe_nghiep_bo'] ?></b></span>
                </span>
            </div>
            <div class="so4">
                <span class="title so41">
                    <span>4. Họ tên người đỡ đầu (nếu có): <b><?php echo $item[0]['ten_do_dau'] ?></b></span>
                    <span>Năm sinh: <b><?php echo ($item[0]['nam_sinh_do_dau'] != 0) ? $item[0]['nam_sinh_do_dau'] : '' ?></b></span>
                </span>
                <span class="title so42">
                    <span>- Số CMND: <b><?php echo $item[0]['cmnd_do_dau'] ?></b></span>
                    <span>Số ĐT: <b><?php echo $item[0]['dien_thoai_do_dau'] ?></b></span>
                    <span>Nghề nghiệp: <b><?php echo $item[0]['nghe_nghiep_do_dau'] ?></b></span>
                </span>
            </div>
            <div class="so5">
                <span class="title so51">
                    <span>5. Thông tin liên hệ: <b><?php echo $item[0]['dien_thoai'] ?></b></span>
                    <span>Email: <b><?php echo $item[0]['email'] ?></b></span>
                </span>
            </div>
            <div class="so6">
                <span class="title">
                    <span class="so61">6. Gia đình đăng ký người đón trẻ: </span>
                    <span class="so62">Ông/bà <input type="checkbox" /></span>
                    <span class="so62">Bố/mẹ <input type="checkbox" /></span>
                    <span class="so62">Anh/chị ruột <input type="checkbox" /></span>
                </span>
            </div>
            <div class="so7">
                <span class="title">Cha mẹ học sinh cam kết những thông tin của học sinh là đúng sự thật; nếu không đúng cha mẹ học sinh chịu trách nhiệm</span>
                <span class="title">Học sinh nhập học tại <b><?php echo $truonghoc[0]['title'] ?></b> theo thời gian quy định của nhà trường</span>
                <span class="title">Trân trọng cảm ơn!</span>
            </div>
            <div class="so8">
                <div class="nguoinhanhoso">
                    <span style="font-weight: 700;text-transform: uppercase;">Người nhận hồ sơ</span>
                    <span style="font-style: italic;">(Ký và ghi rõ họ tên)</span>
                </div>
                <div class="nguoinhanhoso">
                    <span style="font-weight: 700;text-transform: uppercase;">Phụ huynh học sinh</span>
                    <span style="font-style: italic;">(Ký và ghi rõ họ tên)</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
