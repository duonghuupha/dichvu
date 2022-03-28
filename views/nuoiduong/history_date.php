<?php
$jsonObj = $this->jsonObj;
?>
<ul class="todo-list">
    <?php
    foreach($jsonObj as $row){
    ?>
    <li>
        <span class="text">
            Vào lúc <?php echo date("H:i:s", strtotime($row['time'])) ?> ngày <?php echo date("d-m-Y") ?> 
            <b><?php echo $row['name'] ?></b> 
            đã báo <?php echo $row['anchinh'] ?> ăn chính <?php echo $row['coduong'] ?> có đường <?php echo $row['khongduong'] ?> không đường
        </span>
    </li>
    <?php
    }
    ?>
</ul>