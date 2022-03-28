<?php
$jsonObj = $this->jsonObj; $sql = new Model();
function showCategories($categories, $parent_id = 0, $char = '', $iduser){
    $cate_child = array(); $roles = new Roles();
    $array = array(1 => 'Thêm mới', 2 => 'Cập nhật', 3 => 'Xóa', 4 => 'Giao việc', 5 => 'Lịch công tác tổ / nhóm',
                    6 => 'Duyệt bài', 7 => 'Duyệt đề nghị', 8 => 'Duyệt hiển thị', 9 => 'Giao lịch', 10 => 'Chuyển lớp',
                    11 => 'Đăng tin');
    foreach ($categories as $key => $item){
        if ($item['parent_id'] == $parent_id){
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
    if ($cate_child){
        echo '<ul>';
        foreach ($cate_child as $key => $item){
            echo '<li>';
            echo '<label>';
            echo '<input type="checkbox" class="flat-red" name="roles[]" id="roles" value="'.$item['id'].'" '.$roles->return_checked($item['id'], $iduser).'/>';
            echo ' '.$item['title'];
            echo '</label>';
            if($item['chuc_nang'] != ''){
                echo '<ul>';
                $role = explode(",", $item['chuc_nang']);
                foreach ($role as $key => $value) {
                    echo '<li>';
                    echo '<label>';
                    echo '<input type="checkbox" class="flat-red" name="chucnang[]" id="roles" value="'.$item['id'].'.'.$value.'" '.$roles->return_checked_chucnang($item['id'], $value, $iduser).'/>';
                    echo ' '.$array[$value];
                    echo '</label>';
                    echo '</li>';
                }
                echo  '</ul>';
            }
            showCategories($categories, $item['id'], $char.'|---', $iduser);
            echo '</li>';
        }
        echo '</ul>';
    }
}
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/nguoidung/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Phân quyền cho tài khoản
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trường học</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Tên hiển thị"
                                        name="fullname" value="<?php echo $jsonObj[0]['truonghoc_id'] ?>" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hiển thị</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Tên hiển thị"
                                        name="fullname" value="<?php echo $jsonObj[0]['fullname'] ?>" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập"
                                        name="username" value="<?php echo $jsonObj[0]['username'] ?>" readonly />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box box-success">
                    <form role="form" method="post" id="fm" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $jsonObj[0]['id'] ?>" type="hidden" />
                        <div class="box-header with-border">
                            <h3 class="box-title">Danh sách quyền</h3>
                        </div>
                        <div class="box-body roles_menu">
                            <?php
                            foreach($this->dichvu as $row){
                                $quyen = $sql->get_all_menu_roles($row['id']);
                                if(count($quyen) > 0){
                            ?>
                            <div class="col-md-4 roles">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo $row['title'] ?></h3>
                                </div>
                                <?php
                                showCategories($quyen, 0, '', $jsonObj[0]['id'])
                                ?>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="button" class="btn btn-primary" onclick="save_roles()">Cập nhật</button>
                            <button type="button" class="btn btn-danger"
                                onclick="window.location.href='<?php echo URL.'/nguoidung' ?>'">Quay lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
