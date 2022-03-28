<?php
$phongban = $this->phongban;
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/nuoiduong/baoan.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Nuôi dưỡng - Báo ăn trực tuyến
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            Số liệu báo ăn :: <?php echo date("d-m-Y") ?>
                        </h3>
                    </div>
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="phongbanid" name="phongbanid" value="<?php echo $phongban[0]['id'] ?>" type="hidden" />
                        <div class="box-body">
                            <div class="col-md-12 text-center">
                                <h4><?php echo $phongban[0]['title_virtual'] ?></h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ăn chính</label>
                                    <input type="text" class="form-control" id="an_chinh" placeholder="Số lượng ăn chính"
                                        name="an_chinh" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sữa có đường</label>
                                    <input type="text" class="form-control" id="co_duong" placeholder="Sữa có đường"
                                        name="co_duong" value="0" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sữa không đường</label>
                                    <input type="text" class="form-control" id="khong_duong" placeholder="Sữa không đường"
                                        name="khong_duong" value="0" required />
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save()">
                                <i class="fa fa-pencil"></i>
                                Ghi dữ liệu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Quá trình báo ăn trong ngày <?php echo date("d-m-Y") ?>
                        </h3>
                    </div>
                    <div class="box-body" id="food_history_date">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Dữ liệu báo ăn của lớp
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_history">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="view_history" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lịch sử báo ăn ngày</h4>
            </div>
            <div class="modal-body">
                <ul class="todo-list" id="todo_history">
                    
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>