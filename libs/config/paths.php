<?php
session_start();
define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/dichvu');
$dirtionary = realpath($_SERVER['DOCUMENT_ROOT']);
define('DIR_UPLOAD', $dirtionary.'/dichvu/public');;
?>
