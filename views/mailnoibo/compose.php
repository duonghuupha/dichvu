<script type="text/javascript" src="<?php echo URL.'/public/javascript/mailnoibo/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Mail nội bộ
            <small>13 new messages</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo URL.'/mailnoibo' ?>" class="btn btn-primary btn-block margin-bottom">Quay lại hộp thư đến</a>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thư mục</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active">
                                <a href="#">
                                    <i class="fa fa-inbox"></i> Hộp thư đến
                                    <span class="label label-primary pull-right">12</span>
                                </a>
                            </li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> Đã gửi</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i> Thư nháp</a></li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> Thùng rác</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Soạn thư mới</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" placeholder="GỬi đến:">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Tiêu đề:">
                        </div>
                        <div class="form-group">
                            <textarea id="compose-textarea" class="form-control" style="height: 300px">
                                <h1><u>Heading Of Message</u></h1>
                                <h4>Subheading</h4>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                    was born and I will give you a complete account of the system, and expound the actual teachings
                                    of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                                    dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                                    how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                                    is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                                    but because occasionally circumstances occur in which toil and pain can procure him some great
                                    pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                                    except to obtain some advantage from it? But who has any right to find fault with a man who
                                    chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                                    produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                                    dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                                    blinded by desire, that they cannot foresee</p>
                                <ul>
                                    <li>List item one</li>
                                    <li>List item two</li>
                                    <li>List item three</li>
                                    <li>List item four</li>
                                </ul>
                                <p>Thank you,</p>
                                <p>John Doe</p>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Đính kèm
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Tối đa. 32MB</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Thư nháp</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gửi</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Hủy bỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>