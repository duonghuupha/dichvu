<?php
$sql = new Model();
function showCategories($categories, $parent_id = 0, $char = ''){
    $cate_child = array(); $convert = new Convert();
    foreach ($categories as $key => $item){
        if ($item['parent_id'] == $parent_id){
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
    if ($cate_child){
        echo '<ul>';
        foreach ($cate_child as $key => $item){
            echo '<li>'.$char.' <a href="javascript:void(0)" onclick="edit('.$item['id'].')" data-toggle="tooltip" data-container="body" data-placement="bottom" title="'.$convert->display_chuc_nang($item['chuc_nang']).'">'.$item['title']."</a>";
            if($item['is_menu'] == 1){
                echo '<small style="margin-left:10px;"><i>( Menu - Quyền )</i></small>';
            }else{
                echo '<small tyle="margin-left:10px;"><i>( Quyền )</i></small>';
            }
            showCategories($categories, $item['id'], $char.'|---');
            echo '</li>';
        }
        echo '</ul>';
    }
}
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/menu/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh sách quyền và hệ thống menu của phần mềm
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php
            foreach($this->dichvu as $row){
                $jsonObj = $sql->get_all_menu_roles($row['id']);
            ?>
            <div class="col-xs-4">
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $row['title'] ?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" onclick="add(<?php echo $row['id'] ?>)">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body roles_menu">
                        <?php
                        showCategories($jsonObj);
                        ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
</div>

<div class="modal fade" id="menu" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Quyền - Menu</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="fm">
                    <input id="id_menu" name="id_menu" type="hidden" value="0" />
                    <input id="id_dichvu" name="id_dichvu" type="hidden" value="0" />
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Lựa chọn dịch vụ</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="dichvu_id"
                                    name="dichvu_id" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Menu cha</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="parent_id"
                                    name="parent_id">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Tiêu đề quyền - menu"
                                    name="title" required="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Thứ tự hiển thị</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="thu_tu" placeholder="Thứ tự hiển thị"
                                    name="thu_tu" required="" />
                            </div>
                        </div>
                        <div class="form-group" id="duongdan">
                            <label for="inputEmail3" class="col-sm-3 control-label">Đường dẫn</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="link" placeholder="Đường dẫn module"
                                    name="link" required=""/>
                            </div>
                        </div>

                        <div class="form-group" id="chucnang">
                            <label for="inputEmail3" class="col-sm-3 control-label">Chức năng</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="chuc_nang"
                                    name="chuc_nang[]" multiple="">
                                    <option value="1">Thêm mới</option>
                                    <option value="2">Cập nhật</option>
                                    <option value="3">Xóa</option>
                                    <option value="4">Giao việc</option>
                                    <option value="5">Lịch công tác tổ nhóm</option>
                                    <option value="6">Duyệt bài</option>
                                    <option value="7">Duyệt đề nghị</option>
                                    <option value="8">Duyệt hiển thị</option>
                                    <option value="9">Giao lịch</option>
                                    <option value="10">Chuyển lớp</option>
                                    <option value="11">Đăng tin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="save()">Lưu</button>
                <button type="button" class="btn btn-danger" id="danger_menu">Xóa</button>
            </div>
        </div>
    </div>
</div>
