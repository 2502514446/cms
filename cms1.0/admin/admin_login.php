<?php
$rootFile = dirname(__FILE__);
$fileLength = mb_strlen(basename(dirname(__FILE__)), 'utf-8')*(-1);
require_once(substr($rootFile, 0, $fileLength) . 'initialise.inc.php');
if($_SESSION['admin']) {
	Tool::alertLocation(null, './admin.php');
}
$template = new Template();
$template->display('admin_login.tpl');
