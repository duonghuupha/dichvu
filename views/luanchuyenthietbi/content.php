<?php
$convert = new Convert(); $jsonObj = $this->jsonObj; $perpage = $this->perpage;
$pages = $this->page;
?>
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Nơi đi</th>
            <th>Nơi đến</th>
            <th>Thiết bị</th>
            <th>Cập nhật lần cuối</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($jsonObj['rows'] as $row){
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?>.</td>
            <td><?php echo $row['noidi'] ?></td>
            <td><?php echo $row['noiden'] ?></td>
            <td><?php echo $row['thietbi'].' - '.$row['so_con'] ?></td>
            <td><?php echo date("H:i:s d-m-Y", strtotime($row['create_at'])) ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="width: 10px">#</th>
            <th>Nơi đi</th>
            <th>Nơi đến</th>
            <th>Thiết bị</th>
            <th>Cập nhật lần cuối</th>
        </tr>
    </tfoot>
</table>
<?php
if($jsonObj['total'] > $perpage){
    $pagination = $convert->pagination($jsonObj['total'], $pages, $perpage);
    $createlink = $convert->createLinks_event($jsonObj['total'], $perpage, $pagination['number'], 'view_page_luanchuyen', 1);
?>
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php echo $createlink ?>
    </ul>
</div>
<?php
}