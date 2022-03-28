<?php
$userid = $_REQUEST['id'];
function showCategories($categories, $user_id, $parent_id = 0, $char = ''){
    $cate_child = array(); $convert = new Convert(); $sql = new Model();
    foreach ($categories as $key => $item){
        if ($item['parent_id'] == $parent_id){
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
    if ($cate_child){
        echo '<ul>';
        foreach ($cate_child as $key => $item){
            $chucnang = $sql->get_chuc_nang_of_user($user_id, $item['id']);
            if(count($chucnang) > 0){
                foreach ($chucnang as $key => $value) {
                    $arr[$item['id']][] = $value['chuc_nang'];
                }
                $arr_chucnang = $convert->display_chuc_nang(implode(",", $arr[$item['id']]));
            }else{
                $arr_chucnang = '';
            }
            echo '<li>'.$char.' <a href="javascript:void(0)" onclick="edit('.$item['id'].')" data-toggle="tooltip" data-container="body" data-placement="bottom" title="'.$arr_chucnang.'">'.$item['title']."</a>";
            if($item['is_menu'] == 1){
                echo '<small style="margin-left:10px;"><i>( Menu - Quyền )</i></small>';
            }else{
                echo '<small tyle="margin-left:10px;"><i>( Quyền )</i></small>';
            }
            showCategories($categories, $user_id, $item['id'], $char.'|---');
            echo '</li>';
        }
        echo '</ul>';
    }
}
echo showCategories($this->roles, $userid);
?>
