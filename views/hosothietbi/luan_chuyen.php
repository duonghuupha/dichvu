<?php
$landau = $this->landau; $luanchuyen = $this->luanchuyen;
?>
<ul class="timeline timeline-inverse">
    <li class="time-label">
        <span class="bg-green">
            <?php echo date("d-m-Y", strtotime($landau[0]['ngaytao'])) ?>
        </span>
    </li>
    <li>
        <i class="fa  fa-share-alt bg-blue"></i>
        <div class="timeline-item">
            <h3 class="timeline-header">
                Cấp lần đầu tiên: <?php echo $landau[0]['phongbanp'] ?> - <?php echo $landau[0]['phongbanv'] ?>
            </h3>
        </div>
    </li>
    <?php
    foreach($luanchuyen as $row){
    ?>
    <li class="time-label">
        <span class="bg-blue">
            <?php echo date("d-m-Y", strtotime($row['create_at'])) ?>
        </span>
    </li>
    <li>
        <i class="fa fa-exchange bg-aqua"></i>
        <div class="timeline-item">
            <h3 class="timeline-header no-border">
                Luân chuyển từ: <i style="color:red"><?php echo $row['titlep'].' - '.$row['titlev'] ?></i>
            </h3>
            <h3 class="timeline-header no-border">
                Đến: <i style="color:green"><?php echo $row['titlepd'].' - '.$row['titlevd'] ?></i>
            </h3>
        </div>
    </li>
    <?php
    }
    ?>
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>