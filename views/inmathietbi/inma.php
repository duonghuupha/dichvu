<title>PTSOFT :: In mã thiết bị</title>
<?php
$data = base64_decode($_REQUEST['data']); $data = explode(",", $data);
$sql = new Model(); $coquan = $this->coquan;
foreach($data as $row){
    $value = explode(".", $row); $detail = $sql->get_info_thietbi($value[0]);
    for($i = 1; $i <= $value[1]; $i++){
?>
<div class="item">
    <img src="<?php echo URL.'/inmathietbi/qrcode?data='.base64_encode($detail[0]['code']."-".$i).'&size=250x250' ?>"/>
    <div>
        <?php
        if($coquan[0]['logo'] != ''){
            echo "<img src='".URL."/public/truonghoc/logo/".$coquan[0]['logo']."'/>";
        }else{
            echo "<img src='".URL."/styles/dist/img/giao_duc.jpg'/>";
        }
        ?>
        <span>
            <i><?php echo $coquan[0]['title'] ?></i>
            <i><?php echo $detail[0]['title'].' - '.$i ?></i>
        </span>
    </div>
</div>
<?php
    }
}
?>
<style>
.item{float:left;width:250px;height:300px;overflow:hidden;border:1px solid #ccc;margin-right:3px;margin-bottom:3px;text-align:center}
.item div{float:left;width:100%;overflow:hidden}
.item div>img{float:left;width:50px}
.item div>span{float:left;width:200px}
.item div>span>i{font-size:12px;float:left;width:100%}
.item div>span>i:nth-child(1){font-weight:bold}
</style>