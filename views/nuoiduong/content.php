<?php
$list = array(); $thoigian = $_REQUEST['thoigian']; $thoigian = explode("-", $thoigian);
$month = $thoigian[0]; $year = $thoigian[1]; $sql  = new Model();
$startdate = "01-".$month."-".$year;
$starttime = strtotime($startdate);
$endtime = strtotime("+1 month", $starttime);
for($i = $starttime; $i < $endtime; $i += 86400){
    $list[] = date("d", $i);
}
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Họ tên/Thời gian</th>
            <?php
            foreach ($list as $key => $value) {
            ?>
            <th class="text-center"><?php echo $value ?></th>
            <?php
            }
            ?>
            <th class="text-center">Tổng cộng</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($this->hocsinh as $row) {
        $i++; $tonghocsinh[$row['id']] = 0;
    ?>
    <tr>
        <td class="text-center"><?php echo $i ?></td>
        <td style="min-width:200px"><?php echo trim($row['fullname']) ?></td>
        <?php
        foreach ($list as $key => $value) {
            $Datetime_acdate  = strtotime($year.'-'.$month.'-'.$value);
            $DayofWeek = date('D', $Datetime_acdate );
            $diemdanh = $sql->get_diem_danh_hocsinh($_SESSION['data'][0]['truonghoc_id'], $row['id'], $year.'-'.$month.'-'.$value, $_REQUEST['lophoc']);
            $stick = ($diemdanh == 0) ? '' : 'x';
            $tonghocsinh[$row['id']] = $tonghocsinh[$row['id']] + $diemdanh;
            if($DayofWeek == 'Sat' or $DayofWeek == 'Sun'){
        ?>
        <td class="text-center" style="background:gray"></td>
        <?php
            }else{
        ?>
        <td class="text-center"><?php echo $stick ?></td>
        <?php
            }
        }
        ?>
        <td class="text-center"><?php echo $tonghocsinh[$row['id']] ?></td>
    </tr>
    <?php
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td class="text-center">Tổng</td>
            <?php
            foreach ($list as $key => $value) {
            ?>
            <td class="text-center"></td>
            <?php
            }
            ?>
        </tr>
    </tfoot>
</table>
<style>
.table-bordered > tbody > tr > th,
.table-bordered > tbody > tr > td{
    vertical-align: middle;
    font-size:12px;
    padding:5px;
}
</style>
