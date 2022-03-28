<?php
class Roles{
    private $_Data;
    function __construct(){
        $this->_Data = new Model();
    }

    /**
     * 1 - bao tri, bao duong; 2 - sua chua, thay the; 3 - erp; 4 - van ban; 5 - cttdt
     * 6 - tai san; 7 - create website; 8 - email noi bo; 9 - tuyen sinh; 10 - nuoi duong
     * @param unknown $id
     */

    function return_checked($role, $id){
        $value = $this->_Data->check_roles($id, $role);
        if($value > 0){
            $checked = 'checked=""';
        }else{
            $checked = '';
        }
        return $checked;
    }
    /****/
    function return_checked_chucnang($role, $chucnang, $id){
        $value = $this->_Data->check_chucnang($role, $chucnang, $id);
        if($value > 0){
            $checked = 'checked=""';
        }else{
            $checked = '';
        }
        return $checked;
    }

    //***/
    function check_role_when_enter_link($userid, $url, $chucnang){
        $sql = new Model();
        $role = $sql->get_id_of_role($url);
        if(count($role) > 0){
            $id_role = $role[0]['id'];
            if($sql->check_chuc_nang_of_user($userid, $id_role, $chucnang) == 0){
                session_start();
                session_destroy();
                header ('Location: '.URL.'/index/login_s');
                exit;
            }
        }else{
            session_start();
            session_destroy();
            header ('Location: '.URL.'/index/login_s');
            exit;
        }
    }
}
?>
