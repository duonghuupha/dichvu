<?php
$convert = new Convert();
if(count($this->linkctt) > 0){
    $link = $this->linkctt;
    echo "<table>";
    echo $convert->return_thongke_website($link[0]['link_ctt']);
    echo "</table>";
}else{
    echo "<i>Không có dữ liệu</i>";
}
?>