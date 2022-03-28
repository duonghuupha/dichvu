<?php 
$sql = new Model(); $info = $_SESSION['data'];
$jsonObj = $this->jsonObj;
if(count($jsonObj) > 0){
    foreach($jsonObj as $row){
        $array[] = $row['id'];
    }
}else{
    $array[] = '';
}
?>
<script>
var dataStr = '<?php echo implode(",", $array) ?>';
</script>
<script type="text/javascript" src="<?php echo URL.'/public/javascript/diemdanh/index.js' ?>"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Điểm danh
            <small>
                Ngày <?php echo date("d-m-Y") ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách học sinh
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding" id="list_hocsinh">
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Danh sách học sinh đi học
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table id="list_diemdanh" class="table table-bordered table-hover">
                            <tr>
                                <th class="text-center" style="width: 10px">#</th>
                                <th class="text-center" style="width: 100px">Mã HS</th>
                                <th class="text-center">Họ và tên</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>