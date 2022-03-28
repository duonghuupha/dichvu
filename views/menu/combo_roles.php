<option value="">Lựa chọn menu cha</option>
<?php
function showCategories($categories, $parent_id = 0, $char = '', $idh){
    foreach ($categories as $key => $item){
        $selected = ($idh == $item['id']) ? 'selected=""' : '';
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id){
            echo '<option value="'.$item['id'].'" '.$selected.'>';
                echo $char . $item['title'];
            echo '</option>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item['id'], $char.'|---', $idh);
        }
    }
}
showCategories($this->jsonObj, 0, '', $_REQUEST['idh']);
?>