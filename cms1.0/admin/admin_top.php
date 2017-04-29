<?php
$rootFile = dirname(__FILE__);
$fileLength = mb_strlen(basename(dirname(__FILE__)), 'utf-8')*(-1);
require_once(substr($rootFile, 0, $fileLength) . 'initialise.inc.php');
if(!$_SESSION['admin']) {
	Tool::alertLocation(null, './admin_login.php');
}
$template = new Template();
//注入变量应在生成编译文件之前注入
$template->assigned('user',$_SESSION['admin']['user']);
$template->assigned('level_name',$_SESSION['admin']['level_name']);
$template->display('admin_top.tpl');

