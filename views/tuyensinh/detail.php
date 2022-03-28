<?php
$sql = new Model(); $item = $this->jsonObj; $truonghoc = $this->truonghoc;
$namhoc = $sql->get_title_nam_hoc_by_id($item[0]['nam_hoc_id']);
$bienban = $this->bienban;
?>
<script>
var namhoctuyensinh = <?php echo $item[0]['nam_hoc_id'] ?>;
var idtuyensinh = <?php echo $item[0]['id'] ?>;
var nguoinhan = <?php echo (count($bienban) > 0) ? $bienban[0]['user_id'] : 0 ?>;
var nguoigiao = '<?php echo (count($bienban) > 0) ? $bienban[0]['cmnd'] : '' ?>';
</script>
<link rel="stylesheet" href="<?php echo URL.'/styles/' ?>dist/css/tuyensinh.css" />
<script type="text/javascript" src="<?php echo URL.'/public/javascript/tuyensinh/index.js' ?>"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chi tiết thông tin đăng ký tuyển sinh
            <small>
                <div class="btn-group">
                    <button type="button" class="btn btn-success">Chức năng</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo URL.'/tuyensinh/invoice?id='.$item[0]['id'] ?>" target="_blank">In giấy nhập học</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-toggle="modal" onclick="form_bienban(<?php echo $item[0]['id'] ?>)">
                                In BB bàn giao hồ sơ
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-toggle="modal" onclick="form_tiepnhan(<?php echo $item[0]['id'] ?>)">
                                In giấy tiếp nhận
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URL.'/tuyensinh/formedit?id='.$item[0]['id'] ?>">
                                Chỉnh sửa
                            </a>
                        </li>
                    </ul>
                </div>
            </small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding">
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
                                <span>Đối tượng:
                                    <?php echo ($item[0]['doi_tuong'] != 4) ? 'DT'.$item[0]['doi_tuong'] : 'Trái tuyến' ?></span>
                                <span>Kính gửi: Ban tuyển sinh <?php echo $truonghoc[0]['title'] ?></span>
                            </div>
                            <div class="noidung">
                                <div class="so1">
                                    <span class="title tenhocsinh">1. Họ và tên học sinh:
                                        <b><?php echo $item[0]['ho_ten'] ?></b></span>
                                    <span class="title so11">
                                        <span>- Giới tính:
                                            <b><?php echo ($item[0]['gioi_tinh'] == 1) ? 'Nam' : 'Nữ' ?></b></span>
                                        <span>Dân tộc:
                                            <b><?php echo $sql->get_title_dan_toc_via_id($item[0]['dan_toc']) ?></b></span>
                                        <span>Đối tượng chính sách:
                                            <b><?php echo $item[0]['doi_tuong_chinh_sach'] ?></b></span>
                                    </span>
                                    <span class="title so12">
                                        <span>- Ngày sinh:
                                            <b><?php echo date("d-m-Y", strtotime($item[0]['ngay_sinh'])) ?></b></span>
                                        <span>Nới sinh (Tỉnh, thành phố):
                                            <b><?php echo $sql->get_title_tinh_via_id($item[0]['noi_sinh']) ?></b></span>
                                    </span>
                                    <span class="title so13">
                                        <span>- Học sinh khuyết tật:
                                            <b><?php echo $item[0]['hoc_sinh_khuyet_tat'] ?></b></span>
                                        <span>Loại khuyết tật: <b><?php echo $item[0]['loai_khuyet_tat'] ?></b></span>
                                        <span>Tình trạng sức khỏe:
                                            <b><?php echo $item[0]['tinh_trang_suc_khoe'] ?></b></span>
                                    </span>
                                    <span class="title so14">
                                        <span>- Hộ khẩu thường trú: Tỉnh(Thành phố):
                                            <b><?php echo $sql->get_title_tinh_via_id($item[0]['tinh_thuong_tru']) ?></b></span>
                                        <span>Huyện(Quận):
                                            <b><?php echo $sql->get_title_huyen_via_id($item[0]['huyen_thuong_tru']) ?></b></span>
                                    </span>
                                    <span class="title so13">
                                        <span>- Xã(Phường/Thị trấn):
                                            <b><?php echo $sql->get_title_xa_via_id($item[0]['xa_thuong_tru']) ?></b></span>
                                        <span>Thôn(Phố):
                                            <b><?php echo $sql->get_title_thon_to_via_id($item[0]['thon_thuong_tru']) ?></b></span>
                                        <span>Xóm(Tổ): <b><?php echo $item[0]['to_thuong_tru'] ?></b></span>
                                    </span>
                                    <span class="title so14">
                                        <span>- Hiện đang cư trú: Tỉnh(Thành phố):
                                            <b><?php echo $sql->get_title_tinh_via_id($item[0]['tinh_hien_tai']) ?></b></span>
                                        <span>Huyện(Quận):
                                            <b><?php echo $sql->get_title_huyen_via_id($item[0]['huyen_hien_tai']) ?></b></span>
                                    </span>
                                    <span class="title so13">
                                        <span>- Xã(Phường/Thị trấn):
                                            <b><?php echo $sql->get_title_xa_via_id($item[0]['xa_hien_tai']) ?></b></span>
                                        <span>Thôn(Phố):
                                            <b><?php echo $sql->get_title_thon_to_via_id($item[0]['thon_hien_tai']) ?></b></span>
                                        <span>Xóm(Tổ): <b><?php echo $item[0]['to_hien_tai'] ?></b></span>
                                    </span>
                                    <span class="title">Được phân tuyến tuyển sinh vào:
                                        <b><?php echo $truonghoc[0]['title'] ?></b></span>
                                    <span class="title">Nguyện vọng vào học:
                                        <b><?php echo $truonghoc[0]['title'] ?></b></span>
                                </div>
                                <div class="so2">
                                    <span class="title so21">
                                        <span>2. Họ tên mẹ: <b><?php echo $item[0]['ten_me'] ?></b></span>
                                        <span>Năm sinh:
                                            <b><?php echo ($item[0]['nam_sinh_me'] != 0) ? $item[0]['nam_sinh_me'] : '' ?></b></span>
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
                                        <span>Năm sinh:
                                            <b><?php echo ($item[0]['nam_sinh_bo'] != 0) ? $item[0]['nam_sinh_bo'] : '' ?></b></span>
                                    </span>
                                    <span class="title so32">
                                        <span>- Số CMND: <b><?php echo $item[0]['cmnd_bo'] ?></b></span>
                                        <span>Số ĐT: <b><?php echo $item[0]['dien_thoai_bo'] ?></b></span>
                                        <span>Nghề nghiệp: <b><?php echo $item[0]['nghe_nghiep_bo'] ?></b></span>
                                    </span>
                                </div>
                                <div class="so4">
                                    <span class="title so41">
                                        <span>4. Họ tên người đỡ đầu (nếu có):
                                            <b><?php echo $item[0]['ten_do_dau'] ?></b></span>
                                        <span>Năm sinh:
                                            <b><?php echo ($item[0]['nam_sinh_do_dau'] != 0) ? $item[0]['nam_sinh_do_dau'] : '' ?></b></span>
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
                                    <span class="title">Cha mẹ học sinh cam kết những thông tin của học sinh là đúng sự
                                        thật; nếu không đúng cha mẹ học sinh chịu trách nhiệm</span>
                                    <span class="title">Học sinh nhập học tại
                                        <b><?php echo $truonghoc[0]['title'] ?></b> theo thời gian quy định của nhà
                                        trường</span>
                                    <span class="title">Trân trọng cảm ơn!</span>
                                </div>
                                <div class="so8">
                                    <div class="nguoinhanhoso">
                                        <span style="font-weight: 700;text-transform: uppercase;">Người nhận hồ
                                            sơ</span>
                                        <span style="font-style: italic;">(Ký và ghi rõ họ tên)</span>
                                    </div>
                                    <div class="nguoinhanhoso">
                                        <span style="font-weight: 700;text-transform: uppercase;">Phụ huynh học
                                            sinh</span>
                                        <span style="font-style: italic;">(Ký và ghi rõ họ tên)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="bienban" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Biên bản bàn giao hồ sơ</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_bienban">
                    <input id="code" name="code" type="hidden" value="<?php echo $item[0]['code'] ?>"/> 
                    <input id="hotennguoigiao" name="hotennguoigiao" type="hidden" 
                    value="<?php echo (count($bienban) > 0) ? $bienban[0]['nguoigiao'] : '' ?>"/> 
					<div class="box-body">
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Ngày nhận hồ sơ</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="ngay_nhan_ho_so"
									placeholder="Ngày nhận hồ sơ" name="ngay_nhan_ho_so" 
                                    value="<?php echo date("d-m-Y") ?>" required/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Bên nhận</label>
							<div class="col-sm-9">
								<select class="form-control select2" style="width: 100%;"
									id="bennhan_id" name="bennhan_id" required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Bên giao</label>
							<div class="col-sm-9">
								<select class="form-control select2" style="width: 100%;"
									id="bengiao_id" name="bengiao_id" required onchange="set_ho_ten_giao(this)">
								</select>
							</div>
						</div>
                        <div class="col-md-12">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="flat-red" name="don_xin_hoc" id="don_xin_hoc"
                                        <?php echo (count($bienban) > 0 && $bienban[0]['don_xin_hoc'] == 1) ? 'checked=""' : '' ?>/>
                                        Đơn xin học
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="flat-red" name="giay_khai_sinh" id="giay_khai_sinh"
                                        <?php echo (count($bienban) > 0 &&  $bienban[0]['giay_khai_sinh'] == 1) ? 'checked=""' : '' ?>/>
                                        Giấy khai sinh
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="flat-red" name="photo_ho_khau" id="photo_ho_khau"
                                        <?php echo (count($bienban) > 0 &&  $bienban[0]['photo_ho_khau'] == 1) ? 'checked=""' : '' ?>/>
                                        Bản photo Hộ khẩu hoặc giấy tờ khác thay thế
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Giấy tờ khác</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="giay_to_khac"
									placeholder="Giấy tờ khác" name="giay_to_khac" 
                                    value="<?php echo (count($bienban) > 0) ? $bienban[0]['giay_to_khac'] : '' ?>"/>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    Đóng
                </button>
				<button type="button" class="btn btn-primary" onclick="save_bienban()">
                    Lưu
                </button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="giaytiepnhan" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Giấy tiếp nhận</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_tiepnhan">
                    <input id="code" name="code" type="hidden" value="<?php echo $item[0]['code'] ?>"/>
					<div class="box-body">
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Ngày đi học</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="ngay_di_hoc"
									placeholder="Ngày đi học" name="ngay_di_hoc" 
                                    value="<?php echo (count($bienban) > 0) ? date("d-m-Y", strtotime($bienban[0]['tu_ngay'])) : date("d-m-Y") ?>" required/>
							</div>
						</div>
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Tình trạng sức khỏe</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="tinh_trang_suc_khoe"
									placeholder="Tình trạng sức khỏe" name="tinh_trang_suc_khoe"
                                    value="<?php echo (count($bienban) > 0) ? $bienban[0]['suc_khoe'] : 'Tốt' ?>"/>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    Đóng
                </button>
				<button type="button" class="btn btn-primary" onclick="save_tiepnhan()">
                    Lưu
                </button>
			</div>
		</div>
	</div>
</div>