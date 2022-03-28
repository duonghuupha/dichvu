<ul class="timeline timeline-inverse">
    <?php
    foreach($this->jsonObj as $row){
    ?>
    <li class="time-label">
        <span class="bg-red">
            <?php echo date("H:i:s d-m-Y") ?>
        </span>
    </li>
    <li>
        <i class="fa fa-wrench bg-blue"></i>
        <div class="timeline-item">
            <h3 class="timeline-header">
                <?php echo $row['danhmuc'] ?>
            </h3>
            <div class="timeline-body"><?php echo $row['noidung'] ?></div>
        </div>
    </li>
    <?php
    }
    ?>
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>