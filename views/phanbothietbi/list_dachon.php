<input id="datadc" name="datadc" type="hidden" value="<?php echo $this->dachon ?>"/>
<ul>
    <?php
    $sql = new Model(); $result = array_diff($this->array, [0]);   
    if(count($result) > 0){
        foreach($result as $row){
            $value = explode(".", $row);
            $info = $sql->get_info_thietbi($value[0]);
        ?>
        <li id="tb_<?php echo $value[0].'_'.$value[1] ?>">
            <?php echo $info[0]['title'].' - '.$value[1] ?> |
            <a href="javascript:void(0)" onclick="del_dachon('<?php echo $row ?>')" style="color:red" title="Xóa">
                <i class="fa fa-trash"></i>
            </a>
        </li> 
        <?php
        }
    }else{
        echo "";
    }
    ?>
</ul>