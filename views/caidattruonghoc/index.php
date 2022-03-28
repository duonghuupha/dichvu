<?php
$phantuyen = $this->phantuyen;
?>
<script>
var xa_phuong = '<?php echo (count($phantuyen) > 0) ? $phantuyen[0]['xa_phuong'] : '' ?>';
var thon_to = '<?php echo (count($phantuyen) > 0) ? $phantuyen[0]['thon_to'] : '' ?>';
</script>
<script type="text/javascript"
	src="<?php echo URL.'/public/javascript/caidattruonghoc/index.js' ?>"></script>
<script>
$(function(){
    $('#thanhpho_id').load(baseUrl + '/other/combo_thanhpho?id=<?php echo $phantuyen[0]['thanhpho_id'] ?>');
    $('#quan_id').load(baseUrl + '/other/combo_quanhuyen?idh=<?php echo $phantuyen[0]['thanhpho_id'] ?>&id=<?php echo $phantuyen[0]['quan_id'] ?>');
    $('#xaphuong').load(baseUrl + '/other/list_xaphuong?idh=<?php echo $phantuyen[0]['quan_id'] ?>&id=<?php echo $phantuyen[0]['xa_phuong'] ?>');
    $('#thonto').load(baseUrl + '/other/list_thonto?idh='+btoa('<?php echo $phantuyen[0]['xa_phuong'] ?>')+'&id='+btoa('<?php echo $phantuyen[0]['thon_to'] ?>'));
})
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Cài đặt trường học <small>Cài đặt, thiết lập các thông số quan trọng
				cho việc vận hành phần mềm của nhà trường</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Năm học</a></li>
						<li><a href="#tab_2" data-toggle="tab">Phòng ban</a></li>
						<li><a href="#tab_3" data-toggle="tab">Lớp tuyển sinh</a></li>
						<li><a href="#tab_4" data-toggle="tab">Ban tuyển sinh</a></li>
						<li><a href="#tab_5" data-toggle="tab">Phân tuyến tuyển sinh</a></li>
						<li><a href="#tab_6" data-toggle="tab">Tài nguyên</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<div class="box">
                                <div class="box-header">
                                	<h3 class="box-title"></h3>
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default" data-toggle="modal"
                                                    onclick="add_namhoc()">
                                                    <i class="fa fa-plus"></i>
                                                    Thêm mới
                                                </button>
												<button type="button" class="btn btn-success" data-toggle="modal"
                                                onclick="create_qrcodde()" data-toggle="tooltip" data-container="body" data-placement="bottom"
												title="Tạo đường dẫn cho công tác tuyển sinh trực tuyến">
                                                    <i class="fa fa-qrcode"></i>
                                                    Tạo đường dẫn
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body" id="list_namhoc"></div>
                            </div>
						</div>
						<div class="tab-pane" id="tab_2">
							<div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                    	<small>Đỏ: các phòng ban cố định; Xanh: Các phòng ban thay đổi theo năm học</small>
                                    </h3>
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default" data-toggle="modal"
                                                    onclick="add_phongban()">
                                                    <i class="fa fa-plus"></i>
                                                    Thêm mới
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body" id="list_phongban"></div>
                            </div>
						</div>
						<div class="tab-pane" id="tab_3">
							<div class="box">
                                <div class="box-header">
                                	<h3 class="box-title">
										<small>Sử dụng trong công tác tuyển sinh</small>
									</h3>
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default" data-toggle="modal"
                                                    onclick="add_classtemp()">
                                                    <i class="fa fa-plus"></i>
                                                    Thêm mới
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body" id="list_classtemp"></div>
                            </div>
						</div>
						<div class="tab-pane" id="tab_4">
							<div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <small>Sử dụng cho công tác tuyển sinh</small>
                                    </h3>
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default" data-toggle="modal"
                                                    onclick="add_tuyensinh()">
                                                    <i class="fa fa-plus"></i>
                                                    Thêm mới
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body" id="list_bantuyensinh"></div>
                            </div>
						</div>
						<div class="tab-pane" id="tab_5">
							<form id="fm_phantuyen">
                                <input id="id_phantuyen" name="id_phantuyen" value="" type="hidden"/>
                                <input id="xa_phuong" name="xa_phuong" value="<?php echo $phantuyen[0]['xa_phuong'] ?>" type="hidden"/>
                                <input id="thon_to" name="thon_to" value="<?php echo $phantuyen[0]['thon_to'] ?>" type="hidden"/>
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">
                                            Phân tuyến tuyển sinh
                                            <small>Sử dụng cho công tác tuyển sinh</small>
                                        </h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tỉnh / Thành phố<i style="color:red">(*)</i></label>
                                                <select class="form-control" data-placeholder="Lựa chọn tỉnh/TP"
                                                style="width: 100%;" id="thanhpho_id" name="thanhpho_id" required
                                                onchange="set_quan_huyen()">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quận / Huyện<i style="color:red">(*)</i></label>
                                                <select class="form-control" data-placeholder="Lựa chọn quận/huyện"
                                                style="width: 100%;" id="quan_id" name="quan_id" required
                                                onchange="set_xa_phuong()">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Xã / Phường<i style="color:red">(*)</i></label>
                                                <div id="xaphuong" style="height:400px;overflow:auto">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Thôn / Tổ<i style="color:red">(*)</i></label>
                                                <div id="thonto" style="height:400px;overflow:auto">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align:center">
                                        <button type="button" class="btn btn-primary" onclick="save_phantuyen()">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
						</div>
						<div class="tab-pane" id="tab_6">
							<div class="box">
                                <div class="box-header">
                                	<h3 class="box-title">
										<small>Sử dụng cho công tác cập nhật tài nguyên</small>
									</h3>
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default" data-toggle="modal"
                                                    onclick="add_exam()">
                                                    <i class="fa fa-plus"></i>
                                                    Thêm mới
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body" id="list_exam"></div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="namhoc" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Năm học</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_namhoc">
					<input id="id_namhoc" name="id_namhoc" type="hidden" value="0" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title_namhoc"
									placeholder="Tên năm học" name="title_namhoc" required />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
					data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary"
					onclick="save_namhoc()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="phongban" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Phòng ban</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_phongban">
					<input id="id_phongban" name="id_phongban" type="hidden" value="0" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Năm học</label>
							<div class="col-sm-9">
								<select class="form-control select2" style="width: 100%;"
									id="namhoc_id" name="namhoc_id" required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Tên vật
								lý</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title_physic"
									placeholder="Tiêu đề phòng vật lý" name="title_physic" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Tên năm
								học</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title_virtual"
									placeholder="Tiêu đề phòng năm học" name="title_virtual"
									required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Phòng cố
								định</label>
							<div class="col-sm-9">
								<input type="checkbox" class="flat-red" name="co_dinh"
									id="co_dinh" />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
					data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary"
					onclick="save_phongban()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="copyphongban" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog" style="width: 50%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					Copy Phòng ban <small>Chức năng chỉ sử dụng để copy dữ liệu giữa
						các năm học</small>
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_copy">
					<input id="id_cu" name="id_cu" type="hidden" />
					<input id="namhoccuid" name="namhoccuid" type="hidden" />
					<input id="giao_vien" name="giao_vien" type="hidden" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Năm học</label>
							<div class="col-sm-9">
								<select class="form-control select2" style="width: 100%;"
									id="namhocc_id" name="namhocc_id" onchange="check_namhoc()"
									required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Tên vật
								lý</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title_p"
									placeholder="Tiêu đề phòng vật lý" name="title_physic" readonly
									required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Tên năm
								học</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title_v"
									placeholder="Tiêu đề phòng năm học" name="title_virtual"
									required />
							</div>
						</div>
						<!--<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Copy
								thiết bị</label>
							<div class="col-sm-9">
								<input type="checkbox" class="flat-red" name="copytb"
									id="copytb" checked /> <small>Tất cả các thiết bị của phòng ban
									cũ sẽ được luân chuyển lên phòng ban mới</small>
							</div>
						</div>-->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Copy
								giáo viên</label>
							<div class="col-sm-9">
								<input type="checkbox" class="flat-red" name="copygv"
									id="copygv" checked /> <small>Giáo viên cũ sẽ theo lên lớp mới</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
					data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" onclick="save_copy()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="bantuyensinh" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ban tuyển sinh</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_bantuyensinh">
					<input id="id_bantuyensinh" name="id_bantuyensinh" type="hidden"
						value="0" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Năm học</label>
							<div class="col-sm-9">
								<select class="form-control select2" style="width: 100%;"
									id="tsnamhoc_id" name="tsnamhoc_id" required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Lựa chọn
								người dùng</label>
							<div class="col-sm-9">
								<select class="form-control select2" style="width: 100%;"
									id="user_id" name="user_id[]" multiple="multiple" required>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
					data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary"
					onclick="save_tuyensinh()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="classtemp" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Lớp học sử dụng cho module tuyển sinh</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_classtemp">
					<input id="id_temp" name="id_temp" type="hidden" value="0" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title_temp"
									placeholder="Tên lớp" name="title_temp" required />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
					data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary"
					onclick="save_classtemp()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="phanbogiaovien" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog" style="width:60%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="pbgv_title"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_phanbogiaovien">
					<input id="phongbanid" name="phongbanid" type="hidden" value="0" />
					<input id="data_pbgv" name="data_pbgv" type="hidden"/>
					<div class="box-body" id="list_giaovien_pb">

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
					data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary"
					onclick="save_pbgv()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exam" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Elearning</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_exam">
					<input id="id_exam" name="id_exam" type="hidden" value="0" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="title_exam"
									placeholder="Tiêu đề" name="title_exam" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Ngày bắt đầu</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="date_start"
									placeholder="Ngày bắt đầu" name="date_start"
									required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Ngày kết thúc</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="date_end"
									placeholder="Ngày kết thúc" name="date_end"
									required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">Số lượng</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="so_luong"
									placeholder="Số lượng cần cập nhật" name="so_luong" required />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" onclick="save_exam()">Lưu</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="tuyensinh" data-keyboard="false"  data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tạo đường dẫn tuyển sinh trực tuyến</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="fm_exam">
					<input id="id_exam" name="id_exam" type="hidden" value="0" />
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Lựa chọn năm học</label>
							<div class="col-sm-8">
								<select class="form-control" id="lua_chon_nam_hoc" style="width:100%"
									placeholder="Lựa chọn năm học" name="lua_chon_nam_hoc" required>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Ngày bắt đầu</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="date_start_tuyensinh"
									placeholder="Ngày bắt đầu" name="date_start"
									required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Ngày kết thúc</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="date_end_tuyensinh"
									placeholder="Ngày kết thúc" name="date_end"
									required />
							</div>
						</div>
						<div class="form-group" id="duongdantuyensinh">
							<label for="inputEmail3" class="col-sm-4 control-label">Đường dẫn</label>
							<div class="col-sm-8">
								<a id="link">Đường link tuyển sinh trực tuyến</a>
							</div>
						</div>
						<div class="form-group" id="anh_qrcode">
							<label for="inputEmail3" class="col-sm-4 control-label">QR Code</label>
							<div class="col-sm-8">
								<san id="qrcode"></span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" onclick="tao_duong_dan()" id="duongdan">Tạo đường dẫn</button>
			</div>
		</div>
	</div>
</div>
