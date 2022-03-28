<option value="">Lựa chọn thiết bị</option>
<?php
$jsonObj = $this->jsonObj; $sql = new Model(); $thietbicu = $_REQUEST['edit_id'];
for($i = 1; $i <= $jsonObj[0]['so_luong']; $i++){
    if(!isset($_REQUEST['data']) && $_REQUEST['data'] == '' && $thietbicu == ''){
        $disabled = ($sql->check_daphanbo_thietbi($jsonObj[0]['id'], $i) > 0) ? "disabled" : "";
    }else{
        $data = base64_decode($_REQUEST['data']); $data = explode(",", $data);
        /*if(in_array($jsonObj[0]['id'].'.'.$i, $data) && $sql->check_daphanbo_thietbi($jsonObj[0]['id'], $i) > 0){
            $disabled = 'disabled';
        }elseif(!in_array($jsonObj[0]['id'].'.'.$i, $data) && $sql->check_daphanbo_thietbi($jsonObj[0]['id'], $i) > 0){
            $disabled = 'disabled';
        }else{
            $disabled = '';
        }*/
        if(in_array($jsonObj[0]['id'].'.'.$i, $data)){ // neu thiet bi con nam trong thiet bi da chon
            $disabled = 'disabled';
        }else{
            $arr = base64_decode($thietbicu); $arr = explode(",", $arr);
            // neu khong nam trong thiet bi da chon thi kiem tra xem no da dc phan bo chua
            if($sql->check_daphanbo_thietbi($jsonObj[0]['id'], $i) > 0){
                if(in_array($jsonObj[0]['id'].'.'.$i, $arr)){
                    $disabled = '';
                }else{
                    $disabled = 'disabled';
                }
            }else{
                $disabled = '';
            }
        }
    }
?>
<option value="<?php echo $jsonObj[0]['id'].'.'.$i ?>" <?php echo $disabled ?>><?php echo $jsonObj[0]['title'].' - '.$i ?></option>
<?php
}
?>
