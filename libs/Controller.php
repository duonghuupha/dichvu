<?php
class Controller {
    private $_Data;
    private $_Info;
    private $_Convert;
	function __construct() {
		$this->view = new View();
        $this->_Data = new Model();
        @$this->_Info = $_SESSION['data'];
        $this->_Convert = new Convert();
	}

	public function loadModel($name) {
		$path = 'models/'.$name.'_model.php';

		if (file_exists($path)) {
			require 'models/'.$name.'_model.php';
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}

	public function PhadhInt(){
        Session::init();
        $logged = Session::get('loggedIn');
        if($logged == false){
            session_start();
            //Session::destroy();
            session_destroy();
            header ('Location: '.URL.'/index/login');
            exit;
        }else{
            if(isset($_REQUEST['url'])){
                $url = $_REQUEST['url'];
            }else{
                $url = "index";
            }
            if(!$this->_Convert->return_role_url($this->_Info[0]['truonghoc_id'], $url)){
                session_start();
                session_destroy();
                header ('Location: '.URL.'/index/login_s');
                exit;
            }
        }
    }

    public function renderMenuDichVu($truonghocid, $userid, $isboss, $url){
        $menu = '
        <li class="'.$this->_Convert->return_active_menu('index', $url).'">
            <a href="'.URL.'/index">
                <i class="fa fa-dashboard"></i> <span>Bàn làm việc</span>
            </a>
        </li>
        ';

        if($truonghocid == 0){
            $menu .= '
                <li class="treeview '.$this->_Convert->return_active_menu('danhmucloi,thanhpho,quanhuyen,xaphuong,thonto', $url).'">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Danh mục </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="'.$this->_Convert->return_active_menu('dichvu', $url).'">
                            <a href="'.URL.'/dichvu">
                                <i class="fa fa-files-o"></i>
                                <span>Quản lý dịch vụ</span>
                            </a>
                        </li>
                        <li class="'.$this->_Convert->return_active_menu('menu', $url).'">
                            <a href="'.URL.'/menu">
                                <i class="fa fa-files-o"></i>
                                <span>Quyền - Menu</span>
                            </a>
                        </li>
                        <li class="'.$this->_Convert->return_active_menu('danhmucloi', $url).'">
                            <a href="'.URL.'/danhmucloi">
                                <i class="fa fa-files-o"></i>
                                <span>Danh mục hỗ trợ kỹ thuật</span>
                            </a>
                        </li>
                        <li class="'.$this->_Convert->return_active_menu('thanhpho', $url).'">
                            <a href="'.URL.'/thanhpho">
                                <i class="fa fa-files-o"></i>
                                <span>Danh mục tỉnh / thành phố</span>
                            </a>
                        </li>
                        <li class="'.$this->_Convert->return_active_menu('quanhuyen', $url).'">
                            <a href="'.URL.'/quanhuyen">
                                <i class="fa fa-files-o"></i>
                                <span>Danh mục quận / huyện</span>
                            </a>
                        </li>
                        <li class="'.$this->_Convert->return_active_menu('xaphuong', $url).'">
                            <a href="'.URL.'/xaphuong">
                                <i class="fa fa-files-o"></i>
                                <span>Danh mục xã / phường</span>
                            </a>
                        </li>
                        <li class="'.$this->_Convert->return_active_menu('thonto', $url).'">
                            <a href="'.URL.'/thonto">
                                <i class="fa fa-files-o"></i>
                                <span>Danh mục thôn / tổ</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="'.$this->_Convert->return_active_menu('truonghoc', $url).'">
                    <a href="'.URL.'/truonghoc">
                        <i class="fa fa-th"></i> <span>Quản lý trường học</span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green">'.$this->_Data->get_total_truonghoc().'</small>
                        </span>
                    </a>
                </li>'
            ;
        }

        if($truonghocid == 0 || $this->_Data->check_exit_dichvu($truonghocid) > 0){
            if($isboss == 1 || $truonghocid == 0){
            $menu .= '
                <li class="'.$this->_Convert->return_active_menu('nguoidung', $url).'">
                    <a href="'.URL.'/nguoidung">
                        <i class="fa fa-users"></i> <span>Người dùng</span>
                    </a>
                </li>
            ';
            }
            if($isboss == 1){
                $menu .= '
                    <li class="'.$this->_Convert->return_active_menu('caidattruonghoc', $url).'">
                        <a href="'.URL.'/caidattruonghoc">
                            <i class="fa fa-gear"></i> <span>Cài đặt trường học</span>
                        </a>
                    </li>
                ';
            }
        }

        return $menu;
    }
}
?>
