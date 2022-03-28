<?php
$convert = new Convert(); $info = $_SESSION['data']; $sql = new Model();
$array_day = $convert->daysInWeek($_REQUEST['tuan']);
?>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/erp/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            ERP - Lịch công tác tổ nhóm
            <small class="pull-right">
                <button type="button" class="btn btn-success" onclick="xuat_file()">
                    <i class="fa fa-file-pdf-o"></i>
                    Xuất PDF
                </button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo URL.'/erp' ?>'">
                    <i class="fa fa-angle-double-left "></i>
                    Quay lại
                </button>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding" id="lichtonhom">
                        <table id="customers">
                            <colgroup style="width:3%"></colgroup>
                            <colgroup style="width:10%"></colgroup>
                            <colgroup style="width:5%"></colgroup>
                            <colgroup style="width:13%"></colgroup>
                            <colgroup style="width:13%"></colgroup>
                            <colgroup style="width:13%"></colgroup>
                            <colgroup style="width:13%"></colgroup>
                            <colgroup style="width:13%"></colgroup>
                            <colgroup style="width:13%"></colgroup>
                            <tr>
                                <th>TT</th>
                                <th>Họ và tên</th>
                                <th>Buổi</th>
                                <?php
                                foreach($array_day as $row){
                                ?>
                                <th>
                                    <?php
                                    echo $convert->return_day_text(date("D", strtotime($row))).'<br/>';
                                    echo date("d-m", strtotime($row));
                                    ?>
                                </th>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                            $i = 0;
                            foreach($this->jsonObj as $row){
                                $i++;
                            ?>
                            <tr>
                                <td style="text-align:center;font-weight:700" rowspan="2"><?php echo $i ?></td>
                                <td style="text-align:center;font-weight:700" rowspan="2"><?php echo $row['fullname']."<br/><i style='font-weight:300'>(".$row['job'].")</i>" ?></td>
                                <td style="text-align:center;font-weight:700">Sáng</td>
                                <?php
                                foreach($array_day as $item){
                                    echo "<td style='vertical-align:top'>";
                                    $task[$row['id']] = $sql->get_list_task_via_day(date("Y-m-d", strtotime($item)), $row['id'], 1);
                                    //echo $task;
                                    if(count($task[$row['id']]) > 0){
                                        foreach ($task[$row['id']] as $value) {
                                            $arr = $value['user_id_follow']; $arr = explode(",", $arr);
                                            $giamsat = (in_array($row['id'], $arr)) ? '<i style="font-size:12px">(Giám sát)</i>' : '';
                                            echo "<p><i class='fa fa-tag'></i> ".$value['content']." ".$giamsat."</p>";
                                        }
                                    }else{
                                        echo "<i>Chưa có công việc</i>";
                                    }
                                    echo "</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-weight:700">Chiều</td>
                                <?php
                                foreach($array_day as $item){
                                    echo "<td style='vertical-align:top'>";
                                    $task[$row['id']] = $sql->get_list_task_via_day(date("Y-m-d", strtotime($item)), $row['id'], 2);
                                    //echo $task;
                                    if(count($task[$row['id']]) > 0){
                                        foreach ($task[$row['id']] as $value) {
                                            $arr = $value['user_id_follow']; $arr = explode(",", $arr);
                                            $giamsat = (in_array($row['id'], $arr)) ? '<i style="font-size:12px">(Giám sát)</i>' : '';
                                            echo "<p><i class='fa fa-tag'></i> ".$value['content']." ".$giamsat."</p>";
                                        }
                                    }else{
                                        echo "<i>Chưa có công việc</i>";
                                    }
                                    echo "</td>";
                                }
                                ?>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
